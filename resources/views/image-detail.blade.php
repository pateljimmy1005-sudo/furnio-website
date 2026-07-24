@extends('layouts.app')

@section('content')




@if(session('success'))
    <div id="successAlert" class="success-alert">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(function () {
            let msg = document.getElementById('successAlert');
            if (msg) {
                msg.classList.add('fade-out');
                setTimeout(() => msg.remove(), 500);
            }
        }, 3000); // 3 seconds
    </script>
@endif


<div class="furnio-container">

    <h2 class="all-products-header mt-4 mb-5 text-center fs-3">Product Details</h2>

    @php
        $originalPrice = $product->catalogPrice();
        $discount = $product->catalogDiscount();
        $discountAmount = ($originalPrice * $discount) / 100;
        $finalPrice = $originalPrice - $discountAmount;
    @endphp

    <div class="product-detail-wrapper">
        
        <!-- Image Section -->
        <div class="product-detail-image-section">
            <!-- Main Image -->
            <img id="main-product-image" src="{{ $product->imageUrl() }}" class="main-product-image">
            
            @if($product->images && $product->images->count() > 1)
                <div class="product-thumbnails">
                    @foreach($product->images as $thumbnail)
                        <img src="{{ $thumbnail->imageUrl() }}" 
                             class="product-thumbnail {{ $thumbnail->image === $product->image ? 'active' : '' }}"
                             onclick="changeMainImage(this, '{{ $thumbnail->imageUrl() }}')">
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Info Section -->

        <div class="product-info-section">
            <!-- PRODUCT NAME -->
            <h2 class="product-title">{{ $product->catalogName() }}</h2>

            <!-- RATING -->
            @php
                $avgRating = $product->reviews->avg('rating') ?? 0;
                $reviewCount = $product->reviews->count();
                $roundedRating = round($avgRating);
            @endphp
            <div class="product-rating">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= $roundedRating)★@else☆@endif
                @endfor
                <span class="review-count-text">({{ $reviewCount }} Reviews)</span>
            </div>

            <!-- PRICE SECTION -->
            @if($discount > 0)
                <div class="price-container">
                    <p class="original-price-line"><del>₹{{ number_format($originalPrice, 2) }}</del></p>
                    <p class="discount-badge">{{ $discount }}% OFF</p>
                </div>
                <h2 class="final-price fs-5 mb-0">₹{{ number_format($finalPrice, 2) }}</h2>
                <p class="savings-text">You Save ₹{{ number_format($discountAmount, 2) }}</p>
            @else
                <h2 class="price-tag fs-5 mb-0 text-muted">₹{{ number_format($originalPrice, 2) }}</h2>
            @endif

            <!-- DESCRIPTION -->
            <p class="description">{{ $product->catalogDescription() }}</p>

            <!-- MATERIAL -->
            <p class="details"><strong>Material:</strong> {{ $product->catalogMaterial() }}</p>

            <!-- STOCK -->
            <p class="details">
                <strong>Status:</strong>
                <span class="{{ $product->catalogStock() > 0 ? 'stock-status-in' : 'stock-status-out' }}">
                    {{ $product->catalogStock() > 0 ? 'In Stock' : 'Out of Stock' }}
                </span>
            </p>

            <!-- BUTTONS -->
            <div class="btn-group">
                <!-- ADD TO CART -->
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    @if($product->catalogStock() > 0)
                    <button type="submit" class="detail-add-cart-btn">
                        <i class="fa-solid fa-cart-shopping"></i> Add to Cart
                    </button>
                    @else
                    <button type="button" class="detail-add-cart-btn btn-disabled" disabled>
                        <i class="fa-solid fa-cart-shopping"></i> Out of Stock
                    </button>
                    @endif
                </form>

                <!-- BUY NOW -->
                <form action="{{ route('buy.now', $product->id) }}" method="POST">
                    @csrf
                    @if($product->catalogStock() > 0)
                    <button type="submit" class="detail-buy-now-btn">
                        <i class="fa-solid fa-bag-shopping"></i> Buy Now
                    </button>
                    @else
                    <button type="button" class="detail-buy-now-btn btn-disabled" disabled>
                        <i class="fa-solid fa-bag-shopping"></i> Out of Stock
                    </button>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function changeMainImage(element, imageUrl) {
        document.getElementById('main-product-image').src = imageUrl;
        
        let thumbnails = document.querySelectorAll('.product-thumbnail');
        thumbnails.forEach(thumb => {
            thumb.classList.remove('active');
        });
        
        element.classList.add('active');
    }
