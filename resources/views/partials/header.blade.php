@php
    $cartCount = \App\Models\Cart::where('user_id', auth()->id())->sum('quantity');
    $wishlistCount = auth()->check() ? \App\Models\Wishlist::where('user_id', auth()->id())->count() : 0;
@endphp

<!-- HEADER WRAPPER -->

<!-- TOP BAR -->
<div class="top-bar-new" style="height: auto; min-height: 40px;">
    <div class="container d-flex flex-column flex-md-row justify-content-center justify-content-md-between align-items-center gap-2 gap-md-0 py-2">
        <div class="contact-info d-flex flex-wrap justify-content-center align-items-center gap-2 gap-md-4">
            <span class="d-flex align-items-center m-0" style="font-size: clamp(11px, 2.5vw, 13px);"><i class="bi bi-telephone me-1"></i> +91 90993 23456</span>
            <span class="d-flex align-items-center m-0" style="font-size: clamp(11px, 2.5vw, 13px);"><i class="bi bi-envelope me-1"></i> furnio@gmail.com</span>
        </div>

        <div class="top-links d-flex align-items-center mt-1 mt-md-0">
            <div class="social-icons d-flex justify-content-center gap-3 m-0">
                <a href="#" style="font-size: clamp(12px, 2.5vw, 14px);"><i class="bi bi-facebook"></i></a>
                <a href="#" style="font-size: clamp(12px, 2.5vw, 14px);"><i class="bi bi-instagram"></i></a>
                <a href="#" style="font-size: clamp(12px, 2.5vw, 14px);"><i class="bi bi-twitter-x"></i></a>
            </div>
        </div>
    </div>
</div>

<!-- NAVBAR -->
<div class="navbar-new sticky-top">
    <div class="container d-flex justify-content-between align-items-center">
        
        <!-- LOGO -->
        <div class="logo-new">
            <style>
                .furnio-logo-text {
                    font-size: 22px !important;
                    font-weight: 800 !important;
                    letter-spacing: 2px !important;
                    text-decoration: none;
                    color: #1A1A1A;
                }
                @media (min-width: 768px) {
                    .furnio-logo-text {
                        font-size: 30px !important;
                    }
                }
            </style>
            <a href="/" class="furnio-logo-text">FURNI<span class="text-orange" style="font-size: inherit !important;">O</span></a>
        </div>

        <!-- MENU -->
        <ul class="menu-new d-none d-lg-flex m-0 p-0" id="navMenuNew">
            <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
            <li><a href="/about" class="{{ request()->is('about') ? 'active' : '' }}">About</a></li>
            <li class="dropdown-new">
                <a href="/store" class="{{ request()->is('store') ? 'active' : '' }}">Shop</a>
                <ul class="dropdown-menu-new">
                    <li><a href="{{ url('/category/sofa') }}">Sofas</a></li>
                    <li><a href="{{ url('/category/bed') }}">Beds</a></li>
                    <li><a href="{{ url('/category/chair') }}">Chairs</a></li>
                    <li><a href="{{ url('/category/table') }}">Tables</a></li>
                    <li><a href="{{ url('/category/wardrobe') }}">Wardrobes</a></li>
                </ul>
            </li>
            
            <li><a href="/contact" class="{{ request()->is('contact') ? 'active' : '' }}">Contact</a></li>
        </ul>

        <!-- RIGHT ICONS -->
        <div class="nav-icons-new d-flex align-items-center">
            
            <div class="search-wrapper d-none d-md-flex align-items-center me-3">
                <form action="{{ route('search') }}" method="GET" class="w-100 position-relative">
                    <input type="text" name="search" class="search-input-new" placeholder="Search for products..." required>
                    <button type="submit" class="search-btn-new"><i class="bi bi-search"></i></button>
                </form>
            </div>

            <div class="icon-group d-none d-lg-flex align-items-center gap-3">
                @auth
                    @include('layouts.navigation')
                @else
                    <a href="{{ route('login') }}" class="icon-link-new"><i class="bi bi-person"></i></a>
                @endauth

                @auth
                <a href="/wishlist" class="icon-link-new position-relative">
                    <i class="bi bi-heart"></i>
                    <span class="badge-new">{{ $wishlistCount }}</span>
                </a>

                <a href="/cart" class="icon-link-new position-relative">
                    <i class="bi bi-cart3"></i>
                    <span class="badge-new">{{ $cartCount }}</span>
                </a>
                @endauth
            </div>

            <!-- MOBILE MENU BTN -->
            <button class="btn btn-link mobile-menu-btn d-lg-none ms-3 fs-3 text-dark p-0 shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenuOffcanvas" aria-controls="mobileMenuOffcanvas">
                <i class="bi bi-list"></i>
            </button>
        </div>
    </div>
</div>

