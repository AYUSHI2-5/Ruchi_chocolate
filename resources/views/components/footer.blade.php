{{-- Section 9: Footer (Standard Shared Footer) --}}
<footer class="rc-footer-section" id="rcFooter" aria-label="Site Footer">
    <!-- PART A: Main Footer (Light warm cream/off-white background) -->
    <div class="rc-footer-main">
        <div class="rc-footer-container">
            <div class="rc-footer-grid">
                
                <!-- Column 1: Logo + Company Description -->
                <div class="rc-footer-col rc-footer-col--brand">
                    <a href="{{ route('home') }}" class="rc-footer-logo-link" aria-label="Ruchi Chocolate Home">
                        <img src="{{ asset('images/logo.png') }}" alt="Ruchi Beverages - Homemade Chocolates" class="rc-footer-logo-img">
                    </a>
                    <p class="rc-footer-desc">
                        Ruchi Chocolate brings you the finest handmade chocolates and thoughtful gift hampers for every occasion.
                    </p>
                    <div class="rc-social-icons-wrap rc-footer-social" aria-label="Social media">
                        <a href="{{ config('ruchi.instagram_url') }}" target="_blank" rel="noopener noreferrer" class="rc-social-btn rc-social-btn--brand rc-social-btn--instagram" aria-label="Follow Ruchi Chocolates on Instagram">
                            <svg width="40" height="40" viewBox="0 0 24 24" aria-hidden="true">
                                <defs>
                                    <linearGradient id="rc-footer-ig-grad" x1="0%" y1="100%" x2="100%" y2="0%">
                                        <stop offset="0%" stop-color="#FEDA75"/>
                                        <stop offset="25%" stop-color="#FA7E1E"/>
                                        <stop offset="50%" stop-color="#D62976"/>
                                        <stop offset="75%" stop-color="#962FBF"/>
                                        <stop offset="100%" stop-color="#4F5BD5"/>
                                    </linearGradient>
                                </defs>
                                <rect width="24" height="24" rx="6" fill="url(#rc-footer-ig-grad)"/>
                                <rect x="5.5" y="5.5" width="13" height="13" rx="4" fill="none" stroke="#FFFFFF" stroke-width="1.6"/>
                                <circle cx="12" cy="12" r="3.2" fill="none" stroke="#FFFFFF" stroke-width="1.6"/>
                                <circle cx="17.2" cy="6.8" r="1.1" fill="#FFFFFF"/>
                            </svg>
                        </a>
                        <a href="{{ config('ruchi.facebook_url') }}" target="_blank" rel="noopener noreferrer" class="rc-social-btn rc-social-btn--brand rc-social-btn--facebook" aria-label="Follow Ruchi Chocolates on Facebook">
                            <svg width="40" height="40" viewBox="0 0 24 24" aria-hidden="true">
                                <circle cx="12" cy="12" r="12" fill="#1877F2"/>
                                <path fill="#FFFFFF" d="M13.5 12.5h2.2l0.9-2.9h-2.2V8.4c0-.8.3-1.4 1.5-1.4h1.2V4.2c-.2 0-1.1-.1-2.1-.1-2.1 0-3.6 1.3-3.6 3.7v2.1H9v2.9h2.5V19h2.9v-6.5z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Column 2: EXPLORE -->
                <div class="rc-footer-col">
                    <h4 class="rc-footer-heading">EXPLORE</h4>
                    <div class="rc-footer-divider" aria-hidden="true">
                        <span class="rc-footer-divider-line"></span>
                        <span class="rc-footer-divider-heart">♥</span>
                        <span class="rc-footer-divider-line"></span>
                    </div>
                    <ul class="rc-footer-links">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('products') }}">Our Products</a></li>
                        <li><a href="{{ route('customised-gifts') }}">Customised Gifts</a></li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Column 3: CUSTOMER CARE -->
                <div class="rc-footer-col">
                    <h4 class="rc-footer-heading">CUSTOMER CARE</h4>
                    <div class="rc-footer-divider" aria-hidden="true">
                        <span class="rc-footer-divider-line"></span>
                        <span class="rc-footer-divider-heart">♥</span>
                        <span class="rc-footer-divider-line"></span>
                    </div>
                    <ul class="rc-footer-links">
                        <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('terms-and-conditions') }}">Terms &amp; Conditions</a></li>
                    </ul>
                </div>

                <!-- Column 5: NEWSLETTER -->
                <div class="rc-footer-col rc-footer-col--newsletter">
                    <h4 class="rc-footer-heading">NEWSLETTER</h4>
                    <div class="rc-footer-divider" aria-hidden="true">
                        <span class="rc-footer-divider-line"></span>
                        <span class="rc-footer-divider-heart">♥</span>
                        <span class="rc-footer-divider-line"></span>
                    </div>
                    <p class="rc-footer-newsletter-desc">
                        Subscribe to get special offers, new arrivals &amp; sweet updates!
                    </p>
                    <form class="rc-footer-form" onsubmit="event.preventDefault(); alert('Thank you for subscribing!');">
                        <div class="rc-footer-input-wrap">
                            <input type="email" placeholder="Enter your email address" class="rc-footer-input" required aria-label="Email address for newsletter">
                        </div>
                        <button type="submit" class="rc-footer-subscribe-btn">
                            <span>Subscribe</span>
                            <svg class="rc-footer-send-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <line x1="22" y1="2" x2="11" y2="13"></line>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                            </svg>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- PART B: Bottom Copyright Bar (Dark Chocolate-Brown) -->
    <div class="rc-footer-bottom">
        <div class="rc-footer-bottom-container">
            <div class="rc-footer-copyright">
                &copy; {{ date('Y') }} Ruchi Chocolate. All Rights Reserved.
            </div>

            <div class="rc-footer-center-msg">
                Made with <span class="rc-footer-pink-heart">♥</span> for Every Celebration
            </div>
        </div>
    </div>
</footer>
