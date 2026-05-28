<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Offers & Deals — All You Want</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth;font-size:15px}
body{font-family:'Inter',sans-serif;background:#f8f9fa;color:#1a1a2e;-webkit-font-smoothing:antialiased}
a{text-decoration:none;color:inherit}ul{list-style:none}img{max-width:100%;display:block}button{cursor:pointer;font-family:inherit}
.topbar{background:#0d6e39;color:#fff;font-size:12.5px;padding:7px 0}
.topbar-inner{max-width:1320px;margin:0 auto;padding:0 20px;display:flex;justify-content:space-between;align-items:center;gap:12px}
.topbar-left{display:flex;align-items:center;gap:18px}.topbar-left span{display:flex;align-items:center;gap:5px;opacity:.9}
.topbar-right{display:flex;align-items:center;gap:16px}.topbar-right a{opacity:.85;font-size:12px;color:#fff;transition:opacity .15s}.topbar-right a:hover{opacity:1}
.topbar-divider{opacity:.3;font-size:11px}
.navbar{background:#fff;border-bottom:1px solid #e8edf0;position:sticky;top:0;z-index:200;box-shadow:0 1px 6px rgba(0,0,0,.06)}
.navbar-inner{max-width:1320px;margin:0 auto;padding:0 20px;display:flex;align-items:center;gap:20px;height:68px}
.logo{display:flex;align-items:center;gap:9px;flex-shrink:0}
.logo-mark{width:36px;height:36px;background:#0d6e39;border-radius:9px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:18px;font-weight:800;letter-spacing:-1px}
.logo-text{font-size:20px;font-weight:800;color:#1a1a2e;letter-spacing:-.5px}.logo-text span{color:#0d6e39}
.logo-sub{font-size:10px;color:#6b7280;letter-spacing:.5px;text-transform:uppercase;display:block;margin-top:-2px}
.search-wrap{flex:1;max-width:580px}
.search-box{display:flex;border:1.5px solid #d1d5db;border-radius:10px;overflow:hidden;transition:border-color .2s,box-shadow .2s;background:#fff}
.search-box:focus-within{border-color:#0d6e39;box-shadow:0 0 0 3px rgba(13,110,57,.10)}
.search-input{flex:1;border:none;padding:11px 14px;font-size:13.5px;outline:none;background:#fff;color:#111}.search-input::placeholder{color:#9ca3af}
.search-btn{background:#0d6e39;border:none;color:#fff;padding:0 20px;font-size:14px;font-weight:500;transition:background .2s;display:flex;align-items:center;gap:6px;cursor:pointer}
.search-btn:hover{background:#0a5a2e}
.nav-right{display:flex;align-items:center;gap:6px;margin-left:auto;flex-shrink:0}
.nav-icon-btn{display:flex;flex-direction:column;align-items:center;gap:2px;padding:7px 12px;border-radius:8px;border:none;background:none;color:#374151;font-size:11.5px;font-weight:500;transition:background .15s;white-space:nowrap;cursor:pointer;text-decoration:none}
.nav-icon-btn:hover{background:#f3f4f6;color:#0d6e39}
.nav-icon-btn svg{width:22px;height:22px;stroke:#374151;stroke-width:1.8;fill:none}.nav-icon-btn:hover svg{stroke:#0d6e39}
.btn-cart{background:#0d6e39;color:#fff;border-radius:10px;padding:9px 18px;font-size:13px;font-weight:600;border:none;display:flex;align-items:center;gap:8px;transition:background .2s;text-decoration:none}
.btn-cart:hover{background:#0a5a2e}.btn-cart svg{width:18px;height:18px;stroke:#fff;stroke-width:2;fill:none}
.cart-count{background:rgba(255,255,255,.25);border-radius:5px;padding:1px 6px;font-size:12px;font-weight:700}
.cat-nav{background:#fff;border-bottom:1px solid #e8edf0}
.cat-nav-inner{max-width:1320px;margin:0 auto;padding:0 20px;display:flex;align-items:center;overflow-x:auto;scrollbar-width:none}
.cat-nav-inner::-webkit-scrollbar{display:none}
.cat-link{display:flex;align-items:center;gap:6px;padding:11px 16px;font-size:13px;font-weight:500;color:#4b5563;white-space:nowrap;border-bottom:2.5px solid transparent;transition:all .15s;text-decoration:none}
.cat-link:hover,.cat-link.active{color:#0d6e39;border-bottom-color:#0d6e39}
.page-wrap{max-width:1320px;margin:0 auto;padding:0 20px}
.breadcrumb{padding:16px 0;display:flex;align-items:center;gap:6px;font-size:13px;color:#6b7280}
.breadcrumb a{color:#0d6e39;font-weight:500}

/* OFFERS HERO */
.offers-hero{background:linear-gradient(120deg,#7c2d12 0%,#c2410c 55%,#ea580c 100%);border-radius:14px;padding:36px 44px;display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;position:relative;overflow:hidden}
.oh-glow{position:absolute;width:320px;height:320px;border-radius:50%;background:rgba(255,255,255,.05);right:-60px;top:-80px}
.oh-text{z-index:1}
.oh-tag{display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,.15);color:rgba(255,255,255,.9);font-size:12px;font-weight:500;padding:5px 12px;border-radius:20px;margin-bottom:10px}
.oh-title{font-size:34px;font-weight:800;color:#fff;letter-spacing:-.5px;margin-bottom:6px}
.oh-sub{font-size:14px;color:rgba(255,255,255,.75);max-width:360px}
.oh-emoji{font-size:90px;z-index:1;line-height:1;filter:drop-shadow(0 8px 24px rgba(0,0,0,.2))}

/* COUPON CARDS */
.coupon-strip{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:28px}
.coupon-card{background:#fff;border:2px dashed #d1fae5;border-radius:12px;padding:18px 20px;display:flex;align-items:center;justify-content:space-between;gap:12px;transition:all .2s}
.coupon-card:hover{border-color:#0d6e39;box-shadow:0 4px 16px rgba(13,110,57,.10)}
.coupon-left{display:flex;flex-direction:column;gap:3px}
.coupon-code{font-size:17px;font-weight:800;color:#0d6e39;letter-spacing:1px}
.coupon-desc{font-size:12.5px;color:#6b7280}
.coupon-min{font-size:11.5px;color:#9ca3af}
.coupon-copy{padding:8px 16px;background:#f0faf4;border:1.5px solid #0d6e39;border-radius:8px;font-size:12.5px;font-weight:600;color:#0d6e39;cursor:pointer;transition:all .15s;font-family:inherit}
.coupon-copy:hover{background:#0d6e39;color:#fff}

/* PRODUCTS */
.sec-title{font-size:22px;font-weight:800;color:#1a1a2e;letter-spacing:-.4px;margin-bottom:4px}
.sec-title span{color:#e53935}
.sec-sub{font-size:13px;color:#6b7280;margin-bottom:20px}
.products-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:14px}
.prod-card{background:#fff;border:1.5px solid #e8edf0;border-radius:12px;overflow:hidden;transition:all .2s;cursor:pointer;position:relative}
.prod-card:hover{transform:translateY(-4px);box-shadow:0 12px 32px rgba(0,0,0,.09);border-color:#fca5a5}
.prod-badge{position:absolute;top:10px;left:10px;font-size:10.5px;font-weight:700;padding:3px 9px;border-radius:5px;z-index:2}
.badge-sale{background:#ff3b30;color:#fff}
.prod-wish{position:absolute;top:10px;right:10px;width:30px;height:30px;background:#fff;border:1px solid #e8edf0;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:14px;z-index:2;transition:all .15s;cursor:pointer}
.prod-wish:hover{background:#fff0f0;border-color:#fca5a5}
.prod-img-wrap{height:160px;background:#f8fafc;display:flex;align-items:center;justify-content:center;overflow:hidden;transition:transform .3s}
.prod-img-wrap img{width:100%;height:100%;object-fit:cover}
.prod-card:hover .prod-img-wrap{transform:scale(1.05)}
.prod-emoji{font-size:72px;line-height:1}
.prod-body{padding:12px}
.prod-cat-tag{font-size:11px;color:#0d6e39;font-weight:600;text-transform:uppercase;letter-spacing:.3px;margin-bottom:4px}
.prod-name{font-size:13.5px;font-weight:600;color:#1a1a2e;line-height:1.35;margin-bottom:3px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
.prod-weight{font-size:12px;color:#9ca3af;margin-bottom:8px}
.prod-footer{display:flex;align-items:center;justify-content:space-between;gap:6px}
.prod-price-wrap{display:flex;flex-direction:column}
.prod-price{font-size:17px;font-weight:800;color:#e53935;line-height:1}
.prod-price-old{font-size:12px;color:#9ca3af;text-decoration:line-through;margin-top:1px}
.prod-savings{font-size:11px;color:#0d6e39;font-weight:600;margin-top:2px}
.btn-add{width:34px;height:34px;background:#0d6e39;border:none;border-radius:8px;color:#fff;font-size:20px;display:flex;align-items:center;justify-content:center;transition:all .15s;flex-shrink:0;cursor:pointer}
.btn-add:hover{background:#0a5a2e;transform:scale(1.08)}
.empty-state{grid-column:1/-1;text-align:center;padding:64px 20px;background:#fff;border-radius:12px;border:1.5px dashed #e8edf0}
.empty-icon{font-size:52px;margin-bottom:14px}
.empty-title{font-size:17px;font-weight:700;color:#1a1a2e;margin-bottom:6px}
.empty-sub{font-size:14px;color:#9ca3af;margin-bottom:20px}
.btn-browse{display:inline-flex;align-items:center;gap:6px;background:#0d6e39;color:#fff;padding:11px 24px;border-radius:8px;font-size:13.5px;font-weight:600;text-decoration:none;transition:background .2s}
.btn-browse:hover{background:#0a5a2e}
.pagination-wrap{margin-top:32px;display:flex;justify-content:center;align-items:center;gap:6px}
.pagination-wrap .page-link{display:flex;align-items:center;justify-content:center;width:38px;height:38px;border:1.5px solid #e8edf0;border-radius:8px;font-size:13.5px;font-weight:500;color:#374151;background:#fff;text-decoration:none;transition:all .15s}
.pagination-wrap .page-link:hover{border-color:#0d6e39;color:#0d6e39;background:#f0faf4}
.pagination-wrap .page-link.active{background:#0d6e39;color:#fff;border-color:#0d6e39}
.pagination-wrap .page-link.disabled{opacity:.4;pointer-events:none}
.mob-menu-btn{display:none;flex-direction:column;justify-content:center;gap:5px;width:40px;height:40px;background:none;border:1.5px solid #e8edf0;border-radius:8px;padding:8px;cursor:pointer;flex-shrink:0}
.mob-menu-btn span{display:block;height:2px;background:#374151;border-radius:2px}
.mob-cart-icon{display:none;align-items:center;justify-content:center;position:relative;width:40px;height:40px;border:1.5px solid #e8edf0;border-radius:8px;background:none;cursor:pointer;flex-shrink:0;text-decoration:none}
.mob-cart-icon svg{width:20px;height:20px;stroke:#374151;stroke-width:1.8;fill:none}
.mob-bottom-nav{display:none;position:fixed;bottom:0;left:0;right:0;background:#fff;border-top:1px solid #e8edf0;z-index:400;padding:6px 0}
.mob-bottom-nav-inner{display:flex;justify-content:space-around}
.mob-nav-item{display:flex;flex-direction:column;align-items:center;gap:3px;padding:6px 16px;font-size:11px;font-weight:500;color:#6b7280;cursor:pointer;min-width:56px;transition:color .15s;text-decoration:none}
.mob-nav-item.active,.mob-nav-item:hover{color:#0d6e39}
.mob-nav-item svg{width:22px;height:22px;stroke:currentColor;stroke-width:1.8;fill:none}
.mob-drawer{display:none;position:fixed;inset:0;z-index:500}
.mob-overlay{position:absolute;inset:0;background:rgba(0,0,0,.45)}
.mob-panel{position:absolute;left:0;top:0;bottom:0;width:300px;background:#fff;overflow-y:auto;transform:translateX(-100%);transition:transform .3s ease;padding:0 0 80px}
.mob-drawer.open .mob-panel{transform:translateX(0)}.mob-drawer.open{display:block}
.mob-panel-head{display:flex;align-items:center;justify-content:space-between;padding:16px 18px;border-bottom:1px solid #e8edf0;background:#0d6e39}
.mob-panel-logo{font-size:18px;font-weight:800;color:#fff}.mob-panel-logo span{color:#fcd34d}
.mob-close{background:rgba(255,255,255,.15);border:none;color:#fff;width:32px;height:32px;border-radius:8px;font-size:18px;cursor:pointer;display:flex;align-items:center;justify-content:center}
.mob-nav-link{display:flex;align-items:center;gap:12px;padding:12px 18px;font-size:14px;color:#374151;font-weight:500;border-bottom:1px solid #f9fafb;transition:background .15s;text-decoration:none}
.mob-nav-link:hover{background:#f0faf4;color:#0d6e39}
.mob-nav-title{font-size:11px;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.6px;padding:8px 18px 4px}
.alert-success{background:#dcfce7;border-bottom:1px solid #bbf7d0;color:#15803d;padding:10px 20px;font-size:13px;font-weight:500}
.alert-error{background:#fef2f2;border-bottom:1px solid #fecaca;color:#dc2626;padding:10px 20px;font-size:13px;font-weight:500}
@media(max-width:1024px){.products-grid{grid-template-columns:repeat(3,1fr)}.coupon-strip{grid-template-columns:1fr 1fr}}
@media(max-width:768px){
  html{font-size:14px}.topbar{display:none}.navbar-inner{height:58px;gap:10px;padding:0 14px}
  .search-wrap{display:none}.nav-icon-btn{display:none}.btn-cart{display:none}
  .mob-menu-btn{display:flex}.mob-cart-icon{display:flex}.page-wrap{padding:0 14px}
  .offers-hero{padding:22px 20px;border-radius:12px;margin-bottom:18px}.oh-title{font-size:22px}.oh-emoji{font-size:60px}
  .coupon-strip{grid-template-columns:1fr}.products-grid{grid-template-columns:repeat(2,1fr);gap:10px}
  .mob-bottom-nav{display:block}body{padding-bottom:62px}
}
@media(max-width:480px){.oh-emoji{display:none}.products-grid{grid-template-columns:repeat(2,1fr);gap:8px}}
</style>
</head>
<body>

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
      <?php if(auth()->guard()->check()): ?>
        <a href="<?php echo e(route('account.index')); ?>">My Account</a>
        <span class="topbar-divider">|</span>
        <form action="<?php echo e(route('logout')); ?>" method="POST" style="display:inline"><?php echo csrf_field(); ?><button style="background:none;border:none;color:rgba(255,255,255,.85);cursor:pointer;font-size:12px;font-family:inherit">Logout</button></form>
      <?php else: ?>
        <a href="<?php echo e(route('login')); ?>">Login</a>
        <span class="topbar-divider">|</span>
        <a href="<?php echo e(route('register')); ?>">Register</a>
      <?php endif; ?>
    </div>
  </div>
</div>

<nav class="navbar">
  <div class="navbar-inner">
    <a href="<?php echo e(route('home')); ?>" class="logo">
      <div class="logo-mark">A</div>
      <div><div class="logo-text">All You <span>Want</span></div><span class="logo-sub">Fresh • Fast • Reliable</span></div>
    </a>
    <div class="search-wrap">
      <form action="<?php echo e(route('shop.search')); ?>" method="GET" class="search-box">
        <input class="search-input" type="text" name="q" placeholder="Search products..." value="<?php echo e(request('q')); ?>">
        <button class="search-btn" type="submit">
          <svg viewBox="0 0 24 24" style="width:16px;height:16px;stroke:#fff;fill:none;stroke-width:2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
          Search
        </button>
      </form>
    </div>
    <div class="nav-right">
      <?php if(auth()->guard()->check()): ?>
        <a href="<?php echo e(route('account.index')); ?>" class="nav-icon-btn"><svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>Account</a>
      <?php else: ?>
        <a href="<?php echo e(route('login')); ?>" class="nav-icon-btn"><svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>Login</a>
      <?php endif; ?>
      <a href="<?php echo e(route('cart.index')); ?>" class="btn-cart">
        <svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
        My Cart
        <?php $cartCount = count(session('cart',[])); ?>
        <?php if($cartCount > 0): ?><span class="cart-count"><?php echo e($cartCount); ?></span><?php endif; ?>
      </a>
    </div>
    <a href="<?php echo e(route('cart.index')); ?>" class="mob-cart-icon"><svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg></a>
    <button class="mob-menu-btn" onclick="openMenu()"><span></span><span></span><span></span></button>
  </div>
</nav>

<div class="cat-nav">
  <div class="cat-nav-inner">
    <a href="<?php echo e(route('home')); ?>" class="cat-link">🏠 Home</a>
    <a href="<?php echo e(route('shop')); ?>" class="cat-link">🛒 All Products</a>
    <?php $__currentLoopData = $allCategories ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php $icons = ['Vegetables'=>'🥬','Fruits'=>'🍎','Dairy & Eggs'=>'🥛','Meat & Fish'=>'🍗','Bakery'=>'🧁','Beverages'=>'🧃','Instant Food'=>'🍜','Personal Care'=>'🧴','Household'=>'🏠','Pet Care'=>'🐾']; ?>
      <a href="<?php echo e(route('category.show', $cat->slug)); ?>" class="cat-link"><?php echo e($icons[$cat->name] ?? '🛒'); ?> <?php echo e($cat->name); ?></a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <a href="<?php echo e(route('offers')); ?>" class="cat-link active" style="color:#e53935;border-bottom-color:#e53935">🔥 Offers</a>
  </div>
</div>

<?php if(session('success')): ?><div class="alert-success">✅ <?php echo e(session('success')); ?></div><?php endif; ?>
<?php if(session('error')): ?><div class="alert-error">❌ <?php echo e(session('error')); ?></div><?php endif; ?>

<div class="page-wrap" style="padding-top:4px;padding-bottom:40px">
  <div class="breadcrumb">
    <a href="<?php echo e(route('home')); ?>">Home</a>
    <span style="color:#d1d5db">›</span>
    <span style="color:#1a1a2e;font-weight:500">Offers & Deals</span>
  </div>

  <div class="offers-hero">
    <div class="oh-glow"></div>
    <div class="oh-text">
      <div class="oh-tag">🔥 Limited Time Deals</div>
      <div class="oh-title">Exclusive Offers & Deals</div>
      <div class="oh-sub"><?php echo e($products->total()); ?> sale products available now. Grab them before they expire!</div>
    </div>
    <div class="oh-emoji">🏷️</div>
  </div>

  
  <div class="coupon-strip">
    <div class="coupon-card">
      <div class="coupon-left">
        <div class="coupon-code">VEGGIE30</div>
        <div class="coupon-desc">30% OFF on Fresh Vegetables</div>
        <div class="coupon-min">Min. order ₹299</div>
      </div>
      <button class="coupon-copy" onclick="copyCoupon(this,'VEGGIE30')">Copy Code</button>
    </div>
    <div class="coupon-card">
      <div class="coupon-left">
        <div class="coupon-code">WELCOME100</div>
        <div class="coupon-desc">Flat ₹100 OFF — First Order</div>
        <div class="coupon-min">Min. order ₹299 · New users only</div>
      </div>
      <button class="coupon-copy" onclick="copyCoupon(this,'WELCOME100')">Copy Code</button>
    </div>
    <div class="coupon-card">
      <div class="coupon-left">
        <div class="coupon-code">FREEDEL</div>
        <div class="coupon-desc">Free Delivery on Any Order</div>
        <div class="coupon-min">No minimum order value</div>
      </div>
      <button class="coupon-copy" onclick="copyCoupon(this,'FREEDEL')">Copy Code</button>
    </div>
  </div>

  
  <div class="sec-title">🔥 <span>Sale</span> Products</div>
  <div class="sec-sub">All products with active discounts</div>
  <div class="products-grid">
    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <?php $icons = ['Vegetables'=>'🥬','Fruits'=>'🍎','Dairy & Eggs'=>'🥛','Meat & Fish'=>'🍗','Bakery'=>'🧁','Beverages'=>'🧃','Instant Food'=>'🍜','Personal Care'=>'🧴','Household'=>'🏠','Pet Care'=>'🐾']; $pIcon = $icons[$product->category->name ?? ''] ?? '🛒'; ?>
      <div class="prod-card">
        <div class="prod-badge badge-sale"><?php echo e($product->discount_percent); ?>% OFF</div>
        <button class="prod-wish" onclick="toggleWish(this)">🤍</button>
        <a href="<?php echo e(route('product.show', $product->slug)); ?>">
          <div class="prod-img-wrap">
            <?php if($product->thumbnail): ?><img src="<?php echo e(asset('storage/'.$product->thumbnail)); ?>" alt="<?php echo e($product->name); ?>">
            <?php else: ?><div class="prod-emoji"><?php echo e($pIcon); ?></div><?php endif; ?>
          </div>
        </a>
        <div class="prod-body">
          <div class="prod-cat-tag"><?php echo e($product->category->name ?? ''); ?></div>
          <a href="<?php echo e(route('product.show', $product->slug)); ?>" style="text-decoration:none;color:inherit"><div class="prod-name"><?php echo e($product->name); ?></div></a>
          <div class="prod-weight"><?php echo e($product->weight); ?> · <?php echo e($product->unit); ?></div>
          <div class="prod-footer">
            <div class="prod-price-wrap">
              <div class="prod-price">₹<?php echo e(number_format($product->current_price)); ?></div>
              <div class="prod-price-old">₹<?php echo e(number_format($product->price)); ?></div>
              <div class="prod-savings">Save ₹<?php echo e(number_format($product->price - $product->current_price)); ?></div>
            </div>
            <?php if($product->is_in_stock): ?>
              <form action="<?php echo e(route('cart.add')); ?>" method="POST"><?php echo csrf_field(); ?><input type="hidden" name="product_id" value="<?php echo e($product->id); ?>"><input type="hidden" name="qty" value="1"><button type="submit" class="btn-add" onclick="addToCartAnim(this)">+</button></form>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <div class="empty-state">
        <div class="empty-icon">🏷️</div>
        <div class="empty-title">No active offers right now</div>
        <div class="empty-sub">Check back soon — new deals drop every day!</div>
        <a href="<?php echo e(route('shop')); ?>" class="btn-browse">Browse All Products →</a>
      </div>
    <?php endif; ?>
  </div>

  <?php if($products->hasPages()): ?>
  <div class="pagination-wrap">
    <?php if($products->onFirstPage()): ?><span class="page-link disabled">‹</span><?php else: ?><a href="<?php echo e($products->previousPageUrl()); ?>" class="page-link">‹</a><?php endif; ?>
    <?php $__currentLoopData = $products->getUrlRange(max(1,$products->currentPage()-2),min($products->lastPage(),$products->currentPage()+2)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <a href="<?php echo e($url); ?>" class="page-link <?php echo e($page==$products->currentPage()?'active':''); ?>"><?php echo e($page); ?></a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php if($products->hasMorePages()): ?><a href="<?php echo e($products->nextPageUrl()); ?>" class="page-link">›</a><?php else: ?><span class="page-link disabled">›</span><?php endif; ?>
  </div>
  <?php endif; ?>
</div>

<div class="mob-drawer" id="mobDrawer">
  <div class="mob-overlay" onclick="closeMenu()"></div>
  <div class="mob-panel">
    <div class="mob-panel-head"><div class="mob-panel-logo">All You <span>Want</span></div><button class="mob-close" onclick="closeMenu()">✕</button></div>
    <div style="display:flex;gap:10px;padding:16px 18px">
      <?php if(auth()->guard()->check()): ?><a href="<?php echo e(route('account.index')); ?>" style="flex:1;padding:11px;border:1.5px solid #0d6e39;border-radius:8px;font-size:13.5px;font-weight:600;color:#0d6e39;text-align:center;text-decoration:none">My Account</a>
      <?php else: ?><a href="<?php echo e(route('login')); ?>" style="flex:1;padding:11px;border:1.5px solid #0d6e39;border-radius:8px;font-size:13.5px;font-weight:600;color:#0d6e39;text-align:center;text-decoration:none">Login</a><a href="<?php echo e(route('register')); ?>" style="flex:1;padding:11px;background:#0d6e39;border:none;border-radius:8px;font-size:13.5px;font-weight:600;color:#fff;text-align:center;text-decoration:none">Register</a><?php endif; ?>
    </div>
    <div class="mob-nav-title">Categories</div>
    <?php $__currentLoopData = $allCategories ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php $icons = ['Vegetables'=>'🥬','Fruits'=>'🍎','Dairy & Eggs'=>'🥛','Meat & Fish'=>'🍗','Bakery'=>'🧁','Beverages'=>'🧃','Instant Food'=>'🍜','Personal Care'=>'🧴','Household'=>'🏠','Pet Care'=>'🐾']; ?>
      <a href="<?php echo e(route('category.show', $cat->slug)); ?>" class="mob-nav-link"><?php echo e($icons[$cat->name] ?? '🛒'); ?> <?php echo e($cat->name); ?></a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</div>

<div class="mob-bottom-nav">
  <div class="mob-bottom-nav-inner">
    <a href="<?php echo e(route('home')); ?>" class="mob-nav-item"><svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>Home</a>
    <a href="<?php echo e(route('shop')); ?>" class="mob-nav-item"><svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>Shop</a>
    <a href="<?php echo e(route('cart.index')); ?>" class="mob-nav-item"><svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>Cart</a>
    <a href="<?php echo e(route('offers')); ?>" class="mob-nav-item active" style="color:#0d6e39"><svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>Offers</a>
    <a href="<?php echo e(auth()->check() ? route('account.index') : route('login')); ?>" class="mob-nav-item"><svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>Account</a>
  </div>
</div>

<script>
function openMenu(){document.getElementById('mobDrawer').classList.add('open');document.body.style.overflow='hidden'}
function closeMenu(){document.getElementById('mobDrawer').classList.remove('open');document.body.style.overflow=''}
function toggleWish(el){el.textContent=el.textContent==='🤍'?'❤️':'🤍';el.style.background=el.textContent==='❤️'?'#fff0f0':''}
function addToCartAnim(btn){btn.textContent='✓';btn.style.background='#0a5a2e';setTimeout(()=>{btn.textContent='+';btn.style.background=''},1800)}
function copyCoupon(btn,code){navigator.clipboard.writeText(code).then(()=>{btn.textContent='Copied!';btn.style.background='#0d6e39';btn.style.color='#fff';setTimeout(()=>{btn.textContent='Copy Code';btn.style.background='';btn.style.color=''},2000)})}
const io=new IntersectionObserver(entries=>entries.forEach(e=>{if(e.isIntersecting){e.target.style.opacity='1';e.target.style.transform='translateY(0)'}}),{threshold:.06});
document.querySelectorAll('.prod-card,.coupon-card').forEach(el=>{el.style.opacity='0';el.style.transform='translateY(16px)';el.style.transition='opacity .4s ease,transform .4s ease';io.observe(el)});
</script>
</body>
</html><?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views/frontend/offers.blade.php ENDPATH**/ ?>