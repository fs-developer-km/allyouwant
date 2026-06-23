<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<title><?php echo $__env->yieldContent('title', 'Dashboard'); ?> — GroceryMart Admin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
/* ── Reset ── */
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{font-size:14px;scroll-behavior:smooth}
body{font-family:'Inter',sans-serif;background:#f0f2f5;color:#1e293b;-webkit-font-smoothing:antialiased;display:flex;min-height:100vh}
a{text-decoration:none;color:inherit}
ul{list-style:none}
button{cursor:pointer;font-family:inherit}
img{max-width:100%;display:block}

/* ── CSS Variables ── */
:root{
  --green:#16a34a;
  --green-dark:#15803d;
  --green-light:#dcfce7;
  --sidebar-w:250px;
  --header-h:60px;
  --white:#ffffff;
  --border:#e2e8f0;
  --text:#1e293b;
  --text-muted:#64748b;
  --bg:#f0f2f5;
  --shadow:0 1px 3px rgba(0,0,0,.08),0 1px 2px rgba(0,0,0,.04);
  --shadow-md:0 4px 16px rgba(0,0,0,.10);
  --r:10px;
}

/* ── SIDEBAR ── */
.sidebar{
  width:var(--sidebar-w);
  background:#0f172a;
  min-height:100vh;
  position:fixed;
  left:0;top:0;bottom:0;
  z-index:300;
  display:flex;
  flex-direction:column;
  transition:transform .25s ease;
  overflow-y:auto;
  scrollbar-width:none;
}
.sidebar::-webkit-scrollbar{display:none}

.sidebar-logo{
  display:flex;align-items:center;gap:10px;
  padding:20px 20px 16px;
  border-bottom:1px solid rgba(255,255,255,.07);
}
.logo-icon{
  width:34px;height:34px;background:var(--green);
  border-radius:8px;display:flex;align-items:center;
  justify-content:center;color:#fff;font-size:16px;font-weight:800;
}
.logo-name{font-size:15px;font-weight:700;color:#fff}
.logo-sub{font-size:10px;color:rgba(255,255,255,.4);display:block;margin-top:1px;letter-spacing:.5px;text-transform:uppercase}

/* Nav groups */
.nav-group{padding:16px 0 8px}
.nav-group-label{
  font-size:10px;font-weight:600;color:rgba(255,255,255,.3);
  text-transform:uppercase;letter-spacing:.8px;
  padding:0 20px 8px;
}
.nav-item{
  display:flex;align-items:center;gap:10px;
  padding:9px 20px;font-size:13px;font-weight:500;
  color:rgba(255,255,255,.6);cursor:pointer;
  transition:all .15s;position:relative;
  border-left:2.5px solid transparent;
}
.nav-item:hover{color:#fff;background:rgba(255,255,255,.05);border-left-color:rgba(255,255,255,.2)}
.nav-item.active{color:#fff;background:rgba(22,163,74,.15);border-left-color:var(--green)}
.nav-item.active .nav-icon{color:var(--green)}
.nav-icon{font-size:17px;width:20px;text-align:center;flex-shrink:0}
.nav-badge{margin-left:auto;background:var(--green);color:#fff;font-size:10px;font-weight:700;padding:1px 7px;border-radius:20px}
.nav-badge.red{background:#ef4444}

/* Sub menu */
.nav-sub{display:none;padding-left:52px}
.nav-sub.open{display:block}
.nav-sub a{display:block;padding:6px 12px;font-size:12.5px;color:rgba(255,255,255,.45);transition:color .15s;border-radius:6px}
.nav-sub a:hover,.nav-sub a.active{color:#fff;background:rgba(255,255,255,.06)}
.nav-chevron{margin-left:auto;font-size:10px;transition:transform .2s;color:rgba(255,255,255,.3)}
.nav-item.open .nav-chevron{transform:rotate(180deg)}

/* Sidebar bottom */
.sidebar-bottom{margin-top:auto;border-top:1px solid rgba(255,255,255,.07);padding:16px 20px}
.admin-profile{display:flex;align-items:center;gap:10px}
.admin-avatar{width:34px;height:34px;background:var(--green);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-size:13px;font-weight:700;flex-shrink:0}
.admin-name{font-size:13px;font-weight:600;color:#fff}
.admin-role{font-size:11px;color:rgba(255,255,255,.4)}
.logout-btn{margin-left:auto;background:rgba(255,255,255,.07);border:none;color:rgba(255,255,255,.5);width:30px;height:30px;border-radius:7px;display:flex;align-items:center;justify-content:center;font-size:14px;transition:all .15s}
.logout-btn:hover{background:rgba(239,68,68,.2);color:#ef4444}

/* ── HEADER ── */
.header{
  position:fixed;top:0;left:var(--sidebar-w);right:0;
  height:var(--header-h);background:var(--white);
  border-bottom:1px solid var(--border);
  display:flex;align-items:center;justify-content:space-between;
  padding:0 24px;z-index:200;gap:16px;
  box-shadow:var(--shadow);
}
.header-left{display:flex;align-items:center;gap:14px}
.mob-toggle{display:none;background:none;border:none;font-size:20px;color:var(--text-muted)}
.breadcrumb{display:flex;align-items:center;gap:6px;font-size:13px}
.breadcrumb-item{color:var(--text-muted)}
.breadcrumb-item.active{color:var(--text);font-weight:500}
.breadcrumb-sep{color:var(--border);font-size:11px}

.header-right{display:flex;align-items:center;gap:8px}
.header-btn{
  position:relative;width:36px;height:36px;background:var(--bg);
  border:1px solid var(--border);border-radius:8px;
  display:flex;align-items:center;justify-content:center;
  font-size:16px;color:var(--text-muted);transition:all .15s;cursor:pointer;
}
.header-btn:hover{background:var(--green-light);border-color:var(--green);color:var(--green)}
.notif-dot{position:absolute;top:6px;right:6px;width:7px;height:7px;background:#ef4444;border-radius:50%;border:1.5px solid #fff}
.header-search{
  display:flex;align-items:center;gap:8px;
  background:var(--bg);border:1px solid var(--border);
  border-radius:8px;padding:0 12px;height:36px;
  transition:border-color .2s;
}
.header-search:focus-within{border-color:var(--green)}
.header-search input{border:none;background:none;font-size:13px;outline:none;width:200px;color:var(--text)}
.header-search input::placeholder{color:var(--text-muted)}
.header-profile{display:flex;align-items:center;gap:8px;padding:6px 12px;border-radius:8px;cursor:pointer;transition:background .15s}
.header-profile:hover{background:var(--bg)}
.h-avatar{width:32px;height:32px;background:var(--green);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-size:12px;font-weight:700}
.h-name{font-size:13px;font-weight:500}
.h-role{font-size:11px;color:var(--text-muted)}

/* ── MAIN CONTENT ── */
.main{
  margin-left:var(--sidebar-w);
  margin-top:var(--header-h);
  flex:1;padding:24px;
  min-height:calc(100vh - var(--header-h));
}

/* ── PAGE HEADER ── */
.page-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;flex-wrap:wrap;gap:12px}
.page-title{font-size:20px;font-weight:700;color:var(--text)}
.page-sub{font-size:13px;color:var(--text-muted);margin-top:3px}
.page-actions{display:flex;gap:8px}

/* ── BUTTONS ── */
.btn{display:inline-flex;align-items:center;gap:7px;padding:9px 18px;border-radius:8px;font-size:13px;font-weight:600;border:none;transition:all .15s;cursor:pointer;white-space:nowrap}
.btn-primary{background:var(--green);color:#fff}
.btn-primary:hover{background:var(--green-dark);transform:translateY(-1px)}
.btn-secondary{background:var(--white);color:var(--text);border:1px solid var(--border)}
.btn-secondary:hover{background:var(--bg);border-color:#cbd5e1}
.btn-danger{background:#fef2f2;color:#dc2626;border:1px solid #fecaca}
.btn-danger:hover{background:#fee2e2}
.btn-sm{padding:6px 13px;font-size:12px}
.btn-icon{width:34px;height:34px;padding:0;justify-content:center}

/* ── CARDS ── */
.card{background:var(--white);border:1px solid var(--border);border-radius:var(--r);box-shadow:var(--shadow)}
.card-header{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;border-bottom:1px solid var(--border)}
.card-title{font-size:14px;font-weight:600;color:var(--text)}
.card-body{padding:20px}
.card-footer{padding:14px 20px;border-top:1px solid var(--border);background:#fafafa;border-radius:0 0 var(--r) var(--r)}

/* ── STAT CARDS ── */
.stat-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px}
.stat-card{background:var(--white);border:1px solid var(--border);border-radius:var(--r);padding:20px;box-shadow:var(--shadow);transition:transform .2s,box-shadow .2s}
.stat-card:hover{transform:translateY(-2px);box-shadow:var(--shadow-md)}
.stat-top{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:14px}
.stat-icon{width:44px;height:44px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:20px}
.stat-badge{display:flex;align-items:center;gap:4px;font-size:11.5px;font-weight:600;padding:3px 9px;border-radius:20px}
.stat-badge.up{background:#dcfce7;color:#16a34a}
.stat-badge.down{background:#fef2f2;color:#dc2626}
.stat-value{font-size:26px;font-weight:800;color:var(--text);letter-spacing:-.5px}
.stat-label{font-size:12.5px;color:var(--text-muted);margin-top:3px}
.stat-foot{font-size:12px;color:var(--text-muted);margin-top:10px;padding-top:10px;border-top:1px solid var(--border)}

/* ── TABLE ── */
.table-wrap{overflow-x:auto;border-radius:var(--r);border:1px solid var(--border)}
table{width:100%;border-collapse:collapse;font-size:13px}
thead{background:#f8fafc}
thead th{padding:11px 16px;text-align:left;font-size:11.5px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:.4px;border-bottom:1px solid var(--border);white-space:nowrap}
tbody tr{border-bottom:1px solid #f1f5f9;transition:background .12s}
tbody tr:last-child{border-bottom:none}
tbody tr:hover{background:#f8fafc}
tbody td{padding:12px 16px;color:var(--text);vertical-align:middle}

/* Table helpers */
.td-img{width:44px;height:44px;border-radius:8px;object-fit:cover;background:#f1f5f9;display:flex;align-items:center;justify-content:center;font-size:22px;flex-shrink:0}
.td-name{font-weight:500}
.td-sub{font-size:12px;color:var(--text-muted);margin-top:2px}
.td-flex{display:flex;align-items:center;gap:10px}
.td-actions{display:flex;gap:6px}

/* Status badges */
.badge{display:inline-flex;align-items:center;gap:4px;padding:3px 10px;border-radius:20px;font-size:11.5px;font-weight:600;white-space:nowrap}
.badge::before{content:'';width:5px;height:5px;border-radius:50%;background:currentColor;flex-shrink:0}
.badge-success{background:#dcfce7;color:#16a34a}
.badge-warning{background:#fef9c3;color:#ca8a04}
.badge-danger{background:#fef2f2;color:#dc2626}
.badge-info{background:#dbeafe;color:#2563eb}
.badge-secondary{background:#f1f5f9;color:#64748b}
.badge-purple{background:#f5f3ff;color:#7c3aed}

/* ── FORM ── */
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:18px}
.form-grid-3{display:grid;grid-template-columns:1fr 1fr 1fr;gap:18px}
.form-full{grid-column:1/-1}
.form-group{display:flex;flex-direction:column;gap:6px}
.form-label{font-size:13px;font-weight:500;color:var(--text)}
.form-label span{color:#ef4444;margin-left:2px}
.form-control{
  padding:9px 13px;border:1.5px solid var(--border);border-radius:8px;
  font-size:13.5px;font-family:inherit;outline:none;
  transition:border-color .2s,box-shadow .2s;color:var(--text);background:#fff;
}
.form-control:focus{border-color:var(--green);box-shadow:0 0 0 3px rgba(22,163,74,.10)}
.form-control::placeholder{color:#94a3b8}
select.form-control{cursor:pointer}
textarea.form-control{resize:vertical;min-height:100px}
.form-hint{font-size:12px;color:var(--text-muted);margin-top:2px}
.form-error{font-size:12px;color:#dc2626;margin-top:2px}

/* Image upload area */
.upload-area{
  border:2px dashed var(--border);border-radius:var(--r);
  padding:32px;text-align:center;cursor:pointer;
  transition:all .2s;background:#fafafa;
}
.upload-area:hover{border-color:var(--green);background:var(--green-light)}
.upload-icon{font-size:36px;margin-bottom:10px}
.upload-title{font-size:13px;font-weight:500;margin-bottom:4px}
.upload-sub{font-size:12px;color:var(--text-muted)}

/* Toggle switch */
.toggle-wrap{display:flex;align-items:center;gap:10px}
.toggle{position:relative;width:42px;height:22px;flex-shrink:0}
.toggle input{opacity:0;width:0;height:0}
.toggle-slider{position:absolute;inset:0;background:#cbd5e1;border-radius:20px;cursor:pointer;transition:background .2s}
.toggle-slider::before{content:'';position:absolute;width:16px;height:16px;left:3px;top:3px;background:#fff;border-radius:50%;transition:transform .2s}
.toggle input:checked + .toggle-slider{background:var(--green)}
.toggle input:checked + .toggle-slider::before{transform:translateX(20px)}
.toggle-label{font-size:13px;color:var(--text)}

/* ── ALERTS ── */
.alert{display:flex;align-items:flex-start;gap:10px;padding:12px 16px;border-radius:8px;font-size:13px;margin-bottom:16px}
.alert-success{background:#dcfce7;border:1px solid #bbf7d0;color:#15803d}
.alert-error{background:#fef2f2;border:1px solid #fecaca;color:#dc2626}
.alert-warning{background:#fef9c3;border:1px solid #fde047;color:#a16207}
.alert-info{background:#dbeafe;border:1px solid #bfdbfe;color:#1d4ed8}

/* ── PAGINATION ── */
.pagination{display:flex;align-items:center;gap:4px}
.page-item{width:34px;height:34px;border-radius:7px;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:500;cursor:pointer;transition:all .15s;border:1px solid var(--border);color:var(--text-muted);background:var(--white)}
.page-item:hover{border-color:var(--green);color:var(--green)}
.page-item.active{background:var(--green);color:#fff;border-color:var(--green)}
.page-item.disabled{opacity:.5;cursor:not-allowed}

/* ── TOAST ── */
.toast-wrap{position:fixed;bottom:24px;right:24px;z-index:9999;display:flex;flex-direction:column;gap:8px}
.toast{display:flex;align-items:center;gap:10px;padding:12px 18px;border-radius:10px;background:var(--white);border:1px solid var(--border);box-shadow:var(--shadow-md);font-size:13px;font-weight:500;animation:slideIn .3s ease;min-width:260px}
.toast.success{border-left:3px solid #16a34a}
.toast.error{border-left:3px solid #dc2626}
@keyframes slideIn{from{transform:translateX(100px);opacity:0}to{transform:translateX(0);opacity:1}}

/* ── FILTERS BAR ── */
.filters-bar{display:flex;align-items:center;gap:10px;flex-wrap:wrap;margin-bottom:16px}
.filter-select{padding:7px 12px;border:1px solid var(--border);border-radius:8px;font-size:13px;font-family:inherit;outline:none;background:#fff;color:var(--text);cursor:pointer;transition:border-color .15s}
.filter-select:focus{border-color:var(--green)}
.search-filter{display:flex;align-items:center;gap:8px;background:#fff;border:1px solid var(--border);border-radius:8px;padding:0 12px;height:36px;flex:1;max-width:300px}
.search-filter input{border:none;background:none;font-size:13px;outline:none;width:100%}
.search-filter:focus-within{border-color:var(--green)}

/* ── MOBILE ── */
.sidebar-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.4);z-index:299}

@media(max-width:1024px){
  .stat-grid{grid-template-columns:repeat(2,1fr)}
}
@media(max-width:768px){
  .sidebar{transform:translateX(-100%)}
  .sidebar.open{transform:translateX(0)}
  .sidebar-overlay.open{display:block}
  .header{left:0}
  .main{margin-left:0}
  .mob-toggle{display:block}
  .header-search{display:none}
  .stat-grid{grid-template-columns:1fr 1fr}
  .form-grid{grid-template-columns:1fr}
  .form-grid-3{grid-template-columns:1fr}
  .page-header{flex-direction:column;align-items:flex-start}
}
@media(max-width:480px){
  .stat-grid{grid-template-columns:1fr}
  .main{padding:16px}
}
</style>
<?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>


<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>


<aside class="sidebar" id="sidebar">
  <div class="sidebar-logo">
    <div class="logo-icon">G</div>
    <div>
      <div class="logo-name">GroceryMart</div>
      <span class="logo-sub">Admin Panel</span>
    </div>
  </div>

  <nav>
    
    <div class="nav-group">
      <div class="nav-group-label">Main</div>
      <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
        <span class="nav-icon">📊</span> Dashboard
      </a>
    </div>

    
    <div class="nav-group">
      <div class="nav-group-label">Catalog</div>
      <div class="nav-item <?php echo e(request()->routeIs('admin.categories.*') ? 'active' : ''); ?>" onclick="toggleSub('cat-sub', this)">
        <span class="nav-icon">🗂️</span> Categories
        <span class="nav-chevron">▾</span>
      </div>
      <div class="nav-sub <?php echo e(request()->routeIs('admin.categories.*') ? 'open' : ''); ?>" id="cat-sub">
        <a href="<?php echo e(route('admin.categories.index')); ?>" class="<?php echo e(request()->routeIs('admin.categories.index') ? 'active' : ''); ?>">All Categories</a>
        <a href="<?php echo e(route('admin.categories.create')); ?>" class="<?php echo e(request()->routeIs('admin.categories.create') ? 'active' : ''); ?>">Add New</a>
      </div>

      <div class="nav-item <?php echo e(request()->routeIs('admin.products.*') ? 'active' : ''); ?>" onclick="toggleSub('prod-sub', this)">
        <span class="nav-icon">🛒</span> Products
        <span class="nav-chevron">▾</span>
      </div>
      <div class="nav-sub <?php echo e(request()->routeIs('admin.products.*') ? 'open' : ''); ?>" id="prod-sub">
        <a href="<?php echo e(route('admin.products.index')); ?>" class="<?php echo e(request()->routeIs('admin.products.index') ? 'active' : ''); ?>">All Products</a>
        <a href="<?php echo e(route('admin.products.create')); ?>" class="<?php echo e(request()->routeIs('admin.products.create') ? 'active' : ''); ?>">Add New</a>
      </div>

      <a href="<?php echo e(route('admin.inventory.index')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.inventory.*') ? 'active' : ''); ?>">
        <span class="nav-icon">📦</span> Inventory
        <?php try { $lowStockCount = \App\Models\Product::whereColumn('stock_quantity','<=','low_stock_alert')->count(); } catch(\Exception $e) { $lowStockCount = 0; } ?>
        <?php if($lowStockCount > 0): ?>
          <span class="nav-badge red"><?php echo e($lowStockCount); ?></span>
        <?php endif; ?>
      </a>
    </div>

    
    <div class="nav-group">
      <div class="nav-group-label">Sales</div>
      <a href="<?php echo e(route('admin.orders.index')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.orders.*') ? 'active' : ''); ?>">
        <span class="nav-icon">🧾</span> Orders
        <?php try { $pendingOrdersCount = \App\Models\Order::where('status','pending')->count(); } catch(\Exception $e) { $pendingOrdersCount = 0; } ?>
        <?php if($pendingOrdersCount > 0): ?>
          <span class="nav-badge"><?php echo e($pendingOrdersCount); ?></span>
        <?php endif; ?>
      </a>
      <a href="<?php echo e(route('admin.customers.index')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.customers.*') ? 'active' : ''); ?>">
        <span class="nav-icon">👥</span> Customers
      </a>
      <a href="<?php echo e(route('admin.coupons.index')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.coupons.*') ? 'active' : ''); ?>">
        <span class="nav-icon">🎟️</span> Coupons
      </a>
    </div>

    
    <div class="nav-group">
      <div class="nav-group-label">Marketing</div>
      <a href="<?php echo e(route('admin.banners.index')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.banners.*') ? 'active' : ''); ?>">
        <span class="nav-icon">🖼️</span> Banners
      </a>
      <a href="<?php echo e(route('admin.reviews.index')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.reviews.*') ? 'active' : ''); ?>">
        <span class="nav-icon">⭐</span> Reviews
      </a>
    </div>

    
    <div class="nav-group">
      <div class="nav-group-label">Reports</div>
      <a href="<?php echo e(route('admin.reports.sales')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.reports.*') ? 'active' : ''); ?>">
        <span class="nav-icon">📈</span> Sales Report
      </a>
    </div>

    
    <div class="nav-group">
      <div class="nav-group-label">System</div>
      <a href="<?php echo e(route('admin.settings.general')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.settings.*') ? 'active' : ''); ?>">
        <span class="nav-icon">⚙️</span> Settings
      </a>
      <a href="<?php echo e(url('/')); ?>" target="_blank" class="nav-item">
        <span class="nav-icon">🌐</span> View Website
      </a>
    </div>
  </nav>

  <div class="sidebar-bottom">
    <div class="admin-profile">
      <div class="admin-avatar"><?php echo e(substr(auth()->user()->name, 0, 2)); ?></div>
      <div>
        <div class="admin-name"><?php echo e(auth()->user()->name); ?></div>
        <div class="admin-role">Administrator</div>
      </div>
      <form action="<?php echo e(route('logout')); ?>" method="POST" style="margin-left:auto">
        <?php echo csrf_field(); ?>
        <button type="submit" class="logout-btn" title="Logout">⇥</button>
      </form>
    </div>
  </div>
</aside>


<header class="header">
  <div class="header-left">
    <button class="mob-toggle" onclick="openSidebar()">☰</button>
    <div class="breadcrumb">
      <span class="breadcrumb-item">Admin</span>
      <span class="breadcrumb-sep">›</span>
      <span class="breadcrumb-item active"><?php echo $__env->yieldContent('breadcrumb', 'Dashboard'); ?></span>
    </div>
  </div>
  <div class="header-right">
    <div class="header-search">
      <span>🔍</span>
      <input type="text" placeholder="Search...">
    </div>
    <div class="header-btn" title="Notifications">
      🔔
      <span class="notif-dot"></span>
    </div>
    <div class="header-btn" title="View website" onclick="window.open('/')">🌐</div>
    <div class="header-profile">
      <div class="h-avatar"><?php echo e(substr(auth()->user()->name, 0, 2)); ?></div>
      <div>
        <div class="h-name"><?php echo e(auth()->user()->name); ?></div>
        <div class="h-role">Admin</div>
      </div>
    </div>
  </div>
</header>


<main class="main">
  
  <?php if(session('success')): ?>
    <div class="alert alert-success">✅ <?php echo e(session('success')); ?></div>
  <?php endif; ?>
  <?php if(session('error')): ?>
    <div class="alert alert-error">❌ <?php echo e(session('error')); ?></div>
  <?php endif; ?>
  <?php if(session('warning')): ?>
    <div class="alert alert-warning">⚠️ <?php echo e(session('warning')); ?></div>
  <?php endif; ?>

  <?php echo $__env->yieldContent('content'); ?>
</main>


<div class="toast-wrap" id="toastWrap"></div>

<script>
// Sidebar toggle
function openSidebar(){
  document.getElementById('sidebar').classList.add('open');
  document.getElementById('sidebarOverlay').classList.add('open');
  document.body.style.overflow='hidden';
}
function closeSidebar(){
  document.getElementById('sidebar').classList.remove('open');
  document.getElementById('sidebarOverlay').classList.remove('open');
  document.body.style.overflow='';
}

// Sub-menu toggle
function toggleSub(id, el){
  const sub=document.getElementById(id);
  const isOpen=sub.classList.contains('open');
  sub.classList.toggle('open',!isOpen);
  el.classList.toggle('open',!isOpen);
}

// Toast notification
function showToast(msg, type='success'){
  const wrap=document.getElementById('toastWrap');
  const t=document.createElement('div');
  t.className='toast '+type;
  t.innerHTML=(type==='success'?'✅':'❌')+' '+msg;
  wrap.appendChild(t);
  setTimeout(()=>{t.style.opacity='0';t.style.transform='translateX(60px)';setTimeout(()=>t.remove(),300);},3000);
}

// CSRF for AJAX
window.csrfToken = document.querySelector('meta[name="csrf-token"]').content;

// Confirm delete
function confirmDelete(form){
  if(confirm('Kya aap sach mein delete karna chahte hain? Ye action undo nahi ho sakta.')){
    form.submit();
  }
}
</script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views\admin\layouts\admin.blade.php ENDPATH**/ ?>