<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::active()->with('category');
        if ($request->category) $query->where('category_id',$request->category);
        if ($request->min_price) $query->where('price','>=',$request->min_price);
        if ($request->max_price) $query->where('price','<=',$request->max_price);
        if ($request->sort === 'price_asc')  $query->orderBy('price');
        elseif ($request->sort === 'price_desc') $query->orderByDesc('price');
        elseif ($request->sort === 'newest') $query->latest();
        else $query->latest();
        $products   = $query->paginate(16)->withQueryString();
        $categories = Category::active()->withCount('activeProducts')->get();
        return view('frontend.shop', compact('products','categories'));
    }

    public function show($slug)
    {
        $product  = Product::where('slug',$slug)->active()->with(['category','images','approvedReviews.user'])->firstOrFail();
        $related  = Product::where('category_id',$product->category_id)->active()->where('id','!=',$product->id)->take(6)->get();
        $product->increment('views');
        return view('frontend.product-detail', compact('product','related'));
    }

    public function category($slug)
    {
        $category = Category::where('slug',$slug)->active()->firstOrFail();
        $products = Product::where('category_id',$category->id)->active()->with('category')->paginate(16);
        return view('frontend.category', compact('category','products'));
    }

    public function offers()
    {
        $products = Product::active()->whereNotNull('sale_price')->with('category')->paginate(16);
        return view('frontend.offers', compact('products'));
    }

    public function search(Request $request)
    {
        $q        = $request->get('q','');
        $products = Product::active()->where('name','like',"%{$q}%")->with('category')->paginate(16);
        return view('frontend.search', compact('products','q'));
    }
}
