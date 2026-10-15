<?php

namespace Tests\Feature;

use Tests\TestCase;

class NewArrivalsPageTest extends TestCase
{
    public function test_new_arrivals_page_loads_successfully(): void
    {
        $response = $this->get('/new-arrivals');

        $response->assertStatus(200);
        $response->assertSee('Products', false);
        $response->assertSee('Explore our wide range of handmade chocolates &amp; gifts.', false);
    }

    public function test_new_arrivals_page_has_breadcrumb(): void
    {
        $response = $this->get('/new-arrivals');

        $response->assertStatus(200);
        $response->assertSee('na-breadcrumb', false);
        $response->assertSee('Home', false);
        $response->assertSee('Products', false);
    }

    public function test_new_arrivals_page_has_filter_sidebar_and_groups(): void
    {
        $response = $this->get('/new-arrivals');

        $response->assertStatus(200);
        $response->assertSee('Categories', false);

        // 3 main category sections
        $response->assertSee('Festivals', false);
        $response->assertSee('Occasions', false);
        $response->assertSee('Gifting', false);

        // Subcategories under Festivals
        $response->assertSee('Diwali', false);
        $response->assertSee('Rakhi', false);
        $response->assertSee('Holi', false);
        $response->assertSee('Uttarayan', false);
        $response->assertSee('Christmas', false);
        $response->assertSee('New Year', false);
        $response->assertDontSee('Navratri', false);
        $response->assertDontSee('Eid', false);
        $response->assertSee('data-coming-soon="true"', false);

        // Subcategories under Occasions
        $response->assertSee('Birthday', false);
        $response->assertSee('Anniversary', false);
        $response->assertSee('Ring Ceremony', false);
        $response->assertSee('Valentine', false);
        $response->assertSee('Baby Shower', false);

        // Gifting is a direct clickable category row with NO dropdown
        $response->assertSee('na-category-direct-link', false);
        $response->assertDontSee('data-target="#catgroup-gifting"', false);

        // Price Range and standalone Occasions sections are removed
        $response->assertDontSee('Price Range', false);
        $response->assertDontSee('General Occasions', false);
    }

    public function test_new_arrivals_page_has_toolbar_and_count(): void
    {
        $response = $this->get('/new-arrivals');

        $response->assertStatus(200);
        $response->assertSee('47', false);
        $response->assertSee('Items', false);
        $response->assertSee('Sort by:', false);
        $response->assertSee('Featured', false);
        $response->assertSee('na-view-toggle', false);
    }

    public function test_new_arrivals_page_renders_four_column_products_and_cards(): void
    {
        $response = $this->get('/new-arrivals');

        $response->assertStatus(200);
        $response->assertSee('na-product-grid', false);
        $response->assertSee('P001 Small Heart Tin Box', false);
        $response->assertSee('P002 Big Heart Tin Box', false);
        $response->assertSee('P003 Rectangle Tin Box', false);
        $response->assertSee('P004 Small Square Tin Box', false);
        $response->assertSee('₹170.00', false);
        $response->assertSee('₹225.00', false);
        $response->assertSee('wishlist-toggle', false);
        $response->assertSee('View Product', false);
    }

