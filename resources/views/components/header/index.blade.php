{{-- Ruchi Beverages Custom Responsive Header --}}
<header id="shopify-section-header" class="shopify-section custom-header-section" role="banner">
    <header-component id="header-component" class="rc-header">
        {{-- Top Announcement Bar --}}
        @include('components.header.announcement-bar')

        {{-- Single Compact Navigation Row (Logo on left, Nav & Actions on right) --}}
        @include('components.header.navigation-bar')
    </header-component>

    {{-- Mobile Navigation Drawer --}}
    @include('components.header.mobile-menu')

    {{-- Wishlist Global Drawer --}}
    @include('components.header.wishlist-drawer')
</header>
