{{-- Section 8: Homepage Featured Collections (Wide 4-Column Grid) --}}
<section class="featured-collections-section" id="featured-collections-home" aria-label="Featured Collections">
    <div class="featured-collections__container">
        
        <!-- Section Header Block -->
        <div class="featured-collections__header">
            <div class="featured-collections__title-wrapper">
                <!-- Left Decorative Gold Ornament -->
                <span class="featured-collections__flourish-icon left-icon" aria-hidden="true">
                    <svg width="30" height="30" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6C16 10 9 12 9 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M9 16.5C6.5 16.5 4.5 18.5 4.5 21C4.5 24.5 9 27.5 9 27.5C9 27.5 13.5 24.5 13.5 21C13.5 18.5 11.5 16.5 9 16.5Z" fill="currentColor"/>
                        <path d="M18 6C19.5 10 24.5 11.5 24.5 15.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M24.5 15C22.5 15 21 16.5 21 18.5C21 21.5 24.5 24 24.5 24C24.5 24 28 21.5 28 18.5C28 16.5 26.5 15 24.5 15Z" fill="currentColor"/>
                        <path d="M18 6C18.5 5 19.5 4.5 20.5 5C21 5.25 21 6 20 6.5C19 7 18.5 6.5 18 6Z" fill="currentColor"/>
                    </svg>
                </span>

                <h2 class="featured-collections__title">Featured Collections</h2>

                <!-- Right Decorative Gold Ornament -->
                <span class="featured-collections__flourish-icon right-icon" aria-hidden="true">
                    <svg width="30" height="30" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6C16 10 9 12 9 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M9 16.5C6.5 16.5 4.5 18.5 4.5 21C4.5 24.5 9 27.5 9 27.5C9 27.5 13.5 24.5 13.5 21C13.5 18.5 11.5 16.5 9 16.5Z" fill="currentColor"/>
                        <path d="M18 6C19.5 10 24.5 11.5 24.5 15.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M24.5 15C22.5 15 21 16.5 21 18.5C21 21.5 24.5 24 24.5 24C24.5 24 28 21.5 28 18.5C28 16.5 26.5 15 24.5 15Z" fill="currentColor"/>
                        <path d="M18 6C18.5 5 19.5 4.5 20.5 5C21 5.25 21 6 20 6.5C19 7 18.5 6.5 18 6Z" fill="currentColor"/>
                    </svg>
                </span>
            </div>

            <!-- Small Gold Divider below heading: ──── ♥ ──── -->
            <div class="featured-collections__divider" aria-hidden="true">
                <div class="featured-collections__divider-line"></div>
                <span class="featured-collections__divider-heart">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="#D99A2B">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                </span>
                <div class="featured-collections__divider-line"></div>
            </div>

            <!-- Subtitle -->
            <p class="featured-collections__subheading">
                Handpicked gifts to make every moment special
            </p>
        </div>

        <!-- 4-Column Product Grid (Full Desktop Width) -->
        <div class="featured-collections__grid">
            
            <!-- ROW 1 -->
            <!-- Product Card 1: R011 Big Rose Bouquet -->
            <div class="featured-collections__card">
                <div class="featured-collections__card-image-wrap">
                    <img src="{{ asset('images/products/r011.jpg') }}" alt="R011 Big Rose Bouquet" class="featured-collections__card-img" loading="lazy">
                    <button type="button" class="featured-collections__wishlist-btn wishlist-toggle" data-id="fc-r011" data-title="R011 Big Rose Bouquet" data-price="₹350.00" data-image="{{ asset('images/products/r011.jpg') }}" data-url="{{ route('catalog') }}" aria-label="Add R011 to wishlist">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                    </button>
                </div>
                <div class="featured-collections__card-body">
                    <h3 class="featured-collections__card-title">R011 Big Rose Bouquet</h3>
                    <div class="featured-collections__card-rating">
                        <div class="featured-collections__stars" aria-hidden="true">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <span class="featured-collections__rating-score">4.8</span>
                        <span class="featured-collections__rating-count">(216)</span>
                    </div>
                    <div class="featured-collections__card-price">₹350.00</div>
                    <button type="button" class="featured-collections__card-btn featured-collections__card-btn--view open-product-modal" data-id="r011">
                        View Product
                    </button>
                </div>
            </div>

            <!-- Product Card 2: R009 Silver golden Bouquet -->
            <div class="featured-collections__card">
                <div class="featured-collections__card-image-wrap">
                    <img src="{{ asset('images/products/r009.jpg') }}" alt="R009 Silver golden Bouquet" class="featured-collections__card-img" loading="lazy">
                    <button type="button" class="featured-collections__wishlist-btn wishlist-toggle" data-id="fc-r009" data-title="R009 Silver golden Bouquet" data-price="₹490.00" data-image="{{ asset('images/products/r009.jpg') }}" data-url="{{ route('catalog') }}" aria-label="Add R009 to wishlist">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                    </button>
                </div>
                <div class="featured-collections__card-body">
                    <h3 class="featured-collections__card-title">R009 Silver golden Bouquet</h3>
                    <div class="featured-collections__card-rating">
                        <div class="featured-collections__stars" aria-hidden="true">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <span class="featured-collections__rating-score">4.8</span>
                        <span class="featured-collections__rating-count">(216)</span>
                    </div>
                    <div class="featured-collections__card-price">₹490.00</div>
                    <button type="button" class="featured-collections__card-btn featured-collections__card-btn--view open-product-modal" data-id="r009">
                        View Product
                    </button>
                </div>
            </div>

            <!-- Product Card 3: R010 Half Round Bouquet -->
            <div class="featured-collections__card">
                <div class="featured-collections__card-image-wrap">
                    <img src="{{ asset('images/products/r010.jpg') }}" alt="R010 Half Round Bouquet" class="featured-collections__card-img" loading="lazy">
                    <button type="button" class="featured-collections__wishlist-btn wishlist-toggle" data-id="fc-r010" data-title="R010 Half Round Bouquet" data-price="₹510.00" data-image="{{ asset('images/products/r010.jpg') }}" data-url="{{ route('catalog') }}" aria-label="Add R010 to wishlist">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                    </button>
                </div>
                <div class="featured-collections__card-body">
                    <h3 class="featured-collections__card-title">R010 Half Round Bouquet</h3>
                    <div class="featured-collections__card-rating">
                        <div class="featured-collections__stars" aria-hidden="true">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <span class="featured-collections__rating-score">4.8</span>
                        <span class="featured-collections__rating-count">(216)</span>
                    </div>
                    <div class="featured-collections__card-price">₹510.00</div>
                    <button type="button" class="featured-collections__card-btn featured-collections__card-btn--view open-product-modal" data-id="r010">
                        View Product
                    </button>
                </div>
            </div>

            <!-- Product Card 4: R002 12 Chocolates -->
            <div class="featured-collections__card">
                <div class="featured-collections__card-image-wrap">
                    <img src="{{ asset('images/products/r002.jpg') }}" alt="R002 12 Chocolates" class="featured-collections__card-img" loading="lazy">
                    <button type="button" class="featured-collections__wishlist-btn wishlist-toggle" data-id="fc-r002" data-title="R002 12 Chocolates" data-price="₹460" data-image="{{ asset('images/products/r002.jpg') }}" data-url="{{ route('catalog') }}" aria-label="Add R002 to wishlist">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                    </button>
                </div>
                <div class="featured-collections__card-body">
                    <h3 class="featured-collections__card-title">R002 12 Chocolates</h3>
                    <div class="featured-collections__card-rating">
                        <div class="featured-collections__stars" aria-hidden="true">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <span class="featured-collections__rating-score">4.8</span>
                        <span class="featured-collections__rating-count">(216)</span>
                    </div>
                    <div class="featured-collections__card-price">₹460</div>
                    <button type="button" class="featured-collections__card-btn featured-collections__card-btn--view open-product-modal" data-id="r002">
                        View Product
                    </button>
                </div>
            </div>

            <!-- ROW 2 -->
            <!-- Product Card 5: R006 Volley Basket -->
            <div class="featured-collections__card">
                <div class="featured-collections__card-image-wrap">
                    <img src="{{ asset('images/products/r006.jpg') }}" alt="R006 Volley Basket" class="featured-collections__card-img" loading="lazy">
                    <button type="button" class="featured-collections__wishlist-btn wishlist-toggle" data-id="fc-r006" data-title="R006 Volley Basket" data-price="₹415.00" data-image="{{ asset('images/products/r006.jpg') }}" data-url="{{ route('catalog') }}" aria-label="Add R006 to wishlist">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                    </button>
                </div>
                <div class="featured-collections__card-body">
                    <h3 class="featured-collections__card-title">R006 Volley Basket</h3>
                    <div class="featured-collections__card-rating">
                        <div class="featured-collections__stars" aria-hidden="true">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <span class="featured-collections__rating-score">4.9</span>
                        <span class="featured-collections__rating-count">(220)</span>
                    </div>
                    <div class="featured-collections__card-price">₹415.00</div>
                    <button type="button" class="featured-collections__card-btn featured-collections__card-btn--view open-product-modal" data-id="r006">
                        View Product
                    </button>
                </div>
            </div>

            <!-- Product Card 6: R001 Volley Handy -->
            <div class="featured-collections__card">
                <div class="featured-collections__card-image-wrap">
                    <img src="{{ asset('images/products/r001.jpg') }}" alt="R001 Volley Handy" class="featured-collections__card-img" loading="lazy">
                    <button type="button" class="featured-collections__wishlist-btn wishlist-toggle" data-id="fc-r001" data-title="R001 Volley Handy" data-price="₹250.00" data-image="{{ asset('images/products/r001.jpg') }}" data-url="{{ route('catalog') }}" aria-label="Add R001 to wishlist">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                    </button>
                </div>
                <div class="featured-collections__card-body">
                    <h3 class="featured-collections__card-title">R001 Volley Handy</h3>
                    <div class="featured-collections__card-rating">
                        <div class="featured-collections__stars" aria-hidden="true">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <span class="featured-collections__rating-score">4.8</span>
                        <span class="featured-collections__rating-count">(216)</span>
                    </div>
                    <div class="featured-collections__card-price">₹250.00</div>
                    <button type="button" class="featured-collections__card-btn featured-collections__card-btn--view open-product-modal" data-id="r001">
                        View Product
                    </button>
                </div>
            </div>

            <!-- Product Card 7: R003 One side (Matki) -->
            <div class="featured-collections__card">
                <div class="featured-collections__card-image-wrap">
                    <img src="{{ asset('images/products/p001.jpg') }}" alt="R003 One side (Matki)" class="featured-collections__card-img" loading="lazy">
                    <button type="button" class="featured-collections__wishlist-btn wishlist-toggle" data-id="fc-r003" data-title="R003 One side (Matki)" data-price="₹360.00" data-image="{{ asset('images/products/p001.jpg') }}" data-url="{{ route('catalog') }}" aria-label="Add R003 to wishlist">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                    </button>
                </div>
                <div class="featured-collections__card-body">
                    <h3 class="featured-collections__card-title">R003 One side (Matki)</h3>
                    <div class="featured-collections__card-rating">
                        <div class="featured-collections__stars" aria-hidden="true">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <span class="featured-collections__rating-score">4.9</span>
                        <span class="featured-collections__rating-count">(184)</span>
                    </div>
                    <div class="featured-collections__card-price">₹360.00</div>
                    <button type="button" class="featured-collections__card-btn featured-collections__card-btn--view open-product-modal" data-id="r003">
                        View Product
                    </button>
                </div>
            </div>

            <!-- Product Card 8: R005 Cross(Matki) -->
            <div class="featured-collections__card">
                <div class="featured-collections__card-image-wrap">
                    <img src="{{ asset('images/products/r005.jpg') }}" alt="R005 Cross(Matki)" class="featured-collections__card-img" loading="lazy">
                    <button type="button" class="featured-collections__wishlist-btn wishlist-toggle" data-id="fc-r005" data-title="R005 Cross(Matki)" data-price="₹360.00" data-image="{{ asset('images/products/r005.jpg') }}" data-url="{{ route('catalog') }}" aria-label="Add R005 to wishlist">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                    </button>
                </div>
                <div class="featured-collections__card-body">
                    <h3 class="featured-collections__card-title">R005 Cross(Matki)</h3>
                    <div class="featured-collections__card-rating">
                        <div class="featured-collections__stars" aria-hidden="true">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <span class="featured-collections__rating-score">4.8</span>
                        <span class="featured-collections__rating-count">(170)</span>
                    </div>
                    <div class="featured-collections__card-price">₹360.00</div>
                    <button type="button" class="featured-collections__card-btn featured-collections__card-btn--view open-product-modal" data-id="r005">
                        View Product
                    </button>
                </div>
            </div>

            <!-- ROW 3 -->
            <!-- Product Card 9: R004 Uneven(Matki) (In column 1 of 4) -->
            <div class="featured-collections__card">
                <div class="featured-collections__card-image-wrap">
                    <img src="{{ asset('images/products/r004.jpg') }}" alt="R004 Uneven(Matki)" class="featured-collections__card-img" loading="lazy">
                    <button type="button" class="featured-collections__wishlist-btn wishlist-toggle" data-id="fc-r004" data-title="R004 Uneven(Matki)" data-price="₹360.00" data-image="{{ asset('images/products/r004.jpg') }}" data-url="{{ route('catalog') }}" aria-label="Add R004 to wishlist">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                    </button>
                </div>
                <div class="featured-collections__card-body">
                    <h3 class="featured-collections__card-title">R004 Uneven(Matki)</h3>
                    <div class="featured-collections__card-rating">
                        <div class="featured-collections__stars" aria-hidden="true">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <span class="featured-collections__rating-score">4.8</span>
                        <span class="featured-collections__rating-count">(195)</span>
                    </div>
                    <div class="featured-collections__card-price">₹360.00</div>
                    <button type="button" class="featured-collections__card-btn featured-collections__card-btn--view open-product-modal" data-id="r004">
                        View Product
                    </button>
                </div>
            </div>

        </div>

        <!-- Centered Bottom CTA Button: Explore All Products -->
        <div class="featured-collections__cta-wrapper">
            <a href="{{ route('catalog') }}" class="featured-collections__cta-btn" id="exploreAllProductsBtn">
                <span>Explore All Products</span>
            </a>
        </div>

    </div>
</section>
