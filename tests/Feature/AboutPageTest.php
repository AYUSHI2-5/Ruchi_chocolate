<?php

namespace Tests\Feature;

use Tests\TestCase;

class AboutPageTest extends TestCase
{
    /**
     * Test that the About page renders all 3 sections matching both reference screenshots in exact vertical order.
     */
    public function test_about_page_renders_all_three_sections_in_correct_order(): void
    {
        $response = $this->get(route('about'));

        $response->assertStatus(200);

        // ==========================================
        // SECTION 1: OUR STORY / ABOUT HERO + STATS BAR
        // ==========================================
        $response->assertSee('rc-about-section');
        $response->assertSee('Home');
        $response->assertSee('About Us');
        $response->assertSee('OUR STORY');
        $response->assertSee('A Sweet Journey');
        $response->assertSee('Since 2010');
        $response->assertSee('From a small kitchen to countless celebrations, Ruchi Chocolates has been spreading happiness with handmade chocolates and thoughtful gifts for over a decade.');
        $response->assertSee('about-hero-hamper.jpg');
        $response->assertSee('rc-about-image-blend');

        // Statistics bar
        $response->assertSee('rc-about-stats-bar');
        $response->assertSee('50,000+');
        $response->assertSee('Happy Customers');
        $response->assertSee('10,000+');
        $response->assertSee('Hampers Delivered');
        $response->assertSee('4.8/5');
        $response->assertSee('Customer Rating');
        $response->assertSee('100%');
        $response->assertSee('Made with Love');

        // ==========================================
        // SECTION 2: WHY CHOOSE US (5 Items)
        // ==========================================
        $response->assertSee('rc-about-why-section');
        $response->assertSee('WHY CHOOSE US');
        $response->assertSee('Finest Ingredients');
        $response->assertSee('We use premium chocolate &amp; the finest ingredients.', false);
        $response->assertSee('Handcrafted with Love');
        $response->assertSee('Each bouquet and hamper is handmade with creativity, care, and attention to detail.');
        $response->assertSee('Perfect for Every Occasion');
        $response->assertSee('Birthday gifts, anniversary surprises, wedding hampers, festive gifting, and more.');
        $response->assertSee('Beautiful Packaging');
        $response->assertSee('Elegant presentation and premium packaging that instantly attracts attention.');
        $response->assertSee('Trusted by Customers');
        $response->assertSee('Loved by customers for our quality, creativity, and unique gifting experience.');

        // ==========================================
        // SECTION 3: OUR PROCESS (5-Step Timeline)
        // ==========================================
        $response->assertSee('rc-about-process-section');
        $response->assertSee('OUR PROCESS');
        $response->assertSee('rc-process-timeline');
        $response->assertSee('Carefully Selected');
        $response->assertSee('Creative Designing');
        $response->assertSee('Quality Checked with');
        $response->assertSee('Beautifully Packed for');
        $response->assertSee('Delivered with');

        // Verify vertical order in rendered HTML
        $content = $response->getContent();
        $posSection1 = strpos($content, 'our-story-section');
        $posStats = strpos($content, 'rc-about-stats-bar');
        $posSection2 = strpos($content, 'why-choose-us-section');
        $posSection3 = strpos($content, 'our-process-section');

        $this->assertNotFalse($posSection1);
        $this->assertNotFalse($posStats);
        $this->assertNotFalse($posSection2);
        $this->assertNotFalse($posSection3);

        $this->assertTrue($posSection1 < $posStats, 'Section 1 (Our Story) must appear before Statistics bar');
        $this->assertTrue($posStats < $posSection2, 'Statistics bar must appear before Section 2 (Why Choose Us)');
        $this->assertTrue($posSection2 < $posSection3, 'Section 2 (Why Choose Us) must appear before Section 3 (Our Process)');
    }
}
