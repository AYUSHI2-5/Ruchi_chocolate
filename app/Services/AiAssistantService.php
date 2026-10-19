<?php

namespace App\Services;

class AiAssistantService
{
    public function __construct(
        protected ProductCatalogService $catalogService,
        protected ContactWhatsAppInquiry $contactWhatsAppInquiry
    ) {}

    /**
     * Process an incoming user message and return an AI assistant response.
     *
     * @param  string  $language  'en', 'hi', or 'gu'
     * @param  array<int, array<string, string>>  $history
     * @param  string|null  $currentPage  Current URL pathname or route name
     * @return array<string, mixed>
     */
    public function processMessage(string $message, string $language = 'en', array $history = [], ?string $currentPage = null, array $contactForm = [], array $customisationIntake = []): array
    {
        $trimmedMessage = trim($message);
        if ($trimmedMessage === '') {
            return $this->formatFinalResponse([
                'message' => 'Please type or speak a question about our chocolates or gifts.',
                'speech_text' => 'Please type or speak a question about our chocolates or gifts.',
            ]);
        }

        $normalized = mb_strtolower($trimmedMessage, 'UTF-8');
        $detectedLang = $this->detectLanguage($normalized, $language);

        $response = $this->dispatchIntent($normalized, $trimmedMessage, $detectedLang, $currentPage, $contactForm, $history, $customisationIntake);

        return $this->formatFinalResponse($response);
    }

    /**
     * Dispatch user input to navigation or inquiry handlers.
     *
     * @return array<string, mixed>
     */
    protected function dispatchIntent(string $normalized, string $trimmedMessage, string $detectedLang, ?string $currentPage, array $contactForm = [], array $history = [], array $customisationIntake = []): array
    {
        // 0. Direct Voice Commands & Assistant Controls
        // 0A. "Stop speaking" / "Stop"
        if ($this->isStopSpeakingIntent($normalized)) {
            return [
                'message' => "I have stopped speaking. I'm right here whenever you'd like to continue! 😊",
                'speech_text' => '',
                'avatar_gesture' => 'idle',
                'action' => 'stop_speech',
                'quick_replies' => ['Explain That Again 🔁', 'Go to Next Section ➡️', 'Show Products 🎁'],
            ];
        }

        // 0B. "Explain that again" / "Repeat that"
        if ($this->isRepeatIntent($normalized)) {
            return $this->handleRepeatLastExplanation($currentPage, $detectedLang);
        }

        // 0C. "Take me back" / "Go back"
        if ($this->isGoBackIntent($normalized)) {
            return $this->handleGoBack($currentPage, $detectedLang);
        }

        if ($this->isCurrentPage($currentPage, 'contact')) {
            $contactFormIntake = $this->handleContactFormIntake($trimmedMessage, $normalized, $detectedLang, $contactForm);
            if ($contactFormIntake !== null) {
                return $contactFormIntake;
            }
        }

        if ($this->shouldCaptureCustomGiftDescription($trimmedMessage, $normalized, $currentPage, $history, $customisationIntake)) {
            return $this->buildCustomisedGiftsWhatsAppFromDescription($trimmedMessage, $detectedLang);
        }

        // 1. Ambiguous navigation clarification (e.g. customer just says "policy" or "open policy")
        if (preg_match('/^(take me to|show|explain|open|what is (your )?)?(the )?policy\??$/ui', $normalized) || $normalized === 'policy' || $normalized === 'policies') {
            return $this->handleAmbiguousPolicy($detectedLang);
        }

        // 2. Check for Page-Aware Follow-Up Questions (grounded in the current page content)
        if (! empty($currentPage)) {
            $followUp = $this->handlePageAwareFollowUp($normalized, $currentPage, $detectedLang);
            if ($followUp !== null) {
                return $followUp;
            }
        }

        // 3. Conversational Navigation & Page Explanations
        // 3A. Brand Story / About Us
        if ($this->isAboutIntent($normalized)) {
            $isAlreadyOnPage = $this->isCurrentPage($currentPage, 'about');

            return $this->handleNavigateAboutUs($detectedLang, $isAlreadyOnPage);
        }

        // 3B. Chocolates Sold / Our Products / Catalogue
        if ($this->isProductsIntent($normalized)) {
            $isAlreadyOnPage = $this->isCurrentPage($currentPage, 'products');

            return $this->handleNavigateProducts($normalized, $detectedLang, $isAlreadyOnPage);
        }

        // 3C. Customised Gifts
        if ($this->isCustomisedIntent($normalized)) {
            $isAlreadyOnPage = $this->isCurrentPage($currentPage, 'customised-gifts');

            return $this->handleNavigateCustomisedGifts($detectedLang, $isAlreadyOnPage);
        }

        // 3D. Return & Refund inquiries (inline guidance; no dedicated policy page)
        if ($this->isReturnPolicyIntent($normalized)) {
            return $this->handleReturnRefundInformation($detectedLang);
        }

        // 3E. Contact Us / Studio Location
        if ($this->isContactIntent($normalized)) {
            $isAlreadyOnPage = $this->isCurrentPage($currentPage, 'contact');

            return $this->handleNavigateContactUs($detectedLang, $isAlreadyOnPage);
        }

        // 3F. Privacy Policy
        if ($this->isPrivacyPolicyIntent($normalized)) {
            $isAlreadyOnPage = $this->isCurrentPage($currentPage, 'privacy-policy');

            return $this->handleNavigatePrivacyPolicy($detectedLang, $isAlreadyOnPage);
        }

        // 3G. Terms & Conditions
        if ($this->isTermsIntent($normalized)) {
            $isAlreadyOnPage = $this->isCurrentPage($currentPage, 'terms-and-conditions');

            return $this->handleNavigateTermsConditions($detectedLang, $isAlreadyOnPage);
        }

        // 3H. Home Page Navigation
        if ($this->isHomeIntent($normalized)) {
            $isAlreadyOnPage = $this->isCurrentPage($currentPage, 'home');

            return $this->handleNavigateHome($detectedLang, $isAlreadyOnPage);
        }

        // 4. Non-Navigation Direct Inquiries (Answer directly without redirecting)
        // 4A. Delivery details
        if ($this->matchesIntent($normalized, ['delivery', 'shipping', 'courier', 'dispatch', 'pincode', 'home delivery', 'pickup', 'collect from shop', 'shop pickup', 'डिलीवरी', 'पिकअप', 'ડિલિવરી', 'પિકઅપ'])) {
            return $this->handleDeliveryInformation($detectedLang);
        }

        // 4B. Order tracking
        if ($this->matchesIntent($normalized, ['track', 'track order', 'status', 'where is my order', 'order id', 'ऑर्डर स्टेटस', 'ऑर्डर कहां है'])) {
            return $this->handleTrackOrder($normalized, $detectedLang);
        }

        // 4C. Offers and discounts
        if ($this->matchesIntent($normalized, ['offer', 'offers', 'deal', 'deals', 'discount', 'coupon', 'sale', 'छूट', 'ऑफर', 'ઓફર', 'ડિસ્કાઉન્ટ'])) {
            return $this->handleOffersAndDeals($detectedLang);
        }

        // 4D. Human contact fallback
        if ($this->matchesIntent($normalized, ['human', 'talk to human', 'agent', 'support', 'owner', 'इंसान', 'बात करनी'])) {
            return $this->handleTalkToHuman($detectedLang);
        }

        // 4E. Price search (e.g. "under 300", "under 500")
        if (preg_match('/(under|below|less than|budget|₹|\bprice\b|sasta|cheapest|kam price|कीमत|दाम|भाव|ભાવ|કિંમત)/ui', $normalized)) {
            return $this->handlePriceSearch($normalized, $detectedLang);
        }

        // 4F. Occasion recommendation (e.g. birthday, anniversary)
        $occasionResult = $this->handleOccasionSearch($normalized, $detectedLang, $currentPage);
        if ($occasionResult !== null) {
            return $occasionResult;
        }

        // 4G. Keyword search across catalogue
        $productSearchResult = $this->handleProductKeywordSearch($normalized, $detectedLang);
        if ($productSearchResult !== null) {
            return $productSearchResult;
        }

        // 4H. Greetings
        if ($this->matchesIntent($normalized, ['hi', 'hello', 'hey', 'namaste', 'kem cho', 'good morning', 'good evening', 'kem chho', 'pranam', 'hii', 'helo', 'नमस्ते', 'પ્રણામ', 'કેમ છો'])) {
            if ($this->isCurrentPage($currentPage, 'contact') && ! $this->isContactFormIntakeActive($contactForm)) {
                return $this->handleContactPageWelcome($detectedLang);
            }

            return $this->handleGreeting($detectedLang);
        }

        // 4I. Gratitude
        if ($this->matchesIntent($normalized, ['thank', 'thanks', 'dhanyawad', 'shukriya', 'aabhar', 'great', 'awesome', 'nice'])) {
            return $this->handleGratitude($detectedLang);
        }

        // 5. Intelligent Fallback
        return $this->handleFallback($trimmedMessage, $detectedLang);
    }

    /**
     * Format final response array ensuring consistent structure.
     *
     * @param  array<string, mixed>  $response
     * @return array<string, mixed>
     */
    protected function formatFinalResponse(array $response): array
    {
        return [
            'message' => $response['message'] ?? '',
            'speech_text' => $response['speech_text'] ?? ($response['message'] ?? ''),
            'action' => $response['action'] ?? null,
            'action_label' => $response['action_label'] ?? null,
            'action_url' => $response['action_url'] ?? null,
            'quick_replies' => $response['quick_replies'] ?? [],
            'products' => $response['products'] ?? [],
            'navigation' => $response['navigation'] ?? null,
            'section_target' => $response['section_target'] ?? null,
            'avatar_gesture' => $response['avatar_gesture'] ?? 'idle',
            'contact_form' => $response['contact_form'] ?? null,
            'customisation_details' => $response['customisation_details'] ?? null,
            'customisation_intake' => $response['customisation_intake'] ?? null,
        ];
    }

    /**
     * Determine if current client page matches route key.
     */
    public function isCurrentPage(?string $currentPage, string $routeKey): bool
    {
        if (empty($currentPage)) {
            return false;
        }

        $clean = trim(parse_url($currentPage, PHP_URL_PATH) ?? '', '/');

        return match ($routeKey) {
            'home' => $clean === '' || $clean === 'home',
            'about' => $clean === 'about',
            'products' => in_array($clean, ['products', 'new-arrivals', 'catalog'], true),
            'customised-gifts' => in_array($clean, ['customised-gifts', 'customize', 'customise'], true),
            'privacy-policy' => $clean === 'privacy-policy',
            'terms-and-conditions' => in_array($clean, ['terms-and-conditions', 'terms'], true),
            'contact' => $clean === 'contact',
            default => false,
        };
    }

    /* =========================================================================
       Intent Matchers (Semantic & Natural Spoken Queries)
       ========================================================================= */

    protected function isStopSpeakingIntent(string $text): bool
    {
        return (bool) preg_match('/^(stop speaking|stop talking|stop audio|stop voice|quiet|be quiet|shut up|stop it|stop|ruk jao|chup ho jao|bolna band karo|રોકો|ચૂપ રહો)/ui', $text);
    }

    protected function isRepeatIntent(string $text): bool
    {
        return (bool) preg_match('/(explain (that|this|it) again|explain this part again|repeat (that|this|it)?|say that again|speak again|tell me again|dobara batao|phir se batao|ફરીથી કહો|ફરીથી સમજાવો)/ui', $text);
    }

    protected function isGoBackIntent(string $text): bool
    {
        return (bool) preg_match('/(take me back|go back|previous page|previous section|peechhe jao|પાછા જાઓ)/ui', $text);
    }

    protected function isAboutIntent(string $text): bool
    {
        if (preg_match('/(tell (me )?about ruchi|what is ruchi( chocolates)?( about)?|tell (me )?(your|the|our) story|who are you|who (started|founded|made) ruchi|brand story|your journey|history of ruchi|about (ruchi|us|company|the brand)|take me to about|open about|go to about)/ui', $text)) {
            return true;
        }

        return $this->matchesIntent($text, ['tell me about ruchi', 'about us', 'about ruchi', 'our story', 'tell me your story', 'who are you', 'what is ruchi', 'रुआच के बारे में', 'कहानी', 'વાર્તા', 'અમારા વિશે']);
    }

