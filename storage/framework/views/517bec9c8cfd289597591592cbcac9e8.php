<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<title><?php echo e($category->name); ?> — All You Want</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{font-family:'Inter',sans-serif;background:#f8f9fa;color:#1a1a2e;-webkit-font-smoothing:antialiased}
a{text-decoration:none;color:inherit}
:root{--green:#0d6e39;--green-dark:#0a5a2e;--green-light:#f0faf4;--orange:#f97316;--border:#e8edf0;--shadow:0 2px 12px rgba(0,0,0,.08);--r:12px}

/* NAVBAR */
.navbar{background:#fff;border-bottom:1px solid var(--border);position:sticky;top:0;z-index:300;box-shadow:0 1px 8px rgba(0,0,0,.06)}
.nav-inner{max-width:1320px;margin:0 auto;padding:0 20px;height:64px;display:flex;align-items:center;gap:16px}
.logo{font-size:20px;font-weight:800;color:#1a1a2e;flex-shrink:0;display:flex;align-items:center;gap:8px}
.logo-mark{width:32px;height:32px;background:var(--green);border-radius:8px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:15px;font-weight:800}
.logo span{color:var(--green)}
.search-form{flex:1;max-width:520px;display:flex;border:1.5px solid var(--border);border-radius:50px;overflow:hidden;transition:all .2s}
.search-form:focus-within{border-color:var(--green);box-shadow:0 0 0 3px rgba(13,110,57,.1)}
.search-form input{flex:1;border:none;padding:10px 18px;font-size:13.5px;outline:none;font-family:inherit}
.search-form button{background:var(--green);border:none;color:#fff;padding:0 20px;font-size:13px;font-weight:500;cursor:pointer;transition:background .2s}
.search-form button:hover{background:var(--green-dark)}
.nav-right{display:flex;align-items:center;gap:8px;margin-left:auto}
.nav-link{font-size:13px;font-weight:500;color:#374151;padding:7px 12px;border-radius:8px;transition:all .15s;display:flex;align-items:center;gap:5px}
.nav-link:hover{background:var(--green-light);color:var(--green)}
.btn-cart{background:var(--green);color:#fff;padding:8px 18px;border-radius:50px;font-size:13px;font-weight:600;display:flex;align-items:center;gap:7px;transition:all .2s}
.btn-cart:hover{background:var(--green-dark);transform:translateY(-1px)}
.cart-badge{background:rgba(255,255,255,.3);border-radius:20px;padding:1px 7px;font-size:11px;font-weight:700}

/* BREADCRUMB */
.breadcrumb{background:#fff;border-bottom:1px solid var(--border);padding:10px 0}
.bc-inner{max-width:1320px;margin:0 auto;padding:0 20px;display:flex;align-items:center;gap:6px;font-size:13px;color:#9ca3af;flex-wrap:wrap}
.bc-inner a{color:var(--green);font-weight:500;transition:opacity .15s}
.bc-inner a:hover{opacity:.75}
.bc-sep{color:#d1d5db}

/* CATEGORY HERO */
.cat-hero{position:relative;overflow:hidden;padding:40px 0}
.cat-hero-bg{position:absolute;inset:0;z-index:0}
.cat-hero-overlay{position:absolute;inset:0;backdrop-filter:blur(1px)}
.cat-hero-inner{max-width:1320px;margin:0 auto;padding:0 20px;position:relative;z-index:1;display:flex;align-items:center;gap:28px}
.cat-hero-icon{width:80px;height:80px;border-radius:20px;background:rgba(255,255,255,.2);backdrop-filter:blur(8px);display:flex;align-items:center;justify-content:center;font-size:44px;flex-shrink:0;box-shadow:0 8px 32px rgba(0,0,0,.15);border:2px solid rgba(255,255,255,.3)}
.cat-hero-info{}
.cat-hero-name{font-size:32px;font-weight:800;color:#fff;letter-spacing:-.5px;margin-bottom:6px}
.cat-hero-meta{font-size:14px;color:rgba(255,255,255,.8);display:flex;align-items:center;gap:14px;flex-wrap:wrap}
.cat-hero-meta span{display:flex;align-items:center;gap:5px}
.cat-hero-meta strong{color:#fff;font-weight:700}

/* SUB-CATEGORIES PILLS */
.sub-cats{background:#fff;border-bottom:1px solid var(--border);padding:12px 0;overflow-x:auto;scrollbar-width:none}
.sub-cats::-webkit-scrollbar{display:none}
.sub-cats-inner{max-width:1320px;margin:0 auto;padding:0 20px;display:flex;gap:8px;align-items:center;white-space:nowrap}
.sub-pill{display:inline-flex;align-items:center;gap:6px;padding:7px 16px;border-radius:50px;border:1.5px solid var(--border);font-size:13px;font-weight:500;color:#374151;cursor:pointer;transition:all .2s;background:#fff}
.sub-pill:hover,.sub-pill.active{background:var(--green);border-color:var(--green);color:#fff;box-shadow:0 4px 12px rgba(13,110,57,.25)}

/* LAYOUT */
.page-wrap{max-width:1320px;margin:0 auto;padding:24px 20px}
.main-layout{display:grid;grid-template-columns:260px 1fr;gap:22px;align-items:start}

/* FILTER SIDEBAR */
.filter-card{background:#fff;border-radius:var(--r);border:1px solid var(--border);position:sticky;top:82px;overflow:hidden}
.filter-head{padding:16px 20px;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between}
.filter-title{font-size:14px;font-weight:700;color:#1a1a2e}
.filter-clear{font-size:12px;font-weight:600;color:var(--green);cursor:pointer}
.filter-clear:hover{text-decoration:underline}
.filter-section{padding:16px 20px;border-bottom:1px solid #f9fafb}
.filter-section:last-child{border-bottom:none}
.filter-sec-title{font-size:12px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:.5px;margin-bottom:12px;display:flex;align-items:center;justify-content:space-between;cursor:pointer}
.filter-sec-title svg{width:14px;height:14px;stroke:#9ca3af;fill:none;transition:transform .2s}
.filter-sec-title.collapsed svg{transform:rotate(-90deg)}
.filter-opts{display:flex;flex-direction:column;gap:8px}
.filter-opt{display:flex;align-items:center;gap:9px;font-size:13px;color:#374151;cursor:pointer;padding:4px 0;border-radius:6px;transition:color .15s}
.filter-opt:hover{color:var(--green)}
.filter-opt input[type=checkbox]{accent-color:var(--green);width:15px;height:15px;flex-shrink:0;cursor:pointer}
.price-inputs{display:flex;align-items:center;gap:8px}
.price-inp{width:90px;padding:7px 10px;border:1.5px solid var(--border);border-radius:8px;font-size:12.5px;outline:none;font-family:inherit;transition:border-color .2s}
.price-inp:focus{border-color:var(--green)}
.apply-btn{width:100%;background:var(--green);color:#fff;border:none;padding:10px;border-radius:9px;font-size:13px;font-weight:600;cursor:pointer;margin-top:12px;font-family:inherit;transition:background .2s}
.apply-btn:hover{background:var(--green-dark)}
.active-filters{padding:12px 20px;border-bottom:1px solid #f1f5f9;display:flex;flex-wrap:wrap;gap:6px}
.filter-tag{display:inline-flex;align-items:center;gap:5px;background:var(--green-light);color:var(--green);font-size:11.5px;font-weight:600;padding:4px 10px;border-radius:20px}
.filter-tag button{background:none;border:none;color:var(--green);cursor:pointer;font-size:13px;line-height:1;padding:0;margin-left:2px}

/* PRODUCT SECTION */
.prod-section{}
.prod-topbar{display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;flex-wrap:wrap;gap:12px;background:#fff;padding:12px 16px;border-radius:var(--r);border:1px solid var(--border)}
.results-text{font-size:13.5px;color:#64748b}
.results-text strong{color:#1a1a2e}
.sort-wrap{display:flex;align-items:center;gap:8px}
.sort-label{font-size:13px;color:#64748b;font-weight:500}
.sort-select{padding:7px 12px;border:1.5px solid var(--border);border-radius:8px;font-size:13px;outline:none;font-family:inherit;background:#fff;cursor:pointer;color:#374151;transition:border-color .2s}
.sort-select:focus{border-color:var(--green)}
.view-toggle{display:flex;border:1.5px solid var(--border);border-radius:8px;overflow:hidden}
.view-btn{width:34px;height:34px;background:#fff;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:14px;color:#9ca3af;transition:all .15s}
.view-btn.active,.view-btn:hover{background:var(--green-light);color:var(--green)}

/* PRODUCT GRID */
.products-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:16px}
.products-grid.list-view{grid-template-columns:1fr}

/* PRODUCT CARD */
.prod-card{background:#fff;border:1.5px solid var(--border);border-radius:var(--r);overflow:hidden;position:relative;transition:all .25s cubic-bezier(.4,0,.2,1);cursor:pointer}
.prod-card:hover{transform:translateY(-6px);box-shadow:0 20px 40px rgba(0,0,0,.12);border-color:#c8e6c9}
.prod-card-inner{position:relative}
.prod-badges{position:absolute;top:10px;left:10px;display:flex;flex-direction:column;gap:4px;z-index:3}
.prod-badge{font-size:10.5px;font-weight:700;padding:3px 9px;border-radius:5px;display:inline-block;line-height:1.4}
.badge-sale{background:#ff3b30;color:#fff}
.badge-new{background:var(--green);color:#fff}
.badge-hot{background:#f97316;color:#fff}
.badge-out{background:#94a3b8;color:#fff}
.prod-wish{position:absolute;top:10px;right:10px;width:32px;height:32px;background:rgba(255,255,255,.92);border:1.5px solid var(--border);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:14px;z-index:3;cursor:pointer;transition:all .2s;box-shadow:0 2px 8px rgba(0,0,0,.1)}
.prod-wish:hover{background:#fff;border-color:#f43f5e;transform:scale(1.15)}
.prod-wish.wishlisted{background:#fff0f3;border-color:#f43f5e}
.prod-img{height:170px;background:linear-gradient(135deg,#fff,#fff);display:flex;align-items:center;justify-content:center;overflow:hidden;transition:transform .4s ease;position:relative}
.prod-img img{width:100%;height:100%;object-fit:contain;transition:transform .4s ease}
.prod-card:hover .prod-img img,.prod-card:hover .prod-img{transform:scale(1.08)}
.prod-emoji-icon{font-size:72px;line-height:1;transition:transform .4s ease}
.prod-card:hover .prod-emoji-icon{transform:scale(1.12)}
.prod-body{padding:14px}
.prod-cat{font-size:10.5px;font-weight:700;color:var(--green);text-transform:uppercase;letter-spacing:.5px;margin-bottom:5px}
.prod-name{font-size:14px;font-weight:600;color:#1a1a2e;line-height:1.35;margin-bottom:4px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
.prod-weight{font-size:12px;color:#9ca3af;margin-bottom:8px}
.prod-rating{display:flex;align-items:center;gap:5px;margin-bottom:10px}
.stars{color:#f59e0b;font-size:12px;letter-spacing:-1px}
.stars-empty{color:#e5e7eb}
.rating-val{font-size:12px;font-weight:600;color:#374151}
.rating-cnt{font-size:11.5px;color:#9ca3af}
.prod-foot{display:flex;align-items:center;justify-content:space-between;gap:8px}
.prod-prices{}
.prod-price{font-size:18px;font-weight:800;color:var(--green);line-height:1}
.prod-price-old{font-size:12px;color:#9ca3af;text-decoration:line-through;margin-top:2px}
.prod-disc{font-size:11px;font-weight:700;color:#ff3b30;margin-top:1px}
.btn-add{width:36px;height:36px;background:var(--green);border:none;border-radius:10px;color:#fff;font-size:22px;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .2s;flex-shrink:0;position:relative;overflow:hidden}
.btn-add:hover{background:var(--green-dark);transform:scale(1.1);box-shadow:0 4px 12px rgba(13,110,57,.35)}
.btn-add:active{transform:scale(.95)}
.btn-add.adding{background:var(--green-dark)}
.btn-add.added{background:#dcfce7;color:var(--green)}
.btn-add-ripple{position:absolute;inset:0;border-radius:10px;background:rgba(255,255,255,.3);transform:scale(0);animation:ripple .4s ease-out}
@keyframes ripple{to{transform:scale(2);opacity:0}}

/* LIST VIEW CARD */
.products-grid.list-view .prod-card{display:flex;align-items:center}
.products-grid.list-view .prod-card-inner{display:flex;width:100%}
.products-grid.list-view .prod-img{width:140px;height:120px;flex-shrink:0;border-radius:0}
.products-grid.list-view .prod-body{flex:1;display:flex;align-items:center;gap:20px;flex-wrap:wrap}
.products-grid.list-view .prod-prices{margin-left:auto}

/* QUICK VIEW MODAL */
.modal-overlay{position:fixed;inset:0;background:rgba(0,0,0,.6);backdrop-filter:blur(4px);z-index:1000;display:flex;align-items:center;justify-content:center;padding:20px;opacity:0;pointer-events:none;transition:opacity .3s}
.modal-overlay.open{opacity:1;pointer-events:all}
.modal-box{background:#fff;border-radius:20px;overflow:hidden;max-width:860px;width:100%;max-height:90vh;overflow-y:auto;transform:scale(.92) translateY(20px);transition:transform .3s;box-shadow:0 32px 80px rgba(0,0,0,.2)}
.modal-overlay.open .modal-box{transform:scale(1) translateY(0)}
.modal-inner{display:grid;grid-template-columns:1fr 1fr;min-height:400px}
.modal-img{background:linear-gradient(135deg,#f8fafc,#f1f5f9);display:flex;align-items:center;justify-content:center;font-size:140px;min-height:360px;position:relative;overflow:hidden}
.modal-img img{width:100%;height:100%;object-fit:cover}
.modal-info{padding:32px;display:flex;flex-direction:column;justify-content:space-between}
.modal-cat{font-size:12px;font-weight:700;color:var(--green);text-transform:uppercase;letter-spacing:.5px;margin-bottom:8px}
.modal-name{font-size:22px;font-weight:800;color:#1a1a2e;line-height:1.25;margin-bottom:8px}
.modal-price{font-size:28px;font-weight:800;color:var(--green);margin-bottom:4px}
.modal-price-old{font-size:15px;color:#9ca3af;text-decoration:line-through;margin-left:8px;font-weight:400}
.modal-desc{font-size:13.5px;color:#4b5563;line-height:1.7;margin:14px 0}
.modal-qty{display:flex;align-items:center;gap:10px;margin-bottom:14px}
.qty-ctrl{display:flex;align-items:center;border:1.5px solid var(--border);border-radius:10px;overflow:hidden}
.qty-btn{width:38px;height:38px;background:#f8fafc;border:none;font-size:18px;cursor:pointer;font-family:inherit;transition:background .15s;display:flex;align-items:center;justify-content:center}
.qty-btn:hover{background:var(--green-light)}
.qty-val{width:44px;height:38px;border:none;border-left:1px solid var(--border);border-right:1px solid var(--border);text-align:center;font-size:15px;font-weight:700;outline:none;font-family:inherit}
.btn-modal-cart{flex:1;background:var(--green);color:#fff;border:none;padding:13px;border-radius:10px;font-size:14px;font-weight:700;cursor:pointer;font-family:inherit;transition:all .2s;display:flex;align-items:center;justify-content:center;gap:8px}
.btn-modal-cart:hover{background:var(--green-dark);transform:translateY(-1px)}
.modal-close{position:absolute;top:16px;right:16px;width:36px;height:36px;background:rgba(0,0,0,.15);border:none;border-radius:50%;color:#fff;font-size:18px;cursor:pointer;z-index:10;display:flex;align-items:center;justify-content:center;transition:background .15s}
.modal-close:hover{background:rgba(0,0,0,.3)}

/* EMPTY STATE */
.empty-state{text-align:center;padding:80px 20px;grid-column:1/-1}
.empty-icon{font-size:72px;margin-bottom:20px;animation:bounce 2s ease-in-out infinite}
@keyframes bounce{0%,100%{transform:translateY(0)}50%{transform:translateY(-12px)}}
.empty-title{font-size:22px;font-weight:700;margin-bottom:8px}
.empty-sub{font-size:14px;color:#9ca3af;margin-bottom:24px}
.empty-btn{display:inline-block;background:var(--green);color:#fff;padding:12px 28px;border-radius:50px;font-size:14px;font-weight:600;transition:all .2s}
.empty-btn:hover{background:var(--green-dark);transform:translateY(-2px)}

/* PAGINATION */
.pagination-wrap{margin-top:32px;display:flex;justify-content:center;align-items:center;gap:6px}
.page-btn{width:38px;height:38px;border-radius:9px;border:1.5px solid var(--border);background:#fff;font-size:13px;font-weight:500;color:#374151;cursor:pointer;display:flex;align-items:center;justify-content:center;text-decoration:none;transition:all .15s}
.page-btn:hover{border-color:var(--green);color:var(--green)}
.page-btn.active{background:var(--green);color:#fff;border-color:var(--green);box-shadow:0 4px 12px rgba(13,110,57,.3)}
.page-btn.disabled{opacity:.4;pointer-events:none;cursor:default}

/* TOAST */
.toast-container{position:fixed;bottom:28px;left:50%;transform:translateX(-50%);z-index:9999;display:flex;flex-direction:column;align-items:center;gap:8px;pointer-events:none}
.toast{background:#1a1a2e;color:#fff;padding:12px 22px;border-radius:50px;font-size:13.5px;font-weight:500;display:flex;align-items:center;gap:8px;box-shadow:0 8px 32px rgba(0,0,0,.2);animation:toastIn .35s cubic-bezier(.34,1.56,.64,1);pointer-events:all}
.toast.success{background:#0d6e39}
.toast.error{background:#dc2626}
@keyframes toastIn{from{transform:translateY(20px);opacity:0}to{transform:translateY(0);opacity:1}}

/* MOBILE */
.mob-filter-btn{display:none;position:fixed;bottom:88px;left:20px;background:var(--green);color:#fff;border:none;border-radius:50px;padding:12px 22px;font-size:13.5px;font-weight:700;cursor:pointer;z-index:200;box-shadow:0 8px 24px rgba(13,110,57,.35);font-family:inherit;align-items:center;gap:8px}
.mob-filter-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:400}
.mob-filter-panel{position:fixed;left:0;bottom:0;right:0;background:#fff;border-radius:24px 24px 0 0;padding:24px 20px 40px;max-height:80vh;overflow-y:auto;transform:translateY(100%);transition:transform .3s;z-index:401}
.mob-filter-panel.open{transform:translateY(0)}
.mob-filter-overlay.open,.mob-filter-btn.show{display:flex}
.mob-filter-handle{width:40px;height:4px;background:#e2e8f0;border-radius:2px;margin:0 auto 20px}

@media(max-width:1024px){.main-layout{grid-template-columns:220px 1fr}}
@media(max-width:768px){
  .navbar{position:sticky}
  .main-layout{grid-template-columns:1fr}
  .filter-card{display:none}
  .mob-filter-btn{display:flex}
  .products-grid{grid-template-columns:repeat(2,1fr);gap:12px}
  .cat-hero{padding:24px 0}
  .cat-hero-icon{width:60px;height:60px;font-size:32px}
  .cat-hero-name{font-size:24px}
  .modal-inner{grid-template-columns:1fr}
  .modal-img{min-height:220px;font-size:100px}
}
@media(max-width:400px){.products-grid{grid-template-columns:repeat(2,1fr);gap:8px}}
</style>
</head>
<body>


<nav class="navbar">
  <div class="nav-inner">
    <a href="<?php echo e(route('home')); ?>" class="logo">
      <div class="logo-mark">A</div>
      All You <span>Want</span>
    </a>
    <form action="<?php echo e(route('shop.search')); ?>" method="GET" class="search-form">
      <input type="text" name="q" placeholder="Search in <?php echo e($category->name); ?>..." value="<?php echo e(request('q')); ?>">
      <button type="submit">🔍 Search</button>
    </form>
    <div class="nav-right">
      <?php if(auth()->guard()->check()): ?>
        <a href="<?php echo e(route('account.index')); ?>" class="nav-link">👤 Account</a>
      <?php else: ?>
        <a href="<?php echo e(route('login')); ?>" class="nav-link">Login</a>
      <?php endif; ?>
      <a href="<?php echo e(route('cart.index')); ?>" class="btn-cart">
        🛒 Cart
        <?php $cc = count(session('cart',[])); ?>
        <?php if($cc > 0): ?><span class="cart-badge"><?php echo e($cc); ?></span><?php endif; ?>
      </a>
    </div>
  </div>
</nav>


<div class="breadcrumb">
  <div class="bc-inner">
    <a href="<?php echo e(route('home')); ?>">🏠 Home</a>
    <span class="bc-sep">›</span>
    <a href="<?php echo e(route('shop')); ?>">Shop</a>
    <span class="bc-sep">›</span>
    <span style="color:#1a1a2e;font-weight:600"><?php echo e($category->name); ?></span>
  </div>
</div>


<?php
  $catColors = [
    'Vegetables'   => ['from'=>'#064e29','to'=>'#16a34a'],
    'Fruits'       => ['from'=>'#7c2d12','to'=>'#ea580c'],
    'Dairy & Eggs' => ['from'=>'#1e3a5f','to'=>'#3b82f6'],
    'Meat & Fish'  => ['from'=>'#4a1d1d','to'=>'#dc2626'],
    'Bakery'       => ['from'=>'#451a03','to'=>'#d97706'],
    'Beverages'    => ['from'=>'#312e81','to'=>'#6366f1'],
    'Instant Food' => ['from'=>'#3b0764','to'=>'#a855f7'],
    'Personal Care'=> ['from'=>'#0c4a6e','to'=>'#0ea5e9'],
    'Household'    => ['from'=>'#1c1917','to'=>'#78716c'],
    'Pet Care'     => ['from'=>'#052e16','to'=>'#22c55e'],
  ];
  $clr = $catColors[$category->name] ?? ['from'=>'#064e29','to'=>'#16a34a'];
  $icons = ['Vegetables'=>'🥬','Fruits'=>'🍎','Dairy & Eggs'=>'🥛','Meat & Fish'=>'🍗','Bakery'=>'🧁','Beverages'=>'🧃','Instant Food'=>'🍜','Personal Care'=>'🧴','Household'=>'🏠','Pet Care'=>'🐾'];
  $catIcon = $icons[$category->name] ?? '🛒';
?>
<div class="cat-hero" style="background:linear-gradient(135deg,<?php echo e($clr['from']); ?> 0%,<?php echo e($clr['to']); ?> 100%)">
  <div class="cat-hero-inner">
    <div class="cat-hero-icon"><?php echo e($catIcon); ?></div>
    <div class="cat-hero-info">
      <div class="cat-hero-name"><?php echo e($category->name); ?></div>
      <div class="cat-hero-meta">
        <span>📦 <strong><?php echo e($products->total()); ?></strong> Products</span>
        <span>🚚 Free delivery above ₹499</span>
        <span>⚡ 60-min express delivery</span>
      </div>
      <?php if($category->description): ?>
        <div style="font-size:13px;color:rgba(255,255,255,.75);margin-top:8px"><?php echo e($category->description); ?></div>
      <?php endif; ?>
    </div>
  </div>
</div>


<div class="sub-cats">
  <div class="sub-cats-inner">
    <a href="<?php echo e(route('category.show', $category->slug)); ?>" class="sub-pill <?php echo e(!request('sort') && !request('filter') ? 'active' : ''); ?>">All <?php echo e($category->name); ?></a>
    <a href="<?php echo e(route('category.show', $category->slug)); ?>?filter=sale" class="sub-pill <?php echo e(request('filter')==='sale' ? 'active' : ''); ?>">🏷️ On Sale</a>
    <a href="<?php echo e(route('category.show', $category->slug)); ?>?sort=price_asc" class="sub-pill <?php echo e(request('sort')==='price_asc' ? 'active' : ''); ?>">💰 Low Price</a>
    <a href="<?php echo e(route('category.show', $category->slug)); ?>?filter=instock" class="sub-pill <?php echo e(request('filter')==='instock' ? 'active' : ''); ?>">✅ In Stock</a>
    <a href="<?php echo e(route('category.show', $category->slug)); ?>?filter=new" class="sub-pill <?php echo e(request('filter')==='new' ? 'active' : ''); ?>">✨ New Arrivals</a>
    <a href="<?php echo e(route('category.show', $category->slug)); ?>?filter=bestseller" class="sub-pill <?php echo e(request('filter')==='bestseller' ? 'active' : ''); ?>">🔥 Bestsellers</a>
  </div>
</div>


<div class="page-wrap">
  <div class="main-layout">

    
    <aside class="filter-card" id="filterSidebar">
      <form method="GET" action="<?php echo e(route('category.show', $category->slug)); ?>" id="filterForm">
        <div class="filter-head">
          <div class="filter-title">🔧 Filters</div>
          <a href="<?php echo e(route('category.show', $category->slug)); ?>" class="filter-clear">Clear all</a>
        </div>

        
        <?php if(request()->hasAny(['sort','filter','min_price','max_price'])): ?>
        <div class="active-filters">
          <?php if(request('sort')): ?><span class="filter-tag">Sort: <?php echo e(request('sort')); ?> <button type="button" onclick="removeFilter('sort')">✕</button></span><?php endif; ?>
          <?php if(request('filter')): ?><span class="filter-tag"><?php echo e(ucfirst(request('filter'))); ?> <button type="button" onclick="removeFilter('filter')">✕</button></span><?php endif; ?>
          <?php if(request('min_price')): ?><span class="filter-tag">Min: ₹<?php echo e(request('min_price')); ?> <button type="button" onclick="removeFilter('min_price')">✕</button></span><?php endif; ?>
          <?php if(request('max_price')): ?><span class="filter-tag">Max: ₹<?php echo e(request('max_price')); ?> <button type="button" onclick="removeFilter('max_price')">✕</button></span><?php endif; ?>
        </div>
        <?php endif; ?>

        
        <div class="filter-section">
          <div class="filter-sec-title">↕️ Sort By</div>
          <div class="filter-opts">
            <?php $__currentLoopData = [''=> 'Relevance', 'newest'=>'Newest First', 'price_asc'=>'Price: Low to High', 'price_desc'=>'Price: High to Low', 'bestseller'=>'Bestsellers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <label class="filter-opt">
              <input type="radio" name="sort" value="<?php echo e($val); ?>" <?php echo e(request('sort')===$val ? 'checked' : ''); ?> onchange="this.form.submit()">
              <?php echo e($label); ?>

            </label>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>

        
        <div class="filter-section">
          <div class="filter-sec-title">📦 Availability</div>
          <div class="filter-opts">
            <?php $__currentLoopData = [''=> 'All Products', 'instock'=>'In Stock Only', 'sale'=>'On Sale', 'new'=>'New Arrivals', 'bestseller'=>'Bestsellers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <label class="filter-opt">
              <input type="radio" name="filter" value="<?php echo e($val); ?>" <?php echo e(request('filter')===$val ? 'checked' : ''); ?> onchange="this.form.submit()">
              <?php echo e($label); ?>

            </label>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>

        
        <div class="filter-section">
          <div class="filter-sec-title">💰 Price Range</div>
          <div class="price-inputs">
            <input type="number" name="min_price" class="price-inp" placeholder="Min ₹" value="<?php echo e(request('min_price')); ?>" min="0">
            <span style="color:#9ca3af;font-size:13px">–</span>
            <input type="number" name="max_price" class="price-inp" placeholder="Max ₹" value="<?php echo e(request('max_price')); ?>" min="0">
          </div>
          <button type="submit" class="apply-btn">Apply Price Filter</button>
        </div>
      </form>
    </aside>

    
    <div class="prod-section">

      
      <div class="prod-topbar">
        <div class="results-text">
          Showing <strong><?php echo e($products->count()); ?></strong> of <strong><?php echo e($products->total()); ?></strong> products
          <?php if(request()->hasAny(['sort','filter','min_price','max_price'])): ?>
            <a href="<?php echo e(route('category.show', $category->slug)); ?>" style="color:var(--green);font-weight:600;margin-left:8px">Clear filters</a>
          <?php endif; ?>
        </div>
        <div class="sort-wrap">
          <span class="sort-label">Sort:</span>
          <select class="sort-select" onchange="applySort(this.value)">
            <option value="">Relevance</option>
            <option value="newest" <?php echo e(request('sort')==='newest' ? 'selected':''); ?>>Newest</option>
            <option value="price_asc" <?php echo e(request('sort')==='price_asc' ? 'selected':''); ?>>Price ↑</option>
            <option value="price_desc" <?php echo e(request('sort')==='price_desc' ? 'selected':''); ?>>Price ↓</option>
            <option value="bestseller" <?php echo e(request('sort')==='bestseller' ? 'selected':''); ?>>Best Sellers</option>
          </select>
          <div class="view-toggle">
            <button class="view-btn active" id="gridBtn" onclick="setView('grid')" title="Grid">⊞</button>
            <button class="view-btn" id="listBtn" onclick="setView('list')" title="List">☰</button>
          </div>
        </div>
      </div>

      
      <div class="products-grid" id="productsGrid">
        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php
          $pIcon = ['Vegetables'=>'🥬','Fruits'=>'🍎','Dairy & Eggs'=>'🥛','Meat & Fish'=>'🍗','Bakery'=>'🧁','Beverages'=>'🧃','Instant Food'=>'🍜','Personal Care'=>'🧴','Household'=>'🏠','Pet Care'=>'🐾'][$product->category->name ?? ''] ?? '🛒';
        ?>
        <div class="prod-card" data-id="<?php echo e($product->id); ?>"
             data-name="<?php echo e($product->name); ?>"
             data-price="<?php echo e($product->current_price); ?>"
             data-img="<?php echo e($product->thumbnail ? asset('storage/'.$product->thumbnail) : ''); ?>"
             data-desc="<?php echo e($product->description); ?>"
             data-stock="<?php echo e($product->is_in_stock ? 1 : 0); ?>">
          <div class="prod-card-inner">
            
            <div class="prod-badges">
              <?php if(!$product->is_in_stock): ?>
                <span class="prod-badge badge-out">Out of Stock</span>
              <?php elseif($product->is_on_sale): ?>
                <span class="prod-badge badge-sale"><?php echo e($product->discount_percent); ?>% OFF</span>
              <?php elseif($product->is_new_arrival): ?>
                <span class="prod-badge badge-new">NEW</span>
              <?php elseif($product->is_bestseller): ?>
                <span class="prod-badge badge-hot">🔥 BEST</span>
              <?php endif; ?>
            </div>
            
            <button class="prod-wish" onclick="toggleWish(this, <?php echo e($product->id); ?>)" title="Add to Wishlist">🤍</button>
            
            <a href="<?php echo e(route('product.show', $product->slug)); ?>">
              <div class="prod-img">
                <?php if($product->thumbnail): ?>
                  <img src="<?php echo e(asset('storage/'.$product->thumbnail)); ?>" alt="<?php echo e($product->name); ?>" loading="lazy">
                <?php else: ?>
                  <span class="prod-emoji-icon"><?php echo e($pIcon); ?></span>
                <?php endif; ?>
              </div>
            </a>
          </div>
          
          <div class="prod-body">
            <div class="prod-cat"><?php echo e($product->category->name); ?></div>
            <a href="<?php echo e(route('product.show', $product->slug)); ?>" style="text-decoration:none;color:inherit">
              <div class="prod-name"><?php echo e($product->name); ?></div>
            </a>
            <div class="prod-weight"><?php echo e($product->weight); ?> · <?php echo e($product->unit); ?></div>
            <?php $avgR = $product->approvedReviews->avg('rating') ?: 0; ?>
            <div class="prod-rating">
              <span class="stars">
                <?php for($i=1;$i<=5;$i++): ?><?php echo e($i <= round($avgR) ? '★' : '☆'); ?><?php endfor; ?>
              </span>
              <span class="rating-val"><?php echo e(number_format($avgR,1)); ?></span>
              <span class="rating-cnt">(<?php echo e($product->approvedReviews->count()); ?>)</span>
            </div>
            <div class="prod-foot">
              <div class="prod-prices">
                <div class="prod-price">₹<?php echo e(number_format($product->current_price)); ?></div>
                <?php if($product->is_on_sale): ?>
                  <div class="prod-price-old">₹<?php echo e(number_format($product->price)); ?></div>
                <?php endif; ?>
              </div>
              <?php if($product->is_in_stock): ?>
                <form action="<?php echo e(route('cart.add')); ?>" method="POST" class="cart-form">
                  <?php echo csrf_field(); ?>
                  <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                  <input type="hidden" name="qty" value="1">
                  <button type="submit" class="btn-add" onclick="cartAnim(this)">+</button>
                </form>
              <?php else: ?>
                <button class="btn-add" disabled style="background:#e2e8f0;cursor:not-allowed">✕</button>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="empty-state">
          <div class="empty-icon"><?php echo e($catIcon); ?></div>
          <div class="empty-title">No Products Found</div>
          <div class="empty-sub">
            <?php if(request()->hasAny(['sort','filter','min_price','max_price'])): ?>
              No products match your current filters. Try clearing some filters.
            <?php else: ?>
              No products in this category yet. Check back soon!
            <?php endif; ?>
          </div>
          <?php if(request()->hasAny(['sort','filter','min_price','max_price'])): ?>
            <a href="<?php echo e(route('category.show', $category->slug)); ?>" class="empty-btn">Clear All Filters</a>
          <?php else: ?>
            <a href="<?php echo e(route('shop')); ?>" class="empty-btn">Browse All Products</a>
          <?php endif; ?>
        </div>
        <?php endif; ?>
      </div>

      
      <?php if($products->hasPages()): ?>
      <div class="pagination-wrap">
        <?php if($products->onFirstPage()): ?>
          <span class="page-btn disabled">‹</span>
        <?php else: ?>
          <a href="<?php echo e($products->previousPageUrl()); ?>" class="page-btn">‹</a>
        <?php endif; ?>
        <?php $__currentLoopData = $products->getUrlRange(max(1,$products->currentPage()-2), min($products->lastPage(),$products->currentPage()+2)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <a href="<?php echo e($url); ?>" class="page-btn <?php echo e($products->currentPage()==$page ? 'active':''); ?>"><?php echo e($page); ?></a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if($products->hasMorePages()): ?>
          <a href="<?php echo e($products->nextPageUrl()); ?>" class="page-btn">›</a>
        <?php else: ?>
          <span class="page-btn disabled">›</span>
        <?php endif; ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>


<div class="modal-overlay" id="quickModal" onclick="closeModal(event)">
  <div class="modal-box">
    <div class="modal-inner">
      <div class="modal-img" id="modalImg">
        <button class="modal-close" onclick="document.getElementById('quickModal').classList.remove('open')">✕</button>
        <span id="modalEmoji">🛒</span>
      </div>
      <div class="modal-info">
        <div>
          <div class="modal-cat" id="modalCat"></div>
          <div class="modal-name" id="modalName"></div>
          <div style="display:flex;align-items:baseline;gap:8px;margin:12px 0">
            <div class="modal-price" id="modalPrice"></div>
          </div>
          <div class="modal-desc" id="modalDesc"></div>
        </div>
        <div>
          <div class="modal-qty">
            <span style="font-size:13.5px;font-weight:600;color:#374151">Qty:</span>
            <div class="qty-ctrl">
              <button type="button" class="qty-btn" onclick="changeQty(-1)">−</button>
              <input type="number" class="qty-val" value="1" min="1" id="modalQty">
              <button type="button" class="qty-btn" onclick="changeQty(1)">+</button>
            </div>
          </div>
          <div style="display:flex;gap:10px">
            <form id="modalCartForm" action="<?php echo e(route('cart.add')); ?>" method="POST" style="flex:1">
              <?php echo csrf_field(); ?>
              <input type="hidden" name="product_id" id="modalProductId">
              <input type="hidden" name="qty" id="modalQtyInput" value="1">
              <button type="submit" class="btn-modal-cart">🛒 Add to Cart</button>
            </form>
          </div>
          <a id="modalViewLink" href="#" style="display:block;text-align:center;margin-top:12px;font-size:13px;font-weight:600;color:var(--green)">View Full Details →</a>
        </div>
      </div>
    </div>
  </div>
</div>


<button class="mob-filter-btn show" onclick="openMobFilter()">
  🔧 Filters & Sort
</button>
<div class="mob-filter-overlay" id="mobFilterOverlay" onclick="closeMobFilter()"></div>
<div class="mob-filter-panel" id="mobFilterPanel">
  <div class="mob-filter-handle"></div>
  <div style="font-size:16px;font-weight:700;margin-bottom:18px">Filters & Sort</div>
  <div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:16px">
    <?php $__currentLoopData = ['newest'=>'Newest','price_asc'=>'Price ↑','price_desc'=>'Price ↓','bestseller'=>'Best Sellers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $lbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <a href="<?php echo e(route('category.show', $category->slug)); ?>?sort=<?php echo e($val); ?>" class="sub-pill <?php echo e(request('sort')===$val ? 'active':''); ?>"><?php echo e($lbl); ?></a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
  <div style="display:flex;flex-wrap:wrap;gap:8px">
    <?php $__currentLoopData = ['instock'=>'✅ In Stock','sale'=>'🏷️ On Sale','new'=>'✨ New','bestseller'=>'🔥 Best']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $lbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <a href="<?php echo e(route('category.show', $category->slug)); ?>?filter=<?php echo e($val); ?>" class="sub-pill <?php echo e(request('filter')===$val ? 'active':''); ?>"><?php echo e($lbl); ?></a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
  <a href="<?php echo e(route('category.show', $category->slug)); ?>" style="display:block;text-align:center;margin-top:18px;font-size:13.5px;font-weight:600;color:var(--green)">Clear All Filters</a>
</div>


<div class="toast-container" id="toastContainer"></div>


<div style="background:#0f1c14;color:rgba(255,255,255,.5);text-align:center;padding:20px;font-size:13px;margin-top:40px">
  © <?php echo e(date('Y')); ?> All You Want · <a href="<?php echo e(route('home')); ?>" style="color:#4ade80">Home</a> · <a href="<?php echo e(route('shop')); ?>" style="color:#4ade80">All Products</a>
</div>

<script>
// ── CART ANIMATION ────────────────────────────
function cartAnim(btn) {
  const ripple = document.createElement('div');
  ripple.className = 'btn-add-ripple';
  btn.appendChild(ripple);
  btn.textContent = '✓';
  btn.classList.add('added');
  showToast('Added to cart!', 'success');
  setTimeout(() => { btn.textContent = '+'; btn.classList.remove('added'); ripple.remove(); }, 1800);
}

// ── WISHLIST ──────────────────────────────────
function toggleWish(btn, id) {
  btn.textContent = btn.textContent === '🤍' ? '❤️' : '🤍';
  btn.classList.toggle('wishlisted');
  const msg = btn.classList.contains('wishlisted') ? 'Added to wishlist!' : 'Removed from wishlist';
  showToast(msg, 'success');
}

// ── TOAST ─────────────────────────────────────
function showToast(msg, type='success') {
  const c = document.getElementById('toastContainer');
  const t = document.createElement('div');
  t.className = `toast ${type}`;
  t.innerHTML = (type==='success' ? '✅' : '❌') + ' ' + msg;
  c.appendChild(t);
  setTimeout(() => { t.style.opacity='0'; t.style.transform='translateY(10px)'; t.style.transition='all .3s'; setTimeout(()=>t.remove(),300); }, 2800);
}

// ── VIEW TOGGLE ───────────────────────────────
function setView(view) {
  const grid = document.getElementById('productsGrid');
  document.getElementById('gridBtn').classList.toggle('active', view==='grid');
  document.getElementById('listBtn').classList.toggle('active', view==='list');
  grid.classList.toggle('list-view', view==='list');
  localStorage.setItem('productView', view);
}
// Restore view
const savedView = localStorage.getItem('productView');
if (savedView === 'list') setView('list');

// ── SORT ──────────────────────────────────────
function applySort(val) {
  const url = new URL(window.location.href);
  if (val) url.searchParams.set('sort', val);
  else url.searchParams.delete('sort');
  url.searchParams.delete('page');
  window.location = url.toString();
}

// ── REMOVE FILTER ─────────────────────────────
function removeFilter(key) {
  const url = new URL(window.location.href);
  url.searchParams.delete(key);
  url.searchParams.delete('page');
  window.location = url.toString();
}

// ── MOBILE FILTER ─────────────────────────────
function openMobFilter() {
  document.getElementById('mobFilterPanel').classList.add('open');
  document.getElementById('mobFilterOverlay').classList.add('open');
  document.body.style.overflow = 'hidden';
}
function closeMobFilter() {
  document.getElementById('mobFilterPanel').classList.remove('open');
  document.getElementById('mobFilterOverlay').classList.remove('open');
  document.body.style.overflow = '';
}

// ── SCROLL REVEAL ─────────────────────────────
const io = new IntersectionObserver(entries => {
  entries.forEach((e, i) => {
    if (e.isIntersecting) {
      setTimeout(() => {
        e.target.style.opacity = '1';
        e.target.style.transform = 'translateY(0)';
      }, i * 60);
      io.unobserve(e.target);
    }
  });
}, { threshold: 0.05, rootMargin: '0px 0px -20px 0px' });

document.querySelectorAll('.prod-card').forEach((el, i) => {
  el.style.opacity = '0';
  el.style.transform = 'translateY(24px)';
  el.style.transition = 'opacity .4s ease, transform .4s ease';
  io.observe(el);
});

// ── MODAL ─────────────────────────────────────
function closeModal(e) {
  if (e.target === document.getElementById('quickModal')) {
    document.getElementById('quickModal').classList.remove('open');
  }
}

// ── QTY CONTROL ───────────────────────────────
function changeQty(delta) {
  const input = document.getElementById('modalQty');
  const newVal = Math.max(1, parseInt(input.value || 1) + delta);
  input.value = newVal;
  document.getElementById('modalQtyInput').value = newVal;
}
document.getElementById('modalQty')?.addEventListener('input', function() {
  document.getElementById('modalQtyInput').value = this.value;
});
</script>
</body>
</html><?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views/frontend/category.blade.php ENDPATH**/ ?>