<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function orders()
    {
        $orders = Order::with(['items.product.featuredImage', 'legacyProduct.featuredImage'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();
            
        return view('orders', compact('orders'));
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

