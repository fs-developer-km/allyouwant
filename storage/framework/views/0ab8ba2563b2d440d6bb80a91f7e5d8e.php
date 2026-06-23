<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<title>All Categories — All You Want Grocery</title>
<meta name="description" content="Browse all grocery categories — Vegetables, Fruits, Dairy, Bakery and more. Delivered in 60 minutes.">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
/* ════════════════════════════════════════════
   ALL CATEGORIES PAGE — ALL YOU WANT GROCERY
   Professional Design — Client Project
════════════════════════════════════════════ */
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{font-family:'Inter',sans-serif;background:#f5f7fa;color:#1a1a2e;-webkit-font-smoothing:antialiased}
a{text-decoration:none;color:inherit}
img{display:block;max-width:100%}
:root{
  --g:#0d6e39;--g2:#0a5a2e;--gl:#f0faf4;--gl2:#dcfce7;
  --border:#e2e8f0;--text:#1a1a2e;--text2:#374151;--muted:#64748b;
  --white:#fff;--bg:#f5f7fa;
  --shadow:0 2px 8px rgba(0,0,0,.07);
  --shadow-md:0 8px 28px rgba(0,0,0,.10);
  --r:14px;
}

/* ── TOPBAR ── */
.topbar{background:var(--g);padding:7px 0;font-size:12.5px;color:#fff}
.topbar-inner{max-width:1360px;margin:0 auto;padding:0 20px;display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap}
.topbar-left{display:flex;align-items:center;gap:16px;opacity:.9}
.topbar-right{display:flex;align-items:center;gap:14px}
.topbar-right a{color:rgba(255,255,255,.85);font-size:12px;transition:color .15s}
.topbar-right a:hover{color:#fff}
.tb-sep{color:rgba(255,255,255,.3);font-size:10px}

/* ── NAVBAR ── */
.navbar-wrap{background:var(--white);border-bottom:1px solid var(--border);position:sticky;top:0;z-index:500;box-shadow:0 1px 8px rgba(0,0,0,.07)}
.nav-inner{max-width:1360px;margin:0 auto;padding:0 20px;height:66px;display:flex;align-items:center;gap:16px}
.logo{display:flex;align-items:center;gap:9px;flex-shrink:0;text-decoration:none}
.logo-icon{width:38px;height:38px;background:linear-gradient(135deg,var(--g),#22c55e);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:19px;box-shadow:0 3px 10px rgba(13,110,57,.3)}
.logo-name{font-size:19px;font-weight:800;color:var(--text);letter-spacing:-.4px}
.logo-name span{color:var(--g)}
.logo-sub{font-size:9px;color:var(--muted);letter-spacing:.4px;display:block}
.nav-search{flex:1;max-width:560px;display:flex;border:2px solid var(--border);border-radius:50px;overflow:hidden;transition:all .2s}
.nav-search:focus-within{border-color:var(--g);box-shadow:0 0 0 3px rgba(13,110,57,.1)}
.nav-search input{flex:1;border:none;padding:0 18px;font-size:13.5px;outline:none;font-family:inherit;height:42px}
.nav-search button{background:var(--g);border:none;color:#fff;padding:0 22px;font-size:13px;font-weight:600;cursor:pointer;transition:background .2s;height:42px;white-space:nowrap}
.nav-search button:hover{background:var(--g2)}
.nav-right{display:flex;align-items:center;gap:6px;margin-left:auto}
.nav-btn{display:flex;align-items:center;gap:5px;padding:8px 13px;border-radius:9px;font-size:13px;font-weight:600;color:var(--text2);transition:all .15s;text-decoration:none}
.nav-btn:hover{background:var(--gl);color:var(--g)}
.btn-cart-nav{background:var(--g);color:#fff!important;border-radius:50px;padding:9px 20px!important}
.btn-cart-nav:hover{background:var(--g2)!important}
.cart-badge{background:rgba(255,255,255,.25);border-radius:20px;padding:1px 8px;font-size:11.5px;font-weight:700}

/* ── BREADCRUMB ── */
.breadcrumb-bar{background:var(--white);border-bottom:1px solid var(--border);padding:9px 0}
.bc-inner{max-width:1360px;margin:0 auto;padding:0 20px;display:flex;align-items:center;gap:6px;font-size:13px;color:var(--muted);flex-wrap:wrap}
.bc-inner a{color:var(--g);font-weight:500;transition:opacity .15s}
.bc-inner a:hover{opacity:.75}
.bc-sep{color:#cbd5e1}

/* ── HERO BANNER ── */
.cats-hero{background:linear-gradient(135deg,#064e29 0%,var(--g) 55%,#22c55e 100%);padding:36px 0;position:relative;overflow:hidden}
.cats-hero::before{content:'';position:absolute;inset:0;background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Ccircle cx='30' cy='30' r='20' stroke='rgba(255,255,255,.05)' stroke-width='1'/%3E%3C/g%3E%3C/svg%3E") repeat}
.cats-hero-inner{max-width:1360px;margin:0 auto;padding:0 20px;position:relative;z-index:1;display:flex;align-items:center;justify-content:space-between;gap:24px;flex-wrap:wrap}
.cats-hero-text{}
.cats-hero-eyebrow{display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,.15);color:rgba(255,255,255,.9);font-size:12.5px;font-weight:600;padding:5px 14px;border-radius:20px;margin-bottom:12px;backdrop-filter:blur(4px);border:1px solid rgba(255,255,255,.2)}
.cats-hero-title{font-size:34px;font-weight:900;color:#fff;letter-spacing:-.8px;margin-bottom:8px;line-height:1.1}
.cats-hero-title em{color:#fde68a;font-style:normal}
.cats-hero-sub{font-size:14px;color:rgba(255,255,255,.8);line-height:1.65}
.cats-hero-stats{display:flex;gap:28px;margin-top:20px;flex-wrap:wrap}
.hs-num{font-size:22px;font-weight:900;color:#fde68a;line-height:1}
.hs-lbl{font-size:11.5px;color:rgba(255,255,255,.65);margin-top:2px}
.cats-hero-emoji{font-size:90px;line-height:1;animation:float 3.5s ease-in-out infinite;filter:drop-shadow(0 10px 28px rgba(0,0,0,.2))}
@keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-10px)}}

/* ── SEARCH + FILTER BAR ── */
.filter-bar{background:var(--white);border-bottom:1px solid var(--border);padding:12px 0;position:sticky;top:66px;z-index:400;box-shadow:0 2px 8px rgba(0,0,0,.04)}
.filter-bar-inner{max-width:1360px;margin:0 auto;padding:0 20px;display:flex;align-items:center;gap:12px;flex-wrap:wrap}
.cat-search-box{display:flex;border:1.5px solid var(--border);border-radius:50px;overflow:hidden;flex:1;max-width:380px;transition:all .2s}
.cat-search-box:focus-within{border-color:var(--g);box-shadow:0 0 0 3px rgba(13,110,57,.1)}
.cat-search-box input{flex:1;border:none;padding:9px 16px;font-size:13.5px;outline:none;font-family:inherit}
.cat-search-box button{background:var(--g);border:none;color:#fff;padding:0 18px;font-size:13px;cursor:pointer;font-family:inherit}
.sort-pills{display:flex;gap:6px;flex-wrap:wrap}
.sort-pill{padding:7px 15px;border-radius:50px;border:1.5px solid var(--border);font-size:12.5px;font-weight:600;color:var(--text2);cursor:pointer;transition:all .18s;background:var(--white)}
.sort-pill:hover,.sort-pill.active{background:var(--g);border-color:var(--g);color:#fff}
.view-toggle{display:flex;border:1.5px solid var(--border);border-radius:8px;overflow:hidden;margin-left:auto}
.vt-btn{width:36px;height:36px;background:var(--white);border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:16px;color:var(--muted);transition:all .15s}
.vt-btn:hover,.vt-btn.active{background:var(--gl);color:var(--g)}

/* ── PAGE CONTENT ── */
.page-content{max-width:1360px;margin:0 auto; background:#fff;padding:28px 20px 48px}

/* ── CATEGORY GROUP HEADING ── */
.group-head{display:flex;align-items:center;gap:12px;margin:28px 0 16px}
.group-head:first-child{margin-top:0}
.group-head-line{flex:1;height:1px;background:var(--border)}
.group-head-label{font-size:13.5px;font-weight:800;color:var(--muted);text-transform:uppercase;letter-spacing:.7px;white-space:nowrap;padding:0 4px}

/* ── CATEGORY CARD ── */
.cat-grid{display:grid;grid-template-columns:repeat(7,1fr);gap:10px}
.cat-grid.list-view{grid-template-columns:1fr}

/* Grid card */
.cat-card{
    /* background:var(--white); */
    /* border:1.5pxsolid var(--border); */
    border-radius:12px;
    overflow:hidden;
    transition:all .25s cubic-bezier(.4,0,.2,1);
    text-decoration:none;
    display:flex;
    flex-direction:column;
    position:relative;
    cursor:pointer
}

.cat-card:hover{transform:translateY(-6px);}
.cat-card-img{
    width:100%;
    /* aspect-ratio:1/1; */
    /* background:#f8fafc; */
    display:flex;
    align-items:center;
    justify-content:center;
    overflow:hidden;
    position:relative;
    transition:background .2s;

}
/* .cat-card:hover .cat-card-img{background:var(--gl)} */
.cat-card-img img{width:100%;height:100%;
     border-radius:12px;
    object-fit:contain;transition:transform .35s ease;}
/* .cat-card:hover .cat-card-img img{transform:scale(1.1)} */
.cat-card-emoji{font-size:52px;line-height:1;transition:transform .3s}
.cat-card:hover .cat-card-emoji{transform:scale(1.12)}
.cat-card-body{padding:12px 12px 14px;text-align:center}
.cat-card-name{font-size:13px;font-weight:700;color:var(--text);margin-bottom:4px;line-height:1.3}
.cat-card-count{font-size:11.5px;color:var(--muted)}
.cat-card-arrow{position:absolute;bottom:12px;right:12px;width:24px;height:24px;background:var(--gl);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:12px;color:var(--g);font-weight:800;opacity:0;transition:all .2s}
.cat-card:hover .cat-card-arrow{opacity:1;transform:translateX(2px)}
/* Color accents per card */
.cat-card-accent{position:absolute;bottom:0;left:0;right:0;height:3px;background:var(--g);transform:scaleX(0);transition:transform .25s;transform-origin:left}
.cat-card:hover .cat-card-accent{transform:scaleX(1)}

/* List card */
.cat-grid.list-view .cat-card{flex-direction:row;align-items:center;padding:16px 20px;gap:16px}
.cat-grid.list-view .cat-card-img{width:70px;height:70px;flex-shrink:0;border-radius:10px;aspect-ratio:1}
.cat-grid.list-view .cat-card-body{text-align:left;padding:0;flex:1}
.cat-grid.list-view .cat-card-name{font-size:15px;font-weight:700;margin-bottom:3px}
.cat-grid.list-view .cat-card-count{font-size:13px}
.cat-grid.list-view .cat-card-arrow{position:static;opacity:1;background:var(--gl);width:32px;height:32px;font-size:14px}
.cat-grid.list-view .cat-card-accent{height:100%;width:3px;left:0;bottom:0;top:0;transform:scaleY(0);transform-origin:top}
.cat-grid.list-view .cat-card:hover .cat-card-accent{transform:scaleY(1)}

/* Popular badge */
.popular-chip{position:absolute;top:8px;right:8px;background:#ff3b30;color:#fff;font-size:9.5px;font-weight:800;padding:2px 8px;border-radius:4px;letter-spacing:.2px}
.new-chip{position:absolute;top:8px;right:8px;background:var(--g);color:#fff;font-size:9.5px;font-weight:800;padding:2px 8px;border-radius:4px}

/* ── OFFERS STRIP ── */
.offers-strip{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin:28px 0}
.offer-strip-card{border-radius:12px;padding:18px 20px;display:flex;align-items:center;gap:14px;text-decoration:none;transition:transform .2s,box-shadow .2s;position:relative;overflow:hidden}
.offer-strip-card:hover{transform:translateY(-3px);box-shadow:0 12px 32px rgba(0,0,0,.12)}
.osc1{background:linear-gradient(135deg,#064e29,var(--g))}
.osc2{background:linear-gradient(135deg,#7c2d12,#dc2626)}
.osc3{background:linear-gradient(135deg,#312e81,#6366f1)}
.osc-emoji{font-size:44px;flex-shrink:0;filter:drop-shadow(0 4px 8px rgba(0,0,0,.2))}
.osc-text{}
.osc-eyebrow{font-size:10.5px;color:rgba(255,255,255,.7);font-weight:600;text-transform:uppercase;letter-spacing:.5px;margin-bottom:3px}
.osc-title{font-size:17px;font-weight:800;color:#fff;margin-bottom:3px;line-height:1.2}
.osc-sub{font-size:12px;color:rgba(255,255,255,.75)}
.osc-glow{position:absolute;width:120px;height:120px;border-radius:50%;background:rgba(255,255,255,.06);right:-20px;top:-30px}

/* ── POPULAR CATEGORIES ROW ── */
.popular-row{display:grid;grid-template-columns:repeat(8,1fr);gap:12px;margin-bottom:28px}
.pop-item{
    /* background:var(--white); */
    /* border:1.5px solid var(--border); */
    border-radius:10px;
    padding:0px 0px;
    display:flex;
    flex-direction:column;
    align-items:center;
    gap:8px;
    text-decoration:none;
    transition:all .2s;
    color:inherit
}
.pop-item:hover{

    border-color:#064e29;
    transform:translateY(-3px);
    box-shadow:0 8px 20px rgba(13,110,57,.1)
}
.pop-img{border-radius: 20px;
    height: 108px;
    background: #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 35px;
    overflow: hidden;
    transition: background .2s;
}
.pop-item:hover .pop-img{background:var(--g)}
.pop-img img{width:100%;height:100%;object-fit:cover;border-radius:0%}
.pop-name{font-size:11.5px;font-weight:700;color:var(--text2);text-align:center;line-height:1.3}
.pop-cnt{font-size:10.5px;color:var(--muted)}

/* ── EMPTY STATE ── */
.empty-cats{text-align:center;padding:72px 20px;grid-column:1/-1}
.empty-icon{font-size:72px;margin-bottom:18px;animation:float 2.5s ease-in-out infinite}

/* ── NO RESULTS ── */
.no-results{text-align:center;padding:60px 20px;background:var(--white);border-radius:var(--r);border:1px solid var(--border)}

/* ── MOBILE BOTTOM NAV ── */
.mob-bottom-nav{display:none;position:fixed;bottom:0;left:0;right:0;background:var(--white);border-top:1px solid var(--border);z-index:400;box-shadow:0 -3px 12px rgba(0,0,0,.07)}
.mbn-inner{display:flex;justify-content:space-around;padding:7px 0 env(safe-area-inset-bottom,6px)}
.mbn-item{display:flex;flex-direction:column;align-items:center;gap:3px;padding:5px 14px;font-size:10.5px;font-weight:600;color:var(--muted);text-decoration:none;transition:color .15s}
.mbn-item.active,.mbn-item:hover{color:var(--g)}
.mbn-item svg{width:22px;height:22px;stroke:currentColor;stroke-width:1.8;fill:none}

/* ── TOAST ── */
.toast-wrap{position:fixed;bottom:24px;left:50%;transform:translateX(-50%);z-index:9999;display:flex;flex-direction:column;align-items:center;gap:7px;pointer-events:none}
.toast{background:var(--g);color:#fff;padding:11px 22px;border-radius:50px;font-size:13.5px;font-weight:600;box-shadow:0 6px 24px rgba(0,0,0,.18);animation:tIn .3s ease;white-space:nowrap}
@keyframes tIn{from{opacity:0;transform:translateY(12px)}to{opacity:1;transform:translateY(0)}}

/* ── RESPONSIVE ── */
@media(max-width:1200px){.cat-grid{grid-template-columns:repeat(7,1fr)}.popular-row{grid-template-columns:repeat(6,1fr)}}
@media(max-width:992px){.cat-grid{grid-template-columns:repeat(4,1fr)}.popular-row{grid-template-columns:repeat(5,1fr)}.offers-strip{grid-template-columns:1fr 1fr}.offers-strip .offer-strip-card:last-child{display:none}}
@media(max-width:768px){
  .topbar{display:none}
  .nav-inner{height:58px;padding:0 14px;gap:10px}
  .nav-search{max-width:100%;flex:1}
  .nav-btn:not(.btn-cart-nav){display:none}
  .cats-hero{padding:24px 0}
  .cats-hero-title{font-size:24px}
  .cats-hero-emoji{display:none}
  .cats-hero-stats{gap:16px}
  .filter-bar{top:58px}
  .filter-bar-inner{gap:8px;padding:0 14px}
  .cat-search-box{max-width:100%;flex:1}
  .page-content{padding:16px 14px 80px}
  .cat-grid{grid-template-columns:repeat(3,1fr);gap:10px}
  .popular-row{grid-template-columns:repeat(4,1fr);gap:8px}
  .offers-strip{grid-template-columns:1fr;gap:10px}
  .offers-strip .offer-strip-card:last-child{display:flex}
  .mob-bottom-nav{display:block}
}
@media(max-width:480px){
  .cat-grid{grid-template-columns:repeat(3,1fr);gap:8px}
  .popular-row{grid-template-columns:repeat(3,1fr);gap:7px}
  .cats-hero-title{font-size:20px}
  .filter-bar-inner{flex-wrap:wrap}
  .sort-pills{display:flex;overflow-x:auto;scrollbar-width:none;flex-wrap:nowrap;padding-bottom:2px}
  .sort-pills::-webkit-scrollbar{display:none}
}
</style>
</head>
<body>


<div class="topbar">
  <div class="topbar-inner">
    <div class="topbar-left">
      <span>🚚 Free delivery above ₹499</span>
      <span class="tb-sep">|</span>
      <span>⚡ 60-min express delivery</span>
    </div>
    <div class="topbar-right">
      <a href="tel:9911011411">📞 9911011411</a>
      <span class="tb-sep">|</span>
      <?php if(auth()->guard()->check()): ?>
        <a href="<?php echo e(route('account.index')); ?>">My Account</a>
        <span class="tb-sep">|</span>
        <form action="<?php echo e(route('logout')); ?>" method="POST" style="display:inline"><?php echo csrf_field(); ?><button style="background:none;border:none;color:rgba(255,255,255,.85);cursor:pointer;font-size:12px;font-family:inherit">Logout</button></form>
      <?php else: ?>
        <a href="<?php echo e(route('login')); ?>">Login</a>
        <span class="tb-sep">|</span>
        <a href="<?php echo e(route('register')); ?>">Register</a>
      <?php endif; ?>
    </div>
  </div>
</div>


<nav class="navbar-wrap">
  <div class="nav-inner">
    <a href="<?php echo e(route('home')); ?>" class="logo">
      <div class="logo-icon">🛒</div>
      <div>
        <div class="logo-name">All You <span>Want</span></div>
        <span class="logo-sub">Fresh • Fast • Reliable</span>
      </div>
    </a>
    <form action="<?php echo e(route('shop.search')); ?>" method="GET" class="nav-search">
      <input type="text" name="q" placeholder="Search products, categories..." value="<?php echo e(request('q')); ?>">
      <button type="submit">🔍 Search</button>
    </form>
    <div class="nav-right">
      <?php if(auth()->guard()->check()): ?>
        <a href="<?php echo e(route('account.index')); ?>" class="nav-btn">👤 Account</a>
      <?php else: ?>
        <a href="<?php echo e(route('login')); ?>" class="nav-btn">Login</a>
      <?php endif; ?>
      
      <a href="<?php echo e(route('cart.index')); ?>" class="nav-btn btn-cart-nav">
        🛒 Cart
        <?php $cc = count(session('cart',[])); ?>
        <?php if($cc > 0): ?><span class="cart-badge"><?php echo e($cc); ?></span><?php endif; ?>
      </a>
    </div>
  </div>
</nav>


<div class="breadcrumb-bar">
  <div class="bc-inner">
    <a href="<?php echo e(route('home')); ?>">🏠 Home</a>
    <span class="bc-sep">›</span>
    <span style="color:var(--text2);font-weight:600">All Categories</span>
  </div>
</div>


<div class="cats-hero">
  <div class="cats-hero-inner">
    <div class="cats-hero-text">
      <div class="cats-hero-eyebrow">🛒 Browse Everything</div>
      <div class="cats-hero-title">Shop by <em>Category</em></div>
      <div class="cats-hero-sub">
        Explore <?php echo e($categories->count()); ?>+ categories — from fresh vegetables to<br>
        dairy, bakery, beverages & more. Delivered in 60 min!
      </div>
      <div class="cats-hero-stats">
        <div><div class="hs-num"><?php echo e($categories->count()); ?>+</div><div class="hs-lbl">Categories</div></div>
        <div><div class="hs-num"><?php echo e($categories->sum('active_products_count')); ?>+</div><div class="hs-lbl">Products</div></div>
        <div><div class="hs-num">60 Min</div><div class="hs-lbl">Delivery</div></div>
        <div><div class="hs-num">Free</div><div class="hs-lbl">Above ₹499</div></div>
      </div>
    </div>
    <div class="cats-hero-emoji">🛍️</div>
  </div>
</div>


<div class="filter-bar">
  <div class="filter-bar-inner">
    
    <div class="cat-search-box">
      <input type="text" id="catSearchInput" placeholder="Search categories..." oninput="searchCats(this.value)">
      <button type="button">🔍</button>
    </div>
    
    <div class="sort-pills">
      <button class="sort-pill active" onclick="sortCats('default',this)">All</button>
      <button class="sort-pill" onclick="sortCats('az',this)">A–Z</button>
      <button class="sort-pill" onclick="sortCats('popular',this)">Popular</button>
      <button class="sort-pill" onclick="sortCats('most-products',this)">Most Items</button>
    </div>
    
    <div class="view-toggle ms-auto">
      <button class="vt-btn active" id="gridViewBtn" onclick="setView('grid')" title="Grid View">⊞</button>
      <button class="vt-btn" id="listViewBtn" onclick="setView('list')" title="List View">☰</button>
    </div>
  </div>
</div>


<div class="page-content">



  
  <?php
    $icons=['Vegetables'=>'🥬','Fruits'=>'🍎','Dairy & Eggs'=>'🥛','Meat & Fish'=>'🍗','Bakery'=>'🧁','Beverages'=>'🧃','Instant Food'=>'🍜','Personal Care'=>'🧴','Household'=>'🏠','Pet Care'=>'🐾'];
    $popular = $categories->sortByDesc('active_products_count')->take(8);
  ?>
  <div style="margin-bottom:6px">
    <div style="font-size:16px;font-weight:800;color:var(--text);margin-bottom:14px;display:flex;align-items:center;gap:8px">
      🔥 Popular Categories
      <span style="font-size:12px;font-weight:500;color:var(--muted)">Most shopped by customers</span>
    </div>
    <div class="popular-row" id="popularRow">
      <?php $__currentLoopData = $popular; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php $icon = $icons[$cat->name] ?? '🛒'; ?>
      <a href="<?php echo e(route('category.show', $cat->slug)); ?>" class="pop-item">
        <div class="pop-img">
          <?php if($cat->image): ?><img src="<?php echo e(asset('storage/'.$cat->image)); ?>" alt="<?php echo e($cat->name); ?>">
          <?php else: ?><span><?php echo e($icon); ?></span><?php endif; ?>
        </div>
        <div class="pop-name"><?php echo e($cat->name); ?></div>
        <div class="pop-cnt"><?php echo e($cat->active_products_count); ?> items</div>
      </a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>

  
  <div class="group-head">
    <div class="group-head-line"></div>
    <div class="group-head-label">All Categories</div>
    <div class="group-head-line"></div>
  </div>

  
  <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;flex-wrap:wrap;gap:10px">
    <div style="font-size:13.5px;color:var(--muted)">
      Showing <strong id="catCount" style="color:var(--text)"><?php echo e($categories->count()); ?></strong> categories
    </div>
    <div id="noResultMsg" style="display:none;font-size:13.5px;color:var(--muted)"></div>
  </div>

  
  <div class="cat-grid" id="catGrid">

    <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <?php
      $icon = $icons[$cat->name] ?? '🛒';
      $colors = ['#f0faf4','#fff8f0','#f0f8ff','#fff0f0','#fffbf0','#f0f0ff','#fff0fa','#f5f0ff','#f0fff8','#fff8f0'];
      $bg = $colors[$i % count($colors)];
      $accentColors = ['#0d6e39','#f97316','#3b82f6','#ef4444','#f59e0b','#8b5cf6','#ec4899','#6366f1','#14b8a6','#f97316'];
      $accent = $accentColors[$i % count($accentColors)];
      $isPopular = $cat->active_products_count >= 3;
      $isNew     = $cat->created_at && $cat->created_at->diffInDays() < 30;
    ?>

    <a href="<?php echo e(route('category.show', $cat->slug)); ?>"
       class="cat-card cat-item"
       data-name="<?php echo e(strtolower($cat->name)); ?>"
       data-count="<?php echo e($cat->active_products_count); ?>">

      
      <?php if($isPopular): ?>
        <span class="popular-chip" style="z-index: 999">POPULAR</span>
      <?php elseif($isNew): ?>
        <span class="new-chip" style="z-index: 999">NEW</span>
      <?php endif; ?>

      
      <div class="cat-card-img">
        <?php if($cat->image): ?>
          <img src="<?php echo e(asset('storage/'.$cat->image)); ?>" alt="<?php echo e($cat->name); ?>">
        <?php else: ?>
          <span class="cat-card-emoji"><?php echo e($icon); ?></span>
        <?php endif; ?>
      </div>

      
      <div class="cat-card-body">
        <div class="cat-card-name"><?php echo e($cat->name); ?></div>
        <div class="cat-card-count">
          <?php echo e($cat->active_products_count > 0 ? $cat->active_products_count.' products' : 'Coming soon'); ?>

        </div>
      </div>

      
      <div class="cat-card-arrow">›</div>

      
      <div class="cat-card-accent" style="background:<?php echo e($accent); ?>"></div>

    </a>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="empty-cats">
      <div class="empty-icon">🛒</div>
      <div style="font-size:20px;font-weight:700;margin-bottom:8px;color:var(--text2)">No Categories Yet</div>
      <div style="font-size:14px;color:var(--muted);margin-bottom:20px">Add categories from the admin panel to show them here.</div>
      <a href="/admin/categories/create" style="background:var(--g);color:#fff;padding:12px 28px;border-radius:50px;font-size:14px;font-weight:700;display:inline-block">Add Categories →</a>
    </div>
    <?php endif; ?>

  </div>

  
  <div id="noResultsBox" style="display:none">
    <div class="no-results">
      <div style="font-size:52px;margin-bottom:16px">🔍</div>
      <div style="font-size:18px;font-weight:700;color:var(--text);margin-bottom:8px">No categories found</div>
      <div style="font-size:14px;color:var(--muted);margin-bottom:18px">Try a different search term</div>
      <button onclick="clearCatSearch()" style="background:var(--g);color:#fff;padding:10px 24px;border-radius:50px;border:none;font-size:14px;font-weight:700;cursor:pointer;font-family:inherit">Clear Search</button>
    </div>
  </div>


    
  <div class="offers-strip">
    <a href="<?php echo e(route('offers')); ?>" class="offer-strip-card osc1">
      <div class="osc-glow"></div>
      <div class="osc-emoji">🥗</div>
      <div class="osc-text">
        <div class="osc-eyebrow">Weekend Deal</div>
        <div class="osc-title">30% OFF<br>Fresh Veggies</div>
        <div class="osc-sub">Code: VEGGIE30</div>
      </div>
    </a>
    <a href="<?php echo e(route('register')); ?>" class="offer-strip-card osc2">
      <div class="osc-glow"></div>
      <div class="osc-emoji">🎁</div>
      <div class="osc-text">
        <div class="osc-eyebrow">New User</div>
        <div class="osc-title">₹100 OFF<br>First Order</div>
        <div class="osc-sub">Code: WELCOME100</div>
      </div>
    </a>
    <a href="<?php echo e(route('shop')); ?>" class="offer-strip-card osc3">
      <div class="osc-glow"></div>
      <div class="osc-emoji">⚡</div>
      <div class="osc-text">
        <div class="osc-eyebrow">Express</div>
        <div class="osc-title">60-Min<br>Delivery</div>
        <div class="osc-sub">Mayur Vihar Phase-1</div>
      </div>
    </a>
  </div>

  
  <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-top:40px" class="feat-bottom-grid">
    <?php $__currentLoopData = [['🚚','Free Delivery','On orders above ₹499'],['⚡','60-Min Express','Order & get in 60 min'],['🌿','100% Fresh','Farm to doorstep daily'],['🔒','Secure Pay','UPI, Cards, COD']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div style="background:var(--white);border:1.5px solid var(--border);border-radius:12px;padding:18px 16px;display:flex;align-items:center;gap:13px;transition:all .2s" class="feat-bottom-item">
      <div style="width:42px;height:42px;border-radius:10px;background:var(--gl);display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0"><?php echo e($feat[0]); ?></div>
      <div>
        <div style="font-size:13.5px;font-weight:700;color:var(--text)"><?php echo e($feat[1]); ?></div>
        <div style="font-size:12px;color:var(--muted);margin-top:1px"><?php echo e($feat[2]); ?></div>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>

</div>


<div style="background:#0f1c14;color:rgba(255,255,255,.5);text-align:center;padding:22px;font-size:13px">
  © <?php echo e(date('Y')); ?> All You Want Grocery ·
  <a href="<?php echo e(route('home')); ?>" style="color:#4ade80">Home</a> ·
  <a href="<?php echo e(route('shop')); ?>" style="color:#4ade80">Shop</a> ·
  <a href="<?php echo e(route('offers')); ?>" style="color:#4ade80">Offers</a>
</div>


<div class="mob-bottom-nav">
  <div class="mbn-inner">
    <a href="<?php echo e(route('home')); ?>" class="mbn-item">
      <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>Home
    </a>
    <a href="<?php echo e(route('shop')); ?>" class="mbn-item">
      <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>Shop
    </a>
    <a href="<?php echo e(route('categories.all')); ?>" class="mbn-item active">
      <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>Categories
    </a>
    <a href="<?php echo e(route('cart.index')); ?>" class="mbn-item" style="position:relative">
      <svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
      Cart
      <?php if($cc > 0): ?><span class="mob-bottom-badge" style="position:absolute;top:4px;right:8px;background:#e53935;color:#fff;font-size:9px;font-weight:700;min-width:15px;height:15px;border-radius:50%;display:flex;align-items:center;justify-content:center;border:2px solid #fff"><?php echo e($cc); ?></span><?php endif; ?>
    </a>
    <a href="<?php echo e(auth()->check() ? route('account.index') : route('login')); ?>" class="mbn-item">
      <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>Account
    </a>
  </div>
</div>


<div class="toast-wrap" id="toastWrap"></div>

<script>
// ─── SEARCH CATEGORIES ────────────────────────────
function searchCats(val) {
  const q   = val.trim().toLowerCase();
  const grid = document.getElementById('catGrid');
  const noBox= document.getElementById('noResultsBox');
  const cntEl= document.getElementById('catCount');
  const items= document.querySelectorAll('.cat-item');
  let visible = 0;

  items.forEach(item => {
    const name = (item.dataset.name || '').toLowerCase();
    const show = !q || name.includes(q);
    item.style.display = show ? '' : 'none';
    if (show) visible++;
  });

  cntEl.textContent = visible;
  grid.style.display = visible === 0 ? 'none' : 'grid';
  noBox.style.display = visible === 0 ? 'block' : 'none';
}

function clearCatSearch() {
  document.getElementById('catSearchInput').value = '';
  searchCats('');
}

// ─── SORT ────────────────────────────────────────
function sortCats(type, btn) {
  document.querySelectorAll('.sort-pill').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');

  const grid  = document.getElementById('catGrid');
  const items = Array.from(document.querySelectorAll('.cat-item'));

  items.sort((a, b) => {
    if (type === 'az')           return a.dataset.name.localeCompare(b.dataset.name);
    if (type === 'most-products')return parseInt(b.dataset.count) - parseInt(a.dataset.count);
    if (type === 'popular')      return parseInt(b.dataset.count) - parseInt(a.dataset.count);
    return 0; // default — original order
  });

  // Re-append sorted
  items.forEach(item => grid.appendChild(item));
}

// ─── VIEW TOGGLE ─────────────────────────────────
function setView(v) {
  const grid   = document.getElementById('catGrid');
  const gridBtn= document.getElementById('gridViewBtn');
  const listBtn= document.getElementById('listViewBtn');

  grid.classList.toggle('list-view', v === 'list');
  gridBtn.classList.toggle('active', v === 'grid');
  listBtn.classList.toggle('active', v === 'list');
  localStorage.setItem('catView', v);
}
// Restore saved view
const savedView = localStorage.getItem('catView');
if (savedView === 'list') setView('list');

// ─── SCROLL REVEAL ───────────────────────────────
const io = new IntersectionObserver(entries => {
  entries.forEach((e, i) => {
    if (e.isIntersecting) {
      setTimeout(() => {
        e.target.style.opacity = '1';
        e.target.style.transform = 'translateY(0)';
      }, i * 50);
      io.unobserve(e.target);
    }
  });
}, { threshold: 0.05 });

document.querySelectorAll('.cat-item, .pop-item, .offer-strip-card, .feat-bottom-item').forEach((el, i) => {
  el.style.opacity = '0';
  el.style.transform = 'translateY(18px)';
  el.style.transition = `opacity .4s ${i * .04}s ease, transform .4s ${i * .04}s ease`;
  io.observe(el);
});

// ─── TOAST ───────────────────────────────────────
function showToast(msg) {
  const w = document.getElementById('toastWrap');
  const t = document.createElement('div');
  t.className = 'toast'; t.textContent = msg;
  w.appendChild(t);
  setTimeout(() => { t.style.opacity='0'; t.style.transition='opacity .25s'; setTimeout(()=>t.remove(),250); }, 2500);
}

// ─── RESPONSIVE FEAT GRID ────────────────────────
window.addEventListener('resize', () => {
  const fg = document.querySelector('.feat-bottom-grid');
  if (!fg) return;
  fg.style.gridTemplateColumns = window.innerWidth < 576 ? '1fr 1fr' : window.innerWidth < 768 ? '1fr 1fr' : 'repeat(4,1fr)';
});
window.dispatchEvent(new Event('resize'));
</script>
</body>
</html><?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views/frontend/all-categories.blade.php ENDPATH**/ ?>