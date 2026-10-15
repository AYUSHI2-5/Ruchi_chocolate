<?php

namespace Tests\Feature;

use Tests\TestCase;

class CustomisedGiftsPageTest extends TestCase
{
    /**
     * Test that the Customised Gifts page renders with all required sections.
     */
    public function test_customised_gifts_page_renders_successfully(): void
    {
        $response = $this->get(route('customised-gifts'));

        $response->assertStatus(200);

        // Header and active navigation link
        $response->assertSee('rc-main-nav-bar');
        $response->assertSee('Customised Gifts');
        $response->assertSee('active');

        // Hero Section & Breadcrumb
        $response->assertSee('rc-custom-hero-section', false);
        $response->assertSee('Home');
        $response->assertSee('Customise Your');
        $response->assertSee('Perfect Gift');
        $response->assertSee('Make your moments extra special with personalised chocolates, hampers and gifts');

        // Customisation Details Form Card
        $response->assertSee('Share Your Customisation Details');
        $response->assertSee('Tell us what you have in mind');
        $response->assertSee('Type your customisation details here...');
        $response->assertSee('Enquire on WhatsApp');
        $response->assertSee('917490828282');

        // Hero Hamper Image
        $response->assertSee('hero-hamper.jpg');

        // Product Photos Section
        $response->assertSee('Product Photos');
        $response->assertSee('Take a look at some of our customised creations.');
        $response->assertSee('gallery-birthday-box.jpg');
        $response->assertSee('gallery-heart-box.jpg');
        $response->assertSee('gallery-pink-bouquet.jpg');
        $response->assertSee('gallery-custom-hamper.jpg');
        $response->assertSee('gallery-lettering-box.jpg');
        $response->assertDontSee('btn-gallery-prev', false);
        $response->assertDontSee('scrollCustomGallery', false);

        // Preserved Standard Website Footer
        $response->assertSee('rc-footer-section', false);
        $response->assertSee('All Rights Reserved.');
    }

    /**
     * Test redirect routes for /customize and /customise.
     */
    public function test_customise_redirect_routes(): void
    {
        $this->get('/customize')->assertRedirect(route('customised-gifts'));
        $this->get('/customise')->assertRedirect(route('customised-gifts'));
    }
}
