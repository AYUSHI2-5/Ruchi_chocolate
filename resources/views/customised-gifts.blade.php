@extends('layouts.app')

@section('title', 'Customised Gifts — Ruchi Chocolates | Handcrafted with Love')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/customised-gifts.css') }}">
@endpush

@section('content')
<div class="rc-customised-page">

    {{-- =========================================================================
         SECTION 1: HERO SECTION (3 Visual Areas: Content - Form Card - Hamper Media)
         ========================================================================= --}}
    <section class="rc-custom-hero-section" aria-label="Customised Gifts Hero">
        <div class="rc-custom-hero-container">

            <!-- Area 1: Left Side — Breadcrumb & Content -->
            <div class="rc-custom-hero-left">
                <!-- Breadcrumb -->
                <nav class="rc-custom-breadcrumb" aria-label="Breadcrumb">
                    <a href="{{ route('home') }}" class="rc-custom-breadcrumb-link">Home</a>
                    <span class="rc-custom-breadcrumb-sep">&gt;</span>
                    <span class="rc-custom-breadcrumb-current">Customised Gifts</span>
                </nav>

                <!-- Heading with Outlined Heart Accent -->
                <div class="rc-custom-hero-heading-wrap">
                    <h1 class="rc-custom-hero-title">
                        <span class="rc-custom-title-serif">Customise Your</span>
                        <span class="rc-custom-title-script">Perfect Gift</span>
                    </h1>
                    <svg class="rc-custom-title-heart" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                    </svg>
                </div>

                <!-- Description Paragraph -->
                <p class="rc-custom-hero-desc">
                    Make your moments extra special with personalised chocolates, hampers and gifts. Share your ideas with us and we’ll create something unique, just for you.
                </p>

                <!-- Subtle Botanical Line-Art SVG Decoration -->
                <svg class="rc-custom-botanical-bg" viewBox="0 0 100 160" fill="none" stroke="#dcb4a8" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M10,150 C25,100 40,60 85,15"></path>
                    <path d="M30,120 C45,115 55,125 45,135 C38,140 30,130 30,120 Z"></path>
                    <path d="M48,90 C60,80 72,90 65,100 C58,107 50,97 48,90 Z"></path>
                    <path d="M65,50 C78,40 90,47 82,60 C75,67 66,57 65,50 Z"></path>
                </svg>
            </div>

            <!-- Area 2: Center — Customisation Enquiry Form Card -->
            <div class="rc-custom-hero-center">
                <div class="rc-custom-form-card">
                    <span class="rc-custom-form-badge">Bespoke Creations</span>
                    <h2 class="rc-custom-form-title">Share Your Customisation Details</h2>
                    <p class="rc-custom-form-sub">
                        Tell us what you have in mind. You can include text, theme, colours, flavours, occasion or any special requests.
                    </p>

                    <form id="customisation-form" onsubmit="event.preventDefault(); submitCustomisationWhatsApp();">
                        <textarea 
                            id="customisation-details"
                            class="rc-custom-textarea" 
                            rows="4" 
                            placeholder="Type your customisation details here..." 
                            aria-label="Customisation requirements and details"
                        ></textarea>

                        <button 
                            type="submit" 
                            class="rc-custom-enquire-btn"
                            id="btn-enquire-whatsapp"
                        >
                            <svg class="rc-custom-wa-icon" viewBox="0 0 24 24">
                                <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2zm5.79 14.07c-.24.67-1.39 1.28-1.92 1.36-.5.08-1.14.12-3.37-.8-2.67-1.11-4.38-3.83-4.51-4.01-.13-.18-1.07-1.42-1.07-2.71 0-1.29.68-1.92.92-2.18.24-.26.53-.33.71-.33.18 0 .36.002.51.01.16.01.38-.06.59.45.24.57.81 1.97.88 2.11.07.15.12.32.02.51-.1.2-.15.32-.3.49-.15.17-.31.39-.45.52-.15.15-.31.31-.13.62.18.31.8 1.31 1.71 2.12 1.17 1.04 2.16 1.36 2.47 1.51.31.15.49.13.67-.08.18-.21.78-.91.99-1.22.21-.31.42-.26.71-.15.29.11 1.83.86 2.15 1.02.32.16.53.24.61.37.08.14.08.79-.16 1.46z"/>
                            </svg>
                            <span>Enquire on WhatsApp</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Area 3: Right Side — Realistic Hamper Image with Soft Natural Blend -->
            <div class="rc-custom-hero-right">
                <div class="rc-custom-hero-media-wrap">
                    <img 
                        src="{{ asset('images/custom-gifts/hero-hamper.jpg') }}" 
                        alt="Ruchi Chocolates bespoke open gift hamper with assorted chocolates and pink satin ribbon" 
                        class="rc-custom-hero-media-img"
                        loading="eager"
                    >
                    <div class="rc-custom-hero-media-blend" aria-hidden="true"></div>
                </div>
            </div>

        </div>
    </section>

    {{-- =========================================================================
         SECTION 2: PRODUCT PHOTOS (5 Attractive Product Photographs in Gallery)
         ========================================================================= --}}
    <section class="rc-custom-gallery-section" aria-label="Customised Gift Photos">
        <div class="rc-custom-gallery-container">

            <!-- Section Heading & Subtitle with Gold Heart Divider -->
            <div class="rc-custom-gallery-header">
                <div class="rc-custom-gallery-divider" aria-hidden="true">
                    <span class="rc-custom-divider-line"></span>
                    <span class="rc-custom-divider-heart">♥</span>
                    <span class="rc-custom-divider-line"></span>
                </div>
                <h2 class="rc-custom-gallery-title">Product Photos</h2>
                <p class="rc-custom-gallery-sub">Take a look at some of our customised creations.</p>
            </div>

            <div class="rc-custom-gallery-wrapper">
                <div class="rc-custom-gallery-track" id="custom-gallery-track">

                    <!-- Photo 1: Personalised Birthday Chocolate Box -->
                    <article class="rc-custom-gallery-card">
                        <div class="rc-custom-card-media">
                            <img 
                                src="{{ asset('images/custom-gifts/gallery-birthday-box.jpg') }}" 
                                alt="Personalised birthday chocolate box with customised message and artisan truffles" 
                                class="rc-custom-card-img"
                                loading="lazy"
                            >
                            <div class="rc-custom-card-overlay">
                                <button type="button" class="rc-custom-card-btn" onclick="populateEnquiry('Personalised Birthday Chocolate Box')">Enquire This</button>
                            </div>
                        </div>
                        <div class="rc-custom-card-info">
                            <h3 class="rc-custom-card-title">Personalised Birthday Box</h3>
                            <p class="rc-custom-card-desc">Custom names, wishes &amp; handcrafted assorted flavours</p>
                        </div>
                    </article>

                    <!-- Photo 2: Heart-shaped Chocolate Gift Box -->
                    <article class="rc-custom-gallery-card">
                        <div class="rc-custom-card-media">
                            <img 
                                src="{{ asset('images/custom-gifts/gallery-heart-box.jpg') }}" 
                                alt="Romantic heart-shaped chocolate gift box with red rose embellishment and wrapped chocolates" 
                                class="rc-custom-card-img"
                                loading="lazy"
                            >
                            <div class="rc-custom-card-overlay">
                                <button type="button" class="rc-custom-card-btn" onclick="populateEnquiry('Heart-shaped Chocolate Gift Box')">Enquire This</button>
                            </div>
                        </div>
                        <div class="rc-custom-card-info">
                            <h3 class="rc-custom-card-title">Heart Chocolate Box</h3>
                            <p class="rc-custom-card-desc">Romantic rose floral accents &amp; rich assorted truffles</p>
                        </div>
                    </article>

                    <!-- Photo 3: Chocolate Bouquet with Pink Wrapping -->
                    <article class="rc-custom-gallery-card">
                        <div class="rc-custom-card-media">
                            <img 
                                src="{{ asset('images/custom-gifts/gallery-pink-bouquet.jpg') }}" 
                                alt="Handcrafted luxury chocolate bouquet with pastel pink wrapping and roses" 
                                class="rc-custom-card-img"
                                loading="lazy"
                            >
                            <div class="rc-custom-card-overlay">
                                <button type="button" class="rc-custom-card-btn" onclick="populateEnquiry('Chocolate Bouquet with Pink Wrapping')">Enquire This</button>
                            </div>
                        </div>
                        <div class="rc-custom-card-info">
                            <h3 class="rc-custom-card-title">Pink Chocolate Bouquet</h3>
                            <p class="rc-custom-card-desc">Elegant blush-pink wrapping, satin bow &amp; sweet roses</p>
                        </div>
                    </article>

                    <!-- Photo 4: Premium Customised Chocolate Hamper -->
                    <article class="rc-custom-gallery-card">
                        <div class="rc-custom-card-media">
                            <img 
                                src="{{ asset('images/custom-gifts/gallery-custom-hamper.jpg') }}" 
                                alt="Curated premium chocolate gift hamper with gold ribbon and Ruchi signature chocolates" 
                                class="rc-custom-card-img"
                                loading="lazy"
                            >
                            <div class="rc-custom-card-overlay">
                                <button type="button" class="rc-custom-card-btn" onclick="populateEnquiry('Premium Customised Chocolate Hamper')">Enquire This</button>
                            </div>
                        </div>
                        <div class="rc-custom-card-info">
                            <h3 class="rc-custom-card-title">Luxury Gift Hamper</h3>
                            <p class="rc-custom-card-desc">Grand gift box with gold ribbon, truffles &amp; bars</p>
                        </div>
                    </article>

                    <!-- Photo 5: Personalised Chocolate Box with Decorative Lettering -->
                    <article class="rc-custom-gallery-card">
                        <div class="rc-custom-card-media">
                            <img 
                                src="{{ asset('images/custom-gifts/gallery-lettering-box.jpg') }}" 
                                alt="Bespoke personalised chocolate box with decorative edible golden lettering" 
                                class="rc-custom-card-img"
                                loading="lazy"
                            >
                            <div class="rc-custom-card-overlay">
                                <button type="button" class="rc-custom-card-btn" onclick="populateEnquiry('Personalised Lettering Chocolate Box')">Enquire This</button>
                            </div>
                        </div>
                        <div class="rc-custom-card-info">
                            <h3 class="rc-custom-card-title">Lettering Chocolate Box</h3>
                            <p class="rc-custom-card-desc">Edible gold letters spelling names or celebratory wishes</p>
                        </div>
                    </article>

                </div>
            </div>

        </div>
    </section>

</div>
@endsection

@push('scripts')
<script>
    /**
     * Submit customer's customisation enquiry to WhatsApp
     */
    function submitCustomisationWhatsApp() {
        var textarea = document.getElementById('customisation-details');
        if (!textarea) return;

        var text = textarea.value.trim();
        if (!text) {
            alert('Please type your customisation requirements before proceeding to WhatsApp.');
            textarea.focus();
            return;
        }

        var message = "Hi Ruchi Chocolates, I would like to enquire about a customised gift:\n\n" + text;
        var encoded = encodeURIComponent(message);
        window.open("https://wa.me/917490828282?text=" + encoded, "_blank");
    }

    /**
     * Helper to populate form and scroll to enquiry box from photo clicks
     */
    function populateEnquiry(productName) {
        var textarea = document.getElementById('customisation-details');
        if (textarea) {
            var current = textarea.value.trim();
            if (current) {
                textarea.value = current + "\n- Interested in: " + productName;
            } else {
                textarea.value = "Hi, I am interested in customising: " + productName + ". Please let me know the options available.";
            }
            textarea.scrollIntoView({ behavior: 'smooth', block: 'center' });
            textarea.focus();
        }
    }

</script>
@endpush
