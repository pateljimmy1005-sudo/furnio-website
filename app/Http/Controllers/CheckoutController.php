<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;

class CheckoutController extends Controller
{
    public function buyNow($id)
    {
        Product::findOrFail($id);
        return redirect()->route('checkout', ['buy_now' => $id]);
    }

    public function checkout(Request $request)
    {
        $buyNowId = $request->query('buy_now');
        $checkoutItems = collect();
        $subtotal = 0;
        $shipping = 99;

        if ($buyNowId) {
            $product = Product::findOrFail($buyNowId);
            $originalPrice = $product->price;
            $discount = $product->discount;
            $discountAmount = ($originalPrice * $discount) / 100;
            $finalPrice = $product->finalPrice();

            $checkoutItems->push((object)[
                'product' => $product,
                'quantity' => 1,
                'final_price' => $finalPrice,
                'original_price' => $originalPrice,
                'discount' => $discount,
                'discount_amount' => $discountAmount,
                'subtotal' => $finalPrice
            ]);
            $subtotal = $finalPrice;
        } else {
            $cart = Cart::with('product.featuredImage')
                ->where('user_id', auth()->id())
                ->get();

            if ($cart->isEmpty()) {
                return redirect()->route('cart')->with('info', 'Your cart is empty.');
            }

            foreach ($cart as $item) {
                $product = $item->product;
                if (!$product) continue;
                $originalPrice = $product->price;
                $discount = $product->discount;
                $discountAmount = ($originalPrice * $discount) / 100;
                $finalPrice = $product->finalPrice();
                $itemSubtotal = $finalPrice * $item->quantity;

                $checkoutItems->push((object)[
                    'product' => $product,
                    'quantity' => $item->quantity,
                    'final_price' => $finalPrice,
                    'original_price' => $originalPrice,
                    'discount' => $discount,
                    'discount_amount' => $discountAmount,
                    'subtotal' => $itemSubtotal,
                    'cart_id' => $item->id
                ]);
                $subtotal += $itemSubtotal;
            }
        }

        $totalAmount = $subtotal + $shipping;
        $defaultAddress = \App\Models\UserAddress::where('user_id', auth()->id())->where('is_default', true)->first();

        return view('checkout', compact('checkoutItems', 'subtotal', 'shipping', 'totalAmount', 'defaultAddress'));
    }

    public function placeOrder(\App\Http\Requests\CheckoutRequest $request)
    {
        $buyNowId = $request->input('buy_now');
        $checkoutItems = collect();

        if ($buyNowId) {
            $product = Product::findOrFail($buyNowId);
            $finalPrice = $product->finalPrice();

            $checkoutItems->push([
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $finalPrice,
            ]);
        } else {
            $cart = Cart::with('product.featuredImage')
                ->where('user_id', auth()->id())
                ->get();

            if ($cart->isEmpty()) {
                return redirect()->route('cart')->with('error', 'Your cart is empty.');
            }

            foreach ($cart as $item) {
                $product = $item->product;
                if (!$product) continue;
                $finalPrice = $product->finalPrice();

                $checkoutItems->push([
                    'product_id' => $product->id,
                    'quantity' => $item->quantity,
                    'price' => $finalPrice,
                ]);
            }
        }

        $shipping = config('shop.shipping_fee', 99);
        DB::beginTransaction();
        try {
            $totalProductAmount = 0;
            
            // First pass: Calculate totals and verify stock
            foreach ($checkoutItems as $item) {
                $productForStockCheck = Product::lockForUpdate()->find($item['product_id']);
                if (!$productForStockCheck || $productForStockCheck->stock < $item['quantity']) {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Insufficient stock for product: ' . ($productForStockCheck->name ?? 'Unknown'))->withInput();
                }
                
                $orderTotal = $item['price'] * $item['quantity'];
                $totalProductAmount += $orderTotal;
                
                // Decrement stock immediately to prevent race conditions
                $productForStockCheck->decrement('stock', $item['quantity']);
            }

            $totalPayableAmount = $totalProductAmount + $shipping;

            // Create single Order
            $order = Order::create([
                'user_id' => auth()->id(),
                'name' => $request->name,
                'phone' => $request->mobile,
                'address' => $request->address,
                'total_amount' => $totalProductAmount,
                'shipping_fee' => $shipping,
                'payment_method' => $request->payment_method,
                'status' => 'Created',
                'payment_status' => 'pending',
            ]);

            // Create OrderItems
            foreach ($checkoutItems as $item) {
                \App\Models\OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);
            }

            if ($request->payment_method == 'online') {
                $razorpayKey = config('services.razorpay.key');
                $razorpaySecret = config('services.razorpay.secret');

                $isMock = empty($razorpayKey) ||
                          empty($razorpaySecret) ||
                          str_contains($razorpayKey, 'XXXX') ||
                          str_contains($razorpaySecret, 'xxxx');

                if ($isMock) {
                    $razorpayOrderId = 'order_mock_' . uniqid();
                } else {
                    $api = new \Razorpay\Api\Api($razorpayKey, $razorpaySecret);
                    $razorpayOrder = $api->order->create([
                        'receipt' => 'receipt_order_' . $order->id,
                        'amount' => $totalPayableAmount * 100,
                        'currency' => 'INR'
                    ]);
                    $razorpayOrderId = $razorpayOrder['id'];
                }

                $order->update([
                    'razorpay_order_id' => $razorpayOrderId
                ]);

                if (!$buyNowId) {
                    Cart::where('user_id', auth()->id())->delete();
                }

                DB::commit();

                return view('payment', [
                    'razorpayOrderId' => $razorpayOrderId,
                    'amount' => $totalPayableAmount,
                    'order' => $order,
                    'name' => $request->name,
                    'phone' => $request->mobile,
                    'email' => auth()->user()->email,
                    'isMock' => $isMock,
                ]);

            } else {
                if (!$buyNowId) {
                    Cart::where('user_id', auth()->id())->delete();
                }

                DB::commit();

                Mail::to(auth()->user()->email)->queue(new OrderConfirmationMail($order));

                return redirect()->route('success')->with('success', 'Order placed successfully with Cash On Delivery.');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order placing failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while placing your order. Please try again.')->withInput();
        }
    }
}
