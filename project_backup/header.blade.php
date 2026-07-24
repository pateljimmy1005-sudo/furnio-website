<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">


@php

    // CART COUNT
    $cartCount = \App\Models\Cart::where('user_id', auth()->id())
                    ->sum('quantity');

    // WISHLIST COUNT
    $wishlistCount = auth()->check()
                    ? \App\Models\Wishlist::where('user_id', auth()->id())->count()
                    : 0;

@endphp


<!-- TOP BAR -->
<div class="top-bar">

    <div class="contact">

        <span>
            📧 furnio@gmail.com
        </span>

        <span>
            📱 +91 90993 23456
        </span>

    </div>


    <!-- SOCIAL ICONS -->
    <div class="social-icon">

        <a href="#">
            <i class="bi bi-facebook"></i>
        </a>

        <a href="#">
            <i class="bi bi-instagram"></i>
        </a>

        <a href="#">
            <i class="bi bi-twitter-x"></i>
        </a>

    </div>

</div>





<!-- NAVBAR -->
<div class="navbar">


    <!-- LOGO -->
    <div class="logo">

        <h2>
            <a href="/">FURNIO</a>
        </h2>

    </div>



    <!-- MENU -->
    <ul class="menu">

        <li>
            <a href="/">Home</a>
        </li>


        <!-- SHOP DROPDOWN -->
        <li class="dropdown">

            <a href="/store">Shop</a>

            <ul class="dropdown-menu">

                <li>
                    <a href="{{ url('/category/sofa') }}">
                        Sofa
                    </a>
                </li>

                <li>
                    <a href="{{ url('/category/bed') }}">
                        Bed
                    </a>
                </li>

                <li>
                    <a href="{{ url('/category/chair') }}">
                        Chair
                    </a>
                </li>

                <li>
                    <a href="{{ url('/category/table') }}">
                        Table
                    </a>
                </li>

                <li>
                    <a href="{{ url('/category/wardrobe') }}">
                        Wardrobe
                    </a>
                </li>

            </ul>

        </li>


        <li>
            <a href="/about">About</a>
        </li>

        <li>
            <a href="contact">Contact</a>
        </li>

    </ul>




    <!-- NAV ICONS -->
    <div class="nav-icons">


        <!-- SEARCH -->
        <div class="search-box1">

            <i class="bi bi-search icon-btn"
               onclick="toggleSearch()"></i>


            <form action="/search"
                  method="GET"
                  class="search-form"
                  id="searchForm">

                <input type="text"
                       name="query"
                       placeholder="Search products...">

            </form>

        </div>




<!-- LOGIN / LOGOUT -->

@auth

    <form method="POST"
          action="{{ route('logout') }}"
          style="display:inline;">

        @csrf

        <button type="submit"
                class="icon-btn"
                style="border:none; background:none;">

            <i class="bi bi-box-arrow-right"></i>

        </button>

    </form>

@else

    <a href="{{ route('login') }}"
       class="icon-btn">

        <i class="bi bi-person-circle"></i>

    </a>

@endauth


        <!-- CART -->
        <a href="/cart"
           class="icon-btn cart"
           style="position:relative;">

            <span class="badge">

                {{ $cartCount }}

            </span>

            <i class="bi bi-cart2"></i>

        </a>




        <!-- WISHLIST -->
        <a href="/wishlist"
           class="icon-btn"
           style="position:relative;">

            <span class="badge">

                {{ $wishlistCount }}

            </span>

            <i class="bi bi-heart"></i>

        </a>

    </div>

</div>


<script>

    function toggleSearch()
    {
        let form = document.getElementById("searchForm");

        form.classList.toggle("active");
    }

</script>