@extends('layouts.app')

@section('title', 'Terms & Conditions — Ruchi Chocolates | Handcrafted with Love')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/privacy-policy.css') }}">
@endpush

@section('content')
<div class="rc-privacy-page-wrapper">

    {{-- =========================================================================
         HERO SECTION: Breadcrumb, Heading + Accent Heart, Intro & Hamper Image
         ========================================================================= --}}
    <section class="rc-policy-hero-section" aria-label="Terms and Conditions Introduction">
        <div class="rc-policy-hero-container">
            
            <!-- Left Column: Content -->
            <div class="rc-policy-hero-content">
                <!-- Breadcrumb -->
                <nav class="rc-policy-breadcrumb" aria-label="Breadcrumb">
                    <a href="{{ route('home') }}" class="rc-policy-breadcrumb-link">Home</a>
                    <span class="rc-policy-breadcrumb-sep">&gt;</span>
                    <span class="rc-policy-breadcrumb-current">Terms &amp; Conditions</span>
                </nav>

                <!-- Heading with Subtle Decorative Gold Heart -->
                <div class="rc-policy-heading-row">
                    <h1 class="rc-policy-hero-title">Terms &amp; Conditions</h1>
                    <svg class="rc-policy-heart-icon rc-policy-heart-icon--gold" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                    </svg>
                </div>

                <!-- Description -->
                <p class="rc-policy-hero-desc">
                    Welcome to Ruchi Chocolates. These terms explain the conditions that apply when you browse our website, enquire about our products, or place an order with us.
                </p>
            </div>

            <!-- Right Column: Blended Chocolate Hamper Photo with Soft Gradient -->
            <div class="rc-policy-hero-media">
                <div class="rc-policy-hero-img-wrap">
                    <img 
                        src="{{ asset('images/terms-hero-hamper.jpg') }}" 
                        alt="Ruchi Chocolates handcrafted luxury gift hamper with ribbons and artisan chocolates" 
                        class="rc-policy-hero-img"
                        loading="eager"
                    >
                    <div class="rc-policy-hero-blend" aria-hidden="true"></div>
                </div>
            </div>

        </div>
    </section>

    {{-- =========================================================================
         CONTENT SECTION: 13 Vertically Stacked Content Cards + Botanical Details
         ========================================================================= --}}
    <section class="rc-policy-cards-section" aria-label="Terms and Conditions Details">
        <div class="rc-policy-cards-container">

            <!-- Botanical Line-Art Background Flourishes -->
            <svg class="rc-policy-botanical rc-policy-botanical--left-1" viewBox="0 0 100 180" fill="none" stroke="#dcb4a8" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M10,170 C25,120 40,80 85,20"></path>
                <path d="M30,135 C45,130 55,140 45,150 C38,155 30,145 30,135 Z"></path>
                <path d="M48,105 C60,95 72,105 65,115 C58,122 50,112 48,105 Z"></path>
                <path d="M65,65 C78,55 90,62 82,75 C75,82 66,72 65,65 Z"></path>
                <path d="M85,20 C92,10 98,16 94,26 C90,32 84,26 85,20 Z"></path>
            </svg>

            <svg class="rc-policy-botanical rc-policy-botanical--right-1" viewBox="0 0 100 200" fill="none" stroke="#dcb4a8" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M90,190 C75,130 60,85 15,15"></path>
                <path d="M70,150 C55,145 45,155 55,165 C62,170 70,160 70,150 Z"></path>
                <path d="M52,115 C40,105 28,115 35,125 C42,132 50,122 52,115 Z"></path>
                <path d="M35,70 C22,60 10,67 18,80 C25,87 34,77 35,70 Z"></path>
                <path d="M15,15 C8,5 2,11 6,21 C10,27 16,21 15,15 Z"></path>
            </svg>

            <svg class="rc-policy-botanical rc-policy-botanical--left-2" viewBox="0 0 100 180" fill="none" stroke="#dcb4a8" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M15,10 C30,60 45,100 85,165"></path>
                <path d="M35,45 C50,50 60,40 50,30 C43,25 35,35 35,45 Z"></path>
                <path d="M52,85 C65,95 75,85 68,75 C61,68 53,78 52,85 Z"></path>
                <path d="M70,125 C82,135 95,128 88,115 C81,108 72,118 70,125 Z"></path>
            </svg>

            <svg class="rc-policy-botanical rc-policy-botanical--right-2" viewBox="0 0 100 180" fill="none" stroke="#dcb4a8" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M85,10 C70,60 55,100 15,165"></path>
                <path d="M65,45 C50,50 40,40 50,30 C57,25 65,35 65,45 Z"></path>
                <path d="M48,85 C35,95 25,85 32,75 C39,68 47,78 48,85 Z"></path>
                <path d="M30,125 C18,135 5,128 12,115 C19,108 28,118 30,125 Z"></path>
            </svg>

            <!-- Cards List -->
            <div class="rc-policy-cards-list">

                {{-- CARD 1: Acceptance of Terms --}}
                <article class="rc-policy-card">
                    <div class="rc-policy-card__icon-wrap" aria-hidden="true">
                        <!-- Document-Check Icon -->
                        <svg class="rc-policy-card__icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <polyline points="9 15 11 17 15 13"></polyline>
                        </svg>
                    </div>
                    <div class="rc-policy-card__content">
                        <h2 class="rc-policy-card__title">1. Acceptance of Terms</h2>
                        <p class="rc-policy-card__text">
                            By accessing or using the Ruchi Chocolates website, you agree to these Terms &amp; Conditions. If you do not agree with these terms, please discontinue use of the website.
                        </p>
                    </div>
                </article>

                {{-- CARD 2: Products and Descriptions --}}
                <article class="rc-policy-card">
                    <div class="rc-policy-card__icon-wrap" aria-hidden="true">
                        <!-- Chocolate Box / Gift Icon -->
                        <svg class="rc-policy-card__icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <polyline points="20 12 20 22 4 22 4 12"></polyline>
                            <rect x="2" y="7" width="20" height="5"></rect>
                            <line x1="12" y1="22" x2="12" y2="7"></line>
                            <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path>
                            <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path>
                        </svg>
                    </div>
                    <div class="rc-policy-card__content">
                        <h2 class="rc-policy-card__title">2. Products and Descriptions</h2>
                        <p class="rc-policy-card__text">
                            We aim to display accurate product descriptions, photographs, prices, and customisation options. Actual product appearance may vary slightly because our chocolates and gifts are handcrafted, and colours or packaging may differ from photographs.
                        </p>
                        <p class="rc-policy-card__text" style="margin-top: 10px;">
                            Product availability and customisation options may change without prior notice.
                        </p>
                    </div>
                </article>

                {{-- CARD 3: Orders and Confirmation --}}
                <article class="rc-policy-card">
                    <div class="rc-policy-card__icon-wrap" aria-hidden="true">
                        <!-- Shopping Bag Icon -->
                        <svg class="rc-policy-card__icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                        </svg>
                    </div>
                    <div class="rc-policy-card__content">
                        <h2 class="rc-policy-card__title">3. Orders and Confirmation</h2>
                        <p class="rc-policy-card__text">
                            Submitting an enquiry or order request does not necessarily mean that an order has been accepted. Orders may require confirmation of product availability, customisation details, shop pickup arrangements, and final pricing.
                        </p>
                        <p class="rc-policy-card__text" style="margin-top: 10px;">
                            We will communicate any necessary clarification or confirmation through the contact details provided by the customer.
                        </p>
                    </div>
                </article>

                {{-- CARD 4: Pricing and Payment --}}
                <article class="rc-policy-card">
                    <div class="rc-policy-card__icon-wrap" aria-hidden="true">
                        <!-- Currency / Payment Card Icon -->
                        <svg class="rc-policy-card__icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                            <line x1="1" y1="10" x2="23" y2="10"></line>
                            <path d="M6 15h2"></path>
                            <path d="M11 15h4"></path>
                        </svg>
                    </div>
                    <div class="rc-policy-card__content">
                        <h2 class="rc-policy-card__title">4. Pricing and Payment</h2>
                        <p class="rc-policy-card__text">
                            Prices and applicable charges will be communicated or displayed before an order is confirmed. Any customisation charges, taxes, or other applicable costs should be disclosed before the customer commits to the purchase. We do not offer home delivery or shipping.
                        </p>
                        <p class="rc-policy-card__text" style="margin-top: 10px;">
                            Payment methods and payment timing are subject to the arrangements confirmed for the particular order. We support secure and verified payment methods agreed upon during order confirmation.
                        </p>
                    </div>
                </article>

                {{-- CARD 5: Customised Products --}}
                <article class="rc-policy-card">
                    <div class="rc-policy-card__icon-wrap" aria-hidden="true">
                        <!-- Gift / Personalisation Star Icon -->
                        <svg class="rc-policy-card__icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                        </svg>
                    </div>
                    <div class="rc-policy-card__content">
                        <h2 class="rc-policy-card__title">5. Customised Products</h2>
                        <p class="rc-policy-card__text">
                            Customers should provide accurate spelling, names, messages, colours, themes, and other personalisation instructions when requesting customised chocolates or gift hampers.
                        </p>
                        <p class="rc-policy-card__text" style="margin-top: 10px;">
                            Customised products are prepared according to the details confirmed with the customer. Changes after confirmation may not always be possible.
                        </p>
                        <p class="rc-policy-card__text" style="margin-top: 10px;">
                            Any restrictions on cancellations, returns, refunds, or replacements must follow the published policies and applicable law.
                        </p>
                    </div>
                </article>

                {{-- CARD 6: Shop pickup --}}
                <article class="rc-policy-card">
                    <div class="rc-policy-card__icon-wrap" aria-hidden="true">
                        <svg class="rc-policy-card__icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                    </div>
                    <div class="rc-policy-card__content">
                        <h2 class="rc-policy-card__title">6. Shop Pickup</h2>
                        <p class="rc-policy-card__text">
                            {{ config('ruchi.shop_pickup_notice') }} All orders must be collected from our shop in Ahmedabad. Home delivery, courier shipping, and dispatch to other cities are not available.
                        </p>
                        <p class="rc-policy-card__text" style="margin-top: 10px;">
                            Pickup dates and times depend on product availability, customisation requirements, and the arrangements confirmed with you at the time of ordering. Please provide accurate contact details and collect your order within the agreed pickup window.
                        </p>
                        <p class="rc-policy-card__text" style="margin-top: 10px;">
                            Our shop address is published on the Contact page. Contact us on WhatsApp ({{ config('ruchi.phone_display') }}) to confirm availability and arrange pickup.
                        </p>
                    </div>
                </article>

                {{-- CARD 7: Cancellations, Returns, and Refunds --}}
                <article class="rc-policy-card">
                    <div class="rc-policy-card__icon-wrap" aria-hidden="true">
                        <!-- Circular Arrows / Return Icon -->
                        <svg class="rc-policy-card__icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <polyline points="1 4 1 10 7 10"></polyline>
                            <polyline points="23 20 23 14 17 14"></polyline>
                            <path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path>
                        </svg>
                    </div>
                    <div class="rc-policy-card__content">
                        <h2 class="rc-policy-card__title">7. Cancellations, Returns, and Refunds</h2>
                        <p class="rc-policy-card__text">
                            Order cancellations, returns, replacements, and refunds are handled case by case. Because some products are perishable or customised, different conditions may apply depending on the product and the circumstances.
                        </p>
                        <p class="rc-policy-card__text" style="margin-top: 10px;">
                            For damaged or incorrect orders, please contact us on WhatsApp ({{ config('ruchi.phone_display') }}) within 24 hours of pickup with photo or video proof. Nothing in these terms removes any consumer rights that cannot legally be excluded.
                        </p>
                    </div>
                </article>

                {{-- CARD 8: Customer Responsibilities --}}
                <article class="rc-policy-card">
                    <div class="rc-policy-card__icon-wrap" aria-hidden="true">
                        <!-- Checklist Icon -->
                        <svg class="rc-policy-card__icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M9 11l3 3L22 4"></path>
                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                        </svg>
                    </div>
                    <div class="rc-policy-card__content">
                        <h2 class="rc-policy-card__title">8. Customer Responsibilities</h2>
                        <p class="rc-policy-card__text">
                            Customers agree to:
                        </p>
                        <ul class="rc-policy-card__list">
                            <li class="rc-policy-card__item">Provide accurate contact and order information for shop pickup.</li>
                            <li class="rc-policy-card__item">Use the website lawfully and responsibly.</li>
                            <li class="rc-policy-card__item">Avoid submitting fraudulent orders or misleading enquiries.</li>
                            <li class="rc-policy-card__item">Respect the intellectual property and content published on the website.</li>
                        </ul>
                    </div>
                </article>

                {{-- CARD 9: Intellectual Property --}}
                <article class="rc-policy-card">
                    <div class="rc-policy-card__icon-wrap" aria-hidden="true">
                        <!-- Copyright / Document Icon -->
                        <svg class="rc-policy-card__icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M14.83 14.83a4 4 0 1 1 0-5.66"></path>
                        </svg>
                    </div>
                    <div class="rc-policy-card__content">
                        <h2 class="rc-policy-card__title">9. Intellectual Property</h2>
                        <p class="rc-policy-card__text">
                            Website content, including branding, logos, photographs, product descriptions, graphics, and design elements, may be owned by Ruchi Chocolates or used with permission.
                        </p>
                        <p class="rc-policy-card__text" style="margin-top: 10px;">
                            Content may not be copied, republished, or commercially reused without appropriate authorisation, except where permitted by applicable law.
                        </p>
                    </div>
                </article>

                {{-- CARD 10: Website Availability --}}
                <article class="rc-policy-card">
                    <div class="rc-policy-card__icon-wrap" aria-hidden="true">
                        <!-- Globe / Availability Icon -->
                        <svg class="rc-policy-card__icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="2" y1="12" x2="22" y2="12"></line>
                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                        </svg>
                    </div>
                    <div class="rc-policy-card__content">
                        <h2 class="rc-policy-card__title">10. Website Availability</h2>
                        <p class="rc-policy-card__text">
                            We aim to keep the website accessible and accurate, but temporary interruptions, technical issues, maintenance, or errors may occur.
                        </p>
                        <p class="rc-policy-card__text" style="margin-top: 10px;">
                            We may update website content, product information, or available features as needed. Any limitations of liability must be consistent with applicable law.
                        </p>
                    </div>
                </article>

                {{-- CARD 11: Privacy --}}
                <article class="rc-policy-card">
                    <div class="rc-policy-card__icon-wrap" aria-hidden="true">
                        <!-- Shield / Privacy Icon -->
                        <svg class="rc-policy-card__icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        </svg>
                    </div>
                    <div class="rc-policy-card__content">
                        <h2 class="rc-policy-card__title">11. Privacy</h2>
                        <p class="rc-policy-card__text">
                            Personal information provided through the website or during enquiries is handled according to our Privacy Policy.
                        </p>
                        <p class="rc-policy-card__text" style="margin-top: 10px;">
                            Please refer to our <a href="{{ route('privacy-policy') }}" class="rc-policy-text-link">Privacy Policy</a> to understand how your data is collected, stored, and protected.
                        </p>
                    </div>
                </article>

                {{-- CARD 12: Changes to These Terms --}}
                <article class="rc-policy-card">
                    <div class="rc-policy-card__icon-wrap" aria-hidden="true">
                        <!-- Document-Edit / Updates Icon -->
                        <svg class="rc-policy-card__icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                    </div>
                    <div class="rc-policy-card__content">
                        <h2 class="rc-policy-card__title">12. Changes to These Terms</h2>
                        <p class="rc-policy-card__text">
                            We may update these Terms &amp; Conditions when our services, website, or business requirements change. Updated terms will be published on this page with a revised effective date where appropriate.
                        </p>
                    </div>
                </article>

                {{-- CARD 13: Contact Us --}}
                <article class="rc-policy-card rc-policy-card--contact">
                    <div class="rc-policy-card__icon-wrap" aria-hidden="true">
                        <!-- Headset / Customer Support Icon -->
                        <svg class="rc-policy-card__icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                            <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path>
                        </svg>
                    </div>
                    <div class="rc-policy-card__content">
                        <h2 class="rc-policy-card__title">13. Contact Us</h2>
                        <p class="rc-policy-card__text">
                            For questions about these Terms &amp; Conditions, orders, or our products, contact Ruchi Chocolates:
                        </p>

                        <!-- Horizontal Contact Details on Desktop, neatly stacked on mobile -->
                        <div class="rc-policy-contact-row">
                            <!-- Email -->
                            <a href="mailto:{{ config('ruchi.email') }}" class="rc-policy-contact-item" title="Send email to {{ config('ruchi.email') }}">
                                <svg class="rc-policy-contact-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                                <span>{{ config('ruchi.email') }}</span>
                            </a>

                            <div class="rc-policy-contact-divider" aria-hidden="true"></div>

                            <!-- Phone -->
                            <a href="{{ config('ruchi.tel_url') }}" class="rc-policy-contact-item" title="Call {{ config('ruchi.phone_display') }}">
                                <svg class="rc-policy-contact-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                                <span>{{ config('ruchi.phone_display') }}</span>
                            </a>

                            <div class="rc-policy-contact-divider" aria-hidden="true"></div>

                            <!-- Location -->
                            <div class="rc-policy-contact-item" title="Location: Ahmedabad, Gujarat, India">
                                <svg class="rc-policy-contact-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <span>Ahmedabad, Gujarat, India</span>
                            </div>

                            <div class="rc-policy-contact-divider" aria-hidden="true"></div>

                            <!-- WhatsApp Enquiry -->
                            <a 
                                href="{{ config('ruchi.whatsapp_url') }}?text=Hi%20Ruchi%20Chocolates%2C%20I%20have%20a%20question%20about%20your%20Terms%20%26%20Conditions." 
                                class="rc-policy-whatsapp-btn" 
                                target="_blank" 
                                rel="noopener noreferrer"
                            >
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2zm5.79 14.07c-.24.67-1.39 1.28-1.92 1.36-.5.08-1.14.12-3.37-.8-2.67-1.11-4.38-3.83-4.51-4.01-.13-.18-1.07-1.42-1.07-2.71 0-1.29.68-1.92.92-2.18.24-.26.53-.33.71-.33.18 0 .36.002.51.01.16.01.38-.06.59.45.24.57.81 1.97.88 2.11.07.15.12.32.02.51-.1.2-.15.32-.3.49-.15.17-.31.39-.45.52-.15.15-.31.31-.13.62.18.31.8 1.31 1.71 2.12 1.17 1.04 2.16 1.36 2.47 1.51.31.15.49.13.67-.08.18-.21.78-.91.99-1.22.21-.31.42-.26.71-.15.29.11 1.83.86 2.15 1.02.32.16.53.24.61.37.08.14.08.79-.16 1.46z"/>
                                </svg>
                                <span>Enquire on WhatsApp</span>
                            </a>
                        </div>
                    </div>

                    <!-- Chocolate Stack Illustration Near Bottom Right of Card 13 -->
                    <div class="rc-policy-choc-decoration" aria-hidden="true">
                        <img 
                            src="{{ asset('images/chocolate-stack.jpg') }}" 
                            alt="Handcrafted dark chocolate blocks" 
                            class="rc-policy-choc-img"
                            loading="lazy"
                        >
                    </div>
                </article>

            </div>

        </div>
    </section>

</div>
@endsection
