{{-- Section 6: Homepage Best Sellers (Exact Screenshot Recreation) --}}
<section class="best-sellers-section" id="best-sellers-home" aria-label="Best sellers">
    <div class="best-sellers__container">
        
        <!-- Section Header Block -->
        <div class="best-sellers__header">
            <div class="best-sellers__title-wrapper">
                <!-- Left Decorative Gold Ornament -->
                <span class="best-sellers__flourish-icon left-icon" aria-hidden="true">
                    <svg width="28" height="28" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6C16 10 9 12 9 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M9 16.5C6.5 16.5 4.5 18.5 4.5 21C4.5 24.5 9 27.5 9 27.5C9 27.5 13.5 24.5 13.5 21C13.5 18.5 11.5 16.5 9 16.5Z" fill="currentColor"/>
                        <path d="M18 6C19.5 10 24.5 11.5 24.5 15.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M24.5 15C22.5 15 21 16.5 21 18.5C21 21.5 24.5 24 24.5 24C24.5 24 28 21.5 28 18.5C28 16.5 26.5 15 24.5 15Z" fill="currentColor"/>
                        <path d="M18 6C18.5 5 19.5 4.5 20.5 5C21 5.25 21 6 20 6.5C19 7 18.5 6.5 18 6Z" fill="currentColor"/>
                    </svg>
                </span>

                <h2 class="best-sellers__title">Best sellers</h2>

                <!-- Right Decorative Gold Ornament -->
                <span class="best-sellers__flourish-icon right-icon" aria-hidden="true">
                    <svg width="28" height="28" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6C16 10 9 12 9 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M9 16.5C6.5 16.5 4.5 18.5 4.5 21C4.5 24.5 9 27.5 9 27.5C9 27.5 13.5 24.5 13.5 21C13.5 18.5 11.5 16.5 9 16.5Z" fill="currentColor"/>
                        <path d="M18 6C19.5 10 24.5 11.5 24.5 15.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M24.5 15C22.5 15 21 16.5 21 18.5C21 21.5 24.5 24 24.5 24C24.5 24 28 21.5 28 18.5C28 16.5 26.5 15 24.5 15Z" fill="currentColor"/>
                        <path d="M18 6C18.5 5 19.5 4.5 20.5 5C21 5.25 21 6 20 6.5C19 7 18.5 6.5 18 6Z" fill="currentColor"/>
                    </svg>
                </span>
            </div>

            <!-- Small Gold Divider below heading: ──── ♥ ──── -->
            <div class="best-sellers__divider" aria-hidden="true">
                <div class="best-sellers__divider-line"></div>
                <span class="best-sellers__divider-heart">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="#D99A2B">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                </span>
                <div class="best-sellers__divider-line"></div>
            </div>

            <!-- Subtitle -->
            <p class="best-sellers__subheading">
                Most loved gifts, chosen by your customers
            </p>
        </div>

        <!-- Carousel Wrapper with Left/Right Navigation Arrows -->
        <div class="best-sellers__carousel-wrapper">
            <!-- Left Arrow Button (Hidden as all 4 products are displayed) -->
            <button type="button" class="best-sellers__arrow best-sellers__arrow--prev" id="bestSellersPrev" aria-label="Previous products" style="display: none;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>

            <!-- Carousel Track with Horizontal Product Cards -->
            <div class="best-sellers__track" id="bestSellersCarousel" role="region" aria-label="Best Sellers Carousel">
                
                <!-- Product Card 1: R011 Big Rose Bouquet -->
                <div class="best-sellers__card">
                    <div class="best-sellers__card-image-wrap">
                        <div class="best-sellers__badge" aria-label="Best Seller">
                            <span>BEST</span>
                            <span>SELLER</span>
                        </div>
                        <img src="{{ asset('images/products/r011.jpg') }}" alt="R011 Big Rose Bouquet" class="best-sellers__card-img" loading="lazy" width="768" height="1024">
                        <button type="button" class="best-sellers__wishlist-btn wishlist-toggle" data-id="r011" data-title="R011 Big Rose Bouquet" data-price="₹350.00" data-image="{{ asset('images/products/r011.jpg') }}" data-url="{{ route('products') }}" aria-label="Add R011 to wishlist">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="best-sellers__card-body">
                        <h3 class="best-sellers__card-title">R011 Big Rose Bouquet</h3>
                        <div class="best-sellers__card-rating">
                            <div class="best-sellers__stars" aria-hidden="true">
                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                            </div>
                            <span class="best-sellers__rating-score">4.8</span>
                            <span class="best-sellers__rating-count">(216)</span>
                        </div>
                        <div class="best-sellers__card-price">₹350.00</div>
                        <button type="button" class="best-sellers__card-btn best-sellers__card-btn--view open-product-modal" data-id="r011">
                            View Product
                        </button>
                    </div>
                </div>

                <!-- Product Card 2: R001 Volley Handy -->
                <div class="best-sellers__card">
                    <div class="best-sellers__card-image-wrap">
                        <div class="best-sellers__badge" aria-label="Best Seller">
                            <span>BEST</span>
                            <span>SELLER</span>
                        </div>
                        <img src="{{ asset('images/products/r001.jpg') }}" alt="R001 Volley Handy" class="best-sellers__card-img" loading="lazy" width="576" height="1024">
                        <button type="button" class="best-sellers__wishlist-btn wishlist-toggle" data-id="r001" data-title="R001 Volley Handy" data-price="₹250.00" data-image="{{ asset('images/products/r001.jpg') }}" data-url="{{ route('products') }}" aria-label="Add R001 to wishlist">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="best-sellers__card-body">
                        <h3 class="best-sellers__card-title">R001 Volley Handy</h3>
                        <div class="best-sellers__card-rating">
                            <div class="best-sellers__stars" aria-hidden="true">
                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                            </div>
                            <span class="best-sellers__rating-score">4.8</span>
                            <span class="best-sellers__rating-count">(216)</span>
                        </div>
                        <div class="best-sellers__card-price">₹250.00</div>
                        <button type="button" class="best-sellers__card-btn best-sellers__card-btn--view open-product-modal" data-id="r001">
                            View Product
                        </button>
                    </div>
                </div>

                <!-- Product Card 3: R012 Acrylic Bouquet -->
                <div class="best-sellers__card">
                    <div class="best-sellers__card-image-wrap">
                        <div class="best-sellers__badge" aria-label="Best Seller">
                            <span>BEST</span>
                            <span>SELLER</span>
                        </div>
                        <img src="{{ asset('images/products/r012.jpg') }}" alt="R012 Acrylic Bouquet" class="best-sellers__card-img" loading="lazy" width="766" height="1024">
                        <button type="button" class="best-sellers__wishlist-btn wishlist-toggle" data-id="r012" data-title="R012 Acrylic Bouquet" data-price="₹750.00" data-image="{{ asset('images/products/r012.jpg') }}" data-url="{{ route('products') }}" aria-label="Add R012 to wishlist">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="best-sellers__card-body">
                        <h3 class="best-sellers__card-title">R012 Acrylic Bouquet</h3>
                        <div class="best-sellers__card-rating">
                            <div class="best-sellers__stars" aria-hidden="true">
                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                            </div>
                            <span class="best-sellers__rating-score">4.9</span>
                            <span class="best-sellers__rating-count">(216)</span>
                        </div>
                        <div class="best-sellers__card-price">₹750.00</div>
                        <button type="button" class="best-sellers__card-btn best-sellers__card-btn--view open-product-modal" data-id="r012">
                            View Product
                        </button>
                    </div>
                </div>

                <!-- Product Card 4: R010 Half Round Bouquet -->
                <div class="best-sellers__card">
                    <div class="best-sellers__card-image-wrap">
                        <div class="best-sellers__badge" aria-label="Best Seller">
                            <span>BEST</span>
                            <span>SELLER</span>
                        </div>
                        <img src="{{ asset('images/products/r010.jpg') }}" alt="R010 Half Round Bouquet" class="best-sellers__card-img" loading="lazy" width="768" height="1024">
                        <button type="button" class="best-sellers__wishlist-btn wishlist-toggle" data-id="r010" data-title="R010 Half Round Bouquet" data-price="₹510.00" data-image="{{ asset('images/products/r010.jpg') }}" data-url="{{ route('products') }}" aria-label="Add R010 to wishlist">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="best-sellers__card-body">
                        <h3 class="best-sellers__card-title">R010 Half Round Bouquet</h3>
                        <div class="best-sellers__card-rating">
                            <div class="best-sellers__stars" aria-hidden="true">
                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                            </div>
                            <span class="best-sellers__rating-score">4.8</span>
                            <span class="best-sellers__rating-count">(216)</span>
                        </div>
                        <div class="best-sellers__card-price">₹510.00</div>
                        <button type="button" class="best-sellers__card-btn best-sellers__card-btn--view open-product-modal" data-id="r010">
                            View Product
                        </button>
                    </div>
                </div>

            </div>

            <!-- Right Arrow Button (Hidden as all 4 products are displayed) -->
            <button type="button" class="best-sellers__arrow best-sellers__arrow--next" id="bestSellersNext" aria-label="Next products" style="display: none;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>
        </div>

        <!-- Centered Bottom CTA Button: View All Products -->
        <div class="best-sellers__cta-wrapper">
            <a href="{{ route('products') }}" class="best-sellers__cta-btn" id="viewAllProductsBtn">
                <svg class="best-sellers__cta-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                </svg>
                <span>View All Products</span>
            </a>
        </div>

    </div>
</section>

{{-- Vanilla Carousel Script for Section 6 --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carousel = document.getElementById('bestSellersCarousel');
        const prevBtn = document.getElementById('bestSellersPrev');
        const nextBtn = document.getElementById('bestSellersNext');

        if (!carousel || !prevBtn || !nextBtn) return;

        function getScrollAmount() {
            const card = carousel.querySelector('.best-sellers__card');
            if (card) {
                const style = window.getComputedStyle(carousel);
                const gap = parseFloat(style.gap) || 20;
                return card.offsetWidth + gap;
            }
            return 280;
        }

        prevBtn.addEventListener('click', function() {
            carousel.scrollBy({
                left: -getScrollAmount(),
                behavior: 'smooth'
            });
        });

        nextBtn.addEventListener('click', function() {
            carousel.scrollBy({
                left: getScrollAmount(),
                behavior: 'smooth'
            });
        });
    });
</script>
