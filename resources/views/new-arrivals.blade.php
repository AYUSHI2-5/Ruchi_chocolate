@extends('layouts.app')

@section('title', 'Products | New Arrivals — Ruchi Chocolates')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/new-arrivals.css') }}">
@endpush

@section('content')
<div class="new-arrivals-page">
    
    <!-- Hero Section: Ruchi Chocolates Luxury Products Hero Banner -->
    <section class="products-hero" aria-label="Our Products Hero Banner">
        <div class="products-hero__inner">
            <!-- Left Column: Typography & Content -->
            <div class="products-hero__content">
                <!-- 1. Breadcrumb Navigation -->
                <nav class="na-breadcrumb products-hero__breadcrumb" aria-label="Breadcrumb">
                    <ol class="na-breadcrumb__list">
                        <li class="na-breadcrumb__item">
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="na-breadcrumb__separator" aria-hidden="true">&gt;</li>
                        <li class="na-breadcrumb__item na-breadcrumb__item--active" aria-current="page">
                            Our Products
                        </li>
                    </ol>
                </nav>

                <!-- 2. Small Eyebrow Text with Decorative Accents -->
                <div class="products-hero__eyebrow-wrap">
                    <span class="products-hero__eyebrow-line"></span>
                    <span class="products-hero__eyebrow-heart" aria-hidden="true">♥</span>
                    <span class="products-hero__eyebrow">HANDMADE WITH LOVE</span>
                    <span class="products-hero__eyebrow-heart" aria-hidden="true">♥</span>
                    <span class="products-hero__eyebrow-line"></span>
                </div>

                <!-- 3. Main Heading (H1) -->
                <h1 class="products-hero__title">
                    Discover Our
                    <span class="products-hero__title-italic">Chocolate Collection</span>
                </h1>

                <!-- 4. Thin Golden Divider Line -->
                <div class="products-hero__divider" aria-hidden="true">
                    <span class="products-hero__divider-diamond">✦</span>
                </div>

                <!-- 5. Subheading -->
                <p class="products-hero__subtitle">
                    Explore our handcrafted chocolates, delightful gift hampers, and beautiful chocolate bouquets for every special occasion.
                </p>

                <!-- 6. CTA Button -->
                <div class="products-hero__actions">
                    <a href="#productsCatalog" class="products-hero__cta-btn" id="exploreAllProductsBtn">
                        <span>Explore All Products</span>
                        <span class="products-hero__cta-arrow" aria-hidden="true">&rarr;</span>
                    </a>
                </div>
            </div>

            <!-- Right Column: Premium Hamper Photograph -->
            <div class="products-hero__visual">
                <div class="products-hero__image-wrapper">
                    <img 
                        src="{{ asset('images/products-hero-hamper.jpg') }}" 
                        alt="Handcrafted Chocolate Gift Hamper with Assorted Truffles and Gold Ribbon — Ruchi Chocolates" 
                        class="products-hero__image"
                        loading="eager"
                    >
                    <div class="products-hero__badge">
                        <span class="products-hero__badge-icon">✨</span>
                        <span class="products-hero__badge-text">Handcrafted with Love</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="na-container" id="productsCatalog">
        
        <!-- Accessible Page Header: Title & Description for SEO & Test Compatibility -->
        <div class="na-header visually-hidden">
            <h2 class="na-header__title">Products</h2>
            <p class="na-header__description">Explore our wide range of handmade chocolates &amp; gifts.</p>
        </div>

        <!-- Mobile Filter Toggle Button -->
        <button type="button" class="na-mobile-filter-btn" id="naMobileFilterToggle" aria-expanded="false" aria-controls="naFilterSidebar">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="4" y1="21" x2="4" y2="14"></line>
                <line x1="4" y1="10" x2="4" y2="3"></line>
                <line x1="12" y1="21" x2="12" y2="12"></line>
                <line x1="12" y1="8" x2="12" y2="3"></line>
                <line x1="20" y1="21" x2="20" y2="16"></line>
                <line x1="20" y1="12" x2="20" y2="3"></line>
                <line x1="1" y1="14" x2="7" y2="14"></line>
                <line x1="9" y1="8" x2="15" y2="8"></line>
                <line x1="17" y1="16" x2="23" y2="16"></line>
            </svg>
            <span>Filters &amp; Categories</span>
        </button>

        <!-- 3. Main 2-Column Layout: Sidebar + Product Grid -->
        <div class="na-layout">
             <!-- LEFT COLUMN: Filter Sidebar -->
            <aside class="na-sidebar" id="naFilterSidebar" aria-label="Product Filters">
                <!-- Filter Section: Categories -->
                <div class="na-sidebar__section">
                    <div class="na-sidebar__main-header">
                        <span class="na-sidebar__title">Categories</span>
                        @if($activeSubcategory)
                            <a href="{{ route('new-arrivals', array_merge(request()->except(['category', 'occasion']), ['page' => 1])) }}#productsCatalog" class="na-sidebar__clear-link" title="Clear category filter">Clear</a>
                        @endif
                    </div>
                    
                    <div class="na-category-groups" id="naCategoryGroups">
                        @foreach($mainCategorySections as $sec)
                            @if(!empty($sec['is_dropdown']))
                                @php
                                    $groupHasActive = false;
                                    foreach ($sec['subcategories'] as $sub) {
                                        if ($activeSubcategory === $sub['slug'] ||
                                            ($sub['slug'] === 'rakhi' && $activeSubcategory === 'raksha-bandhan') ||
                                            ($sub['slug'] === 'ring-ceremony' && $activeSubcategory === 'engagement') ||
                                            ($sub['slug'] === 'valentine' && in_array($activeSubcategory, ['valentine', 'valentines-day']))) {
                                            $groupHasActive = true;
                                            break;
                                        }
                                    }
                                @endphp
                                <div class="na-category-group" data-group="{{ $sec['slug'] }}">
                                    <button type="button" 
                                            class="na-category-group__header" 
                                            data-toggle="category-group" 
                                            data-target="#catgroup-{{ $sec['slug'] }}" 
                                            aria-expanded="{{ $groupHasActive ? 'true' : 'false' }}"
                                            onclick="toggleCategoryGroup(this)">
                                        <span class="na-category-group__title">
                                            <span class="na-category-group__icon" aria-hidden="true">{{ $sec['icon'] }}</span>
                                            <span class="na-category-group__name">{{ $sec['name'] }}</span>
                                        </span>
                                        <svg class="na-category-group__chevron {{ $groupHasActive ? '' : 'collapsed' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </button>
                                    
                                    <div class="na-category-group__content {{ $groupHasActive ? '' : 'is-collapsed' }}" 
                                         id="catgroup-{{ $sec['slug'] }}"
                                         style="{{ $groupHasActive ? '' : 'display: none;' }}">
                                        <ul class="na-subcategory-list">
                                            @foreach($sec['subcategories'] as $sub)
                                                @php
                                                    $isSubActive = ($activeSubcategory === $sub['slug']) || 
                                                                   ($sub['slug'] === 'rakhi' && $activeSubcategory === 'raksha-bandhan') ||
                                                                   ($sub['slug'] === 'ring-ceremony' && $activeSubcategory === 'engagement') ||
                                                                   ($sub['slug'] === 'valentine' && in_array($activeSubcategory, ['valentine', 'valentines-day']));
                                                    $targetUrl = $isSubActive
                                                        ? route('new-arrivals', array_merge(request()->except(['category', 'occasion']), ['page' => 1]))
                                                        : route('new-arrivals', array_merge(request()->except(['category', 'occasion']), ['category' => $sub['slug'], 'page' => 1]));
                                                @endphp
                                                <li class="na-subcategory-item">
                                                    <a href="{{ $targetUrl }}#productsCatalog" 
                                                       class="na-subcategory-link {{ $isSubActive ? 'active' : '' }} @if(!empty($sub['coming_soon'])) na-subcategory-link--soon @endif"
                                                       data-subcategory="{{ $sub['slug'] }}"
                                                       @if(!empty($sub['coming_soon'])) data-coming-soon="true" @endif>
                                                        <span class="na-subcategory-name">{{ $sub['name'] }}</span>
                                                        @if(!empty($sub['coming_soon']))
                                                            <span class="na-subcategory-soon-badge">Soon</span>
                                                        @else
                                                            <span class="na-subcategory-count">({{ $sub['count'] }})</span>
                                                        @endif
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @else
                                {{-- Gifting: Simple Clickable Category Row (No Dropdown Arrow, No Dropdown List) --}}
                                @php
                                    $isGiftingActive = $activeSubcategory === $sec['slug'];
                                    $giftingUrl = $isGiftingActive
                                        ? route('new-arrivals', array_merge(request()->except(['category', 'occasion']), ['page' => 1]))
                                        : route('new-arrivals', array_merge(request()->except(['category', 'occasion']), ['category' => $sec['slug'], 'page' => 1]));
                                @endphp
                                <div class="na-category-group na-category-group--direct {{ $isGiftingActive ? 'active' : '' }}" data-group="{{ $sec['slug'] }}">
                                    <a href="{{ $giftingUrl }}#productsCatalog" 
                                       class="na-category-direct-link {{ $isGiftingActive ? 'active' : '' }}"
                                       data-category="{{ $sec['slug'] }}">
                                        <span class="na-category-group__title">
                                            <span class="na-category-group__icon" aria-hidden="true">{{ $sec['icon'] }}</span>
                                            <span class="na-category-group__name">{{ $sec['name'] }}</span>
                                        </span>
                                        @if(isset($sec['count']))
                                            <span class="na-category-direct-count">({{ $sec['count'] }})</span>
                                        @endif
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Clear Filters Action Button -->
                @if($activeSubcategory)
                    <a href="{{ route('new-arrivals') }}#productsCatalog" class="na-clear-btn" id="naClearFiltersBtn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <polyline points="1 4 1 10 7 10"></polyline>
                            <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path>
                        </svg>
                        <span>Clear Filters</span>
                    </a>
                @endif
            </aside>

            <!-- RIGHT COLUMN: Product Area (Toolbar + 4-Column Grid + Pagination) -->
            <main class="na-main-products">

                @if(!empty($comingSoonFestivalName))
                    <div class="na-coming-soon-notice" role="status" aria-live="polite">
                        <span class="na-coming-soon-notice__icon" aria-hidden="true">🎉</span>
                        <div class="na-coming-soon-notice__body">
                            <p class="na-coming-soon-notice__title">{{ $comingSoonFestivalName }} collection — Coming Soon</p>
                            <p class="na-coming-soon-notice__text">
                                We are preparing special {{ $comingSoonFestivalName }} chocolates and gift hampers. Check back soon, or enquire on WhatsApp for custom festive orders.
                            </p>
                            <a href="{{ config('ruchi.whatsapp_url') }}?text={{ rawurlencode('Hi Ruchi Chocolates, I would like to enquire about '.$comingSoonFestivalName.' gifting.') }}"
                               class="na-coming-soon-notice__cta"
                               target="_blank"
                               rel="noopener noreferrer">
                                Enquire on WhatsApp
                            </a>
                        </div>
                    </div>
                @endif
                
                <!-- Product Toolbar: Count + Sort Dropdown + Grid/List Controls -->
                <div class="na-toolbar">
                    <div class="na-toolbar__count">
                        <strong id="naToolbarCountNumber">{{ $filteredCount ?? $totalItemsCount ?? 34 }}</strong> Items
                    </div>
                    <div class="na-toolbar__controls">
                        <div class="na-sort-wrap">
                            <label for="naSortSelect">Sort by:</label>
                            <select id="naSortSelect" class="na-sort-select" onchange="window.location.href = this.value">
                                <option value="{{ route('new-arrivals', array_merge(request()->query(), ['sort' => 'featured', 'page' => 1])) }}" {{ $sort === 'featured' ? 'selected' : '' }}>Featured</option>
                                <option value="{{ route('new-arrivals', array_merge(request()->query(), ['sort' => 'price_low_high', 'page' => 1])) }}" {{ $sort === 'price_low_high' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="{{ route('new-arrivals', array_merge(request()->query(), ['sort' => 'price_high_low', 'page' => 1])) }}" {{ $sort === 'price_high_low' ? 'selected' : '' }}>Price: High to Low</option>
                                <option value="{{ route('new-arrivals', array_merge(request()->query(), ['sort' => 'rating', 'page' => 1])) }}" {{ $sort === 'rating' ? 'selected' : '' }}>Customer Rating</option>
                                <option value="{{ route('new-arrivals', array_merge(request()->query(), ['sort' => 'newest', 'page' => 1])) }}" {{ $sort === 'newest' ? 'selected' : '' }}>Newest</option>
                            </select>
                        </div>
                        <div class="na-view-toggle" role="group" aria-label="Product display view">
                            <button type="button" class="na-view-btn active" id="naGridViewBtn" aria-label="Grid View" title="4-Column Grid View">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
                                    <rect x="3" y="3" width="7" height="7" rx="1"></rect>
                                    <rect x="14" y="3" width="7" height="7" rx="1"></rect>
                                    <rect x="3" y="14" width="7" height="7" rx="1"></rect>
                                    <rect x="14" y="14" width="7" height="7" rx="1"></rect>
                                </svg>
                            </button>
                            <button type="button" class="na-view-btn" id="naListViewBtn" aria-label="List View" title="List View">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
                                    <rect x="3" y="4" width="18" height="4" rx="1"></rect>
                                    <rect x="3" y="10" width="18" height="4" rx="1"></rect>
                                    <rect x="3" y="16" width="18" height="4" rx="1"></rect>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- 4-Column Product Grid -->
                <div class="na-product-grid" id="naProductGrid">
                    @forelse($products as $product)
                        <article class="na-card" data-id="{{ $product['id'] }}" data-category="{{ $product['category'] }}" data-price="{{ $product['price'] }}" data-rating="{{ $product['rating'] }}">
                            
                            <!-- Product Image & Top-Right Wishlist Button -->
                            <div class="na-card__img-wrap">
                                <img src="{{ asset($product['image']) }}" 
                                     alt="{{ $product['title'] }}" 
                                     class="na-card__img" 
                                     loading="lazy">
                                
                                <button type="button" 
                                        class="na-card__wishlist-btn wishlist-toggle" 
                                        data-id="{{ $product['id'] }}" 
                                        data-title="{{ $product['title'] }}" 
                                        data-price="₹{{ number_format($product['price'], 2) }}" 
                                        data-image="{{ asset($product['image']) }}" 
                                        data-url="{{ route('new-arrivals') }}" 
                                        aria-label="Add {{ $product['title'] }} to wishlist">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                    </svg>
                                </button>
                            </div>

                            <!-- Product Details Body -->
                            <div class="na-card__body">
                                <h3 class="na-card__title" title="{{ $product['title'] }}">{{ $product['title'] }}</h3>
                                
                                <div class="na-card__rating">
                                    <div class="na-card__stars" aria-hidden="true">
                                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                    </div>
                                    <span class="na-card__rating-score">{{ number_format($product['rating'], 1) }}</span>
                                    <span class="na-card__rating-count">({{ $product['rating_count'] }})</span>
                                </div>

                                <div class="na-card__price">₹{{ number_format($product['price'], 2) }}</div>

                                <!-- Action Button: View Product -->
                                <button type="button" class="na-card__btn na-card__btn--view open-product-modal" data-id="{{ $product['id'] }}">
                                    View Product
                                </button>
                            </div>

                        </article>
                    @empty
                        @if(empty($comingSoonFestivalName))
                            <div class="na-empty-state">
                                <h3>No Products Found</h3>
                                <p>No products match your selected filters. Try clearing some filters to see more chocolates.</p>
                                <a href="{{ route('new-arrivals') }}" class="na-clear-btn" style="max-width: 200px; margin: 0 auto;">Reset All Filters</a>
                            </div>
                        @endif
                    @endforelse
                </div>

                @if(!empty($categoryFilterDisplayName))
                    <p class="na-collection-more-soon" role="status">
                        Many more {{ $categoryFilterDisplayName }} chocolates, hampers &amp; gift ideas coming soon — watch this space!
                    </p>
                @endif

                <!-- 7. Centered Pagination -->
                @if($totalPages > 1)
                    <nav class="na-pagination" id="naPagination" aria-label="Products pagination">
                        {{-- Previous Page Button --}}
                        @if($currentPage > 1)
                            <a href="{{ route('new-arrivals', array_merge(request()->query(), ['page' => $currentPage - 1])) }}" 
                               class="na-page-link na-page-link--prev" 
                               aria-label="Previous Page">
                                <span aria-hidden="true">&larr;</span>
                                <span>Previous</span>
                            </a>
                        @else
                            <span class="na-page-link na-page-link--prev na-page-link--disabled" 
                                  aria-disabled="true" 
                                  aria-label="Previous Page (Disabled)">
                                <span aria-hidden="true">&larr;</span>
                                <span>Previous</span>
                            </span>
                        @endif

                        {{-- Page Number Links --}}
                        @for($p = 1; $p <= $totalPages; $p++)
                            <a href="{{ route('new-arrivals', array_merge(request()->query(), ['page' => $p])) }}" 
                               class="na-page-link na-page-number {{ $currentPage == $p ? 'active' : '' }}" 
                               aria-label="Page {{ $p }}"
                               {{ $currentPage == $p ? 'aria-current="page"' : '' }}>
                                {{ $p }}
                            </a>
                        @endfor

                        {{-- Next Page Button --}}
                        @if($currentPage < $totalPages)
                            <a href="{{ route('new-arrivals', array_merge(request()->query(), ['page' => $currentPage + 1])) }}" 
                               class="na-page-link na-page-link--next" 
                               aria-label="Next Page">
                                <span>Next</span>
                                <span aria-hidden="true">&rarr;</span>
                            </a>
                        @else
                            <span class="na-page-link na-page-link--next na-page-link--disabled" 
                                  aria-disabled="true" 
                                  aria-label="Next Page (Disabled)">
                                <span>Next</span>
                                <span aria-hidden="true">&rarr;</span>
                            </span>
                        @endif
                    </nav>
                @endif

            </main>

        </div>

    </div>
</div>

<!-- Floating WhatsApp Chat Action Component -->
@include('components.home.whatsapp-button')
@endsection

@push('scripts')
<script>
    function toggleCategoryGroup(btn) {
        if (!btn) return;
        const targetId = btn.getAttribute('data-target');
        const targetEl = document.querySelector(targetId);
        const chevron = btn.querySelector('.na-category-group__chevron');
        
        if (targetEl) {
            const isExpanded = btn.getAttribute('aria-expanded') === 'true';
            if (isExpanded) {
                targetEl.style.display = 'none';
                targetEl.classList.add('is-collapsed');
                btn.setAttribute('aria-expanded', 'false');
                if (chevron) chevron.classList.add('collapsed');
            } else {
                targetEl.style.display = 'block';
                targetEl.classList.remove('is-collapsed');
                btn.setAttribute('aria-expanded', 'true');
                if (chevron) chevron.classList.remove('collapsed');
            }
        }
    }
    window.toggleCategoryGroup = toggleCategoryGroup;

    document.addEventListener('DOMContentLoaded', function() {
        // 1. Mobile Filter Sidebar Toggle
        const mobileToggle = document.getElementById('naMobileFilterToggle');
        const sidebar = document.getElementById('naFilterSidebar');
        if (mobileToggle && sidebar) {
            mobileToggle.addEventListener('click', function() {
                const isOpen = sidebar.classList.toggle('open');
                mobileToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            });
        }

        // 2. Subcategory link clicks: prevent bubbling
        const subcategoryLinks = document.querySelectorAll('.na-subcategory-link');
        subcategoryLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });

        // 4. View Mode Toggle (Grid 4-col vs List view)
        const gridViewBtn = document.getElementById('naGridViewBtn');
        const listViewBtn = document.getElementById('naListViewBtn');
        const productGrid = document.getElementById('naProductGrid');

        if (gridViewBtn && listViewBtn && productGrid) {
            gridViewBtn.addEventListener('click', function() {
                gridViewBtn.classList.add('active');
                listViewBtn.classList.remove('active');
                productGrid.classList.remove('list-view');
            });

            listViewBtn.addEventListener('click', function() {
                listViewBtn.classList.add('active');
                gridViewBtn.classList.remove('active');
                productGrid.classList.add('list-view');
            });
        }

        function scrollToProductsCatalogSection() {
            const target = document.getElementById('productsCatalog');
            if (!target) {
                return;
            }
            const headerOffset = 70;
            const elementPosition = target.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
            window.scrollTo({
                top: Math.max(0, offsetPosition),
                behavior: 'smooth'
            });
        }

        const hasCategoryFilter = window.location.search.includes('category=') || window.location.search.includes('occasion=');
        if (window.location.hash === '#productsCatalog' || hasCategoryFilter) {
            requestAnimationFrame(function () {
                scrollToProductsCatalogSection();
            });
        }

        // 5. Scroll to top of product grid when navigating pages via URL query parameter
        if (window.location.search.includes('page=') && !window.location.search.includes('page=1')) {
            const mainProducts = document.querySelector('.na-main-products');
            if (mainProducts) {
                const headerOffset = 75;
                const elementPosition = mainProducts.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                window.scrollTo({
                    top: Math.max(0, offsetPosition),
                    behavior: 'smooth'
                });
            }
        }

        // 6. Smooth scroll for hero CTA button
        const exploreBtn = document.getElementById('exploreAllProductsBtn');
        if (exploreBtn) {
            exploreBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.getElementById('productsCatalog');
                if (target) {
                    const headerOffset = 70;
                    const elementPosition = target.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                    window.scrollTo({
                        top: Math.max(0, offsetPosition),
                        behavior: 'smooth'
                    });
                }
            });
        }
    });
</script>
@endpush
