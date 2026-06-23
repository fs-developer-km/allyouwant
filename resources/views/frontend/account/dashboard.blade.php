
@extends('frontend.layouts.app')

@section('title', 'My Account')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
/* ══════════════════════════════════════════
   ALL YOU WANT GROCERY — ACCOUNT DASHBOARD
   Professional · Feature-Rich · Responsive
══════════════════════════════════════════ */
:root{
  --g:#0d6e39;--g2:#0a5a2e;--g3:#22c55e;
  --gl:#f0faf4;--gl2:#dcfce7;
  --orange:#f97316;--red:#dc2626;--blue:#3b82f6;--gold:#f59e0b;
  --border:#e8edf0;--border2:#f1f5f9;
  --white:#fff;--bg:#f5f7fa;
  --text:#0f1111;--text2:#374151;--muted:#6b7280;
  --shadow:0 1px 4px rgba(0,0,0,.07);
  --shadow-md:0 4px 20px rgba(0,0,0,.10);
  --r:12px;--r2:16px;
}

/* ── PAGE SHELL ─────────────────────────── */
.acc-page{background:var(--bg);min-height:100vh}
.acc-wrap{max-width:1180px;margin:0 auto;padding:28px 20px 60px}

/* ── BREADCRUMB ─────────────────────────── */
.acc-bc{font-size:12.5px;color:var(--muted);margin-bottom:22px;display:flex;align-items:center;gap:6px}
.acc-bc a{color:var(--g);font-weight:500;text-decoration:none}
.acc-bc a:hover{text-decoration:underline}
.acc-bc .sep{color:#d1d5db}

/* ── LAYOUT ─────────────────────────────── */
.acc-grid{display:grid;grid-template-columns:260px 1fr;gap:22px;align-items:start}

/* ══════════════════════════════════════════
   LEFT SIDEBAR
══════════════════════════════════════════ */
.acc-sidebar{position:sticky;top:130px}
.acc-profile-card{background:var(--white);border-radius:var(--r2);border:1px solid var(--border);overflow:hidden;margin-bottom:14px;box-shadow:var(--shadow)}
.acc-profile-top{background:linear-gradient(135deg,var(--g2) 0%,var(--g) 60%,var(--g3) 100%);padding:24px 20px;text-align:center;position:relative}
.acc-avatar{width:68px;height:68px;border-radius:50%;background:rgba(255,255,255,.2);border:3px solid rgba(255,255,255,.5);display:flex;align-items:center;justify-content:center;font-size:26px;font-weight:800;color:#fff;margin:0 auto 12px;letter-spacing:-.5px;backdrop-filter:blur(4px)}
.acc-name{font-size:15px;font-weight:700;color:#fff;margin-bottom:3px}
.acc-email{font-size:12px;color:rgba(255,255,255,.75)}
.acc-member-badge{display:inline-flex;align-items:center;gap:5px;background:rgba(255,255,255,.15);color:rgba(255,255,255,.9);font-size:11px;font-weight:600;padding:4px 12px;border-radius:20px;margin-top:10px;backdrop-filter:blur(4px);border:1px solid rgba(255,255,255,.2)}
.acc-profile-stats{display:grid;grid-template-columns:repeat(3,1fr);border-top:1px solid var(--border2)}
.aps-item{padding:12px 8px;text-align:center}
.aps-item:not(:last-child){border-right:1px solid var(--border2)}
.aps-num{font-size:18px;font-weight:800;color:var(--g)}
.aps-lbl{font-size:10.5px;color:var(--muted);margin-top:2px}

/* SIDEBAR NAV */
.acc-nav{background:var(--white);border-radius:var(--r2);border:1px solid var(--border);overflow:hidden;box-shadow:var(--shadow)}
.acc-nav-head{padding:11px 16px;background:var(--border2);font-size:11px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.6px}
.acc-nav-item{display:flex;align-items:center;gap:11px;padding:13px 16px;font-size:13.5px;font-weight:500;color:var(--text2);text-decoration:none;border-bottom:1px solid var(--border2);transition:all .15s;cursor:pointer;border:none;background:none;width:100%;text-align:left;font-family:inherit}
.acc-nav-item:last-child{border-bottom:none}
.acc-nav-item:hover{background:var(--gl);color:var(--g)}
.acc-nav-item.active{background:var(--gl);color:var(--g);font-weight:700;border-left:3px solid var(--g)}
.acc-nav-icon{font-size:17px;width:26px;text-align:center;flex-shrink:0}
.acc-nav-badge{margin-left:auto;background:var(--g);color:#fff;font-size:10px;font-weight:700;padding:2px 8px;border-radius:10px}
.acc-nav-arrow{margin-left:auto;color:var(--muted);font-size:12px}

/* ══════════════════════════════════════════
   RIGHT: MAIN CONTENT
══════════════════════════════════════════ */
.acc-main{}

/* ── TAB PANELS ─────────────────────────── */
.acc-panel{display:none}
.acc-panel.active{display:block}

/* ── SECTION HEADER ─────────────────────── */
.sec-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;flex-wrap:wrap;gap:10px}
.sec-title{font-size:18px;font-weight:800;color:var(--text);display:flex;align-items:center;gap:8px}
.sec-sub{font-size:13px;color:var(--muted);margin-top:2px}

/* ── CARD BASE ──────────────────────────── */
.dash-card{background:var(--white);border-radius:var(--r2);border:1px solid var(--border);box-shadow:var(--shadow);margin-bottom:18px;overflow:hidden}
.dash-card-head{padding:15px 20px;border-bottom:1px solid var(--border2);display:flex;align-items:center;justify-content:space-between}
.dash-card-title{font-size:14px;font-weight:700;color:var(--text);display:flex;align-items:center;gap:7px}
.dash-card-body{padding:18px 20px}

/* ── STATS ROW ──────────────────────────── */
.stats-row{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:18px}
.stat-box{background:var(--white);border-radius:var(--r2);border:1px solid var(--border);padding:18px 16px;box-shadow:var(--shadow);display:flex;align-items:flex-start;gap:12px;transition:all .2s}
.stat-box:hover{transform:translateY(-2px);box-shadow:var(--shadow-md);border-color:#b7e4c7}
.stat-ico{width:44px;height:44px;border-radius:11px;display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0}
.stat-ico-g{background:var(--gl2)}
.stat-ico-o{background:#fff7ed}
.stat-ico-b{background:#eff6ff}
.stat-ico-r{background:#fef2f2}
.stat-num{font-size:24px;font-weight:900;color:var(--text);line-height:1;margin-bottom:3px}
.stat-lbl{font-size:12px;color:var(--muted);font-weight:500}

/* ── ORDER CARDS ─────────────────────────── */
.order-card{background:var(--white);border:1.5px solid var(--border);border-radius:var(--r2);margin-bottom:14px;overflow:hidden;transition:all .2s;box-shadow:var(--shadow)}
.order-card:hover{border-color:#b7e4c7;box-shadow:var(--shadow-md)}
.order-card-head{padding:14px 18px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid var(--border2);flex-wrap:wrap;gap:10px;background:#fafcfb}
.order-num{font-size:14px;font-weight:800;color:var(--g)}
.order-date{font-size:12px;color:var(--muted)}
.order-items-strip{padding:14px 18px;display:flex;align-items:center;gap:12px;flex-wrap:wrap}
.order-item-thumb{width:52px;height:52px;border-radius:9px;border:1px solid var(--border);background:#f8fafc;display:flex;align-items:center;justify-content:center;overflow:hidden;flex-shrink:0;font-size:24px}
.order-item-thumb img{width:100%;height:100%;object-fit:cover}
.order-item-info{flex:1;min-width:0}
.order-item-name{font-size:13.5px;font-weight:600;color:var(--text);margin-bottom:2px;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden}
.order-item-meta{font-size:12px;color:var(--muted)}
.order-more-items{font-size:12px;color:var(--muted);font-weight:600;white-space:nowrap}
.order-card-foot{padding:12px 18px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;background:var(--border2)}
.order-total{font-size:15px;font-weight:800;color:var(--text)}
.order-payment{font-size:11.5px;color:var(--muted);display:flex;align-items:center;gap:5px;margin-top:2px}

/* ── ORDER TRACKER ──────────────────────── */
.order-tracker{padding:16px 18px;background:var(--gl);border-top:1px solid #b7e4c7}
.tracker-steps{display:flex;align-items:flex-start;position:relative}
.tracker-steps::before{content:'';position:absolute;top:14px;left:12px;right:12px;height:2px;background:var(--border);z-index:0}
.tracker-step{flex:1;display:flex;flex-direction:column;align-items:center;position:relative;z-index:1;text-align:center}
.ts-dot{width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:13px;border:2px solid var(--border);background:var(--white);margin-bottom:7px;transition:all .3s}
.ts-dot.done{background:var(--g);border-color:var(--g);color:#fff}
.ts-dot.active{background:var(--white);border-color:var(--g);color:var(--g);box-shadow:0 0 0 4px rgba(13,110,57,.15)}
.ts-label{font-size:10.5px;font-weight:600;color:var(--muted);line-height:1.3}
.ts-label.done,.ts-label.active{color:var(--g)}
.tracker-line-fill{position:absolute;top:14px;left:12px;height:2px;background:var(--g);z-index:0;transition:width .6s ease}

/* ── BADGE STYLES ───────────────────────── */
.badge{display:inline-flex;align-items:center;gap:4px;padding:3px 10px;border-radius:20px;font-size:11.5px;font-weight:700}
.badge-pending{background:#fef9c3;color:#ca8a04}
.badge-confirmed{background:#dbeafe;color:#1d4ed8}
.badge-processing{background:#ede9fe;color:#7c3aed}
.badge-shipped{background:#e0f2fe;color:#0369a1}
.badge-out_for_delivery{background:#fff7ed;color:#c2410c}
.badge-delivered{background:var(--gl2);color:var(--g2)}
.badge-cancelled{background:#fef2f2;color:var(--red)}
.badge-refunded{background:#f3f4f6;color:#374151}

/* ── QUICK ACTIONS ──────────────────────── */
.quick-actions{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:18px}
.qa-item{background:var(--white);border:1.5px solid var(--border);border-radius:var(--r2);padding:16px 12px;text-align:center;text-decoration:none;color:var(--text2);transition:all .2s;cursor:pointer}
.qa-item:hover{border-color:var(--g);background:var(--gl);color:var(--g);transform:translateY(-2px);box-shadow:var(--shadow-md)}
.qa-icon{font-size:26px;margin-bottom:7px}
.qa-label{font-size:12.5px;font-weight:600}

/* ── ADDRESS CARD ───────────────────────── */
.addr-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:14px}
.addr-card{border:1.5px solid var(--border);border-radius:var(--r);padding:16px;position:relative;transition:all .2s}
.addr-card.default{border-color:var(--g);background:var(--gl)}
.addr-card:hover{border-color:var(--g);box-shadow:var(--shadow-md)}
.addr-default-badge{position:absolute;top:10px;right:10px;background:var(--g);color:#fff;font-size:10px;font-weight:700;padding:2px 8px;border-radius:10px}
.addr-label{font-size:12px;font-weight:700;color:var(--g);text-transform:uppercase;letter-spacing:.4px;margin-bottom:6px;display:flex;align-items:center;gap:5px}
.addr-text{font-size:13px;color:var(--text2);line-height:1.65}
.addr-actions{display:flex;gap:8px;margin-top:12px}
.addr-btn{padding:5px 12px;border-radius:6px;font-size:12px;font-weight:600;cursor:pointer;transition:all .15s;border:1px solid var(--border);background:var(--white);color:var(--text2);font-family:inherit}
.addr-btn:hover{border-color:var(--g);color:var(--g)}
.addr-btn.danger:hover{border-color:var(--red);color:var(--red)}
.add-addr-card{border:1.5px dashed var(--border);border-radius:var(--r);padding:16px;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:8px;cursor:pointer;transition:all .2s;min-height:120px}
.add-addr-card:hover{border-color:var(--g);background:var(--gl)}

/* ── PROFILE FORM ───────────────────────── */
.form-group{margin-bottom:16px}
.form-label{display:block;font-size:12.5px;font-weight:700;color:var(--text2);margin-bottom:6px;text-transform:uppercase;letter-spacing:.3px}
.form-control{width:100%;padding:11px 14px;border:1.5px solid var(--border);border-radius:9px;font-size:14px;font-family:inherit;color:var(--text);outline:none;transition:all .2s;background:#fff}
.form-control:focus{border-color:var(--g);box-shadow:0 0 0 3px rgba(13,110,57,.1)}
.form-row-2{display:grid;grid-template-columns:1fr 1fr;gap:16px}
.btn-save{background:var(--g);color:#fff;border:none;padding:12px 28px;border-radius:10px;font-size:14px;font-weight:700;cursor:pointer;transition:all .2s;font-family:inherit}
.btn-save:hover{background:var(--g2);transform:translateY(-1px);box-shadow:0 4px 14px rgba(13,110,57,.3)}
.btn-outline{background:none;color:var(--text2);border:1.5px solid var(--border);padding:11px 22px;border-radius:10px;font-size:14px;font-weight:600;cursor:pointer;transition:all .2s;font-family:inherit}
.btn-outline:hover{border-color:var(--g);color:var(--g)}

/* ── EMPTY STATE ─────────────────────────── */
.empty-state{text-align:center;padding:52px 20px}
.empty-icon{font-size:60px;margin-bottom:14px}
.empty-title{font-size:17px;font-weight:700;color:var(--text2);margin-bottom:7px}
.empty-sub{font-size:13.5px;color:var(--muted);margin-bottom:20px}
.btn-shop{display:inline-block;background:var(--g);color:#fff;padding:11px 28px;border-radius:50px;font-size:14px;font-weight:700;text-decoration:none;transition:all .2s}
.btn-shop:hover{background:var(--g2);transform:translateY(-2px)}

/* ── TOAST ──────────────────────────────── */
.toast-wrap{position:fixed;bottom:22px;left:50%;transform:translateX(-50%);z-index:9999;display:flex;flex-direction:column;align-items:center;gap:7px;pointer-events:none}
.toast{background:var(--g);color:#fff;padding:11px 22px;border-radius:50px;font-size:13.5px;font-weight:600;box-shadow:0 6px 24px rgba(0,0,0,.18);animation:tIn .3s ease;white-space:nowrap}
@keyframes tIn{from{opacity:0;transform:translateY(12px)}to{opacity:1;transform:translateY(0)}}

/* ── SCROLL REVEAL ──────────────────────── */
.reveal{opacity:0;transform:translateY(16px);transition:opacity .4s ease,transform .4s ease}
.reveal.visible{opacity:1;transform:translateY(0)}

/* ── RESPONSIVE ─────────────────────────── */
@media(max-width:900px){
  .acc-grid{grid-template-columns:1fr}
  .acc-sidebar{position:static}
  .stats-row{grid-template-columns:repeat(2,1fr)}
  .quick-actions{grid-template-columns:repeat(4,1fr)}
  .addr-grid{grid-template-columns:1fr}
}
@media(max-width:600px){
  .acc-wrap{padding:16px 14px 80px}
  .stats-row{grid-template-columns:repeat(2,1fr);gap:10px}
  .quick-actions{grid-template-columns:repeat(2,1fr)}
  .form-row-2{grid-template-columns:1fr}
  .order-card-head{padding:12px 14px}
  .order-items-strip{padding:12px 14px}
  .order-card-foot{padding:10px 14px}
  .dash-card-body{padding:14px}
}
@media(max-width:400px){
  .stats-row{grid-template-columns:repeat(2,1fr)}
  .stat-num{font-size:20px}
}
</style>
@endpush

@section('content')

@php
  $user = auth()->user();
  $orders = $user->orders()->with('items.product')->latest()->get();

  $totalOrders   = $orders->count();
  $delivered     = $orders->where('status','delivered')->count();
  $pending       = $orders->whereIn('status',['pending','confirmed','processing'])->count();
  $totalSpent    = $orders->where('status','!=','cancelled')->sum('total');

  $statusSteps = [
    'pending'          => 0,
    'confirmed'        => 1,
    'processing'       => 2,
    'shipped'          => 3,
    'out_for_delivery' => 4,
    'delivered'        => 5,
  ];
  $trackerLabels = ['Placed','Confirmed','Preparing','Shipped','Out for\nDelivery','Delivered'];
  $trackerIcons  = ['🛒','✅','🍱','🚚','🛵','🎉'];
@endphp

<div class="acc-page">
<div class="acc-wrap">

  {{-- BREADCRUMB --}}
  <div class="acc-bc">
    <a href="{{ route('home') }}">🏠 Home</a>
    <span class="sep">›</span>
    <span style="color:var(--text2);font-weight:600">My Account</span>
  </div>

  <div class="acc-grid">

    {{-- ══ LEFT SIDEBAR ══ --}}
    <aside class="acc-sidebar">

      {{-- Profile Card --}}
      <div class="acc-profile-card">
        <div class="acc-profile-top">
          <div class="acc-avatar">{{ strtoupper(substr($user->name,0,2)) }}</div>
          <div class="acc-name">{{ $user->name }}</div>
          <div class="acc-email">{{ $user->email }}</div>
          <div class="acc-member-badge">⭐ Valued Customer</div>
        </div>
        <div class="acc-profile-stats">
          <div class="aps-item"><div class="aps-num">{{ $totalOrders }}</div><div class="aps-lbl">Orders</div></div>
          <div class="aps-item"><div class="aps-num">{{ $delivered }}</div><div class="aps-lbl">Delivered</div></div>
          <div class="aps-item"><div class="aps-num">₹{{ number_format($totalSpent,0) }}</div><div class="aps-lbl">Spent</div></div>
        </div>
      </div>

      {{-- Nav Menu --}}
      <div class="acc-nav">
        <div class="acc-nav-head">My Account</div>
        <button class="acc-nav-item active" onclick="showPanel('orders',this)">
          <span class="acc-nav-icon">📦</span>My Orders
          @if($pending > 0)<span class="acc-nav-badge">{{ $pending }}</span>@endif
        </button>
        <button class="acc-nav-item" onclick="showPanel('profile',this)">
          <span class="acc-nav-icon">👤</span>Profile & Settings
          <span class="acc-nav-arrow">›</span>
        </button>
        <button class="acc-nav-item" onclick="showPanel('addresses',this)">
          <span class="acc-nav-icon">📍</span>Saved Addresses
          <span class="acc-nav-arrow">›</span>
        </button>
        <button class="acc-nav-item" onclick="showPanel('wishlist',this)">
          <span class="acc-nav-icon">❤️</span>Wishlist
          <span class="acc-nav-arrow">›</span>
        </button>
        <div class="acc-nav-head" style="margin-top:4px">Support</div>
        <a href="https://wa.me/919911011411" target="_blank" class="acc-nav-item" style="text-decoration:none">
          <span class="acc-nav-icon">💬</span>WhatsApp Support
          <span class="acc-nav-arrow">›</span>
        </a>
        <a href="{{ route('home') }}" class="acc-nav-item" style="text-decoration:none">
          <span class="acc-nav-icon">🛒</span>Continue Shopping
          <span class="acc-nav-arrow">›</span>
        </a>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="acc-nav-item" style="color:var(--red)">
            <span class="acc-nav-icon">🚪</span>Logout
          </button>
        </form>
      </div>

    </aside>

    {{-- ══ MAIN CONTENT ══ --}}
    <div class="acc-main">

      {{-- ── STATS ROW ── --}}
      <div class="stats-row reveal">
        <div class="stat-box">
          <div class="stat-ico stat-ico-g">📦</div>
          <div>
            <div class="stat-num">{{ $totalOrders }}</div>
            <div class="stat-lbl">Total Orders</div>
          </div>
        </div>
        <div class="stat-box">
          <div class="stat-ico stat-ico-o">⏳</div>
          <div>
            <div class="stat-num">{{ $pending }}</div>
            <div class="stat-lbl">In Progress</div>
          </div>
        </div>
        <div class="stat-box">
          <div class="stat-ico stat-ico-b">✅</div>
          <div>
            <div class="stat-num">{{ $delivered }}</div>
            <div class="stat-lbl">Delivered</div>
          </div>
        </div>
        <div class="stat-box">
          <div class="stat-ico stat-ico-r">💰</div>
          <div>
            <div class="stat-num">₹{{ number_format($totalSpent,0) }}</div>
            <div class="stat-lbl">Total Spent</div>
          </div>
        </div>
      </div>

      {{-- ── QUICK ACTIONS ── --}}
      <div class="quick-actions reveal" style="transition-delay:.05s">
        <a href="{{ route('shop') }}" class="qa-item">
          <div class="qa-icon">🛒</div>
          <div class="qa-label">Shop Now</div>
        </a>
        <button class="qa-item" onclick="showPanel('orders',document.querySelector('.acc-nav-item'))">
          <div class="qa-icon">📦</div>
          <div class="qa-label">My Orders</div>
        </button>
        <button class="qa-item" onclick="showPanel('addresses',document.querySelectorAll('.acc-nav-item')[2])">
          <div class="qa-icon">📍</div>
          <div class="qa-label">Addresses</div>
        </button>
        <a href="{{ route('offers') }}" class="qa-item">
          <div class="qa-icon">🔥</div>
          <div class="qa-label">Offers</div>
        </a>
      </div>

      {{-- ══════════════════════════════
           PANEL: ORDERS
      ══════════════════════════════ --}}
      <div class="acc-panel active" id="panel-orders">

        <div class="sec-head">
          <div>
            <div class="sec-title">📦 My Orders</div>
            <div class="sec-sub">Track and manage your orders</div>
          </div>
          <a href="{{ route('shop') }}" style="font-size:13px;font-weight:700;color:var(--g);text-decoration:none;padding:8px 16px;border:1.5px solid var(--gl2);border-radius:50px;background:var(--gl)">+ New Order</a>
        </div>

        {{-- Filter tabs --}}
        <div style="display:flex;gap:6px;margin-bottom:18px;overflow-x:auto;scrollbar-width:none;padding-bottom:2px">
          @foreach(['all'=>'All','pending'=>'Pending','processing'=>'Processing','shipped'=>'Shipped','out_for_delivery'=>'Out for Delivery','delivered'=>'Delivered','cancelled'=>'Cancelled'] as $s=>$l)
          <button onclick="filterOrders('{{ $s }}')" id="otab-{{ $s }}" style="padding:7px 16px;border-radius:50px;border:1.5px solid var(--border);background:var(--white);font-size:12.5px;font-weight:600;color:var(--text2);cursor:pointer;white-space:nowrap;transition:all .15s;font-family:inherit" class="{{ $s==='all' ? 'otab-active' : '' }}">{{ $l }}</button>
          @endforeach
        </div>

        {{-- Order Cards --}}
        @forelse($orders as $order)
        @php
          $stepNum = $statusSteps[$order->status] ?? 0;
          $lineW   = $order->status === 'cancelled' ? 0 : round($stepNum / 5 * 100);
        @endphp
        <div class="order-card reveal" data-status="{{ $order->status }}" style="transition-delay:{{ $loop->index * .07 }}s">

          {{-- Head --}}
          <div class="order-card-head">
            <div>
              <div class="order-num">#{{ $order->order_number }}</div>
              <div class="order-date">📅 {{ $order->created_at->format('d M Y, h:i A') }}</div>
            </div>
            <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap">
              <span class="badge badge-{{ $order->status }}">
                {{ ['pending'=>'⏳','confirmed'=>'✅','processing'=>'🍱','shipped'=>'🚚','out_for_delivery'=>'🛵','delivered'=>'🎉','cancelled'=>'❌','refunded'=>'↩️'][$order->status] ?? '📦' }}
                {{ $order->status_label }}
              </span>
              <a href="{{ route('order.show', $order->id) }}" style="font-size:12px;font-weight:700;color:var(--g);text-decoration:none;padding:5px 12px;border:1.5px solid #b7e4c7;border-radius:6px;background:var(--gl);white-space:nowrap">View Details →</a>
            </div>
          </div>

          {{-- Order Items --}}
          <div class="order-items-strip">
            @foreach($order->items->take(3) as $item)
            <div class="order-item-thumb">
              @if($item->product_image)
                <img src="{{ asset('storage/'.$item->product_image) }}" alt="{{ $item->product_name }}" onerror="this.style.display='none'">
              @else
                🛒
              @endif
            </div>
            @endforeach
            @if($order->items->count() > 3)
              <div class="order-more-items">+{{ $order->items->count() - 3 }} more items</div>
            @endif
            <div style="margin-left:auto;text-align:right">
              <div style="font-size:13px;color:var(--muted)">{{ $order->items->sum('quantity') }} items</div>
              <div style="font-size:15px;font-weight:800;color:var(--text)">₹{{ number_format($order->total) }}</div>
            </div>
          </div>

          {{-- ORDER TRACKER --}}
          @if(!in_array($order->status, ['cancelled','refunded']))
          <div class="order-tracker">
            <div style="font-size:11.5px;font-weight:700;color:var(--g2);margin-bottom:12px;text-transform:uppercase;letter-spacing:.4px">📍 Order Tracking</div>
            <div class="tracker-steps" id="tracker-{{ $order->id }}">
              {{-- Progress line fill --}}
              <div class="tracker-line-fill" style="width:{{ $lineW }}%"></div>
              @foreach($trackerIcons as $idx => $icon)
              @php
                $isDone   = $stepNum > $idx;
                $isActive = $stepNum === $idx;
                $cls      = $isDone ? 'done' : ($isActive ? 'active' : '');
              @endphp
              <div class="tracker-step">
                <div class="ts-dot {{ $cls }}">{{ $isDone ? '✓' : $icon }}</div>
                <div class="ts-label {{ $cls }}" style="font-size:9.5px">{{ $trackerLabels[$idx] }}</div>
              </div>
              @endforeach
            </div>
          </div>
          @endif

          {{-- Footer --}}
          <div class="order-card-foot">
            <div>
              <div class="order-total">₹{{ number_format($order->total) }}</div>
              <div class="order-payment">
                💳 {{ strtoupper($order->payment_method) }}
                @if($order->delivery_charge == 0)
                  · <span style="color:var(--g);font-weight:700">FREE Delivery</span>
                @else
                  · Delivery ₹{{ $order->delivery_charge }}
                @endif
              </div>
            </div>
            <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap">
              @if($order->status === 'delivered')
                <button onclick="showToast('⭐ Review feature coming soon!')" style="padding:7px 14px;border-radius:7px;border:1.5px solid var(--border);background:var(--white);font-size:12.5px;font-weight:600;cursor:pointer;color:var(--text2);font-family:inherit">⭐ Rate Order</button>
                <button onclick="showToast('🔄 Reorder feature coming soon!')" style="padding:7px 14px;border-radius:7px;background:var(--g);color:#fff;border:none;font-size:12.5px;font-weight:700;cursor:pointer;font-family:inherit">🔄 Reorder</button>
              @elseif($order->status === 'pending')
                <a href="{{ route('order.show', $order->id) }}" style="padding:7px 14px;border-radius:7px;border:1.5px solid #fde68a;background:#fffbeb;font-size:12.5px;font-weight:600;cursor:pointer;color:#92400e;text-decoration:none">📞 Contact Us</a>
              @elseif(in_array($order->status, ['cancelled','refunded']))
                <span style="font-size:12px;color:var(--muted)">Need help? Call 9911011411</span>
              @else
                <a href="https://wa.me/919911011411?text=Order {{ $order->order_number }} status?" target="_blank" style="padding:7px 14px;border-radius:7px;border:1.5px solid #bbf7d0;background:var(--gl);font-size:12.5px;font-weight:600;color:var(--g2);text-decoration:none">💬 Track</a>
              @endif
              <div style="font-size:11px;color:var(--muted)">📍 {{ $order->delivery_city }}</div>
            </div>
          </div>

        </div>
        @empty
        <div class="dash-card">
          <div class="empty-state">
            <div class="empty-icon">🛒</div>
            <div class="empty-title">No orders yet!</div>
            <div class="empty-sub">You haven't placed any orders. Start shopping now!</div>
            <a href="{{ route('shop') }}" class="btn-shop">🛍️ Shop Now</a>
          </div>
        </div>
        @endforelse

      </div>

      {{-- ══════════════════════════════
           PANEL: PROFILE
      ══════════════════════════════ --}}
      <div class="acc-panel" id="panel-profile">

        <div class="sec-head">
          <div>
            <div class="sec-title">👤 Profile & Settings</div>
            <div class="sec-sub">Update your personal information</div>
          </div>
        </div>

        <div class="dash-card reveal">
          <div class="dash-card-head">
            <div class="dash-card-title">👤 Personal Information</div>
          </div>
          <div class="dash-card-body">
            <form action="{{ route('account.index') }}" method="POST" onsubmit="showToast('✅ Profile updated successfully!')">
              @csrf @method('PUT')
              <div class="form-row-2">
                <div class="form-group">
                  <label class="form-label">Full Name</label>
                  <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="Your full name">
                </div>
                <div class="form-group">
                  <label class="form-label">Phone Number</label>
                  <input type="tel" class="form-control" name="phone" value="{{ $user->phone ?? '' }}" placeholder="10-digit mobile" maxlength="10">
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="your@email.com">
              </div>
              <div style="display:flex;gap:10px;flex-wrap:wrap">
                <button type="submit" class="btn-save">💾 Save Changes</button>
                <button type="reset" class="btn-outline">Reset</button>
              </div>
            </form>
          </div>
        </div>

        <div class="dash-card reveal" style="transition-delay:.05s">
          <div class="dash-card-head">
            <div class="dash-card-title">🔒 Change Password</div>
          </div>
          <div class="dash-card-body">
            <form action="#" method="POST" onsubmit="event.preventDefault();showToast('✅ Password updated!')">
              @csrf
              <div class="form-group">
                <label class="form-label">Current Password</label>
                <input type="password" class="form-control" placeholder="Enter current password">
              </div>
              <div class="form-row-2">
                <div class="form-group">
                  <label class="form-label">New Password</label>
                  <input type="password" class="form-control" placeholder="Min 8 characters">
                </div>
                <div class="form-group">
                  <label class="form-label">Confirm New Password</label>
                  <input type="password" class="form-control" placeholder="Repeat new password">
                </div>
              </div>
              <button type="submit" class="btn-save">🔒 Update Password</button>
            </form>
          </div>
        </div>

        {{-- Account Info --}}
        <div class="dash-card reveal" style="transition-delay:.1s">
          <div class="dash-card-head">
            <div class="dash-card-title">ℹ️ Account Information</div>
          </div>
          <div class="dash-card-body">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px">
              <div style="background:var(--border2);border-radius:9px;padding:14px">
                <div style="font-size:11px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.4px;margin-bottom:5px">Member Since</div>
                <div style="font-size:14px;font-weight:700;color:var(--text)">{{ $user->created_at->format('d M Y') }}</div>
              </div>
              <div style="background:var(--border2);border-radius:9px;padding:14px">
                <div style="font-size:11px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.4px;margin-bottom:5px">Account Status</div>
                <div style="font-size:14px;font-weight:700;color:var(--g)">✅ Active & Verified</div>
              </div>
              <div style="background:var(--border2);border-radius:9px;padding:14px">
                <div style="font-size:11px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.4px;margin-bottom:5px">Total Orders</div>
                <div style="font-size:14px;font-weight:700;color:var(--text)">{{ $totalOrders }} orders placed</div>
              </div>
              <div style="background:var(--border2);border-radius:9px;padding:14px">
                <div style="font-size:11px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.4px;margin-bottom:5px">Total Saved</div>
                <div style="font-size:14px;font-weight:700;color:var(--g)">FREE delivery on ₹2000+</div>
              </div>
            </div>
          </div>
        </div>

      </div>

      {{-- ══════════════════════════════
           PANEL: ADDRESSES
      ══════════════════════════════ --}}
      <div class="acc-panel" id="panel-addresses">

        <div class="sec-head">
          <div>
            <div class="sec-title">📍 Saved Addresses</div>
            <div class="sec-sub">Manage your delivery addresses</div>
          </div>
        </div>

        <div class="dash-card reveal">
          <div class="dash-card-head">
            <div class="dash-card-title">📍 Your Addresses</div>
          </div>
          <div class="dash-card-body">
            <div class="addr-grid">
              @php $addresses = $user->addresses ?? collect(); @endphp
              @forelse($addresses as $addr)
              <div class="addr-card {{ $addr->is_default ? 'default' : '' }}">
                @if($addr->is_default)<div class="addr-default-badge">Default</div>@endif
                <div class="addr-label">
                  {{ ['Home'=>'🏠','Work'=>'💼','Other'=>'📍'][$addr->label] ?? '📍' }} {{ $addr->label ?? 'Address' }}
                </div>
                <div class="addr-text">
                  {{ $addr->address }}<br>
                  {{ $addr->city }}, {{ $addr->state }} — {{ $addr->pincode }}
                </div>
                <div class="addr-actions">
                  @if(!$addr->is_default)
                    <button class="addr-btn" onclick="showToast('✅ Default address updated!')">Set Default</button>
                  @endif
                  <button class="addr-btn" onclick="showToast('✏️ Edit feature coming soon!')">Edit</button>
                  <button class="addr-btn danger" onclick="showToast('🗑️ Address removed!')">Remove</button>
                </div>
              </div>
              @empty
              <div class="addr-card" style="text-align:center;padding:24px;color:var(--muted)">
                <div style="font-size:32px;margin-bottom:8px">📍</div>
                <div style="font-size:13.5px;font-weight:600;margin-bottom:4px">No addresses saved</div>
                <div style="font-size:12px">Add your first delivery address</div>
              </div>
              @endforelse
              <div class="add-addr-card" onclick="showToast('➕ Add address feature coming soon!')">
                <div style="font-size:28px">➕</div>
                <div style="font-size:13.5px;font-weight:600;color:var(--g)">Add New Address</div>
              </div>
            </div>
          </div>
        </div>

        {{-- Delivery Zone Info --}}
        <div class="dash-card reveal" style="transition-delay:.05s">
          <div class="dash-card-head">
            <div class="dash-card-title">🗺️ Our Delivery Zone</div>
          </div>
          <div class="dash-card-body">
            <div style="background:var(--gl);border:1px solid #b7e4c7;border-radius:10px;padding:16px;margin-bottom:14px;display:flex;align-items:flex-start;gap:12px">
              <div style="font-size:28px">📍</div>
              <div>
                <div style="font-size:14px;font-weight:700;color:var(--g2);margin-bottom:4px">Store Location</div>
                <div style="font-size:13px;color:var(--text2)">All You Want Grocery, Mayur Vihar Phase-1, Delhi<br>Near Mitra Di Chap & Sameer Restaurant</div>
              </div>
            </div>
            <div style="font-size:13px;font-weight:700;color:var(--text2);margin-bottom:10px">✅ We deliver to:</div>
            <div style="display:flex;flex-wrap:wrap;gap:7px">
              @foreach(['Mayur Vihar Ph-1','Mayur Vihar Ph-2','Mayur Vihar Ph-3','Preet Vihar','Kondli','Patparganj','Shahdara','Laxmi Nagar','Anand Vihar','Mandawali','Geeta Colony','Gandhi Nagar','Noida Sec-1','Noida Sec-14'] as $area)
              <span style="background:var(--gl2);color:var(--g2);font-size:11.5px;font-weight:600;padding:4px 12px;border-radius:20px;border:1px solid #b7e4c7">{{ $area }}</span>
              @endforeach
            </div>
          </div>
        </div>

      </div>

      {{-- ══════════════════════════════
           PANEL: WISHLIST
      ══════════════════════════════ --}}
      <div class="acc-panel" id="panel-wishlist">
        <div class="sec-head">
          <div>
            <div class="sec-title">❤️ Wishlist</div>
            <div class="sec-sub">Products you've saved for later</div>
          </div>
        </div>
        <div class="dash-card reveal">
          <div class="empty-state">
            <div class="empty-icon">❤️</div>
            <div class="empty-title">Your wishlist is empty</div>
            <div class="empty-sub">Browse products and tap ❤️ to save them here</div>
            <a href="{{ route('shop') }}" class="btn-shop">🛍️ Explore Products</a>
          </div>
        </div>
      </div>

    </div>{{-- /acc-main --}}
  </div>{{-- /acc-grid --}}
</div>{{-- /acc-wrap --}}
</div>{{-- /acc-page --}}

{{-- TOAST --}}
<div class="toast-wrap" id="toastWrap"></div>

@endsection

@push('scripts')
<script>
// ── PANEL SWITCHING ──────────────────────────
function showPanel(name, btn) {
  // Hide all panels
  document.querySelectorAll('.acc-panel').forEach(p => p.classList.remove('active'));
  // Remove active from all nav items
  document.querySelectorAll('.acc-nav-item').forEach(b => b.classList.remove('active'));

  // Show target panel
  const panel = document.getElementById('panel-' + name);
  if (panel) {
    panel.classList.add('active');
    // Trigger reveals
    setTimeout(() => {
      panel.querySelectorAll('.reveal').forEach(el => el.classList.add('visible'));
    }, 50);
  }

  // Mark nav item active
  if (btn) btn.classList.add('active');
}

// ── ORDER STATUS FILTER ──────────────────────
function filterOrders(status) {
  // Update tab styles
  document.querySelectorAll('[id^="otab-"]').forEach(btn => {
    btn.style.background = 'var(--white)';
    btn.style.borderColor = 'var(--border)';
    btn.style.color = 'var(--text2)';
  });
  const activeTab = document.getElementById('otab-' + status);
  if (activeTab) {
    activeTab.style.background = 'var(--g)';
    activeTab.style.borderColor = 'var(--g)';
    activeTab.style.color = '#fff';
  }

  // Show/hide order cards
  document.querySelectorAll('.order-card').forEach(card => {
    if (status === 'all' || card.dataset.status === status) {
      card.style.display = '';
    } else {
      card.style.display = 'none';
    }
  });

  // Show empty msg if nothing visible
  const visible = [...document.querySelectorAll('.order-card')].filter(c => c.style.display !== 'none');
  const emptyEl = document.getElementById('orders-empty-msg');
  if (emptyEl) emptyEl.style.display = visible.length === 0 ? 'block' : 'none';
}

// ── TOAST ────────────────────────────────────
function showToast(msg, type = 'success') {
  const w = document.getElementById('toastWrap');
  if (!w) return;
  const t = document.createElement('div');
  t.className = 'toast';
  t.textContent = msg;
  w.appendChild(t);
  setTimeout(() => {
    t.style.opacity = '0';
    t.style.transform = 'translateY(10px)';
    t.style.transition = 'all .3s';
    setTimeout(() => t.remove(), 300);
  }, 2800);
}

// ── SCROLL REVEAL ────────────────────────────
const revealIO = new IntersectionObserver(entries => {
  entries.forEach((e, i) => {
    if (e.isIntersecting) {
      setTimeout(() => e.target.classList.add('visible'), i * 60);
      revealIO.unobserve(e.target);
    }
  });
}, { threshold: 0.05 });

document.querySelectorAll('.reveal').forEach(el => revealIO.observe(el));

// ── INIT: Active tab styling ─────────────────
document.addEventListener('DOMContentLoaded', () => {
  filterOrders('all'); // Set "All" tab as active on load
});
</script>
@endpush