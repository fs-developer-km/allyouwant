<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('sort_order')->get();
        return view('admin.banners.index', compact('banners'));
    }
    public function create() { return view('admin.banners.create'); }
    public function store(Request $request)
    {
        $request->validate(['title'=>'required|string|max:200','image'=>'nullable|image|max:2048']);
        $data = $request->only(['title','subtitle','button_text','button_link','badge_text','sort_order']);
        $data['is_active'] = $request->has('is_active');
        if ($request->hasFile('image')) $data['image'] = $request->file('image')->store('banners','public');
        Banner::create($data);
        return redirect()->route('admin.banners.index')->with('success','Banner created!');
    }
    public function edit(Banner $banner) { return view('admin.banners.edit', compact('banner')); }
    public function update(Request $request, Banner $banner)
    {
        $data = $request->only(['title','subtitle','button_text','button_link','badge_text','sort_order']);
        $data['is_active'] = $request->has('is_active');
        if ($request->hasFile('image')) {
            if ($banner->image) Storage::disk('public')->delete($banner->image);
            $data['image'] = $request->file('image')->store('banners','public');
        }
        $banner->update($data);
        return redirect()->route('admin.banners.index')->with('success','Banner updated!');
    }
    public function destroy(Banner $banner)
    {
        if ($banner->image) Storage::disk('public')->delete($banner->image);
        $banner->delete();
        return redirect()->route('admin.banners.index')->with('success','Banner deleted!');
    }
    public function toggleStatus($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->update(['is_active'=>!$banner->is_active]);
        return response()->json(['success'=>true,'status'=>$banner->is_active]);
    }
}
