<?php

namespace Tests\Feature;

use Tests\TestCase;

class HeaderTest extends TestCase
{
    public function test_homepage_renders_header_layers_correctly(): void
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);

        // LAYER 1: Continuous Marquee Announcement Bar Elements
        $response->assertSee('announcement-bar-marquee');
        $response->assertSee('Handmade with Love');
        $response->assertDontSee('PAN India Delivery');
        $response->assertSee('Exclusive Gift Hampers');
        $response->assertDontSee('Track Order');
        $response->assertSee('Help &amp; Support', false);
        $response->assertSee('+91 7490828282');

        // LAYER 2: Compact Single Navigation Row (Logo, Left-Shifted Links, WhatsApp)
        $response->assertSee('rc-main-nav-bar');
        $response->assertSee('Home');
        $response->assertSee('Our Products');
        $response->assertSee('New Arrivals');
        $response->assertSee('Trending');
        $response->assertSee('Customised Gifts');
        $response->assertSee('About Us');
        $response->assertSee('Contact Us');
        $response->assertSee('Enquire on WhatsApp');
        $response->assertDontSee('rc-search-toggle-btn');

        // Removed items from header: Account / Sign In, Cart, Search Button
        $response->assertDontSee('Sign In / Account');
        $response->assertDontSee('rc-account-link');
        $response->assertDontSee('rc-cart-link');
    }

    public function test_search_route_works_correctly(): void
    {
        $response = $this->get(route('search', ['q' => 'dark chocolate truffles']));

        $response->assertStatus(200);
        $response->assertSee('dark chocolate truffles');
    }

    public function test_all_header_navigation_routes(): void
    {
        $this->get(route('new-arrivals'))->assertStatus(200);
        $this->get(route('products'))->assertStatus(200);
        $this->get(route('trending'))->assertStatus(200);
        $this->get(route('customised-gifts'))->assertStatus(200);
        $this->get(route('catalog'))->assertRedirect(route('home'));
        $this->get(route('about'))->assertStatus(200);
        $this->get(route('contact'))->assertStatus(200);
        $this->get(route('offers'))->assertRedirect(route('home'));
        $this->get(route('account'))->assertRedirect(route('home'));
        $this->get(route('wishlist'))->assertRedirect(route('home'));
        $this->get(route('cart'))->assertRedirect(route('home'));
        $this->get(route('track-order'))->assertRedirect(route('home'));
        $this->get(route('support'))->assertRedirect(route('home'));
    }

    public function test_customised_gifts_page_is_empty(): void
    {
        $response = $this->get(route('customised-gifts'));
        $response->assertStatus(200);
        $response->assertSee('rc-customised-page');
        $response->assertDontSee('na-layout');
    }
}
