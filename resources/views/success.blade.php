@extends('layouts.app')

@section('content')

<div class="success-page">

    <div class="success-card">

        <div class="success-icon">
            ✓
        </div>

        <h1>
            Order Placed Successfully
        </h1>

        <p>
            Thank you for shopping with us.
            Your order has been placed successfully.
        </p>

        <div class="success-buttons">

            <a href="{{ route('orders') }}"
               class="order-btn">

                View My Orders

            </a>

            <a href="/"
               class="shop-btn">

                Continue Shopping

            </a>

        </div>

    </div>

</div>

@endsection