<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function handleRazorpay(Request $request)
    {
        $webhookSecret = config('services.razorpay.webhook_secret');
        $signature = $request->header('X-Razorpay-Signature');

        if (!$signature || !$webhookSecret) {
            return response()->json(['error' => 'Missing signature or secret'], 400);
        }

        $payload = $request->getContent();
        
        $expectedSignature = hash_hmac('sha256', $payload, $webhookSecret);

        if (!hash_equals($expectedSignature, $signature)) {
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        $data = json_decode($payload, true);

        if (isset($data['event']) && $data['event'] === 'order.paid') {
            $razorpayOrderId = $data['payload']['order']['entity']['id'];
            
            $orders = Order::where('razorpay_order_id', $razorpayOrderId)->get();
            
            foreach ($orders as $order) {
                if ($order->payment_status !== \App\Enums\PaymentStatus::PAID) {
                    $order->payment_status = \App\Enums\PaymentStatus::PAID;
                    $order->save();
                    
                    // Stock is now decremented at checkout to prevent race conditions.
                    
                    \Illuminate\Support\Facades\Mail::to($order->user->email)->queue(new \App\Mail\OrderConfirmationMail($order));
                }
            }
        }

        return response()->json(['status' => 'success']);
    }
}
