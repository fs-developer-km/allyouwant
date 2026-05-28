<?php
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
    public function index(Request $request)
    {
        $query = Product::with('category')->latest();
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                  ->orWhere('sku', 'like', '%'.$request->search.'%');
            });
        }
        if ($request->category) $query->where('category_id', $request->category);
        if ($request->status !== null && $request->status !== '') $query->where('is_active', $request->status);
        if ($request->stock === 'low') $query->whereColumn('stock_quantity', '<=', 'low_stock_alert');
        elseif ($request->stock === 'out') $query->where('stock_quantity', 0);

        $products   = $query->paginate(15)->withQueryString();
        $categories = Category::active()->get();
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::active()->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:200',
            'category_id'    => 'required|exists:categories,id',
            'price'          => 'required|numeric|min:0',
            'sale_price'     => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'unit'           => 'required|string|max:20',
            'thumbnail'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'images.*'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'sku'            => 'nullable|string|max:100|unique:products,sku',
        ]);

        $data = $request->only([
            'name','category_id','description','short_description',
            'sku','price','sale_price','stock_quantity','unit',
            'weight','low_stock_alert','tax_percent',
        ]);

        // Clean empty sale_price
        if (empty($data['sale_price'])) $data['sale_price'] = null;

        $data['slug']           = $this->uniqueSlug($request->name);
        $data['is_active']      = $request->has('is_active')      ? 1 : 0;
        $data['is_featured']    = $request->has('is_featured')    ? 1 : 0;
        $data['is_bestseller']  = $request->has('is_bestseller')  ? 1 : 0;
        $data['is_new_arrival'] = $request->has('is_new_arrival') ? 1 : 0;
        $data['track_inventory']= $request->has('track_inventory')? 1 : 0;

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $file = $request->file('thumbnail');
            $filename = time().'_'.Str::slug($request->name).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('products/thumbnails', $filename, 'public');
            $data['thumbnail'] = $path;
        }

        $product = Product::create($data);

        // Handle gallery images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $i => $img) {
                if ($img->isValid()) {
                    $filename = time().'_'.$i.'_'.$product->id.'.'.$img->getClientOriginalExtension();
                    $path = $img->storeAs('products/gallery', $filename, 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image'      => $path,
                        'sort_order' => $i,
                    ]);
                }
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product "'.$product->name.'" created successfully! ✅');
    }

    public function edit(Product $product)
    {
        $categories = Category::active()->get();
        $product->load('images');
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // IMPORTANT: Using POST for update (not PUT) to support file uploads
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'           => 'required|string|max:200',
            'category_id'    => 'required|exists:categories,id',
            'price'          => 'required|numeric|min:0',
            'sale_price'     => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'unit'           => 'required|string|max:20',
            'thumbnail'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'images.*'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'sku'            => 'nullable|string|max:100|unique:products,sku,'.$product->id,
        ]);

        $data = $request->only([
            'name','category_id','description','short_description',
            'sku','price','sale_price','stock_quantity','unit',
            'weight','low_stock_alert','tax_percent',
        ]);

        if (empty($data['sale_price'])) $data['sale_price'] = null;

        $data['slug']           = $this->uniqueSlug($request->name, $product->id);
        $data['is_active']      = $request->has('is_active')      ? 1 : 0;
        $data['is_featured']    = $request->has('is_featured')    ? 1 : 0;
        $data['is_bestseller']  = $request->has('is_bestseller')  ? 1 : 0;
        $data['is_new_arrival'] = $request->has('is_new_arrival') ? 1 : 0;
        $data['track_inventory']= $request->has('track_inventory')? 1 : 0;

        // New thumbnail
        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            // Delete old thumbnail
            if ($product->thumbnail && Storage::disk('public')->exists($product->thumbnail)) {
                Storage::disk('public')->delete($product->thumbnail);
            }
            $file = $request->file('thumbnail');
            $filename = time().'_'.Str::slug($request->name).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('products/thumbnails', $filename, 'public');
            $data['thumbnail'] = $path;
        }

        $product->update($data);

        // Additional gallery images
        if ($request->hasFile('images')) {
            $maxOrder = $product->images()->max('sort_order') ?? -1;
            foreach ($request->file('images') as $i => $img) {
                if ($img->isValid()) {
                    $filename = time().'_'.$i.'_'.$product->id.'.'.$img->getClientOriginalExtension();
                    $path = $img->storeAs('products/gallery', $filename, 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image'      => $path,
                        'sort_order' => $maxOrder + $i + 1,
                    ]);
                }
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully! ✅');
    }

    public function destroy(Product $product)
    {
        if ($product->thumbnail && Storage::disk('public')->exists($product->thumbnail)) {
            Storage::disk('public')->delete($product->thumbnail);
        }
        foreach ($product->images as $img) {
            if (Storage::disk('public')->exists($img->image)) {
                Storage::disk('public')->delete($img->image);
            }
        }
        $product->images()->delete();
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted!');
    }

    public function toggleStatus(Product $product)
    {
        $product->update(['is_active' => !$product->is_active]);
        return response()->json([
            'success' => true,
            'status'  => $product->is_active,
            'message' => 'Product '.($product->is_active ? 'activated' : 'deactivated'),
        ]);
    }

    public function deleteImage(ProductImage $image)
    {
        if (Storage::disk('public')->exists($image->image)) {
            Storage::disk('public')->delete($image->image);
        }
        $image->delete();
        return response()->json(['success' => true, 'message' => 'Image deleted']);
    }

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug  = Str::slug($name);
        $query = Product::where('slug', $slug);
        if ($ignoreId) $query->where('id', '!=', $ignoreId);
        if ($query->exists()) $slug = $slug.'-'.time();
        return $slug;
    }
}