@extends('layouts.app')

@section('title', 'Privacy Policy — Ruchi Chocolates | Handcrafted with Love')
@section('meta_description', 'Read the Privacy Policy for Ruchi Chocolates to understand how we collect, protect, and handle your personal information when using our website and services.')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/privacy-policy.css') }}">
@endpush

@section('content')
<div class="rc-privacy-page-wrapper">

    {{-- =========================================================================
         HERO SECTION: Breadcrumb, Heading + Outlined Heart, Intro & Hamper Image
         ========================================================================= --}}
    <section class="rc-policy-hero-section" aria-label="Privacy Policy Introduction">
        <div class="rc-policy-hero-container">
            
            <!-- Left Column: Content -->
            <div class="rc-policy-hero-content">
                <!-- Breadcrumb -->
                <nav class="rc-policy-breadcrumb" aria-label="Breadcrumb">
                    <a href="{{ route('home') }}" class="rc-policy-breadcrumb-link">Home</a>
                    <span class="rc-policy-breadcrumb-sep">&gt;</span>
                    <span class="rc-policy-breadcrumb-current">Privacy Policy</span>
                </nav>

                <!-- Heading with Subtle Outlined Heart -->
                <div class="rc-policy-heading-row">
                    <h1 class="rc-policy-hero-title">Privacy Policy</h1>
                    <svg class="rc-policy-heart-icon" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                    </svg>
                </div>

                <!-- Description -->
                <p class="rc-policy-hero-desc">
                    Your trust means a lot to us. At Ruchi Chocolates, we are committed to keeping your personal information safe, secure and confidential.
                </p>
            </div>

            <!-- Right Column: Blended Chocolate Box Photo -->
            <div class="rc-policy-hero-media">
                <div class="rc-policy-hero-img-wrap">
                    <img 
                        src="{{ asset('images/privacy-hero-box.jpg') }}" 
                        alt="Ruchi Chocolates luxury artisan gift box with satin ribbon" 
                        class="rc-policy-hero-img"
                        loading="eager"
                        width="1376"
                        height="768"
                    >
                    <div class="rc-policy-hero-blend" aria-hidden="true"></div>
                </div>
            </div>

        </div>
    </section>

    {{-- =========================================================================
         CONTENT SECTION: 7 Vertically Stacked Policy Cards + Botanical Details
         ========================================================================= --}}
    <section class="rc-policy-cards-section" aria-label="Privacy Policy Sections">
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

                {{-- CARD 1: Information We Collect --}}
                <article class="rc-policy-card">
                    <div class="rc-policy-card__icon-wrap" aria-hidden="true">
                        <!-- User / Contact Info Icon -->
                        <svg class="rc-policy-card__icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <circle cx="18" cy="11" r="3"></circle>
                            <path d="M20.2 13.2L22 15"></path>
                        </svg>
                    </div>
                    <div class="rc-policy-card__content">
                        <h2 class="rc-policy-card__title">1. Information We Collect</h2>
                        <p class="rc-policy-card__text">
                            We may collect the following information when you use our website, contact us, or enquire about our products:
                        </p>
                        <ul class="rc-policy-card__list">
                            <li class="rc-policy-card__item">Name</li>
                            <li class="rc-policy-card__item">Mobile Number</li>
                            <li class="rc-policy-card__item">Email Address</li>
                            <li class="rc-policy-card__item">Pickup or contact details (if shared for enquiries)</li>
                            <li class="rc-policy-card__item">Any other information you provide through our contact form, WhatsApp, email or calls</li>
                        </ul>
                    </div>
                </article>

                {{-- CARD 2: How We Use Your Information --}}
                <article class="rc-policy-card">
                    <div class="rc-policy-card__icon-wrap" aria-hidden="true">
                        <!-- Settings / Gear Icon -->
                        <svg class="rc-policy-card__icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                        </svg>
                    </div>
                    <div class="rc-policy-card__content">
                        <h2 class="rc-policy-card__title">2. How We Use Your Information</h2>
                        <p class="rc-policy-card__text">
                            We use your information to:
                        </p>
                        <ul class="rc-policy-card__list">
                            <li class="rc-policy-card__item">Respond to your enquiries about chocolates, gift hampers and customised gifts</li>
                            <li class="rc-policy-card__item">Provide customer support</li>
                            <li class="rc-policy-card__item">Share product updates, new arrivals and special offers (only if you have opted in)</li>
                            <li class="rc-policy-card__item">Improve our website, products and services</li>
                            <li class="rc-policy-card__item">Keep a record of our communication with you</li>
                        </ul>
                    </div>
                </article>

                {{-- CARD 3: Sharing of Information --}}
                <article class="rc-policy-card">
                    <div class="rc-policy-card__icon-wrap" aria-hidden="true">
                        <!-- Connected Users / People Icon -->
                        <svg class="rc-policy-card__icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <div class="rc-policy-card__content">
                        <h2 class="rc-policy-card__title">3. Sharing of Information</h2>
                        <p class="rc-policy-card__text">
                            We do not sell, trade or rent your personal information to third parties. We may share your information only with trusted service providers who help us operate our website and communicate with you, such as:
                        </p>
                        <ul class="rc-policy-card__list">
                            <li class="rc-policy-card__item">WhatsApp and email service providers (for responding to enquiries)</li>
                            <li class="rc-policy-card__item">Website hosting and analytics providers (to understand website usage)</li>
                            <li class="rc-policy-card__item">We do not share your details with delivery or courier partners — shop pickup only</li>
                        </ul>
                        <p class="rc-policy-card__text">
                            These partners are required to keep your information confidential and use it only for the purpose of providing their services to us.
                        </p>
                    </div>
                </article>

                {{-- CARD 4: Data Protection --}}
                <article class="rc-policy-card">
                    <div class="rc-policy-card__icon-wrap" aria-hidden="true">
                        <!-- Shield Security Icon -->
                        <svg class="rc-policy-card__icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            <path d="M9 12l2 2 4-4"></path>
                        </svg>
                    </div>
                    <div class="rc-policy-card__content">
                        <h2 class="rc-policy-card__title">4. Data Protection</h2>
                        <p class="rc-policy-card__text">
                            We take reasonable security measures to protect your personal information from unauthorised access, misuse, alteration or disclosure. While we strive to keep your information safe, no method of transmission over the internet is 100% secure.
                        </p>
                    </div>
                </article>

                {{-- CARD 5: Your Choices --}}
                <article class="rc-policy-card">
                    <div class="rc-policy-card__icon-wrap" aria-hidden="true">
                        <!-- Sliders / Preferences Icon -->
                        <svg class="rc-policy-card__icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <line x1="4" y1="21" x2="4" y2="14"></line>
                            <line x1="4" y1="10" x2="4" y2="3"></line>
                            <line x1="12" y1="21" x2="12" y2="12"></line>
                            <line x1="12" y1="8" x2="12" y2="3"></line>
                            <line x1="20" y1="21" x2="20" y2="16"></line>
                            <line x1="20" y1="12" x2="20" y2="3"></line>
                            <line x1="1" y1="14" x2="7" y2="14"></line>
                            <line x1="9" y1="8" x2="15" y2="8"></line>
                            <line x1="17" y1="16" x2="23" y2="16"></line>
                        </svg>
                    </div>
                    <div class="rc-policy-card__content">
                        <h2 class="rc-policy-card__title">5. Your Choices</h2>
                        <p class="rc-policy-card__text">
                            You can choose not to receive promotional messages from us at any time by informing us via email or WhatsApp.
                        </p>
                    </div>
                </article>

                {{-- CARD 6: Updates to This Policy --}}
                <article class="rc-policy-card">
                    <div class="rc-policy-card__icon-wrap" aria-hidden="true">
                        <!-- Document Edit Icon -->
                        <svg class="rc-policy-card__icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                    </div>
                    <div class="rc-policy-card__content">
                        <h2 class="rc-policy-card__title">6. Updates to This Policy</h2>
                        <p class="rc-policy-card__text">
                            We may update this Privacy Policy from time to time. Any changes will be posted on this page with the updated date.
                        </p>
                    </div>
                </article>

                {{-- CARD 7: Contact Us --}}
                <article class="rc-policy-card rc-policy-card--contact">
                    <div class="rc-policy-card__icon-wrap" aria-hidden="true">
                        <!-- Headset / Customer Support Icon -->
                        <svg class="rc-policy-card__icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                            <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path>
                        </svg>
                    </div>
                    <div class="rc-policy-card__content">
                        <h2 class="rc-policy-card__title">7. Contact Us</h2>
                        <p class="rc-policy-card__text">
                            If you have any questions about our Privacy Policy or how we handle your information, please contact us:
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
                                href="{{ config('ruchi.whatsapp_url') }}?text=Hi%20Ruchi%20Chocolates%2C%20I%20have%20a%20question%20about%20your%20Privacy%20Policy." 
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

                    <!-- Chocolate Stack Illustration Near Bottom Right of Card 7 -->
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

@push('schema')
<script type="application/ld+json">
@php
    $privacyBreadcrumb = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Home',
                'item' => rtrim(config('ruchi.canonical_base_url'), '/') . '/',
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => 'Privacy Policy',
                'item' => rtrim(config('ruchi.canonical_base_url'), '/') . '/privacy-policy',
            ],
        ],
    ];
@endphp
{!! json_encode($privacyBreadcrumb, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endpush

