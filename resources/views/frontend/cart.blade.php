<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Cart — GroceryMart</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>*{box-sizing:border-box;margin:0;padding:0}body{font-family:'Inter',sans-serif;background:#f0f2f5}
.navbar{background:#fff;padding:14px 24px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid #e2e8f0}
.logo{font-size:20px;font-weight:800;color:#1a1a2e;text-decoration:none}.logo span{color:#16a34a}
.nav-links{display:flex;gap:16px}.nav-links a{font-size:13.5px;color:#374151;text-decoration:none}
.wrap{max-width:1000px;margin:24px auto;padding:0 20px;display:grid;grid-template-columns:1fr 320px;gap:20px;align-items:start}
.card{background:#fff;border-radius:12px;padding:24px;border:1px solid #e2e8f0}
.card-title{font-size:16px;font-weight:700;margin-bottom:20px}
.cart-item{display:flex;align-items:center;gap:14px;padding:14px 0;border-bottom:1px solid #f1f5f9}
.cart-item:last-child{border-bottom:none}
.item-img{width:60px;height:60px;background:#f8fafc;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:32px;flex-shrink:0}
.item-name{font-size:14px;font-weight:600;flex:1}.item-price{font-size:13px;color:#64748b;margin-top:2px}
.item-total{font-size:15px;font-weight:700;color:#16a34a;margin-left:auto}
.del-btn{background:#fef2f2;color:#dc2626;border:none;width:30px;height:30px;border-radius:7px;font-size:14px;cursor:pointer;margin-left:8px}
.summary-row{display:flex;justify-content:space-between;font-size:14px;padding:8px 0;border-bottom:1px solid #f1f5f9}
.summary-total{display:flex;justify-content:space-between;font-size:16px;font-weight:700;padding:12px 0}
.btn-checkout{display:block;background:#16a34a;color:#fff;text-align:center;padding:14px;border-radius:10px;font-size:15px;font-weight:600;text-decoration:none;margin-top:16px}
.btn-checkout:hover{background:#15803d}
.empty{text-align:center;padding:40px;color:#9ca3af}
.alert{padding:12px 16px;border-radius:8px;font-size:13px;margin-bottom:16px;background:#dcfce7;border:1px solid #bbf7d0;color:#15803d}
</style>
</head>
<body>
<nav class="navbar">
  <a href="{{ route('home') }}" class="logo">Grocery<span>Mart</span></a>
  <div class="nav-links">
    <a href="{{ route('home') }}">Home</a>
    <a href="{{ route('shop') }}">Shop</a>
    @auth <a href="{{ route('account.index') }}">Account</a> @else <a href="{{ route('login') }}">Login</a> @endauth
  </div>
</nav>
<div style="max-width:1000px;margin:24px auto;padding:0 20px">
  @if(session('success'))<div class="alert">{{ session('success') }}</div>@endif
  <h1 style="font-size:22px;font-weight:700;margin-bottom:20px">🛒 My Cart</h1>
  @if(count($products) > 0)
  <div style="display:grid;grid-template-columns:1fr 300px;gap:20px;align-items:start">
    <div class="card">
      <div class="card-title">Cart Items ({{ count($products) }})</div>
      @foreach($products as $item)
      <div class="cart-item">
        <div class="item-img">🛒</div>
        <div style="flex:1">
          <div class="item-name">{{ $item['product']->name }}</div>
          <div class="item-price">₹{{ number_format($item['product']->current_price) }} × {{ $item['qty'] }}</div>
        </div>
        <div class="item-total">₹{{ number_format($item['product']->current_price * $item['qty']) }}</div>
        <form action="{{ route('cart.remove',$item['product']->id) }}" method="POST">@csrf @method('DELETE')<button type="submit" class="del-btn">🗑</button></form>
      </div>
      @endforeach
    </div>
    <div class="card">
      <div class="card-title">Order Summary</div>
      <div class="summary-row"><span>Subtotal</span><span>₹{{ number_format($total) }}</span></div>
      <div class="summary-row"><span>Delivery</span><span>{{ $total >= 499 ? 'FREE' : '₹40' }}</span></div>
      <div class="summary-total"><span>Total</span><span>₹{{ number_format($total >= 499 ? $total : $total + 40) }}</span></div>
      @auth
        <a href="{{ route('checkout.index') }}" class="btn-checkout">Proceed to Checkout →</a>
      @else
        <a href="{{ route('login') }}" class="btn-checkout">Login to Checkout →</a>
      @endauth
      <a href="{{ route('shop') }}" style="display:block;text-align:center;margin-top:12px;font-size:13px;color:#16a34a">← Continue Shopping</a>
    </div>
  </div>
  @else
  <div class="card"><div class="empty"><div style="font-size:48px;margin-bottom:12px">🛒</div><div style="font-size:16px;font-weight:500;margin-bottom:8px">Your cart is empty</div><a href="{{ route('shop') }}" style="color:#16a34a;font-weight:600">Start Shopping →</a></div></div>
  @endif
</div>
</body></html>
