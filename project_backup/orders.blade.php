@extends('layouts.app')

@section('content')

<div class="checkout-page">

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))

        <div class="success-message">

            {{ session('success') }}

        </div>

    @endif




    {{-- BREADCRUMB --}}
    <div class="breadcrumb">

        <a href="/">Home</a>

        <span>/</span>

        <span>Checkout</span>

    </div>




    {{-- PAGE HEADER --}}
    <div class="checkout-header">

        <h1>

            Secure Checkout

        </h1>

        <p>

            Complete your order by filling the details below

        </p>

    </div>




    @if($orders->count() > 0)

        @foreach($orders as $order)

            @if($order->status == 'pending')



            @php

                // ORIGINAL PRICE
                $originalPrice = $order->product->price;

                // DISCOUNT %
                $discount = $order->product->discount ?? 0;

                // DISCOUNT AMOUNT
                $discountAmount = ($originalPrice * $discount) / 100;

                // FINAL PRICE
                $finalPrice = $originalPrice - $discountAmount;

                // SHIPPING
                $shipping = 99;

                // TOTAL
                $totalAmount = ($finalPrice * $order->quantity) + $shipping;

            @endphp




            <div class="checkout-container">




                {{-- LEFT SIDE --}}
                <div class="checkout-form-section">

                    <div class="checkout-card">

                        <h2>

                            Delivery Information

                        </h2>




                        <form action="{{ route('order.place') }}"
                              method="POST"
                              class="checkout-form">

                            @csrf



                            <input type="hidden"
                                   name="product_id"
                                   value="{{ $order->product->id }}">




                            {{-- NAME --}}
                            <div class="form-group">

                                <label>

                                    Full Name

                                </label>

                                <input type="text"
                                       name="name"
                                       placeholder="Enter your full name"
                                       required>

                            </div>




                            {{-- MOBILE --}}
                            <div class="form-group">

                                <label>

                                    Mobile Number

                                </label>

                                <input type="text"
                                       name="mobile"
                                       placeholder="Enter your mobile number"
                                       required>

                            </div>




                            {{-- ADDRESS --}}
                            <div class="form-group">

                                <label>

                                    Delivery Address

                                </label>

                                <textarea name="address"
                                          placeholder="Enter your full delivery address"
                                          required></textarea>

                            </div>




                            {{-- PAYMENT --}}
                            <div class="payment-section">

                                <h3>

                                    Select Payment Method

                                </h3>




                                <label class="payment-option">

                                    <input type="radio"
                                           name="payment_method"
                                           value="cod"
                                           checked>

                                    <div class="payment-box">

                                        <h4>

                                            Cash On Delivery

                                        </h4>

                                        <p>

                                            Pay after product delivery

                                        </p>

                                    </div>

                                </label>




                                <label class="payment-option">

                                    <input type="radio"
                                           name="payment_method"
                                           value="online">

                                    <div class="payment-box">

                                        <h4>

                                            Online Payment

                                        </h4>

                                        <p>

                                            Secure online payment gateway

                                        </p>

                                    </div>

                                </label>

                            </div>




                            {{-- PLACE ORDER BUTTON --}}
                            <button type="submit"
                                    class="place-order-btn">

                                Place Order

                            </button>

                        </form>

                    </div>

                </div>





                {{-- RIGHT SIDE --}}
                <div class="checkout-summary-section">

                    <div class="summary-card">

                        <h2>

                            Order Summary

                        </h2>




                        {{-- PRODUCT --}}
                        <div class="summary-product">

                            <img src="{{ asset('images/'.$order->product->image) }}"
                                 alt="{{ $order->product->name }}">




                            <div class="summary-product-info">

                                <h3>

                                    {{ $order->product->name }}

                                </h3>




                                {{-- FINAL PRICE --}}
                                <p>

                                    ₹{{ number_format($finalPrice, 2) }}

                                </p>




                                {{-- QUANTITY --}}
                                <span>

                                    Quantity :
                                    {{ $order->quantity }}

                                </span>

                            </div>

                        </div>





                        {{-- PRICE DETAILS --}}
                        <div class="price-details">




                            {{-- PRODUCT PRICE --}}
                            <div class="price-row">

                                <span>

                                    Product Price

                                </span>

                                <span>

                                    ₹{{ number_format($finalPrice * $order->quantity, 2) }}

                                </span>

                            </div>




                            {{-- SHIPPING --}}
                            <div class="price-row">

                                <span>

                                    Shipping Charge

                                </span>

                                <span>

                                    ₹{{ number_format($shipping, 2) }}

                                </span>

                            </div>




                            {{-- DISCOUNT --}}
                            @if($discount > 0)

                            <div class="price-row discount-row">

                                <span>

                                    Discount

                                </span>

                                <span>

                                    -₹{{ number_format($discountAmount * $order->quantity, 2) }}

                                </span>

                            </div>

                            @endif

                        </div>





                        {{-- TOTAL --}}
                        <div class="grand-total">

                            <span>

                                Total Amount

                            </span>

                            <strong>

                                ₹{{ number_format($totalAmount, 2) }}

                            </strong>

                        </div>





                        {{-- FEATURES --}}
                        <div class="checkout-features">

                            <div class="feature-box">

                                <h4>

                                    Secure Payment

                                </h4>

                                <p>

                                    100% protected payment

                                </p>

                            </div>




                            <div class="feature-box">

                                <h4>

                                    Easy Returns

                                </h4>

                                <p>

                                    7 days easy return policy

                                </p>

                            </div>




                            <div class="feature-box">

                                <h4>

                                    Fast Delivery

                                </h4>

                                <p>

                                    Delivery within 3-5 days

                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            @endif

        @endforeach

    @else




    {{-- EMPTY STATE --}}
    <div class="empty-checkout">

        <h2>

            No Orders Available

        </h2>

        <p>

            You have not added any products yet

        </p>

        <a href="/"
           class="continue-shopping-btn">

            Continue Shopping

        </a>

    </div>

    @endif

</div>

@endsection