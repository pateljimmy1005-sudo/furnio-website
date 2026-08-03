<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function orders(Request $request)
    {
        $query = Order::with(['items.product.featuredImage', 'legacyProduct.featuredImage'])
            ->where('user_id', auth()->id());

        // Multi-attribute Search (Order ID, Invoice Number, Product Name, Customer Name, Phone Number, Payment ID)
        if ($request->filled('search')) {
            $searchTerm = trim($request->search);
            $digitsOnly = preg_replace('/[^0-9]/', '', $searchTerm);

            $query->where(function ($q) use ($searchTerm, $digitsOnly) {
                // Numeric Order ID / Invoice ID
                if ($digitsOnly !== '') {
                    $q->orWhere('id', (int) $digitsOnly);
                }

                // Customer Name / Shipping Name & Mobile Phone
                $q->orWhere('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('phone', 'LIKE', "%{$searchTerm}%");

                // Razorpay Payment ID & Order ID
                $q->orWhere('razorpay_payment_id', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('razorpay_order_id', 'LIKE', "%{$searchTerm}%");

                // Product Name (Partial Case-Insensitive Match)
                $q->orWhereHas('items.product', function ($pq) use ($searchTerm) {
                    $pq->where('name', 'LIKE', "%{$searchTerm}%");
                })->orWhereHas('legacyProduct', function ($pq) use ($searchTerm) {
                    $pq->where('name', 'LIKE', "%{$searchTerm}%");
                });
            });
        }

        $totalMatching = (clone $query)->count();
        $orders = $query->latest()->paginate(10)->appends($request->query());

        return view('orders', compact('orders', 'totalMatching'));
    }

    public function cancelOrder($id)
    {
        $order = Order::with('items')->where('user_id', auth()->id())->findOrFail($id);

        if ($order->status === \App\Enums\OrderStatus::DELIVERED) {
            return back()->with('error', 'Delivered orders cannot be cancelled.');
        }

        if ($order->status === \App\Enums\OrderStatus::CANCELLED) {
            return back()->with('info', 'Order is already cancelled.');
        }

        $order->status = \App\Enums\OrderStatus::CANCELLED;
        $order->save();

        foreach ($order->items as $item) {
            $product = \App\Models\Product::find($item->product_id);
            if ($product) {
                $product->increment('stock', $item->quantity);
            }
        }

        return back()->with('success', 'Order cancelled successfully.');
    }
}

