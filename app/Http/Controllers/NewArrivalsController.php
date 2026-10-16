<?php

namespace App\Http\Controllers;

use App\Services\ProductCatalogService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewArrivalsController extends Controller
{
    public function __construct(
        protected ProductCatalogService $catalogService
    ) {}

    /**
     * Display the New Arrivals product catalog page.
     */
    public function index(Request $request): View
    {
        $allProducts = $this->catalogService->getAllProducts();
        $totalItemsCount = count($allProducts);

        $mainCategorySections = $this->catalogService->getMainCategorySections($allProducts);
        $categories = $this->catalogService->getCategories($allProducts);
        $occasionGroups = $this->catalogService->getOccasionGroups();
        $occasions = $this->catalogService->getOccasions();

        $products = $allProducts;

        // Filter by category / subcategory if requested
        $selectedCategory = $request->query('category');
        $comingSoonFestivalSlug = null;
        $comingSoonFestivalName = null;

        if (is_string($selectedCategory) && $selectedCategory !== '') {
            $categorySlug = strtolower(trim($selectedCategory));
            if ($this->catalogService->isFestivalComingSoon($categorySlug)) {
                $comingSoonFestivalSlug = $categorySlug;
                $comingSoonFestivalName = $this->catalogService->getFestivalDisplayName($categorySlug);
            }
        }

        if ($selectedCategory && $comingSoonFestivalSlug === null) {
            $catLower = strtolower($selectedCategory);
            if ($catLower === 'gifting') {
                $products = array_values(array_filter($products, function ($item) {
                    return in_array(strtolower($item['category']), ['chocolates', 'gift-hampers', 'bouquets', 'combos'])
                        || ! empty($item['occasions']);
                }));
            } elseif (in_array($catLower, ['chocolates', 'gift-hampers', 'bouquets', 'combos'])) {
                $products = array_values(array_filter($products, function ($item) use ($catLower) {
                    return strtolower($item['category']) === $catLower;
                }));
            } elseif ($catLower === 'rakhi') {
                $products = array_values(array_filter($products, function ($item) {
                    $itemOccs = array_map('strtolower', $item['occasions'] ?? []);

                    return in_array('rakhi', $itemOccs) || in_array('raksha-bandhan', $itemOccs);
                }));
            } elseif ($catLower === 'ring-ceremony') {
                $products = array_values(array_filter($products, function ($item) {
                    $itemOccs = array_map('strtolower', $item['occasions'] ?? []);

                    return in_array('ring-ceremony', $itemOccs);
                }));
            } elseif (in_array($catLower, ['valentine', 'valentines-day'])) {
                $products = array_values(array_filter($products, function ($item) {
                    $itemOccs = array_map('strtolower', $item['occasions'] ?? []);

                    return in_array('valentine', $itemOccs) || in_array('valentines-day', $itemOccs);
                }));
            } elseif ($catLower === 'new-born') {
                $products = array_values(array_filter($products, function ($item) {
                    $itemOccs = array_map('strtolower', $item['occasions'] ?? []);

                    return in_array('new-born', $itemOccs);
                }));
            } else {
                $products = array_values(array_filter($products, function ($item) use ($catLower) {
                    $itemOccs = array_map('strtolower', $item['occasions'] ?? []);

                    return in_array($catLower, $itemOccs) || strtolower($item['category']) === $catLower;
                }));
            }
        }

        // Filter by occasion(s) if requested (supports array, comma-separated string, or single string)
        $rawOccasion = $request->query('occasion');
        $selectedOccasions = [];
        if (is_array($rawOccasion)) {
            $selectedOccasions = array_values(array_filter(array_map('trim', $rawOccasion)));
        } elseif (is_string($rawOccasion) && trim($rawOccasion) !== '') {
            $trimmed = trim($rawOccasion);
            if (in_array(strtolower($trimmed), ['occasions', 'all', '1', 'true'])) {
                $selectedOccasions = ['occasions'];
            } else {
                $selectedOccasions = array_values(array_filter(array_map('trim', explode(',', $trimmed))));
            }
        }
        $selectedOccasionsLower = array_map('strtolower', $selectedOccasions);

        if ($comingSoonFestivalSlug === null && ! empty($selectedOccasionsLower)) {
            foreach ($selectedOccasionsLower as $occSlug) {
                if ($this->catalogService->isFestivalComingSoon($occSlug)) {
                    $comingSoonFestivalSlug = $occSlug;
                    $comingSoonFestivalName = $this->catalogService->getFestivalDisplayName($occSlug);
                    break;
                }
            }
        }

        if (! empty($selectedOccasionsLower) && $comingSoonFestivalSlug === null) {
            $products = array_values(array_filter($products, function ($item) use ($selectedOccasionsLower) {
                if (in_array('occasions', $selectedOccasionsLower)) {
                    return ! empty($item['occasions']) || in_array(strtolower($item['category']), ['occasions', 'gift-hampers', 'bouquets', 'combos']);
                }

                $itemOccasions = array_map('strtolower', $item['occasions'] ?? []);
                foreach ($selectedOccasionsLower as $occSlug) {
                    if ($occSlug === 'rakhi' && (in_array('rakhi', $itemOccasions) || in_array('raksha-bandhan', $itemOccasions))) {
                        return true;
                    }
                    if ($occSlug === 'ring-ceremony' && in_array('ring-ceremony', $itemOccasions)) {
                        return true;
                    }
                    if (in_array($occSlug, ['valentine', 'valentines-day']) && (in_array('valentine', $itemOccasions) || in_array('valentines-day', $itemOccasions))) {
                        return true;
                    }
                    if (in_array($occSlug, $itemOccasions)) {
                        return true;
                    }
                }

                return false;
            }));
        }

        if ($comingSoonFestivalSlug !== null) {
            $products = [];
        }

        $categoryFilterSlug = is_string($selectedCategory) ? strtolower(trim($selectedCategory)) : '';
        $activeSubcategory = null;
        if ($categoryFilterSlug !== '') {
            $activeSubcategory = $categoryFilterSlug;
        } elseif (! empty($selectedOccasionsLower)) {
            $activeSubcategory = $selectedOccasionsLower[0];
        }

        // Filter by availability if requested
        $selectedAvailability = $request->query('availability');
        if ($selectedAvailability) {
            $products = array_values(array_filter($products, function ($item) use ($selectedAvailability) {
                if ($selectedAvailability === 'in_stock') {
                    return $item['in_stock'] === true;
                }
                if ($selectedAvailability === 'out_of_stock') {
                    return $item['in_stock'] === false;
                }

                return true;
            }));
        }

        // Filter by price range if requested
        $minPrice = $request->query('min_price', 100);
        $maxPrice = $request->query('max_price', 1000);
        if ($request->has('min_price') || $request->has('max_price')) {
            $products = array_values(array_filter($products, function ($item) use ($minPrice, $maxPrice) {
                return $item['price'] >= (float) $minPrice && $item['price'] <= (float) $maxPrice;
            }));
        }

        // Sorting
        $sort = $request->query('sort', 'featured');
        switch ($sort) {
            case 'price_low_high':
                usort($products, fn ($a, $b) => $a['price'] <=> $b['price']);
                break;
            case 'price_high_low':
                usort($products, fn ($a, $b) => $b['price'] <=> $a['price']);
                break;
            case 'rating':
                usort($products, fn ($a, $b) => $b['rating'] <=> $a['rating']);
                break;
            case 'newest':
                usort($products, fn ($a, $b) => strcmp($b['id'], $a['id']));
                break;
            default: // featured
                break;
        }

        // Filtered count & Pagination
        $filteredCount = count($products);
        $page = max(1, (int) $request->query('page', 1));
        $perPage = 16;
        $totalPages = max(1, (int) ceil($filteredCount / $perPage));
        $page = min($page, $totalPages);
        $offset = ($page - 1) * $perPage;
        $paginatedProducts = array_slice($products, $offset, $perPage);

        return view('new-arrivals', [
            'products' => $paginatedProducts,
            'allProducts' => $products,
            'totalItemsCount' => $totalItemsCount,
            'filteredCount' => $filteredCount,
            'mainCategorySections' => $mainCategorySections,
            'activeSubcategory' => $activeSubcategory,
            'categories' => $categories,
            'occasionGroups' => $occasionGroups,
            'occasions' => $occasions,
            'selectedCategory' => $selectedCategory,
            'selectedOccasion' => is_string($rawOccasion) ? $rawOccasion : implode(',', $selectedOccasions),
            'selectedOccasions' => $selectedOccasionsLower,
            'selectedAvailability' => $selectedAvailability,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'sort' => $sort,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'comingSoonFestivalSlug' => $comingSoonFestivalSlug,
            'comingSoonFestivalName' => $comingSoonFestivalName,
        ]);
    }
}
