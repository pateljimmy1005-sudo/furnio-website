@extends('layouts.app')

@section('content')

<div class="container my-5">
<div class="orders-history-page orders-page-wrapper">

    <div class="container" style="max-width: 1000px;">
        

@if(session('success'))
    <div class="orders-alert-success auto-hide-alert">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="orders-alert-error auto-hide-alert">
        {{ session('error') }}
    </div>
@endif

<script>
    setTimeout(function () {
        let alerts = document.querySelectorAll('.auto-hide-alert');
        alerts.forEach(function (msg) {
            msg.classList.add('fade-out');
            setTimeout(() => msg.remove(), 500);
        });
    }, 3000); 
</script>

        <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('home') }}" class="back-btn" style="display: inline-block; margin-bottom: 25px;">
            <i class="bi bi-arrow-left"></i> Back
        </a>

        <div class="text-center mb-5 mt-2">
            <h1 class="section-title all-products-header fw-bold" style="margin-bottom: 2px !important;">
                My Orders
            </h1>
            <div class="d-flex justify-content-center align-items-center" style="margin-top: 2px;">
                <div class="title-line" style="width: 80px; height: 3px; background-color: var(--theme-primary, #C06B1F); border-radius: 2px;"></div>
            </div>
            <p class="orders-page-subtitle text-center mt-2 mb-0" style="font-size: 15px; color: #6B7280;">
                Track and manage your recent purchase history.
            </p>
        </div>

        @if($orders->isEmpty())
            <div class="orders-empty-card">
                <div class="orders-empty-icon">📦</div>
                <h2 class="orders-empty-title">No Orders Placed Yet</h2>
                <p class="orders-empty-text">You have not made any purchases yet. Add some beautiful furniture to your home!</p>
                <a href="/store" class="orders-btn-browse">Browse Shop</a>
            </div>
        @else
            <div class="orders-list-grid">
                @foreach($orders as $order)
                <div class="order-card-box">
                    
                    <div class="order-card-header">
                        <div class="order-card-meta">
                            <div>
                                <span class="order-meta-label">ORDER PLACED</span>
                                <span class="order-meta-val-date">{{ $order->created_at->format('d M Y') }}</span>
                            </div>
                            <div>
                                <span class="order-meta-label">TOTAL AMOUNT</span>
                                <span class="order-meta-val-price">₹{{ number_format(($order->total_amount ?? $order->total_price) + $order->shipping_fee, 2) }}</span>
                            </div>
                            <div>
                                <span class="order-meta-label">SHIP TO</span>
                                <span class="order-meta-val-ship" title="{{ $order->address }}">{{ Str::limit($order->name, 20) }}</span>
                            </div>
                        </div>
                        <div>
                            <span class="order-meta-val-id-wrapper">Order ID: <span class="order-meta-val-id">#{{ $order->id }}</span></span>
                        </div>
                    </div>

                    <div class="order-card-body">
                        
                        <div class="order-product-details">
                            <div class="items-list">
                                @if($order->items->count() > 0)
                                    @foreach($order->items as $item)
                                    @if($item->product)
                                    <div class="order-item-row">
                                        <div class="order-product-img-wrapper">
                                            <img src="{{ $item->product->imageUrl() }}" alt="{{ $item->product->catalogName() }}" class="order-product-img">
                                        </div>
                                        <div class="order-item-info">
                                            <h3 class="order-product-name">
                                                {{ $item->product->catalogName() }}
                                            </h3>
                                            <p class="order-product-qty">Qty: {{ $item->quantity }}</p>
                                            <p class="order-product-price">Price: ₹{{ number_format($item->price, 2) }}</p>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                @elseif($order->legacyProduct)
                                    <div class="order-item-row">
                                        <div class="order-product-img-wrapper">
                                            <img src="{{ $order->legacyProduct->imageUrl() }}" alt="{{ $order->legacyProduct->catalogName() }}" class="order-product-img">
                                        </div>
                                        <div class="order-item-info">
                                            <h3 class="order-product-name">
                                                {{ $order->legacyProduct->catalogName() }}
                                            </h3>
                                            <p class="order-product-qty">Qty: {{ $order->quantity }}</p>
                                            <p class="order-product-price">Price: ₹{{ number_format($order->total_price, 2) }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="order-badges-wrapper">
                                @if($order->status === \App\Enums\OrderStatus::CREATED)
                                    <span class="order-badge order-badge-created">CREATED</span>
                                @elseif($order->status === \App\Enums\OrderStatus::DELIVERED)
                                    <span class="order-badge order-badge-delivered">DELIVERED</span>
                                @else
                                    <span class="order-badge order-badge-cancelled">CANCELLED</span>
                                @endif

                                @if($order->payment_status === \App\Enums\PaymentStatus::PAID)
                                    <span class="order-badge order-badge-paid">PAID</span>
                                @elseif($order->payment_status === \App\Enums\PaymentStatus::FAILED)
                                    <span class="order-badge order-badge-failed">FAILED</span>
                                @else
                                    <span class="order-badge order-badge-unpaid">UNPAID</span>
                                @endif

                                {{-- Payment method badge --}}
                                <span class="order-badge order-badge-method">
                                    {{ strtoupper($order->payment_method) }}
                                </span>
                            </div>
                        </div>

                        {{-- ACTIONS --}}
                        <div class="order-actions-wrapper">
                            <a href="{{ route('invoice.show', $order->id) }}" class="order-btn-invoice">
                                <i class="fa-solid fa-file-lines me-2"></i> View Invoice
                            </a>

                            @if($order->status === \App\Enums\OrderStatus::CREATED)
                                <a href="{{ route('cancel.order', $order->id) }}" 
                                   onclick="return confirm('Are you sure you want to cancel this order?')"
                                   class="order-btn-cancel">
                                    <i class="fa-regular fa-circle-xmark me-2"></i> Cancel Order
                                </a>
                            @endif

                            <a href="{{ route('contact') }}" class="order-btn-help">
                                <i class="fa-solid fa-headset me-2"></i> Need Help?
                            </a>
                        </div>

                    </div>

                    <div class="order-card-footer">
                        <i class="fa-solid fa-circle-question me-1"></i> Need help with your order? <a href="{{ route('contact') }}">Contact our support team.</a>
                    </div>

                </div>
                @endforeach
            </div>
        @endif

    </div>

</div>
</div>

@endsection