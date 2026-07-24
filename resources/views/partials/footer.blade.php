<footer class="footer-new home-footer-bg pt-5 pb-3">
    <div class="container">
        <div class="row g-4 mb-5">
            
            <!-- Column 1: About -->
            <div class="col-12 col-md-6 col-lg-3">
                <h3 class="fw-bold mb-3 home-footer-logo">FURNI<span class="text-orange" style="font-size: inherit !important;">O</span></h3>
                <p class="text-white-50 mb-4 lh-18">We provide modern and stylish furniture for your home and office. Quality and comfort is our priority.</p>
                <div class="d-flex gap-3">
                    <a href="#" class="text-white bg-dark rounded-circle d-flex align-items-center justify-content-center border border-secondary home-footer-social-btn"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white bg-dark rounded-circle d-flex align-items-center justify-content-center border border-secondary home-footer-social-btn"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white bg-dark rounded-circle d-flex align-items-center justify-content-center border border-secondary home-footer-social-btn"><i class="bi bi-twitter-x"></i></a>
                </div>
            </div>

            <!-- Column 2: Quick Links -->
            <div class="col-6 col-md-3 col-lg-2">
                <h6 class="fw-bold mb-3 text-white">Quick Links</h6>
                <ul class="list-unstyled home-footer-links">
                    <li><a href="/">Home</a></li>
                    <li><a href="/store">Shop</a></li>
                    <li><a href="/about">About Us</a></li>
                    <li><a href="/contact">Contact Us</a></li>
                    <li><a href="#">Track Order</a></li>
                </ul>
            </div>

            <!-- Column 3: Categories -->
            <div class="col-6 col-md-3 col-lg-2">
                <h6 class="fw-bold mb-3 text-white">Categories</h6>
                <ul class="list-unstyled home-footer-links">
                    <li><a href="{{ url('/category/sofa') }}">Sofas</a></li>
                    <li><a href="{{ url('/category/bed') }}">Beds</a></li>
                    <li><a href="{{ url('/category/Dining Table') }}">Dining Tables</a></li>
                    <li><a href="{{ url('/category/TV Unit') }}">TV Units</a></li>
                    <li><a href="{{ url('/category/wardrobe') }}">Wardrobes</a></li>
                    <li><a href="/store">More Categories</a></li>
                </ul>
            </div>

            <!-- Column 4: Customer Service -->
            <div class="col-6 col-md-4 col-lg-2">
                <h6 class="fw-bold mb-3 text-white">Customer Service</h6>
                <ul class="list-unstyled home-footer-links">
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Returns</a></li>
                    <li><a href="#">Shipping Policy</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
                </ul>
            </div>

            <!-- Column 5: Newsletter -->
            <div class="col-12 col-md-8 col-lg-3">
                <h6 class="fw-bold mb-3 text-white">Newsletter</h6>
                <p class="text-white-50 mb-3">Subscribe for latest updates</p>
                <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Newsletter feature is coming soon!');">
                    <div class="mb-3">
                        <input type="email" class="form-control rounded-2 border-0 home-footer-input shadow-none" placeholder="Enter your email" required>
                    </div>
                    <button type="submit" class="btn w-100 rounded-2 text-white fw-bold btn-orange home-footer-btn">Subscribe</button>
                </form>
            </div>

        </div>

        <!-- Bottom Bar -->
        <div class="d-flex flex-column flex-md-row justify-content-center align-items-center pt-3 border-top border-secondary">
            <p class="text-white-50 m-0">&copy; {{ date('Y') }} Furnio Furniture | Designed by You</p>
        </div>
    </div>
</footer>
