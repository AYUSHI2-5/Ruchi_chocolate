{{-- Mobile Navigation Drawer --}}
<div class="rc-mobile-drawer" id="rcMobileDrawer">
    <div class="rc-mobile-drawer-overlay" onclick="toggleRcMobileDrawer()"></div>
    <div class="rc-mobile-drawer-content">
        <div class="rc-mobile-drawer-header">
            <div class="rc-mobile-drawer-logo">
                @if(file_exists(public_path('images/logo.png')))
                    <img src="{{ asset('images/logo.png') }}" alt="Ruchi Chocolates" class="rc-drawer-logo-img">
                @else
                    <span class="rc-drawer-logo-title">Ruchi Chocolates</span>
                @endif
            </div>
            <button type="button" class="rc-mobile-drawer-close" onclick="toggleRcMobileDrawer()" aria-label="Close menu">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        
        <div class="rc-mobile-drawer-body">
            <!-- Mobile Search Bar -->
            <form action="{{ route('search') }}" method="GET" role="search" class="rc-mobile-drawer-search">
                <input 
                    type="text" 
                    name="q" 
                    placeholder="Search chocolates, gifts & more..." 
                    aria-label="Search" 
                    class="rc-mobile-drawer-search-input" 
                    value="{{ request('q', $searchQuery ?? '') }}"
                    autocomplete="off"
                >
                <button type="submit" class="rc-mobile-drawer-search-btn" aria-label="Search">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </button>
            </form>

            <ul class="rc-mobile-nav">
                <li class="rc-mobile-nav-item">
                    <a href="{{ route('home') }}" class="rc-mobile-nav-link {{ request()->routeIs('home') ? 'active' : '' }}" onclick="toggleRcMobileDrawer()">Home</a>
                </li>
                <li class="rc-mobile-nav-item">
                    <a href="{{ route('products') }}" class="rc-mobile-nav-link {{ request()->routeIs('products') || request()->routeIs('new-arrivals') ? 'active' : '' }}" onclick="toggleRcMobileDrawer()">Our Products</a>
                </li>
                <li class="rc-mobile-nav-item">
                    <a href="{{ route('customised-gifts') }}" class="rc-mobile-nav-link {{ request()->routeIs('customised-gifts') || request()->routeIs('trending') ? 'active' : '' }}" onclick="toggleRcMobileDrawer()">Customised Gifts</a>
                </li>
                <li class="rc-mobile-nav-item">
                    <a href="{{ route('about') }}" class="rc-mobile-nav-link {{ request()->routeIs('about') ? 'active' : '' }}" onclick="toggleRcMobileDrawer()">About Us</a>
                </li>
                <li class="rc-mobile-nav-item">
                    <a href="{{ route('contact') }}" class="rc-mobile-nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" onclick="toggleRcMobileDrawer()">Contact Us</a>
                </li>
            </ul>

            <!-- Enquire on WhatsApp in mobile drawer -->
            <div class="rc-mobile-drawer-whatsapp">
                <a href="https://wa.me/917490828282?text=Hi%20Ruchi%20Chocolates%2C%20I%20would%20like%20to%20enquire%20about%20your%20products." 
                   class="rc-whatsapp-nav-btn rc-whatsapp-drawer-btn" 
                   target="_blank" 
                   rel="noopener noreferrer" 
                   aria-label="Enquire on WhatsApp">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2zm5.79 14.07c-.24.67-1.39 1.28-1.92 1.36-.5.08-1.14.12-3.37-.8-2.67-1.11-4.38-3.83-4.51-4.01-.13-.18-1.07-1.42-1.07-2.71 0-1.29.68-1.92.92-2.18.24-.26.53-.33.71-.33.18 0 .36.002.51.01.16.01.38-.06.59.45.24.57.81 1.97.88 2.11.07.15.12.32.02.51-.1.2-.15.32-.3.49-.15.17-.31.39-.45.52-.15.15-.31.31-.13.62.18.31.8 1.31 1.71 2.12 1.17 1.04 2.16 1.36 2.47 1.51.31.15.49.13.67-.08.18-.21.78-.91.99-1.22.21-.31.42-.26.71-.15.29.11 1.83.86 2.15 1.02.32.16.53.24.61.37.08.14.08.79-.16 1.46z"/>
                    </svg>
                    <span>Enquire on WhatsApp</span>
                </a>
            </div>
        </div>
    </div>
</div>
