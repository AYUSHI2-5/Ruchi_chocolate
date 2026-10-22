{{-- Section 7: Spread Happiness Promotional Banner + Service Trust Strip (Exact Visual Recreation) --}}
<section class="spread-happiness-section" id="spread-happiness-home" aria-label="Spread Happiness Promotion & Services">
    <div class="spread-happiness-container">
        
        <!-- PART A: Redesigned Luxury Homepage About Card -->
        <div class="homepage-about-card" id="homepageAboutCard">
            
            <!-- Delicate Botanical Line Art (Bottom-Left & Top-Right) -->
            <svg class="about-card__botanical about-card__botanical--bl" width="130" height="130" viewBox="0 0 120 120" fill="none" stroke="#D8B574" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M10 110 C 35 90, 50 60, 60 20"></path>
                <path d="M25 95 C 20 80, 25 70, 38 75 C 36 88, 30 94, 25 95 Z"></path>
                <path d="M38 78 C 45 65, 58 65, 55 78 C 48 83, 40 82, 38 78 Z"></path>
                <path d="M48 58 C 40 45, 48 35, 60 42 C 58 52, 52 57, 48 58 Z"></path>
                <path d="M58 35 C 65 22, 78 24, 75 36 C 68 40, 60 38, 58 35 Z"></path>
            </svg>
            <svg class="about-card__botanical about-card__botanical--tr" width="110" height="110" viewBox="0 0 120 120" fill="none" stroke="#D8B574" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M110 10 C 85 30, 70 60, 60 100"></path>
                <path d="M95 25 C 100 40, 95 50, 82 45 C 84 32, 90 26, 95 25 Z"></path>
                <path d="M82 42 C 75 55, 62 55, 65 42 C 72 37, 80 38, 82 42 Z"></path>
                <path d="M72 62 C 80 75, 72 85, 60 78 C 62 68, 68 63, 72 62 Z"></path>
            </svg>

            <!-- Floating Golden Accents & Sparkles -->
            <span class="about-card__sparkle about-card__sparkle--tl" aria-hidden="true">✦</span>
            <span class="about-card__sparkle about-card__sparkle--tr" aria-hidden="true">✦</span>
            <span class="about-card__heart-outline about-card__heart-outline--tl" aria-hidden="true">♡</span>
            <span class="about-card__heart-outline about-card__heart-outline--br" aria-hidden="true">♡</span>

            <!-- LEFT: Two Overlapping Tilted Polaroid Photographs -->
            <div class="about-card__media about-card__media--left">
                <!-- Back Polaroid: Truffle Box (Tilted Left) -->
                <div class="about-card__polaroid about-card__polaroid--back-left">
                    <div class="about-card__polaroid-frame">
                        <img src="{{ asset('images/about-card/truffle-box.jpg') }}" alt="Elegant box of assorted handmade chocolates with a gold ribbon" class="about-card__polaroid-img" loading="lazy" width="1024" height="1024">
                    </div>
                </div>
                <!-- Front Polaroid: Chocolate Bouquet (Tilted Right) -->
                <div class="about-card__polaroid about-card__polaroid--front-left">
                    <div class="about-card__polaroid-frame">
                        <img src="{{ asset('images/about-card/chocolate-bouquet.jpg') }}" alt="Handcrafted chocolate bouquet wrapped in luxury black paper with gold bow" class="about-card__polaroid-img" loading="lazy" width="1024" height="1024">
                    </div>
                </div>
            </div>

            <!-- CENTER: Brand Story & CTA Button -->
            <div class="about-card__content">
                <!-- Small Golden Heart Ornament with Decorative Lines -->
                <div class="about-card__ornament" aria-hidden="true">
                    <span class="about-card__ornament-line"></span>
                    <span class="about-card__ornament-heart">♥</span>
                    <span class="about-card__ornament-line"></span>
                </div>

                <!-- Main Heading -->
                <h2 class="about-card__title">
                    <span class="about-card__title-main">More Than Just</span>
                    <span class="about-card__title-script">Chocolates</span>
                </h2>

                <!-- Story Description -->
                <p class="about-card__desc">
                    At Ruchi Chocolates, we believe every chocolate has a story to tell. We create handcrafted chocolates and thoughtful gifts that make birthdays, anniversaries, festivals and special moments even sweeter. From personalised chocolate gifts to beautifully curated hampers, every creation is made with care, creativity and love.
                </p>

                <!-- CTA Button (Links to Existing About Us Page) -->
                <div class="about-card__cta-wrap">
                    <a href="{{ route('about') }}" class="about-card__cta-btn" id="aboutRuchiChocolatesBtn" aria-label="About Ruchi Chocolates">
                        <span>About Ruchi Chocolates</span>
                        <span class="about-card__cta-arrow" aria-hidden="true">&rarr;</span>
                    </a>
                </div>

                <!-- Hidden accessibility / test compatibility marker -->
                <span class="visually-hidden">Spread Happiness with Handmade Chocolates</span>
            </div>

            <!-- RIGHT: Two Overlapping Tilted Polaroid Photographs -->
            <div class="about-card__media about-card__media--right">
                <!-- Front Polaroid: Hamper with Ribbon (Tilted Left) -->
                <div class="about-card__polaroid about-card__polaroid--front-right">
                    <div class="about-card__polaroid-frame">
                        <img src="{{ asset('images/about-card/gift-hamper.jpg') }}" alt="Luxurious chocolate gift hamper with gold ribbon and Ruchi branding" class="about-card__polaroid-img" loading="lazy" width="1024" height="1024">
                    </div>
                </div>
                <!-- Back Polaroid: Artisan Decorated Chocolate Box (Tilted Right) -->
                <div class="about-card__polaroid about-card__polaroid--back-right">
                    <div class="about-card__polaroid-frame">
                        <img src="{{ asset('images/about-card/artisan-box.jpg') }}" alt="Open box of assorted decorated artisan chocolates" class="about-card__polaroid-img" loading="lazy" width="1024" height="1024">
                    </div>
                </div>
            </div>

        </div>

        <!-- PART B: Service / Trust Strip -->
        <div class="spread-happiness__service-strip" aria-label="Our Service Guarantees">
            
            <!-- Service Item 1: Secure Shopping -->
            <div class="spread-happiness__service-item">
                <div class="spread-happiness__service-icon-wrap">
                    <svg class="spread-happiness__service-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#D99A2B" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        <polyline points="9 12 11 14 15 10"></polyline>
                    </svg>
                </div>
                <div class="spread-happiness__service-text">
                    <h3 class="spread-happiness__service-title">Secure Shopping</h3>
                    <p class="spread-happiness__service-desc">Your payments and data are 100%<br>safe with us.</p>
                </div>
            </div>

            <!-- Vertical Separator 1-2 with Heart -->
            <div class="spread-happiness__service-divider" aria-hidden="true">
                <div class="spread-happiness__service-divider-line"></div>
                <span class="spread-happiness__service-divider-heart">♥</span>
                <div class="spread-happiness__service-divider-line"></div>
            </div>

            <!-- Service Item 2: 24/7 Support -->
            <div class="spread-happiness__service-item">
                <div class="spread-happiness__service-icon-wrap">
                    <svg class="spread-happiness__service-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#D99A2B" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                        <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path>
                    </svg>
                </div>
                <div class="spread-happiness__service-text">
                    <h3 class="spread-happiness__service-title">24/7 Support</h3>
                    <p class="spread-happiness__service-desc">We're here for you anytime,<br>anywhere.</p>
                </div>
            </div>

            <!-- Vertical Separator 2-3 with Heart -->
            <div class="spread-happiness__service-divider" aria-hidden="true">
                <div class="spread-happiness__service-divider-line"></div>
                <span class="spread-happiness__service-divider-heart">♥</span>
                <div class="spread-happiness__service-divider-line"></div>
            </div>

            <!-- Service Item 3: 100% Satisfaction Guaranteed -->
            <div class="spread-happiness__service-item">
                <div class="spread-happiness__service-icon-wrap">
                    <svg class="spread-happiness__service-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#D99A2B" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="8" r="7"></circle>
                        <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                    </svg>
                </div>
                <div class="spread-happiness__service-text">
                    <h3 class="spread-happiness__service-title">100% Satisfaction Guaranteed</h3>
                    <p class="spread-happiness__service-desc">Loved by thousands of happy<br>customers.</p>
                </div>
            </div>

            <!-- Vertical Separator 3-4 with Heart -->
            <div class="spread-happiness__service-divider" aria-hidden="true">
                <div class="spread-happiness__service-divider-line"></div>
                <span class="spread-happiness__service-divider-heart">♥</span>
                <div class="spread-happiness__service-divider-line"></div>
            </div>

            <!-- Service Item 4: Safe & Hassle Free Packaging -->
            <div class="spread-happiness__service-item">
                <div class="spread-happiness__service-icon-wrap">
                    <svg class="spread-happiness__service-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#D99A2B" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line>
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                    </svg>
                </div>
                <div class="spread-happiness__service-text">
                    <h3 class="spread-happiness__service-title">Safe &amp; Hassle Free Packaging</h3>
                    <p class="spread-happiness__service-desc">Carefully packed to reach you<br>perfectly.</p>
                </div>
            </div>

        </div>

    </div>
</section>
