<section class="promo-banners container container py-5">
    <div class="row g-4">
        
        <!-- Banner 1 -->
        <div class="col-12 col-md-4">
            <div class="position-relative rounded-4 overflow-hidden shadow-sm home-promo-card home-promo-card-wrapper">
                <!-- Placeholder Image -->
                <img src="{{ asset('images/sofa.jpg') }}" alt="Mega Sale" class="w-100 h-100 object-fit-cover position-absolute">
                <div class="position-absolute w-100 h-100 top-0 start-0 home-promo-overlay-1"></div>
                
                <style>
                    .promo-title-responsive { font-size: 16px !important; }
                    .promo-text-responsive { font-size: 11px !important; }
                    @media (min-width: 768px) { 
                        .promo-title-responsive { font-size: 24px !important; }
                        .promo-text-responsive { font-size: 16px !important; }
                    }
                </style>
                <div class="position-absolute top-50 start-0 translate-middle-y p-4">
                    <h3 class="fw-bold text-dark mb-1 promo-title-responsive">Mega Sale</h3>
                    <h4 class="text-dark mb-2 promo-text-responsive">Up to 50% OFF</h4>
                    <p class="text-muted small mb-3">On selected items</p>
                    <a href="{{ route('store') }}" class="btn btn-light rounded-pill px-4 fw-bold shadow-sm home-promo-btn">Shop Now</a>
                </div>
            </div>
        </div>

        <!-- Banner 2 -->
        <div class="col-12 col-md-4">
            <div class="position-relative rounded-4 overflow-hidden shadow-sm home-promo-card home-promo-card-wrapper">
                <!-- Placeholder Image -->
                <img src="{{ asset('images/dini7.jpg') }}" alt="New Arrivals" class="w-100 h-100 object-fit-cover position-absolute">
                <div class="position-absolute w-100 h-100 top-0 start-0 home-promo-overlay-2"></div>
                
                <div class="position-absolute top-50 start-50 translate-middle text-center w-100 p-4">
                    <h3 class="fw-bold text-dark mb-2 promo-title-responsive">New Arrivals</h3>
                    <p class="text-muted small mb-3">Explore the latest furniture collection</p>
                    <a href="{{ route('store') }}" class="btn btn-light rounded-pill px-4 fw-bold shadow-sm home-promo-btn">Explore Now</a>
                </div>
            </div>
        </div>

        <!-- Banner 3 -->
        <div class="col-12 col-md-4">
            <div class="position-relative rounded-4 overflow-hidden shadow-sm home-promo-card home-promo-card-wrapper">
                <!-- Placeholder Image -->
                <img src="{{ asset('images/bad8.jpg') }}" alt="Best Deals" class="w-100 h-100 object-fit-cover position-absolute">
                <div class="position-absolute w-100 h-100 top-0 start-0 home-promo-overlay-3"></div>
                
                <div class="position-absolute top-50 start-0 translate-middle-y p-4">
                    <h3 class="fw-bold text-white mb-1 promo-title-responsive">Best Deals</h3>
                    <h4 class="text-white mb-2 promo-text-responsive">Up to 40% OFF</h4>
                    <p class="text-light small mb-3">On bedroom furniture</p>
                    <a href="{{ route('store') }}" class="btn btn-light rounded-pill px-4 fw-bold shadow-sm home-promo-btn">Shop Now</a>
                </div>
            </div>
        </div>

    </div>
</section>
