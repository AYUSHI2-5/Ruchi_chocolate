<?php

namespace App\Http\Controllers;

use App\Services\ProductCatalogService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TrendingController extends Controller
{
    public function __construct(
        protected ProductCatalogService $catalogService
    ) {}

    /**
     * Display the Trending chocolates and gifts catalog page.
     */
    public function index(Request $request): View
    {
        // 1. Fetch only trending products
        $trendingProducts = $this->catalogService->getTrendingProducts();
        $totalTrendingCount = count($trendingProducts);

        // 2. Categories with counts scoped to trending items
        $categories = $this->catalogService->getCategories($trendingProducts);
        $occasions = $this->catalogService->getOccasions();

        $products = $trendingProducts;

        // 3. Filter by category if requested
        $selectedCategory = $request->query('category');
        if ($selectedCategory) {
            $products = array_values(array_filter($products, function ($item) use ($selectedCategory) {
                return strtolower($item['category']) === strtolower($selectedCategory);
            }));
        }

        // 4. Filter by occasion if requested
        $selectedOccasion = $request->query('occasion');
        if ($selectedOccasion) {
            $products = array_values(array_filter($products, function ($item) use ($selectedOccasion) {
                if (in_array(strtolower($selectedOccasion), ['occasions', 'all', '1', 'true'])) {
                    return ! empty($item['occasions']) || in_array(strtolower($item['category']), ['occasions', 'gift-hampers', 'bouquets', 'combos']);
                }

                return in_array(strtolower($selectedOccasion), array_map('strtolower', $item['occasions'] ?? []));
            }));
        }

        // 5. Filter by availability if requested
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

        // 6. Filter by price range if requested
        $minPrice = $request->query('min_price', 100);
        $maxPrice = $request->query('max_price', 1000);
        if ($request->has('min_price') || $request->has('max_price')) {
            $products = array_values(array_filter($products, function ($item) use ($minPrice, $maxPrice) {
                return $item['price'] >= (float) $minPrice && $item['price'] <= (float) $maxPrice;
            }));
        }

        // 7. Sorting
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

        // 8. Filtered count & Pagination
        $filteredCount = count($products);
        $page = max(1, (int) $request->query('page', 1));
        $perPage = 16;
        $totalPages = max(1, (int) ceil($filteredCount / $perPage));
        $page = min($page, $totalPages);
        $offset = ($page - 1) * $perPage;
        $paginatedProducts = array_slice($products, $offset, $perPage);

        return view('trending', [
            'products' => $paginatedProducts,
            'allProducts' => $products,
            'totalItemsCount' => $totalTrendingCount,
            'filteredCount' => $filteredCount,
            'categories' => $categories,
            'occasions' => $occasions,
            'selectedCategory' => $selectedCategory,
            'selectedOccasion' => $selectedOccasion,
            'selectedAvailability' => $selectedAvailability,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'sort' => $sort,
            'currentPage' => $page,
            'totalPages' => $totalPages,
        ]);
    }
}
