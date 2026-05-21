<!DOCTYPE html>
<html><head><meta charset="UTF-8"><title>Invoice #{{ $order->order_number }}</title>
<style>
*{box-sizing:border-box;margin:0;padding:0}body{font-family:'Arial',sans-serif;font-size:13px;color:#1a1a2e;padding:40px}
.header{display:flex;justify-content:space-between;margin-bottom:40px;border-bottom:2px solid #16a34a;padding-bottom:20px}
.logo{font-size:24px;font-weight:800;color:#1a1a2e}.logo span{color:#16a34a}
.inv-title{font-size:20px;font-weight:700;color:#16a34a}
.inv-num{font-size:14px;color:#64748b;margin-top:4px}
.section{margin-bottom:24px}
.section-title{font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#64748b;margin-bottom:8px}
.info-grid{display:grid;grid-template-columns:1fr 1fr;gap:24px}
table{width:100%;border-collapse:collapse;margin-top:16px}
th{background:#f8fafc;padding:10px 12px;text-align:left;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.4px;color:#64748b;border-bottom:2px solid #e2e8f0}
td{padding:10px 12px;border-bottom:1px solid #f1f5f9}
.total-section{margin-top:16px;margin-left:auto;max-width:260px}
.total-row{display:flex;justify-content:space-between;padding:6px 0;font-size:13px;border-bottom:1px solid #f1f5f9}
.grand-total{display:flex;justify-content:space-between;padding:10px 0;font-size:15px;font-weight:800;color:#16a34a;border-top:2px solid #16a34a;margin-top:4px}
.footer{margin-top:40px;text-align:center;color:#9ca3af;font-size:12px;border-top:1px solid #e2e8f0;padding-top:16px}
@media print{body{padding:20px}.no-print{display:none}}
</style>
</head>
<body>
<div class="no-print" style="margin-bottom:20px;text-align:right">
  <button onclick="window.print()" style="background:#16a34a;color:#fff;border:none;padding:10px 24px;border-radius:8px;font-size:14px;cursor:pointer">🖨️ Print Invoice</button>
  <a href="{{ route('admin.orders.show',$order->id) }}" style="margin-left:10px;color:#64748b">← Back</a>
</div>

<div class="header">
  <div><div class="logo">Grocery<span>Mart</span></div><div style="font-size:12px;color:#64748b;margin-top:6px">Fresh • Fast • Reliable<br>hello@grocerymart.in | +91 98765 43210</div></div>
  <div style="text-align:right"><div class="inv-title">INVOICE</div><div class="inv-num">#{{ $order->order_number }}</div><div style="font-size:12px;color:#64748b;margin-top:4px">{{ $order->created_at->format('d M Y') }}</div></div>
</div>

<div class="info-grid" style="margin-bottom:24px">
  <div>
    <div class="section-title">Bill To</div>
    <div style="font-weight:600">{{ $order->delivery_name }}</div>
    <div style="color:#64748b">{{ $order->delivery_phone }}</div>
    <div style="color:#64748b;margin-top:4px">{{ $order->delivery_address }}, {{ $order->delivery_city }}, {{ $order->delivery_state }} - {{ $order->delivery_pincode }}</div>
  </div>
  <div>
    <div class="section-title">Payment Info</div>
    <div><strong>Method:</strong> {{ strtoupper($order->payment_method) }}</div>
    <div><strong>Status:</strong> {{ ucfirst($order->payment_status) }}</div>
    <div><strong>Order Status:</strong> {{ $order->status_label }}</div>
    @if($order->payment_id)<div><strong>Txn ID:</strong> {{ $order->payment_id }}</div>@endif
  </div>
</div>

<table>
  <thead><tr><th>#</th><th>Product</th><th>Price</th><th>Qty</th><th>Total</th></tr></thead>
  <tbody>
    @foreach($order->items as $i => $item)
    <tr>
      <td>{{ $i+1 }}</td>
      <td>{{ $item->product_name }}</td>
      <td>₹{{ number_format($item->price,2) }}</td>
      <td>{{ $item->quantity }}</td>
      <td>₹{{ number_format($item->subtotal,2) }}</td>
    </tr>
    @endforeach
  </tbody>
</table>

<div class="total-section">
  <div class="total-row"><span>Subtotal</span><span>₹{{ number_format($order->subtotal,2) }}</span></div>
  <div class="total-row"><span>Delivery Charge</span><span>{{ $order->delivery_charge > 0 ? '₹'.number_format($order->delivery_charge,2) : 'FREE' }}</span></div>
  @if($order->discount > 0)<div class="total-row" style="color:#16a34a"><span>Discount</span><span>-₹{{ number_format($order->discount,2) }}</span></div>@endif
  <div class="grand-total"><span>TOTAL</span><span>₹{{ number_format($order->total,2) }}</span></div>
</div>

<div class="footer">Thank you for shopping with GroceryMart! For support: hello@grocerymart.in</div>
</body></html>
