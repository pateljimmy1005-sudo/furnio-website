@extends('layouts.app')

@section('content')

<div class="orders-history-page orders-page-wrapper">

    <div class="container">
        

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

        <div class="orders-header-row">
            <div class="orders-title-wrapper">
                <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('home') }}" class="orders-back-link" style="margin-top: -30px;" onmouseover="this.style.color='#1f2937'" onmouseout="this.style.color='#6b7280'">
                    <svg class="orders-back-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back
                </a>
                <div style="text-align: center; width: 100%;">
                    <h1 class="orders-page-title">
                        My Orders
                    </h1>
                    <p class="orders-page-subtitle">
                        Track and manage your recent purchase history.
                    </p>
                </div>
            </div>
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
                                <span class="order-meta-label">Order Placed</span>
                                <span class="order-meta-val-date">{{ $order->created_at->format('d M Y') }}</span>
                            </div>
                            <div>
                                <span class="order-meta-label">Total Amount</span>
                                <span class="order-meta-val-price">₹{{ number_format(($order->total_amount ?? $order->total_price) + $order->shipping_fee, 2) }}</span>
                            </div>
                            <div>
                                <span class="order-meta-label">Ship To</span>
                                <span class="order-meta-val-ship" title="{{ $order->address }}">{{ Str::limit($order->name, 15) }}</span>
                            </div>
                        </div>
                        <div>
                            <span class="order-meta-val-id-wrapper">Order ID: <span class="order-meta-val-id">#{{ $order->id }}</span></span>
                        </div>
                    </div>

                    <div class="order-card-body">
                        
                        <div class="order-product-details" style="flex-direction: column; gap: 15px;">
                            <div class="items-list" style="display: flex; flex-direction: column; gap: 15px;">
                                @if($order->items->count() > 0)
                                    @foreach($order->items as $item)
                                    @if($item->product)
                                    <div style="display: flex; gap: 15px; align-items: center;">
                                        <div class="order-product-img-wrapper" style="flex-shrink: 0;">
                                            <img src="{{ $item->product->imageUrl() }}" alt="{{ $item->product->catalogName() }}" class="order-product-img" style="max-height: 80px; width: auto;">
                                        </div>
                                        <div>
                                            <h3 class="order-product-name fs-5" style="margin-bottom: 5px;">
                                                {{ $item->product->catalogName() }}
                                            </h3>
                                            <p class="order-product-summary" style="margin-bottom: 0;">Qty: {{ $item->quantity }} <br> Price: ₹{{ number_format($item->price, 2) }}</p>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                @elseif($order->legacyProduct)
                                    <div style="display: flex; gap: 15px; align-items: center;">
                                        <div class="order-product-img-wrapper" style="flex-shrink: 0;">
                                            <img src="{{ $order->legacyProduct->imageUrl() }}" alt="{{ $order->legacyProduct->catalogName() }}" class="order-product-img" style="max-height: 80px; width: auto;">
                                        </div>
                                        <div>
                                            <h3 class="order-product-name fs-5" style="margin-bottom: 5px;">
                                                {{ $order->legacyProduct->catalogName() }}
                                            </h3>
                                            <p class="order-product-summary" style="margin-bottom: 0;">Qty: {{ $order->quantity }} <br> Price: ₹{{ number_format($order->total_price, 2) }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div style="width: 100%;">
                                <div class="order-badges-wrapper">
                                    @if($order->status === \App\Enums\OrderStatus::CREATED)
                                        <span class="order-badge-created">Created</span>
                                    @elseif($order->status === \App\Enums\OrderStatus::DELIVERED)
                                        <span class="order-badge-delivered">Delivered</span>
                                    @else
                                        <span class="order-badge-cancelled">Cancelled</span>
                                    @endif

                                    @if($order->payment_status === \App\Enums\PaymentStatus::PAID)
                                        <span class="order-badge-paid">Paid</span>
                                    @elseif($order->payment_status === \App\Enums\PaymentStatus::FAILED)
                                        <span class="order-badge-failed">Payment Failed</span>
                                    @else
                                        <span class="order-badge-unpaid">Unpaid</span>
                                    @endif

                                    {{-- Payment method badge --}}
                                    <span class="order-badge-method">
                                        {{ $order->payment_method }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- ACTIONS --}}
                        <div class="order-actions-wrapper">
                            <a href="{{ route('invoice.show', $order->id) }}" class="order-btn-invoice">
                                <i class="bi bi-receipt-cutoff"></i> View Invoice
                            </a>


                            @if($order->status === \App\Enums\OrderStatus::CREATED)
                                <a href="{{ route('cancel.order', $order->id) }}" 
                                   onclick="return confirm('Are you sure you want to cancel this order?')"
                                   class="order-btn-cancel">
                                    <i class="bi bi-x-circle"></i> Cancel Order
                                </a>
                            @endif
                            <a href="{{ route('contact') }}" class="order-btn-help">
                                Need Help?
                            </a>
                        </div>

                    </div>

                </div>
                @endforeach
            </div>
        @endif

    </div>

</div>

@endsection