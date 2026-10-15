<?php

namespace Tests\Feature;

use Tests\TestCase;

class CategorySectionTest extends TestCase
{
    /**
     * Test that Homepage Section 3 "Shop by Category" renders accurately.
     */
    public function test_homepage_renders_shop_by_category_section(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        // Verify Heading
        $response->assertSee('Shop by Category');

        // Verify category titles
        $response->assertSee('Diwali');
        $response->assertSee('Gifting');
        $response->assertSee('New Born');
        $response->assertSee('Birthday');
        $response->assertSee('Occasions');
        $response->assertDontSee('Jute Potli Bags');
        $response->assertDontSee('Gift Pouches');
        $response->assertDontSee('Cane Bouquets');

        // Verify Image asset URLs
        $response->assertSee('diwali.jpg');
        $response->assertSee('gifting.jpg');
        $response->assertSee('new-born.jpg');
        $response->assertSee('birthday.jpg');
        $response->assertSee('occasions.jpg');
        $response->assertDontSee('jute-potli-bags.jpg');

        // Verify Section 1 Header is still intact
        $response->assertSee('Handmade with Love');
        $response->assertSee('+91 7490828282');

        // Verify Section 2 Hero and Trust Strip are still intact
        $response->assertSee('A Little');
        $response->assertSee('Sweetness');
        $response->assertSee('A Lot of');
        $response->assertSee('Love');
        $response->assertSee('Exclusive Gift Hampers');
        $response->assertSee('Finest Ingredients');
        $response->assertSee('Made with Care &amp; Passion', false);
        $response->assertSee('Safe &amp; Secure Packaging', false);
        $response->assertSee('24/7 Support');
    }

    /**
     * Test that homepage category images exist on disk.
     */
    public function test_category_images_exist_on_disk(): void
    {
        $images = [
            'diwali.jpg',
            'gifting.jpg',
            'new-born.jpg',
            'birthday.jpg',
            'occasions.jpg',
        ];

        foreach ($images as $img) {
            $this->assertFileExists(public_path('images/categories/'.$img));
        }
    }
}
