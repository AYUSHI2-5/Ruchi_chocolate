<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProductModalTest extends TestCase
{
    /**
     * Test that the product detail API endpoint returns complete product details including description and highlights.
     */
    public function test_api_returns_product_with_description_and_details(): void
    {
        $testIds = ['r001', 'r002', 'r003', 'r004', 'r005', 'r006', 'r007', 'r008', 'r009', 'r010', 'r011', 'r012', 'r013', 'r014', 'r015', 'p001'];

        foreach ($testIds as $id) {
            $response = $this->getJson("/api/products/{$id}");

            $response->assertStatus(200);
            $response->assertJsonStructure([
                'id',
                'title',
                'price',
                'rating',
                'rating_count',
                'image',
                'category',
                'description',
                'details',
            ]);

            $data = $response->json();
            $this->assertNotEmpty($data['description'], "Product {$id} should have a non-empty description");
            $this->assertIsArray($data['details'], "Product {$id} should have details array");
            $this->assertNotEmpty($data['details'], "Product {$id} should have non-empty details");
        }
    }

    /**
     * Test that fc- prefixed IDs (used in featured collections) also resolve cleanly.
     */
    public function test_api_handles_fc_prefixed_ids(): void
    {
        $response = $this->getJson('/api/products/fc-r001');

        $response->assertStatus(200);
        $response->assertJsonPath('id', 'r001');
        $response->assertJsonPath('title', 'R001 Volley Handy');
    }

    /**
     * Test that the homepage includes the product modal component and triggers.
     */
    public function test_homepage_includes_product_modal_and_view_triggers(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('id="productDetailModal"', false);
        $response->assertSee('id="modalProductDescription"', false);
        $response->assertSee('id="modalProductDetailsList"', false);
        $response->assertSee('modalWhatsAppBtn', false);
        $response->assertSee('open-product-modal', false);
        $response->assertSee('Shop Pickup Only');
        $response->assertSee('product-modal__pickup-notice', false);
    }

    /**
     * Product API includes shareable URL and WhatsApp inquiry link with pickup wording.
     */
    public function test_api_returns_whatsapp_inquiry_fields_for_product(): void
    {
        $response = $this->getJson('/api/products/r001');

        $response->assertStatus(200);
        $response->assertJsonPath('shop_pickup_only', true);

        $data = $response->json();
        $this->assertStringContainsString(route('new-arrivals', ['product' => 'r001'], absolute: true), $data['product_url']);
        $this->assertStringStartsWith(config('ruchi.whatsapp_url'), $data['whatsapp_inquiry_url']);
        $this->assertStringContainsString('arrange%20pickup', $data['whatsapp_inquiry_url']);
        $this->assertStringContainsString(rawurlencode($data['title']), $data['whatsapp_inquiry_url']);
    }
}
