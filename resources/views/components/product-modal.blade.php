{{-- Reusable Luxury Product Detail / Quick View Modal Component --}}
<div id="productDetailModal" class="product-modal" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="modalProductTitle">
    <div class="product-modal__overlay" id="productModalOverlay"></div>
    <div class="product-modal__container">
        <div class="product-modal__dialog">
            
            <!-- Close Button -->
            <button type="button" class="product-modal__close" id="productModalCloseBtn" aria-label="Close product details">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>

            <!-- Modal Content Grid -->
            <div class="product-modal__content">
                
                <!-- Left: Product Image & Gallery -->
                <div class="product-modal__media">
                    <div class="product-modal__img-wrap">
                        <img id="modalProductImage" src="{{ asset('images/products/p001.jpg') }}" alt="Product Image" class="product-modal__img">
                        <span class="product-modal__badge" id="modalProductBadge">Handmade with Love</span>
                    </div>
                </div>

                <!-- Right: Product Information & Actions -->
                <div class="product-modal__info">
                    
                    <div class="product-modal__category-tag" id="modalProductCategory">Handmade Chocolates</div>
                    <h2 class="product-modal__title" id="modalProductTitle">Product Overview</h2>
                    
                    <!-- Rating Bar -->
                    <div class="product-modal__rating">
                        <div class="product-modal__stars" id="modalProductStars" aria-hidden="true">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <span class="product-modal__rating-score" id="modalProductRatingScore">4.8</span>
                        <span class="product-modal__rating-count" id="modalProductRatingCount">(Verified Reviews)</span>
                    </div>

                    <!-- Price Display -->
                    <div class="product-modal__price-box">
                        <span class="product-modal__price-current" id="modalProductCurrentPrice">₹0.00</span>
                    </div>

                    <!-- Stock Status -->
                    <div class="product-modal__stock" id="modalProductStock">
                        <span class="product-modal__stock-dot"></span>
                        <span class="product-modal__stock-text" id="modalProductStockText">In Stock</span>
                    </div>

                    <!-- Description -->
                    <div class="product-modal__description-box">
                        <h4 class="product-modal__section-heading">Description</h4>
                        <p class="product-modal__description" id="modalProductDescription"></p>
                    </div>

                    <!-- Specifications / Key Details -->
                    <div class="product-modal__details-box" id="modalProductDetailsBox">
                        <h4 class="product-modal__section-heading">Key Highlights &amp; Specifications</h4>
                        <ul class="product-modal__details-list" id="modalProductDetailsList"></ul>
                    </div>

                    <!-- Quantity & Actions -->
                    <div class="product-modal__actions">
                        <div class="product-modal__qty-wrap">
                            <label for="modalQtyInput" class="product-modal__qty-label">Quantity</label>
                            <div class="product-modal__qty-ctrl">
                                <button type="button" class="product-modal__qty-btn" id="modalQtyMinus" aria-label="Decrease quantity">&minus;</button>
                                <input type="number" id="modalQtyInput" class="product-modal__qty-input" value="1" min="1" max="99" aria-label="Product quantity">
                                <button type="button" class="product-modal__qty-btn" id="modalQtyPlus" aria-label="Increase quantity">&plus;</button>
                            </div>
                        </div>

                        <div class="product-modal__buttons">
                            <!-- Add To Cart -->
                            <button type="button" class="product-modal__btn product-modal__btn--cart" id="modalAddToCartBtn">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="9" cy="21" r="1"></circle>
                                    <circle cx="20" cy="21" r="1"></circle>
                                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                </svg>
                                <span>Add to Cart</span>
                            </button>

                            <!-- Order on WhatsApp -->
                            <a href="https://wa.me/917490828282" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               class="product-modal__btn product-modal__btn--whatsapp" 
                               id="modalWhatsAppBtn">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.312.045-.634.062-1.025-.067-.323-.106-.743-.243-1.282-.477-2.264-.98-3.738-3.303-3.85-3.454-.113-.15-.92-1.226-.92-2.338 0-1.112.576-1.658.784-1.884.208-.225.454-.282.607-.282.152 0 .304.002.436.009.141.007.33-.053.516.395.191.462.652 1.589.709 1.704.057.115.095.249.019.4-.076.152-.114.247-.227.381-.114.133-.239.297-.341.399-.114.113-.233.236-.101.463.133.227.591.974 1.269 1.577.873.777 1.609 1.018 1.837 1.131.228.113.361.095.494-.057.133-.152.57-.665.722-.893.152-.228.304-.19.516-.114.212.076 1.344.634 1.572.748.228.114.38.171.436.266.057.095.057.55-.087.955z"/>
                                    <path d="M12 2C6.48 2 2 6.48 2 12c0 1.85.5 3.58 1.38 5.07L2 22l5.09-1.33C8.54 21.49 10.22 22 12 22c5.52 0 10-4.48 10-10S17.52 2 12 2zm0 18.2c-1.61 0-3.11-.47-4.38-1.28l-.31-.2-3.03.79.81-2.95-.2-.33C4.03 14.94 3.55 13.51 3.55 12c0-4.66 3.79-8.45 8.45-8.45 4.66 0 8.45 3.79 8.45 8.45 0 4.66-3.79 8.45-8.45 8.45z"/>
                                </svg>
                                <span>Order on WhatsApp</span>
                            </a>
                        </div>
                    </div>


                    <!-- Trust Strip -->
                    <div class="product-modal__trust">
                        <div class="product-modal__trust-item">
                            <span class="trust-icon">🚚</span>
                            <span>Freshly Made on Order</span>
                        </div>
                        <div class="product-modal__trust-item">
                            <span class="trust-icon">🍫</span>
                            <span>100% Vegetarian &amp; Pure</span>
                        </div>
                        <div class="product-modal__trust-item">
                            <span class="trust-icon">💝</span>
                            <span>Custom Gifting Available</span>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<style>
