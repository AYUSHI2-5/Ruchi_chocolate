<?php

namespace Tests\Feature;

use Tests\TestCase;

class SpreadHappinessSectionTest extends TestCase
{
    /**
     * Test that the homepage renders Section 7 (Promotional Banner & Service Trust Strip) correctly.
     */
    public function test_homepage_renders_spread_happiness_and_service_strip_section(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        // Assert PART A: Redesigned About Us Promotional Card ("More Than Just Chocolates")
        $response->assertSee('spread-happiness-section', false);
        $response->assertSee('homepage-about-card', false);
        $response->assertSee('More Than Just', false);
        $response->assertSee('Chocolates', false);
        $response->assertSee('about-card__title-script', false);
        $response->assertSee('At Ruchi Chocolates, we believe every chocolate has a story to tell.', false);
        $response->assertSee('About Ruchi Chocolates', false);
        $response->assertSee('aboutRuchiChocolatesBtn', false);
        $response->assertSee(route('about'), false);
        $response->assertSee('truffle-box.jpg', false);
        $response->assertSee('chocolate-bouquet.jpg', false);
        $response->assertSee('gift-hamper.jpg', false);
        $response->assertSee('artisan-box.jpg', false);

        // Assert PART B: Service Strip items
        $response->assertSee('Secure Shopping');
        $response->assertSee('Your payments and data are 100%');
        $response->assertSee('24/7 Support');
        $response->assertSee("We're here for you anytime,", false);
        $response->assertSee('100% Satisfaction Guaranteed');
        $response->assertSee('Loved by thousands of happy');
        $response->assertSee('Safe &amp; Hassle Free Packaging', false);
        $response->assertSee('Carefully packed to reach you');
    }

    /**
     * Test that previous sections (Sections 1-6) remain intact.
     */
    public function test_previous_sections_remain_intact(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('MADE WITH LOVE');
        $response->assertSee('Shop by Category');
        $response->assertSee('Best sellers', false);
    }
}