    protected function isProductsIntent(string $text): bool
    {
        if (preg_match('/(under|below|less than|budget|₹)/ui', $text)) {
            return false;
        }

        if (preg_match('/(show (me )?(your |the )?chocolates( (you|we) sell)?|what chocolates (do you|you) (sell|have|make)|show (all )?(products|catalogue|catalog|collection)|browse (products|chocolates|catalogue)|take me to products|open (products|catalogue|catalog)|our products|see chocolates|show (me )?(the )?birthday gifts|birthday gifts)/ui', $text)) {
            return true;
        }

        return $this->matchesIntent($text, ['show me your chocolates', 'show chocolates', 'chocolates you sell', 'show me the chocolates', 'show products', 'our products', 'browse products', 'all products', 'open catalogue', 'open catalog', 'birthday gifts', 'चॉकलेट्स दिखाएं', 'કટોલોગ', 'પ્રોડક્ટ્સ બતાવો']);
    }

    protected function isCustomisedIntent(string $text): bool
    {
        if (preg_match('/(show (me )?customis|i want to customis|how (can i|to) customis|can i customis|customise a gift|customize a gift|customised gifts|customized gifts|personalise a gift|personalize a gift|take me to custom|open custom)/ui', $text)) {
            return true;
        }

        return $this->matchesIntent($text, ['show me customised gifts', 'show me customized gifts', 'customise a gift', 'customize a gift', 'want to customise', 'want to customize', 'how can i customise a gift', 'personalise chocolate', 'personalize chocolate', 'customised gifts', 'customized gifts', 'कस्टमाइज गिफ्ट', 'કસ્ટમાઇઝ ગિફ્ટ']);
    }

    protected function isReturnPolicyIntent(string $text): bool
    {
        if (preg_match('/(explain (the |your |our )?(return|refund)( and refund)? policy|what is (the |your |our )?(return|refund)( and refund)? policy|return policy|refund policy|can i return|return and refund|take me to return|open return)/ui', $text)) {
            return true;
        }

        return $this->matchesIntent($text, ['explain the return policy', 'explain your return policy', 'return policy', 'refund policy', 'explain return', 'explain refund', 'return and refund', 'वापसी नियम', 'રિટર્ન પોલિસી']);
    }

    protected function isContactIntent(string $text): bool
    {
        if (preg_match('/(where can i contact you|how (can|do) i contact you|where is your (store|studio|shop|location|address)|what is your (phone|number|address|email|contact)|contact us|contact details|call you|reach you|take me to contact|open contact)/ui', $text)) {
            return true;
        }

        return $this->matchesIntent($text, ['where can i contact you', 'how to contact you', 'contact us', 'contact details', 'studio address', 'phone number', 'reach you', 'call you', 'ક્યાં સંપર્ક કરવો', 'સંપર્ક કરો']);
    }

    protected function isPrivacyPolicyIntent(string $text): bool
    {
        if (preg_match('/(explain (your )?privacy policy|what is (your )?privacy policy|privacy policy|privacy rules|data privacy|take me to privacy|open privacy)/ui', $text)) {
            return true;
        }

        return $this->matchesIntent($text, ['privacy policy', 'explain privacy', 'data privacy', 'personal data policy', 'પ્રાઇવસી પોલિસી']);
    }

    protected function isTermsIntent(string $text): bool
    {
        if (preg_match('/(show (me )?terms|explain (your )?terms|what are (your )?terms|terms and conditions|terms of service|terms page|legal conditions|take me to terms|open terms)/ui', $text)) {
            return true;
        }

        return $this->matchesIntent($text, ['terms and conditions', 'terms of service', 'explain terms', 'show terms', 'legal terms', 'શરતો અને નિયમો']);
    }

    protected function isHomeIntent(string $text): bool
    {
        if (preg_match('/(take me (to )?home|go (back )?(to )?home( page)?|go back to (the )?main page|home page|main page|open home)/ui', $text)) {
            return true;
        }

        return $this->matchesIntent($text, ['take me home', 'go home', 'home page', 'main page', 'મુખ્ય પેજ']);
    }

    /* =========================================================================
       Navigation & Destination Page Explanation Handlers
       ========================================================================= */

    /**
     * Repeat or replay the last explanation on the current page.
     *
     * @return array<string, mixed>
     */
    protected function handleRepeatLastExplanation(?string $currentPage, string $lang): array
    {
        if ($this->isCurrentPage($currentPage, 'about')) {
            return $this->handleNavigateAboutUs($lang, true);
        }
        if ($this->isCurrentPage($currentPage, 'customised-gifts')) {
            return $this->handleNavigateCustomisedGifts($lang, true);
        }
        if ($this->isCurrentPage($currentPage, 'products')) {
            return $this->handleNavigateProducts('', $lang, true);
        }
        if ($this->isCurrentPage($currentPage, 'contact')) {
            return $this->handleNavigateContactUs($lang, true);
        }

        return [
            'message' => "I'd be happy to explain again! What would you like to hear about — our brand story, customised gifts, or chocolate catalog?",
            'speech_text' => 'I would be happy to explain again! Would you like to hear about our story, customised gifts, or chocolate collection?',
            'avatar_gesture' => 'welcoming',
            'quick_replies' => ['Tell me about Ruchi 🍫', 'Show Customised Gifts ✨', 'Contact Us 📞'],
        ];
    }

    /**
     * Handle navigation back to home page.
     *
     * @return array<string, mixed>
     */
    protected function handleGoBack(?string $currentPage, string $lang): array
    {
        return [
            'message' => 'Taking you back to the home page! ✨',
            'speech_text' => 'Taking you back to our home page.',
            'action' => 'navigate',
            'action_url' => route('home'),
            'action_label' => 'Go to Home',
            'avatar_gesture' => 'walking',
            'navigation' => [
                'navigate' => true,
                'url' => route('home'),
                'page_key' => 'home',
                'page_name' => 'Home',
                'pre_speech' => 'Taking you back to our home page.',
            ],
            'quick_replies' => ['Browse Products 🎁', 'Customise a Gift ✨'],
        ];
    }

    /**
     * Handle Disambiguation when customer's request is ambiguous.
     *
     * @return array<string, mixed>
     */
    protected function handleAmbiguousPolicy(string $lang): array
    {
        if ($lang === 'hi') {
            return [
                'message' => "हमारी दो अलग-अलग पॉलिसी पेज हैं। आप किसके बारे में जानना चाहते हैं?\n\n• **Privacy Policy:** आपकी निजी जानकारी और डेटा सुरक्षा के नियम।\n• **Terms & Conditions:** ऑर्डर, डिलीवरी और वेबसाइट उपयोग से जुड़े नियम।",
                'speech_text' => 'हमारे पास Privacy Policy और Terms and Conditions पेज हैं। आप किसके बारे में जानना चाहते हैं?',
                'quick_replies' => ['Privacy Policy 🛡️', 'Terms & Conditions 📜'],
            ];
        }

        if ($lang === 'gu') {
            return [
                'message' => "અમારી પાસે બે પોલિસી પેજ છે. તમે શેના વિશે જાણવા માંગો છો?\n\n• **Privacy Policy:** તમારી વ્યક્તિગત માહિતીની સુરક્ષા માટે.\n• **Terms & Conditions:** ઓર્ડર, ડિલિવરી અને વેબસાઇટ ઉપયોગ માટે.",
                'speech_text' => 'અમારી પાસે Privacy Policy અને Terms and Conditions પેજ છે. તમે કયું જોવા માંગો છો?',
                'quick_replies' => ['Privacy Policy 🛡️', 'Terms & Conditions 📜'],
            ];
        }

        return [
            'message' => "We have two policy pages available. Which one would you like to explore?\n\n• **Privacy Policy:** How we safeguard and respect your personal contact and order data.\n• **Terms & Conditions:** Ordering, shop pickup, cancellations, returns, and website use.",
            'speech_text' => 'We have our Privacy Policy and Terms and Conditions pages. Which one would you like to explore?',
            'quick_replies' => ['Privacy Policy 🛡️', 'Terms & Conditions 📜'],
        ];
    }

