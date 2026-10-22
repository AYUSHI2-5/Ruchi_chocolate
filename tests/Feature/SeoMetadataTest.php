<?php

namespace Tests\Feature;

use Tests\TestCase;

class SeoMetadataTest extends TestCase
{
    /**
     * Helper to assert that an indexable page returns HTTP 200, exactly one <title> tag,
     * exactly one <meta name="description"> tag, exactly one canonical URL on https://ruchichocolate.com,
     * and complete Open Graph and Twitter Card tags.
     */
    protected function assertPageSeoMetadata(
        string $uri,
        string $expectedTitle,
        string $expectedDescription,
        string $expectedCanonicalUrl
    ): void {
        $response = $this->get($uri);

        $response->assertStatus(200);

        $content = $response->getContent();

        // Exactly one <title> tag
        $this->assertSame(
            1,
            substr_count($content, '<title>'),
            "Page {$uri} must contain exactly one <title> tag."
        );

        // Exactly one <meta name="description" tag
        $this->assertSame(
            1,
            substr_count($content, '<meta name="description"'),
            "Page {$uri} must contain exactly one <meta name=\"description\"> tag."
        );

        // Title content matches
        $escapedTitle = e($expectedTitle);
        $this->assertStringContainsString(
            "<title>{$escapedTitle}</title>",
            $content,
            "Page {$uri} does not contain expected title: {$expectedTitle}"
        );

        // Meta description content matches
        $escapedDescription = e($expectedDescription);
        $this->assertStringContainsString(
            "<meta name=\"description\" content=\"{$escapedDescription}\">",
            $content,
            "Page {$uri} does not contain expected meta description: {$expectedDescription}"
        );

        // Exactly one <link rel="canonical"> tag pointing to the expected production HTTPS URL
        $this->assertSame(
            1,
            substr_count($content, '<link rel="canonical"'),
            "Page {$uri} must contain exactly one <link rel=\"canonical\"> tag."
        );
        $this->assertStringContainsString(
            '<link rel="canonical" href="'.$expectedCanonicalUrl.'">',
            $content,
            "Page {$uri} does not contain expected canonical link: {$expectedCanonicalUrl}"
        );

        // Exactly one og:url matching canonical
        $this->assertSame(
            1,
            substr_count($content, '<meta property="og:url"'),
            "Page {$uri} must contain exactly one <meta property=\"og:url\"> tag."
        );
        $this->assertStringContainsString(
            '<meta property="og:url" content="'.$expectedCanonicalUrl.'">',
            $content,
            "Page {$uri} og:url does not match canonical: {$expectedCanonicalUrl}"
        );

        // Open Graph tags
        $this->assertStringContainsString(
            '<meta property="og:site_name" content="'.e(config('ruchi.site_name')).'">',
            $content
        );
        $this->assertStringContainsString(
            '<meta property="og:title" content="'.$escapedTitle.'">',
            $content
        );
        $this->assertStringContainsString(
            '<meta property="og:description" content="'.$escapedDescription.'">',
            $content
        );
        $this->assertStringContainsString(
            '<meta property="og:type" content="website">',
            $content
        );
        $this->assertStringContainsString(
            '<meta property="og:image" content="https://ruchichocolate.com/images/hero-banner.png">',
            $content
        );
        $this->assertStringContainsString(
            '<meta property="og:image:alt" content="'.e(config('ruchi.default_og_image_alt')).'">',
            $content
        );

        // Twitter Card tags
        $this->assertSame(
            1,
            substr_count($content, '<meta name="twitter:card"'),
            "Page {$uri} must contain exactly one <meta name=\"twitter:card\"> tag."
        );
        $this->assertStringContainsString(
            '<meta name="twitter:card" content="summary_large_image">',
            $content
        );
        $this->assertStringContainsString(
            '<meta name="twitter:title" content="'.$escapedTitle.'">',
            $content
        );
        $this->assertStringContainsString(
            '<meta name="twitter:description" content="'.$escapedDescription.'">',
            $content
        );
        $this->assertStringContainsString(
            '<meta name="twitter:image" content="https://ruchichocolate.com/images/hero-banner.png">',
            $content
        );
    }

    /**
     * Test Home page (/) SEO metadata, canonical, Open Graph, and Twitter Cards.
     */
    public function test_home_page_renders_correct_seo_metadata(): void
    {
        $this->assertPageSeoMetadata(
            '/',
            'Ruchi Chocolates | Handmade Chocolates & Gift Hampers',
            'Discover handmade chocolates, chocolate bouquets and gift hampers from Ruchi Chocolates. Explore thoughtful gifts for birthdays, anniversaries and special occasions.',
            'https://ruchichocolate.com/'
        );
    }

