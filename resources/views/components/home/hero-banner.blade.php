{{-- Hero Slideshow & Features Bar matching Ruchi Chocolates Luxury Inspiration --}}
<section class="rc-slideshow-section" aria-label="Hero Banner">
    <div class="rc-slider-container" id="rcSliderContainer">
        <div class="rc-slide active" style="--desktop-bg: url('{{ asset('images/hero-banner.png') }}'); --mobile-bg: url('{{ asset('images/hero-banner.png') }}');">
            <div class="rc-slide-overlay"></div>
            
            <div class="rc-slide-inner">
                <div class="rc-slide-content">
                    
                    <!-- Small Eyebrow Text: HANDMADE WITH LOVE -->
                    <div class="rc-hero-eyebrow">
                        <span class="rc-hero-eyebrow-line" aria-hidden="true"></span>
                        <span class="rc-hero-eyebrow-heart" aria-hidden="true">❤️</span>
                        <span class="rc-hero-eyebrow-text">HANDMADE WITH LOVE</span>
                        <span class="rc-hero-eyebrow-line" aria-hidden="true"></span>
                    </div>

                    <!-- Main Heading (H1): A Little Sweetness, A Lot of Love. -->
                    <h1 class="rc-hero-heading">
                        A Little <span class="rc-hero-highlight">Sweetness</span>,<br>
                        A Lot of <span class="rc-hero-highlight">Love</span>.
                    </h1>

                    <!-- Short Decorative Divider -->
                    <div class="rc-hero-divider" aria-hidden="true">
                        <div class="rc-hero-divider-bar"></div>
                        <span class="rc-hero-divider-icon">✨</span>
                        <div class="rc-hero-divider-bar"></div>
                    </div>

                    <!-- Subheading -->
                    <p class="rc-hero-subheading">
                        Handcrafted Chocolates &amp; Thoughtful Gift Hampers for every occasion.
                    </p>

                    <!-- Primary CTA Button: Explore Our Collection -->
                    <div class="rc-hero-actions">
                        <a href="{{ route('products') }}" class="rc-hero-btn">
                            <span>Explore Our Collection</span>
                            <svg class="rc-hero-btn-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>

                </div>

                <!-- Right Graphic Column (Preserves Background Image Visibility) -->
                <div class="rc-slide-graphic-col" aria-hidden="true"></div>
            </div>
        </div>
    </div>

    <!-- Overlapping Bottom Features Bar (5 items) -->
    <div class="rc-features-bar">
        <div class="rc-features-container">
            
            <!-- Feature 1: Exclusive Gift Hampers -->
            <div class="rc-feature-item">
                <div class="rc-feature-icon-wrapper" aria-hidden="true">
                    <svg class="rc-feature-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="21 8 21 21 3 21 3 8"></polyline>
                        <rect x="1" y="3" width="22" height="5"></rect>
                        <line x1="10" y1="12" x2="14" y2="12"></line>
                    </svg>
                </div>
                <div class="rc-feature-text">
                    <span class="rc-feature-title">Exclusive Gift Hampers</span>
                    <span class="rc-feature-desc">For every occasion</span>
                </div>
            </div>

            <!-- Feature 2: Finest Ingredients -->
            <div class="rc-feature-item">
                <div class="rc-feature-icon-wrapper" aria-hidden="true">
                    <svg class="rc-feature-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="12 2 22 8.5 22 15.5 12 22 2 15.5 2 8.5"></polygon>
                        <polyline points="22 8.5 12 15.5 2 8.5"></polyline>
                        <line x1="12" y1="22" x2="12" y2="15.5"></line>
                        <polyline points="2 15.5 12 8.5 22 15.5"></polyline>
                        <line x1="12" y1="2" x2="12" y2="8.5"></line>
                    </svg>
                </div>
                <div class="rc-feature-text">
                    <span class="rc-feature-title">Finest Ingredients</span>
                    <span class="rc-feature-desc">Rich &amp; delicious</span>
                </div>
            </div>

            <!-- Feature 3: Made with Care & Passion -->
            <div class="rc-feature-item">
                <div class="rc-feature-icon-wrapper" aria-hidden="true">
                    <svg class="rc-feature-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                    </svg>
                </div>
                <div class="rc-feature-text">
                    <span class="rc-feature-title">Made with Care &amp; Passion</span>
                    <span class="rc-feature-desc">Just for you</span>
                </div>
            </div>

            <!-- Feature 4: Safe & Secure Packaging -->
            <div class="rc-feature-item">
                <div class="rc-feature-icon-wrapper" aria-hidden="true">
                    <svg class="rc-feature-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                    </svg>
                </div>
                <div class="rc-feature-text">
                    <span class="rc-feature-title">Safe &amp; Secure Packaging</span>
                    <span class="rc-feature-desc">Delivered with perfection</span>
                </div>
            </div>

            <!-- Feature 5: 24/7 Support -->
            <div class="rc-feature-item">
                <div class="rc-feature-icon-wrapper" aria-hidden="true">
                    <svg class="rc-feature-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                    </svg>
                </div>
                <div class="rc-feature-text">
                    <span class="rc-feature-title">24/7 Support</span>
                    <span class="rc-feature-desc">We're here for you</span>
                </div>
            </div>

        </div>
    </div>
</section>
