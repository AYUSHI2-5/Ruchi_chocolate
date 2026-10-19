<?php

namespace Tests\Feature;

use Tests\TestCase;

class AiAssistantTest extends TestCase
{
    /**
     * Test that the AI assistant floating trigger and chat panel render on pages.
     */
    public function test_ai_assistant_ui_components_rendered_across_pages(): void
    {
        $pages = [
            route('home'),
            route('products'),
            route('customised-gifts'),
            route('about'),
            route('contact'),
            route('privacy-policy'),
            route('terms-and-conditions'),
        ];

        foreach ($pages as $url) {
            $response = $this->get($url);
            $response->assertStatus(200);

            // Floating trigger & avatar
            $response->assertSee('rcAiAssistantRoot');
            $response->assertSee('rcAiAvatarBtn');
            $response->assertSee('Ask Ruchi AI');
            $response->assertSee('ruchi-ai-avatar.jpg');
            $response->assertSee('ruchi-chef-avatar.png');
            $response->assertSee('rcAiCharacterFigure');
            $response->assertSee('rcAiCharacterImg');
            $response->assertSee('rcAiStatusDot');

            // Chat panel & welcome message
            $response->assertSee('rcAiChatPanel');
            $response->assertSee("Hi! I'm Ruchi's AI Assistant", false);
            $response->assertSee('Browse Products');
            $response->assertSee('Customise a Gift');
            $response->assertSee('Chat on WhatsApp');
            $response->assertDontSee('Track My Order');
            $response->assertDontSee('Delivery Info');
            $response->assertDontSee('Offers &amp; Deals', false);

            // Voice replies, mouth lip-sync & speech controls
            $response->assertSee('rcAiAvatarMouth');
            $response->assertSee('rcAiSpeechControlBar');
            $response->assertSee('rcAiSpeechPauseBtn');
            $response->assertSee('rcAiSpeechStopBtn');
            $response->assertSee('rcAiAutoplayPrompt');
            $response->assertSee('Enable Voice Replies');

            // Microphone button & speech recognition UI
            $response->assertSee('rcAiMicBtn');
            $response->assertSee('rcAiVoiceBanner');
            $response->assertSee('rcAiVoiceStatusText');
            $response->assertSee('rcAiVoiceCancelBtn');

            // Interactive Tour Guide Beacon & Animated Character Rig
            $response->assertSee('rcAiTourGuideBeacon');
            $response->assertSee('rcAiRigTrigger');
            $response->assertSee('rcAiBeaconReplayBtn');
            $response->assertSee('rcAiBeaconNextBtn');
        }
    }

