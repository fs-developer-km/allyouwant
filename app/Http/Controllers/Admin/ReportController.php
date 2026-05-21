<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function sales(Request $request)
    {
        $days   = $request->days ?? 30;
        $orders = Order::where('status','delivered')->whereDate('created_at','>=',now()->subDays($days))->with('user')->latest()->paginate(20);
        $total  = Order::where('status','delivered')->whereDate('created_at','>=',now()->subDays($days))->sum('total');
        return view('admin.reports.sales', compact('orders','total','days'));
    }
    public function products()
    {
        $products = Product::withCount('orderItems')->withSum('orderItems','subtotal')->orderByDesc('order_items_count')->paginate(20);
        return view('admin.reports.products', compact('products'));
    }
}
