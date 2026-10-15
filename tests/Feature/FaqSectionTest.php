<?php

namespace Tests\Feature;

use Tests\TestCase;

class FaqSectionTest extends TestCase
{
    /**
     * Test that the Contact page renders the FAQ section matching reference design below the map.
     */
    public function test_contact_page_renders_faq_section_exact_recreation(): void
    {
        $response = $this->get(route('contact'));

        $response->assertStatus(200);

        // Section & Container
        $response->assertSee('rc-faq-section');
        $response->assertSee('rc-faq-container');

        // Header Elements
        $response->assertSee('STILL HAVE QUESTIONS?');
        $response->assertSee('rc-faq-badge-flourish');
        $response->assertSee('Frequently Asked Questions');
        $response->assertSee('rc-faq-divider');

        // 4 FAQ Questions
        $response->assertSee('What are your delivery areas?');
        $response->assertSee('Can I customize a gift hamper?');
        $response->assertSee('How can I track my order?');
        $response->assertSee('What is your return or refund policy?');

        // 4 FAQ Answers
        $response->assertSee('We deliver across Ahmedabad and selected locations across India. Delivery availability and timelines may vary depending on the destination.');
        $response->assertSee('Yes. You can customize selected hampers with chocolates, gifts, packaging and personalized details based on availability.');
        $response->assertSee('Once your order is dispatched, you will receive tracking information through the contact details provided during checkout.');
        $response->assertSee('Please contact us as soon as possible if there is an issue with your order. Return or refund eligibility depends on the product and order condition.');

        // Icons & Chevrons
        $response->assertSee('rc-faq-icon-box');
        $response->assertSee('rc-faq-chevron');

        // Bottom Double-Heart & Flourish Decoration
        $response->assertSee('rc-faq-bottom-decor');
        $response->assertSee('rc-faq-bottom-svg');

        // Prior Sections Intact
        $response->assertSee('rc-contact-form-card');
        $response->assertSee('rc-contact-map-section');
    }
}