    public function test_new_arrivals_page_has_functional_pagination(): void
    {
        // Page 1: Displays items 1-16, Previous disabled, Next enabled
        $response = $this->get('/new-arrivals');
        $response->assertStatus(200);
        $response->assertSee('na-pagination', false);
        $response->assertSee('P001 Small Heart Tin Box', false);
        $response->assertDontSee('P017 18 Rose Chocolates Box', false);
        $response->assertSee('na-page-link--prev na-page-link--disabled', false);
        $response->assertSee(route('new-arrivals', ['page' => 2]), false);

        // Page 2: Displays items 17-32, Previous enabled, Next enabled
        $responsePage2 = $this->get('/new-arrivals?page=2');
        $responsePage2->assertStatus(200);
        $responsePage2->assertSee('P017 18 Rose Chocolates Box', false);
        $responsePage2->assertDontSee('P001 Small Heart Tin Box', false);
        $responsePage2->assertSee(route('new-arrivals', ['page' => 1]), false);
        $responsePage2->assertSee(route('new-arrivals', ['page' => 3]), false);

        // Page 3: Displays items 33-48, Previous enabled, Next enabled
        $responsePage3 = $this->get('/new-arrivals?page=3');
        $responsePage3->assertStatus(200);
        $responsePage3->assertSee('P033 Royal Silk Chocolate Hamper', false);
        $responsePage3->assertSee('P034 Petite Blossom Bouquet 10pc', false);
        $responsePage3->assertDontSee('P001 Small Heart Tin Box', false);
        $responsePage3->assertSee(route('new-arrivals', ['page' => 4]), false);

        // Page 4: Displays last page items, Previous enabled, Next disabled
        $responsePage4 = $this->get('/new-arrivals?page=4');
        $responsePage4->assertStatus(200);
        $responsePage4->assertDontSee('P001 Small Heart Tin Box', false);
        $responsePage4->assertSee('na-page-link--next na-page-link--disabled', false);
    }

    public function test_products_page_has_no_category_selected_by_default(): void
    {
        $response = $this->get('/new-arrivals');

        $response->assertStatus(200);
        $response->assertSee('P001 Small Heart Tin Box', false);
        $response->assertDontSee('Diwali collection — Coming Soon', false);
        $response->assertDontSee('na-subcategory-link active', false);
        $response->assertDontSee('na-category-direct-link active', false);
        $response->assertDontSee('id="naClearFiltersBtn"', false);
    }

    public function test_category_filter_works(): void
    {
        $response = $this->get('/new-arrivals?category=gift-hampers');

        $response->assertStatus(200);
        $response->assertSee('P003 Rectangle Tin Box', false);
        $response->assertSee('P005 Big Square Tin Box', false);
    }

    public function test_categories_expandable_groups_and_subcategories(): void
    {
        $response = $this->get('/new-arrivals');

        $response->assertStatus(200);

        // Group headers with toggle attributes and chevrons for Festivals and Occasions
        $response->assertSee('data-toggle="category-group"', false);
        $response->assertSee('data-target="#catgroup-festivals"', false);
        $response->assertSee('data-target="#catgroup-occasions"', false);
        $response->assertDontSee('data-target="#catgroup-gifting"', false);

        // Gifting is a simple clickable category row
        $response->assertSee('data-category="gifting"', false);

        // Subcategory links with data attributes
        $response->assertSee('data-subcategory="diwali"', false);
        $response->assertSee('data-subcategory="rakhi"', false);
        $response->assertSee('data-subcategory="holi"', false);
        $response->assertSee('data-subcategory="uttarayan"', false);
        $response->assertSee('data-subcategory="birthday"', false);
        $response->assertSee('data-subcategory="anniversary"', false);
        $response->assertSee('data-subcategory="ring-ceremony"', false);
        $response->assertSee('data-subcategory="valentine"', false);
        $response->assertSee('data-subcategory="baby-shower"', false);
    }

