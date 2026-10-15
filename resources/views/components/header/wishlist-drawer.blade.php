{{-- WISHLIST DRAWER GLOBAL HTML --}}
<div class="custom-wishlist-drawer" id="customWishlistDrawer" aria-hidden="true">
    <div class="custom-wishlist-drawer__overlay" id="customWishlistDrawerOverlay"></div>
    <div class="custom-wishlist-drawer__content">
        
        <!-- Drawer Header -->
        <div class="custom-wishlist-drawer__header">
            <div class="custom-wishlist-drawer__header-title">
                <h3 class="custom-wishlist-drawer__title">My Wishlist <span class="custom-wishlist-drawer__heart-icon">❤️</span></h3>
                <span class="custom-wishlist-drawer__count" id="wishlistDrawerCount">0 Items</span>
            </div>
            <button class="custom-wishlist-drawer__close" id="customWishlistDrawerClose" aria-label="Close Wishlist Drawer">✕</button>
        </div>

        <!-- Drawer Body -->
        <div class="custom-wishlist-drawer__body" id="wishlistDrawerBody">
            <!-- Injected dynamically via JS -->
        </div>

        <!-- Drawer Footer -->
        <div class="custom-wishlist-drawer__footer">
            <div class="custom-wishlist-drawer__total-row">
                <span>Total (<span id="wishlistFooterCount">0</span> Items)</span>
                <div class="custom-wishlist-drawer__total-pricing">
                    <span class="custom-wishlist-drawer__total-price" id="wishlistDrawerTotalPrice">₹0</span>
                    <span class="custom-wishlist-drawer__total-compare" id="wishlistDrawerTotalComparePrice"></span>
                </div>
            </div>
            
            <div class="custom-wishlist-drawer__actions">
                <a href="{{ route('wishlist') }}" class="custom-wishlist-drawer__btn custom-wishlist-drawer__btn--outline">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                    </svg>
                    View Wishlist
                </a>
                <button class="custom-wishlist-drawer__btn custom-wishlist-drawer__btn--solid" id="wishlistMoveAllToCart">
                    Move All to Cart
                </button>
            </div>

            <!-- Trust Badges -->
            <div class="custom-wishlist-drawer__trust-badges">
                <div class="custom-wishlist-drawer__trust-item">
                    <span>📦 Secure Packaging</span>
                </div>
                <div class="custom-wishlist-drawer__trust-item">
                    <span>🚚 Pan India Delivery</span>
                </div>
                <div class="custom-wishlist-drawer__trust-item">
                    <span>🛡️ 100% Quality Assured</span>
                </div>
            </div>
        </div>

    </div>
</div>
