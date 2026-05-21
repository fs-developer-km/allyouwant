<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()->with('items')->latest()->paginate(10);
        return view('frontend.account.orders', compact('orders'));
    }
    public function show($id)
    {
        $order = Auth::user()->orders()->with(['items.product'])->findOrFail($id);
        return view('frontend.account.order-detail', compact('order'));
    }
}
