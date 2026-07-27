@extends('layouts.app')

@section('content')



    <!-- HERO SECTION -->
    <section class="about-hero">

        <div class="hero-overlay"></div>

        <div class="hero-content">

            <h1>About <span style="font-size: inherit !important;">FURNIO</span></h1>

            <p>{{ $about->description }}</p>

            <a href="{{ url('/store') }}" class="hero-btn">
                Explore Collection
            </a>

        </div>

    </section>


    <section class="about-section">
        <div class="container d-flex flex-column flex-lg-row align-items-center justify-content-between gap-5">
            <div class="about-left">

                <h5 style="font-size: 22px !important;">WHO WE ARE</h5>
            <h2 style="font-size: 32px !important;">{{ $about->title }}</h2>

            <p>
                We are a premium furniture brand specializing in modern and stylish furniture for homes and offices.
                With years of experience, we focus on quality, comfort, and customer satisfaction.
            </p>

        </div>

        <div class="about-right">
            <img src="{{ asset('images/'.($about->image ?? 'about1.jpg')) }}" alt="About Image" class="w-100 rounded">
        </div>
        </div>

    </section>

    <!-- COUNTER -->
    <section class="counter-section">
        <div class="container">
            <div class="counter-grid">

            <div class="counter-box">
                <h1>10K+</h1>
                <p>Happy Customers</p>
            </div>

            <div class="counter-box">
                <h1>15K+</h1>
                <p>Products Delivered</p>
            </div>

            <div class="counter-box">
                <h1>500+</h1>
                <p>5 Star Reviews</p>
            </div>

            <div class="counter-box">
                <h1>25+</h1>
                <p>Cities Served</p>
            </div>

        </div>
        </div>
    </section>

    <!-- MISSION & VISION -->
    <section class="about-mission-section">
        <div class="container">
            <div class="feature-grid">

            <div class="feature-box">
                <i class="fa-solid fa-bullseye fa-2x"></i>
                <h3>Our Mission</h3>
                <p>Premium quality furniture with comfort & affordability.</p>
            </div>

            <div class="feature-box">
                <i class="fa-solid fa-eye fa-2x"></i>
                <h3>Our Vision</h3>
                <p>Become the most trusted furniture brand in India.</p>
            </div>

        </div>
        </div>
    </section>

    <!-- SERVICES -->
    <section class="about-services-section">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="mb-2 fs-2 fw-bold">Our Services</h2>
                <div class="d-flex justify-content-center align-items-center">
                    <div class="title-line"></div>
                </div>
            </div>
        <div class="feature-grid">

            <div class="feature-box">
                <i class="fa-solid fa-ruler-combined fa-2x"></i>
                <p>Custom Furniture Design</p>
            </div>

            <div class="feature-box">
                <i class="fa-solid fa-house fa-2x"></i>
                <p>Home Interior Solutions</p>
            </div>

            <div class="feature-box">
                <i class="fa-solid fa-chair fa-2x"></i>
                <p>Office Furniture Setup</p>
            </div>

            <div class="feature-box">
                <i class="fa-solid fa-screwdriver-wrench fa-2x"></i>
                <p>Installation Service</p>
            </div>

            <div class="feature-box">
                <i class="fa-solid fa-boxes-stacked fa-2x"></i>
                <p>Bulk Order Service</p>
            </div>

        </div>
        </div>
    </section>

    <!-- PRODUCT CATEGORIES -->
    <section class="about-categories-section">
        <div class="container">
            <div class="text-center mb-4">
            <h2 class="mb-2 fs-2 fw-bold">Product Categories</h2>
            <div class="d-flex justify-content-center align-items-center">
                <div class="title-line"></div>
            </div>
        </div>

        <div class="row g-4">

            <div class="col-lg-4 col-md-6 col-12">
                <div class="feature-box h-100">
                    <i class="fa-solid fa-couch fa-2x"></i>
                    <p>Sofa & Recliners</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12">
                <div class="feature-box h-100">
                    <i class="fa-solid fa-bed fa-2x"></i>
                    <p>Beds & Bedroom Sets</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12">
                <div class="feature-box h-100">
                    <i class="fa-solid fa-utensils fa-2x"></i>
                    <p>Dining Tables</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12">
                <div class="feature-box h-100">
                    <i class="fa-solid fa-chair fa-2x"></i>
                    <p>Chairs & Seating</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12">
                <div class="feature-box h-100">
                    <i class="fa-solid fa-door-closed fa-2x"></i>
                    <p>Wardrobes & Storage</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12">
                <div class="feature-box h-100">
                    <i class="fa-solid fa-briefcase fa-2x"></i>
                    <p>Office Furniture</p>
                </div>
            </div>

        </div>
        </div>
    </section>

    <!-- WHY CHOOSE US -->
    <section class="about-why-section">
        <div class="container">
            <div class="text-center mb-4">
            <h2 class="mb-2 fs-2 fw-bold">Why Choose Us</h2>
            <div class="d-flex justify-content-center align-items-center">
                <div class="title-line"></div>
            </div>
        </div>

        <div class="row g-4">

            <div class="col-lg-4 col-md-6 col-12">
                <div class="feature-box h-100">
                    <i class="fa-solid fa-star fa-2x"></i>
                    <p>Premium Quality Materials</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12">
                <div class="feature-box h-100">
                    <i class="fa-solid fa-indian-rupee-sign fa-2x"></i>
                    <p>Affordable Pricing</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12">
                <div class="feature-box h-100">
                    <i class="fa-solid fa-palette fa-2x"></i>
                    <p>Modern & Traditional Designs</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12">
                <div class="feature-box h-100">
                    <i class="fa-solid fa-users fa-2x"></i>
                    <p>Skilled Craftsmen Team</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12">
                <div class="feature-box h-100">
                    <i class="fa-solid fa-truck fa-2x"></i>
                    <p>On-Time Delivery</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12">
                <div class="feature-box h-100">
                    <i class="fa-solid fa-headset fa-2x"></i>
                    <p>Customer Support</p>
                </div>
            </div>

        </div>
        </div>
    </section>



@endsection