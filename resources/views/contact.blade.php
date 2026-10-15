@extends('layouts.app')

@section('content')
<div class="rc-contact-page-wrapper">
    <div class="rc-contact-container">
        
        <!-- Two-Column Main Layout: Form (Left) & Contact Info (Right) -->
        <div class="rc-contact-grid">
            
            <!-- =================================================================
                 LEFT COLUMN: "Send Us a Message" Contact Form Card
                 ================================================================= -->
            <div class="rc-contact-form-col">
                <div class="rc-contact-card rc-contact-form-card">
                    
                    <!-- Card Header -->
                    <div class="rc-contact-header">
                        <h1 class="rc-contact-main-title">Send Us a Message</h1>
                        
                        <!-- Decorative Heart Divider -->
                        <div class="rc-contact-divider" aria-hidden="true">
                            <span class="rc-contact-divider-line"></span>
                            <span class="rc-contact-divider-heart">♥</span>
                            <span class="rc-contact-divider-line"></span>
                        </div>
                        
                        <p class="rc-contact-subtitle">
                            Fill out the form and we'll get back to you as soon as possible.
                        </p>
                    </div>

                    <!-- Session Success / Validation Alerts -->
                    @if(session('success'))
                        <div class="rc-contact-alert rc-contact-alert--success" role="alert">
                            <svg class="rc-alert-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2E7D32" stroke-width="2">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="rc-contact-alert rc-contact-alert--danger" role="alert">
                            <svg class="rc-alert-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#C62828" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Contact Form -->
                    <form action="{{ route('contact.submit') }}" method="POST" class="rc-contact-form" novalidate>
                        @csrf
                        
                        <!-- Row 1: Name & Email -->
                        <div class="rc-form-row">
                            <!-- Name -->
                            <div class="rc-form-group">
                                <label for="contact_name" class="rc-form-label">Your Name <span class="rc-form-required">*</span></label>
                                <div class="rc-input-wrap">
                                    <span class="rc-input-icon" aria-hidden="true">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                    </span>
                                    <input 
                                        type="text" 
                                        id="contact_name" 
                                        name="name" 
                                        value="{{ old('name') }}" 
                                        class="rc-form-input {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                                        placeholder="Enter your full name" 
                                        required
                                    >
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="rc-form-group">
                                <label for="contact_email" class="rc-form-label">Email Address <span class="rc-form-required">*</span></label>
                                <div class="rc-input-wrap">
                                    <span class="rc-input-icon" aria-hidden="true">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                            <polyline points="22,6 12,13 2,6"></polyline>
                                        </svg>
                                    </span>
                                    <input 
                                        type="email" 
                                        id="contact_email" 
                                        name="email" 
                                        value="{{ old('email') }}" 
                                        class="rc-form-input {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                                        placeholder="Enter your email address" 
                                        required
                                    >
                                </div>
                            </div>
                        </div>

                        <!-- Row 2: Phone & Subject -->
                        <div class="rc-form-row">
                            <!-- Phone -->
                            <div class="rc-form-group">
                                <label for="contact_phone" class="rc-form-label">Phone Number</label>
                                <div class="rc-input-wrap">
                                    <span class="rc-input-icon" aria-hidden="true">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                        </svg>
                                    </span>
                                    <input 
                                        type="tel" 
                                        id="contact_phone" 
                                        name="phone" 
                                        value="{{ old('phone') }}" 
                                        class="rc-form-input" 
                                        placeholder="{{ config('ruchi.phone_display') }}"
                                    >
                                </div>
                            </div>

                            <!-- Subject -->
                            <div class="rc-form-group">
                                <label for="contact_subject" class="rc-form-label">Subject <span class="rc-form-required">*</span></label>
                                <div class="rc-input-wrap">
                                    <span class="rc-input-icon" aria-hidden="true">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                            <polyline points="14 2 14 8 20 8"></polyline>
                                            <line x1="16" y1="13" x2="8" y2="13"></line>
                                            <line x1="16" y1="17" x2="8" y2="17"></line>
                                            <polyline points="10 9 9 9 8 9"></polyline>
                                        </svg>
                                    </span>
                                    <input 
                                        type="text" 
                                        id="contact_subject" 
                                        name="subject" 
                                        value="{{ old('subject') }}" 
                                        class="rc-form-input {{ $errors->has('subject') ? 'is-invalid' : '' }}" 
                                        placeholder="e.g. Custom Hamper Inquiry" 
                                        required
                                    >
                                </div>
                            </div>
                        </div>

                        <!-- Row 3: Full Width Message Textarea -->
                        <div class="rc-form-group rc-form-group--full">
                            <label for="contact_message" class="rc-form-label">Your Message <span class="rc-form-required">*</span></label>
                            <div class="rc-input-wrap rc-input-wrap--textarea">
                                <span class="rc-input-icon rc-input-icon--top" aria-hidden="true">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                </span>
                                <textarea 
                                    id="contact_message" 
                                    name="message" 
                                    rows="4" 
                                    class="rc-form-textarea {{ $errors->has('message') ? 'is-invalid' : '' }}" 
                                    placeholder="Write your message here... tell us about your occasion, gift requirements or questions!" 
                                    required
                                >{{ old('message') }}</textarea>
                            </div>
                        </div>

                        <!-- Form Actions: Send Message Button & Safe Reassurance -->
                        <div class="rc-form-actions">
                            <button type="submit" class="rc-contact-submit-btn">
                                <span class="rc-submit-arrow" aria-hidden="true">➤</span>
                                <span>Send Message</span>
                            </button>

                            <!-- Security Reassurance -->
                            <div class="rc-form-security-note">
                                <svg class="rc-security-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2E7D32" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                    <polyline points="9 12 11 14 15 10"></polyline>
                                </svg>
                                <span>Your information is safe with us and will never be shared.</span>
                            </div>
                        </div>

                    </form>

                    <!-- Flower Decoration (Bottom-Right Corner Inside Form Card) -->
                    <div class="rc-form-flower-decor" aria-hidden="true">
                        <svg width="84" height="84" viewBox="0 0 100 100" fill="none">
                            <path d="M50 20C55 35 70 40 85 40C70 55 70 70 85 85C70 75 55 85 50 100C45 85 30 75 15 85C30 70 30 55 15 40C30 40 45 35 50 20Z" fill="#FCE8EC" stroke="#F5B7C4" stroke-width="1.2"/>
                            <circle cx="50" cy="60" r="14" fill="#FAD0DB" stroke="#E89CAE" stroke-width="1"/>
                            <circle cx="50" cy="60" r="6" fill="#FFE5B4"/>
                        </svg>
                    </div>

                </div>
            </div>

            <!-- =================================================================
                 RIGHT COLUMN: "Get in Touch" Information & Social Cards
                 ================================================================= -->
            <div class="rc-contact-info-col">
                
                <!-- Section Header -->
                <div class="rc-contact-header rc-contact-header--info">
                    <h2 class="rc-contact-main-title">Get in Touch</h2>
                    
                    <div class="rc-contact-divider" aria-hidden="true">
                        <span class="rc-contact-divider-line"></span>
                        <span class="rc-contact-divider-heart">♥</span>
                        <span class="rc-contact-divider-line"></span>
                    </div>
                    
                    <p class="rc-contact-subtitle">
                        We're here to help! Reach out to us through any of the following channels.
                    </p>
                </div>

                <!-- 4 Contact Cards (2x2 Grid) -->
                <div class="rc-info-cards-grid">
                    
                    <!-- CARD 1: OUR ADDRESS -->
                    <div class="rc-info-card">
                        <div class="rc-info-card-header">
                            <div class="rc-info-icon-circle">
                                <!-- Location Pin Icon -->
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#451A05" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                            </div>
                            <h3 class="rc-info-card-title">Our Address</h3>
                        </div>
                        <p class="rc-info-card-text">
                            {{ config('ruchi.address') }}
                        </p>
                    </div>

                    <!-- CARD 2: CALL US -->
                    <div class="rc-info-card">
                        <div class="rc-info-card-header">
                            <div class="rc-info-icon-circle">
                                <!-- Phone Icon -->
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#451A05" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                            </div>
                            <h3 class="rc-info-card-title">Call Us</h3>
                        </div>
                        <p class="rc-info-card-text">
                            <a href="{{ config('ruchi.tel_url') }}" class="rc-info-link">{{ config('ruchi.phone_display') }}</a>
                        </p>
                        <div class="rc-info-card-subtext">
                            <span>Mon - Sat: 9:00 AM - 9:00 PM</span><br>
                            <span>Sun: 10:00 AM - 6:00 PM</span>
                        </div>
                    </div>

                    <!-- CARD 3: EMAIL US -->
                    <div class="rc-info-card">
                        <div class="rc-info-card-header">
                            <div class="rc-info-icon-circle">
                                <!-- Email Icon with small pink decorative dot -->
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#451A05" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                                <span class="rc-info-dot" aria-hidden="true"></span>
                            </div>
                            <h3 class="rc-info-card-title">Email Us</h3>
                        </div>
                        <p class="rc-info-card-text">
                            <a href="mailto:{{ config('ruchi.email') }}" class="rc-info-link">{{ config('ruchi.email') }}</a>
                        </p>
                        <div class="rc-info-card-subtext">
                            <span>We reply within 24 hours</span>
                        </div>
                    </div>

                    <!-- CARD 4: BUSINESS HOURS -->
                    <div class="rc-info-card">
                        <div class="rc-info-card-header">
                            <div class="rc-info-icon-circle">
                                <!-- Clock Icon -->
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#451A05" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                            </div>
                            <h3 class="rc-info-card-title">Business Hours</h3>
                        </div>
                        <div class="rc-info-card-text rc-info-card-text--hours">
                            <span>Mon - Sat: 9:00 AM - 9:00 PM</span><br>
                            <span>Sun: 10:00 AM - 6:00 PM</span>
                        </div>
                    </div>

                </div>

                <!-- CARD 5: FOLLOW US & STAY UPDATED -->
                <div class="rc-contact-card rc-follow-card">
                    <h3 class="rc-follow-title">Follow Us &amp; Stay Updated</h3>
                    <p class="rc-follow-subtitle">
                        Stay connected for new arrivals, offers &amp; sweet surprises!
                    </p>

                    <!-- Circular Social Buttons -->
                    <div class="rc-social-icons-wrap" aria-label="Social media channels">
                        <!-- Instagram -->
                        <a href="{{ config('ruchi.instagram_url') }}" target="_blank" rel="noopener noreferrer" class="rc-social-btn" aria-label="Instagram">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                        </a>

                        <!-- Facebook -->
                        <a href="{{ config('ruchi.facebook_url') }}" target="_blank" rel="noopener noreferrer" class="rc-social-btn" aria-label="Facebook">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                            </svg>
                        </a>

                        <!-- WhatsApp -->
                        <a href="{{ config('ruchi.whatsapp_url') }}?text=Hi%20Ruchi%20Chocolates" target="_blank" rel="noopener noreferrer" class="rc-social-btn" aria-label="WhatsApp">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2zm5.79 14.07c-.24.67-1.39 1.28-1.92 1.36-.5.08-1.14.12-3.37-.8-2.67-1.11-4.38-3.83-4.51-4.01-.13-.18-1.07-1.42-1.07-2.71 0-1.29.68-1.92.92-2.18.24-.26.53-.33.71-.33.18 0 .36.002.51.01.16.01.38-.06.59.45.24.57.81 1.97.88 2.11.07.15.12.32.02.51-.1.2-.15.32-.3.49-.15.17-.31.39-.45.52-.15.15-.31.31-.13.62.18.31.8 1.31 1.71 2.12 1.17 1.04 2.16 1.36 2.47 1.51.31.15.49.13.67-.08.18-.21.78-.91.99-1.22.21-.31.42-.26.71-.15.29.11 1.83.86 2.15 1.02.32.16.53.24.61.37.08.14.08.79-.16 1.46z"/>
                            </svg>
                        </a>

                        <!-- Pinterest -->
                        <a href="https://pinterest.com/ruchichocolate" target="_blank" rel="noopener noreferrer" class="rc-social-btn" aria-label="Pinterest">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 0a12 12 0 0 0-4.37 23.18c-.03-.98-.05-2.5.05-3.58l.75-3.17s-.19-.38-.19-.94c0-.88.51-1.54 1.15-1.54.54 0 .8.41.8.9 0 .55-.35 1.36-.53 2.12-.15.64.32 1.15.95 1.15 1.14 0 2.02-1.2 2.02-2.94 0-1.54-1.1-2.61-2.68-2.61-1.83 0-2.9 1.37-2.9 2.78 0 .55.21 1.14.48 1.46.05.06.06.12.04.18l-.18.73c-.03.11-.1.14-.22.09-.81-.38-1.32-1.56-1.32-2.51 0-2.04 1.49-3.92 4.28-3.92 2.25 0 4 1.6 4 3.75 0 2.24-1.41 4.04-3.37 4.04-.66 0-1.28-.34-1.49-.75l-.41 1.55c-.15.57-.55 1.28-.82 1.72A11.96 11.96 0 0 0 12 24c6.63 0 12-5.37 12-12S18.63 0 12 0z"/>
                            </svg>
                        </a>

                        <!-- YouTube -->
                        <a href="https://youtube.com/ruchichocolate" target="_blank" rel="noopener noreferrer" class="rc-social-btn" aria-label="YouTube">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path>
                                <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon>
                            </svg>
                        </a>
                    </div>

                    <!-- Subtle Decorative Gift Box Outline in Bottom-Right -->
                    <div class="rc-follow-gift-decor" aria-hidden="true">
                        <svg width="72" height="72" viewBox="0 0 24 24" fill="none" stroke="#451A05" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 12 20 22 4 22 4 12"></polyline>
                            <rect x="2" y="7" width="20" height="5"></rect>
                            <line x1="12" y1="22" x2="12" y2="7"></line>
                            <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path>
                            <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path>
                        </svg>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- =================================================================
         FULL-WIDTH MAP SECTION: Ahmedabad Location & Information Card
         ================================================================= -->
    <div class="rc-contact-map-section">
        <div class="rc-contact-map-container">
            <div class="rc-contact-map-wrapper">
                <!-- Google Maps Embed centered around Paldi, Ahmedabad -->
                <iframe
                    class="rc-contact-map-iframe"
                    src="{{ config('ruchi.maps_embed_url') }}"
                    loading="lazy"
                    allowfullscreen
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Ruchi Chocolate Paldi Ahmedabad Location Map">
                </iframe>

                <!-- Centered Location Information Card Overlay -->
                <div class="rc-contact-map-card">
                    <div class="rc-map-card-header">
                        <div class="rc-map-icon-box" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#451A05" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        </div>
                        <h3 class="rc-map-card-title">Ruchi Chocolate</h3>
                    </div>
                    <p class="rc-map-card-address">
                        {{ config('ruchi.address') }}
                    </p>
                    <a href="{{ config('ruchi.maps_search_url') }}" target="_blank" rel="noopener noreferrer" class="rc-map-card-link">
                        <span>View on Google Maps</span>
                        <span class="rc-map-card-arrow" aria-hidden="true">→</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- =================================================================
         FAQ SECTION: Frequently Asked Questions & Accordion
         ================================================================= -->
    @include('components.home.faq')

    <!-- Floating WhatsApp Action Button -->
    @include('components.home.whatsapp-button')
</div>
@endsection


