<?php
// app/Http/Controllers/Admin/CategoryController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    // ── List all categories ──────────────────────
    public function index(Request $request)
    {
        $query = Category::withCount('products')->latest();

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->status !== null && $request->status !== '') {
            $query->where('is_active', $request->status);
        }

        $categories = $query->paginate(15)->withQueryString();

        return view('admin.categories.index', compact('categories'));
    }

    // ── Show create form ─────────────────────────
    public function create()
    {
        $parents = Category::whereNull('parent_id')->active()->get();
        return view('admin.categories.create', compact('parents'));
    }

    // ── Store new category ───────────────────────
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:100|unique:categories,name',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'description' => 'nullable|string|max:500',
            'parent_id'   => 'nullable|exists:categories,id',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        $data = $request->only(['name', 'description', 'parent_id', 'sort_order']);
        $data['slug']            = Str::slug($request->name);
        $data['is_active']       = $request->has('is_active');
        $data['show_on_homepage'] = $request->has('show_on_homepage');

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('categories', 'public');
        }

        Category::create($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category "' . $data['name'] . '" successfully created!');
    }

    // ── Show edit form ───────────────────────────
    public function edit(Category $category)
    {
        $parents = Category::whereNull('parent_id')
            ->where('id', '!=', $category->id)
            ->active()->get();

        return view('admin.categories.edit', compact('category', 'parents'));
    }

    // ── Update category ──────────────────────────
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'        => 'required|string|max:100|unique:categories,name,' . $category->id,
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'description' => 'nullable|string|max:500',
            'parent_id'   => 'nullable|exists:categories,id',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        $data = $request->only(['name', 'description', 'parent_id', 'sort_order']);
        $data['slug']            = Str::slug($request->name);
        $data['is_active']       = $request->has('is_active');
        $data['show_on_homepage'] = $request->has('show_on_homepage');

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $data['image'] = $request->file('image')
                ->store('categories', 'public');
        }

        $category->update($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully!');
    }

    // ── Delete category ──────────────────────────
    public function destroy(Category $category)
    {
        // Check if category has products
        if ($category->products()->count() > 0) {
            return back()->with('error', 'Cannot delete — this category has products. Move products first.');
        }

        // Delete image
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully!');
    }

    // ── Toggle active status (AJAX) ──────────────
    public function toggleStatus(Category $category)
    {
        $category->update(['is_active' => !$category->is_active]);

        return response()->json([
            'success' => true,
            'status'  => $category->is_active,
            'message' => 'Category ' . ($category->is_active ? 'activated' : 'deactivated'),
        ]);
    }
}