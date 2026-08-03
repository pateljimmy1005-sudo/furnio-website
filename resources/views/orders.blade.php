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

        <div class="mb-3">
            <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('home') }}" class="back-btn d-inline-flex align-items-center">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
        </div>

        <div class="text-center mb-4 mt-2">
            <h1 class="section-title all-products-header fw-bold" style="margin-bottom: 2px !important;">
                My Orders
            </h1>
            <div class="d-flex justify-content-center align-items-center" style="margin-top: 2px;">
                <div class="title-line" style="width: 80px; height: 3px; background-color: var(--theme-primary, #C06B1F); border-radius: 2px;"></div>
            </div>
            <p class="orders-page-subtitle text-center mt-2 mb-0" style="font-size: 15px; color: #6B7280;">
                Track, search, and manage your recent purchase history.
            </p>
        </div>

        <!-- Simple Search Bar -->
        <div class="orders-search-box mb-4">
            <form action="{{ route('orders') }}" method="GET">
                <div class="input-group shadow-sm" style="border-radius: 10px;">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control orders-search-input" placeholder="Search Order ID (#123), Product, Invoice, Name, Phone, Payment ID...">
                    <button type="submit" class="btn orders-search-btn">
                        <i class="fa-solid fa-magnifying-glass me-1"></i> Search
                    </button>
                    @if(request()->filled('search'))
                        <a href="{{ route('orders') }}" class="btn btn-outline-secondary d-flex align-items-center justify-content-center px-3" style="border-radius: 0 10px 10px 0; border-left: none;" title="Clear Search">
                            <i class="fa-solid fa-xmark"></i>
                        </a>
                    @endif
                </div>

                @if(request()->filled('search'))
                    <div class="mt-2 text-center text-muted small">
                        Showing <span class="fw-bold text-dark">{{ $totalMatching ?? $orders->total() }}</span> matching {{ Str::plural('order', $totalMatching ?? $orders->total()) }} for "<span class="fw-bold text-dark">{{ request('search') }}</span>"
                        · <a href="{{ route('orders') }}" class="text-decoration-none fw-bold" style="color: #C06B1F;">Clear Search</a>
                    </div>
                @endif
            </form>
        </div>

        @if($orders->isEmpty())
            @if(request()->filled('search'))
                <div class="orders-empty-card text-center p-5 bg-white rounded-4 border shadow-sm">
                    <div class="orders-empty-icon mb-3 fs-1 text-muted">🔍</div>
                    <h3 class="fw-bold text-dark mb-2">No Matching Orders Found</h3>
                    <p class="text-secondary mb-4">We couldn't find any orders matching "<span class="fw-bold">{{ request('search') }}</span>". Check for typos or try searching with a different term.</p>
                    <a href="{{ route('orders') }}" class="btn btn-dark px-4 py-2 rounded-3 fw-bold">
                        <i class="fa-solid fa-rotate-left me-1"></i> View All Orders
                    </a>
                </div>
            @else
                <div class="orders-empty-card">
                    <div class="orders-empty-icon">📦</div>
                    <h2 class="orders-empty-title">No Orders Placed Yet</h2>
                    <p class="orders-empty-text">You have not made any purchases yet. Add some beautiful furniture to your home!</p>
                    <a href="/store" class="orders-btn-browse">Browse Shop</a>
                </div>
            @endif
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
                                            <a href="{{ route('image.detail', $item->product->id) }}" class="order-product-img-link" title="Click to view product details">
                                                <img src="{{ $item->product->imageUrl() }}" alt="{{ $item->product->catalogName() }}" class="order-product-img">
                                            </a>
                                        </div>
                                        <div class="order-item-info">
                                            <h3 class="order-product-name">
                                                <a href="{{ route('image.detail', $item->product->id) }}" class="order-product-link" title="Click to view product details">
                                                    {{ $item->product->catalogName() }}
                                                </a>
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
                                            <a href="{{ route('image.detail', $order->legacyProduct->id) }}" class="order-product-img-link" title="Click to view product details">
                                                <img src="{{ $order->legacyProduct->imageUrl() }}" alt="{{ $order->legacyProduct->catalogName() }}" class="order-product-img">
                                            </a>
                                        </div>
                                        <div class="order-item-info">
                                            <h3 class="order-product-name">
                                                <a href="{{ route('image.detail', $order->legacyProduct->id) }}" class="order-product-link" title="Click to view product details">
                                                    {{ $order->legacyProduct->catalogName() }}
                                                </a>
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

            <!-- Pagination Links -->
            <div class="d-flex justify-content-center mt-4">
                {{ $orders->links() }}
            </div>
        @endif

    </div>

</div>
</div>

@endsection