/* ==========================================================================
   Luxury Product Details / Quick View Modal Styles
   ========================================================================== */
.product-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 999999;
    display: none;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.3s ease;
}

.product-modal.is-active {
    display: block;
    opacity: 1;
    visibility: visible;
}

.product-modal__overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(26, 10, 4, 0.75);
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
}

.product-modal__container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    overflow-y: auto;
    box-sizing: border-box;
}

.product-modal__dialog {
    position: relative;
    width: 100%;
    max-width: 900px;
    max-height: 90vh;
    background: #FFFFFF;
    border-radius: 20px;
    border: 1px solid rgba(217, 154, 43, 0.3);
    box-shadow: 0 25px 60px -15px rgba(42, 15, 5, 0.35), 0 0 0 1px rgba(255, 255, 255, 0.8) inset;
    overflow-y: auto;
    transform: scale(0.94) translateY(20px);
    transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    box-sizing: border-box;
}

.product-modal.is-active .product-modal__dialog {
    transform: scale(1) translateY(0);
}

/* Close Button */
.product-modal__close {
    position: absolute;
    top: 16px;
    right: 16px;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: #F7EFE6;
    border: 1px solid rgba(74, 29, 11, 0.1);
    color: #4A1D0B;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 10;
    transition: all 0.2s ease;
}

.product-modal__close:hover {
    background: #4A1D0B;
    color: #FFF;
    transform: rotate(90deg);
}

/* Content Grid */
.product-modal__content {
    display: grid;
    grid-template-columns: 1fr 1.25fr;
    gap: 32px;
    padding: 32px;
}

@media (max-width: 768px) {
    .product-modal__content {
        grid-template-columns: 1fr;
        gap: 20px;
        padding: 24px 20px;
    }
}

/* Media (Left) */
.product-modal__media {
    display: flex;
    flex-direction: column;
}

