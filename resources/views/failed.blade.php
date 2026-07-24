@extends('layouts.app')

@section('content')

<div class="success-page failed-page-wrapper">

    <div class="success-card failed-card">

        <div class="success-icon failed-icon">
            ✗
        </div>

        <h1 class="failed-title">
            Payment Failed
        </h1>

        <p id="errorText" class="failed-subtitle">
    {{ session('error') ?? 'We could not process your payment. Please try again or choose a different payment method.' }}
</p>

<script>
    setTimeout(function () {
        let msg = document.getElementById('errorText');
        if (msg) {
            msg.classList.add('fade-out');
            setTimeout(() => msg.remove(), 500);
        }
    }, 3000); // 3 seconds
</script>

        <div class="success-buttons failed-actions">

            <a href="{{ route('checkout') }}"
               class="order-btn failed-btn-retry">
                Try Again
            </a>

            <a href="/"
               class="shop-btn failed-btn-home">
                Go to Shop
            </a>

        </div>

    </div>

</div>

@endsection
