@extends('frontend.layouts.app')

@section('title', 'My Cart')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  :root {
    --green: #0d6e39;
    --green-dark: #095c2f;
    --green-light: #e6f4ec;
    --green-mid: #1a8a4a;
    --white: #ffffff;
    --bg: #f4f6f8;
    --card-bg: #ffffff;
    --border: #e4e9f0;
    --text-main: #1a202c;
    --text-muted: #64748b;
    --text-light: #94a3b8;
    --danger: #ef4444;
    --danger-light: #fef2f2;
    --warning: #f59e0b;
    --shadow-sm: 0 1px 4px rgba(0,0,0,0.07);
    --shadow-md: 0 4px 16px rgba(0,0,0,0.10);
    --shadow-lg: 0 8px 32px rgba(0,0,0,0.13);
    --radius: 14px;
    --radius-sm: 8px;
  }

  * { box-sizing: border-box; margin: 0; padding: 0; }

  body {
    font-family: 'Nunito', sans-serif;
    background: var(--bg);
    color: var(--text-main);
    min-height: 100vh;
  }

  /* ── BREADCRUMB ── */
  .cart-breadcrumb {
    background: var(--white);
    border-bottom: 1px solid var(--border);
    padding: 12px 0;
  }
  .breadcrumb-inner {
    max-width: 1200px;
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

  /* ── PROGRESS STEPS ── */
  .checkout-steps {
    background: var(--white);
    border-bottom: 1px solid var(--border);
    padding: 14px 0;
  }
  .steps-inner {
    max-width: 600px;
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0;
  }
  .step {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
    position: relative;
    flex: 1;
  }
  .step-circle {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    font-weight: 700;
    background: var(--green-light);
    color: var(--green);
    border: 2px solid var(--green);
    transition: all 0.3s;
  }
  .step.active .step-circle {
    background: var(--green);
    color: var(--white);
    box-shadow: 0 0 0 4px rgba(13,110,57,0.18);
  }
  .step.done .step-circle {
    background: var(--green);
    color: var(--white);
  }
  .step-label {
    font-size: 11px;
    font-weight: 600;
    color: var(--text-muted);
    white-space: nowrap;
  }
  .step.active .step-label { color: var(--green); }
  .step-line {
    flex: 1;
    height: 2px;
    background: var(--border);
    margin: 0;
    margin-bottom: 18px;
    max-width: 60px;
  }
  .step-line.done { background: var(--green); }

  /* ── MAIN LAYOUT ── */
  .cart-wrapper {
    max-width: 1200px;
    margin: 28px auto;
    padding: 0 20px;
  }
  .cart-grid {
    display: grid;
    grid-template-columns: 1fr 340px;
    gap: 22px;
    align-items: start;
  }

  /* ── CARD BASE ── */
  .card {
    background: var(--card-bg);
    border-radius: var(--radius);
    border: 1px solid var(--border);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
  }
  .card-header {
    padding: 18px 22px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: linear-gradient(135deg, #f8fdf9 0%, #ffffff 100%);
  }
  .card-header-title {
    font-size: 16px;
    font-weight: 800;
    color: var(--text-main);
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .card-header-title .badge {
    background: var(--green);
    color: var(--white);
    font-size: 11px;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 20px;
  }
  .card-body { padding: 0; }

  /* ── SELECT ALL ── */
  .select-all-bar {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 22px;
    border-bottom: 1px solid var(--border);
    background: #fafbfc;
  }
  .select-all-bar label {
    font-size: 13px;
    font-weight: 600;
    color: var(--text-muted);
    cursor: pointer;
  }
  .custom-check {
    width: 18px;
    height: 18px;
    accent-color: var(--green);
    cursor: pointer;
  }
  .select-all-bar .clear-all {
    margin-left: auto;
    font-size: 12px;
    color: var(--danger);
    font-weight: 600;
    cursor: pointer;
    background: none;
    border: none;
    text-decoration: underline;
  }

  /* ── CART ITEM ── */
  .cart-item {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    padding: 18px 22px;
    border-bottom: 1px solid var(--border);
    transition: background 0.2s;
    position: relative;
  }
  .cart-item:last-child { border-bottom: none; }
  .cart-item:hover { background: #fafcfb; }
  .cart-item.removing {
    animation: fadeSlideOut 0.35s ease forwards;
  }
  @keyframes fadeSlideOut {
    to { opacity: 0; transform: translateX(40px); max-height: 0; padding: 0; }
  }

  .item-check { padding-top: 4px; flex-shrink: 0; }

  .item-img-wrap {
    width: 88px;
    height: 88px;
    border-radius: 10px;
    border: 1px solid var(--border);
    background: #f8fafc;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    overflow: hidden;
    position: relative;
  }
  .item-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 10px;
  }
  .item-img-wrap .img-placeholder { font-size: 36px; }
  .item-badge {
    position: absolute;
    top: 5px;
    left: 5px;
    background: var(--danger);
    color: #fff;
    font-size: 9px;
    font-weight: 800;
    padding: 2px 5px;
    border-radius: 4px;
    letter-spacing: 0.3px;
  }

  .item-details { flex: 1; min-width: 0; }
  .item-name {
    font-size: 14px;
    font-weight: 700;
    color: var(--text-main);
    margin-bottom: 4px;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
  .item-meta {
    font-size: 12px;
    color: var(--text-muted);
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
  }
  .item-meta .tag {
    background: var(--green-light);
    color: var(--green);
    font-size: 10px;
    font-weight: 700;
    padding: 2px 7px;
    border-radius: 4px;
  }
  .item-price-row {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 10px;
  }
  .item-price-now {
    font-size: 18px;
    font-weight: 800;
    color: var(--green);
  }
  .item-price-was {
    font-size: 13px;
    color: var(--text-light);
    text-decoration: line-through;
  }
  .item-discount-tag {
    font-size: 11px;
    font-weight: 700;
    color: var(--danger);
    background: var(--danger-light);
    padding: 2px 6px;
    border-radius: 4px;
  }

  /* QTY CONTROL */
  .qty-row {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
  }
  .qty-control {
    display: flex;
    align-items: center;
    border: 1.5px solid var(--border);
    border-radius: 8px;
    overflow: hidden;
    background: #fff;
  }
  .qty-btn {
    width: 32px;
    height: 32px;
    background: #f4f6f8;
    border: none;
    font-size: 18px;
    color: var(--green);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    transition: background 0.15s;
    line-height: 1;
  }
  .qty-btn:hover { background: var(--green-light); }
  .qty-btn:disabled { color: var(--text-light); cursor: not-allowed; }
  .qty-input {
    width: 38px;
    height: 32px;
    text-align: center;
    border: none;
    font-size: 14px;
    font-weight: 700;
    color: var(--text-main);
    font-family: 'Nunito', sans-serif;
    background: #fff;
    outline: none;
  }
  .qty-input::-webkit-inner-spin-button,
  .qty-input::-webkit-outer-spin-button { -webkit-appearance: none; }

  .item-action-btns {
    display: flex;
    align-items: center;
    gap: 6px;
  }
  .btn-save-later, .btn-remove {
    font-size: 12px;
    font-weight: 600;
    padding: 6px 12px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }
  .btn-save-later {
    background: #eff6ff;
    color: #3b82f6;
  }
  .btn-save-later:hover { background: #dbeafe; }
  .btn-remove {
    background: var(--danger-light);
    color: var(--danger);
  }
  .btn-remove:hover { background: #fee2e2; }

  .item-total-col {
    text-align: right;
    flex-shrink: 0;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 4px;
    min-width: 90px;
  }
  .item-subtotal {
    font-size: 16px;
    font-weight: 800;
    color: var(--text-main);
  }
  .item-saved {
    font-size: 11px;
    color: var(--green);
    font-weight: 600;
  }

  /* ── DELIVERY BANNER ── */
  .delivery-banner {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 22px;
    background: linear-gradient(135deg, var(--green-light), #f0fdf4);
    border-bottom: 1px solid #c6e9d5;
    font-size: 13px;
    font-weight: 600;
    color: var(--green-dark);
  }
  .delivery-banner .icon { font-size: 20px; }

  /* ── COUPON SECTION ── */
  .coupon-section {
    padding: 18px 22px;
    border-top: 1px solid var(--border);
  }
  .coupon-title {
    font-size: 14px;
    font-weight: 700;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 6px;
  }
  .coupon-input-wrap {
    display: flex;
    gap: 8px;
  }
  .coupon-input {
    flex: 1;
    padding: 10px 14px;
    border: 1.5px solid var(--border);
    border-radius: 8px;
    font-size: 13px;
    font-family: 'Nunito', sans-serif;
    font-weight: 600;
    outline: none;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: border 0.2s;
  }
  .coupon-input:focus { border-color: var(--green); }
  .btn-apply {
    padding: 10px 20px;
    background: var(--green);
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    transition: background 0.2s;
    font-family: 'Nunito', sans-serif;
  }
  .btn-apply:hover { background: var(--green-dark); }
  .coupon-chips {
    display: flex;
    gap: 8px;
    margin-top: 10px;
    flex-wrap: wrap;
  }
  .coupon-chip {
    font-size: 11px;
    font-weight: 700;
    padding: 4px 10px;
    border: 1.5px dashed var(--green);
    color: var(--green);
    border-radius: 5px;
    cursor: pointer;
    background: var(--green-light);
    transition: all 0.2s;
    letter-spacing: 0.5px;
  }
  .coupon-chip:hover { background: var(--green); color: #fff; }

  /* ── SAVED FOR LATER ── */
  .saved-section {
    margin-top: 0;
    border-top: 3px solid var(--border);
  }
  .saved-header {
    padding: 16px 22px;
    background: #fafbfc;
    font-size: 14px;
    font-weight: 700;
    color: var(--text-muted);
    display: flex;
    align-items: center;
    gap: 8px;
    border-bottom: 1px solid var(--border);
  }
  .saved-item {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 14px 22px;
    border-bottom: 1px solid var(--border);
    opacity: 0.8;
  }
  .saved-item:last-child { border-bottom: none; }
  .saved-item .item-img-wrap { width: 60px; height: 60px; }
  .saved-item .item-name { font-size: 13px; }
  .btn-move-to-cart {
    margin-left: auto;
    padding: 6px 14px;
    background: var(--green);
    color: #fff;
    border: none;
    border-radius: 7px;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
    transition: background 0.2s;
    white-space: nowrap;
    font-family: 'Nunito', sans-serif;
  }
  .btn-move-to-cart:hover { background: var(--green-dark); }

  /* ── ORDER SUMMARY CARD ── */
  .summary-card { position: sticky; top: 90px; }
  .summary-body { padding: 20px 22px; }
  .summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 14px;
    padding: 9px 0;
    border-bottom: 1px solid var(--border);
  }
  .summary-row:last-of-type { border-bottom: none; }
  .summary-row .label { color: var(--text-muted); font-weight: 500; }
  .summary-row .value { font-weight: 700; color: var(--text-main); }
  .summary-row .value.green { color: var(--green); }
  .summary-row .value.strike { text-decoration: line-through; color: var(--text-light); font-weight: 400; }
  .summary-divider { height: 1px; background: var(--border); margin: 4px 0; }
  .summary-total-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px 0 8px;
    font-size: 18px;
    font-weight: 800;
    color: var(--text-main);
  }
  .you-save-banner {
    background: linear-gradient(135deg, var(--green-light), #f0fdf4);
    border: 1px solid #c6e9d5;
    border-radius: 8px;
    padding: 10px 14px;
    font-size: 13px;
    font-weight: 700;
    color: var(--green-dark);
    text-align: center;
    margin: 8px 0 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
  }
  .btn-checkout {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    background: linear-gradient(135deg, var(--green), var(--green-dark));
    color: #fff;
    padding: 15px 20px;
    border-radius: 10px;
    font-size: 16px;
    font-weight: 800;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.25s;
    width: 100%;
    font-family: 'Nunito', sans-serif;
    box-shadow: 0 4px 14px rgba(13,110,57,0.28);
    letter-spacing: 0.3px;
  }
  .btn-checkout:hover {
    background: linear-gradient(135deg, var(--green-mid), var(--green));
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(13,110,57,0.35);
    color: #fff;
    text-decoration: none;
  }
  .btn-checkout .arrow { font-size: 18px; transition: transform 0.2s; }
  .btn-checkout:hover .arrow { transform: translateX(4px); }

  .continue-shop {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    margin-top: 12px;
    font-size: 13px;
    font-weight: 600;
    color: var(--green);
    text-decoration: none;
    transition: gap 0.2s;
  }
  .continue-shop:hover { gap: 10px; color: var(--green-dark); text-decoration: none; }

  /* SECURITY BADGES */
  .security-row {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 14px;
    margin-top: 16px;
    padding-top: 14px;
    border-top: 1px solid var(--border);
    flex-wrap: wrap;
  }
  .sec-badge {
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 11px;
    color: var(--text-muted);
    font-weight: 600;
  }
  .sec-badge .icon { font-size: 14px; }

  /* DELIVERY INFO */
  .delivery-info {
    margin-top: 14px;
    border: 1px solid var(--border);
    border-radius: 8px;
    overflow: hidden;
  }
  .delivery-info-row {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 11px 14px;
    font-size: 12px;
    color: var(--text-muted);
    font-weight: 600;
    border-bottom: 1px solid var(--border);
  }
  .delivery-info-row:last-child { border-bottom: none; }
  .delivery-info-row .di-icon { font-size: 18px; flex-shrink: 0; }
  .delivery-info-row strong { color: var(--text-main); }

  /* ── EMPTY STATE ── */
  .empty-state {
    text-align: center;
    padding: 70px 30px;
  }
  .empty-illustration {
    font-size: 80px;
    margin-bottom: 20px;
    animation: float 3s ease-in-out infinite;
  }
  @keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-12px); }
  }
  .empty-title { font-size: 22px; font-weight: 800; color: var(--text-main); margin-bottom: 8px; }
  .empty-sub { font-size: 14px; color: var(--text-muted); margin-bottom: 28px; }
  .btn-shop-now {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, var(--green), var(--green-dark));
    color: #fff;
    padding: 13px 28px;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 700;
    text-decoration: none;
    box-shadow: 0 4px 14px rgba(13,110,57,0.28);
    transition: transform 0.2s, box-shadow 0.2s;
  }
  .btn-shop-now:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(13,110,57,0.35); color: #fff; text-decoration: none; }

  /* ── RECENTLY VIEWED ── */
  .recently-viewed {
    margin-top: 28px;
    background: var(--white);
    border-radius: var(--radius);
    border: 1px solid var(--border);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
  }
  .rv-header {
    padding: 16px 22px;
    border-bottom: 1px solid var(--border);
    font-size: 15px;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .rv-header a { font-size: 12px; font-weight: 600; color: var(--green); text-decoration: none; }
  .rv-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 0;
  }
  .rv-item {
    padding: 16px;
    border-right: 1px solid var(--border);
    border-bottom: 1px solid var(--border);
    text-align: center;
    cursor: pointer;
    transition: background 0.15s;
    text-decoration: none;
    color: inherit;
    display: block;
  }
  .rv-item:hover { background: #fafcfb; }
  .rv-item:last-child { border-right: none; }
  .rv-img {
    width: 70px;
    height: 70px;
    background: #f8fafc;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 34px;
    margin: 0 auto 10px;
    border: 1px solid var(--border);
  }
  .rv-name { font-size: 12px; font-weight: 600; color: var(--text-main); margin-bottom: 4px; line-height: 1.3; }
  .rv-price { font-size: 13px; font-weight: 800; color: var(--green); }
  .rv-add {
    margin-top: 8px;
    width: 100%;
    padding: 6px;
    background: var(--green-light);
    color: var(--green);
    border: 1.5px solid var(--green);
    border-radius: 6px;
    font-size: 11px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s;
    font-family: 'Nunito', sans-serif;
  }
  .rv-add:hover { background: var(--green); color: #fff; }

  /* ── TOAST ── */
  .toast-container {
    position: fixed;
    bottom: 24px;
    right: 24px;
    z-index: 9999;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }
  .toast {
    background: #1a202c;
    color: #fff;
    padding: 13px 18px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
    box-shadow: var(--shadow-lg);
    animation: slideInToast 0.3s ease;
    max-width: 280px;
  }
  .toast.success { border-left: 4px solid var(--green); }
  .toast.error { border-left: 4px solid var(--danger); }
  @keyframes slideInToast {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
  }
  @keyframes slideOutToast {
    to { transform: translateX(120%); opacity: 0; }
  }

  /* ── ALERT ── */
  .alert-banner {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 18px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 20px;
  }
  .alert-banner.success {
    background: linear-gradient(135deg, #dcfce7, #f0fdf4);
    border: 1px solid #bbf7d0;
    color: #15803d;
  }

  /* ── PAGE HEADER ── */
  .page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 22px;
    flex-wrap: wrap;
    gap: 12px;
  }
  .page-title {
    font-size: 24px;
    font-weight: 800;
    color: var(--text-main);
    font-family: 'Poppins', sans-serif;
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .page-title .cart-count-badge {
    font-size: 14px;
    font-weight: 700;
    background: var(--green);
    color: #fff;
    padding: 2px 10px;
    border-radius: 20px;
  }
  .clear-all-btn {
    background: none;
    border: 1.5px solid var(--border);
    color: var(--text-muted);
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    font-family: 'Nunito', sans-serif;
  }
  .clear-all-btn:hover { border-color: var(--danger); color: var(--danger); background: var(--danger-light); }

  /* ── FREE DELIVERY PROGRESS ── */
  .free-delivery-bar {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 16px 20px;
    margin-bottom: 22px;
    box-shadow: var(--shadow-sm);
  }
  .fd-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 10px;
    font-size: 13px;
    font-weight: 600;
  }
  .fd-top .icon { font-size: 20px; }
  .fd-top .msg { color: var(--green-dark); }
  .fd-top .amount { color: var(--green); font-size: 14px; font-weight: 800; }
  .fd-track {
    height: 8px;
    background: #e9ecef;
    border-radius: 20px;
    overflow: hidden;
  }
  .fd-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--green), #1ab954);
    border-radius: 20px;
    transition: width 0.5s ease;
  }
  .fd-labels {
    display: flex;
    justify-content: space-between;
    font-size: 11px;
    color: var(--text-light);
    margin-top: 6px;
  }

  /* ── RESPONSIVE ── */
  @media (max-width: 1100px) {
    .cart-grid { grid-template-columns: 1fr 300px; }
  }

  @media (max-width: 900px) {
    .cart-grid { grid-template-columns: 1fr; }
    .summary-card { position: static; }
    .rv-grid { grid-template-columns: repeat(3, 1fr); }
  }

  @media (max-width: 640px) {
    .cart-wrapper { margin: 16px auto; padding: 0 12px; }
    .page-title { font-size: 20px; }
    .cart-item { padding: 14px 14px; gap: 10px; }
    .item-img-wrap { width: 70px; height: 70px; }
    .item-total-col { min-width: 70px; }
    .item-price-now { font-size: 15px; }
    .item-subtotal { font-size: 14px; }
    .card-header { padding: 14px 16px; }
    .card-body { }
    .select-all-bar { padding: 11px 14px; }
    .coupon-section { padding: 14px 16px; }
    .summary-body { padding: 16px 16px; }
    .rv-grid { grid-template-columns: repeat(2, 1fr); }
    .btn-checkout { font-size: 15px; padding: 13px 16px; }
    .steps-inner { gap: 0; }
    .checkout-steps { padding: 10px 0; }
    .delivery-banner { padding: 10px 14px; font-size: 12px; }
    .item-action-btns { gap: 4px; }
    .btn-save-later, .btn-remove { padding: 5px 9px; font-size: 11px; }
  }

  @media (max-width: 440px) {
    .item-img-wrap { width: 60px; height: 60px; }
    .item-name { font-size: 13px; }
    .item-price-now { font-size: 14px; }
    .item-total-col { min-width: 60px; }
    .qty-btn { width: 28px; height: 28px; }
    .qty-input { width: 32px; height: 28px; font-size: 13px; }
    .rv-grid { grid-template-columns: repeat(2, 1fr); }
    .toast-container { right: 12px; bottom: 70px; }
    .toast { max-width: 240px; font-size: 12px; }
  }

  /* ── STICKY MOBILE CHECKOUT BAR ── */
  .mobile-checkout-bar {
    display: none;
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: var(--white);
    border-top: 1px solid var(--border);
    padding: 12px 16px;
    z-index: 100;
    box-shadow: 0 -4px 20px rgba(0,0,0,0.10);
    align-items: center;
    gap: 12px;
  }
  .mobile-checkout-bar .total-info { flex: 1; }
  .mobile-checkout-bar .total-label { font-size: 11px; color: var(--text-muted); font-weight: 600; }
  .mobile-checkout-bar .total-amount { font-size: 18px; font-weight: 800; color: var(--text-main); line-height: 1; }
  .mobile-checkout-bar .btn-checkout-mobile {
    background: linear-gradient(135deg, var(--green), var(--green-dark));
    color: #fff;
    padding: 12px 22px;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 800;
    text-decoration: none;
    border: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    box-shadow: 0 4px 14px rgba(13,110,57,0.28);
    font-family: 'Nunito', sans-serif;
    white-space: nowrap;
  }
  @media (max-width: 900px) {
    .mobile-checkout-bar { display: flex; }
    .cart-wrapper { padding-bottom: 90px; }
  }

</style>
@endpush

@section('content')

{{-- ── BREADCRUMB ── --}}
<div class="cart-breadcrumb">
  <div class="breadcrumb-inner">
    <a href="{{ route('home') }}">🏠 Home</a>
    <span class="sep">›</span>
    <a href="{{ route('shop') }}">Shop</a>
    <span class="sep">›</span>
    <span>My Cart</span>
  </div>
</div>

{{-- ── CHECKOUT STEPS ── --}}
<div class="checkout-steps">
  <div class="steps-inner">
    <div class="step active">
      <div class="step-circle">🛒</div>
      <div class="step-label">Cart</div>
    </div>
    <div class="step-line"></div>
    <div class="step">
      <div class="step-circle">📦</div>
      <div class="step-label">Address</div>
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

{{-- ── MAIN WRAPPER ── --}}
<div class="cart-wrapper">

  {{-- Alert --}}
  @if(session('success'))
  <div class="alert-banner success">
    <span>✅</span> {{ session('success') }}
  </div>
  @endif

  @if(count($products) > 0)

  {{-- Free Delivery Progress --}}
  @php
    $remaining = max(0, 499 - $total);
    $percent = min(100, ($total / 499) * 100);
  @endphp
  <div class="free-delivery-bar">
    <div class="fd-top">
      <span class="icon">🚚</span>
      @if($total >= 499)
        <span class="msg">🎉 You've unlocked <strong>FREE delivery!</strong></span>
        <span class="amount">Saved ₹40</span>
      @else
        <span class="msg">Add <strong>₹{{ number_format($remaining) }}</strong> more for FREE delivery</span>
        <span class="amount">₹499 target</span>
      @endif
    </div>
    <div class="fd-track">
      <div class="fd-fill" style="width: {{ $percent }}%"></div>
    </div>
    <div class="fd-labels">
      <span>₹0</span>
      <span>₹499</span>
    </div>
  </div>

  {{-- Page Header --}}
  <div class="page-header">
    <div class="page-title">
      My Cart
      <span class="cart-count-badge">{{ count($products) }} {{ Str::plural('item', count($products)) }}</span>
    </div>
    <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Clear entire cart?')">
      @csrf @method('DELETE')
      <button type="submit" class="clear-all-btn">🗑 Clear All</button>
    </form>
  </div>

  <div class="cart-grid">

    {{-- ── LEFT COLUMN ── --}}
    <div>

      {{-- Cart Items Card --}}
      <div class="card">
        <div class="card-header">
          <div class="card-header-title">
            🛍 Cart Items
            <span class="badge">{{ count($products) }}</span>
          </div>
          <div style="font-size:12px; color:var(--text-muted); font-weight:600;">
            {{ count($products) }} {{ Str::plural('product', count($products)) }} selected
          </div>
        </div>

        {{-- Select All --}}
        <div class="select-all-bar">
          <input type="checkbox" class="custom-check" id="selectAll" checked onchange="toggleAll(this)">
          <label for="selectAll">Select All Items</label>
          <button class="clear-all" onclick="document.querySelector('form[action*=clear]').submit()">Remove All</button>
        </div>

        {{-- Delivery Banner --}}
        @if($total >= 499)
        <div class="delivery-banner">
          <span class="icon">🚚</span>
          <span>Your order qualifies for <strong>FREE delivery!</strong></span>
        </div>
        @else
        <div class="delivery-banner" style="background:linear-gradient(135deg,#fffbeb,#fef9c3);border-color:#fde68a;color:#92400e;">
          <span class="icon">⚡</span>
          <span>Add ₹{{ number_format(499 - $total) }} more to get <strong>FREE delivery</strong></span>
        </div>
        @endif

        {{-- Items --}}
        @foreach($products as $index => $item)
        @php



          $product = $item['product'];
          $qty = $item['qty'];
          $price = $product->current_price;
          $originalPrice = $product->original_price ?? ($price * 1.2);
          $discount = round((($originalPrice - $price) / $originalPrice) * 100);
          $lineTotal = $price * $qty;
        @endphp
        <div class="cart-item" id="cart-item-{{ $product->id }}">

          <div class="item-check">
            <input type="checkbox" class="custom-check item-check-box" checked>
          </div>

 @php
  $imgSrc = null;
  $imgField = $product->thumbnail ?? $product->image ?? null;
  if (!empty($imgField)) {
    $imgSrc = asset('storage/' . $imgField);
  }
@endphp
          <div class="item-img-wrap">
            @if($imgSrc)
              <img src="{{ $imgSrc }}" alt="{{ $product->name }}" loading="lazy"
                   onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
              <span class="img-placeholder" style="display:none">🛒</span>
            @else
              <span class="img-placeholder">🛒</span>
            @endif
            @if($discount > 0)
              <span class="item-badge">-{{ $discount }}%</span>
            @endif
          </div>

          <div class="item-details">
            <div class="item-name">{{ $product->name }}</div>
            <div class="item-meta">
              @if($product->category)
                <span class="tag">{{ $product->category->name ?? 'Grocery' }}</span>
              @endif
              @if($product->weight)
                <span>{{ $product->weight }}</span>
              @endif
              <span>In Stock ✅</span>
            </div>
            <div class="item-price-row">
              <span class="item-price-now">₹{{ number_format($price) }}</span>
              @if($originalPrice > $price)
                <span class="item-price-was">₹{{ number_format($originalPrice) }}</span>
                <span class="item-discount-tag">{{ $discount }}% OFF</span>
              @endif
            </div>
            <div class="qty-row">
              <div class="qty-control">
                <button class="qty-btn" onclick="changeQty({{ $product->id }}, -1)" {{ $qty <= 1 ? 'disabled' : '' }}>−</button>
                <input type="number" class="qty-input" id="qty-{{ $product->id }}" value="{{ $qty }}" min="1" max="20" onchange="updateQty({{ $product->id }}, this.value)">
                <button class="qty-btn" onclick="changeQty({{ $product->id }}, 1)" {{ $qty >= 20 ? 'disabled' : '' }}>+</button>
              </div>
              <div class="item-action-btns">
                <button class="btn-save-later" onclick="saveForLater({{ $product->id }})">🔖 Save for Later</button>
                <form action="{{ route('cart.remove', $product->id) }}" method="POST" style="display:inline" onsubmit="handleRemove(event, {{ $product->id }})">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn-remove">🗑 Remove</button>
                </form>
              </div>
            </div>
          </div>

          <div class="item-total-col">
            <div class="item-subtotal" id="subtotal-{{ $product->id }}">₹{{ number_format($lineTotal) }}</div>
            @if($qty > 1)
              <div class="item-saved" style="font-size:10px;color:var(--text-muted)">{{ $qty }} × ₹{{ number_format($price) }}</div>
            @endif
            @if($discount > 0)
              <div class="item-saved">Saved ₹{{ number_format(($originalPrice - $price) * $qty) }}</div>
            @endif
          </div>

        </div>
        @endforeach

        {{-- Coupon Section --}}
        <div class="coupon-section">
          <div class="coupon-title">🎟 Apply Coupon / Promo Code</div>
          <div class="coupon-input-wrap">
            <input type="text" class="coupon-input" id="couponInput" placeholder="ENTER CODE">
            <button class="btn-apply" onclick="applyCoupon()">Apply</button>
          </div>
          <div class="coupon-chips">
            <span class="coupon-chip" onclick="fillCoupon('FRESH10')">FRESH10</span>
            <span class="coupon-chip" onclick="fillCoupon('SAVE20')">SAVE20</span>
            <span class="coupon-chip" onclick="fillCoupon('FIRST50')">FIRST50</span>
            <span class="coupon-chip" onclick="fillCoupon('GREEN15')">GREEN15</span>
          </div>
        </div>

      </div>{{-- /card --}}

      {{-- Saved For Later --}}
      <div class="card saved-section" style="margin-top:20px;" id="savedSection" style="display:none">
        <div class="saved-header">
          🔖 Saved for Later
          <span id="savedCount" style="background:var(--border);padding:2px 8px;border-radius:10px;font-size:12px;">0</span>
        </div>
        <div id="savedItems"></div>
      </div>

    </div>

    {{-- ── RIGHT COLUMN: SUMMARY ── --}}
    <div>
      <div class="card summary-card">
        <div class="card-header">
          <div class="card-header-title">🧾 Order Summary</div>
        </div>
        <div class="summary-body">

          @php
            $delivery = $total >= 499 ? 0 : 40;
            $totalSaved = 0;
            foreach($products as $item) {
              $op = $item['product']->original_price ?? ($item['product']->current_price * 1.2);
              $totalSaved += ($op - $item['product']->current_price) * $item['qty'];
            }
            $grandTotal = $total + $delivery;
          @endphp

          <div class="summary-row">
            <span class="label">Price ({{ count($products) }} items)</span>
            <span class="value">₹{{ number_format($total + $totalSaved) }}</span>
          </div>
          @if($totalSaved > 0)
          <div class="summary-row">
            <span class="label">Discount</span>
            <span class="value green">− ₹{{ number_format($totalSaved) }}</span>
          </div>
          @endif
          <div class="summary-row">
            <span class="label">Delivery Charges</span>
            @if($delivery == 0)
              <span class="value green">FREE 🎉</span>
            @else
              <span class="value">₹{{ $delivery }}</span>
            @endif
          </div>
          <div class="summary-row" id="couponRow" style="display:none">
            <span class="label">Coupon Discount</span>
            <span class="value green" id="couponSave">−₹0</span>
          </div>
          <div class="summary-divider"></div>
          <div class="summary-total-row">
            <span>Total Amount</span>
            <span id="grandTotalDisplay">₹{{ number_format($grandTotal) }}</span>
          </div>

          @if($totalSaved > 0 || $delivery == 0)
          <div class="you-save-banner">
            🎉 You are saving <strong>₹{{ number_format($totalSaved + ($delivery == 0 ? 40 : 0)) }}</strong> on this order!
          </div>
          @endif

          @auth
            <a href="{{ route('checkout.index') }}" class="btn-checkout">
              Proceed to Checkout <span class="arrow">→</span>
            </a>
          @else
            <a href="{{ route('login') }}" class="btn-checkout">
              Login to Checkout <span class="arrow">→</span>
            </a>
          @endauth

          <a href="{{ route('shop') }}" class="continue-shop">
            ← Continue Shopping
          </a>

          {{-- Security Badges --}}
          <div class="security-row">
            <div class="sec-badge"><span class="icon">🔒</span> Secure</div>
            <div class="sec-badge"><span class="icon">↩️</span> Easy Returns</div>
            <div class="sec-badge"><span class="icon">✅</span> Genuine</div>
          </div>

          {{-- Delivery Info --}}
          <div class="delivery-info">
            <div class="delivery-info-row">
              <span class="di-icon">🚀</span>
              <div><strong>Express Delivery</strong><br>Order before 12 PM — get today</div>
            </div>
            <div class="delivery-info-row">
              <span class="di-icon">↩️</span>
              <div><strong>Easy Returns</strong><br>7-day hassle-free returns</div>
            </div>
            <div class="delivery-info-row">
              <span class="di-icon">💳</span>
              <div><strong>Safe Payments</strong><br>UPI, Cards, COD accepted</div>
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>{{-- /cart-grid --}}

  {{-- Recently Viewed / Related Products — only shown if controller passes $related --}}
  @if(isset($related) && count($related) > 0)
  <div class="recently-viewed">
    <div class="rv-header">
      🛍 You May Also Like
      <a href="{{ route('shop') }}">View All →</a>
    </div>
    <div class="rv-grid">
      @foreach($related->take(6) as $rp)
    @php
  $rpImg = null;
  $rpField = $rp->thumbnail ?? $rp->image ?? null;
  if (!empty($rpField)) {
    $rpImg = asset('storage/' . $rpField);
  }
@endphp
      <a href="{{ route('product.show', $rp->slug ?? $rp->id) }}" class="rv-item">
        <div class="rv-img">
          @if($rpImg)
            <img src="{{ $rpImg }}" alt="{{ $rp->name }}"
                 style="width:100%;height:100%;object-fit:cover;border-radius:8px;"
                 onerror="this.style.display='none'">
          @else
            <span style="font-size:32px">🥦</span>
          @endif
        </div>
        <div class="rv-name">{{ Str::limit($rp->name, 28) }}</div>
        <div class="rv-price">₹{{ number_format($rp->current_price) }}</div>
        <form action="{{ route('cart.add', $rp->id) }}" method="POST" onclick="event.stopPropagation()">
          @csrf
          <button type="submit" class="rv-add">+ Add to Cart</button>
        </form>
      </a>
      @endforeach
    </div>
  </div>
  @endif

  {{-- ── EMPTY STATE ── --}}
  @else

  <div class="card" style="margin-top:8px">
    <div class="empty-state">
      <div class="empty-illustration">🛒</div>
      <div class="empty-title">Your cart is empty!</div>
      <div class="empty-sub">Looks like you haven't added anything yet.<br>Explore our fresh groceries and fill it up!</div>
      <a href="{{ route('shop') }}" class="btn-shop-now">
        🛍 Start Shopping <span>→</span>
      </a>
    </div>
  </div>

  @endif

</div>{{-- /cart-wrapper --}}

{{-- ── MOBILE STICKY CHECKOUT BAR ── --}}
@if(count($products) > 0)
<div class="mobile-checkout-bar">
  <div class="total-info">
    <div class="total-label">Total Amount</div>
    <div class="total-amount">₹{{ number_format(($total >= 499) ? $total : $total + 40) }}</div>
  </div>
  @auth
    <a href="{{ route('checkout.index') }}" class="btn-checkout-mobile">Checkout →</a>
  @else
    <a href="{{ route('login') }}" class="btn-checkout-mobile">Login →</a>
  @endauth
</div>
@endif

{{-- ── TOAST CONTAINER ── --}}
<div class="toast-container" id="toastContainer"></div>

@push('scripts')
<script>
  // ── TOAST ──
  function showToast(msg, type = 'success') {
    const icons = { success: '✅', error: '❌', info: 'ℹ️' };
    const t = document.createElement('div');
    t.className = `toast ${type}`;
    t.innerHTML = `<span>${icons[type]}</span><span>${msg}</span>`;
    document.getElementById('toastContainer').appendChild(t);
    setTimeout(() => { t.style.animation = 'slideOutToast 0.3s ease forwards'; setTimeout(() => t.remove(), 310); }, 3000);
  }

  // ── QTY CHANGE ──
  function changeQty(productId, delta) {
    const input = document.getElementById(`qty-${productId}`);
    let val = parseInt(input.value) + delta;
    val = Math.max(1, Math.min(20, val));
    input.value = val;
    updateQty(productId, val);
  }

  function updateQty(productId, qty) {
    qty = parseInt(qty);
    if (isNaN(qty) || qty < 1) return;
    const input = document.getElementById(`qty-${productId}`);
    input.value = qty;

    const csrfToken = document.querySelector('meta[name=csrf-token]')
                      ? document.querySelector('meta[name=csrf-token]').content
                      : document.querySelector('input[name=_token]')?.value ?? '';

    // Try PATCH first (standard Laravel route), fallback handled by _method
    const formData = new FormData();
    formData.append('_token', csrfToken);
    formData.append('_method', 'PATCH');
    formData.append('qty', qty);

    fetch(`/cart/update/${productId}`, {
      method: 'POST',           // Laravel reads _method=PATCH from body
      headers: { 'X-CSRF-TOKEN': csrfToken },
      body: formData
    })
    .then(r => {
      if (!r.ok) throw new Error(`HTTP ${r.status}`);
      // If response is JSON
      const ct = r.headers.get('content-type') || '';
      if (ct.includes('application/json')) return r.json();
      // If it redirects back (non-JSON controller), just reload
      return { success: true };
    })
    .then(data => {
      if (data.success !== false) {
        showToast('Quantity updated! ✅', 'success');
        setTimeout(() => location.reload(), 600);
      } else {
        showToast(data.message || 'Could not update. Try again.', 'error');
      }
    })
    .catch(err => {
      console.error('Cart update error:', err);
      // Last resort: submit a hidden form (works 100% with any Laravel route)
      const f = document.createElement('form');
      f.method = 'POST';
      f.action = `/cart/update/${productId}`;
      f.innerHTML = `<input name="_token" value="${csrfToken}">
                     <input name="_method" value="PATCH">
                     <input name="qty" value="${qty}">`;
      document.body.appendChild(f);
      f.submit();
    });
  }

  // ── REMOVE ITEM ──
  function handleRemove(e, productId) {
    e.preventDefault();
    const item = document.getElementById(`cart-item-${productId}`);
    item.classList.add('removing');
    setTimeout(() => {
      e.target.closest('form').submit();
    }, 350);
  }

  // ── SELECT ALL ──
  function toggleAll(master) {
    document.querySelectorAll('.item-check-box').forEach(cb => cb.checked = master.checked);
  }
  document.querySelectorAll('.item-check-box').forEach(cb => {
    cb.addEventListener('change', () => {
      const all = document.querySelectorAll('.item-check-box');
      const allChecked = [...all].every(c => c.checked);
      document.getElementById('selectAll').checked = allChecked;
    });
  });

  // ── COUPON ──
  function fillCoupon(code) {
    document.getElementById('couponInput').value = code;
    document.getElementById('couponInput').focus();
  }
  function applyCoupon() {
    const code = document.getElementById('couponInput').value.trim().toUpperCase();
    if (!code) { showToast('Please enter a coupon code', 'error'); return; }
    const discounts = { 'FRESH10': 10, 'SAVE20': 20, 'FIRST50': 50, 'GREEN15': 15 };
    if (discounts[code] !== undefined) {
      const d = discounts[code];
      document.getElementById('couponRow').style.display = 'flex';
      document.getElementById('couponSave').textContent = `−₹${d}`;
      showToast(`Coupon "${code}" applied! Saved ₹${d}`, 'success');
    } else {
      showToast('Invalid coupon code. Try another!', 'error');
    }
  }

  // ── SAVE FOR LATER ──
  const savedItems = [];
  function saveForLater(productId) {
    const item = document.getElementById(`cart-item-${productId}`);
    const name = item.querySelector('.item-name').textContent;
    const price = item.querySelector('.item-price-now').textContent;
    const img = item.querySelector('.item-img-wrap').innerHTML;
    savedItems.push({ productId, name, price, img });
    item.classList.add('removing');
    setTimeout(() => { item.remove(); renderSaved(); }, 350);
    showToast('Saved for later!', 'info');
    // Also remove from cart via AJAX (optional)
  }
  function renderSaved() {
    const section = document.getElementById('savedSection');
    const container = document.getElementById('savedItems');
    const count = document.getElementById('savedCount');
    if (savedItems.length === 0) { section.style.display = 'none'; return; }
    section.style.display = 'block';
    count.textContent = savedItems.length;
    container.innerHTML = savedItems.map(it => `
      <div class="saved-item">
        <div class="item-img-wrap" style="width:60px;height:60px">${it.img}</div>
        <div class="item-details">
          <div class="item-name">${it.name}</div>
          <div class="item-price-now" style="font-size:14px">${it.price}</div>
        </div>
        <button class="btn-move-to-cart" onclick="moveToCart(${it.productId})">Move to Cart</button>
      </div>
    `).join('');
  }
  function moveToCart(productId) {
    showToast('Moved to cart!', 'success');
    const idx = savedItems.findIndex(i => i.productId === productId);
    if (idx > -1) savedItems.splice(idx, 1);
    renderSaved();
    setTimeout(() => location.reload(), 800);
  }

  // ── WELCOME TOAST ──
  @if(session('success'))
    showToast('{{ session('success') }}', 'success');
  @endif
</script>
@endpush

@endsection