{{-- Single Compact Navigation Row (Logo on left, Nav shifted left, WhatsApp on right) --}}
<div class="rc-main-nav-bar rc-middle-bar rc-bottom-bar">
    <div class="rc-nav-container">
        <!-- Left Side: Mobile Hamburger, Logo & Navigation Links -->
        <div class="rc-nav-left">
            <button type="button" class="rc-hamburger-btn" onclick="toggleRcMobileDrawer()" aria-label="Open navigation menu">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
            <a href="{{ route('home') }}" class="rc-logo-link" aria-label="Ruchi Chocolates">
                @if(file_exists(public_path('images/logo.png')))
                    <img src="{{ asset('images/logo.png') }}" alt="Ruchi Chocolates" class="rc-logo-img" width="487" height="598">
                @else
                    <span class="rc-logo-title">Ruchi <span class="rc-logo-accent">Chocolates</span></span>
                @endif
            </a>

            <!-- Navigation Links shifted toward the left side -->
            <nav class="rc-nav" role="navigation" aria-label="Main Navigation">
                <ul class="rc-nav-menu">
                    <li class="rc-nav-item">
                        <a href="{{ route('home') }}" class="rc-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="rc-nav-item">
                        <a href="{{ route('products') }}" class="rc-nav-link {{ request()->routeIs('products') ? 'active' : '' }}">
                            <span>Our Products</span>
                        </a>
                    </li>
                    <li class="rc-nav-item">
                        <a href="{{ route('customised-gifts') }}" class="rc-nav-link {{ request()->routeIs('customised-gifts') ? 'active' : '' }}">
                            <span>Customised Gifts</span>
                        </a>
                    </li>
                    <li class="rc-nav-item">
                        <a href="{{ route('about') }}" class="rc-nav-link {{ request()->routeIs('about') ? 'active' : '' }}">
                            <span>About Us</span>
                        </a>
                    </li>
                    <li class="rc-nav-item">
                        <a href="{{ route('contact') }}" class="rc-nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">
                            <span>Contact Us</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Right Side: WhatsApp Enquiry Button (Aligned Right) -->
        <div class="rc-nav-right">
            <a 
                href="https://wa.me/917490828282?text=Hi%20Ruchi%20Chocolates%2C%20I%20would%20like%20to%20enquire%20about%20your%20products." 
                class="rc-whatsapp-nav-btn" 
                target="_blank" 
                rel="noopener noreferrer" 
                aria-label="Enquire on WhatsApp"
            >
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2zm5.79 14.07c-.24.67-1.39 1.28-1.92 1.36-.5.08-1.14.12-3.37-.8-2.67-1.11-4.38-3.83-4.51-4.01-.13-.18-1.07-1.42-1.07-2.71 0-1.29.68-1.92.92-2.18.24-.26.53-.33.71-.33.18 0 .36.002.51.01.16.01.38-.06.59.45.24.57.81 1.97.88 2.11.07.15.12.32.02.51-.1.2-.15.32-.3.49-.15.17-.31.39-.45.52-.15.15-.31.31-.13.62.18.31.8 1.31 1.71 2.12 1.17 1.04 2.16 1.36 2.47 1.51.31.15.49.13.67-.08.18-.21.78-.91.99-1.22.21-.31.42-.26.71-.15.29.11 1.83.86 2.15 1.02.32.16.53.24.61.37.08.14.08.79-.16 1.46z"/>
                </svg>
                <span>Enquire on WhatsApp</span>
            </a>
        </div>
    </div>
</div>