</script>
 
<!-- Product Reviews Section -->
<div class="review-section">

    <h3 class="mb-4" style="font-family: 'Playfair Display', serif; color: #1A1A1A;">Product Reviews</h3>

    @auth
        @if(isset($hasPurchased) && $hasPurchased)
            @php
                $userReview = $product->reviews->where('user_id', auth()->id())->first();
            @endphp
            <div class="bg-light p-4 rounded-4 mb-5 border-0">
                <h5 class="fw-bold mb-3" style="color: #C06B1F;">{{ $userReview ? 'Update Your Review' : 'Write a Review' }}</h5>
                <form action="{{ route('review.store') }}" method="POST" class="review-form">
                    @csrf

                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary">Rating</label>
                        <select name="rating" class="form-select rounded-2 py-2" required style="border-color: #eeeeee; background-color: #ffffff;">
                            <option value="">Select Rating</option>
                            <option value="5" {{ $userReview && $userReview->rating == 5 ? 'selected' : '' }}>★★★★★ (5 - Excellent)</option>
                            <option value="4" {{ $userReview && $userReview->rating == 4 ? 'selected' : '' }}>★★★★☆ (4 - Very Good)</option>
                            <option value="3" {{ $userReview && $userReview->rating == 3 ? 'selected' : '' }}>★★★☆☆ (3 - Good)</option>
                            <option value="2" {{ $userReview && $userReview->rating == 2 ? 'selected' : '' }}>★★☆☆☆ (2 - Fair)</option>
                            <option value="1" {{ $userReview && $userReview->rating == 1 ? 'selected' : '' }}>★☆☆☆☆ (1 - Poor)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary">Your Review</label>
                        <textarea
                            name="review"
                            rows="4"
                            class="form-control rounded-2 p-3"
                            placeholder="Share your thoughts about this product..."
                            style="border-color: #eeeeee; background-color: #ffffff;"
                        >{{ $userReview ? $userReview->review : '' }}</textarea>
                    </div>

                    <div class="d-flex gap-3 mt-4">
                        <button type="submit" class="btn text-white px-4 py-2 fw-bold" style="background-color: #C06B1F; border: none; border-radius: 8px;">
                            {{ $userReview ? 'Update Review' : 'Submit Review' }}
                        </button>
                        
                        @if($userReview)
                            <button type="button" class="btn px-4 py-2 fw-bold" style="background-color: #dc3545; color: #ffffff; border: none; border-radius: 8px;" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete your review?')) document.getElementById('delete-review-form').submit();">
                                Delete Review
                            </button>
                        @endif
                    </div>
                </form>
            </div>
            
            @if($userReview)
                <form id="delete-review-form" action="{{ route('review.user.delete', $userReview->id) }}" method="POST" class="d-none">
                    @csrf
                    @method('DELETE')
                </form>
            @endif
        @else
            <div class="alert alert-info rounded-3 border-0 bg-light text-secondary">
                <i class="bi bi-info-circle me-2"></i> You can only write a review after purchasing and receiving this product.
            </div>
        @endif
    @else
        <div class="alert alert-warning rounded-3 border-0">
            <i class="bi bi-exclamation-triangle me-2"></i> Please <a href="{{ route('login') }}" class="fw-bold text-dark text-decoration-none">login</a> to submit a review.
        </div>
    @endauth

    <h4 class="mt-5 mb-4 fw-bold" style="font-family: 'Poppins', sans-serif;">Customer Reviews</h4>

    @forelse($product->reviews as $review)
        <div class="review-box p-4 bg-light rounded-4 mb-3 border-0">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <strong class="text-dark fs-5" style="font-family: 'Playfair Display', serif;">{{ $review->user->name }}</strong>
                <small class="text-muted">{{ $review->created_at->format('d M Y') }}</small>
            </div>

            <div class="mb-3" style="color: #f39c12; font-size: 18px;">
                @for($i=1; $i<=5; $i++)
                    @if($i <= $review->rating)
                        ★
                    @else
                        <span style="color: #dddddd;">★</span>
                    @endif
                @endfor
            </div>

            @if($review->review)
                <p class="text-secondary m-0" style="line-height: 1.6;">{{ $review->review }}</p>
            @endif
        </div>
    @empty
        <div class="text-center p-5 bg-light rounded-4">
            <i class="bi bi-chat-square-dots fs-1 text-muted mb-3"></i>
            <p class="text-muted m-0 fs-5">No reviews yet. Be the first to review!</p>
        </div>
    @endforelse

</div>

@endsection