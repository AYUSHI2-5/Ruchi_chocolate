<?php

namespace Tests\Feature;

use Tests\TestCase;

class PrivacyPolicyPageTest extends TestCase
{
    /**
     * Test that the Privacy Policy page returns a 200 OK status and contains all required sections.
     */
    public function test_privacy_policy_page_renders_successfully(): void
    {
        $response = $this->get(route('privacy-policy'));

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
        $response->assertSee('Privacy Policy');
        $response->assertSee('Your trust means a lot to us');
        $response->assertSee('privacy-hero-box.jpg');

        // All 7 Policy Cards
        $response->assertSee('1. Information We Collect');
        $response->assertSee('2. How We Use Your Information');
        $response->assertSee('3. Sharing of Information');
        $response->assertDontSee('Cookies');
        $response->assertSee('4. Data Protection');
        $response->assertSee('5. Your Choices');
        $response->assertSee('6. Updates to This Policy');
        $response->assertSee('7. Contact Us');

        // Card Content & Contact Info
        $response->assertSee(config('ruchi.email'));
        $response->assertSee(config('ruchi.phone_display'));
        $response->assertSee('Ahmedabad, Gujarat, India');
        $response->assertSee('chocolate-stack.jpg');

        // Standard Shared Footer
        $response->assertSee('rc-footer-section', false);
        $response->assertSee('CUSTOMER CARE');
        $response->assertSee('Privacy Policy');
        $response->assertSee('All Rights Reserved.');
    }

    /**
     * Test that clicking policy links from other pages routes properly.
     */
    public function test_privacy_policy_link_accessible_from_home(): void
    {
        $homeResponse = $this->get(route('home'));
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee(route('privacy-policy'));
    }

    /**
     * Test that the Customer Service section contains the Privacy Policy link across pages.
     */
    public function test_footer_customer_service_privacy_policy_link_across_pages(): void
    {
        $pages = [
            route('home'),
            route('products'),
            route('about'),
            route('contact'),
        ];

        foreach ($pages as $url) {
            $response = $this->get($url);
            $response->assertStatus(200);
            $response->assertSee(route('privacy-policy'));
            $response->assertSee('Privacy Policy');
        }
    }
}
