<?php
// ══════════════════════════════════════════════
// app/Http/Controllers/Admin/OrderController.php
// ══════════════════════════════════════════════

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatusHistory;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // List all orders
    public function index(Request $request)
    {
        $query = Order::with('user')->latest();

        if ($request->search) {
            $query->where('order_number', 'like', '%' . $request->search . '%')
                  ->orWhereHas('user', fn($q) => $q->where('name', 'like', '%' . $request->search . '%'));
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->payment) {
            $query->where('payment_method', $request->payment);
        }
        if ($request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $orders = $query->paginate(15)->withQueryString();

        $statusCounts = [
            'all'              => Order::count(),
            'pending'          => Order::where('status', 'pending')->count(),
            'confirmed'        => Order::where('status', 'confirmed')->count(),
            'processing'       => Order::where('status', 'processing')->count(),
            'shipped'          => Order::where('status', 'shipped')->count(),
            'out_for_delivery' => Order::where('status', 'out_for_delivery')->count(),
            'delivered'        => Order::where('status', 'delivered')->count(),
            'cancelled'        => Order::where('status', 'cancelled')->count(),
        ];

        return view('admin.orders.index', compact('orders', 'statusCounts'));
    }

    // View single order
    public function show(Order $order)
    {
        $order->load(['user', 'items.product', 'address', 'statusHistory.updatedBy']);
        return view('admin.orders.show', compact('order'));
    }

    // Update order status
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status'  => 'required|in:pending,confirmed,processing,shipped,out_for_delivery,delivered,cancelled,refunded',
            'comment' => 'nullable|string|max:500',
        ]);

        $oldStatus = $order->status;
        $order->update([
            'status'       => $request->status,
            'delivered_at' => $request->status === 'delivered' ? now() : $order->delivered_at,
        ]);

        // Log status history
        OrderStatusHistory::create([
            'order_id'   => $order->id,
            'status'     => $request->status,
            'comment'    => $request->comment ?? 'Status updated by admin',
            'updated_by' => auth()->id(),
        ]);

        // TODO: Send email notification to customer

        return back()->with('success', "Order #{$order->order_number} status updated to " . ucwords(str_replace('_', ' ', $request->status)));
    }

    // Print invoice
    public function invoice(Order $order)
    {
        $order->load(['user', 'items.product', 'address']);
        return view('admin.orders.invoice', compact('order'));
    }
}