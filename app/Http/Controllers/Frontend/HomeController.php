<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Banner;

class HomeController extends Controller
{
    public function index()
    {
        $banners    = Banner::active()->get();
        $categories = Category::active()->homepage()->ordered()->get();
        $featured   = Product::active()->featured()->inStock()->with('category')->take(10)->get();
        $bestsellers= Product::active()->bestseller()->inStock()->with('category')->take(10)->get();
        $newArrivals= Product::active()->newArrival()->inStock()->with('category')->take(6)->get();
        return view('frontend.home', compact('banners','categories','featured','bestsellers','newArrivals'));
    }
}
