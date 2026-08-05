@extends('layouts.app')

@section('content')

<div class="container my-5">

    <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('home') }}" class="back-btn mb-4 d-inline-block">
        <i class="bi bi-arrow-left"></i> Back
    </a>

    <div class="text-center mb-5 mt-2">
        <h2 class="all-products-header section-title fw-bold mb-1">
            {{ ucfirst(str_replace('+', ' ', $name)) }} Products
        </h2>
        <div class="d-flex justify-content-center align-items-center mt-1">
            <div class="title-line" style="width: 80px; height: 3px; background-color: var(--theme-primary, #C06B1F); border-radius: 2px;"></div>
        </div>
    </div>

    @if($products->isEmpty())
        <div class="no-products-section">
            <i class="bi bi-inbox no-products-icon"></i>
            <h2 class="no-products-title">No Products Found</h2>
            <p class="no-products-description">
                We couldn't find any products in this category.
            </p>
            <a href="{{ route('store') }}" class="btn-primary">View All Products</a>
        </div>
    @else
        <div class="product-grid">

            @foreach($products as $img)

                @php
                    $wish = auth()->check()
                        ? \App\Models\Wishlist::where('user_id', auth()->id())
                            ->where('product_id', $img->id)
                            ->first()
                        : null;
                @endphp

                <div class="product-card">

                    <div class="wishlist-heart">

                        @auth
                            @if(!$wish)

                            <form action="{{ route('wishlist.add') }}" method="POST">
                                @csrf

                                <input type="hidden"
                                       name="product_id"
                                       value="{{ $img->id }}">

                                <button class="heart-btn">
                                    <i class="fa-regular fa-heart"></i>
                                </button>

                            </form>

                            @else

                            <form action="{{ route('wishlist.remove') }}" method="POST">
                                @csrf

                                <input type="hidden"
                                       name="product_id"
                                       value="{{ $img->id }}">

                                <button class="heart-btn">
                                    <i class="fa-solid fa-heart red-heart"></i>
                                </button>

                            </form>

                            @endif
                        @endauth

                    </div>

                    <!-- Product Image -->
                    <a href="{{ route('image.detail', $img->id) }}" class="position-relative d-block overflow-hidden rounded-3">
                        @if($img->catalogStock() <= 0)
                            <div class="out-of-stock-badge-tag">
                                <i class="fa-solid fa-ban"></i> Out of Stock
                            </div>
                        @endif
                        <img src="{{ $img->imageUrl() }}" class="card-img {{ $img->catalogStock() <= 0 ? 'out-of-stock-img-dim' : '' }}">
                    </a>

                    <h3>{{ $img->catalogName() }}</h3>

                    <div class="store-card-rating-badge justify-content-center align-items-center mx-auto">
                        <i class="fa-solid fa-star text-warning"></i> {{ number_format($img->averageRating(), 1) }}
                        <span class="text-muted fw-normal">({{ $img->reviewCount() }})</span>
                    </div>

                    <p class="price-tag">
                        ₹{{ number_format($img->catalogPrice()) }}
                    </p>

                    <!-- Button -->
                    @if($img->catalogStock() > 0)
                        <a href="{{ route('image.detail', $img->id) }}" class="btn-primary btn-view-details">
                            View Details <i class="fa-solid fa-arrow-right ms-1"></i>
                        </a>
                    @else
                        <a href="{{ route('image.detail', $img->id) }}" class="btn-out-of-stock-disabled text-decoration-none">
                            <i class="fa-solid fa-ban"></i> Out of Stock
                        </a>
                    @endif

                </div>

            @endforeach

        </div>
    @endif

</div>

@endsection