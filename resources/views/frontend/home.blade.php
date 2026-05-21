<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>GroceryMart — Fresh Groceries Delivered</title>
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

/* ── TOPBAR ── */
.topbar{background:#0d6e39;color:#fff;font-size:12.5px;padding:7px 0}
.topbar-inner{max-width:1320px;margin:0 auto;padding:0 20px;display:flex;justify-content:space-between;align-items:center;gap:12px}
.topbar-left{display:flex;align-items:center;gap:18px}
.topbar-left span{display:flex;align-items:center;gap:5px;opacity:.9}
.topbar-right{display:flex;align-items:center;gap:16px}
.topbar-right a{opacity:.85;transition:opacity .15s;font-size:12px}
.topbar-right a:hover{opacity:1}
.topbar-divider{opacity:.3;font-size:11px}

/* ── NAVBAR ── */
.navbar{background:#fff;border-bottom:1px solid #e8edf0;position:sticky;top:0;z-index:200;box-shadow:0 1px 6px rgba(0,0,0,.06)}
.navbar-inner{max-width:1320px;margin:0 auto;padding:0 20px;display:flex;align-items:center;gap:20px;height:68px}
.logo{display:flex;align-items:center;gap:9px;flex-shrink:0}
.logo-mark{width:36px;height:36px;background:#0d6e39;border-radius:9px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:18px;font-weight:800;letter-spacing:-1px}
.logo-text{font-size:20px;font-weight:800;color:#1a1a2e;letter-spacing:-.5px}
.logo-text span{color:#0d6e39}
.logo-sub{font-size:10px;color:#6b7280;letter-spacing:.5px;text-transform:uppercase;display:block;margin-top:-2px}

/* Search */
.search-wrap{flex:1;max-width:580px;position:relative}
.search-box{display:flex;border:1.5px solid #d1d5db;border-radius:10px;overflow:hidden;transition:border-color .2s,box-shadow .2s;background:#fff}
.search-box:focus-within{border-color:#0d6e39;box-shadow:0 0 0 3px rgba(13,110,57,.10)}
.search-cat{border:none;background:#f3f4f6;padding:0 14px;font-size:12.5px;color:#374151;border-right:1px solid #d1d5db;outline:none;min-width:110px;font-family:inherit;cursor:pointer}
.search-input{flex:1;border:none;padding:11px 14px;font-size:13.5px;outline:none;background:#fff;color:#111}
.search-input::placeholder{color:#9ca3af}
.search-btn{background:#0d6e39;border:none;color:#fff;padding:0 20px;font-size:14px;font-weight:500;transition:background .2s;display:flex;align-items:center;gap:6px;font-family:inherit}
.search-btn:hover{background:#0a5a2e}
.search-btn svg{width:16px;height:16px}

/* Nav right */
.nav-right{display:flex;align-items:center;gap:6px;margin-left:auto;flex-shrink:0}
.nav-icon-btn{display:flex;flex-direction:column;align-items:center;gap:2px;padding:7px 12px;border-radius:8px;border:none;background:none;color:#374151;font-size:11.5px;font-weight:500;transition:background .15s;position:relative;white-space:nowrap}
.nav-icon-btn:hover{background:#f3f4f6;color:#0d6e39}
.nav-icon-btn svg{width:22px;height:22px;stroke:#374151;stroke-width:1.8;fill:none}
.nav-icon-btn:hover svg{stroke:#0d6e39}
.nav-badge{position:absolute;top:5px;right:8px;background:#e53935;color:#fff;font-size:10px;font-weight:700;min-width:17px;height:17px;border-radius:50%;display:flex;align-items:center;justify-content:center;border:2px solid #fff}
.btn-cart{background:#0d6e39;color:#fff;border-radius:10px;padding:9px 18px;font-size:13px;font-weight:600;border:none;display:flex;align-items:center;gap:8px;transition:background .2s}
.btn-cart:hover{background:#0a5a2e}
.btn-cart svg{width:18px;height:18px;stroke:#fff;stroke-width:2;fill:none}
.cart-count{background:rgba(255,255,255,.25);border-radius:5px;padding:1px 6px;font-size:12px;font-weight:700}

/* ── CATEGORY NAV ── */
.cat-nav{background:#fff;border-bottom:1px solid #e8edf0}
.cat-nav-inner{max-width:1320px;margin:0 auto;padding:0 20px;display:flex;align-items:center;overflow-x:auto;scrollbar-width:none;gap:0}
.cat-nav-inner::-webkit-scrollbar{display:none}
.cat-link{display:flex;align-items:center;gap:6px;padding:11px 16px;font-size:13px;font-weight:500;color:#4b5563;white-space:nowrap;border-bottom:2.5px solid transparent;transition:all .15s}
.cat-link:hover,.cat-link.active{color:#0d6e39;border-bottom-color:#0d6e39}
.cat-link img,.cat-link-icon{font-size:16px}

/* ── LAYOUT ── */
.page-wrap{max-width:1320px;margin:0 auto;padding:0 20px}

/* ── HERO ── */
.hero-section{padding:22px 0 0}
.hero-grid{display:grid;grid-template-columns:240px 1fr 280px;gap:16px;align-items:start}

/* Sidebar categories */
.sidebar-cats{background:#fff;border:1px solid #e8edf0;border-radius:12px;overflow:hidden}
.sidebar-cat-item{display:flex;align-items:center;justify-content:space-between;padding:11px 16px;font-size:13px;color:#374151;border-bottom:1px solid #f3f4f6;cursor:pointer;transition:background .15s;gap:10px}
.sidebar-cat-item:last-child{border-bottom:none}
.sidebar-cat-item:hover{background:#f0faf4;color:#0d6e39}
.sidebar-cat-left{display:flex;align-items:center;gap:10px}
.sidebar-cat-icon{width:32px;height:32px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:17px;flex-shrink:0}
.sidebar-cat-name{font-weight:500;font-size:13px}
.sidebar-chevron{color:#9ca3af;font-size:12px}

/* Main slider */
.hero-slider{border-radius:14px;overflow:hidden;position:relative;min-height:360px}
.slide{position:absolute;inset:0;opacity:0;transition:opacity .6s;padding:48px 52px;display:flex;flex-direction:column;justify-content:center}
.slide.active{opacity:1;position:relative}
.slide-1{background:linear-gradient(120deg,#0a3d20 0%,#1a7a4a 55%,#2d9e62 100%)}
.slide-2{background:linear-gradient(120deg,#7c2d12 0%,#c2410c 55%,#ea580c 100%)}
.slide-3{background:linear-gradient(120deg,#1e3a5f 0%,#1d4ed8 55%,#3b82f6 100%)}
.slide-eyebrow{display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,.15);backdrop-filter:blur(8px);color:rgba(255,255,255,.92);font-size:12px;font-weight:500;padding:5px 12px;border-radius:20px;margin-bottom:14px;width:fit-content;letter-spacing:.3px}
.slide-title{font-size:42px;font-weight:800;color:#fff;line-height:1.1;letter-spacing:-1px;margin-bottom:12px}
.slide-title em{color:#fcd34d;font-style:normal}
.slide-desc{font-size:14.5px;color:rgba(255,255,255,.82);line-height:1.6;margin-bottom:24px;max-width:360px}
.slide-actions{display:flex;gap:10px;align-items:center}
.btn-white{background:#fff;color:#0d6e39;padding:12px 26px;border-radius:8px;font-size:13.5px;font-weight:700;border:none;transition:transform .15s,box-shadow .15s;display:inline-flex;align-items:center;gap:7px}
.btn-white:hover{transform:translateY(-1px);box-shadow:0 6px 20px rgba(0,0,0,.15)}
.btn-ghost{background:rgba(255,255,255,.15);color:#fff;padding:12px 22px;border-radius:8px;font-size:13.5px;font-weight:500;border:1px solid rgba(255,255,255,.3);backdrop-filter:blur(4px);transition:background .2s;display:inline-flex;align-items:center;gap:7px}
.btn-ghost:hover{background:rgba(255,255,255,.25)}
.slide-img{position:absolute;right:40px;top:50%;transform:translateY(-50%);font-size:150px;line-height:1;filter:drop-shadow(0 20px 40px rgba(0,0,0,.2));animation:float 3.5s ease-in-out infinite}
.slide-stats{display:flex;gap:24px;margin-top:24px;padding-top:20px;border-top:1px solid rgba(255,255,255,.15)}
.slide-stat-n{font-size:20px;font-weight:800;color:#fcd34d}
.slide-stat-l{font-size:11.5px;color:rgba(255,255,255,.65);margin-top:1px}
.slider-dots{position:absolute;bottom:16px;left:50%;transform:translateX(-50%);display:flex;gap:6px;z-index:10}
.dot{width:7px;height:7px;border-radius:50%;background:rgba(255,255,255,.4);cursor:pointer;transition:all .2s}
.dot.active{width:22px;border-radius:4px;background:#fff}
@keyframes float{0%,100%{transform:translateY(-50%)}50%{transform:translateY(calc(-50% - 10px))}}

/* Right mini banners */
.hero-right{display:flex;flex-direction:column;gap:14px}
.mini-card{border-radius:12px;padding:20px 18px;position:relative;overflow:hidden;cursor:pointer;transition:transform .2s,box-shadow .2s;min-height:110px;display:flex;flex-direction:column;justify-content:flex-end}
.mini-card:hover{transform:translateY(-3px);box-shadow:0 10px 30px rgba(0,0,0,.12)}
.mini-c1{background:linear-gradient(135deg,#fef3c7 0%,#fde68a 100%)}
.mini-c2{background:linear-gradient(135deg,#dbeafe 0%,#bfdbfe 100%)}
.mini-c3{background:linear-gradient(135deg,#fce7f3 0%,#fbcfe8 100%)}
.mini-emoji{position:absolute;right:14px;top:10px;font-size:46px;opacity:.85}
.mini-tag{font-size:10.5px;font-weight:600;color:#6b7280;text-transform:uppercase;letter-spacing:.5px;margin-bottom:3px}
.mini-title{font-size:15px;font-weight:700;color:#1a1a2e;line-height:1.25}
.mini-sub{font-size:12px;color:#6b7280;margin-top:3px}
.mini-cta{font-size:12px;font-weight:600;color:#0d6e39;margin-top:8px;display:flex;align-items:center;gap:3px}

/* ── FEATURES BAR ── */
.features-bar{background:#fff;border-top:1px solid #e8edf0;border-bottom:1px solid #e8edf0;margin-top:22px}
.features-bar-inner{max-width:1320px;margin:0 auto;padding:0 20px;display:grid;grid-template-columns:repeat(4,1fr)}
.feat-item{display:flex;align-items:center;gap:13px;padding:16px 20px;border-right:1px solid #e8edf0;transition:background .15s}
.feat-item:last-child{border-right:none}
.feat-item:hover{background:#f0faf4}
.feat-icon{width:40px;height:40px;background:#f0faf4;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:19px;flex-shrink:0}
.feat-title{font-size:13.5px;font-weight:600;color:#111}
.feat-sub{font-size:12px;color:#6b7280;margin-top:1px}

/* ── SECTION ── */
.section{padding:36px 0 0}
.sec-header{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:18px}
.sec-title{font-size:22px;font-weight:800;color:#1a1a2e;letter-spacing:-.4px}
.sec-title span{color:#0d6e39}
.sec-sub{font-size:13px;color:#6b7280;margin-top:3px}
.sec-view-all{display:flex;align-items:center;gap:4px;font-size:13px;font-weight:600;color:#0d6e39;transition:gap .15s}
.sec-view-all:hover{gap:8px}

/* Tabs */
.tabs{display:flex;gap:6px;margin-bottom:20px;border-bottom:1.5px solid #e8edf0;padding-bottom:0}
.tab-btn{padding:8px 18px;border-radius:8px 8px 0 0;border:none;background:none;font-size:13px;font-weight:500;color:#6b7280;cursor:pointer;transition:all .15s;border-bottom:2.5px solid transparent;margin-bottom:-1.5px}
.tab-btn.active,.tab-btn:hover{color:#0d6e39;border-bottom-color:#0d6e39;font-weight:600}

/* ── CATEGORIES ── */
.cat-scroll{display:grid;grid-template-columns:repeat(10,1fr);gap:12px}
.cat-box{display:flex;flex-direction:column;align-items:center;gap:8px;padding:16px 8px;background:#fff;border:1.5px solid #e8edf0;border-radius:12px;cursor:pointer;transition:all .2s}
.cat-box:hover{border-color:#0d6e39;background:#f0faf4;transform:translateY(-3px);box-shadow:0 6px 20px rgba(13,110,57,.10)}
.cat-box-icon{width:52px;height:52px;border-radius:50%;background:#f3f4f6;display:flex;align-items:center;justify-content:center;font-size:24px;transition:background .2s}
.cat-box:hover .cat-box-icon{background:#0d6e39}
.cat-box-name{font-size:12px;font-weight:600;color:#374151;text-align:center;line-height:1.3}
.cat-box-count{font-size:11px;color:#9ca3af}

/* ── PRODUCT CARDS ── */
.products-row{display:grid;grid-template-columns:repeat(6,1fr);gap:14px}
.prod-card{background:#fff;border:1.5px solid #e8edf0;border-radius:12px;overflow:hidden;transition:all .2s;cursor:pointer;position:relative}
.prod-card:hover{transform:translateY(-4px);box-shadow:0 12px 32px rgba(0,0,0,.09);border-color:#c8e6c9}
.prod-badge{position:absolute;top:10px;left:10px;font-size:10.5px;font-weight:700;padding:3px 9px;border-radius:5px;z-index:2}
.badge-sale{background:#ff3b30;color:#fff}
.badge-new{background:#0d6e39;color:#fff}
.badge-hot{background:#ff6b00;color:#fff}
.prod-wish{position:absolute;top:10px;right:10px;width:30px;height:30px;background:#fff;border:1px solid #e8edf0;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:14px;z-index:2;box-shadow:0 1px 4px rgba(0,0,0,.08);transition:all .15s;cursor:pointer}
.prod-wish:hover{background:#fff0f0;border-color:#fca5a5}
.prod-img{height:160px;background:#f8fafc;display:flex;align-items:center;justify-content:center;font-size:72px;transition:transform .3s}
.prod-card:hover .prod-img{transform:scale(1.06)}
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
.btn-add{width:34px;height:34px;background:#0d6e39;border:none;border-radius:8px;color:#fff;font-size:20px;font-weight:300;display:flex;align-items:center;justify-content:center;transition:all .15s;flex-shrink:0}
.btn-add:hover{background:#0a5a2e;transform:scale(1.08)}
.btn-add.added{background:#e8f5e9;color:#0d6e39;font-size:14px}

/* ── OFFER BANNERS ── */
.offer-grid{display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px}
.offer-banner{border-radius:14px;padding:28px 30px;display:flex;align-items:center;justify-content:space-between;position:relative;overflow:hidden;cursor:pointer;transition:transform .2s,box-shadow .2s}
.offer-banner:hover{transform:translateY(-3px);box-shadow:0 16px 40px rgba(0,0,0,.12)}
.ob-1{background:linear-gradient(135deg,#064e29 0%,#0d6e39 100%)}
.ob-2{background:linear-gradient(135deg,#7c2d12 0%,#c2410c 100%)}
.ob-3{background:linear-gradient(135deg,#4c1d95 0%,#7c3aed 100%)}
.ob-glow{position:absolute;width:180px;height:180px;border-radius:50%;background:rgba(255,255,255,.07);right:-30px;top:-40px}
.ob-glow2{position:absolute;width:110px;height:110px;border-radius:50%;background:rgba(255,255,255,.05);right:60px;bottom:-40px}
.ob-text{z-index:1}
.ob-eyebrow{font-size:11px;color:rgba(255,255,255,.65);font-weight:500;text-transform:uppercase;letter-spacing:.7px;margin-bottom:6px}
.ob-title{font-size:20px;font-weight:800;color:#fff;line-height:1.2;margin-bottom:6px}
.ob-sub{font-size:12.5px;color:rgba(255,255,255,.75);margin-bottom:16px}
.ob-btn{display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,.18);backdrop-filter:blur(6px);color:#fff;padding:9px 18px;border-radius:7px;font-size:12.5px;font-weight:600;border:1px solid rgba(255,255,255,.25);transition:background .2s}
.ob-btn:hover{background:rgba(255,255,255,.28)}
.ob-emoji{font-size:72px;z-index:1;flex-shrink:0;line-height:1;filter:drop-shadow(0 4px 12px rgba(0,0,0,.15))}

/* ── BESTSELLERS horizontal scroll ── */
.bs-row{display:grid;grid-template-columns:repeat(5,1fr);gap:14px}

/* ── REVIEWS ── */
.reviews-bg{background:#fff;border-top:1px solid #e8edf0;margin-top:40px;padding:40px 0}
.reviews-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-top:20px}
.rev-card{background:#f8fafc;border:1.5px solid #e8edf0;border-radius:12px;padding:20px;transition:box-shadow .2s}
.rev-card:hover{box-shadow:0 8px 24px rgba(0,0,0,.07)}
.rev-top{display:flex;align-items:center;gap:10px;margin-bottom:12px}
.rev-avatar{width:40px;height:40px;border-radius:50%;background:#0d6e39;color:#fff;font-size:14px;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.rev-name{font-size:13.5px;font-weight:600}
.rev-date{font-size:11.5px;color:#9ca3af;margin-top:1px}
.rev-stars{color:#f59e0b;font-size:13px;margin-bottom:8px;letter-spacing:-.5px}
.rev-text{font-size:13px;color:#4b5563;line-height:1.65}
.rev-prod{font-size:12px;color:#0d6e39;font-weight:600;margin-top:10px;display:flex;align-items:center;gap:4px}

/* ── NEWSLETTER ── */
.newsletter{background:linear-gradient(120deg,#064e29 0%,#0d6e39 60%,#15803d 100%);padding:52px 20px;margin-top:40px}
.nl-inner{max-width:580px;margin:0 auto;text-align:center}
.nl-icon{font-size:40px;margin-bottom:16px}
.nl-title{font-size:28px;font-weight:800;color:#fff;margin-bottom:8px}
.nl-sub{font-size:14px;color:rgba(255,255,255,.75);margin-bottom:28px}
.nl-form{display:flex;gap:0;border-radius:10px;overflow:hidden;box-shadow:0 8px 32px rgba(0,0,0,.15)}
.nl-input{flex:1;border:none;padding:14px 20px;font-size:13.5px;outline:none;font-family:inherit}
.nl-btn{background:#fcd34d;color:#1a1a2e;border:none;padding:14px 28px;font-size:13.5px;font-weight:700;cursor:pointer;transition:background .2s;white-space:nowrap;font-family:inherit}
.nl-btn:hover{background:#fbbf24}

/* ── FOOTER ── */
footer{background:#0f1c14;color:rgba(255,255,255,.7);padding:52px 0 0}
.footer-inner{max-width:1320px;margin:0 auto;padding:0 20px}
.footer-grid{display:grid;grid-template-columns:2.2fr 1fr 1fr 1fr 1.3fr;gap:40px;margin-bottom:40px}
.f-logo{font-size:22px;font-weight:800;color:#fff;margin-bottom:12px;letter-spacing:-.4px}
.f-logo span{color:#4ade80}
.f-desc{font-size:13px;line-height:1.75;margin-bottom:18px;max-width:240px}
.f-socials{display:flex;gap:8px}
.f-social{width:34px;height:34px;background:rgba(255,255,255,.08);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:14px;transition:background .2s;cursor:pointer}
.f-social:hover{background:#0d6e39}
.f-col h5{font-size:13px;font-weight:700;color:#fff;margin-bottom:16px;text-transform:uppercase;letter-spacing:.5px}
.f-col ul li{margin-bottom:9px}
.f-col ul li a{font-size:13px;transition:color .15s}
.f-col ul li a:hover{color:#4ade80}
.f-app-title{font-size:13px;font-weight:600;color:#fff;margin-bottom:10px}
.f-app-btns{display:flex;flex-direction:column;gap:8px}
.f-app-btn{display:flex;align-items:center;gap:10px;background:rgba(255,255,255,.08);border-radius:9px;padding:10px 14px;transition:background .2s;cursor:pointer}
.f-app-btn:hover{background:rgba(255,255,255,.14)}
.f-app-icon{font-size:22px}
.f-app-lbl{font-size:10px;color:rgba(255,255,255,.55)}
.f-app-name{font-size:13px;font-weight:600;color:#fff}
.footer-bottom{border-top:1px solid rgba(255,255,255,.07);padding:20px 0;display:flex;justify-content:space-between;align-items:center}
.f-copy{font-size:12.5px}
.f-payments{display:flex;align-items:center;gap:6px}
.pay-tag{font-size:11px;margin-right:6px}
.pay-chip{background:rgba(255,255,255,.1);color:rgba(255,255,255,.8);font-size:11.5px;font-weight:600;padding:4px 11px;border-radius:5px}

/* ── WHATSAPP ── */
.wa-btn{position:fixed;bottom:24px;right:24px;width:54px;height:54px;background:#25d366;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:26px;z-index:999;box-shadow:0 4px 20px rgba(37,211,102,.45);transition:transform .2s,box-shadow .2s;text-decoration:none}
.wa-btn:hover{transform:scale(1.12);box-shadow:0 8px 30px rgba(37,211,102,.60)}
.wa-pulse{position:absolute;inset:0;border-radius:50%;background:#25d366;animation:waPulse 2.2s ease infinite;z-index:-1}
@keyframes waPulse{0%{transform:scale(1);opacity:.6}100%{transform:scale(1.6);opacity:0}}

/* ── BACK TO TOP ── */
.back-top{position:fixed;bottom:88px;right:26px;width:40px;height:40px;background:#fff;border:1.5px solid #e8edf0;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:16px;cursor:pointer;box-shadow:var(--shadow-sm);transition:all .2s;z-index:999;color:#374151}
.back-top:hover{background:#0d6e39;color:#fff;border-color:#0d6e39}

/* ── UTILITY ── */
.pb-40{padding-bottom:40px}

/* ════════════════════════════════════════════
   MOBILE MENU
════════════════════════════════════════════ */
.mob-menu-btn{display:none;flex-direction:column;justify-content:center;gap:5px;width:40px;height:40px;background:none;border:1.5px solid #e8edf0;border-radius:8px;padding:8px;cursor:pointer;flex-shrink:0}
.mob-menu-btn span{display:block;height:2px;background:#374151;border-radius:2px;transition:all .3s}
.mob-menu-btn.open span:nth-child(1){transform:translateY(7px) rotate(45deg)}
.mob-menu-btn.open span:nth-child(2){opacity:0}
.mob-menu-btn.open span:nth-child(3){transform:translateY(-7px) rotate(-45deg)}

.mob-drawer{display:none;position:fixed;inset:0;z-index:500}
.mob-overlay{position:absolute;inset:0;background:rgba(0,0,0,.45);backdrop-filter:blur(2px)}
.mob-panel{position:absolute;left:0;top:0;bottom:0;width:300px;background:#fff;overflow-y:auto;transform:translateX(-100%);transition:transform .3s ease;padding:0 0 80px}
.mob-drawer.open .mob-panel{transform:translateX(0)}
.mob-drawer.open{display:block}
.mob-panel-head{display:flex;align-items:center;justify-content:space-between;padding:16px 18px;border-bottom:1px solid #e8edf0;background:#0d6e39}
.mob-panel-logo{font-size:18px;font-weight:800;color:#fff}
.mob-panel-logo span{color:#fcd34d}
.mob-close{background:rgba(255,255,255,.15);border:none;color:#fff;width:32px;height:32px;border-radius:8px;font-size:18px;cursor:pointer;display:flex;align-items:center;justify-content:center}
.mob-panel-search{padding:14px 18px;border-bottom:1px solid #f3f4f6}
.mob-panel-search input{width:100%;padding:10px 14px;border:1.5px solid #d1d5db;border-radius:8px;font-size:13.5px;outline:none;font-family:inherit}
.mob-panel-search input:focus{border-color:#0d6e39}
.mob-nav-section{padding:8px 0}
.mob-nav-title{font-size:11px;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.6px;padding:8px 18px 4px}
.mob-nav-link{display:flex;align-items:center;gap:12px;padding:12px 18px;font-size:14px;color:#374151;font-weight:500;border-bottom:1px solid #f9fafb;transition:background .15s}
.mob-nav-link:hover{background:#f0faf4;color:#0d6e39}
.mob-nav-link .mob-icon{font-size:20px;width:28px;text-align:center}
.mob-nav-link .mob-arrow{margin-left:auto;color:#9ca3af;font-size:12px}
.mob-auth-btns{display:flex;gap:10px;padding:16px 18px}
.mob-btn-login{flex:1;padding:11px;border:1.5px solid #0d6e39;border-radius:8px;font-size:13.5px;font-weight:600;color:#0d6e39;background:none;text-align:center;cursor:pointer}
.mob-btn-reg{flex:1;padding:11px;background:#0d6e39;border:none;border-radius:8px;font-size:13.5px;font-weight:600;color:#fff;text-align:center;cursor:pointer}

/* Mobile bottom nav */
.mob-bottom-nav{display:none;position:fixed;bottom:0;left:0;right:0;background:#fff;border-top:1px solid #e8edf0;z-index:400;padding:6px 0 env(safe-area-inset-bottom)}
.mob-bottom-nav-inner{display:flex;justify-content:space-around}
.mob-nav-item{display:flex;flex-direction:column;align-items:center;gap:3px;padding:6px 16px;font-size:11px;font-weight:500;color:#6b7280;cursor:pointer;position:relative;min-width:56px;transition:color .15s}
.mob-nav-item.active,.mob-nav-item:hover{color:#0d6e39}
.mob-nav-item svg{width:22px;height:22px;stroke:currentColor;stroke-width:1.8;fill:none}
.mob-nav-badge{position:absolute;top:4px;right:10px;background:#e53935;color:#fff;font-size:9px;font-weight:700;min-width:15px;height:15px;border-radius:50%;display:flex;align-items:center;justify-content:center;border:2px solid #fff}

/* ════════════════════════════════════════════
   TABLET — max 1024px
════════════════════════════════════════════ */
@media(max-width:1024px){
  .topbar-left span:last-of-type{display:none}
  .hero-grid{grid-template-columns:1fr 240px}
  .sidebar-cats{display:none}
  .hero-right{display:grid;grid-template-columns:1fr 1fr;grid-template-rows:auto}
  .mini-card:last-child{display:none}
  .cat-scroll{grid-template-columns:repeat(5,1fr)}
  .products-row{grid-template-columns:repeat(4,1fr)}
  .offer-grid{grid-template-columns:1fr 1fr}
  .offer-banner:last-child{display:none}
  .reviews-grid{grid-template-columns:repeat(2,1fr)}
  .footer-grid{grid-template-columns:1fr 1fr 1fr;gap:28px}
  .footer-grid>div:last-child{grid-column:1/-1}
  .f-app-btns{flex-direction:row}
}

/* ════════════════════════════════════════════
   MOBILE — max 768px
════════════════════════════════════════════ */
@media(max-width:768px){
  html{font-size:14px}

  /* Topbar hidden on mobile */
  .topbar{display:none}

  /* Navbar mobile */
  .navbar-inner{height:58px;gap:10px;padding:0 14px}
  .logo-sub{display:none}
  .logo-text{font-size:17px}
  .search-wrap{display:none}
  .nav-icon-btn{display:none}
  .btn-cart{display:none}
  .mob-menu-btn{display:flex}
  /* Show cart icon only in topbar area */
  .mob-cart-icon{display:flex;align-items:center;justify-content:center;position:relative;width:40px;height:40px;border:1.5px solid #e8edf0;border-radius:8px;background:none;cursor:pointer;flex-shrink:0}
  .mob-cart-icon svg{width:20px;height:20px;stroke:#374151;stroke-width:1.8;fill:none}
  .mob-cart-icon .nav-badge{top:4px;right:4px}

  /* Category nav mobile scroll */
  .cat-nav-inner{padding:0 14px}
  .cat-link{padding:9px 12px;font-size:12.5px}

  /* Page wrap */
  .page-wrap{padding:0 14px}

  /* Hero — full width slider only */
  .hero-section{padding:14px 0 0}
  .hero-grid{display:block}
  .sidebar-cats{display:none}
  .hero-right{display:none}
  .hero-slider{min-height:240px;border-radius:12px}
  .slide{padding:24px 22px}
  .slide-title{font-size:26px;letter-spacing:-.5px}
  .slide-desc{font-size:13px;margin-bottom:16px;max-width:240px}
  .slide-img{font-size:90px;right:16px}
  .slide-stats{gap:16px;margin-top:16px;padding-top:14px}
  .slide-stat-n{font-size:17px}
  .btn-white,.btn-ghost{padding:10px 18px;font-size:13px}

  /* Mini banners below slider on mobile */
  .hero-right-mobile{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-top:12px}
  .mini-card{min-height:90px;padding:14px}
  .mini-emoji{font-size:36px;right:10px;top:8px}
  .mini-title{font-size:13px}

  /* Features bar — 2 col */
  .features-bar-inner{grid-template-columns:1fr 1fr}
  .feat-item{padding:12px 14px;border-right:none;border-bottom:1px solid #e8edf0}
  .feat-item:nth-child(odd){border-right:1px solid #e8edf0}
  .feat-item:nth-last-child(-n+2){border-bottom:none}

  /* Section */
  .section{padding:24px 0 0}
  .sec-title{font-size:19px}
  .sec-header{margin-bottom:14px}

  /* Categories — 4 col scroll */
  .cat-scroll{grid-template-columns:repeat(4,1fr);gap:8px}
  .cat-box{padding:12px 6px}
  .cat-box-icon{width:44px;height:44px;font-size:20px}
  .cat-box-name{font-size:11px}
  .cat-box-count{display:none}

  /* Products — 2 col */
  .products-row{grid-template-columns:repeat(2,1fr);gap:10px}
  .prod-img{height:130px;font-size:58px}
  .prod-body{padding:10px}
  .prod-name{font-size:13px}
  .prod-price{font-size:15px}

  /* Tabs scroll */
  .tabs{overflow-x:auto;scrollbar-width:none;padding-bottom:0;flex-wrap:nowrap}
  .tabs::-webkit-scrollbar{display:none}
  .tab-btn{white-space:nowrap;font-size:12.5px;padding:7px 14px}

  /* Offers — 1 col */
  .offer-grid{grid-template-columns:1fr}
  .offer-banner{padding:22px 20px;min-height:130px}
  .ob-title{font-size:18px}
  .ob-emoji{font-size:56px}

  /* Reviews — 1 col */
  .reviews-bg{padding:28px 0}
  .reviews-grid{grid-template-columns:1fr;gap:12px}

  /* Newsletter */
  .newsletter{padding:36px 16px}
  .nl-title{font-size:22px}
  .nl-form{flex-direction:column;border-radius:10px;overflow:visible;gap:10px;box-shadow:none}
  .nl-input{border-radius:10px;border:none;box-shadow:0 2px 12px rgba(0,0,0,.1)}
  .nl-btn{border-radius:10px;padding:13px;font-size:14px}

  /* Footer — single col */
  .footer-grid{grid-template-columns:1fr;gap:28px}
  .f-desc{max-width:100%}
  .f-app-btns{flex-direction:row}
  .footer-bottom{flex-direction:column;gap:12px;text-align:center}
  .f-payments{flex-wrap:wrap;justify-content:center}

  /* Hide back-to-top (mobile has bottom nav) */
  .back-top{bottom:80px;right:16px}
  .wa-btn{bottom:80px;right:16px;width:48px;height:48px;font-size:22px}

  /* Show mobile bottom nav */
  .mob-bottom-nav{display:block}

  /* Body padding for bottom nav */
  body{padding-bottom:62px}
}

/* ════════════════════════════════════════════
   SMALL MOBILE — max 480px
════════════════════════════════════════════ */
@media(max-width:480px){
  .cat-scroll{grid-template-columns:repeat(4,1fr);gap:7px}
  .products-row{grid-template-columns:repeat(2,1fr);gap:8px}
  .slide-title{font-size:22px}
  .slide-img{display:none}
  .slide-desc{max-width:100%}
  .hero-right-mobile{grid-template-columns:1fr}
  .offer-grid{grid-template-columns:1fr}
  .reviews-grid{grid-template-columns:1fr}
  .features-bar-inner{grid-template-columns:1fr 1fr}
}

/* ════════════════════════════════════════════
   LARGE DESKTOP — min 1400px
════════════════════════════════════════════ */
@media(min-width:1400px){
  .products-row{grid-template-columns:repeat(6,1fr)}
  .cat-scroll{grid-template-columns:repeat(10,1fr)}
}
</style>
</head>
<body>

<!-- TOPBAR -->
<div class="topbar">
  <div class="topbar-inner">
    <div class="topbar-left">
      <span>🚚 Free delivery on orders above ₹499</span>
      <span class="topbar-divider">|</span>
      <span>⚡ 60-minute express delivery available</span>
    </div>
    <div class="topbar-right">
      <a href="#">📞 +91 98765-43210</a>
      <span class="topbar-divider">|</span>
      <a href="#">Track Order</a>
      <span class="topbar-divider">|</span>
      <a href="/login">Login</a>
      <span class="topbar-divider">|</span>
      <a href="/register">Register</a>
    </div>
  </div>
</div>

<!-- NAVBAR -->
<nav class="navbar">
  <div class="navbar-inner">
    <a href="/" class="logo">
      <div class="logo-mark">G</div>
      <div>
        <div class="logo-text">Grocery<span>Mart</span></div>
        <span class="logo-sub">Fresh • Fast • Reliable</span>
      </div>
    </a>

    <div class="search-wrap">
      <div class="search-box">
        <select class="search-cat">
          <option>All Categories</option>
          <option>Vegetables</option>
          <option>Fruits</option>
          <option>Dairy & Eggs</option>
          <option>Meat & Fish</option>
          <option>Bakery</option>
          <option>Beverages</option>
          <option>Snacks</option>
        </select>
        <input class="search-input" type="text" placeholder="Search for milk, vegetables, fruits...">
        <button class="search-btn">
          <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
          Search
        </button>
      </div>
    </div>

    <div class="nav-right">
      <button class="nav-icon-btn" onclick="location.href='/my-account'">
        <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        Account
      </button>
      <button class="nav-icon-btn" onclick="location.href='/wishlist'">
        <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
        Wishlist
        <span class="nav-badge">3</span>
      </button>
      <button class="btn-cart" onclick="location.href='/cart'">
        <svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
        My Cart
        <span class="cart-count">5</span>
      </button>
    </div>
    <!-- Mobile only -->
    <button class="mob-cart-icon" onclick="location.href='/cart'">
      <svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
      <span class="nav-badge">5</span>
    </button>
    <button class="mob-menu-btn" id="menuBtn" onclick="openMenu()">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>

<!-- CATEGORY NAV BAR -->
<div class="cat-nav">
  <div class="cat-nav-inner">
    <a href="/" class="cat-link active">🏠 Home</a>
    <a href="#" class="cat-link">🥬 Vegetables</a>
    <a href="#" class="cat-link">🍎 Fruits</a>
    <a href="#" class="cat-link">🥛 Dairy & Eggs</a>
    <a href="#" class="cat-link">🍗 Meat & Fish</a>
    <a href="#" class="cat-link">🧁 Bakery</a>
    <a href="#" class="cat-link">🧃 Beverages</a>
    <a href="#" class="cat-link">🍜 Instant Food</a>
    <a href="#" class="cat-link">🧴 Personal Care</a>
    <a href="#" class="cat-link">🏠 Household</a>
    <a href="#" class="cat-link">🐾 Pet Care</a>
    <a href="#" class="cat-link" style="color:#e53935;border-bottom-color:#e53935">🔥 Offers</a>
  </div>
</div>

<!-- HERO -->
<div class="page-wrap">
  <div class="hero-section">
    <div class="hero-grid">

      <!-- Sidebar -->
      <div class="sidebar-cats">
        <div class="sidebar-cat-item"><div class="sidebar-cat-left"><div class="sidebar-cat-icon" style="background:#f0faf4">🥬</div><span class="sidebar-cat-name">Vegetables</span></div><span class="sidebar-chevron">›</span></div>
        <div class="sidebar-cat-item"><div class="sidebar-cat-left"><div class="sidebar-cat-icon" style="background:#fff8f0">🍎</div><span class="sidebar-cat-name">Fresh Fruits</span></div><span class="sidebar-chevron">›</span></div>
        <div class="sidebar-cat-item"><div class="sidebar-cat-left"><div class="sidebar-cat-icon" style="background:#f0f8ff">🥛</div><span class="sidebar-cat-name">Dairy & Eggs</span></div><span class="sidebar-chevron">›</span></div>
        <div class="sidebar-cat-item"><div class="sidebar-cat-left"><div class="sidebar-cat-icon" style="background:#fff0f0">🍗</div><span class="sidebar-cat-name">Meat & Fish</span></div><span class="sidebar-chevron">›</span></div>
        <div class="sidebar-cat-item"><div class="sidebar-cat-left"><div class="sidebar-cat-icon" style="background:#fffbf0">🧁</div><span class="sidebar-cat-name">Bakery</span></div><span class="sidebar-chevron">›</span></div>
        <div class="sidebar-cat-item"><div class="sidebar-cat-left"><div class="sidebar-cat-icon" style="background:#f0f0ff">🧃</div><span class="sidebar-cat-name">Beverages</span></div><span class="sidebar-chevron">›</span></div>
        <div class="sidebar-cat-item"><div class="sidebar-cat-left"><div class="sidebar-cat-icon" style="background:#fff0fa">🍜</div><span class="sidebar-cat-name">Instant Food</span></div><span class="sidebar-chevron">›</span></div>
        <div class="sidebar-cat-item"><div class="sidebar-cat-left"><div class="sidebar-cat-icon" style="background:#f5f0ff">🧴</div><span class="sidebar-cat-name">Personal Care</span></div><span class="sidebar-chevron">›</span></div>
        <div class="sidebar-cat-item"><div class="sidebar-cat-left"><div class="sidebar-cat-icon" style="background:#f0fff8">🏠</div><span class="sidebar-cat-name">Household</span></div><span class="sidebar-chevron">›</span></div>
        <div class="sidebar-cat-item"><div class="sidebar-cat-left"><div class="sidebar-cat-icon" style="background:#fff8f0">🐾</div><span class="sidebar-cat-name">Pet Care</span></div><span class="sidebar-chevron">›</span></div>
      </div>

      <!-- Main Slider -->
      <div class="hero-slider" id="heroSlider">
        <div class="slide slide-1 active" id="slide0">
          <div class="slide-eyebrow">🌿 100% Organic & Farm Fresh</div>
          <div class="slide-title">Fresh Groceries<br><em>Delivered in 60 min</em></div>
          <div class="slide-desc">Order fresh vegetables, fruits, dairy & daily essentials from the comfort of your home.</div>
          <div class="slide-actions">
            <a href="/shop" class="btn-white">🛍️ Shop Now</a>
            <a href="/offers" class="btn-ghost">View Offers →</a>
          </div>
          <div class="slide-stats">
            <div><div class="slide-stat-n">10K+</div><div class="slide-stat-l">Happy Customers</div></div>
            <div><div class="slide-stat-n">500+</div><div class="slide-stat-l">Fresh Products</div></div>
            <div><div class="slide-stat-n">60 min</div><div class="slide-stat-l">Express Delivery</div></div>
          </div>
          <div class="slide-img">🥗</div>
        </div>
        <div class="slide slide-2" id="slide1">
          <div class="slide-eyebrow">🔥 Today's Special Deal</div>
          <div class="slide-title">Flat 30% OFF<br><em>on All Fruits</em></div>
          <div class="slide-desc">Freshly sourced seasonal fruits delivered to your door every morning.</div>
          <div class="slide-actions">
            <a href="/category/fruits" class="btn-white">🍎 Buy Fruits</a>
            <a href="/offers" class="btn-ghost">All Offers →</a>
          </div>
          <div class="slide-stats">
            <div><div class="slide-stat-n">₹49</div><div class="slide-stat-l">Starting from</div></div>
            <div><div class="slide-stat-n">30%</div><div class="slide-stat-l">Discount today</div></div>
            <div><div class="slide-stat-n">Free</div><div class="slide-stat-l">Delivery above ₹499</div></div>
          </div>
          <div class="slide-img">🍊</div>
        </div>
        <div class="slide slide-3" id="slide2">
          <div class="slide-eyebrow">🎁 New Customer Offer</div>
          <div class="slide-title">First Order<br><em>Flat ₹100 OFF</em></div>
          <div class="slide-desc">Use code WELCOME100. Valid on minimum order of ₹299. Limited time only!</div>
          <div class="slide-actions">
            <a href="/register" class="btn-white">Register Now</a>
            <a href="/shop" class="btn-ghost">Browse Shop →</a>
          </div>
          <div class="slide-stats">
            <div><div class="slide-stat-n">₹100</div><div class="slide-stat-l">Off first order</div></div>
            <div><div class="slide-stat-n">COD</div><div class="slide-stat-l">Available</div></div>
            <div><div class="slide-stat-n">Safe</div><div class="slide-stat-l">Secure payment</div></div>
          </div>
          <div class="slide-img">🎁</div>
        </div>
        <div class="slider-dots">
          <div class="dot active" onclick="goSlide(0)"></div>
          <div class="dot" onclick="goSlide(1)"></div>
          <div class="dot" onclick="goSlide(2)"></div>
        </div>
      </div>

      <!-- Right mini banners -->
      <div class="hero-right">
        <div class="mini-card mini-c1">
          <div class="mini-emoji">🍓</div>
          <div class="mini-tag">Fresh Picks</div>
          <div class="mini-title">Seasonal Fruits</div>
          <div class="mini-sub">Starting ₹49/kg</div>
          <a href="#" class="mini-cta">Shop Now →</a>
        </div>
        <div class="mini-card mini-c2">
          <div class="mini-emoji">🥦</div>
          <div class="mini-tag">Farm Direct</div>
          <div class="mini-title">Organic Vegetables</div>
          <div class="mini-sub">Upto 25% OFF today</div>
          <a href="#" class="mini-cta">Shop Now →</a>
        </div>
        <div class="mini-card mini-c3">
          <div class="mini-emoji">🥛</div>
          <div class="mini-tag">Daily Essentials</div>
          <div class="mini-title">Dairy & Eggs</div>
          <div class="mini-sub">Always fresh, always on time</div>
          <a href="#" class="mini-cta">Shop Now →</a>
        </div>
      </div>
    </div>

    <!-- Mobile mini banners (shown below slider on mobile) -->
    <div class="hero-right-mobile" style="display:none">
      <div class="mini-card mini-c1"><div class="mini-emoji">🍓</div><div class="mini-tag">Fresh Picks</div><div class="mini-title">Seasonal Fruits</div><a href="#" class="mini-cta">Shop Now →</a></div>
      <div class="mini-card mini-c2"><div class="mini-emoji">🥦</div><div class="mini-tag">Farm Direct</div><div class="mini-title">Organic Veggies</div><a href="#" class="mini-cta">Shop Now →</a></div>
    </div>

<!-- FEATURES BAR -->
<div class="features-bar" style="margin-top:20px">
  <div class="features-bar-inner">
    <div class="feat-item"><div class="feat-icon">🚚</div><div><div class="feat-title">Free Delivery</div><div class="feat-sub">On orders above ₹499</div></div></div>
    <div class="feat-item"><div class="feat-icon">⚡</div><div><div class="feat-title">60-Min Express</div><div class="feat-sub">Ultra-fast delivery</div></div></div>
    <div class="feat-item"><div class="feat-icon">🌿</div><div><div class="feat-title">100% Fresh</div><div class="feat-sub">Farm to your doorstep</div></div></div>
    <div class="feat-item"><div class="feat-icon">🔒</div><div><div class="feat-title">Secure Payment</div><div class="feat-sub">Razorpay, UPI & COD</div></div></div>
  </div>
</div>

<!-- CATEGORIES -->
<div class="page-wrap">
  <div class="section">
    <div class="sec-header">
      <div>
        <div class="sec-title">Shop by <span>Category</span></div>
        <div class="sec-sub">Browse from 12+ product categories</div>
      </div>
      <a href="/shop" class="sec-view-all">View All Categories →</a>
    </div>
    <div class="cat-scroll">
      <div class="cat-box"><div class="cat-box-icon">🥬</div><div class="cat-box-name">Vegetables</div><div class="cat-box-count">120+ items</div></div>
      <div class="cat-box"><div class="cat-box-icon">🍎</div><div class="cat-box-name">Fruits</div><div class="cat-box-count">85+ items</div></div>
      <div class="cat-box"><div class="cat-box-icon">🥛</div><div class="cat-box-name">Dairy & Eggs</div><div class="cat-box-count">60+ items</div></div>
      <div class="cat-box"><div class="cat-box-icon">🍗</div><div class="cat-box-name">Meat & Fish</div><div class="cat-box-count">45+ items</div></div>
      <div class="cat-box"><div class="cat-box-icon">🧁</div><div class="cat-box-name">Bakery</div><div class="cat-box-count">38+ items</div></div>
      <div class="cat-box"><div class="cat-box-icon">🧃</div><div class="cat-box-name">Beverages</div><div class="cat-box-count">72+ items</div></div>
      <div class="cat-box"><div class="cat-box-icon">🍜</div><div class="cat-box-name">Instant Food</div><div class="cat-box-count">55+ items</div></div>
      <div class="cat-box"><div class="cat-box-icon">🧴</div><div class="cat-box-name">Personal Care</div><div class="cat-box-count">90+ items</div></div>
      <div class="cat-box"><div class="cat-box-icon">🏠</div><div class="cat-box-name">Household</div><div class="cat-box-count">100+ items</div></div>
      <div class="cat-box"><div class="cat-box-icon">🐾</div><div class="cat-box-name">Pet Care</div><div class="cat-box-count">30+ items</div></div>
    </div>
  </div>

  <!-- FEATURED PRODUCTS -->
  <div class="section">
    <div class="sec-header">
      <div>
        <div class="sec-title">Featured <span>Products</span></div>
        <div class="sec-sub">Handpicked fresh products for you</div>
      </div>
      <a href="/shop" class="sec-view-all">View All →</a>
    </div>
    <div class="tabs">
      <button class="tab-btn active" onclick="setTab(this)">All</button>
      <button class="tab-btn" onclick="setTab(this)">Vegetables</button>
      <button class="tab-btn" onclick="setTab(this)">Fruits</button>
      <button class="tab-btn" onclick="setTab(this)">Dairy</button>
      <button class="tab-btn" onclick="setTab(this)">Bestsellers</button>
    </div>
    <div class="products-row">

      <div class="prod-card">
        <div class="prod-badge badge-sale">20% OFF</div>
        <div class="prod-wish" onclick="toggleWish(this)">🤍</div>
        <div class="prod-img">🥦</div>
        <div class="prod-body">
          <div class="prod-cat-tag">Vegetables</div>
          <div class="prod-name">Fresh Broccoli</div>
          <div class="prod-weight">500g • Per Pack</div>
          <div class="prod-rating"><span class="stars">★★★★★</span><span class="rating-n">(48)</span></div>
          <div class="prod-footer">
            <div class="prod-price-wrap"><div class="prod-price">₹49</div><div class="prod-price-old">₹61</div></div>
            <button class="btn-add" onclick="addToCart(this)">+</button>
          </div>
        </div>
      </div>

      <div class="prod-card">
        <div class="prod-badge badge-new">NEW</div>
        <div class="prod-wish" onclick="toggleWish(this)">🤍</div>
        <div class="prod-img">🍓</div>
        <div class="prod-body">
          <div class="prod-cat-tag">Fruits</div>
          <div class="prod-name">Fresh Strawberries</div>
          <div class="prod-weight">250g • Per Box</div>
          <div class="prod-rating"><span class="stars">★★★★☆</span><span class="rating-n">(32)</span></div>
          <div class="prod-footer">
            <div class="prod-price-wrap"><div class="prod-price">₹99</div></div>
            <button class="btn-add" onclick="addToCart(this)">+</button>
          </div>
        </div>
      </div>

      <div class="prod-card">
        <div class="prod-badge badge-sale">15% OFF</div>
        <div class="prod-wish" onclick="toggleWish(this)">🤍</div>
        <div class="prod-img">🥛</div>
        <div class="prod-body">
          <div class="prod-cat-tag">Dairy</div>
          <div class="prod-name">Full Cream Milk</div>
          <div class="prod-weight">1 Litre • Packet</div>
          <div class="prod-rating"><span class="stars">★★★★★</span><span class="rating-n">(201)</span></div>
          <div class="prod-footer">
            <div class="prod-price-wrap"><div class="prod-price">₹58</div><div class="prod-price-old">₹68</div></div>
            <button class="btn-add" onclick="addToCart(this)">+</button>
          </div>
        </div>
      </div>

      <div class="prod-card">
        <div class="prod-badge badge-hot">HOT</div>
        <div class="prod-wish" onclick="toggleWish(this)">🤍</div>
        <div class="prod-img">🧅</div>
        <div class="prod-body">
          <div class="prod-cat-tag">Vegetables</div>
          <div class="prod-name">Red Onion</div>
          <div class="prod-weight">1 kg</div>
          <div class="prod-rating"><span class="stars">★★★★☆</span><span class="rating-n">(89)</span></div>
          <div class="prod-footer">
            <div class="prod-price-wrap"><div class="prod-price">₹35</div></div>
            <button class="btn-add" onclick="addToCart(this)">+</button>
          </div>
        </div>
      </div>

      <div class="prod-card">
        <div class="prod-badge badge-sale">25% OFF</div>
        <div class="prod-wish" onclick="toggleWish(this)">🤍</div>
        <div class="prod-img">🍊</div>
        <div class="prod-body">
          <div class="prod-cat-tag">Fruits</div>
          <div class="prod-name">Nagpur Oranges</div>
          <div class="prod-weight">1 kg</div>
          <div class="prod-rating"><span class="stars">★★★★★</span><span class="rating-n">(67)</span></div>
          <div class="prod-footer">
            <div class="prod-price-wrap"><div class="prod-price">₹75</div><div class="prod-price-old">₹100</div></div>
            <button class="btn-add" onclick="addToCart(this)">+</button>
          </div>
        </div>
      </div>

      <div class="prod-card">
        <div class="prod-wish" onclick="toggleWish(this)">🤍</div>
        <div class="prod-img">🥚</div>
        <div class="prod-body">
          <div class="prod-cat-tag">Dairy</div>
          <div class="prod-name">Farm Fresh Eggs</div>
          <div class="prod-weight">12 Pieces • Tray</div>
          <div class="prod-rating"><span class="stars">★★★★★</span><span class="rating-n">(153)</span></div>
          <div class="prod-footer">
            <div class="prod-price-wrap"><div class="prod-price">₹89</div></div>
            <button class="btn-add" onclick="addToCart(this)">+</button>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- OFFER BANNERS -->
  <div class="section pb-40">
    <div class="sec-header">
      <div>
        <div class="sec-title">🔥 Exclusive <span>Offers</span></div>
        <div class="sec-sub">Limited time deals — grab before they're gone!</div>
      </div>
    </div>
    <div class="offer-grid">
      <div class="offer-banner ob-1">
        <div class="ob-glow"></div><div class="ob-glow2"></div>
        <div class="ob-text">
          <div class="ob-eyebrow">Weekend Special</div>
          <div class="ob-title">30% OFF<br>Fresh Veggies</div>
          <div class="ob-sub">Code: VEGGIE30 · Min. order ₹299</div>
          <a href="/offers" class="ob-btn">Grab Deal →</a>
        </div>
        <div class="ob-emoji">🥗</div>
      </div>
      <div class="offer-banner ob-2">
        <div class="ob-glow"></div><div class="ob-glow2"></div>
        <div class="ob-text">
          <div class="ob-eyebrow">First Order</div>
          <div class="ob-title">Flat ₹100<br>OFF Welcome</div>
          <div class="ob-sub">Code: WELCOME100 · Min. order ₹299</div>
          <a href="/register" class="ob-btn">Register Now →</a>
        </div>
        <div class="ob-emoji">🎁</div>
      </div>
      <div class="offer-banner ob-3">
        <div class="ob-glow"></div><div class="ob-glow2"></div>
        <div class="ob-text">
          <div class="ob-eyebrow">Refer & Earn</div>
          <div class="ob-title">Earn ₹50<br>Per Referral</div>
          <div class="ob-sub">Share with friends, earn wallet credits</div>
          <a href="/my-account" class="ob-btn">Start Earning →</a>
        </div>
        <div class="ob-emoji">💰</div>
      </div>
    </div>
  </div>
</div>

<!-- REVIEWS -->
<div class="reviews-bg">
  <div class="page-wrap">
    <div class="sec-header">
      <div>
        <div class="sec-title">What Customers <span>Say</span></div>
        <div class="sec-sub">Trusted by 10,000+ happy customers</div>
      </div>
    </div>
    <div class="reviews-grid">
      <div class="rev-card">
        <div class="rev-top"><div class="rev-avatar">RK</div><div><div class="rev-name">Rahul Kumar</div><div class="rev-date">2 days ago</div></div></div>
        <div class="rev-stars">★★★★★</div>
        <div class="rev-text">Vegetables are super fresh! Delivery was on time and packaging was excellent. Highly recommend to everyone.</div>
        <div class="rev-prod">✔ Verified • Mixed Vegetables Pack</div>
      </div>
      <div class="rev-card">
        <div class="rev-top"><div class="rev-avatar" style="background:#7c3aed">PS</div><div><div class="rev-name">Priya Sharma</div><div class="rev-date">5 days ago</div></div></div>
        <div class="rev-stars">★★★★★</div>
        <div class="rev-text">Best grocery delivery app in our city! Fruits are always fresh and prices are very competitive. Love it!</div>
        <div class="rev-prod">✔ Verified • Seasonal Fruit Basket</div>
      </div>
      <div class="rev-card">
        <div class="rev-top"><div class="rev-avatar" style="background:#c2410c">AM</div><div><div class="rev-name">Amit Mehta</div><div class="rev-date">1 week ago</div></div></div>
        <div class="rev-stars">★★★★☆</div>
        <div class="rev-text">Dairy products are always fresh. Milk and paneer quality is outstanding. 60-min delivery is actually real!</div>
        <div class="rev-prod">✔ Verified • Daily Dairy Pack</div>
      </div>
      <div class="rev-card">
        <div class="rev-top"><div class="rev-avatar" style="background:#0369a1">SK</div><div><div class="rev-name">Sunita Kumari</div><div class="rev-date">3 days ago</div></div></div>
        <div class="rev-stars">★★★★★</div>
        <div class="rev-text">I've been ordering weekly for 3 months. Never disappointed. Customer support is also very responsive and helpful.</div>
        <div class="rev-prod">✔ Verified • Weekly Grocery Bundle</div>
      </div>
    </div>
  </div>
</div>

<!-- NEWSLETTER -->
<div class="newsletter">
  <div class="nl-inner">
    <div class="nl-icon">📧</div>
    <div class="nl-title">Get Exclusive Deals in Your Inbox</div>
    <div class="nl-sub">Subscribe and get 10% OFF on your next order. No spam, only fresh deals!</div>
    <div class="nl-form">
      <input class="nl-input" type="email" placeholder="Enter your email address...">
      <button class="nl-btn">Subscribe →</button>
    </div>
  </div>
</div>

<!-- FOOTER -->
<footer>
  <div class="footer-inner">
    <div class="footer-grid">
      <div>
        <div class="f-logo">Grocery<span>Mart</span></div>
        <div class="f-desc">Your trusted online grocery store. Fresh produce, dairy, and daily essentials delivered to your doorstep with love.</div>
        <div class="f-socials">
          <div class="f-social">f</div>
          <div class="f-social">in</div>
          <div class="f-social">yt</div>
          <div class="f-social">tw</div>
        </div>
      </div>
      <div class="f-col">
        <h5>Quick Links</h5>
        <ul>
          <li><a href="/">Home</a></li>
          <li><a href="/shop">Shop</a></li>
          <li><a href="/offers">Offers & Deals</a></li>
          <li><a href="/new-arrivals">New Arrivals</a></li>
          <li><a href="/bestsellers">Bestsellers</a></li>
          <li><a href="/contact">Contact Us</a></li>
        </ul>
      </div>
      <div class="f-col">
        <h5>My Account</h5>
        <ul>
          <li><a href="/my-account">Dashboard</a></li>
          <li><a href="/my-account/orders">My Orders</a></li>
          <li><a href="/my-account/addresses">My Addresses</a></li>
          <li><a href="/wishlist">Wishlist</a></li>
          <li><a href="/my-account/profile">Profile Settings</a></li>
        </ul>
      </div>
      <div class="f-col">
        <h5>Support</h5>
        <ul>
          <li><a href="#">📞 +91 98765-43210</a></li>
          <li><a href="#">📧 help@grocerymart.in</a></li>
          <li><a href="#">📍 123 Market St, City</a></li>
          <li><a href="#">🕐 Mon–Sat: 8AM–10PM</a></li>
          <li><a href="#">Privacy Policy</a></li>
          <li><a href="#">Terms & Conditions</a></li>
        </ul>
      </div>
      <div>
        <div class="f-app-title">Download Our App</div>
        <div class="f-app-btns">
          <div class="f-app-btn"><div class="f-app-icon">🍎</div><div><div class="f-app-lbl">Download on the</div><div class="f-app-name">App Store</div></div></div>
          <div class="f-app-btn"><div class="f-app-icon">🤖</div><div><div class="f-app-lbl">Get it on</div><div class="f-app-name">Google Play</div></div></div>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="f-copy">© 2024 GroceryMart. All rights reserved. Made with ❤️</div>
      <div class="f-payments">
        <span class="pay-tag">We Accept:</span>
        <span class="pay-chip">VISA</span>
        <span class="pay-chip">Mastercard</span>
        <span class="pay-chip">UPI</span>
        <span class="pay-chip">RuPay</span>
        <span class="pay-chip">COD</span>
      </div>
    </div>
  </div>
</footer>

<!-- MOBILE DRAWER -->
<div class="mob-drawer" id="mobDrawer">
  <div class="mob-overlay" onclick="closeMenu()"></div>
  <div class="mob-panel">
    <div class="mob-panel-head">
      <div class="mob-panel-logo">Grocery<span>Mart</span></div>
      <button class="mob-close" onclick="closeMenu()">✕</button>
    </div>
    <div class="mob-panel-search">
      <input type="text" placeholder="Search vegetables, fruits...">
    </div>
    <div class="mob-auth-btns">
      <button class="mob-btn-login" onclick="location.href='/login'">Login</button>
      <button class="mob-btn-reg" onclick="location.href='/register'">Register</button>
    </div>
    <div class="mob-nav-section">
      <div class="mob-nav-title">Categories</div>
      <a href="#" class="mob-nav-link"><span class="mob-icon">🥬</span> Vegetables <span class="mob-arrow">›</span></a>
      <a href="#" class="mob-nav-link"><span class="mob-icon">🍎</span> Fruits <span class="mob-arrow">›</span></a>
      <a href="#" class="mob-nav-link"><span class="mob-icon">🥛</span> Dairy & Eggs <span class="mob-arrow">›</span></a>
      <a href="#" class="mob-nav-link"><span class="mob-icon">🍗</span> Meat & Fish <span class="mob-arrow">›</span></a>
      <a href="#" class="mob-nav-link"><span class="mob-icon">🧁</span> Bakery <span class="mob-arrow">›</span></a>
      <a href="#" class="mob-nav-link"><span class="mob-icon">🧃</span> Beverages <span class="mob-arrow">›</span></a>
      <a href="#" class="mob-nav-link"><span class="mob-icon">🍜</span> Instant Food <span class="mob-arrow">›</span></a>
      <a href="#" class="mob-nav-link"><span class="mob-icon">🧴</span> Personal Care <span class="mob-arrow">›</span></a>
      <a href="#" class="mob-nav-link"><span class="mob-icon">🏠</span> Household <span class="mob-arrow">›</span></a>
    </div>
    <div class="mob-nav-section" style="border-top:1px solid #f3f4f6">
      <div class="mob-nav-title">My Account</div>
      <a href="/my-account" class="mob-nav-link"><span class="mob-icon">👤</span> My Profile</a>
      <a href="/my-account/orders" class="mob-nav-link"><span class="mob-icon">📦</span> My Orders</a>
      <a href="/wishlist" class="mob-nav-link"><span class="mob-icon">🤍</span> Wishlist</a>
      <a href="/my-account/addresses" class="mob-nav-link"><span class="mob-icon">📍</span> Addresses</a>
    </div>
    <div class="mob-nav-section" style="border-top:1px solid #f3f4f6">
      <div class="mob-nav-title">Help</div>
      <a href="/contact" class="mob-nav-link"><span class="mob-icon">📞</span> Contact Us</a>
      <a href="#" class="mob-nav-link"><span class="mob-icon">🚚</span> Track Order</a>
    </div>
  </div>
</div>

<!-- MOBILE BOTTOM NAV -->
<div class="mob-bottom-nav">
  <div class="mob-bottom-nav-inner">
    <div class="mob-nav-item active" onclick="location.href='/'">
      <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
      Home
    </div>
    <div class="mob-nav-item" onclick="location.href='/shop'">
      <svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
      Shop
    </div>
    <div class="mob-nav-item" onclick="location.href='/cart'" style="position:relative">
      <svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
      Cart
      <span class="mob-nav-badge">5</span>
    </div>
    <div class="mob-nav-item" onclick="location.href='/wishlist'">
      <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
      Wishlist
    </div>
    <div class="mob-nav-item" onclick="location.href='/my-account'">
      <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
      Account
    </div>
  </div>
</div>

<!-- WHATSAPP -->
<a href="https://wa.me/919876543210?text=Hi, I need help with my order" class="wa-btn" target="_blank">
  <div class="wa-pulse"></div>
  💬
</a>

<!-- BACK TO TOP -->
<div class="back-top" onclick="window.scrollTo({top:0,behavior:'smooth'})">↑</div>

<script>
// ── MOBILE MENU ──
function openMenu() {
  const drawer = document.getElementById('mobDrawer');
  const btn = document.getElementById('menuBtn');
  drawer.classList.add('open');
  btn.classList.add('open');
  document.body.style.overflow = 'hidden';
}
function closeMenu() {
  const drawer = document.getElementById('mobDrawer');
  const btn = document.getElementById('menuBtn');
  drawer.classList.remove('open');
  btn.classList.remove('open');
  document.body.style.overflow = '';
}

// ── RESPONSIVE: show/hide mob elements ──
function handleResize() {
  const isMobile = window.innerWidth <= 768;
  const mobCart = document.querySelector('.mob-cart-icon');
  const mobMenu = document.querySelector('.mob-menu-btn');
  const mobMini = document.querySelector('.hero-right-mobile');
  if (mobCart) mobCart.style.display = isMobile ? 'flex' : 'none';
  if (mobMenu) mobMenu.style.display = isMobile ? 'flex' : 'none';
  if (mobMini) mobMini.style.display = isMobile ? 'grid' : 'none';
}
handleResize();
window.addEventListener('resize', handleResize);

// ── SLIDER ──
let current = 0;
const slides = document.querySelectorAll('.slide');
const dots = document.querySelectorAll('.dot');
let timer;

function goSlide(n) {
  slides[current].classList.remove('active');
  dots[current].classList.remove('active');
  current = n;
  slides[current].classList.add('active');
  dots[current].classList.add('active');
  resetTimer();
}
function nextSlide() { goSlide((current + 1) % slides.length); }
function resetTimer() {
  clearInterval(timer);
  timer = setInterval(nextSlide, 4500);
}
resetTimer();

// ── TOUCH SWIPE on slider ──
let touchStartX = 0;
const slider = document.getElementById('heroSlider');
if (slider) {
  slider.addEventListener('touchstart', e => { touchStartX = e.changedTouches[0].screenX; }, { passive: true });
  slider.addEventListener('touchend', e => {
    const diff = touchStartX - e.changedTouches[0].screenX;
    if (Math.abs(diff) > 50) goSlide(diff > 0 ? (current + 1) % slides.length : (current - 1 + slides.length) % slides.length);
  });
}

// ── WISHLIST ──
function toggleWish(el) {
  el.textContent = el.textContent === '🤍' ? '❤️' : '🤍';
  el.style.background = el.textContent === '❤️' ? '#fff0f0' : '';
}

// ── ADD TO CART ──
function addToCart(btn) {
  btn.textContent = '✓';
  btn.classList.add('added');
  setTimeout(() => { btn.textContent = '+'; btn.classList.remove('added'); }, 1800);
}

// ── TABS ──
function setTab(el) {
  document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
  el.classList.add('active');
}

// ── SCROLL REVEAL ──
const io = new IntersectionObserver(entries => {
  entries.forEach(e => {
    if (e.isIntersecting) {
      e.target.style.opacity = '1';
      e.target.style.transform = 'translateY(0)';
    }
  });
}, { threshold: 0.06 });

document.querySelectorAll('.prod-card, .cat-box, .rev-card, .offer-banner, .feat-item').forEach(el => {
  el.style.opacity = '0';
  el.style.transform = 'translateY(16px)';
  el.style.transition = 'opacity .4s ease, transform .4s ease';
  io.observe(el);
});

// ── BACK TO TOP ──
window.addEventListener('scroll', () => {
  const btn = document.querySelector('.back-top');
  if (btn) btn.style.display = window.scrollY > 400 ? 'flex' : 'none';
});
const backBtn = document.querySelector('.back-top');
if (backBtn) backBtn.style.display = 'none';
</script>
</body>
</html>