.product-modal__img-wrap {
    position: relative;
    width: 100%;
    aspect-ratio: 1 / 1;
    border-radius: 16px;
    overflow: hidden;
    background: #FFF8EE;
    border: 1px solid rgba(217, 154, 43, 0.2);
    box-shadow: 0 8px 24px rgba(74, 29, 11, 0.08);
}

.product-modal__img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.product-modal__img-wrap:hover .product-modal__img {
    transform: scale(1.05);
}

.product-modal__badge {
    position: absolute;
    top: 14px;
    left: 14px;
    background: linear-gradient(135deg, #D99A2B 0%, #B87E18 100%);
    color: #FFFFFF;
    font-size: 11.5px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 20px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 10px rgba(217, 154, 43, 0.35);
}

/* Info (Right) */
.product-modal__info {
    display: flex;
    flex-direction: column;
}

.product-modal__category-tag {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #D99A2B;
    margin-bottom: 6px;
}

.product-modal__title {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 26px;
    font-weight: 700;
    color: #2A0F05;
    line-height: 1.25;
    margin: 0 0 10px 0;
}

/* Rating */
.product-modal__rating {
    display: flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 14px;
}

.product-modal__stars {
    color: #F5A623;
    font-size: 15px;
    letter-spacing: 1px;
}

.product-modal__rating-score {
    font-weight: 700;
    font-size: 13.5px;
    color: #2A0F05;
}

.product-modal__rating-count {
    font-size: 12.5px;
    color: #777777;
}

/* Price Box */
.product-modal__price-box {
    display: flex;
    align-items: baseline;
    gap: 12px;
    margin-bottom: 12px;
    flex-wrap: wrap;
}

.product-modal__price-current {
    font-family: 'Outfit', sans-serif;
    font-size: 26px;
    font-weight: 700;
    color: #4A1D0B;
}

/* Stock Status */
.product-modal__stock {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    font-weight: 600;
    color: #2E7D32;
    margin-bottom: 16px;
}

.product-modal__stock-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #2E7D32;
    box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.2);
}

.product-modal__stock.out-of-stock {
    color: #C62828;
}

.product-modal__stock.out-of-stock .product-modal__stock-dot {
    background: #C62828;
    box-shadow: 0 0 0 3px rgba(198, 40, 40, 0.2);
}

/* Section Headings */
.product-modal__section-heading {
    font-size: 13.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: #4A1D0B;
    margin: 0 0 8px 0;
    border-bottom: 1px dashed rgba(217, 154, 43, 0.3);
    padding-bottom: 4px;
}

/* Description */
.product-modal__description-box {
    margin-bottom: 16px;
}

.product-modal__description {
    font-size: 14px;
    line-height: 1.6;
    color: #4B403B;
    margin: 0;
}

/* Details List */
.product-modal__details-box {
    margin-bottom: 20px;
}

.product-modal__details-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px 12px;
}

@media (max-width: 540px) {
    .product-modal__details-list {
        grid-template-columns: 1fr;
    }
}

.product-modal__details-list li {
    font-size: 13.5px;
    color: #333333;
    display: flex;
    align-items: center;
    gap: 8px;
    background: #FFFDF9;
    padding: 6px 10px;
    border-radius: 8px;
    border: 1px solid rgba(217, 154, 43, 0.15);
}

.product-modal__details-list .detail-icon {
    font-size: 15px;
    flex-shrink: 0;
}

/* Quantity & Buttons */
.product-modal__actions {
    display: flex;
    flex-direction: column;
    gap: 14px;
    padding-top: 10px;
    border-top: 1px solid rgba(0, 0, 0, 0.06);
    margin-bottom: 18px;
}

.product-modal__qty-wrap {
    display: flex;
    align-items: center;
    gap: 12px;
}

.product-modal__qty-label {
    font-size: 13px;
    font-weight: 600;
    color: #4A1D0B;
}

