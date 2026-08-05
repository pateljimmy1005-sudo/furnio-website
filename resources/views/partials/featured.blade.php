@php
    $featuredProducts = \App\Models\Product::where('is_active', true)->latest()->take(4)->get();
@endphp

<section class="featured-products container container py-5">
    
    <div class="text-center mb-5">
        <h2 class="fw-bold mb-2">Featured Products</h2>
        <div class="d-flex justify-content-center align-items-center">
            <div class="title-line"></div>
            <div class="title-diamond"></div>
            <div class="title-line"></div>
        </div>
    </div>

    <div class="row g-4">
        @foreach($featuredProducts as $product)
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden home-product-card {{ $product->catalogStock() <= 0 ? 'product-card-out-of-stock' : '' }}">
                <div class="position-relative bg-light home-product-img-wrapper">
                    @if($product->catalogStock() <= 0)
                        <div class="out-of-stock-badge-tag">
                            <i class="fa-solid fa-ban"></i> Out of Stock
                        </div>
                    @endif
                    @if($product->image)
                        <img src="{{ asset('images/' . $product->image) }}" onerror="this.onerror=null; this.src='{{ asset('images/sofa.jpg') }}';" class="w-100 h-100 object-fit-cover {{ $product->catalogStock() <= 0 ? 'out-of-stock-img-dim' : '' }}" alt="{{ $product->name }}">
                    @else
                        <img src="{{ asset('images/sofa.jpg') }}" class="w-100 h-100 object-fit-cover {{ $product->catalogStock() <= 0 ? 'out-of-stock-img-dim' : '' }}" alt="Placeholder">
                    @endif
                    
                    <a href="{{ route('wishlist.add', $product->id) }}" class="position-absolute top-0 end-0 m-3 bg-white rounded-circle d-flex align-items-center justify-content-center shadow-sm home-product-wishlist-btn">
                        <i class="bi bi-heart"></i>
                    </a>
                </div>
                
                <div class="card-body d-flex flex-column p-4">
                    <div class="text-warning mb-2 home-product-rating fw-bold d-flex justify-content-center align-items-center mx-auto" style="font-size: 13px;">
                        <i class="bi bi-star-fill me-1"></i>{{ number_format($product->averageRating(), 1) }}
                        <span class="text-muted fw-normal ms-1">({{ $product->reviewCount() }})</span>
                    </div>
                    
                    <h5 class="card-title fw-bold text-dark mb-1 home-product-title">{{ $product->catalogName() }}</h5>
                    
                    <div class="price-box mb-4 mt-auto">
                        <span class="fw-bold text-dark fs-5">₹{{ number_format($product->catalogPrice(), 2) }}</span>
                        <span class="text-muted ms-2 text-decoration-line-through home-product-old-price">₹{{ number_format($product->catalogPrice() + 5000, 2) }}</span>
                    </div>
                    
                    @if($product->catalogStock() > 0)
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="w-100">
                            @csrf
                            <button type="submit" class="btn w-100 rounded-pill btn-outline-dark fw-bold home-add-to-cart-btn">
                                <i class="bi bi-cart-plus me-2"></i> Add to Cart
                            </button>
                        </form>
                    @else
                        <button type="button" class="btn-out-of-stock-disabled btn-sm py-2 rounded-pill" disabled>
                            <i class="fa-solid fa-ban me-1"></i> Out of Stock
                        </button>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="text-center mt-5">
        <a href="{{ route('store') }}" class="btn btn-dark px-5 py-2 rounded-pill fw-bold">View All Products</a>
    </div>

</section>
