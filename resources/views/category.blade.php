@extends('layouts.app')

@section('content')

<div class="container my-5">

    <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('home') }}" class="back-btn mb-4 d-inline-block">
        <i class="bi bi-arrow-left"></i> Back
    </a>

    <div class="text-center mb-5 mt-2">
        <h2 class="all-products-header section-title fw-bold mb-1">
            {{ ucfirst($name) }} Products
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
                    <a href="{{ route('image.detail', $img->id) }}">
                        <img src="{{ $img->imageUrl() }}" class="card-img">
                    </a>

                    <h3>{{ $img->catalogName() }}</h3>

                    <p class="price-tag">
                        ₹{{ number_format($img->catalogPrice()) }}
                    </p>

                    <!-- Button -->
                    <a href="{{ route('image.detail', $img->id) }}" class="btn-primary btn-view-details">
                        View Details
                    </a>

                </div>

            @endforeach

        </div>
    @endif

</div>

@endsection