@extends('layouts.app')

@section('content')

<!-- HERO SECTION -->
<section class="contact-hero">
    <div class="overlay"></div>
    <div class="hero-content">
        <h1>Contact <span style="font-size: inherit !important;">FURNIO</span></h1>
        <p>We would love to hear from you. Get in touch with us!</p>
    </div>
</section> 

<section class="contact-section">
    <div class="container">
        <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('home') }}" class="back-btn mb-4 d-inline-block">
            <i class="bi bi-arrow-left"></i> Back
        </a>
        <div class="contact-grid">
            <div class="contact-info">
                <h2>Get In Touch</h2>
                <div class="info-box mt-4">
                    <div class="d-flex align-items-start mb-4">
                        <i class="bi bi-geo-alt-fill fs-4 me-3" style="color: #C06B1F;"></i>
                        <div>
                            <h5 class="fw-bold mb-1" style="font-family: 'Poppins', sans-serif;">Address</h5>
                            <p class="mb-0 text-secondary" style="font-size: 17px;">123 Luxury Street, Design District, Mumbai, India</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-start mb-4">
                        <i class="bi bi-telephone-fill fs-4 me-3" style="color: #C06B1F;"></i>
                        <div>
                            <h5 class="fw-bold mb-1" style="font-family: 'Poppins', sans-serif;">Phone</h5>
                            <p class="mb-0 text-secondary" style="font-size: 17px;">+91 90993 23456</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-start mb-4">
                        <i class="bi bi-envelope-fill fs-4 me-3" style="color: #C06B1F;"></i>
                        <div>
                            <h5 class="fw-bold mb-1" style="font-family: 'Poppins', sans-serif;">Email</h5>
                            <p class="mb-0 text-secondary" style="font-size: 17px;">furnio@gmail.com</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-start mb-4">
                        <i class="bi bi-clock-fill fs-4 me-3" style="color: #C06B1F;"></i>
                        <div>
                            <h5 class="fw-bold mb-1" style="font-family: 'Poppins', sans-serif;">Working Hours</h5>
                            <p class="mb-0 text-secondary" style="font-size: 17px;">Mon - Sat: 9:00 AM - 7:00 PM</p>
                        </div>
                    </div>
                    
                    <div class="social-icons mt-3 mt-md-5">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                    </div>
                </div>
            </div>

            <div class="contact-form">
                <h2 class="mb-4">Send Message</h2>
                
@if(session('success'))
    <div id="contactSuccessMessage" class="contact-alert-success">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(function () {
            let msg = document.getElementById('contactSuccessMessage');
            if (msg) {
                msg.classList.add('fade-out');
                setTimeout(() => msg.remove(), 500);
            }
        }, 3000); // 3 seconds
    </script>
@endif

                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <input type="text" name="name" placeholder="Your Name" required>
                    <input type="email" name="email" placeholder="Your Email" required>
                    <input type="text" name="phone" placeholder="Your Phone Number">
                    <input type="text" name="subject" placeholder="Subject">
                    <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
                    <button type="submit" class="contact-submit-btn">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>


<section class="map-section">
    <div class="container">
        <h2 class="contact-store-title mb-4">Find Our Store</h2>
        
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3770.7984803730303!2d72.83359637502422!3d19.073653682133276!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c91130722deb%3A0xc4061a5b8a6ca107!2sBandra%20West%2C%20Mumbai%2C%20Maharashtra!5e0!3m2!1sen!2sin!4v1716999999999!5m2!1sen!2sin" 
                width="100%" height="450" class="contact-map-iframe" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>

@endsection                    