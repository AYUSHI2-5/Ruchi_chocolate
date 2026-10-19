<?php

use App\Http\Controllers\AiAssistantController;
use App\Http\Controllers\NewArrivalsController;
use App\Http\Controllers\TrendingController;
use App\Services\ContactWhatsAppInquiry;
use App\Services\ProductCatalogService;
use App\Services\ProductWhatsAppInquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/search', function (Request $request) {
    $query = $request->query('q', '');

    return view('home', ['searchQuery' => $query]);
})->name('search');

Route::get('/new-arrivals', [NewArrivalsController::class, 'index'])->name('new-arrivals');
Route::get('/products', [NewArrivalsController::class, 'index'])->name('products');

Route::get('/trending', [TrendingController::class, 'index'])->name('trending');
Route::get('/customised-gifts', function () {
    return view('customised-gifts');
})->name('customised-gifts');

Route::get('/customize', function () {
    return redirect()->route('customised-gifts');
});

Route::get('/customise', function () {
    return redirect()->route('customised-gifts');
});

Route::get('/catalog', function () {
    return redirect()->route('home');
})->name('catalog');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', function (Request $request, ContactWhatsAppInquiry $contactWhatsApp) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:50',
        'subject' => 'required|string|max:255',
        'message' => 'required|string|max:5000',
    ]);

    return redirect()->away($contactWhatsApp->buildInquiryUrl($validated));
})->name('contact.submit');

Route::get('/offers', function () {
    return redirect()->route('home');
})->name('offers');

Route::get('/account', function () {
    return redirect()->route('home');
})->name('account');

Route::get('/wishlist', function () {
    return redirect()->route('home');
})->name('wishlist');

Route::get('/cart', function () {
    return redirect()->route('home');
})->name('cart');

Route::get('/track-order', function () {
    return redirect()->route('home');
})->name('track-order');

Route::get('/support', function () {
    return redirect()->route('home');
})->name('support');

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy-policy');

Route::get('/terms-and-conditions', function () {
    return view('terms-and-conditions');
})->name('terms-and-conditions');

Route::get('/terms', function () {
    return redirect()->route('terms-and-conditions');
});

Route::get('/api/products/{id}', function (string $id, ProductCatalogService $catalog, ProductWhatsAppInquiry $inquiry) {
    $product = $catalog->getProductById($id);

    if (! $product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    return response()->json($inquiry->enrichProductForApi($product));
})->name('api.product');

Route::post('/api/ai/chat', [AiAssistantController::class, 'chat'])->name('api.ai.chat');
Route::post('/ai/chat', [AiAssistantController::class, 'chat']);