    /**
     * Test Products catalog page (/products) SEO metadata, canonical, Open Graph, and Twitter Cards.
     */
    public function test_products_page_renders_correct_seo_metadata(): void
    {
        $this->assertPageSeoMetadata(
            '/products',
            'Our Products — Handcrafted Chocolates, Bouquets & Gift Hampers | Ruchi Chocolates',
            'Explore our complete collection of handmade chocolates, gift boxes, chocolate bouquets, and celebration hampers made with love at Ruchi Chocolates.',
            'https://ruchichocolate.com/products'
        );
    }

    /**
     * Test New Arrivals page (/new-arrivals) SEO metadata, distinct canonical from /products, Open Graph, and Twitter Cards.
     */
    public function test_new_arrivals_page_renders_correct_seo_metadata(): void
    {
        $this->assertPageSeoMetadata(
            '/new-arrivals',
            'New Arrivals — Handcrafted Chocolates & Hampers | Ruchi Chocolates',
            'Discover the newest handcrafted chocolate creations and fresh gift hampers from Ruchi Chocolates. Perfect for celebrations and sweet surprises.',
            'https://ruchichocolate.com/new-arrivals'
        );
    }

    /**
     * Test Trending products page (/trending) SEO metadata, canonical, Open Graph, and Twitter Cards.
     */
    public function test_trending_page_renders_correct_seo_metadata(): void
    {
        $this->assertPageSeoMetadata(
            '/trending',
            'Trending Chocolates & Popular Gift Hampers | Ruchi Chocolates',
            'Explore the most popular and trending homemade chocolates, festive hampers, and gifting favorites loved by our customers at Ruchi Chocolates.',
            'https://ruchichocolate.com/trending'
        );
    }

    /**
     * Test Customised Gifts page (/customised-gifts) SEO metadata, canonical, Open Graph, and Twitter Cards.
     */
    public function test_customised_gifts_page_renders_correct_seo_metadata(): void
    {
        $this->assertPageSeoMetadata(
            '/customised-gifts',
            'Customised Gifts — Personalized Chocolate Hampers | Ruchi Chocolates',
            'Create personalized chocolate gifts and bespoke hampers tailored for weddings, birthdays, corporate gifting, and special celebrations with Ruchi Chocolates.',
            'https://ruchichocolate.com/customised-gifts'
        );
    }

    /**
     * Test About Us page (/about) SEO metadata, canonical, Open Graph, and Twitter Cards.
     */
    public function test_about_page_renders_correct_seo_metadata(): void
    {
        $this->assertPageSeoMetadata(
            '/about',
            'About Us — Our Story & Handcrafted Chocolates Since 2010 | Ruchi Chocolates',
            'Learn about Ruchi Chocolates, crafting artisanal homemade chocolates and celebration hampers with love and premium ingredients in Ahmedabad since 2010.',
            'https://ruchichocolate.com/about'
        );
    }

    /**
     * Test Contact Us page (/contact) SEO metadata, canonical, Open Graph, and Twitter Cards.
     */
    public function test_contact_page_renders_correct_seo_metadata(): void
    {
        $this->assertPageSeoMetadata(
            '/contact',
            'Contact Us — Get in Touch & Store Location | Ruchi Chocolates',
            'Contact Ruchi Chocolates in Paldi, Ahmedabad for custom chocolate orders, gift hamper inquiries, and WhatsApp support. We are here to sweeten your celebrations.',
            'https://ruchichocolate.com/contact'
        );
    }

    /**
     * Test Privacy Policy page (/privacy-policy) SEO metadata, canonical, Open Graph, and Twitter Cards.
     */
    public function test_privacy_policy_page_renders_correct_seo_metadata(): void
    {
        $this->assertPageSeoMetadata(
            '/privacy-policy',
            'Privacy Policy — Ruchi Chocolates | Handcrafted with Love',
            'Read the Privacy Policy for Ruchi Chocolates to understand how we collect, protect, and handle your personal information when using our website and services.',
            'https://ruchichocolate.com/privacy-policy'
        );
    }

