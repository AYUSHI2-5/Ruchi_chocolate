@extends('layouts.app')

@section('title', 'Ruchi Chocolates | Handmade Chocolates & Gift Hampers')
@section('meta_description', 'Discover handmade chocolates, chocolate bouquets and gift hampers from Ruchi Chocolates. Explore thoughtful gifts for birthdays, anniversaries and special occasions.')

@section('content')
{{-- Home Hero Section: Slideshow Banner with Overlapping Features Strip --}}
@include('components.home.hero-banner')

{{-- Section 3: Shop by Category --}}
@include('components.home.category-circles')

{{-- Section 6: Best Sellers --}}
@include('components.home.best-sellers')

{{-- Section 7: Spread Happiness Promotional Banner + Service Trust Strip --}}
@include('components.home.spread-happiness')

{{-- Floating WhatsApp Chat Action --}}
@include('components.home.whatsapp-button')

@if(isset($searchQuery) && $searchQuery !== '')
    <div class="content-preview-container">
        <div class="search-feedback-banner">
            <p>Showing search results for: <strong>"{{ $searchQuery }}"</strong></p>
            <a href="{{ route('home') }}" class="clear-search-link">&larr; Clear Search</a>
        </div>
    </div>
@endif
@endsection

