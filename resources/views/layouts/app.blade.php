
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#240a00">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    @php
        $rawTitle = $__env->hasSection('title') && trim($__env->yieldContent('title')) !== ''
            ? trim($__env->yieldContent('title'))
            : ($title ?? config('ruchi.default_title'));
        $pageTitle = htmlspecialchars_decode($rawTitle, ENT_QUOTES);

        $rawDescription = $__env->hasSection('meta_description') && trim($__env->yieldContent('meta_description')) !== ''
            ? trim($__env->yieldContent('meta_description'))
            : ($metaDescription ?? config('ruchi.meta_description'));
        $metaDescription = htmlspecialchars_decode($rawDescription, ENT_QUOTES);

        $canonicalBase = rtrim(config('ruchi.canonical_base_url', 'https://ruchichocolate.com'), '/');
        $rawPath = '/' . ltrim(request()->getPathInfo(), '/');
        $normalizedPath = $rawPath === '/' ? '/' : rtrim($rawPath, '/');

        $isSearchRoute = request()->routeIs('search') || $rawPath === '/search';
        $isNoindex = $isSearchRoute || ($__env->hasSection('robots') && str_contains(strtolower((string) $__env->yieldContent('robots')), 'noindex'));

        $defaultCanonicalUrl = $canonicalBase . $normalizedPath;
        $canonicalUrl = $__env->hasSection('canonical') && trim($__env->yieldContent('canonical')) !== ''
            ? trim($__env->yieldContent('canonical'))
            : ($canonicalUrl ?? $defaultCanonicalUrl);

        $defaultOgImageRelative = config('ruchi.default_og_image', 'images/hero-banner.png');
        $defaultOgImageUrl = $canonicalBase . '/' . ltrim($defaultOgImageRelative, '/');
        $ogImage = $__env->hasSection('og_image') && trim($__env->yieldContent('og_image')) !== ''
            ? trim($__env->yieldContent('og_image'))
            : ($ogImage ?? $defaultOgImageUrl);

        $ogImageAlt = $__env->hasSection('og_image_alt') && trim($__env->yieldContent('og_image_alt')) !== ''
            ? trim($__env->yieldContent('og_image_alt'))
            : ($ogImageAlt ?? config('ruchi.default_og_image_alt', 'Ruchi Chocolates Handmade Chocolates & Gift Hampers'));

        $ogUrl = $isSearchRoute ? ($canonicalBase . '/search') : $canonicalUrl;
    @endphp
    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $metaDescription }}">
@if($isNoindex)
    <meta name="robots" content="noindex, follow">
@else
    <link rel="canonical" href="{{ $canonicalUrl }}">
@endif
    <meta property="og:site_name" content="{{ config('ruchi.site_name') }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $ogUrl }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:image:alt" content="{{ $ogImageAlt }}">
    <meta property="og:image:width" content="{{ config('ruchi.default_og_image_width', 1800) }}">
    <meta property="og:image:height" content="{{ config('ruchi.default_og_image_height', 844) }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    <meta name="twitter:image" content="{{ $ogImage }}">
    <meta name="twitter:image:alt" content="{{ $ogImageAlt }}">

    <!-- Google Fonts: Allura, Cormorant Garamond, Poppins, Dancing Script, Playball, Playfair Display, Outfit, Inter, Montserrat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Allura&family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,400;1,600&family=Dancing+Script:wght@700&family=Inter:wght@400;500;600;700&family=Montserrat:wght@500;600;700&family=Outfit:wght@400;500;600;700&family=Playball&family=Playfair+Display:ital,wght@0,600;0,700;1,400;1,600;1,700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Header & Theme Styles -->
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ai-assistant.css') }}">

    @stack('styles')

    <!-- Global Structured Data (JSON-LD) -->
    @php
        $globalSchemas = [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'Store',
                    '@id' => $canonicalBase . '/#store',
                    'name' => 'Ruchi Chocolates',
                    'url' => $canonicalBase,
                    'logo' => $canonicalBase . '/images/logo.png',
                    'image' => $defaultOgImageUrl,
                    'description' => config('ruchi.meta_description'),
                    'telephone' => '+91' . preg_replace('/\D+/', '', (string) config('ruchi.phone', '7490828282')),
                    'email' => config('ruchi.email', 'Info.ruchi11@gmail.com'),
                    'address' => [
                        '@type' => 'PostalAddress',
                        'streetAddress' => 'Shri Hari appartment, 17 vasantkunj Society, New Sharda Mandir Road',
                        'addressLocality' => 'Paldi, Ahmedabad',
                        'addressRegion' => 'Gujarat',
                        'postalCode' => '380007',
                        'addressCountry' => 'IN',
                    ],
                    'openingHoursSpecification' => [
                        [
                            '@type' => 'OpeningHoursSpecification',
                            'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                            'opens' => '09:00',
                            'closes' => '21:00',
                        ],
                        [
                            '@type' => 'OpeningHoursSpecification',
                            'dayOfWeek' => ['Sunday'],
                            'opens' => '10:00',
                            'closes' => '18:00',
                        ],
                    ],
                    'sameAs' => array_values(array_filter([
                        config('ruchi.instagram_url'),
                        config('ruchi.facebook_url'),
                    ])),
                ],
                [
                    '@type' => 'WebSite',
                    '@id' => $canonicalBase . '/#website',
                    'name' => 'Ruchi Chocolates',
                    'url' => $canonicalBase,
                    'potentialAction' => [
                        '@type' => 'SearchAction',
                        'target' => [
                            '@type' => 'EntryPoint',
                            'urlTemplate' => $canonicalBase . '/search?q={search_term_string}',
                        ],
                        'query-input' => 'required name=search_term_string',
                    ],
                ],
            ],
        ];
    @endphp
    <script type="application/ld+json">
    {!! json_encode($globalSchemas, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>

    @stack('schema')
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
