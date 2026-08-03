<!DOCTYPE html>
<html>
<head>
    <title>Furnio Shop</title>
    <link href="{{ asset('css/style.css?v=' . time()) }}" rel="stylesheet">
</head>

<body>

<div class="container mt-4">

    <h2>Our Products 🛒</h2>

    <div class="row mt-3">

        @foreach($products as $product)

        <div class="col-md-3 mb-4">

            <div class="card {{ $product->catalogStock() <= 0 ? 'product-card-out-of-stock' : '' }}">
                <div class="position-relative overflow-hidden">
                    @if($product->catalogStock() <= 0)
                        <div class="out-of-stock-badge-tag">
                            <i class="fa-solid fa-ban"></i> Out of Stock
                        </div>
                    @endif
                    <img src="{{ $product->imageUrl() }}" class="card-img-top {{ $product->catalogStock() <= 0 ? 'out-of-stock-img-dim' : '' }}">
                </div>

                <div class="card-body">

                    <h5>{{ $product->catalogName() }}</h5>

                    <p class="fw-bold">₹{{ number_format($product->catalogPrice()) }}</p>
                    
                    @if($product->catalogStock() > 0)
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="shop-form-inline">
                            @csrf
                            <button type="submit" class="shop-add-cart-btn">
                                Add To Cart
                            </button>
                        </form>
                    @else
                        <button type="button" class="btn-out-of-stock-disabled btn-sm py-2" disabled>
                            <i class="fa-solid fa-ban"></i> Out of Stock
                        </button>
                    @endif
 
                </div>

            </div>

        </div>

        @endforeach

    </div>

</div>
  

<form method="POST"
      action="{{ route('logout') }}">

    @csrf

    <button class="btn btn-danger btn-sm">
        Logout
    </button>

</form>
</body>
</html>