@extends('frontend.layouts.app')

@section('title', 'Checkout')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
<style>
  :root {
    --green:       #0d6e39;
    --green-dark:  #095c2f;
    --green-light: #e6f4ec;
    --green-mid:   #1a8a4a;
    --white:       #ffffff;
    --bg:          #f4f6f8;
    --border:      #e4e9f0;
    --text-main:   #1a202c;
    --text-muted:  #64748b;
    --text-light:  #94a3b8;
    --danger:      #ef4444;
    --danger-light:#fef2f2;
    --blue:        #3b82f6;
    --blue-light:  #eff6ff;
    --shadow-sm:   0 1px 4px rgba(0,0,0,0.07);
    --shadow-md:   0 4px 16px rgba(0,0,0,0.10);
    --shadow-lg:   0 8px 32px rgba(0,0,0,0.13);
    --radius:      14px;
  }

  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  body {
    font-family: 'Nunito', sans-serif;
    background: var(--bg);
    color: var(--text-main);
    min-height: 100vh;
  }

  /* ── BREADCRUMB ── */
  .co-breadcrumb {
    background: var(--white);
    border-bottom: 1px solid var(--border);
    padding: 11px 0;
  }
  .breadcrumb-inner {
    max-width: 1100px;
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    color: var(--text-muted);
  }
  .breadcrumb-inner a { color: var(--green); text-decoration: none; font-weight: 600; }
  .breadcrumb-inner .sep { color: var(--text-light); }

  /* ── STEPS BAR ── */
  .steps-bar {
    background: var(--white);
    border-bottom: 1px solid var(--border);
    padding: 14px 0;
  }
  .steps-inner {
    max-width: 560px;
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .step {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
    flex: 1;
  }
  .step-circle {
    width: 32px; height: 32px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; font-weight: 800;
    background: var(--green-light);
    color: var(--green);
    border: 2px solid var(--green);
    transition: all .3s;
  }
  .step.done .step-circle  { background: var(--green); color: #fff; }
  .step.active .step-circle { background: var(--green); color: #fff; box-shadow: 0 0 0 4px rgba(13,110,57,.18); }
  .step-label { font-size: 11px; font-weight: 700; color: var(--text-muted); white-space: nowrap; }
  .step.done .step-label, .step.active .step-label { color: var(--green); }
  .step-line { flex: 1; height: 2px; background: var(--border); margin-bottom: 18px; max-width: 60px; }
  .step-line.done { background: var(--green); }

  /* ── LAYOUT ── */
  .co-wrapper {
    max-width: 1100px;
    margin: 28px auto;
    padding: 0 20px;
  }
  .co-grid {
    display: grid;
    grid-template-columns: 1fr 340px;
    gap: 22px;
    align-items: start;
  }

  /* ── CARD ── */
  .card {
    background: var(--white);
    border-radius: var(--radius);
    border: 1px solid var(--border);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
    margin-bottom: 20px;
  }
  .card:last-child { margin-bottom: 0; }
  .card-header {
    padding: 16px 22px;
    border-bottom: 1px solid var(--border);
    background: linear-gradient(135deg, #f8fdf9 0%, #fff 100%);
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .card-header-title {
    font-size: 15px;
    font-weight: 800;
    color: var(--text-main);
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .card-header-title .step-num {
    width: 26px; height: 26px;
    background: var(--green);
    color: #fff;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 800;
  }
  .card-body { padding: 20px 22px; }

  /* ── SAVED ADDRESS ── */
  .saved-addresses {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    margin-bottom: 18px;
  }
  .addr-card {
    border: 1.5px solid var(--border);
    border-radius: 10px;
    padding: 12px 14px;
    cursor: pointer;
    transition: all .2s;
    position: relative;
  }
  .addr-card:hover { border-color: var(--green); background: var(--green-light); }
  .addr-card.selected { border-color: var(--green); background: var(--green-light); }
  .addr-card.selected::after {
    content: '✓';
    position: absolute;
    top: 8px; right: 10px;
    background: var(--green);
    color: #fff;
    width: 18px; height: 18px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 10px; font-weight: 800;
  }
  .addr-name { font-size: 13px; font-weight: 700; margin-bottom: 3px; }
  .addr-detail { font-size: 11px; color: var(--text-muted); line-height: 1.5; }

  .divider-text {
    text-align: center;
    font-size: 12px;
    color: var(--text-muted);
    font-weight: 600;
    margin: 16px 0;
    position: relative;
  }
  .divider-text::before, .divider-text::after {
    content: '';
    position: absolute;
    top: 50%;
    width: 42%;
    height: 1px;
    background: var(--border);
  }
  .divider-text::before { left: 0; }
  .divider-text::after { right: 0; }

  /* ── FORM ── */
  .form-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
  .form-row-3 { display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 14px; }
  .form-group { margin-bottom: 14px; }
  .form-group:last-child { margin-bottom: 0; }
  .form-label {
    display: block;
    font-size: 12px;
    font-weight: 700;
    color: var(--text-muted);
    margin-bottom: 6px;
    text-transform: uppercase;
    letter-spacing: 0.4px;
  }
  .form-label .req { color: var(--danger); }
  .form-control {
    width: 100%;
    padding: 11px 14px;
    border: 1.5px solid var(--border);
    border-radius: 9px;
    font-size: 14px;
    font-family: 'Nunito', sans-serif;
    font-weight: 600;
    color: var(--text-main);
    outline: none;
    transition: border .2s, box-shadow .2s;
    background: #fff;
  }
  .form-control:focus {
    border-color: var(--green);
    box-shadow: 0 0 0 3px rgba(13,110,57,.10);
  }
  .form-control.error { border-color: var(--danger); }
  .form-control::placeholder { color: var(--text-light); font-weight: 500; }
  select.form-control { cursor: pointer; }
  .field-hint { font-size: 11px; color: var(--text-light); margin-top: 4px; font-weight: 500; }
  .field-error { font-size: 11px; color: var(--danger); margin-top: 4px; font-weight: 600; display: none; }

  /* ── PAYMENT OPTIONS ── */
  .payment-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
  .pay-opt {
    border: 1.5px solid var(--border);
    border-radius: 11px;
    padding: 14px 16px;
    cursor: pointer;
    transition: all .2s;
    position: relative;
    display: flex;
    align-items: flex-start;
    gap: 12px;
  }
  .pay-opt:hover { border-color: var(--green); background: #fafcfb; }
  .pay-opt.selected { border-color: var(--green); background: var(--green-light); }
  .pay-opt input[type=radio] { display: none; }
  .pay-radio {
    width: 18px; height: 18px;
    border: 2px solid var(--border);
    border-radius: 50%;
    flex-shrink: 0;
    margin-top: 2px;
    transition: all .2s;
    display: flex; align-items: center; justify-content: center;
  }
  .pay-opt.selected .pay-radio {
    border-color: var(--green);
    background: var(--green);
  }
  .pay-opt.selected .pay-radio::after {
    content: '';
    width: 6px; height: 6px;
    background: #fff;
    border-radius: 50%;
  }
  .pay-icon { font-size: 24px; flex-shrink: 0; }
  .pay-info { flex: 1; }
  .pay-title { font-size: 13px; font-weight: 800; color: var(--text-main); margin-bottom: 3px; }
  .pay-desc { font-size: 11px; color: var(--text-muted); line-height: 1.4; font-weight: 500; }
  .pay-badge {
    position: absolute;
    top: -8px; right: 10px;
    background: var(--green);
    color: #fff;
    font-size: 9px; font-weight: 800;
    padding: 2px 7px;
    border-radius: 10px;
    letter-spacing: 0.3px;
  }

  /* UPI icons row */
  .upi-row {
    display: flex;
    gap: 6px;
    margin-top: 8px;
    flex-wrap: wrap;
  }
  .upi-chip {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 5px;
    padding: 3px 8px;
    font-size: 10px;
    font-weight: 700;
    color: var(--text-muted);
  }

  /* ── ORDER ITEMS ── */
  .order-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 0;
    border-bottom: 1px solid var(--border);
  }
  .order-item:last-child { border-bottom: none; }
  .order-item-img {
    width: 50px; height: 50px;
    border-radius: 8px;
    border: 1px solid var(--border);
    background: #f8fafc;
    overflow: hidden;
    flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
  }
  .order-item-img img { width: 100%; height: 100%; object-fit: cover; }
  .order-item-name { font-size: 13px; font-weight: 700; flex: 1; line-height: 1.3; }
  .order-item-qty { font-size: 11px; color: var(--text-muted); margin-top: 2px; font-weight: 500; }
  .order-item-price { font-size: 14px; font-weight: 800; color: var(--text-main); text-align: right; }

  /* ── SUMMARY ── */
  .summary-card { position: sticky; top: 90px; }
  .summary-body { padding: 18px 20px; }
  .sum-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 13px;
    padding: 8px 0;
    border-bottom: 1px solid var(--border);
  }
  .sum-row:last-of-type { border-bottom: none; }
  .sum-row .lbl { color: var(--text-muted); font-weight: 500; }
  .sum-row .val { font-weight: 700; }
  .sum-row .val.green { color: var(--green); }
  .sum-divider { height: 1px; background: var(--border); margin: 4px 0; }
  .sum-total-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px 0 10px;
    font-size: 18px;
    font-weight: 900;
  }
  .sum-total-row .total-amt { color: var(--green); font-family: 'Poppins', sans-serif; }

  .savings-pill {
    background: linear-gradient(135deg, var(--green-light), #f0fdf4);
    border: 1px solid #c6e9d5;
    border-radius: 8px;
    padding: 9px 14px;
    font-size: 12px;
    font-weight: 700;
    color: var(--green-dark);
    text-align: center;
    margin-bottom: 16px;
    display: flex; align-items: center; justify-content: center; gap: 6px;
  }

  /* ── PLACE ORDER BTN ── */
  .btn-place-order {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    background: linear-gradient(135deg, var(--green), var(--green-dark));
    color: #fff;
    border: none;
    padding: 16px 20px;
    border-radius: 11px;
    font-size: 16px;
    font-weight: 900;
    cursor: pointer;
    font-family: 'Nunito', sans-serif;
    box-shadow: 0 4px 16px rgba(13,110,57,.30);
    transition: all .25s;
    letter-spacing: 0.3px;
  }
  .btn-place-order:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 22px rgba(13,110,57,.38);
    background: linear-gradient(135deg, var(--green-mid), var(--green));
  }
  .btn-place-order:active { transform: translateY(0); }
  .btn-place-order.loading { opacity: .7; cursor: not-allowed; pointer-events: none; }
  .btn-place-order .spinner {
    width: 18px; height: 18px;
    border: 2px solid rgba(255,255,255,.3);
    border-top-color: #fff;
    border-radius: 50%;
    animation: spin .7s linear infinite;
    display: none;
  }
  .btn-place-order.loading .spinner { display: block; }
  .btn-place-order.loading .btn-text { display: none; }
  @keyframes spin { to { transform: rotate(360deg); } }

  /* ── SECURITY ── */
  .security-strip {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 16px;
    margin-top: 14px;
    padding-top: 14px;
    border-top: 1px solid var(--border);
    flex-wrap: wrap;
  }
  .sec-item {
    display: flex; align-items: center; gap: 4px;
    font-size: 11px; color: var(--text-muted); font-weight: 600;
  }

  /* ── DELIVERY ESTIMATE ── */
  .delivery-estimate {
    background: linear-gradient(135deg, var(--green-light), #f0fdf4);
    border: 1px solid #c6e9d5;
    border-radius: 10px;
    padding: 12px 16px;
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 16px;
  }
  .de-icon { font-size: 28px; }
  .de-label { font-size: 11px; color: var(--green-dark); font-weight: 600; }
  .de-date { font-size: 14px; font-weight: 800; color: var(--green-dark); }

  /* ── COUPON MINI ── */
  .coupon-mini {
    border: 1.5px dashed var(--green);
    border-radius: 9px;
    padding: 12px 14px;
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 14px;
    cursor: pointer;
    transition: background .2s;
  }
  .coupon-mini:hover { background: var(--green-light); }
  .coupon-mini .cm-icon { font-size: 20px; }
  .coupon-mini .cm-text { flex: 1; font-size: 13px; font-weight: 700; color: var(--green); }
  .coupon-mini .cm-arrow { font-size: 16px; color: var(--green); }

  /* ── TOAST ── */
  .toast-container {
    position: fixed; bottom: 24px; right: 24px;
    z-index: 9999;
    display: flex; flex-direction: column; gap: 10px;
  }
  .toast {
    background: #1a202c; color: #fff;
    padding: 12px 16px; border-radius: 10px;
    font-size: 13px; font-weight: 600;
    display: flex; align-items: center; gap: 10px;
    box-shadow: var(--shadow-lg);
    animation: slideIn .3s ease;
    max-width: 280px;
  }
  .toast.success { border-left: 4px solid var(--green); }
  .toast.error   { border-left: 4px solid var(--danger); }
  @keyframes slideIn { from { transform: translateX(110%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
  @keyframes slideOut { to { transform: translateX(120%); opacity: 0; } }

  /* ── PAGE TITLE ── */
  .page-title {
    font-family: 'Poppins', sans-serif;
    font-size: 22px;
    font-weight: 800;
    color: var(--text-main);
    margin-bottom: 22px;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  /* ── ALERT ── */
  .alert-success {
    background: linear-gradient(135deg,#dcfce7,#f0fdf4);
    border: 1px solid #bbf7d0;
    color: #15803d;
    padding: 12px 16px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 20px;
    display: flex; align-items: center; gap: 8px;
  }
  .alert-error {
    background: var(--danger-light);
    border: 1px solid #fecaca;
    color: var(--danger);
    padding: 12px 16px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 20px;
  }

  /* ── RESPONSIVE ── */
  @media (max-width: 1000px) {
    .co-grid { grid-template-columns: 1fr 300px; }
  }
  @media (max-width: 820px) {
    .co-grid { grid-template-columns: 1fr; }
    .summary-card { position: static; }
    .payment-grid { grid-template-columns: 1fr 1fr; }
  }
  @media (max-width: 600px) {
    .co-wrapper { margin: 16px auto; padding: 0 12px; }
    .page-title { font-size: 18px; }
    .card-body { padding: 16px 14px; }
    .card-header { padding: 13px 14px; }
    .form-row-2 { grid-template-columns: 1fr; gap: 0; }
    .form-row-3 { grid-template-columns: 1fr 1fr; gap: 10px; }
    .payment-grid { grid-template-columns: 1fr; }
    .saved-addresses { grid-template-columns: 1fr; }
    .steps-inner { max-width: 100%; }
    .toast-container { right: 12px; bottom: 80px; }
  }
  @media (max-width: 400px) {
    .form-row-3 { grid-template-columns: 1fr; }
  }

  /* ── MOBILE STICKY BTN ── */
  .mobile-order-bar {
    display: none;
    position: fixed;
    bottom: 0; left: 0; right: 0;
    background: var(--white);
    border-top: 1px solid var(--border);
    padding: 12px 16px;
    z-index: 100;
    box-shadow: 0 -4px 20px rgba(0,0,0,.10);
    align-items: center;
    gap: 12px;
  }
  .mobile-order-bar .mob-total { flex: 1; }
  .mobile-order-bar .mob-lbl { font-size: 11px; color: var(--text-muted); font-weight: 600; }
  .mobile-order-bar .mob-amt { font-size: 18px; font-weight: 900; color: var(--text-main); }
  @media (max-width: 820px) {
    .mobile-order-bar { display: flex; }
    .co-wrapper { padding-bottom: 90px; }
  }

  /* Input animations */
  .form-control:focus + .field-hint { color: var(--green); }

  /* Pincode auto-fill indicator */
  .pincode-status {
    font-size: 11px;
    font-weight: 600;
    margin-top: 4px;
    display: none;
  }
  .pincode-status.loading { color: var(--text-muted); display: block; }
  .pincode-status.success { color: var(--green); display: block; }
  .pincode-status.error   { color: var(--danger); display: block; }

</style>
@endpush

@section('content')

{{-- BREADCRUMB --}}
<div class="co-breadcrumb">
  <div class="breadcrumb-inner">
    <a href="{{ route('home') }}">🏠 Home</a>
    <span class="sep">›</span>
    <a href="{{ route('cart.index') }}">Cart</a>
    <span class="sep">›</span>
    <span>Checkout</span>
  </div>
</div>

{{-- STEPS --}}
<div class="steps-bar">
  <div class="steps-inner">
    <div class="step done">
      <div class="step-circle">✓</div>
      <div class="step-label">Cart</div>
    </div>
    <div class="step-line done"></div>
    <div class="step active">
      <div class="step-circle">2</div>
      <div class="step-label">Checkout</div>
    </div>
    <div class="step-line"></div>
    <div class="step">
      <div class="step-circle">💳</div>
      <div class="step-label">Payment</div>
    </div>
    <div class="step-line"></div>
    <div class="step">
      <div class="step-circle">✅</div>
      <div class="step-label">Done</div>
    </div>
  </div>
</div>

{{-- MAIN --}}
<div class="co-wrapper">

  @if(session('success'))
    <div class="alert-success">✅ {{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="alert-error">❌ {{ session('error') }}</div>
  @endif
  @if($errors->any())
    <div class="alert-error">
      ❌ Please fix the errors below:
      <ul style="margin-top:6px;padding-left:18px;font-size:12px">
        @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
      </ul>
    </div>
  @endif

  <div class="page-title">🛒 Checkout</div>

  <form action="{{ route('checkout.place') }}" method="POST" id="checkoutForm" novalidate>
    @csrf

  <div class="co-grid">

    {{-- ── LEFT COLUMN ── --}}
    <div>

      {{-- 1. DELIVERY ADDRESS --}}
      <div class="card">
        <div class="card-header">
          <div class="card-header-title">
            <span class="step-num">1</span>
            📍 Delivery Address
          </div>
        </div>


        {{-- 📍 LOCATION DETECTOR --}}
<div id="locationBox" style="background:var(--green-light);border:1px solid #c6e9d5;border-radius:10px;padding:14px 16px;margin-bottom:18px;display:flex;align-items:center;gap:12px;flex-wrap:wrap">
  <div style="font-size:24px">📍</div>
  <div style="flex:1;min-width:200px">
    <div style="font-size:13px;font-weight:800;color:var(--green-dark)" id="locStatusTitle">Check delivery to your location</div>
    <div style="font-size:11px;color:var(--text-muted);font-weight:600" id="locStatusSub">We deliver within 10km of Mayur Vihar Phase-1, Delhi</div>
  </div>
  <button type="button" onclick="detectLocation()" id="locBtn" style="background:var(--green);color:#fff;border:none;padding:9px 16px;border-radius:8px;font-size:12px;font-weight:800;cursor:pointer;font-family:'Nunito',sans-serif;white-space:nowrap">
    📡 Use My Location
  </button>
</div>
{{-- Hidden fields to send km/area with order --}}
<input type="hidden" name="delivery_km" id="delivery_km_input" value="{{ session('delivery_km', 0) }}">
<input type="hidden" name="delivery_area" id="delivery_area_input" value="">

        <div class="card-body">

          {{-- Saved Addresses --}}
          @if(isset($addresses) && $addresses && count($addresses) > 0)
          <div style="margin-bottom:6px">
            <div style="font-size:12px;font-weight:700;color:var(--text-muted);margin-bottom:10px;text-transform:uppercase;letter-spacing:.4px">Saved Addresses</div>
            <div class="saved-addresses">
              @foreach($addresses->take(4) as $addr)
              <div class="addr-card {{ $loop->first ? 'selected' : '' }}" onclick="selectAddress(this, '{{ addslashes($addr->address) }}', '{{ addslashes($addr->city) }}', '{{ addslashes($addr->state) }}', '{{ $addr->pincode }}')">
                <div class="addr-name">{{ $addr->label ?? 'Address ' . $loop->iteration }}</div>
                <div class="addr-detail">{{ Str::limit($addr->address, 60) }}<br>{{ $addr->city }}, {{ $addr->state }} - {{ $addr->pincode }}</div>
              </div>
              @endforeach
            </div>
            <div class="divider-text">or enter a new address</div>
          </div>
          @endif

          {{-- Full Name + Phone --}}
          <div class="form-row-2">
            <div class="form-group">
              <label class="form-label">Full Name <span class="req">*</span></label>
              <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'error' : '' }}"
                     value="{{ old('name', auth()->user()->name) }}" placeholder="Your full name" required>
              @error('name')<div class="field-error" style="display:block">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
              <label class="form-label">Phone Number <span class="req">*</span></label>
              <input type="tel" name="phone" id="phone" class="form-control {{ $errors->has('phone') ? 'error' : '' }}"
                     value="{{ old('phone', auth()->user()->phone ?? '') }}" placeholder="10-digit mobile" required maxlength="10">
              @error('phone')<div class="field-error" style="display:block">{{ $message }}</div>@enderror
            </div>
          </div>

          {{-- Address --}}
          <div class="form-group">
            <label class="form-label">Street Address <span class="req">*</span></label>
            <input type="text" name="address" id="address" class="form-control {{ $errors->has('address') ? 'error' : '' }}"
                   value="{{ old('address') }}" placeholder="House no., Street name, Area, Landmark" required>
            <div class="field-hint">Include flat/house no. and landmark for faster delivery</div>
            @error('address')<div class="field-error" style="display:block">{{ $message }}</div>@enderror
          </div>

          {{-- City + State + Pincode --}}
          <div class="form-row-3">
            <div class="form-group">
              <label class="form-label">City <span class="req">*</span></label>
              <input type="text" name="city" id="city" class="form-control {{ $errors->has('city') ? 'error' : '' }}"
                     value="{{ old('city') }}" placeholder="Your city" required>
              @error('city')<div class="field-error" style="display:block">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
              <label class="form-label">State <span class="req">*</span></label>
              <select name="state" id="state" class="form-control {{ $errors->has('state') ? 'error' : '' }}" required>
                <option value="">Select</option>
                @foreach(['Andhra Pradesh','Arunachal Pradesh','Assam','Bihar','Chhattisgarh','Delhi','Goa','Gujarat','Haryana','Himachal Pradesh','Jammu & Kashmir','Jharkhand','Karnataka','Kerala','Madhya Pradesh','Maharashtra','Manipur','Meghalaya','Mizoram','Nagaland','Odisha','Punjab','Rajasthan','Sikkim','Tamil Nadu','Telangana','Tripura','Uttar Pradesh','Uttarakhand','West Bengal'] as $st)
                  <option value="{{ $st }}" {{ old('state') == $st ? 'selected' : '' }}>{{ $st }}</option>
                @endforeach
              </select>
              @error('state')<div class="field-error" style="display:block">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
              <label class="form-label">Pincode <span class="req">*</span></label>
              <input type="text" name="pincode" id="pincode" class="form-control {{ $errors->has('pincode') ? 'error' : '' }}"
                     value="{{ old('pincode') }}" placeholder="6-digit" required maxlength="6" oninput="checkPincode(this.value)">
              <div class="pincode-status" id="pincodeStatus"></div>
              @error('pincode')<div class="field-error" style="display:block">{{ $message }}</div>@enderror
            </div>
          </div>

          {{-- Order Notes --}}
          <div class="form-group" style="margin-top:4px">
            <label class="form-label">Delivery Instructions <span style="font-weight:500;text-transform:none;letter-spacing:0">(optional)</span></label>
            <textarea name="notes" class="form-control" rows="2" placeholder="e.g. Leave at door, Call before delivery, etc." style="resize:vertical">{{ old('notes') }}</textarea>
          </div>

        </div>
      </div>

      {{-- 2. PAYMENT METHOD --}}
      <div class="card">
        <div class="card-header">
          <div class="card-header-title">
            <span class="step-num">2</span>
            💳 Payment Method
          </div>
        </div>
        <div class="card-body">
          <div class="payment-grid">

            {{-- COD --}}
            <label class="pay-opt selected" id="pay-cod" onclick="selectPayment('cod')">
              <input type="radio" name="payment" value="cod" checked>
              <div class="pay-radio"></div>
              <div class="pay-icon">🏠</div>
              <div class="pay-info">
                <div class="pay-title">Cash on Delivery</div>
                <div class="pay-desc">Pay cash when your order arrives at door</div>
              </div>
            </label>

            {{-- Online --}}
            <label class="pay-opt" id="pay-online" onclick="selectPayment('online')">
              <input type="radio" name="payment" value="online">
              <span class="pay-badge">INSTANT</span>
              <div class="pay-radio"></div>
              <div class="pay-icon">📱</div>
              <div class="pay-info">
                <div class="pay-title">Online Payment</div>
                <div class="pay-desc">UPI, Cards, Net Banking</div>
                <div class="upi-row">
                  <span class="upi-chip">GPay</span>
                  <span class="upi-chip">PhonePe</span>
                  <span class="upi-chip">Paytm</span>
                  <span class="upi-chip">Card</span>
                </div>
              </div>
            </label>

          </div>

          {{-- COD info --}}
          <div id="codInfo" style="margin-top:14px;padding:12px 14px;background:#fffbeb;border:1px solid #fde68a;border-radius:9px;font-size:12px;color:#92400e;font-weight:600;display:flex;align-items:center;gap:8px;">
            <span style="font-size:16px">ℹ️</span>
            Keep exact change ready. Our delivery partner will collect payment at your door.
          </div>
          <div id="onlineInfo" style="margin-top:14px;padding:12px 14px;background:var(--blue-light);border:1px solid #bfdbfe;border-radius:9px;font-size:12px;color:#1d4ed8;font-weight:600;display:flex;align-items:center;gap:8px;display:none;">
            <span style="font-size:16px">🔒</span>
            You'll be redirected to secure payment gateway after placing order.
          </div>

        </div>
      </div>

    </div>{{-- /left --}}

    {{-- ── RIGHT COLUMN ── --}}
    <div>
      <div class="card summary-card">
        <div class="card-header">
          <div class="card-header-title">🧾 Order Summary</div>
          <a href="{{ route('cart.index') }}" style="font-size:12px;color:var(--green);font-weight:700;text-decoration:none;">✏️ Edit</a>
        </div>
        <div class="summary-body">

          {{-- Items --}}
          @foreach($products as $item)
          @php
            $p = $item['product'];
            $imgField = $p->thumbnail ?? $p->image ?? null;
            $imgUrl = $imgField ? asset('storage/' . $imgField) : null;
          @endphp
          <div class="order-item">
            <div class="order-item-img">
              @if($imgUrl)
                <img src="{{ $imgUrl }}" alt="{{ $p->name }}" onerror="this.style.display='none'">
              @else
                <span style="font-size:22px">🛒</span>
              @endif
            </div>
            <div style="flex:1;min-width:0">
              <div class="order-item-name">{{ Str::limit($p->name, 32) }}</div>
              <div class="order-item-qty">Qty: {{ $item['qty'] }} × ₹{{ number_format($p->current_price) }}</div>
            </div>
            <div class="order-item-price">₹{{ number_format($p->current_price * $item['qty']) }}</div>
          </div>
          @endforeach

          {{-- Delivery estimate --}}
          @php
            $deliveryDate = now()->addDays(1)->format('D, d M');
            $deliveryDateFast = now()->addHours(6)->format('h:i A');
          @endphp
          <div class="delivery-estimate" style="margin-top:14px">
            <span class="de-icon">🚚</span>
            <div>
              <div class="de-label">Estimated Delivery</div>
              <div class="de-date">By {{ $deliveryDate }}</div>
            </div>
          </div>

          {{-- Coupon --}}
          <div class="coupon-mini" onclick="document.getElementById('couponModal').style.display='flex'">
            <span class="cm-icon">🎟</span>
            <span class="cm-text" id="couponLabel">Apply Coupon / Promo Code</span>
            <span class="cm-arrow">›</span>
          </div>

          {{-- Summary rows --}}
          @php
            $totalSaved = 0;
            foreach($products as $item) {
              $op = $item['product']->original_price ?? ($item['product']->current_price * 1.2);
              $totalSaved += ($op - $item['product']->current_price) * $item['qty'];
            }
          @endphp

          <div class="sum-row">
            <span class="lbl">Subtotal ({{ count($products) }} items)</span>
            <span class="val">₹{{ number_format($subtotal) }}</span>
          </div>
          @if($totalSaved > 0)
          <div class="sum-row">
            <span class="lbl">Product Discount</span>
            <span class="val green">− ₹{{ number_format($totalSaved) }}</span>
          </div>
          @endif
          <div class="sum-row">
            <span class="lbl">Delivery Charges</span>
            @if($delivery == 0)
              <span class="val green">FREE 🎉</span>
            @else
              <span class="val">₹{{ $delivery }}</span>
            @endif
          </div>
          <div class="sum-row" id="couponDiscRow" style="display:none">
            <span class="lbl">Coupon Discount</span>
            <span class="val green" id="couponDiscVal">−₹0</span>
          </div>
          <div class="sum-divider"></div>
          <div class="sum-total-row">
            <span>Total</span>
            <span class="total-amt">₹{{ number_format($total) }}</span>
          </div>

          @if($totalSaved > 0 || $delivery == 0)
          <div class="savings-pill">
            🎉 You save <strong>₹{{ number_format($totalSaved + ($delivery == 0 ? 40 : 0)) }}</strong> on this order!
          </div>
          @endif

          {{-- Place Order --}}
          <button type="submit" class="btn-place-order" id="placeOrderBtn">
            <span class="btn-text">✅ Place Order • ₹{{ number_format($total) }}</span>
            <div class="spinner"></div>
          </button>

          {{-- Security --}}
          <div class="security-strip">
            <div class="sec-item">🔒 SSL Secure</div>
            <div class="sec-item">↩️ Easy Returns</div>
            <div class="sec-item">✅ 100% Genuine</div>
          </div>

        </div>
      </div>
    </div>

  </div>{{-- /co-grid --}}
  </form>

</div>{{-- /co-wrapper --}}

{{-- ── MOBILE STICKY BAR ── --}}
<div class="mobile-order-bar">
  <div class="mob-total">
    <div class="mob-lbl">Total Amount</div>
    <div class="mob-amt">₹{{ number_format($total) }}</div>
  </div>
  <button type="submit" form="checkoutForm" class="btn-place-order" style="width:auto;padding:13px 22px;font-size:14px">
    Place Order →
  </button>
</div>

{{-- ── COUPON MODAL ── --}}
<div id="couponModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:1000;align-items:flex-end;justify-content:center" onclick="if(event.target===this)this.style.display='none'">
  <div style="background:#fff;border-radius:20px 20px 0 0;padding:24px;width:100%;max-width:480px;animation:slideUp .3s ease">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:18px">
      <div style="font-size:16px;font-weight:800">🎟 Apply Coupon</div>
      <button onclick="document.getElementById('couponModal').style.display='none'" style="background:none;border:none;font-size:22px;cursor:pointer;color:var(--text-muted)">×</button>
    </div>
    <div style="display:flex;gap:8px;margin-bottom:14px">
      <input type="text" id="couponCodeInput" placeholder="ENTER PROMO CODE" style="flex:1;padding:11px 14px;border:1.5px solid var(--border);border-radius:9px;font-size:14px;font-family:'Nunito',sans-serif;font-weight:700;text-transform:uppercase;letter-spacing:1px;outline:none">
      <button onclick="applyCoupon()" style="padding:11px 20px;background:var(--green);color:#fff;border:none;border-radius:9px;font-size:14px;font-weight:800;cursor:pointer;font-family:'Nunito',sans-serif">Apply</button>
    </div>
    <div style="font-size:12px;color:var(--text-muted);font-weight:600;margin-bottom:10px">Available Codes:</div>
    <div style="display:flex;gap:8px;flex-wrap:wrap">
      @foreach(['FRESH10' => '₹10 off', 'SAVE20' => '₹20 off', 'FIRST50' => '₹50 off', 'GREEN15' => '₹15 off'] as $code => $desc)
      <div onclick="document.getElementById('couponCodeInput').value='{{ $code }}'" style="padding:6px 12px;border:1.5px dashed var(--green);border-radius:6px;cursor:pointer;background:var(--green-light);font-size:12px;font-weight:700;color:var(--green)">
        {{ $code }} <span style="color:var(--text-muted);font-weight:500">— {{ $desc }}</span>
      </div>
      @endforeach
    </div>
  </div>
</div>

{{-- ── TOAST ── --}}
<div class="toast-container" id="toastContainer"></div>

@push('scripts')
<style>
  @keyframes slideUp { from { transform: translateY(100%); } to { transform: translateY(0); } }
</style>
<script>


function detectLocation() {
  const btn = document.getElementById('locBtn');
  const title = document.getElementById('locStatusTitle');
  const sub = document.getElementById('locStatusSub');

  if (!navigator.geolocation) {
    showToast('Geolocation not supported by your browser', 'error');
    return;
  }

  btn.disabled = true;
  btn.textContent = '⏳ Detecting...';
  title.textContent = 'Detecting your location...';

  navigator.geolocation.getCurrentPosition(function(pos) {
    const lat = pos.coords.latitude;
    const lng = pos.coords.longitude;

    fetch("{{ route('delivery.check') }}", {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify({ lat: lat, lng: lng })
    })
    .then(r => r.json())
    .then(data => {
      btn.disabled = false;
      btn.textContent = '📡 Use My Location';

      if (data.serviceable) {
        title.textContent = data.message;
        sub.textContent = data.sub;
        document.getElementById('locationBox').style.borderColor = 'var(--green)';
        document.getElementById('delivery_km_input').value = data.km;
        document.getElementById('delivery_area_input').value = data.area || '';
        showToast('Location detected! Delivery available 🎉', 'success');

        // Update delivery charge live in summary (optional refresh)
        recalcDeliveryDisplay(data.charge);
      } else {
        title.textContent = data.message;
        sub.textContent = data.sub || 'Try entering pincode manually below.';
        document.getElementById('locationBox').style.borderColor = 'var(--danger)';
        showToast(data.message, 'error');
      }
    })
    .catch(() => {
      btn.disabled = false;
      btn.textContent = '📡 Use My Location';
      showToast('Could not check delivery area. Try again.', 'error');
    });

  }, function(err) {
    btn.disabled = false;
    btn.textContent = '📡 Use My Location';
    title.textContent = 'Location permission denied';
    sub.textContent = 'Please enter your pincode manually below.';
    showToast('Please allow location access or enter pincode manually', 'error');
  });
}

// Optional: live update delivery charge text in summary without page reload
function recalcDeliveryDisplay(charge) {
  const subtotal = {{ $subtotal }};
  const deliveryRow = document.querySelector('.sum-row .lbl');
  // Simple approach: just notify user, real total recalculates after page submit/reload
if (subtotal >= 2000) return; // free already
  showToast('Delivery charge updated based on your location: ₹' + charge, 'success');
}


  // ── TOAST ──
  function showToast(msg, type = 'success') {
    const icons = { success: '✅', error: '❌', info: 'ℹ️' };
    const t = document.createElement('div');
    t.className = `toast ${type}`;
    t.innerHTML = `<span>${icons[type]}</span><span>${msg}</span>`;
    document.getElementById('toastContainer').appendChild(t);
    setTimeout(() => {
      t.style.animation = 'slideOut .3s ease forwards';
      setTimeout(() => t.remove(), 310);
    }, 3500);
  }

  // ── SELECT PAYMENT ──
  function selectPayment(type) {
    document.querySelectorAll('.pay-opt').forEach(el => el.classList.remove('selected'));
    document.getElementById('pay-' + type).classList.add('selected');
    document.querySelectorAll('.pay-opt input[type=radio]').forEach(r => r.checked = r.value === type);
    document.getElementById('codInfo').style.display    = type === 'cod'    ? 'flex' : 'none';
    document.getElementById('onlineInfo').style.display = type === 'online' ? 'flex' : 'none';
  }

  // ── SELECT SAVED ADDRESS ──
  function selectAddress(el, address, city, state, pincode) {
    document.querySelectorAll('.addr-card').forEach(c => c.classList.remove('selected'));
    el.classList.add('selected');
    document.getElementById('address').value = address;
    document.getElementById('city').value    = city;
    const stateSelect = document.getElementById('state');
    for (let opt of stateSelect.options) {
      if (opt.value === state) { opt.selected = true; break; }
    }
    document.getElementById('pincode').value = pincode;
    showToast('Address selected!', 'success');
  }

  // ── PINCODE CHECK ──
let pincodeTimer;
function checkPincode(val) {
  clearTimeout(pincodeTimer);
  const status = document.getElementById('pincodeStatus');
  if (val.length < 6) { status.className = 'pincode-status'; return; }
  status.className = 'pincode-status loading';
  status.textContent = '⏳ Checking delivery...';

  pincodeTimer = setTimeout(() => {
    fetch("{{ route('delivery.check') }}", {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify({ pincode: val })
    })
    .then(r => r.json())
    .then(data => {
      if (data.serviceable) {
        status.className = 'pincode-status success';
        status.textContent = '✅ ' + data.message + ' — ' + data.sub;
        document.getElementById('delivery_km_input').value = data.km;
        document.getElementById('delivery_area_input').value = data.area || '';
      } else {
        status.className = 'pincode-status error';
        status.textContent = data.message + (data.sub ? ' — ' + data.sub : '');
      }
    })
    .catch(() => {
      status.className = 'pincode-status error';
      status.textContent = '⚠️ Could not verify pincode';
    });
  }, 600);
}

  // ── COUPON ──
  const couponDiscounts = { 'FRESH10': 10, 'SAVE20': 20, 'FIRST50': 50, 'GREEN15': 15 };
  function applyCoupon() {
    const code = document.getElementById('couponCodeInput').value.trim().toUpperCase();
    if (!code) { showToast('Enter a coupon code', 'error'); return; }
    if (couponDiscounts[code] !== undefined) {
      const d = couponDiscounts[code];
      document.getElementById('couponDiscRow').style.display = 'flex';
      document.getElementById('couponDiscVal').textContent   = `−₹${d}`;
      document.getElementById('couponLabel').textContent     = `"${code}" applied — Saved ₹${d} 🎉`;
      document.getElementById('couponModal').style.display   = 'none';
      showToast(`Coupon "${code}" applied! You saved ₹${d}`, 'success');
    } else {
      showToast('Invalid coupon code. Try another!', 'error');
    }
  }

  // ── FORM VALIDATION + LOADING ──
  document.getElementById('checkoutForm').addEventListener('submit', function(e) {
    let valid = true;
    const required = ['name','phone','address','city','state','pincode'];
    required.forEach(id => {
      const el = document.getElementById(id);
      if (!el) return;
      if (!el.value.trim()) {
        el.classList.add('error');
        el.closest('.form-group').querySelector('.field-error') && (el.closest('.form-group').querySelector('.field-error').style.display = 'block');
        valid = false;
      } else {
        el.classList.remove('error');
      }
    });
    // Phone validation
    const phone = document.getElementById('phone').value.trim();
    if (phone && !/^\d{10}$/.test(phone)) {
      document.getElementById('phone').classList.add('error');
      showToast('Enter a valid 10-digit phone number', 'error');
      valid = false;
    }
    // Pincode validation
    const pincode = document.getElementById('pincode').value.trim();
    if (pincode && !/^\d{6}$/.test(pincode)) {
      document.getElementById('pincode').classList.add('error');
      showToast('Enter a valid 6-digit pincode', 'error');
      valid = false;
    }
    if (!valid) {
      e.preventDefault();
      showToast('Please fill all required fields correctly', 'error');
      return;
    }
    // Show loading state
    const btn = document.getElementById('placeOrderBtn');
    btn.classList.add('loading');
    btn.querySelector('.btn-text').textContent = 'Placing Order...';
  });

  // Remove error on input
  document.querySelectorAll('.form-control').forEach(el => {
    el.addEventListener('input', function() {
      this.classList.remove('error');
    });
  });

  // ── SESSION TOAST ──
  @if(session('success'))
    showToast('{{ session('success') }}', 'success');
  @endif
  @if(session('error'))
    showToast('{{ session('error') }}', 'error');
  @endif

  // Sync location from home page (localStorage) if session doesn't have it
document.addEventListener('DOMContentLoaded', function() {
  const currentKm = parseFloat(document.getElementById('delivery_km_input').value) || 0;
  if (currentKm > 0) return; // session already has it

  const saved = localStorage.getItem('gm_delivery_location');
  if (!saved) return;
  try {
    const data = JSON.parse(saved);
    const isStale = (Date.now() - (data.ts || 0)) > 60 * 60 * 1000;
    if (isStale || !data.serviceable) return;

    document.getElementById('delivery_km_input').value = data.km;
    document.getElementById('delivery_area_input').value = data.area || '';
    showToast(`Delivery location: ${data.area || 'your area'} (₹${data.charge} delivery)`, 'success');
  } catch(e) {}
});

</script>
@endpush

@endsection