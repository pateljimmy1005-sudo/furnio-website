@extends('layouts.app')

@section('content')

<div class="checkout-page">

    <div class="container">
        
        <div class="checkout-back-link-wrapper">
            <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('cart') }}" class="back-btn">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        {{-- BREADCRUMB --}}
        <div class="breadcrumb checkout-breadcrumb">
            <a href="/" class="checkout-breadcrumb-link">Home</a>
            <span>/</span>
            <a href="/cart" class="checkout-breadcrumb-link">Cart</a>
            <span>/</span>
            <span class="checkout-breadcrumb-active">Checkout</span>
        </div>

        {{-- PAGE HEADER --}}
        <div class="checkout-header checkout-header-wrapper">
            <div class="checkout-header-text">
                <h1 class="checkout-title">
                    Secure Checkout
                </h1>
                <p class="checkout-subtitle">
                    Complete your details below to place your order.
                </p>
            </div>
        </div>

@if(session('error'))
    <div id="errorMessage" class="error-message checkout-error-alert">
        {{ session('error') }}
    </div>

    <script>
        setTimeout(function () {
            let msg = document.getElementById('errorMessage');
            if (msg) {
                msg.classList.add('fade-out');
                setTimeout(() => msg.remove(), 500);
            }
        }, 3000); // 3 seconds
    </script>
