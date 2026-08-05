@extends('layouts.app')

@section('content')

<div class="container my-5">
<div class="store-container">

    <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('home') }}" class="back-btn back-link search-back-link mb-3 d-inline-block">
        <i class="bi bi-arrow-left"></i> Back
    </a>

    <div class="store-header">
        <div>
            @if($search)
                <h2>Search Results for "{{ $search }}"</h2>
            @else
                <h2>Advanced Search <span class="search-count">({{ $data->count() }} items)</span></h2>
            @endif
        </div>
    </div>

    <form action="{{ route('search') }}" method="GET" id="filter-form" class="simple-filter-bar">
        @csrf
        @if(request('search'))
            <input type="hidden" name="search" value="{{ request('search') }}">
        @endif

        <div class="filter-group">
            <select name="category" class="custom-select" onchange="this.form.submit()">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ $categoryFilter == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
        </div>

        <div class="filter-group">
            <select name="material" class="custom-select" onchange="this.form.submit()">
                <option value="">All Materials</option>
                @foreach($materials as $mat)
                    <option value="{{ $mat }}" {{ $materialFilter == $mat ? 'selected' : '' }}>{{ $mat }}</option>
                @endforeach
            </select>
        </div>

        <div class="filter-group">
            <select name="color" class="custom-select" onchange="this.form.submit()">
                <option value="">All Colors</option>
                @foreach($colors as $col)
                    <option value="{{ $col }}" {{ $colorFilter == $col ? 'selected' : '' }}>{{ $col }}</option>
                @endforeach
            </select>
        </div>

        <div class="filter-group">
            <select name="sort" class="custom-select" onchange="this.form.submit()">
                <option value="latest" {{ $sort == 'latest' ? 'selected' : '' }}>Sort: Newest First</option>
                <option value="price_asc" {{ $sort == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                <option value="price_desc" {{ $sort == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                <option value="name_asc" {{ $sort == 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
                <option value="name_desc" {{ $sort == 'name_desc' ? 'selected' : '' }}>Name: Z to A</option>
            </select>
        </div>

        <div class="filter-actions">
            <a href="{{ route('search') }}" class="btn-main">Clear Filters</a>
        </div>
    </form>

    @if($data->isEmpty())
        <div class="no-products-section">
            <i class="bi bi-inbox no-products-icon"></i>
            <h2 class="no-products-title">No Products Found</h2>
            <p class="no-products-description">
                We couldn't find any products matching your search/filters.
            </p>
            <a href="{{ route('search') }}" class="btn-main">Clear Filters</a>
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
                    <a href="{{ route('image.detail', $img->id) }}" class="position-relative d-block overflow-hidden rounded-3">
                        @if($img->catalogStock() <= 0)
                            <div class="out-of-stock-badge-tag">
                                <i class="fa-solid fa-ban"></i> Out of Stock
                            </div>
                        @endif
                        <img src="{{ $img->imageUrl() }}" class="card-img {{ $img->catalogStock() <= 0 ? 'out-of-stock-img-dim' : '' }}">
                    </a>

                    <h3>{{ $img->name }}</h3>

                    <div class="store-card-rating-badge justify-content-center align-items-center mx-auto">
                        <i class="fa-solid fa-star text-warning"></i> {{ number_format($img->averageRating(), 1) }}
                        <span class="text-muted fw-normal">({{ $img->reviewCount() }})</span>
                    </div>

                    <p class="price-tag">
                        ₹{{ number_format($img->finalPrice()) }}
                    </p>

                    <!-- Button -->
                    @if($img->catalogStock() > 0)
                        <a href="{{ route('image.detail', $img->id) }}" class="btn-primary btn-view-details">
                            View Details
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
</div>

@endsection