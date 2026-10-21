<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#240a00">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    @php
        $pageTitle = $title ?? config('ruchi.default_title');
        $metaDescription = $metaDescription ?? config('ruchi.meta_description');
    @endphp
    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $metaDescription }}">
    <meta property="og:site_name" content="{{ config('ruchi.site_name') }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">

    <!-- Google Fonts: Allura, Cormorant Garamond, Poppins, Dancing Script, Playball, Playfair Display, Outfit, Inter, Montserrat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Allura&family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,400;1,600&family=Dancing+Script:wght@700&family=Inter:wght@400;500;600;700&family=Montserrat:wght@500;600;700&family=Outfit:wght@400;500;600;700&family=Playball&family=Playfair+Display:ital,wght@0,600;0,700;1,400;1,600;1,700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Header & Theme Styles -->
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ai-assistant.css') }}">

    @stack('styles')
</head>
<body class="page-width-narrow">
    <div id="app" class="site-wrapper">
        <!-- Site Header Component (Exact match to ruchichocolate.com) -->
        @include('components.header.index')

        <!-- Main Page Content -->
        <main id="MainContent" class="main-content">
            @yield('content')
        </main>

        <!-- Section 9: Site Footer Component (Exact match to ruchichocolate.com) -->
        @include('components.footer')
    </div>

    <!-- Product Quick View Modal Component -->
    @include('components.product-modal')

    <!-- Floating AI Voice & Text Assistant Component -->
    @include('components.ai-assistant')

    <!-- Header & Wishlist Engine Scripts -->
    <script src="{{ asset('js/header.js') }}"></script>
    <script src="{{ asset('js/ai-assistant.js') }}"></script>
    @stack('scripts')
</body>
</html>
