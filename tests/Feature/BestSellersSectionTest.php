<?php

namespace Tests\Feature;

use Tests\TestCase;

class BestSellersSectionTest extends TestCase
{
    /**
     * Test that the homepage renders Section 6 Best Sellers correctly.
     */
    public function test_homepage_renders_best_sellers_section(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        // Assert section wrapper and headings
        $response->assertSee('best-sellers-section', false);
        $response->assertSee('Best sellers', false);
        $response->assertSee('Most loved gifts, chosen by your customers', false);

        // Assert 4 products in order
        $response->assertSee('R011 Big Rose Bouquet');
        $response->assertSee('₹350.00');
        $response->assertSee('R001 Volley Handy');
        $response->assertSee('₹250.00');
        $response->assertSee('R012 Acrylic Bouquet');
        $response->assertSee('₹750.00');
        $response->assertSee('R010 Half Round Bouquet');
        $response->assertSee('₹510.00');

        // Assert 5th product is not in Best Sellers section on homepage
        $response->assertDontSee('R002 12 Chocolates');

        // Assert badges and View Product buttons
        $response->assertSee('BEST', false);
        $response->assertSee('SELLER', false);
        $response->assertSee('View Product', false);
        $response->assertSee('bestSellersCarousel', false);
        $response->assertSee('bestSellersPrev', false);
        $response->assertSee('bestSellersNext', false);

        // Assert View All Products CTA button
        $response->assertSee('View All Products', false);
        $response->assertSee('viewAllProductsBtn', false);
    }

    public function test_best_sellers_mobile_carousel_css_aligns_track_to_start(): void
    {
        $css = file_get_contents(public_path('css/header.css'));

        $this->assertStringContainsString('.best-sellers__track', $css);
        $this->assertStringContainsString('justify-content: flex-start', $css);
        $this->assertStringContainsString('scroll-padding-inline', $css);
    }

    /**
     * Test that previous sections (Sections 1-5) remain fully intact.
     */
    public function test_previous_sections_remain_intact(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('MADE WITH LOVE');
        $response->assertSee('Shop by Category');
    }
}
