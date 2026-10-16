<?php

namespace App\Services;

class ProductWhatsAppInquiry
{
    /**
     * Absolute URL to open this product on the Products (New Arrivals) page.
     */
    public function productPageUrl(string $productId): string
    {
        $id = strtolower(trim($productId));

        return route('new-arrivals', ['product' => $id], absolute: true);
    }

    /**
     * Formatted unit price for customer-facing messages (e.g. ₹1,450.00).
     */
    public function formatPriceForMessage(float $price): string
    {
        return '₹'.number_format($price, 2);
    }

    /**
     * Plain-text WhatsApp enquiry body for a catalog product.
     *
     * @param  array<string, mixed>  $product
     */
    public function buildInquiryMessage(array $product, int $quantity = 1): string
    {
        $title = (string) ($product['title'] ?? 'Product');
        $price = $this->formatPriceForMessage((float) ($product['price'] ?? 0));
        $productUrl = isset($product['product_url'])
            ? (string) $product['product_url']
            : $this->productPageUrl((string) ($product['id'] ?? ''));

        $quantity = max(1, min(99, $quantity));
        $quantityLine = $quantity > 1 ? "\nQuantity: {$quantity}" : '';

        return "Hello! I'm interested in this product from Ruchi Homemade Chocolates.\n\n"
            ."Product: {$title}\n"
            ."Price: {$price}"
            .$quantityLine."\n"
            ."Product Link: {$productUrl}\n\n"
            ."I'd like to confirm availability and arrange pickup from your shop. Please share the pickup details. Thank you!";
    }

    /**
     * WhatsApp deep link with URL-encoded pre-filled message (customer taps Send in WhatsApp).
     *
     * @param  array<string, mixed>  $product
     */
    public function buildInquiryUrl(array $product, int $quantity = 1): string
    {
        $baseUrl = rtrim((string) config('ruchi.whatsapp_url'), '/');
        $message = $this->buildInquiryMessage($product, $quantity);

        return $baseUrl.'?text='.rawurlencode($message);
    }

    /**
     * @param  array<string, mixed>  $product
     * @return array<string, mixed>
     */
    public function enrichProductForApi(array $product, int $quantity = 1): array
    {
        $id = (string) ($product['id'] ?? '');
        $product['product_url'] = $this->productPageUrl($id);
        $product['whatsapp_inquiry_url'] = $this->buildInquiryUrl($product, $quantity);
        $product['shop_pickup_only'] = true;

        return $product;
    }
}
