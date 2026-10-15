<?php

namespace Tests\Feature;

use Tests\TestCase;

class WhyChooseSectionTest extends TestCase
{
    /**
     * Test that Homepage Section 5 "Why Choose Ruchi Chocolate?" is not rendered.
     */
    public function test_homepage_does_not_render_why_choose_section(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        // Verify Section 5 Container and Heading are removed
        $response->assertDontSee('class="why-choose-section"', false);
        $response->assertDontSee('Why Choose Ruchi Chocolate?');

        // Verify Other Sections are preserved
        $response->assertSee('rc-main-nav-bar');
        $response->assertSee('Shop by Category');
        $response->assertSee('Best sellers', false);
        $response->assertSee('Spread Happiness', false);
    }
}