@endif

        <div class="checkout-container checkout-layout-grid">
            
            {{-- LEFT SIDE: SHIPPING & PAYMENT --}}
            <div class="checkout-form-section">
                
                <div class="checkout-card checkout-card-box">
                    
                    <h2 class="checkout-section-title">
                        Shipping Details
                    </h2>

                    <form action="{{ route('order.place') }}" method="POST" class="checkout-form">
                        @csrf
                        @if(request()->has('buy_now'))
                            <input type="hidden" name="buy_now" value="{{ request('buy_now') }}">
                        @endif

                        {{-- NAME --}}
                        <div class="mb-4">
                            <label class="form-label" for="name" style="font-weight: 600; color: var(--theme-dark);">Full Name <span class="checkout-required-star">*</span></label>
                            <input type="text" 
                                   name="name" id="name" 
                                   value="{{ old('name', $defaultAddress->name ?? auth()->user()->name) }}" 
                                   placeholder="Enter your full name" 
                                   class="form-control checkout-form-input" 
                                   required>
                            @error('name')
                                <span class="checkout-error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- MOBILE --}}
                        <div class="mb-4">
                            <label class="form-label" for="mobile" style="font-weight: 600; color: var(--theme-dark);">Mobile Number <span class="checkout-required-star">*</span></label>
                            <input type="tel" 
                                   name="mobile" id="mobile" 
                                   value="{{ old('mobile', $defaultAddress->phone ?? '') }}" 
                                   placeholder="Mobile Number" 
                                   class="form-control checkout-form-input" 
                                   required>
                            @error('mobile')
                                <span class="checkout-error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- ADDRESS --}}
                        <div class="mb-4">
                            <label class="form-label" for="address" style="font-weight: 600; color: var(--theme-dark);">Delivery Address <span class="checkout-required-star">*</span></label>
                            <textarea name="address" id="address" 
                                      rows="4"
                                      placeholder="Enter your complete delivery address with PIN code" 
                                      class="form-control checkout-form-textarea" 
                                      required style="height: 100px">{{ old('address', $defaultAddress->address ?? '') }}</textarea>
                            @error('address')
                                <span class="checkout-error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- PAYMENT --}}
                        <div class="payment-section checkout-form-group-large">
                            
                            <h3 class="checkout-payment-title">
                                Select Payment Method
                            </h3>

                            <div class="checkout-payment-options">
                                
                                {{-- COD --}}
                                <label class="payment-label checkout-payment-label">
                                    <input type="radio" 
                                           name="payment_method" 
                                           value="cod" 
                                           class="checkout-payment-radio"
                                           checked>
                                    <div>
                                        <span class="checkout-payment-name">Cash On Delivery (COD)</span>
                                        <span class="checkout-payment-desc">Pay in cash when your order is delivered to your door.</span>
                                    </div>
                                </label>

                                {{-- Razorpay --}}
                                <label class="payment-label checkout-payment-label">
                                    <input type="radio" 
                                           name="payment_method" 
                                           value="online"
                                           class="checkout-payment-radio">
                                    <div>
                                        <span class="checkout-payment-name">Online Payment (Razorpay)</span>
                                        <span class="checkout-payment-desc">Pay securely via credit card, debit card, UPI, or Net Banking.</span>
                                    </div>
                                </label>

                             </div>

                        </div>

                        {{-- SUBMIT BUTTON --}}
                        <button type="submit" 
                                class="checkout-submit-btn">
                            Confirm & Place Order
                        </button>

                    </form>

                </div>

            </div>

            {{-- RIGHT SIDE: ORDER SUMMARY --}}
            <div class="checkout-summary-section">
                
                <div class="summary-card checkout-summary-card">
                    
                    <h2 class="checkout-section-title">
                        Order Summary
                    </h2>

                    {{-- PRODUCTS LIST --}}
                    <div class="summary-products-list checkout-summary-list">
                        
                        @foreach($checkoutItems as $item)
                        
                        <div class="summary-product checkout-summary-item">
                            
                            <div class="checkout-item-image-wrapper">
                                <img src="{{ $item->product->imageUrl() }}" 
                                     alt="{{ $item->product->catalogName() }}" 
                                     class="checkout-item-image">
                            </div>

                            <div class="checkout-item-details">
                                <h3 class="checkout-item-name">
                                    {{ $item->product->catalogName() }}
                                </h3>
                                <div class="checkout-item-price-row d-flex align-items-center gap-2 mt-1">
                                    <span class="checkout-item-price">₹{{ number_format($item->subtotal, 2) }}</span>
                                    @if($item->discount > 0)
                                        <del class="checkout-item-original-price">₹{{ number_format($item->original_price * $item->quantity, 2) }}</del>
                                    @endif
                                </div>
                                <p class="checkout-item-qty mt-1 mb-0">
                                    Qty: {{ $item->quantity }}
                                </p>
                            </div>

                        </div>
                        
                        @endforeach

                    </div>

                    {{-- PRICE DETAILS --}}
                    <div class="price-details checkout-price-details">
                        
                        <div class="checkout-price-row">
                            <span>Subtotal</span>
                            <span class="checkout-price-value">₹{{ number_format($subtotal, 2) }}</span>
                        </div>

                        <div class="checkout-price-row">
                            <span>Shipping Charge</span>
                            <span class="checkout-price-value">₹{{ number_format($shipping, 2) }}</span>
                        </div>

                    </div>

                    {{-- GRAND TOTAL --}}
                    <div class="grand-total checkout-total-row">
                        <span class="checkout-total-label">Total Amount</span>
                        <strong class="checkout-total-value">₹{{ number_format($totalAmount, 2) }}</strong>
                    </div>

                    {{-- FEATURES --}}
                    <div class="checkout-features-list">
                        <div class="checkout-feature-item">
                            <span class="checkout-feature-icon-secure">🛡️</span>
                            <span class="checkout-feature-text">100% Secure Payment Guarantee</span>
                        </div>
                        <div class="checkout-feature-item">
                            <span class="checkout-feature-icon-shipping">🚚</span>
                            <span class="checkout-feature-text">Delivered within 3-5 Business Days</span>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
    document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelectorAll('.payment-label').forEach(label => {
                label.style.borderColor = '#e5e7eb';
                label.style.background = 'white';
            });
            if (this.checked) {
                const parentLabel = this.closest('.payment-label');
                parentLabel.style.borderColor = '#C06B1F';
                parentLabel.style.background = '#fff8f3';
            }
        });
    });

    const checkedRadio = document.querySelector('input[name="payment_method"]:checked');
    if (checkedRadio) {
        const parentLabel = checkedRadio.closest('.payment-label');
        parentLabel.style.borderColor = '#C06B1F';
        parentLabel.style.background = '#fff8f3';
    }
</script>

@endsection
