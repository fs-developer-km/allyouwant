<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Order Placed — GroceryMart</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>*{box-sizing:border-box;margin:0;padding:0}body{font-family:'Inter',sans-serif;background:#f0f2f5;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px}
.card{background:#fff;border-radius:16px;padding:48px;text-align:center;max-width:500px;width:100%;box-shadow:0 4px 24px rgba(0,0,0,.10)}
.success-icon{font-size:72px;margin-bottom:20px}
h1{font-size:24px;font-weight:700;color:#15803d;margin-bottom:8px}
p{font-size:14px;color:#64748b;margin-bottom:24px;line-height:1.6}
.order-num{background:#f0faf4;border:1px solid #bbf7d0;border-radius:10px;padding:16px;margin-bottom:24px}
.order-num-label{font-size:12px;color:#64748b;margin-bottom:4px}
.order-num-val{font-size:20px;font-weight:800;color:#15803d}
.btn{display:inline-block;padding:13px 28px;background:#16a34a;color:#fff;border-radius:10px;font-size:14px;font-weight:600;text-decoration:none;margin:6px}
.btn-outline{background:#fff;color:#16a34a;border:1.5px solid #16a34a}
</style>
</head>
<body>
<div class="card">
  <div class="success-icon">🎉</div>
  <h1>Order Placed Successfully!</h1>
  <p>Thank you for shopping with GroceryMart! Your fresh groceries are being prepared and will be delivered soon.</p>
  <div class="order-num">
    <div class="order-num-label">Your Order Number</div>
    <div class="order-num-val">#{{ $order->order_number }}</div>
  </div>
  <div style="font-size:13px;color:#64748b;margin-bottom:24px">
    Payment: <strong>{{ strtoupper($order->payment_method) }}</strong> · Total: <strong style="color:#16a34a">₹{{ number_format($order->total) }}</strong>
  </div>
  <a href="{{ route('home') }}" class="btn">🏠 Back to Home</a>
  <a href="{{ route('account.index') }}" class="btn btn-outline">📦 Track Order</a>
</div>
</body></html>
