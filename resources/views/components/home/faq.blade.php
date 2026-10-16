{{-- Section 9: Frequently Asked Questions (FAQ) Section --}}
<section class="rc-faq-section" id="rcFaqSection" aria-label="Frequently Asked Questions">
    <div class="rc-faq-container">
        
        <!-- Header Section -->
        <div class="rc-faq-header">
            <!-- Top Badge: STILL HAVE QUESTIONS? with Decorative Flourishes -->
            <div class="rc-faq-badge">
                <svg class="rc-faq-badge-flourish" width="28" height="10" viewBox="0 0 28 10" fill="none" stroke="#E89CAE" stroke-width="1.4" stroke-linecap="round" aria-hidden="true">
                    <path d="M1 5C5 1 9 9 14 5C19 1 23 9 27 5"/>
                </svg>
                <span class="rc-faq-badge-text">STILL HAVE QUESTIONS?</span>
                <svg class="rc-faq-badge-flourish" width="28" height="10" viewBox="0 0 28 10" fill="none" stroke="#E89CAE" stroke-width="1.4" stroke-linecap="round" aria-hidden="true">
                    <path d="M1 5C5 1 9 9 14 5C19 1 23 9 27 5"/>
                </svg>
            </div>

            <!-- Main Heading -->
            <h2 class="rc-faq-title">Frequently Asked Questions</h2>

            <!-- Decorative Heart Divider -->
            <div class="rc-faq-divider" aria-hidden="true">
                <span class="rc-faq-divider-line"></span>
                <span class="rc-faq-divider-heart">♥</span>
                <span class="rc-faq-divider-line"></span>
            </div>
        </div>

        <!-- 2-Column FAQ Grid (4 Cards) -->
        <div class="rc-faq-grid" role="region" aria-label="FAQ Accordion">
            
            <!-- FAQ ITEM 1: Shop pickup -->
            <div class="rc-faq-item">
                <button type="button" class="rc-faq-btn" aria-expanded="false" aria-controls="faq-answer-1" id="faq-btn-1">
                    <div class="rc-faq-btn-left">
                        <div class="rc-faq-icon-box" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#451A05" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                        </div>
                        <span class="rc-faq-question">Do you offer home delivery?</span>
                    </div>
                    <svg class="rc-faq-chevron" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#451A05" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="rc-faq-answer" id="faq-answer-1" role="region" aria-labelledby="faq-btn-1">
                    <div class="rc-faq-answer-inner">
                        <p>{{ config('ruchi.shop_pickup_notice') }} Orders must be collected from our shop in Ahmedabad. Contact us on WhatsApp to confirm availability and arrange a pickup time.</p>
                    </div>
                </div>
            </div>

            <!-- FAQ ITEM 2: Customize Gift Hamper -->
            <div class="rc-faq-item">
                <button type="button" class="rc-faq-btn" aria-expanded="false" aria-controls="faq-answer-2" id="faq-btn-2">
                    <div class="rc-faq-btn-left">
                        <div class="rc-faq-icon-box" aria-hidden="true">
                            <!-- Gift Box Icon -->
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#451A05" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 12 20 22 4 22 4 12"></polyline>
                                <rect x="2" y="7" width="20" height="5"></rect>
                                <line x1="12" y1="22" x2="12" y2="7"></line>
                                <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path>
                                <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path>
                            </svg>
                        </div>
                        <span class="rc-faq-question">Can I customize a gift hamper?</span>
                    </div>
                    <svg class="rc-faq-chevron" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#451A05" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="rc-faq-answer" id="faq-answer-2" role="region" aria-labelledby="faq-btn-2">
                    <div class="rc-faq-answer-inner">
                        <p>Yes. You can customize selected hampers with chocolates, gifts, packaging and personalized details based on availability.</p>
                    </div>
                </div>
            </div>

            <!-- FAQ ITEM 3: Track Order -->
            <div class="rc-faq-item">
                <button type="button" class="rc-faq-btn" aria-expanded="false" aria-controls="faq-answer-3" id="faq-btn-3">
                    <div class="rc-faq-btn-left">
                        <div class="rc-faq-icon-box" aria-hidden="true">
                            <!-- Question Mark / Help Circle Icon -->
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#451A05" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                                <line x1="12" y1="17" x2="12.01" y2="17"></line>
                            </svg>
                        </div>
                        <span class="rc-faq-question">How will I know when my order is ready?</span>
                    </div>
                    <svg class="rc-faq-chevron" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#451A05" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="rc-faq-answer" id="faq-answer-3" role="region" aria-labelledby="faq-btn-3">
                    <div class="rc-faq-answer-inner">
                        <p>We confirm orders and share pickup-ready updates on WhatsApp using the contact details you provide. Message us with your order reference if you need a status update.</p>
                    </div>
                </div>
            </div>

            <!-- FAQ ITEM 4: Return or Refund Policy -->
            <div class="rc-faq-item">
                <button type="button" class="rc-faq-btn" aria-expanded="false" aria-controls="faq-answer-4" id="faq-btn-4">
                    <div class="rc-faq-btn-left">
                        <div class="rc-faq-icon-box" aria-hidden="true">
                            <!-- Shield / Check Icon -->
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#451A05" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                <polyline points="9 12 11 14 15 10"></polyline>
                            </svg>
                        </div>
                        <span class="rc-faq-question">What is your return or refund policy?</span>
                    </div>
                    <svg class="rc-faq-chevron" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#451A05" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="rc-faq-answer" id="faq-answer-4" role="region" aria-labelledby="faq-btn-4">
                    <div class="rc-faq-answer-inner">
                        <p>Please contact us as soon as possible if there is an issue with your order. Return or refund eligibility depends on the product and order condition.</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Bottom Heart & Flourish Decoration -->
        <div class="rc-faq-bottom-decor" aria-hidden="true">
            <svg class="rc-faq-bottom-svg" width="220" height="32" viewBox="0 0 220 32" fill="none">
                <path d="M10 16C40 16 65 24 90 16" stroke="#F0D0D8" stroke-width="1.2" stroke-linecap="round"/>
                <circle cx="10" cy="16" r="2.5" fill="#E89CAE"/>
                <path d="M45 16C60 10 75 22 90 16" stroke="#F5B7C4" stroke-width="1" stroke-dasharray="2 2"/>
                
                <!-- Two Overlapping Hearts -->
                <path d="M104 18.5C104 18.5 98 13.5 98 9.5C98 7.5 99.5 6 101.5 6C103 6 104 7 104 7C104 7 105 6 106.5 6C108.5 6 110 7.5 110 9.5C110 13.5 104 18.5 104 18.5Z" fill="#E89CAE"/>
                <path d="M116 21C116 21 108 14.5 108 9.5C108 7 110 5 112.5 5C114.2 5 115.5 6.2 116 7C116.5 6.2 117.8 5 119.5 5C122 5 124 7 124 9.5C124 14.5 116 21 116 21Z" fill="#451A05"/>
                
                <path d="M130 16C155 24 180 16 210 16" stroke="#F0D0D8" stroke-width="1.2" stroke-linecap="round"/>
                <circle cx="210" cy="16" r="2.5" fill="#E89CAE"/>
                <path d="M130 16C145 22 160 10 175 16" stroke="#F5B7C4" stroke-width="1" stroke-dasharray="2 2"/>
            </svg>
        </div>

    </div>
</section>