<!-- MOBILE MENU (OFFCANVAS) -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenuOffcanvas" aria-labelledby="mobileMenuOffcanvasLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title fw-bold" id="mobileMenuOffcanvasLabel">MENU</h5>
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <!-- MOBILE SEARCH -->
        <div class="p-3 border-bottom d-md-none">
            <form action="{{ route('search') }}" method="GET" class="w-100 position-relative d-flex">
                <input type="text" name="search" class="form-control shadow-none" placeholder="Search products..." style="border-radius: 6px 0 0 6px;" required>
                <button type="submit" class="btn text-white" style="background-color: var(--theme-primary, #cd7c38); border-radius: 0 6px 6px 0;"><i class="bi bi-search"></i></button>
            </form>
        </div>

        <!-- MOBILE ICONS -->
        <div class="mobile-icons-bar py-2 px-3 border-bottom d-flex justify-content-around align-items-center d-lg-none bg-light">
            @auth
                <a href="{{ route('profile.edit') }}" class="mobile-icon-link text-dark text-decoration-none d-flex flex-column align-items-center">
                    <i class="bi bi-person-circle mb-1"></i>
                    <span class="mobile-icon-label">Profile</span>
                </a>
            @else
                <a href="{{ route('login') }}" class="mobile-icon-link text-dark text-decoration-none d-flex flex-column align-items-center">
                    <i class="bi bi-person mb-1"></i>
                    <span class="mobile-icon-label">Login</span>
                </a>
            @endauth

            @auth
            <a href="/wishlist" class="mobile-icon-link text-dark text-decoration-none position-relative d-flex flex-column align-items-center">
                <i class="bi bi-heart mb-1"></i>
                <span class="mobile-icon-label">Wishlist</span>
                <span class="badge-new mobile-badge-pos">{{ $wishlistCount }}</span>
            </a>

            <a href="/cart" class="mobile-icon-link text-dark text-decoration-none position-relative d-flex flex-column align-items-center">
                <i class="bi bi-cart3 mb-1"></i>
                <span class="mobile-icon-label">Cart</span>
                <span class="badge-new mobile-badge-pos">{{ $cartCount }}</span>
            </a>
            @endauth
        </div>

        <ul class="mobile-nav-list p-0 m-0 list-unstyled">
            <li><a href="/" class="d-flex align-items-center w-100 border-bottom text-dark text-decoration-none" style="padding: 15px 20px !important; font-weight: 600; font-size: 15px; background: transparent;">Home</a></li>
            <li>
                <button class="d-flex justify-content-between align-items-center w-100 border-bottom text-dark text-decoration-none shadow-none rounded-0" type="button" onclick="toggleMobileShop()" style="padding: 15px 20px !important; border: none; background: transparent; font-weight: 600; font-size: 15px; margin: 0; text-align: left;">
                    <span style="margin: 0; padding: 0;">Shop</span> <i class="bi bi-chevron-down" id="shopMobileIcon"></i>
                </button>
                <div class="bg-light" id="shopCollapse" style="display: none;">
                    <ul class="list-unstyled m-0">
                        <li><a href="/store" class="d-block border-bottom text-dark text-decoration-none" style="padding: 12px 20px 12px 35px !important; font-weight: 500; font-size: 14px;">All Products</a></li>
                        <li><a href="{{ url('/category/sofa') }}" class="d-block border-bottom text-dark text-decoration-none" style="padding: 12px 20px 12px 35px !important; font-weight: 500; font-size: 14px;">Sofas</a></li>
                        <li><a href="{{ url('/category/bed') }}" class="d-block border-bottom text-dark text-decoration-none" style="padding: 12px 20px 12px 35px !important; font-weight: 500; font-size: 14px;">Beds</a></li>
                        <li><a href="{{ url('/category/chair') }}" class="d-block border-bottom text-dark text-decoration-none" style="padding: 12px 20px 12px 35px !important; font-weight: 500; font-size: 14px;">Chairs</a></li>
                        <li><a href="{{ url('/category/table') }}" class="d-block border-bottom text-dark text-decoration-none" style="padding: 12px 20px 12px 35px !important; font-weight: 500; font-size: 14px;">Tables</a></li>
                        <li><a href="{{ url('/category/wardrobe') }}" class="d-block border-bottom text-dark text-decoration-none" style="padding: 12px 20px 12px 35px !important; font-weight: 500; font-size: 14px;">Wardrobes</a></li>
                    </ul>
                </div>
            </li>
            <li><a href="/about" class="d-flex align-items-center w-100 border-bottom text-dark text-decoration-none" style="padding: 15px 20px !important; font-weight: 600; font-size: 15px; background: transparent;">About</a></li>
            <li><a href="/contact" class="d-flex align-items-center w-100 border-bottom text-dark text-decoration-none" style="padding: 15px 20px !important; font-weight: 600; font-size: 15px; background: transparent;">Contact</a></li>
            
            @auth
            <li><a href="/orders" class="d-flex align-items-center w-100 border-bottom text-dark text-decoration-none" style="padding: 15px 20px !important; font-weight: 600; font-size: 15px; background: transparent;">My Orders</a></li>
            @if(auth()->user()->role == 'admin')
            <li><a href="/admin/dashboard" class="d-flex align-items-center w-100 border-bottom text-dark text-decoration-none" style="padding: 15px 20px !important; font-weight: 600; font-size: 15px; background: transparent;">Admin Panel</a></li>
            @endif
            <li>
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="d-flex align-items-center w-100 border-bottom text-dark text-decoration-none text-start shadow-none rounded-0" style="padding: 15px 20px !important; border: none; background: transparent; font-weight: 600; font-size: 15px; margin: 0; text-align: left;">Logout</button>
                </form>
            </li>
            @endauth
        </ul>
    </div>
    
    <script>
        function toggleMobileShop() {
            var menu = document.getElementById('shopCollapse');
            var icon = document.getElementById('shopMobileIcon');
            if (menu.style.display === 'block') {
                menu.style.display = 'none';
                icon.classList.remove('bi-chevron-up');
                icon.classList.add('bi-chevron-down');
            } else {
                menu.style.display = 'block';
                icon.classList.remove('bi-chevron-down');
                icon.classList.add('bi-chevron-up');
            }
        }
    </script>
</div>