    /**
     * Test Terms and Conditions page (/terms-and-conditions) SEO metadata, canonical, Open Graph, and Twitter Cards.
     */
    public function test_terms_and_conditions_page_renders_correct_seo_metadata(): void
    {
        $this->assertPageSeoMetadata(
            '/terms-and-conditions',
            'Terms & Conditions — Ruchi Chocolates | Handcrafted with Love',
            'Review the Terms & Conditions governing orders, shop pickup, customized chocolate hampers, and website usage at Ruchi Chocolates.',
            'https://ruchichocolate.com/terms-and-conditions'
        );
    }

    /**
     * Test that query parameters do not alter or pollute the canonical URL.
     */
    public function test_query_parameters_do_not_alter_canonical_url(): void
    {
        $response = $this->get('/products?category=chocolates&sort=price_low_high&page=2');

        $response->assertStatus(200);

        $content = $response->getContent();

        $this->assertSame(
            1,
            substr_count($content, '<link rel="canonical"'),
            'Products page with query parameters must contain exactly one canonical tag.'
        );

        $this->assertStringContainsString(
            '<link rel="canonical" href="https://ruchichocolate.com/products">',
            $content,
            'Canonical tag must strip query parameters and point to clean base route.'
        );
    }

    /**
     * Test that the /search route outputs noindex, follow and does NOT output an indexable canonical tag.
     */
    public function test_search_page_has_noindex_and_no_canonical_link(): void
    {
        $response = $this->get('/search?q=truffles');

        $response->assertStatus(200);

        $content = $response->getContent();

        // Exactly one robots meta tag with noindex, follow
        $this->assertSame(
            1,
            substr_count($content, '<meta name="robots"'),
            'Search page must contain exactly one <meta name="robots"> tag.'
        );
        $this->assertStringContainsString(
            '<meta name="robots" content="noindex, follow">',
            $content,
            'Search page must declare noindex, follow to prevent indexing of internal search results.'
        );

        // Must NOT output an indexable canonical tag
        $this->assertSame(
            0,
            substr_count($content, '<link rel="canonical"'),
            'Search page must NOT output an indexable canonical tag.'
        );

        // og:url on search route
        $this->assertStringContainsString(
            '<meta property="og:url" content="https://ruchichocolate.com/search">',
            $content
        );
    }

    /**
     * Test that public/sitemap.xml contains all 9 indexable public pages including /trending.
     */
    public function test_sitemap_contains_all_nine_public_routes_including_trending(): void
    {
        $sitemapPath = public_path('sitemap.xml');

        $this->assertFileExists($sitemapPath);

        $sitemapContent = file_get_contents($sitemapPath);

        $expectedUrls = [
            'https://ruchichocolate.com/',
            'https://ruchichocolate.com/products',
            'https://ruchichocolate.com/new-arrivals',
            'https://ruchichocolate.com/trending',
            'https://ruchichocolate.com/customised-gifts',
            'https://ruchichocolate.com/about',
            'https://ruchichocolate.com/contact',
            'https://ruchichocolate.com/privacy-policy',
            'https://ruchichocolate.com/terms-and-conditions',
        ];

        foreach ($expectedUrls as $url) {
            $this->assertStringContainsString(
                "<loc>{$url}</loc>",
                $sitemapContent,
                "Sitemap must contain {$url}"
            );
        }

        // Verify that internal search, API, and utility redirect routes are NOT in the sitemap
        $this->assertStringNotContainsString('/search', $sitemapContent);
        $this->assertStringNotContainsString('/api/', $sitemapContent);
        $this->assertStringNotContainsString('/cart', $sitemapContent);
        $this->assertStringNotContainsString('/account', $sitemapContent);
        $this->assertStringNotContainsString('/wishlist', $sitemapContent);
    }

    /**
     * Test that global Store and WebSite JSON-LD structured data is rendered on public pages.
     */
    public function test_global_structured_data_store_and_website_present(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $content = $response->getContent();

        // Must have application/ld+json script tag
        $this->assertStringContainsString('<script type="application/ld+json">', $content);

        // Store schema verification
        $this->assertStringContainsString('"@type": "Store"', $content);
        $this->assertStringContainsString('"name": "Ruchi Chocolates"', $content);
        $this->assertStringContainsString('"telephone": "+917490828282"', $content);
        $this->assertStringContainsString('"addressLocality": "Paldi, Ahmedabad"', $content);

        // WebSite schema and SearchAction verification
        $this->assertStringContainsString('"@type": "WebSite"', $content);
        $this->assertStringContainsString('"@type": "SearchAction"', $content);
        $this->assertStringContainsString('https://ruchichocolate.com/search?q={search_term_string}', $content);
    }

