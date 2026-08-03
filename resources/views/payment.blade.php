@extends('layouts.app')

@section('content')
<div class="container py-3">
    <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('cart') }}" class="back-btn d-inline-block">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>
<div class="container py-4 d-flex justify-content-center align-items-center" style="min-height: 70vh;">
@if($isMock)
    <div class="card shadow-sm border-0 rounded-4 w-100" style="max-width: 600px;">
        <div class="card-body p-5 text-center">
            
            <!-- Sandbox Badge -->
            <div class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill mb-4" style="background: rgba(40,167,69,0.1); color: #28a745; font-weight: 600;">
                <span>🧪</span> Test Payment Mode (Simulator)
            </div>

            <h2 class="fw-bold mb-2" style="font-family: 'Playfair Display', serif; color: #1A1A1A;">
                Complete Test Payment
            </h2>
            
            <p class="text-secondary mb-4" style="font-size: 14px;">
                Click the green button below to complete a test payment. Your order will be marked as paid and an order confirmation email with the Invoice PDF will be sent automatically.
            </p>

            <!-- Order Summary Box -->
            <div class="bg-light p-4 rounded-3 text-start mb-4">
                <div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
                    <span class="text-secondary">Mock Order ID:</span>
                    <span class="font-monospace fw-bold">{{ $razorpayOrderId }}</span>
                </div>
                <div class="d-flex justify-content-between mb-3 pb-2 border-bottom">
                    <span class="text-secondary">Customer:</span>
                    <span class="fw-bold">{{ $phone }} ({{ $name }})</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <span class="fw-bold fs-5">Total Amount:</span>
                    <strong class="fs-4" style="color: #28a745;">₹{{ number_format($amount, 2) }}</strong>
                </div>
            </div>

            <!-- Simulation Actions -->
            <div class="d-flex flex-column gap-3 mb-4">
                <button id="btn-mock-success" class="btn text-white py-3 fw-bold rounded-3 fs-5 shadow-sm" style="background: #28a745; transition: 0.3s;" onmouseover="this.style.background='#218838'" onmouseout="this.style.background='#28a745'">
                    ✅ Pay ₹{{ number_format($amount, 2) }} (Test Successful Payment)
                </button>
                
                <button id="btn-mock-fail" class="btn btn-outline-danger py-2 fw-semibold rounded-3" style="transition: 0.3s;">
                    ❌ Simulate Payment Failure / Cancel
                </button>
            </div>

            <a href="{{ route('checkout') }}" class="text-decoration-none fw-bold text-muted">
                ← Return to Checkout
            </a>
        </div>
    </div>
@else
    <div class="card shadow-sm border-0 rounded-4 w-100" style="max-width: 500px;">
        <div class="card-body p-5 text-center">
            
            <div class="spinner-border mb-4" style="width: 3rem; height: 3rem; color: #C06B1F;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            
            <h2 class="fw-bold mb-3" style="font-family: 'Playfair Display', serif; color: #1A1A1A;">
                Connecting to Payment Gateway...
            </h2>
            
            <p class="text-secondary mb-4">
                Please wait while we set up a secure checkout session.
            </p>
            
            <p class="small fw-bold text-danger mb-4">
                ⚠️ Do not close this window or refresh the page.
            </p>
            
            <button id="rzp-button1" class="btn text-white py-2 px-4 fw-bold rounded-3" style="display:none; background: #C06B1F;">
                Retry Payment Modal
            </button>
        </div>
    </div>
@endif
</div>

{{-- Hidden Form for Success Signature Verification --}}
<form id="verify-form" action="{{ route('payment.verify') }}" method="POST" class="d-none">
    @csrf
    <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="hidden" name="razorpay_signature" id="razorpay_signature">
</form>

{{-- Hidden Form for Failure Tracking --}}
<form id="payment-fail-form" action="{{ route('payment.fail') }}" method="POST" class="d-none">
    @csrf
    <input type="hidden" name="razorpay_order_id" id="fail-order-id">
    <input type="hidden" name="error[description]" id="fail-desc">
    <input type="hidden" name="error[code]" id="fail-code">
</form>

{{-- Razorpay Checkout script --}}
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        @if($isMock)
            document.getElementById('btn-mock-success').addEventListener('click', function() {
                var mockPaymentId = 'pay_mock_' + Math.random().toString(36).substr(2, 9);
                var mockSignature = 'sig_mock_' + Math.random().toString(36).substr(2, 16);
                
                document.getElementById('razorpay_payment_id').value = mockPaymentId;
                document.getElementById('razorpay_order_id').value = "{{ $razorpayOrderId }}";
                document.getElementById('razorpay_signature').value = mockSignature;
                
                document.getElementById('verify-form').submit();
            });

            document.getElementById('btn-mock-fail').addEventListener('click', function() {
                document.getElementById('fail-order-id').value = "{{ $razorpayOrderId }}";
                document.getElementById('fail-desc').value = "Simulated payment cancellation by sandbox developer.";
                document.getElementById('fail-code').value = "MOCK_CANCELLED";
                
                document.getElementById('payment-fail-form').submit();
            });
        @else
            var options = {
                "key": "{{ config('services.razorpay.key') }}",
                "amount": "{{ $amount * 100 }}", // Amount in paise
                "currency": "INR",
                "name": "Furnio Store",
                "description": "Secure Payment for Order Group",
                "order_id": "{{ $razorpayOrderId }}",
                "handler": function (response) {
                    // Set signature fields
                    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                    document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
                    document.getElementById('razorpay_signature').value = response.razorpay_signature;
                    // Submit form to server for validation
                    document.getElementById('verify-form').submit();
                },
                "prefill": {
                    "name": "{{ $name }}",
                    "email": "{{ $email }}",
                    "contact": "{{ $phone }}"
                },
                "theme": {
                    "color": "#C06B1F"
                },
                "modal": {
                    "ondismiss": function () {
                        // Send to failure endpoint if they cancel
                        document.getElementById('fail-order-id').value = "{{ $razorpayOrderId }}";
                        document.getElementById('fail-desc').value = "Payment cancelled by the user.";
                        document.getElementById('fail-code').value = "MODAL_CLOSED";
                        document.getElementById('payment-fail-form').submit();
                    }
                }
            };

            var rzp1 = new Razorpay(options);

            rzp1.on('payment.failed', function (response) {
                document.getElementById('fail-order-id').value = "{{ $razorpayOrderId }}";
                document.getElementById('fail-desc').value = response.error.description;
                document.getElementById('fail-code').value = response.error.code;
                document.getElementById('payment-fail-form').submit();
            });

            // Auto open Razorpay Modal
            rzp1.open();

            // Fallback button if popup is blocked
            var retryBtn = document.getElementById('rzp-button1');
            retryBtn.style.display = 'inline-block';
            retryBtn.onclick = function (e) {
                rzp1.open();
                e.preventDefault();
            };
        @endif
    });
</script>
@endsection
