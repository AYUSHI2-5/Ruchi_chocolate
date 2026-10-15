<?php

namespace Tests\Feature;

use Tests\TestCase;

class TermsAndConditionsPageTest extends TestCase
{
    /**
     * Test that the Terms & Conditions page returns a 200 OK status and contains all required sections.
     */
    public function test_terms_and_conditions_page_renders_successfully(): void
    {
        $response = $this->get(route('terms-and-conditions'));

        $response->assertStatus(200);

        // Standard Shared Header & Continuous Marquee Announcement Bar
        $response->assertSee('announcement-bar-marquee');
        $response->assertSee('Handmade with Love');
        $response->assertSee('Exclusive Gift Hampers');
        $response->assertSee('rc-main-nav-bar');
        $response->assertSee('Home');
        $response->assertSee('Our Products');
        $response->assertSee('Customised Gifts');
        $response->assertSee('About Us');
        $response->assertSee('Contact Us');
        $response->assertSee('Enquire on WhatsApp');

        // Hero Section & Breadcrumb
        $response->assertSee('rc-policy-hero-section', false);
        $response->assertSee('Home');
        $response->assertSee('Terms &amp; Conditions', false);
        $response->assertSee('Welcome to Ruchi Chocolates. These terms explain the conditions that apply');
        $response->assertSee('terms-hero-hamper.jpg');

        // All 13 Terms Cards
        $response->assertSee('1. Acceptance of Terms');
        $response->assertSee('2. Products and Descriptions');
        $response->assertSee('3. Orders and Confirmation');
        $response->assertSee('4. Pricing and Payment');
        $response->assertSee('5. Customised Products');
        $response->assertSee('6. Delivery');
        $response->assertSee('7. Cancellations, Returns, and Refunds');
        $response->assertSee('8. Customer Responsibilities');
        $response->assertSee('9. Intellectual Property');
        $response->assertSee('10. Website Availability');
        $response->assertSee('11. Privacy');
        $response->assertSee('12. Changes to These Terms');
        $response->assertSee('13. Contact Us');

        // Working link to Privacy Policy
        $response->assertSee(route('privacy-policy'));
        $response->assertSee('24 hours of delivery');

        // Contact Info & Chocolate Stack Decoration
        $response->assertSee(config('ruchi.email'));
        $response->assertSee(config('ruchi.phone_display'));
        $response->assertSee('Ahmedabad, Gujarat, India');
        $response->assertSee('chocolate-stack.jpg');

        // Standard Shared Footer
        $response->assertSee('rc-footer-section', false);
        $response->assertSee('CUSTOMER CARE');
        $response->assertSee('Terms &amp; Conditions', false);
        $response->assertSee('All Rights Reserved.');
    }

    /**
     * Test that the /terms alias redirects to the Terms & Conditions page.
     */
    public function test_terms_alias_redirects_to_terms_and_conditions(): void
    {
        $response = $this->get('/terms');
        $response->assertRedirect(route('terms-and-conditions'));
    }

    /**
     * Test that the Customer Service section contains the Terms & Conditions link across pages.
     */
    public function test_footer_customer_service_terms_and_conditions_link_across_pages(): void
    {
        $pages = [
            route('home'),
            route('products'),
            route('about'),
            route('contact'),
            route('privacy-policy'),
            route('terms-and-conditions'),
        ];

        foreach ($pages as $url) {
            $response = $this->get($url);
            $response->assertStatus(200);
            $response->assertSee(route('terms-and-conditions'));
            $response->assertSee('Terms &amp; Conditions', false);
        }
    }
}
