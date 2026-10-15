<?php

namespace Tests\Feature;

use Tests\TestCase;

class TrustStripTest extends TestCase
{
    public function test_homepage_renders_hero_page_and_features_bar_correctly(): void
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);

        // Hero Banner elements
        $response->assertSee('rc-slideshow-section');
        $response->assertSee('HANDMADE WITH LOVE');
        $response->assertSee('A Little');
        $response->assertSee('Sweetness');
        $response->assertSee('A Lot of');
        $response->assertSee('Love');
        $response->assertSee('Handcrafted Chocolates &amp; Thoughtful Gift Hampers for every occasion', false);
        $response->assertSee('Explore Our Collection');

        // Overlapping 5-Item Features Bar
        $response->assertSee('rc-features-bar');
        $response->assertSee('Exclusive Gift Hampers');
        $response->assertSee('Finest Ingredients');
        $response->assertSee('Made with Care &amp; Passion', false);
        $response->assertSee('Safe &amp; Secure Packaging', false);
        $response->assertSee('24/7 Support');

        // Floating WhatsApp button
        $response->assertSee('rc-whatsapp-float');
        $response->assertSee(config('ruchi.whatsapp_url'), false);

        // Section 1 Header integrity
        $response->assertSee('rc-header');
        $response->assertSee('rc-top-bar');
        $response->assertSee('rc-middle-bar');
        $response->assertSee('rc-bottom-bar');
    }
}
