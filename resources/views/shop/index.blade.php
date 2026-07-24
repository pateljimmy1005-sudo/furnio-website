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

            <div class="card">

                <img src="{{ $product->imageUrl() }}"
                     class="card-img-top">

                <div class="card-body">

                    <h5>{{ $product->catalogName() }}</h5>

                    <p>₹{{ $product->catalogPrice() }}</p>
                    
                    <form action="{{ route('cart.add', $product->id) }}"
                              method="POST"
                                class="shop-form-inline">

                @csrf
    @if($product->stock > 0)
    <button type="submit"
            class="shop-add-cart-btn">
        Add To Cart
    </button>
    @else
    <button type="button"
            class="shop-add-cart-btn bg-secondary" disabled>
        Out of Stock
    </button>
    @endif
</form>
 
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