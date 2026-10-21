<?php

$address = 'Shri Hari appartment, 17 vasantkunj Society, New Sharda Mandir Road, Paldi, Ahmedabad, 380007';

$whatsappBusinessNumber = env('WHATSAPP_BUSINESS_NUMBER', env('RUCHI_PHONE', '7490828282'));
$whatsappDigits = preg_replace('/\D+/', '', (string) $whatsappBusinessNumber) ?? '';
if (str_starts_with($whatsappDigits, '91') && strlen($whatsappDigits) > 10) {
    $whatsappWaMe = $whatsappDigits;
} else {
    $whatsappWaMe = '91'.$whatsappDigits;
}

return [
    'site_name' => env('RUCHI_SITE_NAME', 'Ruchi Chocolate'),
    'default_title' => env('RUCHI_DEFAULT_TITLE', 'Ruchi Chocolate | Homemade Chocolates Made with Love'),
    'meta_description' => env(
        'RUCHI_META_DESCRIPTION',
        'Ruchi Chocolate brings you the finest handmade chocolates and thoughtful gift hampers for every occasion.'
    ),
    'email' => env('RUCHI_EMAIL', 'Info.ruchi11@gmail.com'),
    'phone' => env('RUCHI_PHONE', '7490828282'),
    'phone_display' => '+91 '.env('RUCHI_PHONE', '7490828282'),
    'whatsapp_business_number' => $whatsappBusinessNumber,
    'address' => env('RUCHI_ADDRESS', $address),
    'address_speech' => 'Shri Hari apartment, seventeen vasantkunj Society, New Sharda Mandir Road, Paldi, Ahmedabad.',
    'shop_pickup_notice' => 'Shop Pickup Only — Delivery is not available.',
    'whatsapp' => $whatsappWaMe,
    'whatsapp_url' => 'https://wa.me/'.$whatsappWaMe,
    'tel_url' => 'tel:+91'.env('RUCHI_PHONE', '7490828282'),
    'maps_embed_url' => 'https://maps.google.com/maps?q='.rawurlencode(env('RUCHI_ADDRESS', $address)).'&t=&z=15&ie=UTF8&iwloc=&output=embed',
    'maps_search_url' => 'https://www.google.com/maps/search/?api=1&query='.rawurlencode(env('RUCHI_ADDRESS', $address)),
    'instagram_url' => env('RUCHI_INSTAGRAM_URL', 'https://www.instagram.com/ruchichocolates09/'),
    'facebook_url' => env('RUCHI_FACEBOOK_URL', 'https://www.facebook.com/RuchiHomemadeChocolates'),
];
