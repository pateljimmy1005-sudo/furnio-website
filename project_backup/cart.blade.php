@extends('layouts.app')

@section('content')

@php

    $grandTotal = 0;
    $shipping = 99;
    $cartItems = $cart ?? collect();

@endphp



<div class="cart-page">

    <div class="cart-title">

        <h2>My Shopping Cart</h2>

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
                    $price = $item->product->price;

                    // DISCOUNT %
                    $discount = $item->product->discount ?? 0;

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
                    <div class="cart-image">

                        <img src="{{ asset('images/'.$item->product->image) }}"
                             alt="{{ $item->product->name }}">

                    </div>




                    {{-- PRODUCT DETAILS --}}
                    <div class="cart-details">

                        <h3>

                            {{ $item->product->name }}

                        </h3>



                        {{-- RATING --}}
                        <div class="rating">

                            ★★★★☆

                        </div>




                        {{-- PRICE BOX --}}
                        <div class="price-box">

                            {{-- FINAL PRICE --}}
                            <h4>

                                ₹{{ number_format($finalPrice, 2) }}

                            </h4>



                            {{-- ORIGINAL PRICE --}}
                            @if($discount > 0)

                                <del>

                                    ₹{{ number_format($price, 2) }}

                                </del>



                                <span>

                                    {{ $discount }}% OFF

                                </span>

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
                        <p>

                            Subtotal:
                            <strong>

                                ₹{{ number_format($subtotal, 2) }}

                            </strong>

                        </p>





                        {{-- BUTTONS --}}
                        <div class="cart-buttons">

                            <a href="{{ route('image.detail', $item->product->id) }}">

                                View

                            </a>



                            <a href="{{ route('cart.remove', $item->id) }}">

                                Remove

                            </a>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>





        {{-- RIGHT SIDE --}}
        <div class="cart-right">

            <h3>

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

                <strong>

                    Total Amount

                </strong>

                <strong>

                    ₹{{ number_format($grandTotal + $shipping, 2) }}

                </strong>

            </div>




            {{-- SAVE TEXT --}}
            <p class="save-text">

                You will save more on this order

            </p>




            {{-- PLACE ORDER BUTTON --}}
            <a href="{{ route('orders') }}"
               class="checkout-btn">

                PLACE ORDER

            </a>

        </div>

    </div>

    @endif

</div>

@endsection