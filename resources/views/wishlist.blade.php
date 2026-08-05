@extends('layouts.app')

@section('content')

<div class="container my-5">

    <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('home') }}" class="back-btn back-link d-inline-block mb-4">
        <i class="bi bi-arrow-left"></i> Back
    </a>

    <div class="wishlist-heading mb-4">
        <h2>My Wishlist </h2>
        <p>Your saved favorite products</p>
    </div>

    @if($products->count() > 0)

    <div class="product-grid">

        @foreach($products as $product)

        <div class="product-card">

            @php
                $wish = \App\Models\Wishlist::where('user_id', auth()->id())
                    ->where('product_id', $product->id)
                    ->first();
            @endphp

            <!-- Wishlist Heart -->
            <div class="wishlist-heart">

                @if(!$wish)

                <form action="{{ route('wishlist.add') }}" method="POST">
                    @csrf

                    <input type="hidden"
                           name="product_id"
                           value="{{ $product->id }}">

                    <button class="heart-btn">
                        <i class="fa-regular fa-heart"></i>
                    </button>

                </form>

                @else

                <form action="{{ route('wishlist.remove') }}" method="POST">
                    @csrf

                    <input type="hidden"
                           name="product_id"
                           value="{{ $product->id }}">

                    <button class="heart-btn">
                        <i class="fa-solid fa-heart red-heart"></i>
                    </button>

                </form>

                @endif

            </div>

            <!-- Product Image -->
            <a href="{{ route('image.detail', $product->id) }}" class="position-relative d-block overflow-hidden rounded-3">
                @if($product->catalogStock() <= 0)
                    <div class="out-of-stock-badge-tag">
                        <i class="fa-solid fa-ban"></i> Out of Stock
                    </div>
                @endif
                <img src="{{ $product->imageUrl() }}" class="card-img {{ $product->catalogStock() <= 0 ? 'out-of-stock-img-dim' : '' }}">
            </a>

            <!-- Product Name -->
            <h3>{{ $product->catalogName() }}</h3>

            <div class="store-card-rating-badge justify-content-center align-items-center mx-auto">
                <i class="fa-solid fa-star text-warning"></i> {{ number_format($product->averageRating(), 1) }}
                <span class="text-muted fw-normal">({{ $product->reviewCount() }})</span>
            </div>

            <!-- Product Price -->
            <p class="price-tag">
                ₹{{ number_format($product->catalogPrice()) }}
            </p>

            <!-- View Details Button -->
            @if($product->catalogStock() > 0)
                <a href="{{ route('image.detail', $product->id) }}" class="btn-primary btn-view-details">
                    View Details
                </a>
            @else
                <a href="{{ route('image.detail', $product->id) }}" class="btn-out-of-stock-disabled text-decoration-none">
                    <i class="fa-solid fa-ban"></i> Out of Stock
                </a>
            @endif

        </div>

        @endforeach

    </div>

    @else

    <div class="empty-box">

        <h3>No Wishlist Products</h3>

        <p>
            Add your favorite furniture products 
        </p>

    </div>

    @endif

</div>

@endsection