@extends('layouts.app')

@section('content')
<div class="rc-about-page-wrapper">
    
    {{-- =========================================================================
         SECTION 1: OUR STORY / ABOUT (Exact Reference Recreation)
         ========================================================================= --}}
    <section class="rc-about-section" id="our-story-section" aria-label="About Ruchi Chocolate - Our Story">
        <div class="rc-about-container">
            
            <!-- Main Top Split: Story Text & Blended Hamper Image -->
            <div class="rc-about-hero-grid">
                
                <!-- Left Column: Story Text Content -->
                <div class="rc-about-text-col">
                    <!-- Breadcrumb -->
                    <nav class="rc-about-breadcrumb" aria-label="Breadcrumb">
                        <a href="{{ route('home') }}" class="rc-about-breadcrumb-link">Home</a>
                        <span class="rc-about-breadcrumb-sep">&gt;</span>
                        <span class="rc-about-breadcrumb-current">About Us</span>
                    </nav>

                    <!-- Eyebrow with gold heart between two thin lines -->
                    <div class="rc-about-eyebrow-row">
                        <span class="rc-about-eyebrow">OUR STORY</span>
                        <span class="rc-about-eyebrow-divider" aria-hidden="true">
                            <span class="rc-about-divider-line"></span>
                            <span class="rc-about-divider-heart">♥</span>
                            <span class="rc-about-divider-line"></span>
                        </span>
                    </div>

                    <!-- Main Heading -->
                    <h1 class="rc-about-main-heading">
                        <span class="rc-about-heading-serif">A Sweet Journey</span>
                        <span class="rc-about-heading-script">Since 2010</span>
                    </h1>

                    <!-- Introductory Description Paragraph -->
                    <p class="rc-about-intro-p">
                        From a small kitchen to countless celebrations, Ruchi Chocolates has been spreading happiness with handmade chocolates and thoughtful gifts for over a decade.
                    </p>
                </div>

                <!-- Right Column: Visual Image Blending Naturally into Background -->
                <div class="rc-about-media-col">
                    <div class="rc-about-image-wrapper">
                        <img src="{{ asset('images/about-hero-hamper.jpg') }}" alt="Ruchi Chocolates handmade chocolates and luxury gift hampers" class="rc-about-main-img" loading="eager">
                        <div class="rc-about-image-blend" aria-hidden="true"></div>
                    </div>
                </div>

            </div>

            <!-- Bottom Statistics Bar (Dark Chocolate Brown with Decorative Pattern & 4 Stats) -->
            <div class="rc-about-stats-bar" aria-label="Key Statistics and Milestones">
                <!-- Subtle Decorative Curved / Dashed Background Pattern -->
                <svg class="rc-about-stats-bg-pattern" aria-hidden="true" viewBox="0 0 1000 120" preserveAspectRatio="none">
                    <path d="M0,60 C250,110 450,10 700,70 C850,110 950,20 1000,60" fill="none" stroke="rgba(255,255,255,0.06)" stroke-width="2" stroke-dasharray="6,8"/>
                    <path d="M0,30 C300,90 500,20 800,90 C900,110 980,40 1000,30" fill="none" stroke="rgba(255,255,255,0.04)" stroke-width="1.5"/>
                </svg>

                <div class="rc-about-stats-grid">
                    
                    <!-- Stat 1: 50,000+ Happy Customers -->
                    <div class="rc-about-stat-item">
                        <div class="rc-about-stat-icon-wrap">
                            <svg class="rc-about-stat-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                        <div class="rc-about-stat-info">
                            <span class="rc-about-stat-num">50,000+</span>
                            <span class="rc-about-stat-label">Happy Customers</span>
                        </div>
                    </div>

                    <!-- Separator 1-2 -->
                    <div class="rc-about-stat-sep" aria-hidden="true"></div>

                    <!-- Stat 2: 10,000+ Hampers Delivered -->
                    <div class="rc-about-stat-item">
                        <div class="rc-about-stat-icon-wrap">
                            <svg class="rc-about-stat-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 12 20 22 4 22 4 12"></polyline>
                                <rect x="2" y="7" width="20" height="5"></rect>
                                <line x1="12" y1="22" x2="12" y2="7"></line>
                                <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path>
                                <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path>
                            </svg>
                        </div>
                        <div class="rc-about-stat-info">
                            <span class="rc-about-stat-num">10,000+</span>
                            <span class="rc-about-stat-label">Hampers Delivered</span>
                        </div>
                    </div>

                    <!-- Separator 2-3 -->
                    <div class="rc-about-stat-sep" aria-hidden="true"></div>

                    <!-- Stat 3: 4.8/5 Customer Rating -->
                    <div class="rc-about-stat-item">
                        <div class="rc-about-stat-icon-wrap">
                            <svg class="rc-about-stat-icon" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" stroke="none">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                        </div>
                        <div class="rc-about-stat-info">
                            <span class="rc-about-stat-num">4.8/5</span>
                            <span class="rc-about-stat-label">Customer Rating</span>
                        </div>
                    </div>

                    <!-- Separator 3-4 -->
                    <div class="rc-about-stat-sep" aria-hidden="true"></div>

                    <!-- Stat 4: 100% Made with Love -->
                    <div class="rc-about-stat-item">
                        <div class="rc-about-stat-icon-wrap">
                            <svg class="rc-about-stat-icon" width="24" height="24" viewBox="0 0 24 24" fill="#F5B7C4" stroke="none">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </div>
                        <div class="rc-about-stat-info">
                            <span class="rc-about-stat-num">100%</span>
                            <span class="rc-about-stat-label">Made with Love</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

    {{-- =========================================================================
         SECTION 2: WHY CHOOSE US (Exact Reference 2 Recreation - 5 Items)
         ========================================================================= --}}
    <section class="rc-about-why-section" id="why-choose-us-section" aria-label="Why Choose Ruchi Chocolate">
        <div class="rc-about-container">
            
            <!-- Section Heading with Decorative Wavy Lines -->
            <div class="rc-about-section-header">
                <div class="rc-about-wavy-heading-wrap">
                    <svg class="rc-wavy-accent" width="36" height="12" viewBox="0 0 36 12" fill="none" aria-hidden="true">
                        <path d="M2 6C6 2 10 10 14 6C18 2 22 10 26 6C30 2 34 10 34 6" stroke="#451A05" stroke-width="2.2" stroke-linecap="round"/>
                    </svg>
                    <h2 class="rc-about-wavy-title">WHY CHOOSE US</h2>
                    <svg class="rc-wavy-accent" width="36" height="12" viewBox="0 0 36 12" fill="none" aria-hidden="true">
                        <path d="M2 6C6 2 10 10 14 6C18 2 22 10 26 6C30 2 34 10 34 6" stroke="#451A05" stroke-width="2.2" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>

            <!-- 5 Columns Grid -->
            <div class="rc-why-grid">
                
                <!-- Item 1: Finest Ingredients -->
                <div class="rc-why-col">
                    <div class="rc-why-item">
                        <div class="rc-why-icon-circle rc-why-icon-circle--accent">
                            <!-- Cocoa Pod / Chocolate Icon -->
                            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#451A05" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L3 12.5V21h8.5z"></path>
                                <line x1="16" y1="8" x2="2" y2="22"></line>
                                <line x1="17.5" y1="15" x2="9" y2="15"></line>
                            </svg>
                        </div>
                        <h3 class="rc-why-item-title">Finest Ingredients</h3>
                        <p class="rc-why-item-desc">We use premium chocolate &amp; the finest ingredients.</p>
                    </div>
                </div>

                <!-- Item 2: Handcrafted with Love -->
                <div class="rc-why-col">
                    <div class="rc-why-item">
                        <div class="rc-why-icon-circle">
                            <!-- Hand holding heart / Handcrafted with Love Icon -->
                            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#451A05" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                            </svg>
                        </div>
                        <h3 class="rc-why-item-title">Handcrafted with Love</h3>
                        <p class="rc-why-item-desc">Each bouquet and hamper is handmade with creativity, care, and attention to detail.</p>
                    </div>
                </div>

                <!-- Item 3: Perfect for Every Occasion -->
                <div class="rc-why-col">
                    <div class="rc-why-item">
                        <div class="rc-why-icon-circle">
                            <!-- Shield / Sparkle / Badge Icon -->
                            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#451A05" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                <polyline points="9 12 11 14 15 10"></polyline>
                            </svg>
                        </div>
                        <h3 class="rc-why-item-title">Perfect for Every Occasion</h3>
                        <p class="rc-why-item-desc">Birthday gifts, anniversary surprises, wedding hampers, festive gifting, and more.</p>
                    </div>
                </div>

                <!-- Item 4: Beautiful Packaging -->
                <div class="rc-why-col">
                    <div class="rc-why-item">
                        <div class="rc-why-icon-circle">
                            <!-- Gift Box Icon -->
                            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#451A05" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 12 20 22 4 22 4 12"></polyline>
                                <rect x="2" y="7" width="20" height="5"></rect>
                                <line x1="12" y1="22" x2="12" y2="7"></line>
                                <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path>
                                <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path>
                            </svg>
                        </div>
                        <h3 class="rc-why-item-title">Beautiful Packaging</h3>
                        <p class="rc-why-item-desc">Elegant presentation and premium packaging that instantly attracts attention.</p>
                    </div>
                </div>

                <!-- Item 5: Trusted by Customers -->
                <div class="rc-why-col">
                    <div class="rc-why-item">
                        <div class="rc-why-icon-circle">
                            <!-- Customer Trust / Person with Heart Icon -->
                            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#451A05" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M19 11l2 2 4-4"></path>
                            </svg>
                        </div>
                        <h3 class="rc-why-item-title">Trusted by Customers</h3>
                        <p class="rc-why-item-desc">Loved by customers for our quality, creativity, and unique gifting experience.</p>
                    </div>
                </div>

            </div>

        </div>
    </section>

    {{-- =========================================================================
         SECTION 3: OUR PROCESS (Exact Reference 2 Recreation - 5 Steps Timeline)
         ========================================================================= --}}
    <section class="rc-about-process-section" id="our-process-section" aria-label="Our Chocolate Making Process">
        <div class="rc-about-container">
            
            <!-- Section Heading with Decorative Hearts & Underline -->
            <div class="rc-process-header">
                <h2 class="rc-process-sec-title">
                    <span class="rc-process-title-heart">♥</span>
                    <span>OUR PROCESS</span>
                    <span class="rc-process-title-heart">♥</span>
                </h2>
                <!-- Small Decorative Horizontal Line Under Heading -->
                <div class="rc-process-title-divider" aria-hidden="true"></div>
            </div>

            <!-- 5-Step Process Timeline -->
            <div class="rc-process-timeline">
                
                <!-- Curved / Wavy Connecting Line (Behind Icons) -->
                <div class="rc-process-line-wrap" aria-hidden="true">
                    <svg class="rc-process-wavy-line" viewBox="0 0 1000 60" preserveAspectRatio="none">
                        <path d="M50,30 Q160,5 275,30 T500,30 T725,30 T950,30" fill="none" stroke="#E6CECB" stroke-width="2" stroke-dasharray="5,6"/>
                    </svg>
                </div>

                <!-- 5 Steps Grid -->
                <div class="rc-process-grid">
                    
                    <!-- Step 1: Carefully Selected Products -->
                    <div class="rc-process-step">
                        <div class="rc-process-icon-wrap">
                            <div class="rc-process-icon-circle">
                                <!-- Cocoa Bean / Chocolate Selection Icon -->
                                <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#451A05" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L3 12.5V21h8.5z"></path>
                                    <line x1="16" y1="8" x2="2" y2="22"></line>
                                    <line x1="17.5" y1="15" x2="9" y2="15"></line>
                                </svg>
                            </div>
                            <!-- Numbered Badge Overlapping Bottom -->
                            <div class="rc-process-num-badge">1</div>
                        </div>
                        <h3 class="rc-process-step-title">Carefully Selected<br>Products</h3>
                    </div>

                    <!-- Step 2: Creative Designing -->
                    <div class="rc-process-step">
                        <div class="rc-process-icon-wrap">
                            <div class="rc-process-icon-circle">
                                <!-- Magic Wand / Creative Designing Icon -->
                                <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#451A05" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M15 4V2"></path>
                                    <path d="M15 16v-2"></path>
                                    <path d="M8 9h2"></path>
                                    <path d="M20 9h2"></path>
                                    <path d="M17.8 11.8 19 13"></path>
                                    <path d="M15 9h0"></path>
                                    <path d="M17.8 6.2 19 5"></path>
                                    <path d="m3 21 9-9"></path>
                                    <path d="M12.2 6.2 11 5"></path>
                                </svg>
                            </div>
                            <div class="rc-process-num-badge">2</div>
                        </div>
                        <h3 class="rc-process-step-title">2. Creative Designing</h3>
                    </div>

                    <!-- Step 3: Quality Checked with Care -->
                    <div class="rc-process-step">
                        <div class="rc-process-icon-wrap">
                            <div class="rc-process-icon-circle">
                                <!-- Quality Checked / Clipboard with Checkmark Icon -->
                                <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#451A05" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 11l3 3L22 4"></path>
                                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                </svg>
                            </div>
                            <div class="rc-process-num-badge">3</div>
                        </div>
                        <h3 class="rc-process-step-title">Quality Checked with<br>Care</h3>
                    </div>

                    <!-- Step 4: Beautifully Packed for You -->
                    <div class="rc-process-step">
                        <div class="rc-process-icon-wrap">
                            <div class="rc-process-icon-circle">
                                <!-- Gift Box Packing Icon -->
                                <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#451A05" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 12 20 22 4 22 4 12"></polyline>
                                    <rect x="2" y="7" width="20" height="5"></rect>
                                    <line x1="12" y1="22" x2="12" y2="7"></line>
                                    <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path>
                                    <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path>
                                </svg>
                            </div>
                            <div class="rc-process-num-badge">4</div>
                        </div>
                        <h3 class="rc-process-step-title">Beautifully Packed for<br>You</h3>
                    </div>

                    <!-- Step 5: Delivered with Love -->
                    <div class="rc-process-step">
                        <div class="rc-process-icon-wrap">
                            <div class="rc-process-icon-circle">
                                <!-- Delivery Truck with Heart Icon -->
                                <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#451A05" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="1" y="3" width="15" height="13"></rect>
                                    <polygon points="16 8 20 8 23 11 23 16 16 16 8"></polygon>
                                    <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                    <circle cx="18.5" cy="18.5" r="2.5"></circle>
                                </svg>
                            </div>
                            <div class="rc-process-num-badge">5</div>
                        </div>
                        <h3 class="rc-process-step-title">Delivered with<br>Love</h3>
                    </div>

                </div>

            </div>

        </div>
    </section>

</div>
@endsection
