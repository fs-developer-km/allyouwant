<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Review;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRevenue     = Order::where('status','delivered')->sum('total');
        $lastMonthRevenue = Order::where('status','delivered')->whereMonth('created_at',now()->subMonth()->month)->sum('total');
        $totalOrders      = Order::count();
        $todayOrders      = Order::whereDate('created_at',today())->count();
        $pendingOrders    = Order::where('status','pending')->count();
        $totalCustomers   = User::where('role','customer')->count();
        $newCustomers     = User::where('role','customer')->whereMonth('created_at',now()->month)->count();
        $totalProducts    = Product::count();
        $lowStockCount    = Product::whereColumn('stock_quantity','<=','low_stock_alert')->count();
        $pendingReviews   = Review::where('is_approved',false)->count();
        $recentOrders     = Order::with('user')->latest()->take(8)->get();
        $statusCounts     = ['pending'=>Order::where('status','pending')->count(),'processing'=>Order::where('status','processing')->count(),'delivered'=>Order::where('status','delivered')->count(),'cancelled'=>Order::where('status','cancelled')->count()];
        $labels=[]; $data=[];
        for($i=6;$i>=0;$i--){ $d=Carbon::today()->subDays($i); $labels[]=$d->format('D'); $data[]=Order::where('status','delivered')->whereDate('created_at',$d)->sum('total'); }
        $revenueChartData=['labels'=>$labels,'data'=>$data];
        return view('admin.dashboard',compact('totalRevenue','lastMonthRevenue','totalOrders','todayOrders','pendingOrders','totalCustomers','newCustomers','totalProducts','lowStockCount','pendingReviews','recentOrders','statusCounts','revenueChartData'));
    }
}
