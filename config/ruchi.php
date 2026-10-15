<?php

$address = 'Shri Hari appartment, 17 vasantkunj Society, New Sharda Mandir Road, Paldi, Ahmedabad, 380007';

return [
    'email' => env('RUCHI_EMAIL', 'Info.ruchi11@gmail.com'),
    'phone' => env('RUCHI_PHONE', '7490828282'),
    'phone_display' => '+91 '.env('RUCHI_PHONE', '7490828282'),
    'address' => env('RUCHI_ADDRESS', $address),
    'address_speech' => 'Shri Hari apartment, seventeen vasantkunj Society, New Sharda Mandir Road, Paldi, Ahmedabad.',
    'whatsapp' => '91'.env('RUCHI_PHONE', '7490828282'),
    'whatsapp_url' => 'https://wa.me/91'.env('RUCHI_PHONE', '7490828282'),
    'tel_url' => 'tel:+91'.env('RUCHI_PHONE', '7490828282'),
    'maps_embed_url' => 'https://maps.google.com/maps?q='.rawurlencode(env('RUCHI_ADDRESS', $address)).'&t=&z=15&ie=UTF8&iwloc=&output=embed',
    'maps_search_url' => 'https://www.google.com/maps/search/?api=1&query='.rawurlencode(env('RUCHI_ADDRESS', $address)),
    'instagram_url' => env('RUCHI_INSTAGRAM_URL', 'https://www.instagram.com/ruchichocolates09/'),
    'facebook_url' => env('RUCHI_FACEBOOK_URL', 'https://www.facebook.com/RuchiHomemadeChocolates'),
];
