@extends('layouts.app')

@section('content')

@php

    $grandTotal = 0;
    $shipping = 99;
    $cartItems = $cart ?? collect();

@endphp



<div class="cart-page">

    <style>
        .cart-page .cart-card .cart-image img.cart-responsive-img {
            width: 150px !important;
            height: 150px !important;
            object-fit: cover !important;
            border-radius: 10px !important;
        }
        @media (min-width: 768px) {
            .cart-page .cart-card .cart-image img.cart-responsive-img {
                width: 100px !important;
                height: 100px !important;
            }
        }
    </style>

    <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('home') }}" class="back-btn" style="display: inline-block; margin-bottom: 25px;">
        <i class="bi bi-arrow-left"></i> Back
    </a>

    <div class="cart-title" style="margin-bottom: 40px;">

        <h2 class="fs-3">My Shopping Cart</h2>

    </div>



    {{-- EMPTY CART --}}
    @if($cartItems->isEmpty())

        <div class="empty-cart">

            <h2>Your Cart Is Empty</h2>

            <p>Add your favourite furniture products</p>

            <a href="/" class="shop-btn">
                Continue Shopping
            </a>

        </div>

    @else



    <div class="cart-wrapper">



        {{-- LEFT SIDE --}}
        <div class="cart-left">

            @foreach($cartItems as $item)

                @php

                    // ORIGINAL PRICE
                    $price = $item->product->catalogPrice();

                    // DISCOUNT %
                    $discount = $item->product->catalogDiscount();

                    // DISCOUNT AMOUNT
                    $discountAmount = ($price * $discount) / 100;

                    // FINAL PRICE
                    $finalPrice = $price - $discountAmount;

                    // SUBTOTAL
                    $subtotal = $finalPrice * $item->quantity;

                    // GRAND TOTAL
                    $grandTotal += $subtotal;

                @endphp



                <div class="cart-card">

                    {{-- PRODUCT IMAGE --}}
                    <div class="cart-image mb-3 text-center">
                        <img src="{{ $item->product->imageUrl() }}"
                             alt="{{ $item->product->catalogName() }}"
                             class="cart-responsive-img">
                    </div>




                    {{-- PRODUCT DETAILS --}}
                    <div class="cart-details">

                        <h3 style="font-size: 18px;">

                            {{ $item->product->catalogName() }}

                        </h3>



                        {{-- RATING --}}
                        <div class="rating">
                            @php
                                $avgR = optional($item->product)->reviews ? $item->product->reviews->avg('rating') : 0;
                                $roundR = round($avgR);
                            @endphp
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $roundR)★@else☆@endif
                            @endfor
                        </div>




                        {{-- PRICE BOX --}}
                        <div class="price-box d-flex flex-column flex-md-row justify-content-center align-items-center gap-1 gap-md-2 mb-2">
                            {{-- FINAL PRICE --}}
                            <h4 style="font-size: 18px !important; margin: 0;">
                                ₹{{ number_format($finalPrice, 2) }}
                            </h4>

                            {{-- ORIGINAL PRICE & DISCOUNT --}}
                            @if($discount > 0)
                                <div class="d-flex align-items-center gap-2">
                                    <del>
                                        ₹{{ number_format($price, 2) }}
                                    </del>
                                    <span>
                                        {{ $discount }}% OFF
                                    </span>
                                </div>
                            @endif
                        </div>




                        {{-- QUANTITY --}}
                        <p>

                            Qty:
                            <strong>

                                {{ $item->quantity }}

                            </strong>

                        </p>




                        {{-- SUBTOTAL --}}
                        <p class="mb-3">
                            Subtotal:
                            <strong>
                                ₹{{ number_format($subtotal, 2) }}
                            </strong>
                        </p>





                        {{-- BUTTONS --}}
                        <div class="cart-buttons d-flex flex-column flex-md-row gap-2 w-100 mt-2">
                            <a href="{{ route('image.detail', $item->product->id) }}" class="w-100 text-center" style="display: flex; justify-content: center; align-items: center;">
                                View
                            </a>
                            <a href="{{ route('cart.remove', $item->id) }}" class="w-100 text-center" style="display: flex; justify-content: center; align-items: center;">
                                Remove
                            </a>
                        </div>

                    </div>

                </div>

            @endforeach

        </div>





        {{-- RIGHT SIDE --}}
        <div class="cart-right">

            <h3 style="font-size: 18px; margin-bottom: 20px;">

                PRICE DETAILS

            </h3>




            {{-- PRODUCT TOTAL --}}
            <div>

                <span>

                    Product Total

                </span>

                <span>

                    ₹{{ number_format($grandTotal, 2) }}

                </span>

            </div>




            {{-- SHIPPING --}}
            <div>

                <span>

                    Shipping

                </span>

                <span>

                    ₹{{ number_format($shipping, 2) }}

                </span>

            </div>




            <hr>




            {{-- FINAL TOTAL --}}
            <div>

                <strong style="font-size: 18px;">

                    Total Amount

                </strong>

                <strong style="font-size: 18px;">

                    ₹{{ number_format($grandTotal + $shipping, 2) }}

                </strong>

            </div>




            {{-- SAVE TEXT --}}
            <p class="save-text">

                You will save more on this order

            </p>




            {{-- PLACE ORDER BUTTON --}}
            <a href="{{ route('checkout') }}"
               class="checkout-btn">

                PLACE ORDER

            </a>

        </div>

    </div>

    @endif

</div>

@endsection