@extends('layouts.app')

@section('content')

<div class="container my-4">
    
    <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('home') }}" class="back-btn d-inline-block" style="margin-bottom: 25px !important;">
        <i class="bi bi-arrow-left"></i> Back
    </a>

    @php
        $originalPrice = $product->catalogPrice();
        $discount = $product->catalogDiscount();
        $discountAmount = ($originalPrice * $discount) / 100;
        $finalPrice = $originalPrice - $discountAmount;
    @endphp

    <div class="product-detail-wrapper">
        
        <!-- Image Section -->
        <div class="product-detail-image-section">
            <!-- Main Image Container -->
            <div class="detail-main-img-container position-relative mb-3">
                @if($product->catalogStock() <= 0)
                    <div class="detail-out-of-stock-overlay-badge">
                        <i class="fa-solid fa-ban me-1"></i> OUT OF STOCK
                    </div>
                @endif
                <img id="main-product-image" src="{{ $product->imageUrl() }}" class="main-product-image {{ $product->catalogStock() <= 0 ? 'out-of-stock-img-dim' : '' }}">
            </div>
            
            @if($product->images && $product->images->count() > 1)
                <div class="product-thumbnails">
                    @foreach($product->images as $thumbnail)
                        <img src="{{ $thumbnail->imageUrl() }}" 
                             class="product-thumbnail {{ $thumbnail->image === $product->image ? 'active' : '' }} {{ $product->catalogStock() <= 0 ? 'out-of-stock-img-dim' : '' }}"
                             onclick="changeMainImage(this, '{{ $thumbnail->imageUrl() }}')">
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Info Section -->
        <div class="product-info-section">
            <!-- PRODUCT NAME -->
            <h2 class="product-title">{{ $product->catalogName() }}</h2>

            @if($product->catalogStock() <= 0)
                <!-- Meesho / Flipkart Style Unavailable Banner -->
                <div class="out-of-stock-alert-banner">
                    <i class="fa-solid fa-circle-xmark alert-icon"></i>
                    <div>
                        <div class="alert-title">Currently Unavailable</div>
                        <div class="alert-desc">This item is out of stock and cannot be purchased right now. We don't know when or if this item will be back in stock.</div>
                    </div>
                </div>
            @endif

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

            <!-- STOCK STATUS -->
            <p class="details">
                <strong>Status:</strong>
                <span class="{{ $product->catalogStock() > 0 ? 'stock-status-in' : 'stock-status-out text-danger fw-bold' }}">
                    {{ $product->catalogStock() > 0 ? 'In Stock (' . $product->catalogStock() . ' available)' : 'Out of Stock' }}
                </span>
            </p>

            <!-- BUTTONS -->
            @if($product->catalogStock() > 0)
                <div class="btn-group">
                    <!-- ADD TO CART -->
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="detail-add-cart-btn">
                            <i class="fa-solid fa-cart-shopping"></i> Add to Cart
                        </button>
                    </form>

                    <!-- BUY NOW -->
                    <form action="{{ route('buy.now', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="detail-buy-now-btn">
                            <i class="fa-solid fa-bag-shopping"></i> Buy Now
                        </button>
                    </form>
                </div>
            @else
                <div class="w-100 mt-3">
                    <button type="button" class="btn-out-of-stock-disabled" disabled>
                        <i class="fa-solid fa-ban"></i> Currently Unavailable / Out of Stock
                    </button>
                </div>
            @endif
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
<div class="review-section mt-5 pt-4 border-top">

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h3 class="fw-bold m-0" style="font-family: 'Playfair Display', serif; color: #1A1A1A;">Customer Ratings & Reviews</h3>
    </div>

    <!-- Rating Breakdown Dashboard (Amazon / Flipkart Style) -->
    @php
        $avgScore = $product->averageRating();
        $totalReviews = $product->reviewCount();
        $breakdown = $product->ratingBreakdown();
        $currentSort = $sort ?? 'recent';
    @endphp

    <div class="rating-dashboard-card mb-5">
        <div class="row g-4 align-items-center">
            <!-- Left: Overall Rating Score -->
            <div class="col-lg-4 col-md-5">
                <div class="rating-overview-box">
                    <div class="rating-score-large">{{ number_format($avgScore, 1) }}</div>
                    <div class="rating-stars-gold my-2">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= round($avgScore)) ★ @else <span class="text-muted opacity-25">★</span> @endif
                        @endfor
                    </div>
                    <div class="rating-count-text text-center fw-semibold">
                        Based on {{ number_format($totalReviews) }} {{ Str::plural('review', $totalReviews) }}
                    </div>
                </div>
            </div>

            <!-- Right: 5-Star Breakdown Progress Bars -->
            <div class="col-lg-8 col-md-7">
                <div class="pe-lg-3">
                    @foreach([5, 4, 3, 2, 1] as $star)
                        @php
                            $starData = $breakdown[$star] ?? ['count' => 0, 'percentage' => 0];
                        @endphp
                        <div class="rating-bar-row">
                            <div class="rating-bar-label">
                                {{ $star }} <i class="fa-solid fa-star text-warning small"></i>
                            </div>
                            <div class="rating-progress-track">
                                <div class="rating-progress-fill" style="width: {{ $starData['percentage'] }}%;"></div>
                            </div>
                            <div class="rating-bar-count">
                                {{ $starData['percentage'] }}% ({{ $starData['count'] }})
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Review Form Section -->
    @auth
        @if(isset($hasPurchased) && $hasPurchased)
            @php
                $userReview = $product->reviews->where('user_id', auth()->id())->first();
            @endphp
            <div class="bg-light p-4 rounded-4 mb-5 border-0 shadow-sm">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="verified-buyer-badge">
                        <i class="fa-solid fa-circle-check"></i> Verified Purchaser
                    </span>
                    <h5 class="fw-bold m-0" style="color: #C06B1F;">{{ $userReview ? 'Update Your Review' : 'Write a Verified Review' }}</h5>
                </div>

                <form action="{{ route('review.store') }}" method="POST" class="review-form">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-secondary">Your Rating</label>
                            <select name="rating" class="form-select rounded-3 py-2 fw-semibold" required style="border-color: #e5e7eb; background-color: #ffffff;">
                                <option value="">Select Rating</option>
                                <option value="5" {{ $userReview && $userReview->rating == 5 ? 'selected' : '' }}>★★★★★ (5 - Excellent)</option>
                                <option value="4" {{ $userReview && $userReview->rating == 4 ? 'selected' : '' }}>★★★★☆ (4 - Very Good)</option>
                                <option value="3" {{ $userReview && $userReview->rating == 3 ? 'selected' : '' }}>★★★☆☆ (3 - Good)</option>
                                <option value="2" {{ $userReview && $userReview->rating == 2 ? 'selected' : '' }}>★★☆☆☆ (2 - Fair)</option>
                                <option value="1" {{ $userReview && $userReview->rating == 1 ? 'selected' : '' }}>★☆☆☆☆ (1 - Poor)</option>
                            </select>
                        </div>

                        <div class="col-md-8">
                            <label class="form-label fw-bold text-secondary">Review Title (Optional)</label>
                            <input type="text" name="title" value="{{ $userReview ? $userReview->title : '' }}" class="form-control rounded-3 py-2" placeholder="e.g. Excellent quality & fast delivery!" style="border-color: #e5e7eb; background-color: #ffffff;">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold text-secondary">Review Details</label>
                            <textarea name="review" rows="4" class="form-control rounded-3 p-3" placeholder="Share your experience regarding the quality, material, and comfort of this product..." style="border-color: #e5e7eb; background-color: #ffffff;">{{ $userReview ? $userReview->review : '' }}</textarea>
                        </div>
                    </div>

                    <div class="d-flex gap-3 mt-4">
                        <button type="submit" class="btn text-white px-4 py-2 fw-bold shadow-sm" style="background-color: #C06B1F; border: none; border-radius: 8px;">
                            <i class="fa-solid fa-paper-plane me-1"></i> {{ $userReview ? 'Update Review' : 'Submit Review' }}
                        </button>
                        
                        @if($userReview)
                            <button type="button" class="btn px-4 py-2 fw-bold shadow-sm" style="background-color: #dc3545; color: #ffffff; border: none; border-radius: 8px;" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete your review?')) document.getElementById('delete-review-form').submit();">
                                <i class="fa-solid fa-trash-can me-1"></i> Delete Review
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
            <div class="alert alert-info rounded-3 border-0 bg-light p-3 mb-4 d-flex align-items-center gap-3">
                <i class="fa-solid fa-shield-halved fs-4 text-primary"></i>
                <div>
                    <h6 class="fw-bold m-0 text-dark">Verified Purchase Required</h6>
                    <small class="text-secondary">Only customers who have purchased and received this product can submit a review.</small>
                </div>
            </div>
        @endif
    @else
        <div class="alert alert-warning rounded-3 border-0 p-3 mb-4 d-flex align-items-center gap-3">
            <i class="fa-solid fa-user-lock fs-4 text-warning"></i>
            <div>
                <h6 class="fw-bold m-0 text-dark">Have you purchased this item?</h6>
                <small class="text-secondary">Please <a href="{{ route('login') }}" class="fw-bold text-dark text-decoration-underline">log in</a> to write a review.</small>
            </div>
        </div>
    @endauth

    <!-- Filter & Sort Header Bar -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4 pb-2 border-bottom">
        <h5 class="fw-bold m-0">Customer Reviews ({{ $totalReviews }})</h5>

        <div class="d-flex align-items-center gap-2">
            <label class="small fw-bold text-secondary text-nowrap m-0">Sort By:</label>
            <select class="form-select form-select-sm rounded-3 shadow-sm border-secondary-subtle" style="width: auto;" onchange="window.location.href='?sort=' + this.value">
                <option value="recent" {{ $currentSort === 'recent' ? 'selected' : '' }}>Most Recent</option>
                <option value="highest" {{ $currentSort === 'highest' ? 'selected' : '' }}>Highest Rating</option>
                <option value="lowest" {{ $currentSort === 'lowest' ? 'selected' : '' }}>Lowest Rating</option>
            </select>
        </div>
    </div>

    <!-- Review Cards List -->
    @forelse($product->reviews as $review)
        <div class="review-card-item">
            <div class="d-flex justify-content-between align-items-start gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="user-avatar-circle">
                        {{ strtoupper(substr($review->user->name ?? 'C', 0, 1)) }}
                    </div>
                    <div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="fw-bold text-dark">{{ $review->user->name ?? 'Customer' }}</span>
                            @if(in_array($review->user_id, $verifiedUserIds ?? []))
                                <span class="verified-buyer-badge">
                                    <i class="fa-solid fa-circle-check"></i> Verified Purchase
                                </span>
                            @endif
                        </div>
                        <div class="rating-stars-gold small my-1">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $review->rating) ★ @else <span class="text-muted opacity-25">★</span> @endif
                            @endfor
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <small class="text-muted d-block">{{ $review->created_at->format('d M Y') }}</small>
                    @if(auth()->check() && auth()->id() === $review->user_id)
                        <span class="badge bg-secondary-subtle text-secondary border mt-1">Your Review</span>
                    @endif
                </div>
            </div>

            @if($review->title)
                <div class="review-card-title">{{ $review->title }}</div>
            @endif

            @if($review->review)
                <p class="review-card-body mt-2">{{ $review->review }}</p>
            @endif
        </div>
    @empty
        <div class="text-center py-5 px-4 bg-light rounded-4 border-0">
            <i class="fa-solid fa-comments fs-1 text-secondary opacity-50 mb-3 d-block"></i>
            <h5 class="fw-bold text-dark mb-1">No Reviews Yet</h5>
            <p class="text-muted m-0">Be the first verified customer to write a review for this product!</p>
        </div>
    @endforelse

</div>


@endsection