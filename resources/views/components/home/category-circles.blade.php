{{-- Section 3: Homepage Shop by Category (Exact match to ruchichocolate.com) --}}
@php
$categories = [
    [
        'title' => 'Diwali',
        'image' => asset('images/categories/diwali.jpg'),
        'url' => route('products', ['category' => 'diwali']).'#productsCatalog',
        'alt' => 'Happy Diwali festive chocolate gift box with purple and gold assorted chocolates',
    ],
    [
        'title' => 'Gifting',
        'image' => asset('images/categories/gifting.jpg'),
        'url' => route('products', ['category' => 'gifting']).'#productsCatalog',
        'alt' => 'Black and gold luxury chocolate bouquet with glitter bow for gifting',
    ],
    [
        'title' => 'New Born',
        'image' => asset('images/categories/new-born.jpg'),
        'url' => route('products', ['category' => 'new-born']).'#productsCatalog',
        'alt' => 'Pink and blue tulle gift jars filled with chocolates for newborn baby gifts',
    ],
    [
        'title' => 'Birthday',
        'image' => asset('images/categories/birthday.jpg'),
        'url' => route('products', ['category' => 'birthday']).'#productsCatalog',
        'alt' => 'Happy Birthday blue and white chocolate gift box with balloons and celebration treats',
    ],
    [
        'title' => 'Occasions',
        'image' => asset('images/categories/occasions.jpg'),
        'url' => route('products', ['occasion' => 'occasions']).'#productsCatalog',
        'alt' => 'Ruchi homemade occasion chocolate bars for Diwali, birthday, and anniversary',
    ],
];
@endphp

<section class="category-circles" id="category-circles-home" aria-label="Shop by Category">
    <div class="category-circles__container">
        
        <!-- Header with original gradient lines and SVG flourish icons -->
        <div class="category-circles__header">
            <span class="category-circles__line left-line" aria-hidden="true"></span>
            
            <span class="category-circles__flourish-icon left-icon" aria-hidden="true">
                <svg width="28" height="28" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 6C16 10 9 12 9 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M9 16.5C6.5 16.5 4.5 18.5 4.5 21C4.5 24.5 9 27.5 9 27.5C9 27.5 13.5 24.5 13.5 21C13.5 18.5 11.5 16.5 9 16.5Z" fill="currentColor"/>
                    <path d="M18 6C19.5 10 24.5 11.5 24.5 15.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M24.5 15C22.5 15 21 16.5 21 18.5C21 21.5 24.5 24 24.5 24C24.5 24 28 21.5 28 18.5C28 16.5 26.5 15 24.5 15Z" fill="currentColor"/>
                    <path d="M18 6C18.5 5 19.5 4.5 20.5 5C21 5.25 21 6 20 6.5C19 7 18.5 6.5 18 6Z" fill="currentColor"/>
                </svg>
            </span>

            <h2 class="category-circles__title">Shop by Category</h2>

            <span class="category-circles__flourish-icon right-icon" aria-hidden="true">
                <svg width="28" height="28" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 6C16 10 9 12 9 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M9 16.5C6.5 16.5 4.5 18.5 4.5 21C4.5 24.5 9 27.5 9 27.5C9 27.5 13.5 24.5 13.5 21C13.5 18.5 11.5 16.5 9 16.5Z" fill="currentColor"/>
                    <path d="M18 6C19.5 10 24.5 11.5 24.5 15.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M24.5 15C22.5 15 21 16.5 21 18.5C21 21.5 24.5 24 24.5 24C24.5 24 28 21.5 28 18.5C28 16.5 26.5 15 24.5 15Z" fill="currentColor"/>
                    <path d="M18 6C18.5 5 19.5 4.5 20.5 5C21 5.25 21 6 20 6.5C19 7 18.5 6.5 18 6Z" fill="currentColor"/>
                </svg>
            </span>
            
            <span class="category-circles__line right-line" aria-hidden="true"></span>
        </div>

        <!-- Carousel / Grid Container -->
        <div class="category-circles__carousel-wrapper">
            <button type="button" class="category-circles__arrow category-circles__arrow--prev" aria-label="Previous slide">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>

            <div class="category-circles__grid">
                @foreach($categories as $category)
                    <a href="{{ $category['url'] }}" class="category-circles__card" aria-label="{{ $category['title'] }}">
                        <div class="category-circles__image-wrapper">
                            <div class="category-circles__image-inner">
                                <img 
                                    src="{{ $category['image'] }}" 
                                    alt="{{ $category['alt'] }}" 
                                    loading="lazy" 
                                    width="150" 
                                    height="150"
                                >
                            </div>
                        </div>
                        <span class="category-circles__name">{{ $category['title'] }}</span>
                    </a>
                @endforeach
            </div>

            <button type="button" class="category-circles__arrow category-circles__arrow--next" aria-label="Next slide">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>
        </div>

    </div>
</section>
