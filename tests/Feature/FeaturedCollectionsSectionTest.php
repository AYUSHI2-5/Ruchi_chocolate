<?php

namespace Tests\Feature;

use Tests\TestCase;

class FeaturedCollectionsSectionTest extends TestCase
{
    /**
     * Test that the homepage does not render Section 8 Featured Collections.
     */
    public function test_homepage_does_not_render_featured_collections_section(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        // Assert section wrapper and grid are not present
        $response->assertDontSee('featured-collections-section', false);
        $response->assertDontSee('featured-collections__grid', false);
        $response->assertDontSee('exploreAllProductsBtn', false);
    }

    /**
     * Test that all previous sections (Sections 1-7) remain intact.
     */
    public function test_previous_sections_remain_intact(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('MADE WITH LOVE');
        $response->assertSee('Shop by Category');
        $response->assertSee('Best sellers', false);
        $response->assertSee('Spread Happiness', false);
        $response->assertSee('Secure Shopping', false);
    }
}