    public function test_subcategory_filtering_works_accurately(): void
    {
        // Festivals - Diwali (shows products tagged for Diwali)
        $responseDiwali = $this->get('/new-arrivals?category=diwali');
        $responseDiwali->assertStatus(200);
        $responseDiwali->assertDontSee('Diwali collection — Coming Soon', false);
        $responseDiwali->assertSee('na-subcategory-link active', false);
        $responseDiwali->assertSee('data-subcategory="diwali"', false);
        $responseDiwali->assertSee('Golden Metal Box', false);
        $responseDiwali->assertSee('12 Cavity Paper Box', false);
        $responseDiwali->assertSee('Black Leather Box', false);
        $responseDiwali->assertSee('Jute Bag with 3 Jar', false);
        $responseDiwali->assertSee('4+2 Cavity Paper Box', false);
        $responseDiwali->assertSee('Jute Bag with 2 Jar', false);
        $responseDiwali->assertSee('24 Cavity Paper Box', false);
        $responseDiwali->assertSee('24 Cavity Wooden Box', false);
        $responseDiwali->assertSee('12 Cavity Wooden Box', false);
        $responseDiwali->assertSee('Chocolate Chhab', false);
        $responseDiwali->assertSee('15 Cavity Box', false);
        $responseDiwali->assertSee('12 Cavity Paper Box — Kunafa', false);
        $responseDiwali->assertSee('Polka Bag', false);
        $responseDiwali->assertSee('₹255.00', false);
        $responseDiwali->assertSee('₹390.00', false);
        $responseDiwali->assertSee('₹140.00', false);
        $responseDiwali->assertSee('₹540.00', false);
        $responseDiwali->assertSee('₹315.00', false);
        $responseDiwali->assertSee('₹1,500.00', false);
        $responseDiwali->assertSee('₹770.00', false);
        $responseDiwali->assertSee('₹215.00', false);
        $responseDiwali->assertSee('₹325.00', false);
        $responseDiwali->assertSee('₹345.00', false);
        $responseDiwali->assertSee('₹680.00', false);
        $responseDiwali->assertSee('₹1,090.00', false);
        $responseDiwali->assertDontSee('images/custom-gifts/', false);
        $responseDiwali->assertDontSee('Photo Chocolate Cake', false);
        $responseDiwali->assertDontSee('P001 Small Heart Tin Box', false);
        $responseDiwali->assertSee('<strong id="naToolbarCountNumber">13</strong> Items', false);

        // Festivals - Uttarayan (coming soon)
        $responseUttarayan = $this->get('/new-arrivals?category=uttarayan');
        $responseUttarayan->assertStatus(200);
        $responseUttarayan->assertSee('Uttarayan collection — Coming Soon', false);
        $responseUttarayan->assertDontSee('P003 Rectangle Tin Box', false);

        // Festivals - Holi (coming soon)
        $responseHoli = $this->get('/new-arrivals?category=holi');
        $responseHoli->assertStatus(200);
        $responseHoli->assertSee('Holi collection — Coming Soon', false);
        $responseHoli->assertDontSee('P001 Small Heart Tin Box', false);

        // Occasions - Ring Ceremony
        $responseRing = $this->get('/new-arrivals?category=ring-ceremony');
        $responseRing->assertStatus(200);
        $responseRing->assertSee('P002 Big Heart Tin Box', false);
        $responseRing->assertSee('P016 15 chocolate', false);

        // Occasions - Valentine
        $responseValentine = $this->get('/new-arrivals?category=valentine');
        $responseValentine->assertStatus(200);
        $responseValentine->assertSee('P001 Small Heart Tin Box', false);
        $responseValentine->assertSee('P002 Big Heart Tin Box', false);

        // Gifting category filter shows all gifting products
        $responseGifting = $this->get('/new-arrivals?category=gifting');
        $responseGifting->assertStatus(200);
        $responseGifting->assertSee('P001 Small Heart Tin Box', false);
        $responseGifting->assertSee('P003 Rectangle Tin Box', false);
    }

    public function test_single_occasion_filter_shows_matching_products(): void
    {
        // Birthday filter
        $responseBirthday = $this->get('/new-arrivals?occasion=birthday');
        $responseBirthday->assertStatus(200);
        $responseBirthday->assertSee('P001 Small Heart Tin Box', false);
        $responseBirthday->assertSee('P003 Rectangle Tin Box', false);
        $responseBirthday->assertDontSee('P006 Polka bag', false);

        // Wedding filter
        $responseWedding = $this->get('/new-arrivals?occasion=wedding');
        $responseWedding->assertStatus(200);
        $responseWedding->assertSee('P002 Big Heart Tin Box', false);
        $responseWedding->assertSee('P005 Big Square Tin Box', false);

        // Diwali occasion filter
        $responseDiwali = $this->get('/new-arrivals?occasion=diwali');
        $responseDiwali->assertStatus(200);
        $responseDiwali->assertDontSee('Diwali collection — Coming Soon', false);
        $responseDiwali->assertSee('Golden Metal Box', false);
        $responseDiwali->assertSee('₹770.00', false);
        $responseDiwali->assertDontSee('images/custom-gifts/', false);
        $responseDiwali->assertDontSee('P001 Small Heart Tin Box', false);
        $responseDiwali->assertSee('<strong id="naToolbarCountNumber">13</strong> Items', false);
    }