    /**
     * Handle Page-Aware Follow-Up Questions (Grounded in current destination page).
     *
     * @return array<string, mixed>|null
     */
    protected function handlePageAwareFollowUp(string $normalized, string $currentPage, string $lang): ?array
    {
        // 1. Follow-ups on About Us page
        if ($this->isCurrentPage($currentPage, 'about')) {
            if (preg_match('/(next section|more details|tell me more|what else|continue|اگلا)/ui', $normalized)) {
                return [
                    'message' => "🏆 **Section 2: Milestones & Customer Love**\n\n• **50,000+ Happy Customers:** Handcrafted chocolates enjoyed across birthdays, anniversaries, and corporate events.\n• **10,000+ Gift Hampers:** Beautifully arranged with satin ribbons.\n• **4.8 / 5 Customer Rating:** Celebrated for pure homemade taste.\n\nWould you like me to explain our chocolate crafting process and ingredients next?",
                    'speech_text' => 'Here is our next section on milestones: We are proud to have served over fifty thousand happy customers with more than ten thousand gift hampers delivered and a four point eight star customer rating! Would you like me to explain our chocolate crafting process next?',
                    'quick_replies' => ['Explain Crafting Process 🍫', 'Why Choose Us? ✨', 'Browse Products 🎁'],
                ];
            }

            if (preg_match('/(founded|since|start|history|how old|when did|साल|ક્યારે)/ui', $normalized)) {
                return [
                    'message' => "✨ **A Sweet Journey Since 2010!**\n\nRuchi Chocolates was founded in Ahmedabad in **2010**. For over a decade, we have been crafting homemade chocolates and thoughtful gift hampers that spread sweet smiles across celebrations.\n\nWould you like to hear about our milestones or browse our products?",
                    'speech_text' => 'Ruchi Chocolates was founded in Ahmedabad in 2010, handcrafting artisanal chocolates for over a decade! Would you like to hear about our milestones?',
                    'quick_replies' => ['Milestones 🏆', 'Why Choose Us? ✨', 'Browse Products 🍫'],
                ];
            }

            if (preg_match('/(rating|happy customer|customers|milestone|stat|how many|संख्या|ગ્રાહકો)/ui', $normalized)) {
                return [
                    'message' => "🏆 **Key Milestones of Ruchi Chocolates:**\n\n• **50,000+** Happy Customers\n• **10,000+** Gift Hampers Delivered\n• **4.8 / 5** Average Customer Rating\n• **100%** Handcrafted with Love\n\nWould you like me to explain our ingredients and quality standards next?",
                    'speech_text' => 'We have served over fifty thousand happy customers with more than ten thousand hampers delivered and a four point eight star rating! Would you like me to explain our ingredients and quality next?',
                    'quick_replies' => ['Our Process 🍫', 'Why Choose Us? ✨', 'Contact Us 📞'],
                ];
            }

            if (preg_match('/(why choose|ingredients|quality|special|process|craft|खास|કેમ પસંદ કરવું)/ui', $normalized)) {
                return [
                    'message' => "🍫 **Why Choose Ruchi Chocolates & Our Process:**\n\n1. **Finest Ingredients:** Premium couverture chocolate, pure cocoa butter, and roasted nuts.\n2. **Handcrafted with Love:** Attention to every ribbon and artistic detail.\n3. **Perfect for Every Occasion:** Birthdays, weddings, anniversaries, and corporate gifts.\n4. **Luxury Presentation:** Keepsake tins and custom boxes.\n\nWould you like to explore our products or enquire on WhatsApp?",
                    'speech_text' => 'Customers love us for our finest ingredients, pure homemade chocolate, zero artificial preservatives, and luxury gift presentation. Would you like to explore our products or customise a gift?',
                    'quick_replies' => ['Browse Products 🍫', 'Customise a Gift ✨', 'Contact Us 📞'],
                ];
            }
        }

        // 2. Follow-ups on Our Products page
        if ($this->isCurrentPage($currentPage, 'products')) {
            $browseSlug = $this->resolveBrowseOccasionSlug($normalized);
            if ($browseSlug !== null) {
                return $this->buildOccasionCatalogResponse($browseSlug, $lang);
            }

            if (preg_match('/(festive|hamper|which celebration|which festival|festival|occasion|celebration|shop for|shopping for)/ui', $normalized)) {
                return $this->buildOccasionBrowsePickerResponse($lang);
            }

            if (preg_match('/(next section|more details|tell me more|what else|continue|best seller|tin boxes|heart tins|explain.*tin)/ui', $normalized)) {
                return [
                    'message' => "🎁 **Section 2: Artisan Gift Tin Boxes & Best Sellers**\n\n• **Small & Big Heart Tins:** Starting from ₹170 up to ₹350, perfect for romantic and birthday gifting.\n• **Square & Rectangle Tins:** ₹250 to ₹650, filled with milk truffles and roasted almond rochers.\n• **Grand Celebration Hampers:** Luxury festive arrangements with premium treats.\n\nWould you like to hear about our floral chocolate bouquets or custom gifts next?",
                    'speech_text' => 'Our best selling tin box collection features heart-shaped tins starting from one hundred seventy rupees, and assorted square tins up to six hundred fifty rupees. Would you like to hear about our chocolate bouquets or custom gifts next?',
                    'quick_replies' => ['Explain Bouquets 💐', 'Browse Products 🍫', 'Customise a Gift ✨'],
                ];
            }

            if (preg_match('/(explain bouquets|bouquet section|flower bouquet|floret|potli)/ui', $normalized)) {
                return [
                    'message' => "💐 **Chocolate Bouquets & Satin Potlis:**\n\n• **Chocolate Bouquets:** Floral arrangements featuring individually foil-wrapped chocolate florets in gorgeous decorative vases.\n• **Satin Potlis:** Traditional drawstring pouches with gold borders packed with assorted chocolates.\n\nWould you like to customise a gift or enquire on WhatsApp?",
                    'speech_text' => 'Our floral chocolate bouquets combine handmade chocolate florets in luxury vases, perfect for anniversaries and birthdays. Would you like to see options under three hundred rupees or enquire on WhatsApp?',
                    'action' => 'whatsapp',
                    'action_url' => 'https://wa.me/917490828282?text='.urlencode('Hi Ruchi Chocolates, I would like to order a chocolate bouquet.'),
                    'action_label' => 'Order Bouquet on WhatsApp',
                    'quick_replies' => ['Customise a Gift ✨', 'Browse Products 🍫', 'Contact Details 📞'],
                ];
            }

            if (preg_match('/(under|below|budget|price|कम|बजट)/ui', $normalized)) {
                $all = $this->catalogService->getAllProducts();
                $budget = array_filter($all, fn ($p) => ($p['price_raw'] ?? 0) <= 300);
                $topBudget = array_slice($budget, 0, 4);

                return [
                    'message' => "🏷️ **Best Value Chocolates Under ₹300:**\n\nHere are popular selections under ₹300 crafted fresh with premium ingredients:",
                    'speech_text' => 'Here are our top selections under three hundred rupees, including our signature heart tins starting from one hundred seventy rupees!',
                    'products' => $this->formatProducts($topBudget),
                    'quick_replies' => ['Heart Tin Boxes 💖', 'Customise a Gift ✨', 'Shop Pickup 🏪'],
                ];
            }
        }

        // 3. Follow-ups on Customised Gifts page — single WhatsApp enquiry flow
        if ($this->isCurrentPage($currentPage, 'customised-gifts')) {
            if (preg_match('/(next section|more details|tell me more|what else|continue|lettering|flavour|flavor|how to submit|submit order|how to order|enquire on whatsapp|describe my gift|customisation form|अक्षर|નામ|व्हाट्सएप)/ui', $normalized)) {
                return $this->buildCustomisedGiftsGuideResponse($lang);
            }
        }

        // 5. Follow-ups on Contact Us page
        if ($this->isCurrentPage($currentPage, 'contact')) {
            if (preg_match('/(address|where|location|studio|shop|pincode|पता|સરનામું)/ui', $normalized)) {
                return [
                    'message' => '📍 **Our Studio Address:**\n\n'.config('ruchi.address').'.',
                    'speech_text' => config('ruchi.address_speech'),
                    'action' => 'whatsapp',
                    'action_url' => 'https://wa.me/917490828282?text='.urlencode('Hi Ruchi Chocolates, I need directions to your studio.'),
                    'action_label' => 'Get Directions on WhatsApp',
                    'quick_replies' => ['Business Hours ⏰', 'Phone Number 📞'],
                ];
            }

            if (preg_match('/(hours|timing|timings|open|close|समय|સમય)/ui', $normalized)) {
                return [
                    'message' => "⏰ **Studio & Customer Support Hours:**\n\n• **Monday to Saturday:** 9:00 AM – 9:00 PM\n• **Sunday:** 10:00 AM – 6:00 PM\n• **WhatsApp Support:** Instant replies during operating hours!",
                    'speech_text' => 'We are open Monday to Saturday nine AM to nine PM, and Sundays ten AM to six PM.',
                    'quick_replies' => ['Studio Address 📍', 'Chat on WhatsApp 💬'],
                ];
            }

            if (preg_match('/(phone|call|number|whatsapp|फोन|નંબર)/ui', $normalized)) {
                return [
                    'message' => "📞 **Direct Contact Details:**\n\n• **Phone / WhatsApp:** +91 7490828282\n• **Email:** Info.ruchi11@gmail.com",
                    'speech_text' => 'You can reach us at plus nine one eight zero zero zero zero four three zero five one via phone or WhatsApp.',
                    'action' => 'whatsapp',
                    'action_url' => 'https://wa.me/917490828282',
                    'action_label' => 'Open WhatsApp (+91 7490828282)',
                    'quick_replies' => ['Business Hours ⏰', 'Studio Address 📍'],
                ];
            }
        }

        return null;
    }

    /**
     * Handle Brand Story & About Us.
     *
     * @return array<string, mixed>
     */
    protected function handleNavigateAboutUs(string $lang, bool $isAlreadyOnPage): array
    {
        $url = route('about');
        $preSpeech = match ($lang) {
            'hi' => 'बिल्कुल! चलिए मैं आपको हमारे About Us पेज पर ले चलती हूँ और हमारी कहानी सुनाती हूँ।',
            'gu' => 'ચોક્કસ! ચાલો હું તમને અમારા About Us પેજ પર લઈ જાઉં અને અમારી વાર્તા કહું.',
            default => 'Of course! Let me take you to our About Us page and tell you about our story.',
        };

        $explMessage = "🍫 **A Sweet Journey Since 2010!**\n\n"
            ."Ruchi Chocolates was born in Ahmedabad out of a passion for crafting pure, artisanal, homemade chocolates.\n\n"
            ."• **50,000+ Happy Customers** served across celebrations\n"
            ."• **10,000+ Gift Hampers** handcrafted and delivered\n"
            ."• **4.8 / 5 Rating** with 100% made with love\n"
            ."• **Our Promise:** Pure chocolate, finest ingredients, and elegant presentation for birthdays, anniversaries, and festive gifting.\n\n"
            .'What would you like to know more about our journey?';

        $explSpeech = match ($lang) {
            'hi' => 'स्वागत है हमारे About Us पेज पर! रुचि चॉकलेट्स की शुरुआत 2010 में अहमदाबाद में हुई थी। हमने 50,000 से अधिक खुश ग्राहकों के लिए शुद्ध हैंडमेड चॉकलेट्स तैयार की हैं।',
            'gu' => 'અમારા About Us પેજ પર સ્વાગત છે! રુચિ ચોકલેટ્સની શરૂઆત 2010 માં અમદાવાદમાં થઈ હતી. અમે 50,000 થી વધુ ગ્રાહકો માટે પ્યોર હેન્ડમેડ ચોકલેટ્સ બનાવી છે.',
            default => 'Welcome to our About Us page! Ruchi Chocolates began its sweet journey in Ahmedabad in 2010. We have handcrafted bespoke chocolates for over 50,000 happy customers with a 4.8-star rating. Every creation is handmade with love and the finest ingredients. What would you like to know more about?',
        };

        $quickReplies = ['Explain Next Section: Milestones 🏆', 'Why Choose Us? ✨', 'Our Process 🍫', 'Browse Products 🎁'];
        $sectionTarget = [
            'selector' => '#our-story-section',
            'title' => 'Our Story & Brand Beginnings',
            'gesture' => 'pointing',
            'scroll' => true,
            'highlight' => true,
        ];

        if ($isAlreadyOnPage) {
            return [
                'message' => "We are right here on our **About Us** page! 😊\n\n".$explMessage,
                'speech_text' => "We are right here on our About Us page! {$explSpeech}",
                'quick_replies' => $quickReplies,
                'section_target' => $sectionTarget,
                'avatar_gesture' => 'pointing',
                'navigation' => null,
            ];
        }

        return [
            'message' => $preSpeech,
            'speech_text' => $preSpeech,
            'action' => 'navigate',
            'action_url' => $url,
            'action_label' => 'Go to About Us',
            'avatar_gesture' => 'walking',
            'section_target' => $sectionTarget,
            'navigation' => [
                'navigate' => true,
                'url' => $url,
                'page_key' => 'about',
                'page_name' => 'About Us',
                'pre_speech' => $preSpeech,
                'section_target' => $sectionTarget,
                'explanation' => [
                    'message' => $explMessage,
                    'speech_text' => $explSpeech,
                    'quick_replies' => $quickReplies,
                    'section_target' => $sectionTarget,
                    'avatar_gesture' => 'pointing',
                ],
            ],
            'quick_replies' => $quickReplies,
        ];
    }

