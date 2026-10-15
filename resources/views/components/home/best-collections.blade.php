{{-- Section 4: Homepage Our Best Collections (Screenshot-driven exact visual target) --}}
<section class="best-collections-section" id="best-collections-home" aria-label="Our Best Collections">
    <div class="best-collections__container">
        
        <!-- Top Label: → HANDMADE WITH LOVE ← -->
        <div class="best-collections__eyebrow">
            &rarr; HANDMADE WITH LOVE &larr;
        </div>

        <!-- Section Header Block -->
        <div class="best-collections__header">
            <div class="best-collections__title-wrapper">
                <span class="best-collections__flourish-icon left-icon" aria-hidden="true">
                    <svg width="28" height="28" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6C16 10 9 12 9 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M9 16.5C6.5 16.5 4.5 18.5 4.5 21C4.5 24.5 9 27.5 9 27.5C9 27.5 13.5 24.5 13.5 21C13.5 18.5 11.5 16.5 9 16.5Z" fill="currentColor"/>
                        <path d="M18 6C19.5 10 24.5 11.5 24.5 15.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M24.5 15C22.5 15 21 16.5 21 18.5C21 21.5 24.5 24 24.5 24C24.5 24 28 21.5 28 18.5C28 16.5 26.5 15 24.5 15Z" fill="currentColor"/>
                        <path d="M18 6C18.5 5 19.5 4.5 20.5 5C21 5.25 21 6 20 6.5C19 7 18.5 6.5 18 6Z" fill="currentColor"/>
                    </svg>
                </span>

                <h2 class="best-collections__title">
                    Our <span class="best-collections__title-script">Best</span> Collections
                </h2>

                <span class="best-collections__flourish-icon right-icon" aria-hidden="true">
                    <svg width="28" height="28" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6C16 10 9 12 9 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M9 16.5C6.5 16.5 4.5 18.5 4.5 21C4.5 24.5 9 27.5 9 27.5C9 27.5 13.5 24.5 13.5 21C13.5 18.5 11.5 16.5 9 16.5Z" fill="currentColor"/>
                        <path d="M18 6C19.5 10 24.5 11.5 24.5 15.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M24.5 15C22.5 15 21 16.5 21 18.5C21 21.5 24.5 24 24.5 24C24.5 24 28 21.5 28 18.5C28 16.5 26.5 15 24.5 15Z" fill="currentColor"/>
                        <path d="M18 6C18.5 5 19.5 4.5 20.5 5C21 5.25 21 6 20 6.5C19 7 18.5 6.5 18 6Z" fill="currentColor"/>
                    </svg>
                </span>
            </div>

            <!-- Small Divider below heading: ──── ♥ ──── -->
            <div class="best-collections__divider" aria-hidden="true">
                <div class="best-collections__divider-line"></div>
                <span class="best-collections__divider-heart">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="#D99A2B">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                </span>
                <div class="best-collections__divider-line"></div>
            </div>

            <!-- Subtitle -->
            <p class="best-collections__subheading">
                Handpicked with love, perfect for every occasion &amp; celebration
            </p>
        </div>

        <!-- Carousel Wrapper with Left/Right Navigation Arrows -->
        <div class="best-collections__carousel-wrapper">
            <!-- Left Arrow Button -->
            <button type="button" class="best-collections__arrow best-collections__arrow--prev" id="bestCollectionsPrev" aria-label="Previous products">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>

            <!-- Carousel Track with 5 Product Cards -->
            <div class="best-collections__track" id="bestCollectionsCarousel" role="region" aria-label="Best Collections Carousel">
                
                <!-- Product Card 1 -->
                <div class="best-collections__card">
                    <div class="best-collections__card-image-wrap">
                        <img src="{{ asset('images/products/p001.jpg') }}" alt="P001 Small Heart Tin Box" class="best-collections__card-img" loading="lazy">
                        <button type="button" class="best-collections__wishlist-btn wishlist-toggle" data-id="p001" data-title="P001 Small Heart Tin Box" data-price="Rs. 170.00" data-image="{{ asset('images/products/p001.jpg') }}" data-url="{{ route('catalog') }}" aria-label="Add P001 to wishlist">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="best-collections__card-body">
                        <h3 class="best-collections__card-title">P001 Small Heart Tin Box</h3>
                        <div class="best-collections__card-rating">
                            <div class="best-collections__stars" aria-hidden="true">
                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                            </div>
                            <span class="best-collections__rating-score">4.8</span>
                            <span class="best-collections__rating-count">(216)</span>
                        </div>
                        <div class="best-collections__card-price">Rs. 170.00</div>
                        <button type="button" class="best-collections__card-btn best-collections__card-btn--view open-product-modal" data-id="p001" aria-label="View product details for P001 Small Heart Tin Box">
                            View Product
                        </button>
                    </div>
                </div>

                <!-- Product Card 2 -->
                <div class="best-collections__card">
                    <div class="best-collections__card-image-wrap">
                        <img src="{{ asset('images/products/p002.jpg') }}" alt="P002 Big Heart Tin Box" class="best-collections__card-img" loading="lazy">
                        <button type="button" class="best-collections__wishlist-btn wishlist-toggle" data-id="p002" data-title="P002 Big Heart Tin Box" data-price="Rs. 225.00" data-image="{{ asset('images/products/p002.jpg') }}" data-url="{{ route('catalog') }}" aria-label="Add P002 to wishlist">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="best-collections__card-body">
                        <h3 class="best-collections__card-title">P002 Big Heart Tin Box</h3>
                        <div class="best-collections__card-rating">
                            <div class="best-collections__stars" aria-hidden="true">
                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                            </div>
                            <span class="best-collections__rating-score">4.9</span>
                            <span class="best-collections__rating-count">(216)</span>
                        </div>
                        <div class="best-collections__card-price">Rs. 225.00</div>
                        <button type="button" class="best-collections__card-btn best-collections__card-btn--view open-product-modal" data-id="p002" aria-label="View product details for P002 Big Heart Tin Box">
                            View Product
                        </button>
                    </div>
                </div>

                <!-- Product Card 3 -->
                <div class="best-collections__card">
                    <div class="best-collections__card-image-wrap">
                        <img src="{{ asset('images/products/p003.jpg') }}" alt="P003 Rectangle Tin Box" class="best-collections__card-img" loading="lazy">
                        <button type="button" class="best-collections__wishlist-btn wishlist-toggle" data-id="p003" data-title="P003 Rectangle Tin Box" data-price="Rs. 410.00" data-image="{{ asset('images/products/p003.jpg') }}" data-url="{{ route('catalog') }}" aria-label="Add P003 to wishlist">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="best-collections__card-body">
                        <h3 class="best-collections__card-title">P003 Rectangle Tin Box</h3>
                        <div class="best-collections__card-rating">
                            <div class="best-collections__stars" aria-hidden="true">
                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                            </div>
                            <span class="best-collections__rating-score">4.7</span>
                            <span class="best-collections__rating-count">(95)</span>
                        </div>
                        <div class="best-collections__card-price">Rs. 410.00</div>
                        <button type="button" class="best-collections__card-btn best-collections__card-btn--view open-product-modal" data-id="p003" aria-label="View product details for P003 Rectangle Tin Box">
                            View Product
                        </button>
                    </div>
                </div>

                <!-- Product Card 4 -->
                <div class="best-collections__card">
                    <div class="best-collections__card-image-wrap">
                        <img src="{{ asset('images/products/p004.jpg') }}" alt="P004 Small Square Tin Box" class="best-collections__card-img" loading="lazy">
                        <button type="button" class="best-collections__wishlist-btn wishlist-toggle" data-id="p004" data-title="P004 Small Square Tin Box" data-price="Rs. 290.00" data-image="{{ asset('images/products/p004.jpg') }}" data-url="{{ route('catalog') }}" aria-label="Add P004 to wishlist">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="best-collections__card-body">
                        <h3 class="best-collections__card-title">P004 Small Square Tin Box</h3>
                        <div class="best-collections__card-rating">
                            <div class="best-collections__stars" aria-hidden="true">
                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                            </div>
                            <span class="best-collections__rating-score">4.8</span>
                            <span class="best-collections__rating-count">(142)</span>
                        </div>
                        <div class="best-collections__card-price">Rs. 290.00</div>
                        <button type="button" class="best-collections__card-btn best-collections__card-btn--view open-product-modal" data-id="p004" aria-label="View product details for P004 Small Square Tin Box">
                            View Product
                        </button>
                    </div>
                </div>

                <!-- Product Card 5 -->
                <div class="best-collections__card">
                    <div class="best-collections__card-image-wrap">
                        <img src="{{ asset('images/products/p005.jpg') }}" alt="P005 Big Square Tin Box" class="best-collections__card-img" loading="lazy">
                        <button type="button" class="best-collections__wishlist-btn wishlist-toggle" data-id="p005" data-title="P005 Big Square Tin Box" data-price="Rs. 730.00" data-image="{{ asset('images/products/p005.jpg') }}" data-url="{{ route('catalog') }}" aria-label="Add P005 to wishlist">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="best-collections__card-body">
                        <h3 class="best-collections__card-title">P005 Big Square Tin Box</h3>
                        <div class="best-collections__card-rating">
                            <div class="best-collections__stars" aria-hidden="true">
                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                            </div>
                            <span class="best-collections__rating-score">4.9</span>
                            <span class="best-collections__rating-count">(310)</span>
                        </div>
                        <div class="best-collections__card-price">Rs. 730.00</div>
                        <button type="button" class="best-collections__card-btn best-collections__card-btn--view" data-id="p005">
                            View Product
                        </button>
                    </div>
                </div>

            </div>

            <!-- Right Arrow Button -->
            <button type="button" class="best-collections__arrow best-collections__arrow--next" id="bestCollectionsNext" aria-label="Next products">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>
        </div>

        <!-- Centered Bottom CTA Button: View All Collections -->
        <div class="best-collections__cta-wrapper">
            <a href="{{ route('catalog') }}" class="best-collections__cta-btn">
                <svg class="best-collections__cta-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 12 20 22 4 22 4 12"></polyline>
                    <rect x="2" y="7" width="20" height="5"></rect>
                    <line x1="12" y1="22" x2="12" y2="7"></line>
                    <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path>
                    <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path>
                </svg>
                <span>View All Collections</span>
            </a>
        </div>

    </div>
</section>

