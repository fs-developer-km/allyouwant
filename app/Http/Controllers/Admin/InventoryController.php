<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderBy('stock_quantity')->paginate(20);
        return view('admin.inventory.index', compact('products'));
    }
    public function lowStock()
    {
        $products = Product::with('category')->whereColumn('stock_quantity','<=','low_stock_alert')->paginate(20);
        return view('admin.inventory.low', compact('products'));
    }
    public function update(Request $request, $id)
    {
        $request->validate(['stock_quantity'=>'required|integer|min:0']);
        Product::findOrFail($id)->update(['stock_quantity'=>$request->stock_quantity]);
        return back()->with('success','Stock updated!');
    }
}
