@extends('layouts.app')

@section('content')

@if(session('success'))
    <div id="successMsg" class="success-msg">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(function () {
            let msg = document.getElementById('successMsg');
            if (msg) {
                msg.classList.add('fade-out');
                setTimeout(() => msg.remove(), 500);
            }
        }, 3000);
    </script>
@endif

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
            <a href="{{ route('image.detail', $product->id) }}">

                <img src="{{ $product->imageUrl() }}" class="card-img">

            </a>

            <!-- Product Name -->
            <h3>{{ $product->catalogName() }}</h3>

            <!-- Product Price -->
            <p class="price-tag">
                ₹{{ number_format($product->catalogPrice()) }}
            </p>

            <!-- View Details Button -->
            <a href="{{ route('image.detail', $product->id) }}" class="btn-primary btn-view-details">
                View Details
            </a>

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