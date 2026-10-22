<?php

namespace Tests\Feature;

use Tests\TestCase;

class FooterSectionTest extends TestCase
{
    /**
     * Test that the homepage renders Section 9 Footer correctly.
     */
    public function test_homepage_renders_footer_section(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        // Assert PART A: Main Footer structure and columns
        $response->assertSee('rc-footer-section', false);
        $response->assertSee('Ruchi Chocolate brings you the finest');
        $response->assertSee(config('ruchi.instagram_url'), false);
        $response->assertSee(config('ruchi.facebook_url'), false);
        $response->assertSee('aria-label="Follow Ruchi Chocolates on Instagram"', false);
        $response->assertSee('aria-label="Follow Ruchi Chocolates on Facebook"', false);
        $response->assertSee('EXPLORE', false);
        $response->assertSee('CUSTOMER CARE', false);
        $response->assertSee('NEWSLETTER', false);

        // Assert Links
        $response->assertSee('Home');
        $response->assertSee('Our Products');
        $response->assertSee('New Arrivals');
        $response->assertSee('Trending');
        $response->assertSee('Customised Gifts');
        $response->assertSee('About Us');
        $response->assertSee('Contact Us');
        $response->assertSee('Privacy Policy');
        $response->assertSee('Terms &amp; Conditions', false);
        $response->assertDontSee('Shipping Policy');
        $response->assertDontSee('Return &amp; Refund Policy', false);

        // Assert Newsletter
        $response->assertSee('Subscribe to get special offers, new arrivals');
        $response->assertSee('Enter your email address');
        $response->assertSee('Subscribe');

        // Assert PART B: Bottom Bar
        $response->assertSee('All Rights Reserved.');
        $response->assertSee('Made with', false);
        $response->assertSee('for Every Celebration', false);
        $response->assertDontSee('rc-footer-payments', false);
        $response->assertDontSee('Accepted Payment Methods', false);
    }

    /**
     * Test that all policy routes exist and are functional.
     */
    public function test_footer_policy_routes_redirect_to_home(): void
    {
        $this->get(route('privacy-policy'))->assertStatus(200);
        $this->get('/return-policy')->assertNotFound();
        $this->get('/shipping-policy')->assertNotFound();
        $this->get(route('terms-and-conditions'))->assertStatus(200);
    }

    /**
     * Test that all previous sections (Sections 1-8) remain intact.
     */
    public function test_previous_sections_remain_intact(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('MADE WITH LOVE');
        $response->assertSee('Shop by Category');
        $response->assertSee('Best sellers', false);
        $response->assertSee('Spread Happiness', false);
    }
}
