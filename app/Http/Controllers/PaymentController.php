<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{

    public function verify(Request $request)
    {
        $request->validate([
            'razorpay_order_id' => 'required|string',
            'razorpay_payment_id' => 'required|string',
            'razorpay_signature' => 'required|string',
        ]);

        $razorpayKey = config('services.razorpay.key');
        $razorpaySecret = config('services.razorpay.secret');

        $isMock = empty($razorpayKey) ||
                  empty($razorpaySecret) ||
                  str_contains($razorpayKey, 'XXXX') ||
                  str_contains($razorpaySecret, 'xxxx') ||
                  str_starts_with($request->razorpay_order_id, 'order_mock_');

        try {
            if (!$isMock) {
                $api = new Api($razorpayKey, $razorpaySecret);
                $attributes = [
                    'razorpay_order_id' => $request->razorpay_order_id,
                    'razorpay_payment_id' => $request->razorpay_payment_id,
                    'razorpay_signature' => $request->razorpay_signature
                ];
                $api->utility->verifyPaymentSignature($attributes);
            }

            $orders = Order::where('razorpay_order_id', $request->razorpay_order_id)->get();

            if ($orders->isEmpty()) {
                throw new \Exception('No corresponding orders found in database for Razorpay Order ID: ' . $request->razorpay_order_id);
            }

            DB::beginTransaction();
            try {
                foreach ($orders as $order) {
                    $order->update([
                        'payment_method' => 'online',
                        'payment_status' => 'paid',
                        'status' => 'Created',
                        'razorpay_payment_id' => $request->razorpay_payment_id,
                        'razorpay_signature' => $request->razorpay_signature,
                    ]);
                    // Stock is now decremented immediately at checkout
                }

                Cart::where('user_id', $orders->first()->user_id)->delete();

                DB::commit();

                foreach ($orders as $order) {
                    \Illuminate\Support\Facades\Mail::to($orders->first()->user->email ?? auth()->user()->email)->queue(new \App\Mail\OrderConfirmationMail($order));
                }
            } catch (\Exception $ex) {
                DB::rollBack();
                throw $ex;
            }

            return redirect()->route('success')->with('success', 'Payment successful! Your order has been placed.');

        } catch (\Exception $e) {
            Log::error('Razorpay verification failed: ' . $e->getMessage());

            Order::where('razorpay_order_id', $request->razorpay_order_id)
                ->update([
                    'payment_status' => 'failed',
                ]);

            return redirect()->route('payment.failed')
                ->with('error', 'Payment verification failed: ' . $e->getMessage());
        }
    }


    public function fail(Request $request)
    {
        Log::warning('Razorpay payment failed callback received', $request->all());

        if ($request->has('razorpay_order_id')) {
            Order::where('razorpay_order_id', $request->razorpay_order_id)
                ->update([
                    'payment_status' => 'failed',
                ]);
        }

        return redirect()->route('payment.failed')
            ->with('error', $request->input('error.description', 'Payment was declined or cancelled.'));
    }
}