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
        // ── Step 1: Find the category by slug ──────────────────────────────
        // Could be a parent OR a sub-category
        $category = Category::where('slug', $slug)->active()->firstOrFail();

        // ── Step 2: Determine if this is parent or sub-category ────────────
        $isSubCategory  = !is_null($category->parent_id);
        $parentCategory = $isSubCategory ? $category->parent : null;

        // ── Step 3: Load sub-categories for sidebar ────────────────────────
        if ($isSubCategory) {
            // User is on a sub-category → show siblings (other sub-cats of same parent)
            $subCategories = Category::where('parent_id', $category->parent_id)
                ->active()
                ->withCount('activeProducts')
                ->orderBy('sort_order')
                ->get();
        } else {
            // User is on a parent category → show its children
            $subCategories = Category::where('parent_id', $category->id)
                ->active()
                ->withCount('activeProducts')
                ->orderBy('sort_order')
                ->get();
        }

        $hasSubCategories = $subCategories->count() > 0;

        // ── Step 4: Determine which category_ids to show products from ─────
        $sub = request('sub'); // sub-category slug from URL ?sub=soft-drinks

        if ($isSubCategory) {
            // Already on sub-category page → show only this category's products
            $productCategoryIds = [$category->id];
            $activeSubSlug      = $category->slug;
        } elseif ($sub) {
            // Parent page + ?sub=slug filter
            $subCat = $subCategories->where('slug', $sub)->first();
            if ($subCat) {
                $productCategoryIds = [$subCat->id];
                $activeSubSlug      = $sub;
            } else {
                // Invalid sub slug → show all
                $productCategoryIds = $hasSubCategories
                    ? $subCategories->pluck('id')->push($category->id)->toArray()
                    : [$category->id];
                $activeSubSlug = null;
            }
        } else {
            // Parent page, no sub filter → show ALL (parent + all children)
            if ($hasSubCategories) {
                $productCategoryIds = $subCategories->pluck('id')
                    ->push($category->id) // also include products directly under parent
                    ->toArray();
            } else {
                $productCategoryIds = [$category->id];
            }
            $activeSubSlug = null;
        }

        // ── Step 5: Build product query ────────────────────────────────────
        $query = Product::whereIn('category_id', $productCategoryIds)
            ->active()
            ->with(['category', 'approvedReviews']);

        // Price filter
        if ($request->filled('min_price')) {
            $query->where(function ($q) use ($request) {
                $q->whereNotNull('sale_price')
                  ->where('sale_price', '>=', $request->min_price)
                  ->orWhere(function ($q2) use ($request) {
                      $q2->whereNull('sale_price')->where('price', '>=', $request->min_price);
                  });
            });
        }
        if ($request->filled('max_price')) {
            $query->where(function ($q) use ($request) {
                $q->whereNotNull('sale_price')
                  ->where('sale_price', '<=', $request->max_price)
                  ->orWhere(function ($q2) use ($request) {
                      $q2->whereNull('sale_price')->where('price', '<=', $request->max_price);
                  });
            });
        }

        // Availability filter
        if ($request->filter === 'instock')    $query->where('stock_quantity', '>', 0);
        if ($request->filter === 'sale')       $query->whereNotNull('sale_price');
        if ($request->filter === 'new')        $query->where('is_new_arrival', true);
        if ($request->filter === 'bestseller') $query->where('is_bestseller', true);

        // Sort
        switch ($request->get('sort', 'default')) {
            case 'price_asc':  $query->orderByRaw('COALESCE(sale_price, price) ASC'); break;
            case 'price_desc': $query->orderByRaw('COALESCE(sale_price, price) DESC'); break;
            case 'newest':     $query->latest(); break;
            case 'name_asc':   $query->orderBy('name'); break;
            default:           $query->orderBy('sort_order')->latest(); break;
        }

        $products      = $query->paginate(16)->withQueryString();
        $allCategories = Category::active()->get();

        return view('frontend.category', compact(
            'category',
            'products',
            'allCategories',
            'subCategories',
            'hasSubCategories',
            'isSubCategory',
            'parentCategory',
            'activeSubSlug'
        ));
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



