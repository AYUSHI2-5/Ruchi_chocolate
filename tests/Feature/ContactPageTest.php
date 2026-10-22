<?php

namespace Tests\Feature;

use Tests\TestCase;

class ContactPageTest extends TestCase
{
    /**
     * Test that the Contact page renders all reference design elements and contact information.
     */
    public function test_contact_page_renders_all_required_elements_exact_recreation(): void
    {
        $response = $this->get(route('contact'));

        $response->assertStatus(200);

        // Layout Containers
        $response->assertSee('rc-contact-page-wrapper');
        $response->assertSee('rc-contact-container');
        $response->assertSee('rc-contact-grid');

        // Left Side: "Send Us a Message" Card
        $response->assertSee('Send Us a Message');
        $response->assertSee('your details will open in WhatsApp', false);
        $response->assertSee('Your Name');
        $response->assertSee('Email Address');
        $response->assertSee('Phone Number');
        $response->assertSee('Subject');
        $response->assertSee('Your Message');
        $response->assertSee('Send Message on WhatsApp');
        $response->assertSee('review the message in WhatsApp');
        $response->assertSee('rc-form-flower-decor');

        // Right Side: "Get in Touch" Section
        $response->assertSee('Get in Touch');
        $response->assertSee("We're here to help! Reach out to us through any of the following channels.", false);

        // 4 Contact Cards
        $response->assertSee('Our Address');
        $response->assertSee(config('ruchi.address'));

        $response->assertSee('Call Us');
        $response->assertSee(config('ruchi.phone_display'));

        $response->assertSee('Email Us');
        $response->assertSee(config('ruchi.email'));
        $response->assertSee('We reply within 24 hours');

        $response->assertSee('Business Hours');
        $response->assertSee('Mon - Sat: 9:00 AM - 9:00 PM');
        $response->assertSee('Sun: 10:00 AM - 6:00 PM');

        // Follow Us Card & Social Icons
        $response->assertSee('Follow Us &amp; Stay Updated', false);
        $response->assertSee('Stay connected for new arrivals, offers &amp; sweet surprises!', false);
        $response->assertSee('instagram.com/ruchichocolates09');
        $response->assertSee('facebook.com/RuchiHomemadeChocolates');
        $response->assertDontSee('pinterest.com/ruchichocolate');
        $response->assertDontSee('youtube.com/ruchichocolate');

        // New Map Section & Overlaid Information Card
        $response->assertSee('rc-contact-map-section');
        $response->assertSee('rc-contact-map-container');
        $response->assertSee('rc-contact-map-wrapper');
        $response->assertSee('rc-contact-map-iframe');
        $response->assertSee(rawurlencode(config('ruchi.address')), false);
        $response->assertSee('rc-contact-map-card');
        $response->assertSee('Ruchi Chocolate');
        $response->assertSee('View on Google Maps');
        $response->assertSee('google.com/maps/search/', false);
        $response->assertSee(rawurlencode(config('ruchi.address')), false);

        // FAQ Section on Contact Page
        $response->assertSee('rc-faq-section');
        $response->assertSee('STILL HAVE QUESTIONS?');
        $response->assertSee('Frequently Asked Questions');
        $response->assertSee('rc-faq-divider');
        $response->assertSee('Do you offer home delivery?');
        $response->assertSee('Can I customize a gift hamper?');
        $response->assertSee('How will I know when my order is ready?');
        $response->assertSee('What is your return or refund policy?');
        $response->assertSee(config('ruchi.shop_pickup_notice'));
        $response->assertSee('Yes. You can customize selected hampers with chocolates, gifts, packaging and personalized details based on availability.');
        $response->assertSee('pickup-ready updates on WhatsApp');
        $response->assertSee('Please contact us as soon as possible if there is an issue with your order.');
        $response->assertSee('rc-faq-bottom-decor');

        // Floating WhatsApp Button
        $response->assertDontSee('rc-whatsapp-float');
    }

    /**
     * Test that the contact form handles submissions with validation and success messages.
     */
    public function test_contact_form_submission_and_validation(): void
    {
        // 1. Submit valid message
        $response = $this->post(route('contact.submit'), [
            'name' => 'Rahul Sharma',
            'email' => 'rahul@example.com',
            'phone' => '+91 9876543210',
            'subject' => 'Custom Bouquet Inquiry',
            'message' => 'I would like to order a customized chocolate bouquet for an anniversary.',
        ]);

        $response->assertRedirect();
        $target = $response->headers->get('Location');
        $this->assertNotNull($target);
        $this->assertStringStartsWith(config('ruchi.whatsapp_url'), $target);
        $this->assertStringContainsString(rawurlencode('Rahul Sharma'), $target);
        $this->assertStringContainsString(rawurlencode('Custom Bouquet Inquiry'), $target);
        $this->assertStringContainsString(rawurlencode('rahul@example.com'), $target);

        // 2. Submit invalid message (missing required fields)
        $invalidResponse = $this->post(route('contact.submit'), [
            'name' => '',
            'email' => 'invalid-email',
            'subject' => '',
            'message' => '',
        ]);

        $invalidResponse->assertSessionHasErrors(['name', 'email', 'subject', 'message']);
    }

    /**
     * Test that the Contact page has exactly one H1 describing page purpose
     * and preserves the inquiry form heading as an H2.
     */
    public function test_contact_page_has_single_meaningful_h1_and_h2_inquiry_form(): void
    {
        $response = $this->get(route('contact'));
        $response->assertStatus(200);

        $content = $response->getContent();

        // Exactly one H1 tag
        $this->assertSame(1, substr_count($content, '<h1'), 'Contact page must have exactly one H1.');
        $this->assertStringContainsString('Contact Ruchi Chocolates', $content);

        // Inquiry form heading is an H2
        $this->assertStringContainsString('<h2 class="rc-contact-main-title">Send Us a Message</h2>', $content);
    }
}

