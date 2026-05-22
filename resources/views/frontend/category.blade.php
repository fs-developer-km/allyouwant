<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $category->name }} — All You Want</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth;font-size:15px}
body{font-family:'Inter',sans-serif;background:#f8f9fa;color:#1a1a2e;-webkit-font-smoothing:antialiased}
a{text-decoration:none;color:inherit}
ul{list-style:none}
img{max-width:100%;display:block}
button{cursor:pointer;font-family:inherit}

/* TOPBAR */
.topbar{background:#0d6e39;color:#fff;font-size:12.5px;padding:7px 0}
.topbar-inner{max-width:1320px;margin:0 auto;padding:0 20px;display:flex;justify-content:space-between;align-items:center;gap:12px}
.topbar-left{display:flex;align-items:center;gap:18px}
.topbar-left span{display:flex;align-items:center;gap:5px;opacity:.9}
.topbar-right{display:flex;align-items:center;gap:16px}
.topbar-right a{opacity:.85;transition:opacity .15s;font-size:12px;color:#fff}
.topbar-right a:hover{opacity:1}
.topbar-divider{opacity:.3;font-size:11px}

/* NAVBAR */
.navbar{background:#fff;border-bottom:1px solid #e8edf0;position:sticky;top:0;z-index:200;box-shadow:0 1px 6px rgba(0,0,0,.06)}
.navbar-inner{max-width:1320px;margin:0 auto;padding:0 20px;display:flex;align-items:center;gap:20px;height:68px}
.logo{display:flex;align-items:center;gap:9px;flex-shrink:0}
.logo-mark{width:36px;height:36px;background:#0d6e39;border-radius:9px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:18px;font-weight:800;letter-spacing:-1px}
.logo-text{font-size:20px;font-weight:800;color:#1a1a2e;letter-spacing:-.5px}
.logo-text span{color:#0d6e39}
.logo-sub{font-size:10px;color:#6b7280;letter-spacing:.5px;text-transform:uppercase;display:block;margin-top:-2px}
.search-wrap{flex:1;max-width:580px;position:relative}
.search-box{display:flex;border:1.5px solid #d1d5db;border-radius:10px;overflow:hidden;transition:border-color .2s,box-shadow .2s;background:#fff}
.search-box:focus-within{border-color:#0d6e39;box-shadow:0 0 0 3px rgba(13,110,57,.10)}
.search-cat{border:none;background:#f3f4f6;padding:0 14px;font-size:12.5px;color:#374151;border-right:1px solid #d1d5db;outline:none;min-width:110px;font-family:inherit;cursor:pointer}
.search-input{flex:1;border:none;padding:11px 14px;font-size:13.5px;outline:none;background:#fff;color:#111}
.search-input::placeholder{color:#9ca3af}
.search-btn{background:#0d6e39;border:none;color:#fff;padding:0 20px;font-size:14px;font-weight:500;transition:background .2s;display:flex;align-items:center;gap:6px;font-family:inherit;cursor:pointer}
.search-btn:hover{background:#0a5a2e}
.nav-right{display:flex;align-items:center;gap:6px;margin-left:auto;flex-shrink:0}
.nav-icon-btn{display:flex;flex-direction:column;align-items:center;gap:2px;padding:7px 12px;border-radius:8px;border:none;background:none;color:#374151;font-size:11.5px;font-weight:500;transition:background .15s;position:relative;white-space:nowrap;cursor:pointer;text-decoration:none}
.nav-icon-btn:hover{background:#f3f4f6;color:#0d6e39}
.nav-icon-btn svg{width:22px;height:22px;stroke:#374151;stroke-width:1.8;fill:none}
.nav-icon-btn:hover svg{stroke:#0d6e39}
.btn-cart{background:#0d6e39;color:#fff;border-radius:10px;padding:9px 18px;font-size:13px;font-weight:600;border:none;display:flex;align-items:center;gap:8px;transition:background .2s;cursor:pointer;text-decoration:none}
.btn-cart:hover{background:#0a5a2e}
.btn-cart svg{width:18px;height:18px;stroke:#fff;stroke-width:2;fill:none}
.cart-count{background:rgba(255,255,255,.25);border-radius:5px;padding:1px 6px;font-size:12px;font-weight:700}
.nav-badge{position:absolute;top:5px;right:8px;background:#e53935;color:#fff;font-size:10px;font-weight:700;min-width:17px;height:17px;border-radius:50%;display:flex;align-items:center;justify-content:center;border:2px solid #fff}

/* CAT NAV */
.cat-nav{background:#fff;border-bottom:1px solid #e8edf0}
.cat-nav-inner{max-width:1320px;margin:0 auto;padding:0 20px;display:flex;align-items:center;overflow-x:auto;scrollbar-width:none;gap:0}
.cat-nav-inner::-webkit-scrollbar{display:none}
.cat-link{display:flex;align-items:center;gap:6px;padding:11px 16px;font-size:13px;font-weight:500;color:#4b5563;white-space:nowrap;border-bottom:2.5px solid transparent;transition:all .15s;text-decoration:none}
.cat-link:hover,.cat-link.active{color:#0d6e39;border-bottom-color:#0d6e39}

/* PAGE WRAP */
.page-wrap{max-width:1320px;margin:0 auto;padding:0 20px}

/* BREADCRUMB */
.breadcrumb{padding:16px 0;display:flex;align-items:center;gap:6px;font-size:13px;color:#6b7280}
.breadcrumb a{color:#0d6e39;font-weight:500}
.breadcrumb a:hover{text-decoration:underline}
.breadcrumb span{color:#d1d5db}

/* CATEGORY HERO */
.cat-hero{background:linear-gradient(120deg,#0a3d20 0%,#0d6e39 60%,#15803d 100%);border-radius:14px;padding:32px 40px;display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;position:relative;overflow:hidden}
.cat-hero-glow{position:absolute;width:300px;height:300px;border-radius:50%;background:rgba(255,255,255,.05);right:-60px;top:-80px}
.cat-hero-text{z-index:1}
.cat-hero-tag{display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,.15);color:rgba(255,255,255,.9);font-size:12px;font-weight:500;padding:5px 12px;border-radius:20px;margin-bottom:10px}
.cat-hero-title{font-size:32px;font-weight:800;color:#fff;letter-spacing:-.5px;margin-bottom:6px}
.cat-hero-sub{font-size:14px;color:rgba(255,255,255,.75)}
.cat-hero-emoji{font-size:90px;z-index:1;line-height:1;filter:drop-shadow(0 8px 24px rgba(0,0,0,.2))}

/* FILTER BAR */
.filter-bar{background:#fff;border:1px solid #e8edf0;border-radius:12px;padding:14px 20px;margin-bottom:24px;display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap}
.filter-left{display:flex;align-items:center;gap:10px;flex-wrap:wrap}
.filter-label{font-size:13px;font-weight:600;color:#374151}
.filter-btn{padding:7px 16px;border:1.5px solid #e8edf0;border-radius:8px;font-size:12.5px;font-weight:500;color:#4b5563;background:#f9fafb;cursor:pointer;transition:all .15s;font-family:inherit}
.filter-btn:hover,.filter-btn.active{border-color:#0d6e39;color:#0d6e39;background:#f0faf4}
.filter-right{display:flex;align-items:center;gap:10px}
.sort-select{padding:8px 14px;border:1.5px solid #e8edf0;border-radius:8px;font-size:13px;color:#374151;background:#fff;outline:none;font-family:inherit;cursor:pointer}
.result-count{font-size:13px;color:#6b7280}
.result-count strong{color:#0d6e39}

/* LAYOUT */
.cat-layout{display:grid;grid-template-columns:220px 1fr;gap:20px;align-items:start}
.sidebar{background:#fff;border:1px solid #e8edf0;border-radius:12px;padding:16px;position:sticky;top:88px}
.sidebar-title{font-size:13px;font-weight:700;color:#1a1a2e;margin-bottom:12px;text-transform:uppercase;letter-spacing:.4px}
.sidebar-cat-link{display:flex;align-items:center;justify-content:space-between;padding:9px 12px;border-radius:8px;font-size:13px;color:#374151;transition:all .15s;text-decoration:none;margin-bottom:2px}
.sidebar-cat-link:hover{background:#f0faf4;color:#0d6e39}
.sidebar-cat-link.active{background:#f0faf4;color:#0d6e39;font-weight:600}
.sidebar-cat-icon{margin-right:8px}
.sidebar-divider{height:1px;background:#f3f4f6;margin:12px 0}
.price-range{margin-top:4px}
.price-inputs{display:flex;gap:8px;margin-top:8px}
.price-input{flex:1;padding:8px 10px;border:1.5px solid #e8edf0;border-radius:7px;font-size:13px;outline:none;font-family:inherit;width:100%}
.price-input:focus{border-color:#0d6e39}
.apply-price{width:100%;margin-top:10px;padding:9px;background:#0d6e39;color:#fff;border:none;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;font-family:inherit;transition:background .2s}
.apply-price:hover{background:#0a5a2e}

/* PRODUCTS */
.products-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:14px}
.prod-card{background:#fff;border:1.5px solid #e8edf0;border-radius:12px;overflow:hidden;transition:all .2s;cursor:pointer;position:relative}
.prod-card:hover{transform:translateY(-4px);box-shadow:0 12px 32px rgba(0,0,0,.09);border-color:#c8e6c9}
.prod-badge{position:absolute;top:10px;left:10px;font-size:10.5px;font-weight:700;padding:3px 9px;border-radius:5px;z-index:2}
.badge-sale{background:#ff3b30;color:#fff}
.badge-new{background:#0d6e39;color:#fff}
.badge-hot{background:#ff6b00;color:#fff}
.prod-wish{position:absolute;top:10px;right:10px;width:30px;height:30px;background:#fff;border:1px solid #e8edf0;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:14px;z-index:2;box-shadow:0 1px 4px rgba(0,0,0,.08);transition:all .15s;cursor:pointer}
.prod-wish:hover{background:#fff0f0;border-color:#fca5a5}
.prod-img-wrap{height:160px;background:#f8fafc;display:flex;align-items:center;justify-content:center;overflow:hidden;transition:transform .3s}
.prod-img-wrap img{width:100%;height:100%;object-fit:cover}
.prod-card:hover .prod-img-wrap{transform:scale(1.05)}
.prod-emoji{font-size:72px;line-height:1}
.prod-body{padding:12px}
.prod-cat-tag{font-size:11px;color:#0d6e39;font-weight:600;text-transform:uppercase;letter-spacing:.3px;margin-bottom:4px}
.prod-name{font-size:13.5px;font-weight:600;color:#1a1a2e;line-height:1.35;margin-bottom:3px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
.prod-weight{font-size:12px;color:#9ca3af;margin-bottom:8px}
.prod-rating{display:flex;align-items:center;gap:4px;margin-bottom:8px}
.stars{color:#f59e0b;font-size:12px;letter-spacing:-.5px}
.rating-n{font-size:11.5px;color:#9ca3af}
.prod-footer{display:flex;align-items:center;justify-content:space-between;gap:6px}
.prod-price-wrap{display:flex;flex-direction:column}
.prod-price{font-size:17px;font-weight:800;color:#0d6e39;line-height:1}
.prod-price-old{font-size:12px;color:#9ca3af;text-decoration:line-through;margin-top:1px}
.btn-add{width:34px;height:34px;background:#0d6e39;border:none;border-radius:8px;color:#fff;font-size:20px;font-weight:300;display:flex;align-items:center;justify-content:center;transition:all .15s;flex-shrink:0;cursor:pointer}
.btn-add:hover{background:#0a5a2e;transform:scale(1.08)}
.btn-add:disabled{background:#e2e8f0;color:#9ca3af;cursor:not-allowed;transform:none}

/* EMPTY */
.empty-state{grid-column:1/-1;text-align:center;padding:64px 20px;background:#fff;border-radius:12px;border:1.5px dashed #e8edf0}
.empty-icon{font-size:52px;margin-bottom:14px}
.empty-title{font-size:17px;font-weight:700;color:#1a1a2e;margin-bottom:6px}
.empty-sub{font-size:14px;color:#9ca3af;margin-bottom:20px}
.btn-browse{display:inline-flex;align-items:center;gap:6px;background:#0d6e39;color:#fff;padding:11px 24px;border-radius:8px;font-size:13.5px;font-weight:600;text-decoration:none;transition:background .2s}
.btn-browse:hover{background:#0a5a2e}

/* PAGINATION */
.pagination-wrap{margin-top:32px;display:flex;justify-content:center;align-items:center;gap:6px}
.pagination-wrap .page-link{display:flex;align-items:center;justify-content:center;width:38px;height:38px;border:1.5px solid #e8edf0;border-radius:8px;font-size:13.5px;font-weight:500;color:#374151;background:#fff;text-decoration:none;transition:all .15s}
.pagination-wrap .page-link:hover{border-color:#0d6e39;color:#0d6e39;background:#f0faf4}
.pagination-wrap .page-link.active{background:#0d6e39;color:#fff;border-color:#0d6e39}
.pagination-wrap .page-link.disabled{opacity:.4;cursor:not-allowed;pointer-events:none}

/* MOBILE */
.mob-menu-btn{display:none;flex-direction:column;justify-content:center;gap:5px;width:40px;height:40px;background:none;border:1.5px solid #e8edf0;border-radius:8px;padding:8px;cursor:pointer;flex-shrink:0}
.mob-menu-btn span{display:block;height:2px;background:#374151;border-radius:2px}
.mob-cart-icon{display:none;align-items:center;justify-content:center;position:relative;width:40px;height:40px;border:1.5px solid #e8edf0;border-radius:8px;background:none;cursor:pointer;flex-shrink:0;text-decoration:none}
.mob-cart-icon svg{width:20px;height:20px;stroke:#374151;stroke-width:1.8;fill:none}
.mob-bottom-nav{display:none;position:fixed;bottom:0;left:0;right:0;background:#fff;border-top:1px solid #e8edf0;z-index:400;padding:6px 0}
.mob-bottom-nav-inner{display:flex;justify-content:space-around}
.mob-nav-item{display:flex;flex-direction:column;align-items:center;gap:3px;padding:6px 16px;font-size:11px;font-weight:500;color:#6b7280;cursor:pointer;position:relative;min-width:56px;transition:color .15s;text-decoration:none}
.mob-nav-item.active,.mob-nav-item:hover{color:#0d6e39}
.mob-nav-item svg{width:22px;height:22px;stroke:currentColor;stroke-width:1.8;fill:none}
.mob-nav-badge{position:absolute;top:4px;right:10px;background:#e53935;color:#fff;font-size:9px;font-weight:700;min-width:15px;height:15px;border-radius:50%;display:flex;align-items:center;justify-content:center;border:2px solid #fff}

/* DRAWER */
.mob-drawer{display:none;position:fixed;inset:0;z-index:500}
.mob-overlay{position:absolute;inset:0;background:rgba(0,0,0,.45);backdrop-filter:blur(2px)}
.mob-panel{position:absolute;left:0;top:0;bottom:0;width:300px;background:#fff;overflow-y:auto;transform:translateX(-100%);transition:transform .3s ease;padding:0 0 80px}
.mob-drawer.open .mob-panel{transform:translateX(0)}
.mob-drawer.open{display:block}
.mob-panel-head{display:flex;align-items:center;justify-content:space-between;padding:16px 18px;border-bottom:1px solid #e8edf0;background:#0d6e39}
.mob-panel-logo{font-size:18px;font-weight:800;color:#fff}
.mob-panel-logo span{color:#fcd34d}
.mob-close{background:rgba(255,255,255,.15);border:none;color:#fff;width:32px;height:32px;border-radius:8px;font-size:18px;cursor:pointer;display:flex;align-items:center;justify-content:center}
.mob-nav-link{display:flex;align-items:center;gap:12px;padding:12px 18px;font-size:14px;color:#374151;font-weight:500;border-bottom:1px solid #f9fafb;transition:background .15s;text-decoration:none}
.mob-nav-link:hover{background:#f0faf4;color:#0d6e39}
.mob-nav-title{font-size:11px;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.6px;padding:8px 18px 4px}

/* ALERT */
.alert-success{background:#dcfce7;border-bottom:1px solid #bbf7d0;color:#15803d;padding:10px 20px;font-size:13px;font-weight:500}
.alert-error{background:#fef2f2;border-bottom:1px solid #fecaca;color:#dc2626;padding:10px 20px;font-size:13px;font-weight:500}

/* RESPONSIVE */
@media(max-width:1024px){
  .products-grid{grid-template-columns:repeat(3,1fr)}
  .cat-layout{grid-template-columns:1fr}
  .sidebar{display:none}
}
@media(max-width:768px){
  html{font-size:14px}
  .topbar{display:none}
  .navbar-inner{height:58px;gap:10px;padding:0 14px}
  .search-wrap{display:none}
  .nav-icon-btn{display:none}
  .btn-cart{display:none}
  .mob-menu-btn{display:flex}
  .mob-cart-icon{display:flex}
  .page-wrap{padding:0 14px}
  .cat-hero{padding:22px 20px;border-radius:12px;margin-bottom:18px}
  .cat-hero-title{font-size:22px}
  .cat-hero-emoji{font-size:60px}
  .products-grid{grid-template-columns:repeat(2,1fr);gap:10px}
  .prod-img-wrap{height:130px}
  .filter-bar{padding:12px 14px}
  .mob-bottom-nav{display:block}
  body{padding-bottom:62px}
}
@media(max-width:480px){
  .products-grid{grid-template-columns:repeat(2,1fr);gap:8px}
  .cat-hero-emoji{display:none}
}
</style>
</head>
<body>

{{-- TOPBAR --}}
<div class="topbar">
  <div class="topbar-inner">
    <div class="topbar-left">
      <span>🚚 Free delivery on orders above ₹499</span>
      <span class="topbar-divider">|</span>
      <span>⚡ 60-minute express delivery available</span>
    </div>
    <div class="topbar-right">
      <a href="tel:9911011411">📞 9911011411</a>
      <span class="topbar-divider">|</span>
      @auth
        <a href="{{ route('account.index') }}">My Account</a>
        <span class="topbar-divider">|</span>
        <form action="{{ route('logout') }}" method="POST" style="display:inline">@csrf<button style="background:none;border:none;color:rgba(255,255,255,.85);cursor:pointer;font-size:12px;font-family:inherit">Logout</button></form>
      @else
        <a href="{{ route('login') }}">Login</a>
        <span class="topbar-divider">|</span>
        <a href="{{ route('register') }}">Register</a>
      @endauth
    </div>
  </div>
</div>

{{-- NAVBAR --}}
<nav class="navbar">
  <div class="navbar-inner">
    <a href="{{ route('home') }}" class="logo">
      <div class="logo-mark">A</div>
      <div>
        <div class="logo-text">All You <span>Want</span></div>
        <span class="logo-sub">Fresh • Fast • Reliable</span>
      </div>
    </a>
    <div class="search-wrap">
      <form action="{{ route('shop.search') }}" method="GET" class="search-box">
        <select class="search-cat" name="category">
          <option value="">All Categories</option>
          @foreach($allCategories as $cat)
            <option value="{{ $cat->id }}" {{ request('category')==$cat->id ? 'selected':'' }}>{{ $cat->name }}</option>
          @endforeach
        </select>
        <input class="search-input" type="text" name="q" placeholder="Search products..." value="{{ request('q') }}">
        <button class="search-btn" type="submit">
          <svg viewBox="0 0 24 24" style="width:16px;height:16px;stroke:#fff;fill:none;stroke-width:2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
          Search
        </button>
      </form>
    </div>
    <div class="nav-right">
      @auth
        <a href="{{ route('account.index') }}" class="nav-icon-btn">
          <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          Account
        </a>
      @else
        <a href="{{ route('login') }}" class="nav-icon-btn">
          <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          Login
        </a>
      @endauth
      <a href="{{ route('cart.index') }}" class="btn-cart">
        <svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
        My Cart
        @php $cartCount = count(session('cart',[])); @endphp
        @if($cartCount > 0)<span class="cart-count">{{ $cartCount }}</span>@endif
      </a>
    </div>
    <a href="{{ route('cart.index') }}" class="mob-cart-icon">
      <svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
      @if(isset($cartCount) && $cartCount > 0)<span class="nav-badge">{{ $cartCount }}</span>@endif
    </a>
    <button class="mob-menu-btn" onclick="openMenu()">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>

{{-- CAT NAV --}}
<div class="cat-nav">
  <div class="cat-nav-inner">
    <a href="{{ route('home') }}" class="cat-link">🏠 Home</a>
    <a href="{{ route('shop') }}" class="cat-link">🛒 All Products</a>
    @foreach($allCategories as $cat)
      @php $icons = ['Vegetables'=>'🥬','Fruits'=>'🍎','Dairy & Eggs'=>'🥛','Meat & Fish'=>'🍗','Bakery'=>'🧁','Beverages'=>'🧃','Instant Food'=>'🍜','Personal Care'=>'🧴','Household'=>'🏠','Pet Care'=>'🐾']; $icon = $icons[$cat->name] ?? '🛒'; @endphp
      <a href="{{ route('category.show', $cat->slug) }}" class="cat-link {{ $cat->id == $category->id ? 'active' : '' }}">{{ $icon }} {{ $cat->name }}</a>
    @endforeach
    <a href="{{ route('offers') }}" class="cat-link" style="color:#e53935">🔥 Offers</a>
  </div>
</div>

@if(session('success'))<div class="alert-success">✅ {{ session('success') }}</div>@endif
@if(session('error'))<div class="alert-error">❌ {{ session('error') }}</div>@endif

{{-- MAIN CONTENT --}}
<div class="page-wrap" style="padding-top:4px;padding-bottom:40px">

  {{-- BREADCRUMB --}}
  <div class="breadcrumb">
    <a href="{{ route('home') }}">Home</a>
    <span>›</span>
    <a href="{{ route('shop') }}">Shop</a>
    <span>›</span>
    <span style="color:#1a1a2e;font-weight:500">{{ $category->name }}</span>
  </div>

  {{-- CATEGORY HERO --}}
  @php
    $catIcons = ['Vegetables'=>'🥬','Fruits'=>'🍎','Dairy & Eggs'=>'🥛','Meat & Fish'=>'🍗','Bakery'=>'🧁','Beverages'=>'🧃','Instant Food'=>'🍜','Personal Care'=>'🧴','Household'=>'🏠','Pet Care'=>'🐾'];
    $heroIcon = $catIcons[$category->name] ?? '🛒';
    $gradients = [
      'Vegetables'=>'linear-gradient(120deg,#0a3d20 0%,#0d6e39 60%,#15803d 100%)',
      'Fruits'=>'linear-gradient(120deg,#7c2d12 0%,#c2410c 60%,#ea580c 100%)',
      'Dairy & Eggs'=>'linear-gradient(120deg,#1e3a5f 0%,#1d4ed8 60%,#3b82f6 100%)',
      'Meat & Fish'=>'linear-gradient(120deg,#7f1d1d 0%,#b91c1c 60%,#ef4444 100%)',
      'Bakery'=>'linear-gradient(120deg,#78350f 0%,#d97706 60%,#f59e0b 100%)',
      'Beverages'=>'linear-gradient(120deg,#1e1b4b 0%,#4338ca 60%,#6366f1 100%)',
      'Instant Food'=>'linear-gradient(120deg,#831843 0%,#be185d 60%,#ec4899 100%)',
      'Personal Care'=>'linear-gradient(120deg,#4a044e 0%,#86198f 60%,#d946ef 100%)',
      'Household'=>'linear-gradient(120deg,#0c4a6e 0%,#0369a1 60%,#0ea5e9 100%)',
      'Pet Care'=>'linear-gradient(120deg,#365314 0%,#4d7c0f 60%,#65a30d 100%)',
    ];
    $heroGrad = $gradients[$category->name] ?? 'linear-gradient(120deg,#0a3d20 0%,#0d6e39 60%,#15803d 100%)';
  @endphp
  <div class="cat-hero" style="background:{{ $heroGrad }}">
    <div class="cat-hero-glow"></div>
    <div class="cat-hero-text">
      <div class="cat-hero-tag">📦 {{ $products->total() }} Products Available</div>
      <div class="cat-hero-title">{{ $category->name }}</div>
      <div class="cat-hero-sub">{{ $category->description ?? 'Fresh, quality products delivered to your door' }}</div>
    </div>
    <div class="cat-hero-emoji">{{ $heroIcon }}</div>
  </div>

  {{-- FILTER + SORT BAR --}}
  <div class="filter-bar">
    <div class="filter-left">
      <span class="filter-label">Sort by:</span>
      <form method="GET" id="sortForm">
        <select class="sort-select" name="sort" onchange="document.getElementById('sortForm').submit()">
          <option value="default" {{ request('sort','default')=='default' ? 'selected':'' }}>Default</option>
          <option value="price_asc"  {{ request('sort')=='price_asc'  ? 'selected':'' }}>Price: Low to High</option>
          <option value="price_desc" {{ request('sort')=='price_desc' ? 'selected':'' }}>Price: High to Low</option>
          <option value="newest"     {{ request('sort')=='newest'     ? 'selected':'' }}>Newest First</option>
          <option value="name_asc"   {{ request('sort')=='name_asc'   ? 'selected':'' }}>Name A–Z</option>
        </select>
      </form>
    </div>
    <div class="result-count">
      Showing <strong>{{ $products->firstItem() }}–{{ $products->lastItem() }}</strong> of <strong>{{ $products->total() }}</strong> products
    </div>
  </div>

  {{-- LAYOUT --}}
  <div class="cat-layout">

    {{-- SIDEBAR --}}
    <aside class="sidebar">
      <div class="sidebar-title">All Categories</div>
      @foreach($allCategories as $cat)
        @php $icon = $catIcons[$cat->name] ?? '🛒'; @endphp
        <a href="{{ route('category.show', $cat->slug) }}" class="sidebar-cat-link {{ $cat->id == $category->id ? 'active' : '' }}">
          <span><span class="sidebar-cat-icon">{{ $icon }}</span>{{ $cat->name }}</span>
          <span style="font-size:11px;color:#9ca3af">{{ $cat->activeProducts_count ?? '' }}</span>
        </a>
      @endforeach
      <div class="sidebar-divider"></div>
      <div class="sidebar-title">Filter by Price</div>
      <div class="price-range">
        <form method="GET" id="priceForm">
          <input type="hidden" name="sort" value="{{ request('sort') }}">
          <div class="price-inputs">
            <input class="price-input" type="number" name="min_price" placeholder="Min ₹" value="{{ request('min_price') }}">
            <input class="price-input" type="number" name="max_price" placeholder="Max ₹" value="{{ request('max_price') }}">
          </div>
          <button type="submit" class="apply-price">Apply Filter</button>
        </form>
      </div>
    </aside>

    {{-- PRODUCTS --}}
    <div>
      <div class="products-grid">
        @forelse($products as $product)
          @php $pIcon = $catIcons[$product->category->name ?? ''] ?? '🛒'; @endphp
          <div class="prod-card">
            @if($product->is_on_sale)
              <div class="prod-badge badge-sale">{{ $product->discount_percent }}% OFF</div>
            @elseif($product->is_new_arrival)
              <div class="prod-badge badge-new">NEW</div>
            @elseif($product->is_bestseller)
              <div class="prod-badge badge-hot">HOT</div>
            @endif
            <button class="prod-wish" onclick="toggleWish(this)" title="Wishlist">🤍</button>
            <a href="{{ route('product.show', $product->slug) }}">
              <div class="prod-img-wrap">
                @if($product->thumbnail)
                  <img src="{{ asset('storage/'.$product->thumbnail) }}" alt="{{ $product->name }}">
                @else
                  <div class="prod-emoji">{{ $pIcon }}</div>
                @endif
              </div>
            </a>
            <div class="prod-body">
              <div class="prod-cat-tag">{{ $product->category->name ?? '' }}</div>
              <a href="{{ route('product.show', $product->slug) }}" style="text-decoration:none;color:inherit">
                <div class="prod-name">{{ $product->name }}</div>
              </a>
              <div class="prod-weight">{{ $product->weight }} · {{ $product->unit }}</div>
              <div class="prod-rating">
                <span class="stars">★★★★☆</span>
                <span class="rating-n">({{ $product->approvedReviews->count() ?? 0 }})</span>
              </div>
              <div class="prod-footer">
                <div class="prod-price-wrap">
                  <div class="prod-price">₹{{ number_format($product->current_price) }}</div>
                  @if($product->is_on_sale)
                    <div class="prod-price-old">₹{{ number_format($product->price) }}</div>
                  @endif
                </div>
                @if($product->is_in_stock)
                  <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="qty" value="1">
                    <button type="submit" class="btn-add" onclick="addToCartAnim(this)">+</button>
                  </form>
                @else
                  <button class="btn-add" disabled>✕</button>
                @endif
              </div>
            </div>
          </div>
        @empty
          <div class="empty-state">
            <div class="empty-icon">📦</div>
            <div class="empty-title">No products in {{ $category->name }} yet</div>
            <div class="empty-sub">New products are coming soon. Check other categories!</div>
            <a href="{{ route('shop') }}" class="btn-browse">Browse All Products →</a>
          </div>
        @endforelse
      </div>

      {{-- PAGINATION --}}
      @if($products->hasPages())
      <div class="pagination-wrap">
        {{-- Previous --}}
        @if($products->onFirstPage())
          <span class="page-link disabled">‹</span>
        @else
          <a href="{{ $products->previousPageUrl() }}" class="page-link">‹</a>
        @endif

        {{-- Page Numbers --}}
        @foreach($products->getUrlRange(max(1,$products->currentPage()-2), min($products->lastPage(),$products->currentPage()+2)) as $page => $url)
          <a href="{{ $url }}" class="page-link {{ $page == $products->currentPage() ? 'active' : '' }}">{{ $page }}</a>
        @endforeach

        {{-- Next --}}
        @if($products->hasMorePages())
          <a href="{{ $products->nextPageUrl() }}" class="page-link">›</a>
        @else
          <span class="page-link disabled">›</span>
        @endif
      </div>
      @endif
    </div>
  </div>
</div>

{{-- MOBILE DRAWER --}}
<div class="mob-drawer" id="mobDrawer">
  <div class="mob-overlay" onclick="closeMenu()"></div>
  <div class="mob-panel">
    <div class="mob-panel-head">
      <div class="mob-panel-logo">All You <span>Want</span></div>
      <button class="mob-close" onclick="closeMenu()">✕</button>
    </div>
    <div style="padding:14px 18px;border-bottom:1px solid #f3f4f6">
      <form action="{{ route('shop.search') }}" method="GET">
        <input type="text" name="q" placeholder="Search..." style="width:100%;padding:10px 14px;border:1.5px solid #d1d5db;border-radius:8px;font-size:13.5px;outline:none;font-family:inherit">
      </form>
    </div>
    <div style="display:flex;gap:10px;padding:16px 18px">
      @auth
        <a href="{{ route('account.index') }}" style="flex:1;padding:11px;border:1.5px solid #0d6e39;border-radius:8px;font-size:13.5px;font-weight:600;color:#0d6e39;text-align:center;text-decoration:none">My Account</a>
      @else
        <a href="{{ route('login') }}" style="flex:1;padding:11px;border:1.5px solid #0d6e39;border-radius:8px;font-size:13.5px;font-weight:600;color:#0d6e39;text-align:center;text-decoration:none">Login</a>
        <a href="{{ route('register') }}" style="flex:1;padding:11px;background:#0d6e39;border:none;border-radius:8px;font-size:13.5px;font-weight:600;color:#fff;text-align:center;text-decoration:none">Register</a>
      @endauth
    </div>
    <div>
      <div class="mob-nav-title">Categories</div>
      @foreach($allCategories as $cat)
        @php $icons = ['Vegetables'=>'🥬','Fruits'=>'🍎','Dairy & Eggs'=>'🥛','Meat & Fish'=>'🍗','Bakery'=>'🧁','Beverages'=>'🧃','Instant Food'=>'🍜','Personal Care'=>'🧴','Household'=>'🏠','Pet Care'=>'🐾']; @endphp
        <a href="{{ route('category.show', $cat->slug) }}" class="mob-nav-link {{ $cat->id==$category->id ? 'active':'' }}" style="{{ $cat->id==$category->id ? 'background:#f0faf4;color:#0d6e39;font-weight:600':'' }}">
          {{ $icons[$cat->name] ?? '🛒' }} {{ $cat->name }}
        </a>
      @endforeach
    </div>
  </div>
</div>

{{-- MOBILE BOTTOM NAV --}}
<div class="mob-bottom-nav">
  <div class="mob-bottom-nav-inner">
    <a href="{{ route('home') }}" class="mob-nav-item"><svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>Home</a>
    <a href="{{ route('shop') }}" class="mob-nav-item"><svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>Shop</a>
    <a href="{{ route('cart.index') }}" class="mob-nav-item"><svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>Cart</a>
    <a href="{{ route('offers') }}" class="mob-nav-item"><svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>Offers</a>
    <a href="{{ auth()->check() ? route('account.index') : route('login') }}" class="mob-nav-item"><svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>Account</a>
  </div>
</div>

<script>
function openMenu(){document.getElementById('mobDrawer').classList.add('open');document.body.style.overflow='hidden'}
function closeMenu(){document.getElementById('mobDrawer').classList.remove('open');document.body.style.overflow=''}
function toggleWish(el){el.textContent=el.textContent==='🤍'?'❤️':'🤍';el.style.background=el.textContent==='❤️'?'#fff0f0':''}
function addToCartAnim(btn){btn.textContent='✓';btn.style.background='#0a5a2e';setTimeout(()=>{btn.textContent='+';btn.style.background=''},1800)}

// Scroll animations
const io=new IntersectionObserver(entries=>entries.forEach(e=>{if(e.isIntersecting){e.target.style.opacity='1';e.target.style.transform='translateY(0)'}}),{threshold:.06});
document.querySelectorAll('.prod-card').forEach(el=>{el.style.opacity='0';el.style.transform='translateY(16px)';el.style.transition='opacity .4s ease,transform .4s ease';io.observe(el)});
</script>
</body>
</html>