    /**
     * Test the AI chat API endpoint with a general greeting.
     */
    public function test_ai_chat_api_greeting(): void
    {
        $response = $this->postJson(route('api.ai.chat'), [
            'message' => 'Hello',
            'language' => 'en',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);
        $response->assertJsonStructure([
            'success',
            'data' => [
                'message',
                'speech_text',
                'quick_replies',
            ],
        ]);
    }

    /**
     * Test the acceptance test: "Which chocolate gift is best for a birthday?"
     * Checks that the assistant returns a comprehensive message, speech_text, and product recommendations.
     */
    public function test_ai_chat_api_birthday_recommendation_and_voice_reply(): void
    {
        $response = $this->postJson(route('api.ai.chat'), [
            'message' => 'Which chocolate gift is best for a birthday?',
            'language' => 'en',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $data = $response->json('data');
        $this->assertNotEmpty($data['message']);
        $this->assertNotEmpty($data['speech_text']);
        $this->assertStringContainsString('Birthday', $data['speech_text']);
        $this->assertNotEmpty($data['products']);
        $this->assertIsArray($data['quick_replies']);
    }

    /**
     * Test product recommendation search by price.
     */
    public function test_ai_chat_api_product_search_by_price(): void
    {
        $response = $this->postJson(route('api.ai.chat'), [
            'message' => 'Show me chocolates under 300',
            'language' => 'en',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $data = $response->json('data');
        $this->assertNotEmpty($data['products']);
        foreach ($data['products'] as $product) {
            $this->assertLessThanOrEqual(300.0, (float) $product['price_raw']);
        }
    }

    /**
     * Test customisation enquiry.
     */
    public function test_ai_chat_api_customisation_enquiry(): void
    {
        $response = $this->postJson(route('api.ai.chat'), [
            'message' => 'Can I customise a chocolate gift box with a name?',
            'language' => 'en',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
        $this->assertStringContainsString('Customised', $response->json('data.message'));
        $this->assertEquals(route('customised-gifts'), $response->json('data.action_url'));
    }

    /**
     * Test shop pickup enquiry (no home delivery).
     */
    public function test_ai_chat_api_delivery_enquiry(): void
    {
        $response = $this->postJson(route('api.ai.chat'), [
            'message' => 'Do you provide delivery in Ahmedabad?',
            'language' => 'en',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
        $this->assertStringContainsString('Shop Pickup', $response->json('data.message'));
        $this->assertStringContainsString('not available', strtolower($response->json('data.message')));
    }

    /**
     * Test policies enquiry (Return & Refund).
     */
    public function test_ai_chat_api_return_policy_enquiry(): void
    {
        $response = $this->postJson(route('api.ai.chat'), [
            'message' => 'What is your return and refund policy?',
            'language' => 'en',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
        $this->assertStringContainsString('Return & Refund Guidelines', $response->json('data.message'));
        $this->assertNull($response->json('data.navigation'));
        $this->assertEquals('whatsapp', $response->json('data.action'));
    }

    /**
     * Test Hindi language response.
     */
    public function test_ai_chat_api_hindi_language(): void
    {
        $response = $this->postJson(route('api.ai.chat'), [
            'message' => 'नमस्ते! मुझे चॉकलेट्स देखनी हैं',
            'language' => 'hi',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
        $this->assertNotEmpty($response->json('data.message'));
    }

    /**
     * Test Gujarati language response.
     */
    public function test_ai_chat_api_gujarati_language(): void
    {
        $response = $this->postJson(route('api.ai.chat'), [
            'message' => 'નમસ્તે! મને ચોકલેટ ગિફ્ટ બોક્સ બતાવો',
            'language' => 'gu',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
        $this->assertNotEmpty($response->json('data.message'));
    }

    /**
     * Test validation failure on empty message.
     */
    public function test_ai_chat_api_validation_error(): void
    {
        $response = $this->postJson(route('api.ai.chat'), [
            'message' => '',
        ]);

        $response->assertStatus(422);
    }

    /**
     * Test natural voice navigation to About Us ("What is Ruchi Chocolates about?").
     */
    public function test_ai_chat_api_navigation_to_about_us(): void
    {
        $response = $this->postJson(route('api.ai.chat'), [
            'message' => 'What is Ruchi Chocolates about? Tell me your story.',
            'language' => 'en',
            'current_page' => '/',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $data = $response->json('data');
        $this->assertNotNull($data['navigation']);
        $this->assertTrue($data['navigation']['navigate']);
        $this->assertEquals(route('about'), $data['navigation']['url']);
        $this->assertNotEmpty($data['navigation']['pre_speech']);
        $this->assertNotEmpty($data['navigation']['explanation']);
        $this->assertStringContainsString('About Us', $data['navigation']['pre_speech']);
    }

    /**
     * Test natural voice navigation to Our Products ("Show me the chocolates you sell").
     */
    public function test_ai_chat_api_navigation_to_products(): void
    {
        $response = $this->postJson(route('api.ai.chat'), [
            'message' => 'Show me the chocolates you sell.',
            'language' => 'en',
            'current_page' => '/',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $data = $response->json('data');
        $this->assertNotNull($data['navigation']);
        $this->assertTrue($data['navigation']['navigate']);
        $this->assertEquals(route('products'), $data['navigation']['url']);
        $this->assertNotEmpty($data['navigation']['explanation']);
        $this->assertStringContainsStringIgnoringCase('Same options as our Products menu', $data['navigation']['explanation']['message']);
        $this->assertContains('Diwali 🪔', $data['navigation']['explanation']['quick_replies']);
        $this->assertContains('Birthday 🎂', $data['navigation']['explanation']['quick_replies']);
        $this->assertContains('Gifting 🎁', $data['navigation']['explanation']['quick_replies']);
        $this->assertStringNotContainsString('Rakhi', $data['navigation']['explanation']['message']);
        $this->assertNotContains('New Born', $data['navigation']['explanation']['quick_replies']);
    }

    public function test_browse_products_gifting_opens_full_catalog_slice(): void
    {
        $response = $this->postJson(route('api.ai.chat'), [
            'message' => 'Gifting 🎁',
            'language' => 'en',
            'current_page' => '/products',
        ]);

        $response->assertStatus(200);
        $data = $response->json('data');
        $this->assertStringContainsString('Gifting', $data['message']);
        $this->assertNotEmpty($data['products']);
        $this->assertStringContainsString('category=gifting', $data['action_url']);
        $this->assertNull($data['navigation']);
        $this->assertLessThanOrEqual(3, count($data['products']));
    }

    public function test_browse_products_diwali_shows_festival_catalog_items(): void
    {
        $response = $this->postJson(route('api.ai.chat'), [
            'message' => 'Diwali 🪔',
            'language' => 'en',
            'current_page' => '/products',
        ]);

        $response->assertStatus(200);
        $data = $response->json('data');
        $this->assertStringContainsString('Diwali', $data['message']);
        $this->assertNotEmpty($data['products']);
        $titles = array_column($data['products'], 'title');
        $this->assertContains('Golden Metal Box', $titles);
        $this->assertStringContainsString('category=diwali', $data['action_url']);
        $this->assertNull($data['navigation']);
        $this->assertLessThanOrEqual(3, count($data['products']));
    }

    public function test_browse_anniversary_shows_sample_in_chat_without_page_redirect(): void
    {
        $response = $this->postJson(route('api.ai.chat'), [
            'message' => 'Anniversary 💕',
            'language' => 'en',
            'current_page' => '/products',
        ]);

        $response->assertStatus(200);
        $data = $response->json('data');
        $this->assertStringContainsString('Anniversary', $data['message']);
        $this->assertNull($data['navigation']);
        $this->assertGreaterThanOrEqual(1, count($data['products']));
        $this->assertLessThanOrEqual(3, count($data['products']));
        $this->assertStringContainsString('category=anniversary', $data['action_url']);
        $this->assertStringContainsString('View All', $data['action_label']);
    }

    /**
     * Test natural voice navigation to Customised Gifts ("I want to customise a gift").
     */
    public function test_ai_chat_api_navigation_to_customised_gifts(): void
    {
        $response = $this->postJson(route('api.ai.chat'), [
            'message' => 'I want to customise a gift.',
            'language' => 'en',
            'current_page' => '/',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $data = $response->json('data');
        $this->assertNotNull($data['navigation']);
        $this->assertTrue($data['navigation']['navigate']);
        $this->assertEquals(route('customised-gifts'), $data['navigation']['url']);
    }

    /**
     * Test natural voice navigation to Contact Us ("Where can I contact you?").
     */
    public function test_ai_chat_api_navigation_to_contact_us(): void
    {
        $response = $this->postJson(route('api.ai.chat'), [
            'message' => 'Where can I contact you?',
            'language' => 'en',
            'current_page' => '/',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $data = $response->json('data');
        $this->assertNotNull($data['navigation']);
        $this->assertTrue($data['navigation']['navigate']);
        $this->assertEquals(route('contact'), $data['navigation']['url']);
    }

    public function test_contact_page_greeting_prompts_query_submission(): void
    {
        $response = $this->postJson(route('api.ai.chat'), [
            'message' => 'Hello',
            'language' => 'en',
            'current_page' => '/contact',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $data = $response->json('data');
        $this->assertStringContainsString('submit a query', strtolower($data['message']));
        $this->assertContains('Submit a Query 📝', $data['quick_replies']);
    }

    public function test_contact_page_starts_contact_form_intake(): void
    {
        $response = $this->postJson(route('api.ai.chat'), [
            'message' => 'Submit a Query 📝',
            'language' => 'en',
            'current_page' => '/contact',
            'contact_form' => ['step' => null, 'fields' => []],
        ]);

        $response->assertStatus(200);
        $data = $response->json('data');
        $this->assertSame('name', $data['contact_form']['step']);
        $this->assertStringContainsString('full name', strtolower($data['message']));
    }

    public function test_contact_form_intake_skips_prefilled_fields_and_completes(): void
    {
        $fields = [
            'name' => 'Priya Shah',
            'email' => 'priya@example.com',
            'phone' => '',
            'subject' => '',
            'message' => '',
            'phone_skipped' => false,
        ];

        $response = $this->postJson(route('api.ai.chat'), [
            'message' => 'Submit a Query 📝',
            'language' => 'en',
            'current_page' => '/contact',
            'contact_form' => ['step' => null, 'fields' => $fields],
        ]);

        $response->assertStatus(200);
        $this->assertSame('phone', $response->json('data.contact_form.step'));

        $fields['phone_skipped'] = true;

        $response = $this->postJson(route('api.ai.chat'), [
            'message' => 'skip',
            'language' => 'en',
            'current_page' => '/contact',
            'contact_form' => ['step' => 'phone', 'fields' => $fields],
        ]);

        $this->assertSame('subject', $response->json('data.contact_form.step'));

        $fields['phone_skipped'] = true;

        $response = $this->postJson(route('api.ai.chat'), [
            'message' => 'Custom hamper for anniversary',
            'language' => 'en',
            'current_page' => '/contact',
            'contact_form' => ['step' => 'subject', 'fields' => $fields],
        ]);

        $this->assertSame('message', $response->json('data.contact_form.step'));

        $fields['subject'] = 'Custom hamper for anniversary';

        $response = $this->postJson(route('api.ai.chat'), [
            'message' => 'Need 24 pieces with name lettering by next Saturday.',
            'language' => 'en',
            'current_page' => '/contact',
            'contact_form' => ['step' => 'message', 'fields' => $fields],
        ]);

        $data = $response->json('data');
        $this->assertSame('complete', $data['contact_form']['step']);
        $this->assertSame('prefill_contact_form', $data['action']);
        $this->assertSame('Send on WhatsApp', $data['action_label']);
        $this->assertSame('Priya Shah', $data['contact_form']['fields']['name']);
        $this->assertSame('Need 24 pieces with name lettering by next Saturday.', $data['contact_form']['fields']['message']);
        $this->assertStringContainsString('wa.me', $data['action_url']);
        $decodedUrl = rawurldecode($data['action_url']);
        $this->assertStringContainsString('Priya Shah', $decodedUrl);
        $this->assertStringContainsString('priya@example.com', $decodedUrl);
        $this->assertStringContainsString('Custom hamper for anniversary', $decodedUrl);
        $this->assertStringContainsString('Need 24 pieces with name lettering by next Saturday.', $decodedUrl);
    }

    /**
     * Test ambiguous policy question asks clarifying question rather than jumping.
     */
    public function test_ai_chat_api_ambiguous_policy_clarification(): void
    {
        $response = $this->postJson(route('api.ai.chat'), [
            'message' => 'What is your policy?',
            'language' => 'en',
            'current_page' => '/',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $data = $response->json('data');
        $this->assertNull($data['navigation']);
        $this->assertStringContainsString('policy pages', $data['message']);
        $this->assertContains('Privacy Policy 🛡️', $data['quick_replies']);
        $this->assertContains('Terms & Conditions 📜', $data['quick_replies']);
    }

    /**
     * Test page-aware follow-up question when user is already on About page.
     */
    public function test_ai_chat_api_page_aware_follow_up_on_about_page(): void
    {
        $response = $this->postJson(route('api.ai.chat'), [
            'message' => 'When was Ruchi Chocolates founded and who started it?',
            'language' => 'en',
            'current_page' => '/about',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $data = $response->json('data');
        // Since already on About page, no redirect needed, directly grounded explanation provided
        $this->assertNull($data['navigation']);
        $this->assertStringContainsString('2010', $data['message']);
    }

    /**
     * Test that asking for brand story when already on About page explains without redirecting.
     */
    public function test_ai_chat_api_already_on_about_page_does_not_redirect(): void
    {
        $response = $this->postJson(route('api.ai.chat'), [
            'message' => 'What is Ruchi Chocolates about?',
            'language' => 'en',
            'current_page' => '/about',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $data = $response->json('data');
        $this->assertNull($data['navigation']);
        $this->assertStringContainsString('About Us', $data['message']);
    }

    /**
     * Test progressive next section explanation on About Us page.
     */
    public function test_ai_chat_api_progressive_explanation_next_section_about_page(): void
    {
        $response = $this->postJson(route('api.ai.chat'), [
            'message' => 'Explain the next section',
            'language' => 'en',
            'current_page' => '/about',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $data = $response->json('data');
        $this->assertNull($data['navigation']);
        $this->assertStringContainsString('Milestones', $data['message']);
        $this->assertStringContainsString('50,000+', $data['message']);
        $this->assertNotEmpty($data['speech_text']);
    }

    /**
     * Test progressive explanation and follow-up on Our Products page.
     */
    public function test_ai_chat_api_progressive_explanation_products_page(): void
    {
        // 1. Navigation query
        $navResponse = $this->postJson(route('api.ai.chat'), [
            'message' => 'Tell me about your products.',
            'language' => 'en',
            'current_page' => '/',
        ]);
        $navResponse->assertStatus(200);
        $this->assertTrue($navResponse->json('data.navigation.navigate'));
        $this->assertEquals(route('products'), $navResponse->json('data.navigation.url'));
        $this->assertNotEmpty($navResponse->json('data.navigation.explanation.speech_text'));

        // 2. Follow-up on Products page
        $followUpResponse = $this->postJson(route('api.ai.chat'), [
            'message' => 'Tell me more about your tin boxes and prices.',
            'language' => 'en',
            'current_page' => '/products',
        ]);
        $followUpResponse->assertStatus(200);
        $data = $followUpResponse->json('data');
        $this->assertNull($data['navigation']);
        $this->assertStringContainsString('Heart Tins', $data['message']);
        $this->assertStringContainsString('170', $data['message']);
        $this->assertNotEmpty($data['speech_text']);
    }

    /**
     * Test progressive explanation and follow-up on Customised Gifts page.
     */
    public function test_ai_chat_api_progressive_explanation_customised_gifts_page(): void
    {
        // 1. Navigation query
        $navResponse = $this->postJson(route('api.ai.chat'), [
            'message' => 'How can I customise a gift?',
            'language' => 'en',
            'current_page' => '/',
        ]);
        $navResponse->assertStatus(200);
        $this->assertTrue($navResponse->json('data.navigation.navigate'));
        $this->assertEquals(route('customised-gifts'), $navResponse->json('data.navigation.url'));
        $this->assertNotEmpty($navResponse->json('data.navigation.explanation.speech_text'));

        // 2. Follow-up on Customised Gifts page
        $followUpResponse = $this->postJson(route('api.ai.chat'), [
            'message' => 'How to Submit Order 📝',
            'language' => 'en',
            'current_page' => '/customised-gifts',
        ]);
        $followUpResponse->assertStatus(200);
        $data = $followUpResponse->json('data');
        $this->assertNull($data['navigation']);
        $this->assertStringContainsStringIgnoringCase('WhatsApp', $data['message']);
        $this->assertStringContainsStringIgnoringCase('description', $data['message']);
        $this->assertNotEmpty($data['speech_text']);
    }

    public function test_customised_gifts_chat_description_prefills_whatsapp_enquiry(): void
    {
        $description = 'I need a birthday hamper with 24 dark truffles and name lettering for Saturday delivery in Ahmedabad.';

        $response = $this->postJson(route('api.ai.chat'), [
            'message' => $description,
            'language' => 'en',
            'current_page' => '/customised-gifts',
        ]);

        $response->assertStatus(200);
        $data = $response->json('data');
        $this->assertSame('prefill_customisation_form', $data['action']);
        $this->assertSame($description, $data['customisation_details']);
        $this->assertSame('complete', $data['customisation_intake']);
        $this->assertStringContainsString('wa.me', $data['action_url']);
        $this->assertStringContainsString('birthday', strtolower($data['action_url']));
    }

    public function test_customised_gifts_chat_description_captured_when_awaiting_intake_flag(): void
    {
        $description = 'Red and gold theme only';

        $response = $this->postJson(route('api.ai.chat'), [
            'message' => $description,
            'language' => 'en',
            'current_page' => '/',
            'customisation_intake' => ['awaiting_description' => true],
        ]);

        $response->assertStatus(200);
        $data = $response->json('data');
        $this->assertSame('prefill_customisation_form', $data['action']);
        $this->assertSame($description, $data['customisation_details']);
    }

    public function test_customised_gifts_guide_sets_awaiting_intake_state(): void
    {
        $response = $this->postJson(route('api.ai.chat'), [
            'message' => 'How to Submit Order 📝',
            'language' => 'en',
            'current_page' => '/customised-gifts',
        ]);

        $response->assertStatus(200);
        $this->assertSame('awaiting_description', $response->json('data.customisation_intake'));
    }

    public function test_customised_gifts_welcome_speech_focuses_on_description_and_whatsapp(): void
    {
        $response = $this->postJson(route('api.ai.chat'), [
            'message' => 'Show me customised gifts',
            'language' => 'en',
            'current_page' => '/',
        ]);

        $speech = $response->json('data.navigation.explanation.speech_text');
        $this->assertStringContainsStringIgnoringCase('WhatsApp', $speech);
        $this->assertStringNotContainsStringIgnoringCase('letter blocks', $speech);
    }

    /**
     * Acceptance Test 1: "Tell me about Ruchi."
     * Avatar navigates to About Us, highlights relevant section, and explains aloud with speaking animation.
     */
    public function test_acceptance_tell_me_about_ruchi(): void
    {
        $response = $this->postJson(route('api.ai.chat'), [
            'message' => 'Tell me about Ruchi',
            'language' => 'en',
            'current_page' => '/',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $data = $response->json('data');
        $this->assertNotNull($data['navigation']);
        $this->assertTrue($data['navigation']['navigate']);
        $this->assertEquals(route('about'), $data['navigation']['url']);

        // Check target section and gesture
        $this->assertNotNull($data['section_target']);
        $this->assertEquals('#our-story-section', $data['section_target']['selector']);
        $this->assertEquals('pointing', $data['section_target']['gesture']);
        $this->assertTrue($data['section_target']['scroll']);
        $this->assertTrue($data['section_target']['highlight']);

        // Check spoken explanation
        $this->assertNotEmpty($data['speech_text']);
        $this->assertNotEmpty($data['navigation']['explanation']['speech_text']);
    }

    /**
     * Acceptance Test 2: "Show me customised gifts."
     * Avatar opens Customised Gifts, guides customer to enquiry form, and explains how to use it.
     */
    public function test_acceptance_show_me_customised_gifts(): void
    {
        $response = $this->postJson(route('api.ai.chat'), [
            'message' => 'Show me customised gifts',
            'language' => 'en',
            'current_page' => '/',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $data = $response->json('data');
        $this->assertNotNull($data['navigation']);
        $this->assertTrue($data['navigation']['navigate']);
        $this->assertEquals(route('customised-gifts'), $data['navigation']['url']);

        // Check target section is the customisation form
        $this->assertNotNull($data['section_target']);
        $this->assertEquals('.rc-custom-form-card', $data['section_target']['selector']);
        $this->assertEquals('pointing', $data['section_target']['gesture']);

        // Check spoken explanation explains how to submit enquiry
        $this->assertNotEmpty($data['navigation']['explanation']['speech_text']);
        $this->assertStringContainsStringIgnoringCase('description', $data['navigation']['explanation']['message']);
    }

    /**
     * Acceptance Test 3: "Explain the return policy."
     * Avatar explains return guidelines inline and offers WhatsApp support.
     */
    public function test_acceptance_explain_return_policy(): void
    {
        $response = $this->postJson(route('api.ai.chat'), [
            'message' => 'Explain the return policy',
            'language' => 'en',
            'current_page' => '/',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $data = $response->json('data');
        $this->assertNull($data['navigation']);
        $this->assertNotEmpty($data['speech_text']);
        $this->assertStringContainsStringIgnoringCase('perishable', $data['message']);
        $this->assertEquals('whatsapp', $data['action']);
    }

    /**
     * Acceptance Test 4: "Stop speaking."
     * Audio stops immediately and avatar returns to idle state.
     */
    public function test_acceptance_stop_speaking(): void
    {
        $response = $this->postJson(route('api.ai.chat'), [
            'message' => 'Stop speaking',
            'language' => 'en',
            'current_page' => '/about',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $data = $response->json('data');
        $this->assertEquals('stop_speech', $data['action']);
        $this->assertEquals('idle', $data['avatar_gesture']);
        $this->assertEmpty($data['speech_text']);
        $this->assertStringContainsStringIgnoringCase('stopped speaking', $data['message']);
    }

    /**
     * Acceptance Test 5: "Explain that again."
     * Avatar repeats explanation aloud for current page.
     */
    public function test_acceptance_explain_that_again(): void
    {
        $response = $this->postJson(route('api.ai.chat'), [
            'message' => 'Explain that again',
            'language' => 'en',
            'current_page' => '/about',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $data = $response->json('data');
        $this->assertNotEmpty($data['speech_text']);
        $this->assertStringContainsStringIgnoringCase('Ruchi Chocolates', $data['message']);
        $this->assertNotNull($data['section_target']);
        $this->assertEquals('#our-story-section', $data['section_target']['selector']);
    }
}
