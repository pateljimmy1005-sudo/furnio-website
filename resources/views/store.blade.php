@extends('layouts.app')

@section('content')

<div class="container my-5">

    @if($search)
        <a href="{{ route('store') }}" class="back-btn back-link ms-4 mt-4 d-inline-block">
            <i class="bi bi-arrow-left"></i> Back 
        </a>
        <h2 class="search-results-header mt-4 mb-5 text-center fs-3">
            Search Results for "{{ $search }}"
        </h2>
    @else
        <h2 class="all-products-header mt-4 mb-5 text-center fs-3">
            Our Products
        </h2>
    @endif

    @if($data->isEmpty())
        <div class="no-products-section">
            <i class="bi bi-inbox no-products-icon"></i>
            <h2 class="no-products-title">No Products Found</h2>
            <p class="no-products-description">
                We couldn't find any products matching your search.
            </p>
            <a href="{{ route('store') }}" class="btn-primary">View All Products</a>
        </div>
    @else
        <div class="product-grid">

            @foreach($data as $img)

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

                    <h3>{{ $img->name }}</h3>

                    <p class="price-tag">
                        ₹{{ number_format($img->finalPrice()) }}
                    </p>

                    <!-- Button -->
                    <a href="{{ route('image.detail', $img->id) }}"
                       class="btn-primary btn-view-details">

                        View Details

                    </a>

                </div>

            @endforeach

        </div>
    @endif

</div>

@endsection