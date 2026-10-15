<?php

namespace Tests\Feature;

use Tests\TestCase;

class ResponsiveLayoutTest extends TestCase
{
    /**
     * Test that homepage renders with proper responsive container hierarchy.
     */
    public function test_homepage_has_responsive_container_structure(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('class="site-wrapper"', false);
        $response->assertSee('rc-main-nav-bar');
        $response->assertSee('rc-middle-bar');
        $response->assertSee('rc-bottom-bar');
        $response->assertSee('rc-nav-container');
        $response->assertSee('class="rc-slideshow-section"', false);
        $response->assertSee('class="rc-slide-inner"', false);
        $response->assertSee('class="rc-features-container"', false);
        $response->assertSee('class="category-circles__container"', false);
        $response->assertDontSee('class="rc-whatsapp-float"', false);
    }

    /**
     * Test that header.css contains proper responsive properties and no rigid overflowing widths.
     */
    public function test_header_css_contains_responsive_rules(): void
    {
        $css = file_get_contents(public_path('css/header.css'));

        $this->assertStringContainsString('overflow-x: clip', $css);
        $this->assertStringContainsString('position: sticky', $css);
        $this->assertStringContainsString('clamp(', $css);
        $this->assertStringContainsString('@media screen and (max-width: 1024px)', $css);
        $this->assertStringContainsString('@media screen and (max-width: 767px)', $css);
    }
}