    public function test_multiple_occasions_filter_matches_any_selected_occasion(): void
    {
        // Birthday OR Anniversary (array query)
        $responseMultiple = $this->get('/new-arrivals?occasion[]=birthday&occasion[]=anniversary');
        $responseMultiple->assertStatus(200);
        $responseMultiple->assertSee('P001 Small Heart Tin Box', false); // birthday
        $responseMultiple->assertSee('P002 Big Heart Tin Box', false); // anniversary
        $responseMultiple->assertSee('Clear', false);

        // Comma-separated query string
        $responseComma = $this->get('/new-arrivals?occasion=birthday,anniversary');
        $responseComma->assertStatus(200);
        $responseComma->assertSee('P001 Small Heart Tin Box', false);
        $responseComma->assertSee('P002 Big Heart Tin Box', false);
    }

    public function test_occasion_filter_preserves_pagination_and_query_parameters(): void
    {
        $response = $this->get('/new-arrivals?occasion[]=birthday');
        $response->assertStatus(200);
        $response->assertSee('occasion%5B0%5D=birthday', false); // URL encoded query in pagination links
    }

    public function test_sidebar_has_sticky_position_in_stylesheet(): void
    {
        $css = file_get_contents(public_path('css/new-arrivals.css'));

        $this->assertStringContainsString('position: sticky;', $css);
        $this->assertStringContainsString('top: 72px;', $css);
    }

    /**
     * Test that the Our Products page renders the luxury hero banner with full typography, content, CTA, and hamper imagery.
     */
    public function test_our_products_page_renders_luxury_hero_section(): void
    {
        foreach (['/products', '/new-arrivals'] as $url) {
            $response = $this->get($url);

            $response->assertStatus(200);

            // 1. Hero layout and breadcrumb
            $response->assertSee('products-hero', false);
            $response->assertSee('Our Products', false);
            $response->assertSee('Home', false);

            // 2. Eyebrow text & decorative heart
            $response->assertSee('HANDMADE WITH LOVE', false);
            $response->assertSee('products-hero__eyebrow-heart', false);

            // 3. Main Heading (H1) and styling
            $response->assertSee('Discover Our', false);
            $response->assertSee('Chocolate Collection', false);
            $response->assertSee('products-hero__title-italic', false);

            // 4. Subheading
            $response->assertSee('Explore our handcrafted chocolates, delightful gift hampers, and beautiful chocolate bouquets for every special occasion.', false);

            // 5. CTA Button with smooth scroll anchor
            $response->assertSee('Explore All Products', false);
            $response->assertSee('id="exploreAllProductsBtn"', false);
            $response->assertSee('href="#productsCatalog"', false);

            // 6. Hamper imagery & alt text
            $response->assertSee('products-hero-hamper.jpg', false);
            $response->assertSee('alt="Handcrafted Chocolate Gift Hamper with Assorted Truffles and Gold Ribbon — Ruchi Chocolates"', false);
            $response->assertSee('Handcrafted with Love', false);

            // 7. Product catalog section immediately below remains functional
            $response->assertSee('id="productsCatalog"', false);
            $response->assertSee('P001 Small Heart Tin Box', false);
        }
    }

    /**
     * Test that new-arrivals.css contains hero banner styling rules.
     */
    public function test_stylesheet_contains_hero_section_rules(): void
    {
        $css = file_get_contents(public_path('css/new-arrivals.css'));

        $this->assertStringContainsString('.products-hero', $css);
        $this->assertStringContainsString('.products-hero__title-italic', $css);
        $this->assertStringContainsString('.products-hero__cta-btn', $css);
        $this->assertStringContainsString('.products-hero__image-wrapper', $css);
        $this->assertStringContainsString('@media screen and (max-width: 768px)', $css);
    }
}
