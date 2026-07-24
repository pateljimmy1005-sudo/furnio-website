<!DOCTYPE html>
<html>
<head>
    <title>Furnio Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-4">

    <h2>Our Products 🛒</h2>

    <div class="row mt-3">

        @foreach($products as $product)

        <div class="col-md-3 mb-4">

            <div class="card">

                <img src="{{ asset($product->image) }}"
                     class="card-img-top">

                <div class="card-body">

                    <h5>{{ $product->name }}</h5>

                    <p>₹{{ $product->price }}</p>
                    
                    <form action="{{ route('cart.add', $product->id) }}"
                              method="POST"
                                style="display:inline;">

                @csrf

    <button type="submit"
            class="btn btn-primary btn-sm">

        Add To Cart

    </button>

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