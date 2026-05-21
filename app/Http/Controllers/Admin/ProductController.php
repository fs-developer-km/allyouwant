<?php
// app/Http/Controllers/Admin/ProductController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // ── List all products ────────────────────────
    public function index(Request $request)
    {
        $query = Product::with('category')->latest();

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('sku', 'like', '%' . $request->search . '%');
        }
        if ($request->category) {
            $query->where('category_id', $request->category);
        }
        if ($request->status !== null && $request->status !== '') {
            $query->where('is_active', $request->status);
        }
        if ($request->stock === 'low') {
            $query->whereColumn('stock_quantity', '<=', 'low_stock_alert');
        } elseif ($request->stock === 'out') {
            $query->where('stock_quantity', 0);
        }

        $products   = $query->paginate(15)->withQueryString();
        $categories = Category::active()->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    // ── Show create form ─────────────────────────
    public function create()
    {
        $categories = Category::active()->get();
        return view('admin.products.create', compact('categories'));
    }

    // ── Store new product ────────────────────────
    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:200',
            'category_id'    => 'required|exists:categories,id',
            'price'          => 'required|numeric|min:0',
            'sale_price'     => 'nullable|numeric|min:0|lt:price',
            'stock_quantity' => 'required|integer|min:0',
            'unit'           => 'required|string|max:20',
            'description'    => 'nullable|string',
            'thumbnail'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'images.*'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sku'            => 'nullable|string|max:100|unique:products,sku',
        ]);

        $data = $request->only([
            'name','category_id','description','short_description',
            'sku','price','sale_price','stock_quantity','unit',
            'weight','low_stock_alert','tax_percent',
        ]);

        $data['slug']          = $this->uniqueSlug($request->name);
        $data['is_active']     = $request->has('is_active');
        $data['is_featured']   = $request->has('is_featured');
        $data['is_bestseller'] = $request->has('is_bestseller');
        $data['is_new_arrival']= $request->has('is_new_arrival');
        $data['track_inventory']= $request->has('track_inventory');

        // Thumbnail
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')
                ->store('products/thumbnails', 'public');
        }

        $product = Product::create($data);

        // Additional images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $i => $img) {
                $path = $img->store('products/gallery', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image'      => $path,
                    'sort_order' => $i,
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product "' . $product->name . '" created successfully!');
    }

    // ── Show edit form ───────────────────────────
    public function edit(Product $product)
    {
        $categories = Category::active()->get();
        $product->load('images');
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // ── Update product ───────────────────────────
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'           => 'required|string|max:200',
            'category_id'    => 'required|exists:categories,id',
            'price'          => 'required|numeric|min:0',
            'sale_price'     => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'unit'           => 'required|string|max:20',
            'thumbnail'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'images.*'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sku'            => 'nullable|string|max:100|unique:products,sku,' . $product->id,
        ]);

        $data = $request->only([
            'name','category_id','description','short_description',
            'sku','price','sale_price','stock_quantity','unit',
            'weight','low_stock_alert','tax_percent',
        ]);

        $data['slug']           = $this->uniqueSlug($request->name, $product->id);
        $data['is_active']      = $request->has('is_active');
        $data['is_featured']    = $request->has('is_featured');
        $data['is_bestseller']  = $request->has('is_bestseller');
        $data['is_new_arrival'] = $request->has('is_new_arrival');
        $data['track_inventory']= $request->has('track_inventory');

        // New thumbnail
        if ($request->hasFile('thumbnail')) {
            if ($product->thumbnail) {
                Storage::disk('public')->delete($product->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')
                ->store('products/thumbnails', 'public');
        }

        $product->update($data);

        // Additional gallery images
        if ($request->hasFile('images')) {
            $maxOrder = $product->images()->max('sort_order') ?? -1;
            foreach ($request->file('images') as $i => $img) {
                $path = $img->store('products/gallery', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image'      => $path,
                    'sort_order' => $maxOrder + $i + 1,
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully!');
    }

    // ── Delete product ───────────────────────────
    public function destroy(Product $product)
    {
        // Delete thumbnail
        if ($product->thumbnail) {
            Storage::disk('public')->delete($product->thumbnail);
        }
        // Delete gallery images
        foreach ($product->images as $img) {
            Storage::disk('public')->delete($img->image);
        }
        $product->images()->delete();
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully!');
    }

    // ── Toggle active status ─────────────────────
    public function toggleStatus(Product $product)
    {
        $product->update(['is_active' => !$product->is_active]);
        return response()->json([
            'success' => true,
            'status'  => $product->is_active,
            'message' => 'Product ' . ($product->is_active ? 'activated' : 'deactivated'),
        ]);
    }

    // ── Delete single gallery image ───────────────
    public function deleteImage(ProductImage $image)
    {
        Storage::disk('public')->delete($image->image);
        $image->delete();
        return response()->json(['success' => true]);
    }

    // ── Unique slug helper ───────────────────────
    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $query = Product::where('slug', $slug);
        if ($ignoreId) $query->where('id', '!=', $ignoreId);
        if ($query->exists()) {
            $slug = $slug . '-' . time();
        }
        return $slug;
    }
}