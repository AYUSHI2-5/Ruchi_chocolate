{{-- Search Form Component --}}
<form action="{{ route('search') }}" method="GET" role="search" class="rc-search-form">
    <input 
        type="text" 
        name="q" 
        placeholder="Search for chocolates, gifts & more..." 
        aria-label="Search" 
        class="rc-search-input" 
        value="{{ request('q', $searchQuery ?? '') }}"
        autocomplete="off"
    >
    <button type="submit" class="rc-search-button" aria-label="Submit Search">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
    </button>
</form>
