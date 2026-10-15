<?php

namespace Tests\Feature;

use Tests\TestCase;

class BestCollectionsSectionTest extends TestCase
{
    /**
     * Test that Homepage Section 4 "Our Best Collections" is not rendered on the homepage.
     */
    public function test_homepage_does_not_render_best_collections_section(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        // Verify section wrapper, arrows, and CTA are not rendered
        $response->assertDontSee('best-collections__container', false);
        $response->assertDontSee('id="bestCollectionsPrev"', false);
        $response->assertDontSee('id="bestCollectionsNext"', false);
        $response->assertDontSee('View All Collections');

        // 5. Verify Section 1 Header & Sticky Nav are intact
        $response->assertSee('Handmade with Love');
        $response->assertSee('+91 7490828282');
        $response->assertSee('rc-bottom-bar');

        // 6. Verify Section 2 Hero and Trust Strip are intact
        $response->assertSee('A Little');
        $response->assertSee('Sweetness');
        $response->assertSee('Exclusive Gift Hampers');

        // 7. Verify Section 3 Shop by Category is intact
        $response->assertSee('Shop by Category');
        $response->assertSee('Diwali');
        $response->assertSee('Occasions');
    }
}
