<style>
    .hero-responsive-badge {
        font-size: 13px !important;
        padding: 6px 14px !important;
    }
    .hero-responsive-btn {
        font-size: 14px !important;
        padding: 8px 20px !important;
    }
    .hero-subtitle-responsive {
        font-size: 14px !important;
    }
    @media (min-width: 768px) {
        .hero-responsive-badge {
            font-size: 16px !important;
            padding: 8px 20px !important;
        }
        .hero-responsive-btn {
            font-size: 16px !important;
            padding: 10px 24px !important;
        }
        .hero-subtitle-responsive {
            font-size: 18px !important;
        }
    }
</style>

<div class="hero-new home-hero-bg-img position-relative overflow-hidden">
    <!-- Overlay -->
    <div class="position-absolute w-100 h-100 top-0 start-0 home-hero-overlay"></div>
    
    <div class="container h-100 position-relative z-1">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-12 col-md-10 col-lg-8 hero-content-new home-hero-content-box">
                <span class="badge badge-orange text-white rounded-pill mb-2 mb-md-4 d-inline-block shadow-sm" style="font-size: clamp(10px, 2.5vw, 14px) !important; padding: clamp(4px, 1vw, 8px) clamp(10px, 3vw, 20px) !important;">Up to 50% OFF</span>
                
                <h1 class="fw-bold text-white mb-2 mb-md-4 lh-sm hero-title-shadow">Transform Your Home with Stylish Furniture</h1>
                <p class="text-white fs-5 mb-3 mb-md-5 mx-auto hero-subtitle-styled hero-subtitle-responsive">Modern, comfortable & affordable designs for every space.</p>
                <div>
                    <a href="{{ route('store') }}" class="btn btn-orange rounded-pill fw-bold shadow-sm btn-orange-styled hero-responsive-btn">
                        Shop Now <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
