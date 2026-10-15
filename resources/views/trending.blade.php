@extends('layouts.app')

@section('title', 'Trending | Most Popular Chocolates — Ruchi Chocolates')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/new-arrivals.css') }}">
@endpush

@section('content')
<div class="new-arrivals-page">
    <div class="na-container">
        
        <!-- 1. Breadcrumb Navigation -->
        <nav class="na-breadcrumb" aria-label="Breadcrumb">
            <ol class="na-breadcrumb__list">
                <li class="na-breadcrumb__item">
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li class="na-breadcrumb__separator" aria-hidden="true">&gt;</li>
                <li class="na-breadcrumb__item na-breadcrumb__item--active" aria-current="page">
                    Trending
                </li>
            </ol>
        </nav>

        <!-- 2. Page Header: Title & Description -->
        <div class="na-header">
            <h1 class="na-header__title">Trending</h1>
            <p class="na-header__description">Explore our trending handmade chocolates &amp; gifts.</p>
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
                <form id="naFilterForm" method="GET" action="{{ route('trending') }}">
                    
                    <!-- Filter Section: Categories -->
                    <div class="na-sidebar__section">
                        <button type="button" class="na-sidebar__header" data-toggle="collapse" data-target="#naCategoriesGroup" aria-expanded="true">
                            <span class="na-sidebar__title">Categories</span>
                            <svg class="na-sidebar__chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>
                        <div class="na-sidebar__content" id="naCategoriesGroup">
                            <ul class="na-filter-list">
                                @foreach($categories as $cat)
                                    <li>
                                        <a href="{{ route('trending', array_merge(request()->query(), ['category' => $selectedCategory === $cat['slug'] ? null : $cat['slug'], 'page' => 1])) }}" 
                                           class="na-filter-item {{ $selectedCategory === $cat['slug'] ? 'active' : '' }}"
                                           data-category="{{ $cat['slug'] }}">
                                            <span class="na-filter-item__left">
                                                <span class="na-filter-item__icon">{{ $cat['icon'] }}</span>
                                                <span class="na-filter-item__name">{{ $cat['name'] }}</span>
                                            </span>
                                            <span class="na-filter-item__count">({{ $cat['count'] }})</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Filter Section: Price Range -->
                    <div class="na-sidebar__section">
                        <button type="button" class="na-sidebar__header" data-toggle="collapse" data-target="#naPriceGroup" aria-expanded="true">
                            <span class="na-sidebar__title">Price Range</span>
                            <svg class="na-sidebar__chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>
                        <div class="na-sidebar__content" id="naPriceGroup">
                            <div class="na-price-range">
                                <div class="na-price-range__values">
                                    <span id="priceMinLabel">₹{{ $minPrice ?? 100 }}</span>
                                    <span id="priceMaxLabel">₹{{ $maxPrice ?? 1000 }}</span>
                                </div>
                                <div class="na-price-slider-wrap">
                                    <input type="range" class="na-price-slider" id="priceMaxSlider" name="max_price" min="160" max="1000" step="20" value="{{ $maxPrice ?? 1000 }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filter Section: Occasions (Clickable Filter Row) -->
                    <div class="na-sidebar__section">
                        <a href="{{ route('trending', array_merge(request()->query(), ['occasion' => $selectedOccasion ? null : 'occasions', 'page' => 1])) }}" 
                           class="na-sidebar__header na-sidebar__header--link {{ $selectedOccasion ? 'active' : '' }}"
                           id="naOccasionsFilterBtn"
                           aria-label="Filter by Occasions and Hampers"
                           title="Filter Occasion Chocolates &amp; Hampers">
                            <span class="na-sidebar__title">Occasions</span>
                            <svg class="na-sidebar__arrow-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </a>
                    </div>

                    <!-- Filter Section: Availability -->
                    <div class="na-sidebar__section">
                        <button type="button" class="na-sidebar__header" data-toggle="collapse" data-target="#naAvailabilityGroup" aria-expanded="true">
                            <span class="na-sidebar__title">Availability</span>
                            <svg class="na-sidebar__chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>
                        <div class="na-sidebar__content" id="naAvailabilityGroup">
                            <div class="na-checkbox-group">
                                <label class="na-checkbox-label">
                                    <input type="checkbox" name="availability" value="in_stock" class="na-checkbox" {{ $selectedAvailability === 'in_stock' ? 'checked' : '' }} onchange="this.form.submit()">
                                    <span>In Stock</span>
                                </label>
                                <label class="na-checkbox-label">
                                    <input type="checkbox" name="availability" value="out_of_stock" class="na-checkbox" {{ $selectedAvailability === 'out_of_stock' ? 'checked' : '' }} onchange="this.form.submit()">
                                    <span>Out of Stock</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden inputs to preserve sort, category, and occasion across filter form submits -->
                    <input type="hidden" name="sort" value="{{ $sort }}">
                    @if($selectedCategory)
                        <input type="hidden" name="category" value="{{ $selectedCategory }}">
                    @endif
                    @if($selectedOccasion)
                        <input type="hidden" name="occasion" value="{{ $selectedOccasion }}">
                    @endif

                    <!-- Clear Filters Action Button (Maintains Trending scope) -->
                    <a href="{{ route('trending') }}" class="na-clear-btn" id="naClearFiltersBtn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <polyline points="1 4 1 10 7 10"></polyline>
                            <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path>
                        </svg>
                        <span>Clear Filters</span>
                    </a>

                </form>
            </aside>

            <!-- RIGHT COLUMN: Product Area (Toolbar + 4-Column Grid + Pagination) -->
            <main class="na-main-products">
                
                <!-- Product Toolbar: Count + Sort Dropdown + Grid/List Controls -->
                <div class="na-toolbar">
                    <div class="na-toolbar__count">
                        <strong id="naToolbarCountNumber">{{ $filteredCount }}</strong> Items
                    </div>
                    <div class="na-toolbar__controls">
                        <div class="na-sort-wrap">
                            <label for="naSortSelect">Sort by:</label>
                            <select id="naSortSelect" class="na-sort-select" onchange="window.location.href = this.value">
                                <option value="{{ route('trending', array_merge(request()->query(), ['sort' => 'featured', 'page' => 1])) }}" {{ $sort === 'featured' ? 'selected' : '' }}>Featured</option>
                                <option value="{{ route('trending', array_merge(request()->query(), ['sort' => 'price_low_high', 'page' => 1])) }}" {{ $sort === 'price_low_high' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="{{ route('trending', array_merge(request()->query(), ['sort' => 'price_high_low', 'page' => 1])) }}" {{ $sort === 'price_high_low' ? 'selected' : '' }}>Price: High to Low</option>
                                <option value="{{ route('trending', array_merge(request()->query(), ['sort' => 'rating', 'page' => 1])) }}" {{ $sort === 'rating' ? 'selected' : '' }}>Customer Rating</option>
                                <option value="{{ route('trending', array_merge(request()->query(), ['sort' => 'newest', 'page' => 1])) }}" {{ $sort === 'newest' ? 'selected' : '' }}>Newest</option>
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
                                        data-url="{{ route('trending') }}" 
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
                        <div class="na-empty-state">
                            <h3>No Trending Products Found</h3>
                            <p>No trending products match your selected filters. Try clearing some filters to see more chocolates.</p>
                            <a href="{{ route('trending') }}" class="na-clear-btn" style="max-width: 200px; margin: 0 auto;">Reset All Filters</a>
                        </div>
                    @endforelse
                </div>

                <!-- 7. Centered Pagination -->
                @if($totalPages > 1)
                    <nav class="na-pagination" id="naPagination" aria-label="Products pagination">
                        {{-- Previous Page Button --}}
                        @if($currentPage > 1)
                            <a href="{{ route('trending', array_merge(request()->query(), ['page' => $currentPage - 1])) }}" 
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
                            <a href="{{ route('trending', array_merge(request()->query(), ['page' => $p])) }}" 
                               class="na-page-link na-page-number {{ $currentPage == $p ? 'active' : '' }}" 
                               aria-label="Page {{ $p }}"
                               {{ $currentPage == $p ? 'aria-current="page"' : '' }}>
                                {{ $p }}
                            </a>
                        @endfor

                        {{-- Next Page Button --}}
                        @if($currentPage < $totalPages)
                            <a href="{{ route('trending', array_merge(request()->query(), ['page' => $currentPage + 1])) }}" 
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

        // 2. Sidebar Collapsible Sections
        const collapsibleHeaders = document.querySelectorAll('.na-sidebar__header[data-toggle="collapse"]');
        collapsibleHeaders.forEach(header => {
            header.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const targetEl = document.querySelector(targetId);
                const chevron = this.querySelector('.na-sidebar__chevron');
                
                if (targetEl) {
                    const isHidden = targetEl.style.display === 'none';
                    targetEl.style.display = isHidden ? 'block' : 'none';
                    if (chevron) {
                        chevron.classList.toggle('collapsed', !isHidden);
                    }
                }
            });
        });

        // 3. Price Slider Live Label & Debounced Submit
        const priceSlider = document.getElementById('priceMaxSlider');
        const priceMaxLabel = document.getElementById('priceMaxLabel');
        const filterForm = document.getElementById('naFilterForm');
        
        if (priceSlider && priceMaxLabel) {
            priceSlider.addEventListener('input', function() {
                priceMaxLabel.textContent = '₹' + this.value;
            });

            priceSlider.addEventListener('change', function() {
                if (filterForm) {
                    filterForm.submit();
                }
            });
        }

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
    });
</script>
@endpush
