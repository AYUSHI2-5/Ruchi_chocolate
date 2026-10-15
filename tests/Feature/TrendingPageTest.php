<?php

namespace Tests\Feature;

use Tests\TestCase;

class TrendingPageTest extends TestCase
{
    public function test_trending_page_loads_successfully(): void
    {
        $response = $this->get('/trending');

        $response->assertStatus(200);
        $response->assertSee('Trending', false);
        $response->assertSee('Explore our trending handmade chocolates &amp; gifts.', false);
    }

    public function test_trending_page_has_breadcrumb(): void
    {
        $response = $this->get('/trending');

        $response->assertStatus(200);
        $response->assertSee('na-breadcrumb', false);
        $response->assertSee('Home', false);
        $response->assertSee('Trending', false);
    }

    public function test_trending_page_displays_only_trending_products(): void
    {
        $response = $this->get('/trending');

        $response->assertStatus(200);
        // Assert trending items are present
        $response->assertSee('P001 Small Heart Tin Box', false);
        $response->assertSee('P002 Big Heart Tin Box', false);
        $response->assertSee('P003 Rectangle Tin Box', false);
        $response->assertSee('P005 Big Square Tin Box', false);
        $response->assertSee('P008 Chocopie Round Box', false);

        // Assert non-trending items are NOT displayed on Trending page
        $response->assertDontSee('P004 Small Square Tin Box', false);
        $response->assertDontSee('P006 Polka bag', false);
        $response->assertDontSee('P007 Chocopie Potli', false);
        $response->assertDontSee('P009 Big Cone', false);
        $response->assertDontSee('P011 Chocolate Basket', false);
        $response->assertDontSee('P012 Teddy Basket', false);
        $response->assertDontSee('P013 Cutie Jute Bag', false);
        $response->assertDontSee('P015 Chocolate Bar', false);
    }

    public function test_trending_page_category_filter_works_within_trending_scope(): void
    {
        $response = $this->get('/trending?category=gift-hampers');

        $response->assertStatus(200);
        $response->assertSee('P003 Rectangle Tin Box', false);
        $response->assertSee('P005 Big Square Tin Box', false);
        // Non-trending hamper shouldn't show up
        $response->assertDontSee('P021 Teddy & Chocolate Hamper', false);
    }

    public function test_trending_page_occasions_filter_works(): void
    {
        $response = $this->get('/trending?occasion=occasions');

        $response->assertStatus(200);
        $response->assertSee('na-sidebar__header--link active', false);
        $response->assertSee('P001 Small Heart Tin Box', false);
    }

    public function test_trending_page_clear_filters_preserves_trending_scope(): void
    {
        $response = $this->get('/trending');

        $response->assertStatus(200);
        $response->assertSee('href="'.route('trending').'"', false);
    }

    public function test_new_arrivals_page_remains_unaffected(): void
    {
        $response = $this->get('/new-arrivals');

        $response->assertStatus(200);
        $response->assertSee('Products', false);
        $response->assertSee('P004 Small Square Tin Box', false);
    }
}
