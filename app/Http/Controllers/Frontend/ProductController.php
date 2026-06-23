<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Home page — pass categories + featured + bestsellers
     * NOTE: 'categories' variable already passed from HomeController.
     * If you use a separate HomeController, add $allCategories = Category::active()->get()
     * and pass it along. See home() method below for reference.
     */
    public function home()
    {
        $categories  = Category::active()->withCount(['activeProducts'])->get();
        $featured    = Product::active()->where('is_featured', true)->with(['category','approvedReviews'])->take(12)->get();
        $bestsellers = Product::active()->where('is_bestseller', true)->with('category')->take(6)->get();

        return view('frontend.home', compact('categories', 'featured', 'bestsellers'));
    }


        // ── All Categories Page ──────────────────────────────────
    public function allCategories()
    {
        $categories = Category::active()
            ->withCount(['activeProducts'])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('frontend.all-categories', compact('categories'));
    }

    /**
     * Category page — FIX: pass $allCategories for navbar/sidebar
     */
    public function category(Request $request, $slug)
    {
        $category      = Category::where('slug', $slug)->active()->firstOrFail();
        $allCategories = Category::active()->get(); // needed for navbar & sidebar

        // Sorting
        $query = Product::where('category_id', $category->id)
            ->active()
            ->with(['category', 'approvedReviews']);

        // Price filter
        if ($request->filled('min_price')) {
            $query->where(function($q) use ($request) {
                $q->whereNotNull('sale_price')
                  ->where('sale_price', '>=', $request->min_price)
                  ->orWhere(function($q2) use ($request) {
                      $q2->whereNull('sale_price')->where('price', '>=', $request->min_price);
                  });
            });
        }
        if ($request->filled('max_price')) {
            $query->where(function($q) use ($request) {
                $q->whereNotNull('sale_price')
                  ->where('sale_price', '<=', $request->max_price)
                  ->orWhere(function($q2) use ($request) {
                      $q2->whereNull('sale_price')->where('price', '<=', $request->max_price);
                  });
            });
        }

        // Sort
        switch ($request->get('sort', 'default')) {
            case 'price_asc':
                $query->orderByRaw('COALESCE(sale_price, price) ASC');
                break;
            case 'price_desc':
                $query->orderByRaw('COALESCE(sale_price, price) DESC');
                break;
            case 'newest':
                $query->latest();
                break;
            case 'name_asc':
                $query->orderBy('name');
                break;
            default:
                $query->orderBy('sort_order')->latest();
                break;
        }

        $products = $query->paginate(16)->withQueryString();

        return view('frontend.category', compact('category', 'products', 'allCategories'));
    }

    /**
     * Offers page — FIX: pass $allCategories for navbar
     */
    public function offers()
    {
        $allCategories = Category::active()->get();
        $products      = Product::active()
            ->whereNotNull('sale_price')
            ->with('category')
            ->paginate(16);

        return view('frontend.offers', compact('products', 'allCategories'));
    }

    /**
     * Search page
     */
    public function search(Request $request)
    {
        $q             = $request->get('q', '');
        $categoryId    = $request->get('category');
        $allCategories = Category::active()->get();

        $query = Product::active()->with('category');

        if ($q) {
            $query->where(function ($builder) use ($q) {
                $builder->where('name', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%");
            });
        }

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $products = $query->paginate(16)->withQueryString();

        return view('frontend.search', compact('products', 'q', 'allCategories'));
    }

    /**
     * Single product page
     */
    public function show($slug)
    {
        $product       = Product::where('slug', $slug)->active()->with(['category', 'approvedReviews'])->firstOrFail();
        $related       = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->active()
            ->take(6)
            ->get();
        $allCategories = Category::active()->get();

        return view('frontend.product-detail', compact('product', 'related', 'allCategories'));
    }

    public function index(Request $request)
{
    $allCategories = Category::active()->get();
    $categories = Category::active()->withCount(['activeProducts'])->get(); // ← YEH ADD KARO

    $query = Product::active()->with(['category', 'approvedReviews']);

    // Category filter
    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }

    // Price filter
    if ($request->filled('min_price')) {
        $query->where('price', '>=', $request->min_price);
    }
    if ($request->filled('max_price')) {
        $query->where('price', '<=', $request->max_price);
    }

    // Sort
    switch ($request->get('sort')) {
        case 'price_asc':  $query->orderByRaw('COALESCE(sale_price, price) ASC'); break;
        case 'price_desc': $query->orderByRaw('COALESCE(sale_price, price) DESC'); break;
        case 'bestseller': $query->where('is_bestseller', true)->latest(); break;
        case 'newest':     $query->latest(); break;
        default:           $query->latest(); break;
    }

    $products = $query->paginate(16)->withQueryString();

    return view('frontend.shop', compact('products', 'categories', 'allCategories')); // ← categories pass karo
}
}