    /**
     * Handle Our Products / Catalogue Navigation & Explanation.
     *
     * @return array<string, mixed>
     */
    protected function handleNavigateProducts(string $normalized, string $lang, bool $isAlreadyOnPage): array
    {
        $isBirthday = (bool) preg_match('/(birthday|janmadin|જન્મદિવસ)/ui', $normalized);

        $url = $isBirthday ? route('products', ['category' => 'birthday']).'#productsCatalog' : route('products');
        $catalogCount = count($this->catalogService->getAllProducts());
        $occasionPicker = $this->buildOccasionBrowsePickerResponse($lang, true);

        $preSpeech = match ($lang) {
            'hi' => $isBirthday ? 'ज़रूर! चलिए मैं आपको हमारे बर्थडे गिफ्ट्स और चॉकलेट्स दिखाती हूँ।' : 'ज़रूर! चलिए मैं आपको हमारे Products पेज पर ले चलती हूँ ताकि आप हमारी सभी चॉकलेट्स देख सकें।',
            'gu' => $isBirthday ? 'ચોક્કસ! ચાલો હું તમને અમારા બર્થડે ગિફ્ટ્સ અને ચોકલેટ્સ બતાવું.' : 'ચોક્કસ! ચાલો હું તમને અમારા Products પેજ પર લઈ જાઉં જેથી તમે અમારી બધી ચોકલેટ્સ જોઈ શકો.',
            default => $isBirthday ? 'Sure! Let me take you to our Birthday Gifts collection.' : 'Sure! Let me take you to our Products collection to explore all our handcrafted chocolates.',
        };

        $explMessage = $isBirthday
            ? "🎂 **Special Birthday Chocolate Gifts!**\n\n"
                ."Here is our handcrafted birthday gift selection! You can choose personalised birthday chocolate boxes, heart tins, and luxury flower bouquets designed to make birthdays unforgettable.\n\n"
                .'Would you like to customise a name or message for this birthday gift?'
            : $occasionPicker['message'];

        $explSpeech = match ($lang) {
            'hi' => $isBirthday ? 'यहाँ हैं हमारे खास बर्थडे चॉकलेट गिफ्ट्स! आप नाम और संदेश भी कस्टमाइज करवा सकते हैं।' : 'स्वागत है हमारे Products कलेक्शन में! नीचे अपना त्योहार या मौका चुनें — मैं उपलब्ध हैम्पर और गिफ्ट दिखाऊँगी।',
            'gu' => $isBirthday ? 'અહીં છે અમારા ખાસ બર્થડે ચોકલેટ ગિફ્ટ્સ! તમે નામ અને મેસેજ પણ કસ્ટમાઇઝ કરાવી શકો છો.' : 'અમારા Products કલેક્શનમાં સ્વાગત છે! નીચે તમારો તહેવાર અથવા પ્રસંગ પસંદ કરો — હું ઉપલબ્ધ હેમ્પર અને ગિફ્ટ્સ બતાવીશ.',
            default => $isBirthday ? 'Here are our handcrafted birthday gift collections! We can personalize chocolate name letters, ribbons, and gift hampers for the celebration. Would you like to customize a gift?' : "Welcome to our Products collection with {$catalogCount} handcrafted gifts! Which festival, occasion, or gift type are you shopping for? Tap an option below to see what's available.",
        };

        $quickReplies = $isBirthday
            ? ['Customise a Gift ✨', 'Heart Tin Boxes 💖', 'Order on WhatsApp 💬']
            : $occasionPicker['quick_replies'];

        $sectionTarget = [
            'selector' => '#productsCatalog',
            'title' => $isBirthday ? 'Birthday Gifts Collection' : 'Artisanal Chocolates Catalog',
            'gesture' => 'pointing',
            'scroll' => true,
            'highlight' => true,
        ];

        if ($isAlreadyOnPage) {
            return array_merge($occasionPicker, [
                'message' => "We are right here on our **Our Products** page! 🍫\n\n".$explMessage,
                'speech_text' => "We are right here on our Products page! {$explSpeech}",
                'quick_replies' => $quickReplies,
                'section_target' => $sectionTarget,
                'avatar_gesture' => 'pointing',
                'navigation' => null,
                'products' => $isBirthday ? $this->formatProducts(array_slice($this->catalogService->filterProductsForBrowseCollection('birthday'), 0, 4)) : [],
            ]);
        }

        return [
            'message' => $preSpeech,
            'speech_text' => $preSpeech,
            'action' => 'navigate',
            'action_url' => $url,
            'action_label' => 'View All Products',
            'products' => [],
            'avatar_gesture' => 'walking',
            'section_target' => $sectionTarget,
            'navigation' => [
                'navigate' => true,
                'url' => $url,
                'page_key' => 'products',
                'page_name' => 'Our Products',
                'pre_speech' => $preSpeech,
                'section_target' => $sectionTarget,
                'explanation' => [
                    'message' => $explMessage,
                    'speech_text' => $explSpeech,
                    'products' => [],
                    'quick_replies' => $quickReplies,
                    'section_target' => $sectionTarget,
                    'avatar_gesture' => 'pointing',
                ],
            ],
            'quick_replies' => $quickReplies,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    protected function buildOccasionBrowsePickerResponse(string $lang, bool $includeIntro = true): array
    {
        $available = $this->catalogService->getAvailableBrowseOccasions();
        $lines = [];

        $sectionTitles = [
            'Festivals' => 'Festivals',
            'Occasions' => 'Occasions',
            'Gifting' => 'Gifting',
        ];

        foreach ($sectionTitles as $groupKey => $title) {
            $items = array_values(array_filter($available, fn ($o) => $o['group'] === $groupKey));
            if ($items === []) {
                continue;
            }

            $lines[] = "**{$title}**";
            foreach ($items as $item) {
                $lines[] = "• {$item['icon']} **{$item['name']}** — {$item['count']} available";
            }
            $lines[] = '';
        }

        if ($lines !== [] && end($lines) === '') {
            array_pop($lines);
        }

        $body = implode("\n", $lines);

        $intro = match ($lang) {
            'hi' => "🎁 **कौन-सा त्योहार या मौका?**\n\nनीचे उपलब्ध कलेक्शन चुनें — मैं उसी के हिसाब से हैम्पर और गिफ्ट दिखाऊँगी:\n\n",
            'gu' => "🎁 **કયો તહેવાર અથવા પ્રસંગ?**\n\nનીચે ઉપલબ્ધ કલેક્શન પસંદ કરો — હું તે મુજબ હેમ્પર અને ગિફ્ટ્સ બતાવીશ:\n\n",
            default => "🎁 **Same options as our Products menu**\n\nChoose a **Festival**, **Occasion**, or **Gifting** collection below — counts match what you see on the website:\n\n",
        };

        $message = ($includeIntro ? $intro : '').$body;

        return [
            'message' => $message,
            'speech_text' => match ($lang) {
                'hi' => 'नीचे से अपना त्योहार या मौका चुनें, मैं उपलब्ध गिफ्ट और हैम्पर दिखाऊँगी।',
                'gu' => 'નીચેથી તહેવાર અથવા પ્રસંગ પસંદ કરો, હું ઉપલબ્ધ ગિફ્ટ્સ બતાવીશ.',
                default => 'Pick a festival, occasion, or gifting option below — the same choices as our Products page sidebar.',
            },
            'products' => [],
            'quick_replies' => $this->buildOccasionBrowseQuickReplies($available),
            'avatar_gesture' => 'pointing',
        ];
    }

    /**
     * @param  array<int, array{name: string, slug: string, count: int, icon: string, group: string}>  $available
     * @return array<int, string>
     */
    protected function buildOccasionBrowseQuickReplies(array $available): array
    {
        $chips = [];
        foreach ($available as $item) {
            $chips[] = trim($item['name'].' '.$item['icon']);
        }

        $chips[] = 'Customise a Gift ✨';

        return $chips;
    }

    protected function resolveBrowseOccasionSlug(string $message): ?string
    {
        $normalized = mb_strtolower(trim($message), 'UTF-8');
        $normalized = preg_replace('/[\x{1F300}-\x{1FAFF}\x{2600}-\x{27BF}]/u', ' ', $normalized) ?? $normalized;
        $normalized = trim(preg_replace('/\s+/u', ' ', $normalized));

        foreach ($this->catalogService->getAvailableBrowseOccasions() as $occ) {
            $slug = $occ['slug'];
            $name = mb_strtolower($occ['name'], 'UTF-8');
            $slugSpaced = str_replace('-', ' ', $slug);

            if ($normalized === $slug || $normalized === $name || $normalized === $slugSpaced) {
                return $slug;
            }

            if ($this->messagePrimarilySelectsBrowseOccasion($normalized, $slug, $name, $slugSpaced)) {
                return $slug;
            }
        }

        $aliases = [
            'valentines day' => 'valentine',
            'valentines' => 'valentine',
            "valentine's day" => 'valentine',
            'ring ceremony' => 'ring-ceremony',
            'gifting' => 'gifting',
            'all gifts' => 'gifting',
        ];

        foreach ($aliases as $needle => $slug) {
            if (str_contains($normalized, $needle) && $this->catalogService->filterProductsForBrowseCollection($slug) !== []) {
                if ($this->messagePrimarilySelectsBrowseOccasion($normalized, $slug, $needle, $needle)) {
                    return $slug;
                }
            }
        }

        return null;
    }

    protected function messagePrimarilySelectsBrowseOccasion(string $normalized, string $slug, string $name, string $slugSpaced): bool
    {
        if (preg_match('/(browse|show (me )?(the )?(your )?(all )?(products|catalogue|catalog|collection)|chocolates you sell|our products)/ui', $normalized)) {
            return false;
        }

        if ($normalized === $slug || $normalized === $name || $normalized === $slugSpaced) {
            return true;
        }

        if (str_starts_with($normalized, $name.' ') || str_starts_with($normalized, $slugSpaced.' ')) {
            return true;
        }

        if (mb_strlen($normalized) <= 40 && (str_contains($normalized, $slug) || str_contains($normalized, $name))) {
            return true;
        }

        return false;
    }

    /**
     * @return array<string, mixed>
     */
    protected function buildOccasionCatalogResponse(string $slug, string $lang): array
    {
        $products = $this->catalogService->filterProductsForBrowseCollection($slug);
        $label = $this->catalogService->resolveCategoryFilterLabel($slug);
        $top = array_slice($products, 0, 3);
        $count = count($products);
        $url = $this->catalogService->browseCollectionUrl($slug);

        if ($lang === 'hi') {
            $message = "🎉 **{$label} — {$count} उपलब्ध गिफ्ट**\n\nचैट में कुछ लोकप्रिय विकल्प। पूरा कलेक्शन देखने के लिए **View All {$label} Gifts** टैप करें।";
            $speech = "{$label} के लिए {$count} गिफ्ट उपलब्ध हैं। यहाँ कुछ विकल्प हैं; पूरा कलेक्शन View All पर टैप करके देखें।";
        } elseif ($lang === 'gu') {
            $message = "🎉 **{$label} — {$count} ઉપલબ્ધ ગિફ્ટ્સ**\n\nચેટમાં થોડા લોકપ્રિય વિકલ્પો. સંપૂર્ણ કલેક્શન માટે **View All {$label} Gifts** ટેપ કરો.";
            $speech = "{$label} માટે {$count} ગિફ્ટ્સ ઉપલબ્ધ છે. સંપૂર્ણ કલેક્શન View All પર ટેપ કરીને જુઓ.";
        } else {
            $message = "🎉 **{$label} — {$count} available gifts & hampers**\n\nHere are a few popular picks in chat. Tap **View All {$label} Gifts** to open the full collection on our Products page.";
            $speech = "For {$label}, we have {$count} gifts available. Here are a few popular options in chat. Tap View All to see every gift on our Products page.";
        }

        return [
            'message' => $message,
            'speech_text' => $speech,
            'products' => $this->formatProducts($top),
            'action' => 'navigate',
            'action_url' => $url,
            'action_label' => "View All {$label} Gifts",
            'quick_replies' => array_merge(
                $this->buildOccasionBrowseQuickReplies($this->catalogService->getAvailableBrowseOccasions()),
                ['Enquire on WhatsApp 💬']
            ),
            'avatar_gesture' => 'speaking',
            'navigation' => null,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    protected function customisedGiftsFormSectionTarget(): array
    {
        return [
            'selector' => '.rc-custom-form-card',
            'title' => 'Share Your Customisation Details',
            'gesture' => 'pointing',
            'scroll' => true,
            'highlight' => true,
        ];
    }

    protected function customisedGiftWhatsAppUrl(string $details): string
    {
        $details = trim($details);
        $message = $details === ''
            ? 'Hi Ruchi Chocolates, I would like to enquire about a customised chocolate gift hamper.'
            : "Hi Ruchi Chocolates, I would like to enquire about a customised gift:\n\n".$details;

        return config('ruchi.whatsapp_url').'?text='.urlencode($message);
    }

    /**
     * @return array<string, mixed>
     */
    protected function buildCustomisedGiftsGuideResponse(string $lang): array
    {
        $message = "✨ **Custom chocolate or hampers**\n\n"
            ."Explain here **what type of chocolates or chocolate hampers** you want — occasion, quantity, flavours, names, budget, and preferred pickup date.\n\n"
            .'**Submit your description** in the box on this page (or type it here in chat). '
            .'Then tap **Send on WhatsApp** — I will open WhatsApp with your message ready so you can send it directly to our team.';

        $speechText = match ($lang) {
            'hi' => 'यहाँ बताएं आपको किस तरह की चॉकलेट या हैम्पर चाहिए, विवरण बॉक्स में लिखें या चैट में भेजें, फिर WhatsApp पर भेजें — मैं आपका संदेश WhatsApp पर तैयार कर दूँगी।',
            'gu' => 'અહીં કહો તમને કયા પ્રકારની ચોકલેટ અથવા હેમ્પર જોઈએ, વર્ણન બોક્સમાં લખો અથવા ચેટમાં મોકલો, પછી WhatsApp પર મોકલો.',
            default => 'Explain what type of chocolate or hampers you want. Submit your description in the box on this page or here in chat, then tap Send on WhatsApp and I will open WhatsApp with your message ready to send.',
        };

        return [
            'message' => $message,
            'speech_text' => $speechText,
            'avatar_gesture' => 'pointing',
            'section_target' => $this->customisedGiftsFormSectionTarget(),
            'action' => 'whatsapp',
            'action_url' => $this->customisedGiftWhatsAppUrl(''),
            'action_label' => 'Enquire on WhatsApp',
            'customisation_intake' => 'awaiting_description',
            'quick_replies' => ['Browse Products 🍫', 'Contact Us 📞'],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    protected function buildCustomisedGiftsWhatsAppFromDescription(string $description, string $lang): array
    {
        $details = trim($description);

        return [
            'message' => "✅ **Ready for WhatsApp**\n\n"
                ."I've added your description to the **Share Your Customisation Details** box.\n\n"
                .'Tap **Send on WhatsApp** below — your enquiry will open in WhatsApp so you can send it directly to our team.',
            'speech_text' => 'I have added your description to the customisation box. Tap Send on WhatsApp to send it directly to our team.',
            'avatar_gesture' => 'pointing',
            'section_target' => $this->customisedGiftsFormSectionTarget(),
            'action' => 'prefill_customisation_form',
            'action_url' => $this->customisedGiftWhatsAppUrl($details),
            'action_label' => 'Send on WhatsApp',
            'customisation_details' => $details,
            'customisation_intake' => 'complete',
            'quick_replies' => ['Browse Products 🍫', 'Contact Us 📞'],
        ];
    }

    /**
     * @param  array<int, array<string, string>>  $history
     */
    protected function shouldCaptureCustomGiftDescription(string $message, string $normalized, ?string $currentPage, array $history, array $customisationIntake = []): bool
    {
        if ($this->isObviousNonCustomGiftDescriptionIntent($normalized)) {
            return false;
        }

        $awaitingDescription = ! empty($customisationIntake['awaiting_description'])
            || $this->isAwaitingCustomGiftDescription($history, $currentPage);

        if ($awaitingDescription && mb_strlen(trim($message)) >= 5) {
            return true;
        }

        return $this->isCurrentPage($currentPage, 'customised-gifts')
            && $this->looksLikeCustomGiftDescription($message, $normalized);
    }

    /**
     * @param  array<int, array<string, string>>  $history
     */
    protected function isAwaitingCustomGiftDescription(array $history, ?string $currentPage): bool
    {
        $markers = [
            'submit your description',
            'share your customisation details',
            'custom chocolate or hampers',
            'type it here in chat',
            'type your customisation details',
            'विवरण बॉक्स',
            'description in the box',
        ];

        $recent = array_slice($history, -8);
        for ($i = count($recent) - 1; $i >= 0; $i--) {
            if (($recent[$i]['role'] ?? '') !== 'assistant') {
                continue;
            }

            $content = mb_strtolower($recent[$i]['content'] ?? '', 'UTF-8');
            foreach ($markers as $marker) {
                if (str_contains($content, $marker)) {
                    return true;
                }
            }
        }

        return false;
    }

    protected function isObviousNonCustomGiftDescriptionIntent(string $normalized): bool
    {
        if ($this->isStopSpeakingIntent($normalized) || $this->isRepeatIntent($normalized) || $this->isGoBackIntent($normalized)) {
            return true;
        }

        if ($this->isAboutIntent($normalized) || $this->isProductsIntent($normalized) || $this->isCustomisedIntent($normalized)) {
            return true;
        }

        if ($this->isContactIntent($normalized) || $this->isPrivacyPolicyIntent($normalized) || $this->isTermsIntent($normalized) || $this->isHomeIntent($normalized)) {
            return true;
        }

        if ($this->matchesIntent($normalized, ['hi', 'hello', 'hey', 'namaste', 'good morning', 'good evening', 'thank', 'thanks'])) {
            return true;
        }

        return (bool) preg_match('/^(browse products|contact us|how to submit|submit order|explain that again|go to next|show products|track|delivery|policy|privacy|terms|cancel form|skip)$/ui', $normalized);
    }

    protected function looksLikeCustomGiftDescription(string $message, string $normalized): bool
    {
        if (preg_match('/^(hi|hello|hey|browse|contact|track|delivery|policy|price|under ₹|show me)/ui', $normalized)) {
            return false;
        }

        if (mb_strlen(trim($message)) >= 30) {
            return true;
        }

        return (bool) preg_match('/(hamper|birthday|anniversary|wedding|corporate|truffle|bouquet|letter|box|pieces|kg|custom|gift for|need a|want a|chocolate)/ui', $normalized);
    }

    /**
     * Handle Customised Gifts Navigation & Explanation.
     *
     * @return array<string, mixed>
     */
    protected function handleNavigateCustomisedGifts(string $lang, bool $isAlreadyOnPage): array
    {
        $url = route('customised-gifts');
        $guide = $this->buildCustomisedGiftsGuideResponse($lang);

        $preSpeech = match ($lang) {
            'hi' => 'ज़रूर! चलिए मैं आपको Customised Gifts पेज पर ले चलती हूँ — वहाँ आप अपना विवरण लिखकर WhatsApp पर भेज सकते हैं।',
            'gu' => 'ચોક્કસ! ચાલો Customised Gifts પેજ પર જઈએ — તમે તમારું વર્ણન લખીને WhatsApp પર મોકલી શકો.',
            default => 'Let me take you to our Customised Gifts page, where you can describe your hamper and send it on WhatsApp.',
        };

        if ($isAlreadyOnPage) {
            return array_merge($guide, [
                'message' => "We are right here on our **Customised Gifts** page! ✨\n\n".$guide['message'],
                'speech_text' => $guide['speech_text'],
                'navigation' => null,
            ]);
        }

        return [
            'message' => $preSpeech,
            'speech_text' => $preSpeech,
            'action' => 'navigate',
            'action_url' => $url,
            'action_label' => 'Go to Customised Gifts',
            'avatar_gesture' => 'walking',
            'section_target' => $guide['section_target'],
            'navigation' => [
                'navigate' => true,
                'url' => $url,
                'page_key' => 'customised-gifts',
                'page_name' => 'Customised Gifts',
                'pre_speech' => $preSpeech,
                'section_target' => $guide['section_target'],
                'explanation' => [
                    'message' => $guide['message'],
                    'speech_text' => $guide['speech_text'],
                    'quick_replies' => $guide['quick_replies'],
                    'section_target' => $guide['section_target'],
                    'avatar_gesture' => 'pointing',
                    'action' => $guide['action'],
                    'action_url' => $guide['action_url'],
                    'action_label' => $guide['action_label'],
                    'customisation_intake' => 'awaiting_description',
                ],
            ],
            'quick_replies' => $guide['quick_replies'],
        ];
    }

    /**
     * Answer return and refund questions without a dedicated policy page.
     *
     * @return array<string, mixed>
     */
    protected function handleReturnRefundInformation(string $lang): array
    {
        $message = "🔄 **Return & Refund Guidelines:**\n\n"
            ."Because our artisan chocolates are perishable food items handcrafted fresh to order:\n\n"
            ."• **Damaged or Incorrect Items:** Eligible for an immediate replacement or refund.\n"
            .'• **Reporting Window:** Please report concerns within **24 hours of pickup** with photo proof via WhatsApp ('.config('ruchi.phone_display').").\n"
            ."• **Non-Returnable:** Opened food items or melted chocolates resulting from improper customer heat exposure.\n\n"
            .'Verified damaged orders receive an immediate replacement or refund as per mutual agreement.';

        $speechText = match ($lang) {
            'hi' => 'हमारी चॉकलेट्स ताज़ी खाद्य वस्तुएं हैं। क्षतिग्रस्त या गलत ऑर्डर की रिपोर्ट डिलीवरी के 24 घंटे के अंदर व्हाट्सएप पर करें।',
            'gu' => 'અમારી ચોકલેટ્સ તાજી ખાદ્ય વસ્તુઓ છે. ડેમેજ અથવા ખોટા ઓર્ડરની 24 કલાકમાં વૉટ્સએપ પર જાણ કરો.',
            default => 'Because our chocolates are perishable, report damaged or incorrect orders on WhatsApp within twenty-four hours of pickup for a replacement or refund.',
        };

        return [
            'message' => $message,
            'speech_text' => $speechText,
            'action' => 'whatsapp',
            'action_url' => 'https://wa.me/917490828282?text='.urlencode('Hi Ruchi Chocolates, I would like to report an issue with my order.'),
            'action_label' => 'Report Issue on WhatsApp',
            'avatar_gesture' => 'explaining',
            'quick_replies' => ['Non-Returnable Items 🚫', 'Shop Pickup 🏪', 'Contact Us 📞'],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    protected function contactFormSectionTarget(): array
    {
        return [
            'selector' => '.rc-contact-form-card',
            'title' => 'Send Us a Message',
            'gesture' => 'pointing',
            'scroll' => true,
            'highlight' => true,
        ];
    }

    /**
     * @param  array<string, mixed>  $contactForm
     */
    protected function isContactFormIntakeActive(array $contactForm): bool
    {
        $step = $contactForm['step'] ?? null;

        return is_string($step) && in_array($step, ['name', 'email', 'phone', 'subject', 'message'], true);
    }

    protected function isContactFormStartIntent(string $normalized): bool
    {
        return (bool) preg_match('/submit\s*(a\s*)?query|send\s*(us\s*)?(a\s*)?message|contact\s*form|start\s*contact|fill\s*(out\s*)?(the\s*)?form|submit\s*(my\s*)?(message|query)/ui', $normalized);
    }

    protected function isContactFormCancelIntent(string $normalized): bool
    {
        return (bool) preg_match('/(cancel\s*form|^cancel$|never\s*mind|nevermind|stop\s*form|exit|abort|रद्द|રદ)/ui', $normalized);
    }

    /**
     * @param  array<string, mixed>  $contactForm
     * @return array<string, mixed>|null
     */
    protected function handleContactFormIntake(string $message, string $normalized, string $lang, array $contactForm): ?array
    {
        $step = isset($contactForm['step']) && is_string($contactForm['step']) ? $contactForm['step'] : null;
        $fields = $this->normalizeContactFormFields($contactForm['fields'] ?? []);
        $isActive = $this->isContactFormIntakeActive($contactForm);

        if ($this->isContactFormCancelIntent($normalized) && $isActive) {
            return $this->buildContactFormCancelledResponse($lang);
        }

        if (! $isActive && ! $this->isContactFormStartIntent($normalized)) {
            return null;
        }

        if (! $isActive) {
            return $this->beginContactFormIntake($fields, $lang);
        }

        return $this->advanceContactFormIntake($step, $message, $fields, $lang);
    }

    /**
     * @param  array<string, mixed>  $rawFields
     * @return array{name: string, email: string, phone: string, subject: string, message: string, phone_skipped: bool}
     */
    protected function normalizeContactFormFields(array $rawFields): array
    {
        return [
            'name' => trim((string) ($rawFields['name'] ?? '')),
            'email' => trim((string) ($rawFields['email'] ?? '')),
            'phone' => trim((string) ($rawFields['phone'] ?? '')),
            'subject' => trim((string) ($rawFields['subject'] ?? '')),
            'message' => trim((string) ($rawFields['message'] ?? '')),
            'phone_skipped' => (bool) ($rawFields['phone_skipped'] ?? false),
        ];
    }

    /**
     * @param  array{name: string, email: string, phone: string, subject: string, message: string, phone_skipped: bool}  $fields
     * @return array<string, mixed>
     */
    protected function beginContactFormIntake(array $fields, string $lang): array
    {
        $nextStep = $this->nextContactFormStep($fields);
        if ($nextStep === null) {
            return $this->buildContactFormCompleteResponse($fields, $lang);
        }

        return $this->buildContactFormPromptResponse($nextStep, $fields, $lang, true);
    }

    /**
     * @param  array{name: string, email: string, phone: string, subject: string, message: string, phone_skipped: bool}  $fields
     * @return array<string, mixed>
     */
    protected function advanceContactFormIntake(?string $step, string $message, array $fields, string $lang): array
    {
        $value = trim($message);

        if ($step === 'name') {
            if ($value === '' || mb_strlen($value) > 255) {
                return $this->buildContactFormValidationError('name', $fields, $lang, 'Please enter your full name (up to 255 characters).');
            }
            $fields['name'] = $value;
        } elseif ($step === 'email') {
            if ($value === '' || ! filter_var($value, FILTER_VALIDATE_EMAIL) || mb_strlen($value) > 255) {
                return $this->buildContactFormValidationError('email', $fields, $lang, 'Please enter a valid email address.');
            }
            $fields['email'] = $value;
        } elseif ($step === 'phone') {
            if ($this->shouldSkipContactFormPhone($value)) {
                $fields['phone'] = '';
                $fields['phone_skipped'] = true;
            } elseif (mb_strlen($value) > 50) {
                return $this->buildContactFormValidationError('phone', $fields, $lang, 'Phone number can be at most 50 characters, or type skip to leave it blank.');
            } else {
                $fields['phone'] = $value;
            }
        } elseif ($step === 'subject') {
            if ($value === '' || mb_strlen($value) > 255) {
                return $this->buildContactFormValidationError('subject', $fields, $lang, 'Please enter a subject for your message (up to 255 characters).');
            }
            $fields['subject'] = $value;
        } elseif ($step === 'message') {
            if ($value === '') {
                return $this->buildContactFormValidationError('message', $fields, $lang, 'Please type your message so we know how to help.');
            }
            $fields['message'] = $value;
        }

        $nextStep = $this->nextContactFormStep($fields);
        if ($nextStep === null) {
            return $this->buildContactFormCompleteResponse($fields, $lang);
        }

        return $this->buildContactFormPromptResponse($nextStep, $fields, $lang, false);
    }

    /**
     * @param  array{name: string, email: string, phone: string, subject: string, message: string, phone_skipped: bool}  $fields
     */
    protected function nextContactFormStep(array $fields): ?string
    {
        if ($fields['name'] === '') {
            return 'name';
        }

        if ($fields['email'] === '' || ! filter_var($fields['email'], FILTER_VALIDATE_EMAIL)) {
            return 'email';
        }

        if ($fields['phone'] === '' && ! $fields['phone_skipped']) {
            return 'phone';
        }

        if ($fields['subject'] === '') {
            return 'subject';
        }

        if ($fields['message'] === '') {
            return 'message';
        }

        return null;
    }

    protected function shouldSkipContactFormPhone(string $value): bool
    {
        $normalized = mb_strtolower(trim($value), 'UTF-8');

        return in_array($normalized, ['skip', 'no', 'none', 'n/a', 'na', '-', 'no phone', 'not applicable'], true);
    }

    /**
     * @param  array{name: string, email: string, phone: string, subject: string, message: string, phone_skipped: bool}  $fields
     * @return array<string, mixed>
     */
    protected function buildContactFormPromptResponse(string $step, array $fields, string $lang, bool $isStart): array
    {
        $prompts = [
            'name' => [
                'message' => "📝 **Submit your query**\n\nLet's fill in the same details as our **Send Us a Message** form.\n\n**Step 1 — Your name** *(required)*\nWhat is your full name?",
                'speech' => 'What is your full name for the contact form?',
            ],
            'email' => [
                'message' => "**Step 2 — Email address** *(required)*\nWhat email should we reply to?",
                'speech' => 'What email address should we use to reply?',
            ],
            'phone' => [
                'message' => "**Step 3 — Phone number** *(optional)*\nShare your phone or WhatsApp number, or type **skip** to leave it blank.",
                'speech' => 'What is your phone number? You can also say skip to leave it blank.',
            ],
            'subject' => [
                'message' => "**Step 4 — Subject** *(required)*\nWhat is your message about? *(e.g. Custom hamper inquiry)*",
                'speech' => 'What is the subject of your message?',
            ],
            'message' => [
                'message' => "**Step 5 — Your message** *(required)*\nTell us about your occasion, gift requirements, or questions.",
                'speech' => 'Please type your message for our team.',
            ],
        ];

        $copy = $prompts[$step] ?? $prompts['name'];

        return [
            'message' => $copy['message']."\n\n_Type **cancel** anytime to stop._",
            'speech_text' => $copy['speech'],
            'avatar_gesture' => 'listening',
            'section_target' => $this->contactFormSectionTarget(),
            'contact_form' => [
                'step' => $step,
                'fields' => $this->contactFormFieldsForClient($fields),
            ],
            'quick_replies' => $step === 'phone' ? ['skip'] : ['Cancel form ❌'],
        ];
    }

    /**
     * @param  array{name: string, email: string, phone: string, subject: string, message: string, phone_skipped: bool}  $fields
     * @return array<string, mixed>
     */
    protected function buildContactFormValidationError(string $step, array $fields, string $lang, string $errorMessage): array
    {
        $response = $this->buildContactFormPromptResponse($step, $fields, $lang, false);
        $response['message'] = "⚠️ {$errorMessage}\n\n".$response['message'];

        return $response;
    }

    /**
     * @param  array{name: string, email: string, phone: string, subject: string, message: string, phone_skipped: bool}  $fields
     * @return array<string, mixed>
     */
    protected function buildContactFormCompleteResponse(array $fields, string $lang): array
    {
        $clientFields = $this->contactFormFieldsForClient($fields);
        $phoneLine = $clientFields['phone'] !== '' ? $clientFields['phone'] : '—';
        $whatsappUrl = $this->contactWhatsAppInquiry->buildInquiryUrl($clientFields);

        return [
            'message' => "✅ **Your contact form is ready!**\n\n"
                ."I've filled **Send Us a Message** with:\n\n"
                ."• **Name:** {$clientFields['name']}\n"
                ."• **Email:** {$clientFields['email']}\n"
                ."• **Phone:** {$phoneLine}\n"
                ."• **Subject:** {$clientFields['subject']}\n"
                ."• **Message:** {$clientFields['message']}\n\n"
                .'Tap **Send on WhatsApp** below — your enquiry will open in WhatsApp with these details so you can send it directly to our team. You can also review the form on this page.',
            'speech_text' => 'I have filled in the contact form with your details. Tap Send on WhatsApp to message our team with your enquiry.',
            'avatar_gesture' => 'pointing',
            'section_target' => $this->contactFormSectionTarget(),
            'action' => 'prefill_contact_form',
            'action_url' => $whatsappUrl,
            'action_label' => 'Send on WhatsApp',
            'contact_form' => [
                'step' => 'complete',
                'fields' => $clientFields,
            ],
            'quick_replies' => ['Submit a Query 📝', 'Chat on WhatsApp 💬'],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    protected function buildContactFormCancelledResponse(string $lang): array
    {
        return [
            'message' => "No problem — I've stopped the contact form helper. You can still fill the form manually or tap **Submit a Query** to try again.",
            'speech_text' => 'I have cancelled the contact form helper. You can fill the form manually or start again anytime.',
            'avatar_gesture' => 'idle',
            'section_target' => $this->contactFormSectionTarget(),
            'contact_form' => [
                'step' => null,
                'fields' => [],
            ],
            'quick_replies' => ['Submit a Query 📝', 'Chat on WhatsApp 💬', 'Studio Address 📍'],
        ];
    }

    /**
     * @param  array{name: string, email: string, phone: string, subject: string, message: string, phone_skipped: bool}  $fields
     * @return array{name: string, email: string, phone: string, subject: string, message: string}
     */
    protected function contactFormFieldsForClient(array $fields): array
    {
        return [
            'name' => $fields['name'],
            'email' => $fields['email'],
            'phone' => $fields['phone'],
            'subject' => $fields['subject'],
            'message' => $fields['message'],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    protected function handleContactPageWelcome(string $lang): array
    {
        return [
            'message' => "Hi! 👋 You're on our **Contact Us** page.\n\nWould you like to **submit a query**? I can collect the same details as the contact form and fill it in for you to review and send.",
            'speech_text' => 'Would you like to submit a query? I can collect your details and fill in the contact form for you.',
            'avatar_gesture' => 'welcoming',
            'section_target' => $this->contactFormSectionTarget(),
            'quick_replies' => ['Submit a Query 📝', 'Chat on WhatsApp 💬', 'Studio Address 📍'],
        ];
    }

    /**
     * Handle Contact Us Navigation & Explanation.
     *
     * @return array<string, mixed>
     */
    protected function handleNavigateContactUs(string $lang, bool $isAlreadyOnPage): array
    {
        $url = route('contact');

        $preSpeech = match ($lang) {
            'hi' => 'बिल्कुल! चलिए मैं आपको हमारे Contact Us पेज पर ले चलती हूँ।',
            'gu' => 'ચોક્કસ! ચાલો હું તમને અમારા Contact Us પેજ પર લઈ જાઉં.',
            default => 'Of course! Let me take you to our Contact Us page with our studio address and contact details.',
        };

        $explMessage = "📞 **Contact Ruchi Chocolates:**\n\n"
            ."• **Send a message:** Tap **Submit a Query** below — I'll collect the same details as our contact form (name, email, phone, subject, message), fill the form, and open WhatsApp when you're done.\n\n"
            .'• **Studio Address:** '.config('ruchi.address')."\n"
            .'• **Phone / WhatsApp:** '.config('ruchi.phone_display')." *(Instant reply)*\n"
            .'• **Email:** '.config('ruchi.email')."\n"
            .'• **Business Hours:** Mon–Sat: 9:00 AM – 9:00 PM | Sun: 10:00 AM – 6:00 PM';

        $explSpeech = match ($lang) {
            'hi' => 'स्वागत है हमारे Contact Us पेज पर! क्वेरी भेजने के लिए Submit a Query टैप करें — मैं फॉर्म की तरह आपका नाम, ईमेल और संदेश लूँगी और फॉर्म भर दूँगी।',
            'gu' => 'અમારા Contact Us પેજ પર સ્વાગત છે! Submit a Query ટેપ કરો — હું ફોર્મ જેવી જ વિગતો લઈને ફોર્મ ભરી દઈશ.',
            default => 'Welcome to our Contact Us page! Tap Submit a Query and I will collect your details like the contact form, fill the form, and connect you to WhatsApp to send your message.',
        };

        $quickReplies = ['Submit a Query 📝', 'Chat on WhatsApp 💬', 'Studio Address 📍'];
        $sectionTarget = $this->contactFormSectionTarget();

        if ($isAlreadyOnPage) {
            return [
                'message' => "We are right here on our **Contact Us** page! 📞\n\n".$explMessage,
                'speech_text' => "We are right here on our Contact Us page! {$explSpeech}",
                'action' => 'whatsapp',
                'action_url' => 'https://wa.me/917490828282',
                'action_label' => 'Chat on WhatsApp (+91 7490828282)',
                'quick_replies' => $quickReplies,
                'section_target' => $sectionTarget,
                'avatar_gesture' => 'pointing',
                'navigation' => null,
            ];
        }

        return [
            'message' => $preSpeech,
            'speech_text' => $preSpeech,
            'action' => 'navigate',
            'action_url' => $url,
            'action_label' => 'Go to Contact Us',
            'avatar_gesture' => 'walking',
            'section_target' => $sectionTarget,
            'navigation' => [
                'navigate' => true,
                'url' => $url,
                'page_key' => 'contact',
                'page_name' => 'Contact Us',
                'pre_speech' => $preSpeech,
                'section_target' => $sectionTarget,
                'explanation' => [
                    'message' => $explMessage,
                    'speech_text' => $explSpeech,
                    'quick_replies' => $quickReplies,
                    'section_target' => $sectionTarget,
                    'avatar_gesture' => 'pointing',
                ],
            ],
            'quick_replies' => $quickReplies,
        ];
    }

    /**
     * Handle Privacy Policy Navigation & Explanation.
     *
     * @return array<string, mixed>
     */
    protected function handleNavigatePrivacyPolicy(string $lang, bool $isAlreadyOnPage): array
    {
        $url = route('privacy-policy');

        $preSpeech = match ($lang) {
            'hi' => 'ज़रूर! चलिए मैं आपको हमारे Privacy Policy पेज पर ले चलती हूँ।',
            'gu' => 'ચોક્કસ! ચાલો હું તમને અમારા Privacy Policy પેજ પર લઈ જાઉં.',
            default => 'Certainly! Let me take you to our Privacy Policy page.',
        };

        $explMessage = "🛡️ **Privacy Policy Overview:**\n\n"
            ."At Ruchi Chocolates, your privacy and trust are our top priority:\n\n"
            ."• **Confidential Details:** We only use your contact details to confirm orders and arrange shop pickup.\n"
            ."• **Zero Third-Party Sharing:** Your personal data is never sold or shared with third-party advertisers.\n"
            .'• **Direct Updates:** We communicate order and dispatch updates securely via verified WhatsApp channels.';

        $explSpeech = match ($lang) {
            'hi' => 'स्वागत है हमारे Privacy Policy पेज पर! रुचि चॉकलेट्स पर आपकी जानकारी पूरी तरह सुरक्षित रखी जाती है और किसी तीसरे पक्ष के साथ साझा नहीं की जाती।',
            'gu' => 'અમારા Privacy Policy પેજ પર સ્વાગત છે! રુચિ ચોકલેટ્સ પર તમારી માહિતી સંપૂર્ણપણે સુરક્ષિત રાખવામાં આવે છે.',
            default => 'Welcome to our Privacy Policy page! At Ruchi Chocolates, your contact and order details are kept strictly confidential and secure. We never share your personal information with third parties.',
        };

        $quickReplies = ['Terms & Conditions 📜', 'Contact Us 📞'];

        if ($isAlreadyOnPage) {
            return [
                'message' => "We are right here on our **Privacy Policy** page! 🛡️\n\n".$explMessage,
                'speech_text' => "We are right here on our Privacy Policy page! {$explSpeech}",
                'quick_replies' => $quickReplies,
                'navigation' => null,
            ];
        }

        return [
            'message' => $preSpeech,
            'speech_text' => $preSpeech,
            'action' => 'navigate',
            'action_url' => $url,
            'action_label' => 'View Privacy Policy',
            'navigation' => [
                'navigate' => true,
                'url' => $url,
                'page_key' => 'privacy-policy',
                'page_name' => 'Privacy Policy',
                'pre_speech' => $preSpeech,
                'explanation' => [
                    'message' => $explMessage,
                    'speech_text' => $explSpeech,
                    'quick_replies' => $quickReplies,
                ],
            ],
            'quick_replies' => $quickReplies,
        ];
    }

    /**
     * Handle Terms & Conditions Navigation & Explanation.
     *
     * @return array<string, mixed>
     */
    protected function handleNavigateTermsConditions(string $lang, bool $isAlreadyOnPage): array
    {
        $url = route('terms-and-conditions');

        $preSpeech = match ($lang) {
            'hi' => 'ज़रूर! चलिए मैं आपको हमारे Terms and Conditions पेज पर ले चलती हूँ।',
            'gu' => 'ચોક્કસ! ચાલો હું તમને અમારા Terms and Conditions પેજ પર લઈ જાઉં.',
            default => 'Certainly! Let me take you to our Terms and Conditions page.',
        };

        $explMessage = "📜 **Terms & Conditions Overview:**\n\n"
            ."These conditions explain browsing and ordering with Ruchi Chocolates:\n\n"
            ."• **Artisan Quality:** Handcrafted fresh in small batches upon order confirmation.\n"
            ."• **Customisation Notice:** Name lettering and bulk orders require advance confirmation before preparation.\n"
            .'• **Shop Pickup Only:** '.config('ruchi.shop_pickup_notice')." Collect orders from our Ahmedabad shop after confirmation on WhatsApp.\n"
            .'• **Food Safety:** Prepared following strict homemade hygiene standards.';

        $explSpeech = match ($lang) {
            'hi' => 'स्वागत है हमारे Terms and Conditions पेज पर! हमारे नियम हैंडक्राफ्टेड ऑर्डरिंग, कस्टमाइजेशन और अहमदाबाद लोकल डिलीवरी से जुड़े हैं।',
            'gu' => 'અમારા Terms and Conditions પેજ પર સ્વાગત છે! અમારા નિયમો હેન્ડમેડ ઓર્ડરિંગ અને ડિલિવરી માટે છે.',
            default => 'Welcome to our Terms and Conditions page! Our terms outline handcrafted ordering, customisation timelines, payment, and shop pickup guidelines.',
        };

        $quickReplies = ['Privacy Policy 🛡️', 'Contact Us 📞'];

        if ($isAlreadyOnPage) {
            return [
                'message' => "We are right here on our **Terms & Conditions** page! 📜\n\n".$explMessage,
                'speech_text' => "We are right here on our Terms and Conditions page! {$explSpeech}",
                'quick_replies' => $quickReplies,
                'navigation' => null,
            ];
        }

        return [
            'message' => $preSpeech,
            'speech_text' => $preSpeech,
            'action' => 'navigate',
            'action_url' => $url,
            'action_label' => 'View Terms & Conditions',
            'navigation' => [
                'navigate' => true,
                'url' => $url,
                'page_key' => 'terms-and-conditions',
                'page_name' => 'Terms & Conditions',
                'pre_speech' => $preSpeech,
                'explanation' => [
                    'message' => $explMessage,
                    'speech_text' => $explSpeech,
                    'quick_replies' => $quickReplies,
                ],
            ],
            'quick_replies' => $quickReplies,
        ];
    }

    /**
     * Handle Home Navigation & Explanation.
     *
     * @return array<string, mixed>
     */
    protected function handleNavigateHome(string $lang, bool $isAlreadyOnPage): array
    {
        $url = route('home');

        $preSpeech = match ($lang) {
            'hi' => 'चलिए, मैं आपको हमारे मुख्य होम पेज पर ले चलती हूँ!',
            'gu' => 'ચાલો, હું તમને અમારા મુખ્ય હોમ પેજ પર લઈ જાઉં છું!',
            default => 'Taking you to our Home page right away!',
        };

        $explMessage = "🏠 **Welcome to Ruchi Chocolates Home!**\n\n"
            ."From our homepage, you can discover:\n"
            ."• **Best Seller Hampers** & chocolate bouquets\n"
            ."• **Festive Category Circles** (Diwali, Rakhi, Birthday, Valentine's)\n"
            ."• **Customised Gifts Preview** and clear **shop pickup** information.\n\n"
            .'How can I help make your celebration sweeter today?';

        $explSpeech = match ($lang) {
            'hi' => 'स्वागत है हमारे मुख्य होम पेज पर! यहाँ आप हमारे बेस्ट सेलर हैम्पर्स, फेस्टिव कलेक्शन और ऑफर्स देख सकते हैं।',
            'gu' => 'અમારા મુખ્ય હોમ પેજ પર સ્વાગત છે! અહીં તમે અમારા બેસ્ટ સેલર્સ અને ફેસ્ટિવ કલેક્શન જોઈ શકો છો.',
            default => 'Welcome back to our homepage! You can explore our featured collections, best sellers, and occasion gifts here. What can I help you find today?',
        };

        $quickReplies = ['Browse Products 🍫', 'Customise a Gift ✨', 'Offers & Deals 🏷️', 'About Us 📖'];

        if ($isAlreadyOnPage) {
            return [
                'message' => "We are right here on our **Home** page! 🏠\n\n".$explMessage,
                'speech_text' => "We are right here on our Home page! {$explSpeech}",
                'quick_replies' => $quickReplies,
                'navigation' => null,
            ];
        }

        return [
            'message' => $preSpeech,
            'speech_text' => $preSpeech,
            'action' => 'navigate',
            'action_url' => $url,
            'action_label' => 'Go to Home',
            'navigation' => [
                'navigate' => true,
                'url' => $url,
                'page_key' => 'home',
                'page_name' => 'Home',
                'pre_speech' => $preSpeech,
                'explanation' => [
                    'message' => $explMessage,
                    'speech_text' => $explSpeech,
                    'quick_replies' => $quickReplies,
                ],
            ],
            'quick_replies' => $quickReplies,
        ];
    }

    /* =========================================================================
       Direct Inquiries (Non-Navigation Handlers)
       ========================================================================= */

    /**
     * Handle Delivery Information.
     *
     * @return array<string, mixed>
     */
    protected function handleDeliveryInformation(string $lang): array
    {
        $notice = (string) config('ruchi.shop_pickup_notice');
        $address = (string) config('ruchi.address');

        $message = "🏪 **Shop Pickup Only**\n\n"
            ."{$notice}\n\n"
            ."• **Collect from our Ahmedabad shop:** {$address}\n"
            ."• **Confirm on WhatsApp:** We confirm availability, pricing, and a pickup time before you visit.\n"
            .'• **No home delivery or shipping:** Courier and dispatch services are not available.';

        $speech = match ($lang) {
            'hi' => 'हम केवल शॉप पिकअप देते हैं — होम डिलीवरी उपलब्ध नहीं है। व्हाट्सएप पर उपलब्धता और पिकअप की जानकारी लें।',
            'gu' => 'અમે ફક્ત શોપ પિકઅપ આપીએ છીએ — હોમ ડિલિવરી ઉપલબ્ધ નથી. વૉટ્સએપ પર ઉપલબ્ધતા અને પિકઅપની વિગતો મેળવો.',
            default => 'We are shop pickup only — home delivery is not available. Message us on WhatsApp to confirm availability and arrange pickup.',
        };

        $waBase = rtrim((string) config('ruchi.whatsapp_url'), '/');

        return [
            'message' => $message,
            'speech_text' => $speech,
            'action' => 'whatsapp',
            'action_url' => $waBase.'?text='.urlencode('Hi Ruchi Chocolates, I would like to confirm product availability and arrange shop pickup.'),
            'action_label' => 'Arrange Pickup on WhatsApp',
            'quick_replies' => ['Browse Products 🍫', 'Customise a Gift ✨', 'Contact Us 📞'],
        ];
    }

    /**
     * Handle Track Order.
     *
     * @return array<string, mixed>
     */
    protected function handleTrackOrder(string $normalized, string $lang): array
    {
        $waBase = rtrim((string) config('ruchi.whatsapp_url'), '/');

        return [
            'message' => "🔍 **Order & Pickup Updates:**\n\n"
                ."Our team shares WhatsApp updates when your order is confirmed and when it is ready for **shop pickup** in Ahmedabad.\n\n"
                .'Please share your **order reference** or contact number on WhatsApp, and we will reply with the latest status and pickup details.',
            'speech_text' => 'Message us on WhatsApp with your order reference for pickup-ready updates.',
            'action' => 'whatsapp',
            'action_url' => $waBase.'?text='.urlencode('Hi Ruchi Chocolates, I would like an update on my order and shop pickup details. My order details: '),
            'action_label' => 'Get Pickup Update on WhatsApp',
            'quick_replies' => ['Browse Products 🍫', 'Shop Pickup 🏪'],
        ];
    }

    /**
     * Handle Offers and Deals.
     *
     * @return array<string, mixed>
     */
    protected function handleOffersAndDeals(string $lang): array
    {
        return [
            'message' => "🏷️ **Current Offers & Special Deals:**\n\n"
                ."• **Festive & Bulk Gifting Discount:** Special discounted rates on bulk orders (10+ hampers) for weddings, corporate gifting, and festivals.\n"
                ."• **Free Greeting Tag & Ribbon:** Complimentary personalized greeting message tag with every gift hamper.\n"
                ."• **Budget Specials:** Handcrafted chocolate boxes starting from just **₹170**!\n\n"
                .'Ask our team about seasonal wedding and festive hamper discounts!',
            'speech_text' => 'We have handcrafted chocolate gifts starting from just one hundred seventy rupees, plus bulk discounts for celebrations.',
            'action' => 'navigate',
            'action_url' => route('products'),
            'action_label' => 'Browse Affordable Chocolates',
            'quick_replies' => ['Browse Products 🍫', 'Customised Hampers ✨', 'Enquire on WhatsApp 💬'],
        ];
    }

    /**
     * Handle Talk to Human.
     *
     * @return array<string, mixed>
     */
    protected function handleTalkToHuman(string $lang): array
    {
        return [
            'message' => "👩‍🍳 **Connect with Ruchi Chocolates Directly:**\n\n"
                ."You can chat with our team directly for custom orders, urgent deliveries, or personal assistance:\n\n"
                ."• **WhatsApp:** +91 7490828282 *(Instant response)*\n"
                ."• **Phone:** +91 7490828282\n"
                ."• **Email:** Info.ruchi11@gmail.com\n"
                .'• **Studio Location:** Paldi, Ahmedabad, Gujarat',
            'speech_text' => 'You can connect directly with our chocolate team on WhatsApp at +91 7490828282.',
            'action' => 'whatsapp',
            'action_url' => 'https://wa.me/917490828282?text='.urlencode('Hi Ruchi Chocolates, I would like to speak with a representative about your products.'),
            'action_label' => 'Chat on WhatsApp Now',
            'quick_replies' => ['Browse Products 🍫', 'Customise a Gift ✨'],
        ];
    }

    /**
     * Handle price-related search (e.g. under 200, under 300, under 500).
     *
     * @return array<string, mixed>
     */
    protected function handlePriceSearch(string $normalized, string $lang): array
    {
        $all = $this->catalogService->getAllProducts();
        $targetPrice = 500.0;

        if (preg_match('/(\d+)/', $normalized, $matches)) {
            $parsed = (float) $matches[1];
            if ($parsed > 50) {
                $targetPrice = $parsed;
            }
        }

        $matched = array_filter($all, function ($p) use ($targetPrice) {
            return (float) $p['price'] <= $targetPrice;
        });

        usort($matched, function ($a, $b) {
            return (float) $a['price'] <=> (float) $b['price'];
        });

        $top = array_slice($matched, 0, 4);

        if (empty($top)) {
            $top = array_slice($all, 0, 3);
        }

        $firstItemTitle = ! empty($top) ? preg_replace('/^P\d+\s*/i', '', $top[0]['title']) : 'assorted chocolate boxes';

        if ($lang === 'hi') {
            $msg = "यहाँ **₹{$targetPrice}** के अंदर हमारी सबसे बेहतरीन हैंडक्राफ्टेड चॉकलेट्स हैं:";
            $speech = "{$targetPrice} रुपये के अंदर हमारे लोकप्रिय विकल्पों में {$firstItemTitle} शामिल है।";
        } elseif ($lang === 'gu') {
            $msg = "અહીં **₹{$targetPrice}** અંદર અમારી શ્રેષ્ઠ હેન્ડમેડ ચોકલેટ્સ છે:";
            $speech = "{$targetPrice} રૂપિયાની અંદર અમારા શ્રેષ્ઠ વિકલ્પોમાં {$firstItemTitle} છે.";
        } else {
            $msg = "Here are some of our best handcrafted chocolate gifts under **₹{$targetPrice}**:";
            $speech = "Under {$targetPrice} rupees, our top recommendations include the {$firstItemTitle}, handcrafted with pure ingredients.";
        }

        return [
            'message' => $msg,
            'speech_text' => $speech,
            'products' => $this->formatProducts($top),
            'action' => 'navigate',
            'action_url' => route('products'),
            'action_label' => 'Explore All Products',
            'quick_replies' => ['Customised Gifts ✨', 'Order on WhatsApp 💬'],
        ];
    }

    /**
     * Handle occasion/festival search.
     *
     * @return array<string, mixed>|null
     */
    protected function handleOccasionSearch(string $normalized, string $lang, ?string $currentPage = null): ?array
    {
        $browseSlug = $this->resolveBrowseOccasionSlug($normalized);
        if ($browseSlug !== null) {
            return $this->buildOccasionCatalogResponse($browseSlug, $lang);
        }

        return null;
    }

    /**
     * Handle general product keyword search.
     *
     * @return array<string, mixed>|null
     */
    protected function handleProductKeywordSearch(string $normalized, string $lang): ?array
    {
        $keywords = ['heart', 'tin', 'box', 'potli', 'hamper', 'bouquet', 'matki', 'basket', 'rose', 'truffle', 'acrylic', 'handy'];
        $hasKw = false;
        foreach ($keywords as $kw) {
            if (mb_stripos($normalized, $kw) !== false) {
                $hasKw = true;
                break;
            }
        }

        if (! $hasKw) {
            return null;
        }

        $all = $this->catalogService->getAllProducts();
        $matched = array_filter($all, function ($p) use ($normalized) {
            $haystack = mb_strtolower(($p['title'] ?? '').' '.($p['description'] ?? '').' '.($p['category'] ?? ''));
            $words = explode(' ', $normalized);
            foreach ($words as $w) {
                if (strlen($w) > 3 && mb_stripos($haystack, $w) !== false) {
                    return true;
                }
            }

            return false;
        });

        if (empty($matched)) {
            return null;
        }

        $top = array_slice($matched, 0, 4);

        return [
            'message' => 'I found these delicious options matching your search:',
            'speech_text' => 'I found these delicious options matching your search.',
            'products' => $this->formatProducts($top),
            'action' => 'navigate',
            'action_url' => route('products'),
            'action_label' => 'View Catalogue',
            'quick_replies' => ['Customise This ✨', 'Check Price 🏷️', 'Order on WhatsApp 💬'],
        ];
    }

    /**
     * Handle Greeting.
     *
     * @return array<string, mixed>
     */
    protected function handleGreeting(string $lang): array
    {
        if ($lang === 'hi') {
            return [
                'message' => "नमस्ते! 😊 मैं रुचि चॉकलेट्स की AI असिस्टेंट हूँ।\n\nहमारे पास हैंडक्राफ्टेड चॉकलेट्स, खूबसूरत गिफ्ट हैम्पर्स और पर्सनलाइज्ड गिफ्ट्स की बेहतरीन वैरायटी है।\n\nआज मैं आपके लिए क्या खास ढूंढने में मदद करूँ?",
                'speech_text' => 'नमस्ते! मैं रुचि चॉकलेट्स की AI असिस्टेंट हूँ। आज मैं आपके लिए क्या खास ढूंढने में मदद करूँ?',
                'quick_replies' => ['चॉकलेट्स दिखाएं 🍫', 'कस्टमाइज गिफ्ट्स ✨', 'हमारे बारे में 📖'],
            ];
        }

        if ($lang === 'gu') {
            return [
                'message' => "નમસ્તે! 😊 હું રુચિ ચોકલેટ્સની AI આસિસ્ટન્ટ છું.\n\nઅમારી પાસે પ્રીમિયમ હેન્ડમેડ ચોકલેટ્સ, ગિફ્ટ હેમ્પર્સ અને કસ્ટમાઇઝ્ડ ચોકલેટ બોક્સ છે.\n\nઆજે તમને શેના માટે ચોકલેટ જોઈએ છે?",
                'speech_text' => 'નમસ્તે! હું રુચિ ચોકલેટ્સની AI આસિસ્ટન્ટ છું. આજે તમને શેના માટે ચોકલેટ જોઈએ છે?',
                'quick_replies' => ['પ્રોડક્ટ્સ જુઓ 🍫', 'કસ્ટમાઇઝ્ડ ગિફ્ટ ✨', 'અમારા વિશે 📖'],
            ];
        }

        return [
            'message' => "Hi there! 👋 I'm **Ruchi's AI Assistant**, your chocolate-gifting specialist!\n\nWhether you need handcrafted truffles, stunning chocolate bouquets, custom lettering boxes, or festive hampers in Ahmedabad, I'm here to guide you. What are you celebrating today?",
            'speech_text' => "Hi there! I'm Ruchi's AI Assistant, your chocolate gifting specialist. How can I make your day sweeter?",
            'quick_replies' => ['Browse Products 🍫', 'Customise a Gift ✨', 'Our Story 📖'],
        ];
    }

    /**
     * Handle Gratitude.
     *
     * @return array<string, mixed>
     */
    protected function handleGratitude(string $lang): array
    {
        if ($lang === 'hi') {
            return [
                'message' => 'आपका स्वागत है! 💖 आपकी खुशी ही हमारी मिठास है। अगर कुछ और चाहिए तो बेझिझक पूछें!',
                'speech_text' => 'आपका स्वागत है! अगर आपको कुछ और चाहिए तो बेझिझक पूछें।',
                'quick_replies' => ['और प्रोडक्ट्स देखें 🍫', 'ऑर्डर कैसे करें? 💬'],
            ];
        }

        if ($lang === 'gu') {
            return [
                'message' => 'તમારો ખૂબ ખૂબ આભાર! 💖 તમારા જીવનમાં હંમેશા મીઠાશ રહે. બીજી કોઈ માહિતી જોઈએ તો જરૂર કહેજો!',
                'speech_text' => 'તમારો ખૂબ ખૂબ આભાર! બીજી કોઈ માહિતી જોઈએ તો જરૂર કહેજો.',
                'quick_replies' => ['પ્રોડક્ટ્સ જુઓ 🍫', 'સંપર્ક કરો 💬'],
            ];
        }

        return [
            'message' => "You're very welcome! 💖 We love bringing sweet smiles to your celebrations. Let me know if you need any more recommendations or gifting ideas!",
            'speech_text' => "You're very welcome! Let me know if you need any more recommendations.",
            'quick_replies' => ['Browse Products 🍫', 'Customise a Gift ✨', 'Contact Us 📞'],
        ];
    }

    /**
     * Handle Fallback.
     *
     * @return array<string, mixed>
     */
    protected function handleFallback(string $originalQuery, string $lang): array
    {
        $whatsappMsg = urlencode('Hi Ruchi Chocolates, I have a question: '.$originalQuery);

        return [
            'message' => "That's a wonderful question! While I can guide you across our products, customisation, policies, and Ahmedabad deliveries, our head chocolatier can answer every custom detail personally on WhatsApp.\n\nWould you like me to connect you with our team right away?",
            'speech_text' => 'I can connect you directly with our chocolate team on WhatsApp for personalized assistance.',
            'action' => 'whatsapp',
            'action_url' => "https://wa.me/917490828282?text={$whatsappMsg}",
            'action_label' => 'Ask Our Team on WhatsApp',
            'quick_replies' => ['Browse Products 🍫', 'Customise a Gift ✨', 'Contact Us 📞'],
        ];
    }

    /**
     * Build empty response.
     *
     * @return array<string, mixed>
     */
    protected function buildEmptyResponse(string $lang): array
    {
        return [
            'message' => 'How can I help make your celebration sweeter today? Ask me about our chocolates, custom gift hampers, pricing, or shop pickup!',
            'speech_text' => 'How can I help make your celebration sweeter today?',
            'quick_replies' => ['Browse Products 🍫', 'Customise a Gift ✨', 'Shop Pickup 🏪'],
        ];
    }

    /**
     * Format product items for the frontend assistant cards.
     *
     * @param  array<int, array<string, mixed>>  $products
     * @return array<int, array<string, mixed>>
     */
    protected function formatProducts(array $products): array
    {
        $out = [];
        foreach ($products as $p) {
            $out[] = [
                'id' => $p['id'],
                'title' => $p['title'],
                'price' => number_format((float) $p['price'], 2),
                'price_raw' => (float) $p['price'],
                'image' => asset($p['image']),
                'category' => $p['category'] ?? 'Handmade Chocolates',
                'in_stock' => $p['in_stock'] ?? true,
                'rating' => $p['rating'] ?? 4.8,
            ];
        }

        return $out;
    }

    /**
     * Check if text matches any keyword in list.
     *
     * @param  array<int, string>  $keywords
     */
    protected function matchesIntent(string $text, array $keywords): bool
    {
        foreach ($keywords as $kw) {
            if (mb_stripos($text, $kw) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * Detect language preference from query or default.
     */
    protected function detectLanguage(string $text, string $default): string
    {
        if (preg_match('/[\x{0A80}-\x{0AFF}]/u', $text) || mb_stripos($text, 'kem cho') !== false || mb_stripos($text, 'aabhar') !== false || mb_stripos($text, 'tame') !== false) {
            return 'gu';
        }

        if (preg_match('/[\x{0900}-\x{097F}]/u', $text) || mb_stripos($text, 'namaste') !== false || mb_stripos($text, 'chahiye') !== false || mb_stripos($text, 'kya') !== false || mb_stripos($text, 'hai') !== false) {
            return 'hi';
        }

        return in_array($default, ['en', 'hi', 'gu'], true) ? $default : 'en';
    }
}