    /**
     * Test that child pages render valid BreadcrumbList JSON-LD structured data.
     */
    public function test_child_pages_render_breadcrumb_schema(): void
    {
        $pages = [
            '/about' => 'About Us',
            '/contact' => 'Contact Us',
            '/customised-gifts' => 'Customised Gifts',
            '/privacy-policy' => 'Privacy Policy',
            '/terms-and-conditions' => 'Terms & Conditions',
            '/new-arrivals' => 'New Arrivals',
            '/trending' => 'Trending',
            '/products' => 'Products',
        ];

        foreach ($pages as $uri => $breadcrumbName) {
            $response = $this->get($uri);
            $response->assertStatus(200);

            $content = $response->getContent();
            $this->assertStringContainsString('"@type": "BreadcrumbList"', $content, "Page {$uri} missing BreadcrumbList schema.");
            $this->assertStringContainsString('"name": "' . $breadcrumbName . '"', $content, "Page {$uri} missing breadcrumb item '{$breadcrumbName}'.");
        }
    }

    /**
     * Test that catalog pages (/products, /new-arrivals, /trending) render ItemList with Product schema.
     */
    public function test_catalog_pages_render_itemlist_and_product_schema(): void
    {
        foreach (['/products', '/new-arrivals', '/trending'] as $uri) {
            $response = $this->get($uri);
            $response->assertStatus(200);

            $content = $response->getContent();
            $this->assertStringContainsString('"@type": "ItemList"', $content, "Page {$uri} missing ItemList schema.");
            $this->assertStringContainsString('"@type": "Product"', $content, "Page {$uri} missing Product schema in ItemList.");
            $this->assertStringContainsString('"@type": "Offer"', $content, "Page {$uri} missing Offer in Product schema.");
            $this->assertStringContainsString('"priceCurrency": "INR"', $content, "Page {$uri} missing INR currency.");
        }
    }

    /**
     * Test that heading structure adheres to exactly one H1 per page and includes logical H2 section headings.
     */
    public function test_heading_structure_improvements(): void
    {
        // Contact page: exactly 1 H1
        $contactRes = $this->get('/contact');
        $contactRes->assertStatus(200);
        $contactContent = $contactRes->getContent();
        $this->assertSame(1, substr_count($contactContent, '<h1'), 'Contact page must have exactly 1 H1 tag.');
        $this->assertStringContainsString('Contact Ruchi Chocolates', $contactContent);
        $this->assertStringContainsString('<h2 class="rc-contact-main-title">Send Us a Message</h2>', $contactContent);

        // New Arrivals page: exactly 1 H1 and an H2 preceding product cards
        $naRes = $this->get('/new-arrivals');
        $naRes->assertStatus(200);
        $naContent = $naRes->getContent();
        $this->assertSame(1, substr_count($naContent, '<h1'), 'New Arrivals page must have exactly 1 H1 tag.');
        $this->assertStringContainsString('New Arrivals Chocolate Collection', $naContent);

        // Trending page: exactly 1 H1 and an H2 preceding product cards
        $trRes = $this->get('/trending');
        $trRes->assertStatus(200);
        $trContent = $trRes->getContent();
        $this->assertSame(1, substr_count($trContent, '<h1'), 'Trending page must have exactly 1 H1 tag.');
        $this->assertStringContainsString('Trending Chocolates &amp; Gifts Collection', $trContent);
    }

    /**
     * Test that key static images have intrinsic width and height attributes to avoid CLS.
     */
    public function test_key_static_images_have_intrinsic_dimensions(): void
    {
        // Home page logo and polaroid images
        $homeRes = $this->get('/');
        $homeRes->assertStatus(200);
        $homeContent = $homeRes->getContent();
        $this->assertStringContainsString('width="487"', $homeContent);
        $this->assertStringContainsString('height="598"', $homeContent);
        $this->assertStringContainsString('width="1024"', $homeContent);
        $this->assertStringContainsString('height="1024"', $homeContent);

        // About page hero hamper image
        $aboutRes = $this->get('/about');
        $aboutRes->assertStatus(200);
        $aboutContent = $aboutRes->getContent();
        $this->assertStringContainsString('width="1376"', $aboutContent);
        $this->assertStringContainsString('height="768"', $aboutContent);

        // Products catalog hero hamper image
        $prodRes = $this->get('/products');
        $prodRes->assertStatus(200);
        $prodContent = $prodRes->getContent();
        $this->assertStringContainsString('width="1200"', $prodContent);
        $this->assertStringContainsString('height="896"', $prodContent);
    }
}