.product-modal__qty-ctrl {
    display: inline-flex;
    align-items: center;
    border: 1.5px solid #D99A2B;
    border-radius: 8px;
    overflow: hidden;
    background: #FFF;
}

.product-modal__qty-btn {
    width: 32px;
    height: 32px;
    background: #FFF8EE;
    border: none;
    font-size: 16px;
    font-weight: 700;
    color: #4A1D0B;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s;
}

.product-modal__qty-btn:hover {
    background: #D99A2B;
    color: #FFF;
}

.product-modal__qty-input {
    width: 44px;
    height: 32px;
    text-align: center;
    border: none;
    font-size: 14px;
    font-weight: 700;
    color: #2A0F05;
    outline: none;
    background: #FFF;
    -moz-appearance: textfield;
}

.product-modal__qty-input::-webkit-outer-spin-button,
.product-modal__qty-input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.product-modal__buttons {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
}

@media (max-width: 500px) {
    .product-modal__buttons {
        grid-template-columns: 1fr;
    }
}

.product-modal__btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 18px;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.25s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.product-modal__btn--cart {
    background: linear-gradient(135deg, #4A1D0B 0%, #2A0F05 100%);
    color: #FFECC7;
    border: 1px solid rgba(217, 154, 43, 0.4);
}

.product-modal__btn--cart:hover {
    background: linear-gradient(135deg, #D99A2B 0%, #B87E18 100%);
    color: #FFF;
    border-color: #D99A2B;
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(217, 154, 43, 0.35);
}

.product-modal__btn--whatsapp {
    background: #25D366;
    color: #FFFFFF;
}

.product-modal__btn--whatsapp:hover {
    background: #1EBE5D;
    color: #FFFFFF;
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(37, 211, 102, 0.4);
}

/* Trust Badges */
.product-modal__trust {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    background: #FFF9F2;
    padding: 12px 14px;
    border-radius: 10px;
    border: 1px solid rgba(217, 154, 43, 0.2);
}

.product-modal__trust-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    font-weight: 600;
    color: #4A1D0B;
}

.product-modal__trust-item .trust-icon {
    font-size: 14px;
}

@media (max-width: 600px) {
    .product-modal__trust {
        flex-direction: column;
        gap: 6px;
    }
}
</style>

<script>
// ==========================================================================
// Product Quick View Modal Engine
// ==========================================================================
(function() {
    const productCache = {};

    const modal = document.getElementById('productDetailModal');
    const overlay = document.getElementById('productModalOverlay');
    const closeBtn = document.getElementById('productModalCloseBtn');

    const elImg = document.getElementById('modalProductImage');
    const elBadge = document.getElementById('modalProductBadge');
    const elCategory = document.getElementById('modalProductCategory');
    const elTitle = document.getElementById('modalProductTitle');
    const elRatingScore = document.getElementById('modalProductRatingScore');
    const elRatingCount = document.getElementById('modalProductRatingCount');
    const elPriceCurrent = document.getElementById('modalProductCurrentPrice');
    const elStock = document.getElementById('modalProductStock');
    const elStockText = document.getElementById('modalProductStockText');
    const elDesc = document.getElementById('modalProductDescription');
    const elDetailsList = document.getElementById('modalProductDetailsList');
    const elQty = document.getElementById('modalQtyInput');
    const btnMinus = document.getElementById('modalQtyMinus');
    const btnPlus = document.getElementById('modalQtyPlus');
    const btnAddToCart = document.getElementById('modalAddToCartBtn');
    const btnWhatsApp = document.getElementById('modalWhatsAppBtn');

    let currentProduct = null;

    function openModal(productId, triggerEl = null) {
        if (!modal) return;
        let rawId = String(productId || 'p001').trim().toLowerCase();
        let cleanId = rawId.startsWith('fc-') ? rawId.substring(3) : rawId;

        // 1. Instant Cache Lookup (Synchronous, 0ms latency)
        if (productCache[cleanId]) {
            currentProduct = productCache[cleanId];
            populateModal(currentProduct);
            showModal();
            return;
        }

        if (productCache[rawId]) {
            currentProduct = productCache[rawId];
            populateModal(currentProduct);
            showModal();
            return;
        }

        // 2. Fetch from API with fallback
        fetch(`/api/products/${cleanId}`)
            .then(res => {
                if (!res.ok) throw new Error('Product not found in API');
                return res.json();
            })
            .then(data => {
                productCache[cleanId] = data;
                productCache[rawId] = data;
                currentProduct = data;
                populateModal(data);
                showModal();
            })
            .catch(err => {
                console.warn('Direct API fallback triggered for:', cleanId, err);
                
                // Fallback using trigger element attributes
                const fallbackProduct = {
                    id: cleanId,
                    title: triggerEl ? (triggerEl.getAttribute('data-title') || triggerEl.closest('.featured-collections__card, .best-sellers__card, .best-collections__card, .na-card')?.querySelector('h3, h2, .na-card__title')?.textContent?.trim()) : 'Chocolate Gift',
                    price: triggerEl ? (parseFloat(triggerEl.getAttribute('data-price')?.replace(/[^0-9.]/g, '')) || 250.00) : 250.00,
                    rating: 4.8,
                    rating_count: 216,
                    image: triggerEl?.getAttribute('data-image') || 'images/products/p001.jpg',
                    category: 'Handmade Chocolates',
                    in_stock: true,
                    description: 'Indulge in our exquisite assortment of artisan chocolates handcrafted with premium ingredients for your special occasions.',
                    details: [
                        'Artisan handcrafted chocolate gift',
                        'Made fresh with premium ingredients',
                        'Customizable chocolates, colors & presentation',
                        'Ideal for birthdays, anniversaries & celebrations'
                    ]
                };

                currentProduct = fallbackProduct;
                populateModal(fallbackProduct);
                showModal();
            });
    }

    function showModal() {
        modal.classList.add('is-active');
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        if (!modal) return;
        modal.classList.remove('is-active');
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    function populateModal(p) {
        const assetBase = "{{ asset('') }}";
        const imgPath = (p.image && p.image.startsWith('http')) 
            ? p.image 
            : (assetBase + (p.image || 'images/products/p001.jpg'));
            
        if (elImg) {
            elImg.src = imgPath;
            elImg.alt = p.title || 'Chocolate Gift';
        }

        if (elTitle) elTitle.textContent = p.title || 'Handmade Chocolate';
        if (elCategory) elCategory.textContent = (p.category || 'Handmade Chocolates').toUpperCase();

        if (elRatingScore) elRatingScore.textContent = Number(p.rating || 4.8).toFixed(1);
        if (elRatingCount) elRatingCount.textContent = `(${p.rating_count || 216} verified reviews)`;

        const price = Number(p.price || 0);
        if (elPriceCurrent) elPriceCurrent.textContent = `₹${price.toFixed(2)}`;

        if (elStock && elStockText) {
            if (p.in_stock !== false) {
                elStock.classList.remove('out-of-stock');
                elStockText.textContent = 'In Stock & Ready to Ship';
            } else {
                elStock.classList.add('out-of-stock');
                elStockText.textContent = 'Out of Stock';
            }
        }

        if (elDesc) {
            elDesc.textContent = p.description || "Indulge in our exquisite assortment of artisan chocolates handcrafted with premium ingredients for your special occasions.";
        }

        if (elDetailsList) {
            elDetailsList.innerHTML = '';
            const details = Array.isArray(p.details) && p.details.length > 0 ? p.details : [
                'Artisan handcrafted chocolate gift pack',
                'Contains premium assorted chocolates',
                'Customizable chocolates & presentation',
                'Ideal for birthdays, anniversaries & festivals'
            ];

            const icons = ['🎁', '🍫', '🌹', '✨', '📐', '⚖️', '💝', '✨'];
            details.forEach((item, idx) => {
                const li = document.createElement('li');
                const icon = icons[idx % icons.length];
                li.innerHTML = `<span class="detail-icon">${icon}</span> <span>${item}</span>`;
                elDetailsList.appendChild(li);
            });
        }

        if (elQty) elQty.value = '1';

        updateWhatsAppLink(p, 1);
    }

    function updateWhatsAppLink(p, qty) {
        if (!btnWhatsApp || !p) return;
        const total = (Number(p.price || 170) * qty).toFixed(2);
        const msg = encodeURIComponent(`Hi Ruchi Chocolates, I would like to order ${qty}x ${p.title} (Total: ₹${total}). Please provide details for ordering.`);
        btnWhatsApp.href = `https://wa.me/917490828282?text=${msg}`;
    }

    // Quantity controls
    if (btnMinus && elQty) {
        btnMinus.addEventListener('click', function() {
            let val = parseInt(elQty.value, 10) || 1;
            if (val > 1) {
                elQty.value = val - 1;
                if (currentProduct) updateWhatsAppLink(currentProduct, val - 1);
            }
        });
    }

    if (btnPlus && elQty) {
        btnPlus.addEventListener('click', function() {
            let val = parseInt(elQty.value, 10) || 1;
            if (val < 99) {
                elQty.value = val + 1;
                if (currentProduct) updateWhatsAppLink(currentProduct, val + 1);
            }
        });
    }

    if (elQty) {
        elQty.addEventListener('change', function() {
            let val = Math.max(1, Math.min(99, parseInt(elQty.value, 10) || 1));
            elQty.value = val;
            if (currentProduct) updateWhatsAppLink(currentProduct, val);
        });
    }

    // Add to cart click
    if (btnAddToCart) {
        btnAddToCart.addEventListener('click', function() {
            if (!currentProduct) return;
            const qty = parseInt(elQty ? elQty.value : 1, 10) || 1;
            
            // Visual feedback
            const origHTML = btnAddToCart.innerHTML;
            btnAddToCart.innerHTML = `<span>✓ Added ${qty} to Cart!</span>`;
            btnAddToCart.style.background = '#2E7D32';
            btnAddToCart.style.color = '#FFFFFF';

            // Trigger header cart badge increment
            const cartCountBadge = document.querySelector('.rc-cart-count, .cart-count, #cartCount');
            if (cartCountBadge) {
                let count = parseInt(cartCountBadge.textContent, 10) || 0;
                cartCountBadge.textContent = count + qty;
                cartCountBadge.style.display = 'inline-flex';
            }

            setTimeout(() => {
                btnAddToCart.innerHTML = origHTML;
                btnAddToCart.style.background = '';
                btnAddToCart.style.color = '';
            }, 1800);
        });
    }

    // Event listeners for close
    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    if (overlay) overlay.addEventListener('click', closeModal);
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal && modal.classList.contains('is-active')) {
            closeModal();
        }
    });

    // Delegate open clicks for any View Product button or trigger across the entire site
    document.addEventListener('click', function(e) {
        const trigger = e.target.closest(
            '.open-product-modal, ' +
            '[data-open-modal], ' +
            '.best-sellers__card-btn, ' +
            '.best-sellers__card-btn--view, ' +
            '.featured-collections__card-btn, ' +
            '.featured-collections__card-btn--view, ' +
            '.best-collections__card-btn, ' +
            '.best-collections__card-btn--view, ' +
            '.na-card__btn, ' +
            '.na-card__btn--view'
        );

        if (trigger) {
            e.preventDefault();
            const prodId = trigger.getAttribute('data-id') || 
                           trigger.getAttribute('data-product-id') || 
                           'p001';
            openModal(prodId, trigger);
        }
    });

    // Expose globally for programmatic triggers
    window.rcOpenProductModal = openModal;
    window.rcCloseProductModal = closeModal;
})();
</script>
