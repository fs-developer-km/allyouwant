<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>@yield('title','GroceryMart') — Fresh Groceries</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Inter',sans-serif;background:#f0f2f5;color:#1a1a2e}
a{text-decoration:none;color:inherit}
.navbar{background:#fff;padding:0 24px;height:60px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid #e2e8f0;position:sticky;top:0;z-index:100;box-shadow:0 1px 4px rgba(0,0,0,.06)}
.logo{font-size:20px;font-weight:800;color:#1a1a2e}.logo span{color:#16a34a}
.nav-links{display:flex;align-items:center;gap:16px}
.nav-links a{font-size:13.5px;color:#374151;font-weight:500;padding:6px 10px;border-radius:7px;transition:all .15s}
.nav-links a:hover{background:#f0faf4;color:#16a34a}
.btn-nav{background:#16a34a!important;color:#fff!important;padding:8px 18px!important;border-radius:8px!important}
.btn-nav:hover{background:#15803d!important}
.cart-link{position:relative;display:flex;align-items:center;gap:5px}
.cart-badge{background:#ef4444;color:#fff;font-size:10px;font-weight:700;border-radius:50%;width:17px;height:17px;display:inline-flex;align-items:center;justify-content:center}
footer{background:#0f1c14;color:rgba(255,255,255,.7);padding:40px 24px;text-align:center;margin-top:40px}
footer a{color:rgba(255,255,255,.6)}.footer-logo{font-size:20px;font-weight:800;color:#fff;margin-bottom:8px}.footer-logo span{color:#4ade80}
.alert-success{background:#dcfce7;border:1px solid #bbf7d0;color:#15803d;padding:12px 20px;font-size:13px}
.alert-error{background:#fef2f2;border:1px solid #fecaca;color:#dc2626;padding:12px 20px;font-size:13px}
</style>
@stack('styles')
</head>
<body>
<nav class="navbar">
  <a href="{{ route('home') }}" class="logo">Grocery<span>Mart</span></a>
  <div class="nav-links">
    <a href="{{ route('home') }}">Home</a>
    <a href="{{ route('shop') }}">Shop</a>
    <a href="{{ route('offers') }}">Offers</a>
    <a href="{{ route('cart.index') }}" class="cart-link">🛒 Cart @php $cartCount = count(session('cart',[])); @endphp @if($cartCount > 0)<span class="cart-badge">{{ $cartCount }}</span>@endif</a>
    @auth
      <a href="{{ route('account.index') }}">My Account</a>
      <form action="{{ route('logout') }}" method="POST" style="display:inline">@csrf<button style="background:none;border:none;font-size:13.5px;color:#374151;cursor:pointer;padding:6px 10px;border-radius:7px;font-family:inherit">Logout</button></form>
    @else
      <a href="{{ route('login') }}" class="btn-nav">Login</a>
    @endauth
  </div>
</nav>

@if(session('success'))<div class="alert-success">✅ {{ session('success') }}</div>@endif
@if(session('error'))<div class="alert-error">❌ {{ session('error') }}</div>@endif

@yield('content')

<footer>
  <div class="footer-logo">Grocery<span>Mart</span></div>
  <p style="margin-bottom:12px;font-size:13px">Fresh • Fast • Reliable — Your daily grocery partner</p>
  <div style="display:flex;justify-content:center;gap:20px;font-size:13px">
    <a href="{{ route('home') }}">Home</a>
    <a href="{{ route('shop') }}">Shop</a>
    <a href="{{ route('offers') }}">Offers</a>
    @auth <a href="{{ route('account.index') }}">My Account</a> @else <a href="{{ route('login') }}">Login</a> @endauth
  </div>
  <p style="margin-top:16px;font-size:12px;color:rgba(255,255,255,.4)">© {{ date('Y') }} GroceryMart. All rights reserved.</p>
</footer>

@stack('scripts')
</body>
</html>
