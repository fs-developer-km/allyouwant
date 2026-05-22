<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<title>All You Want — Fresh Groceries Delivered</title>
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
.search-btn svg{width:16px;height:16px;stroke:#fff;fill:none;stroke-width:2}
.nav-right{display:flex;align-items:center;gap:6px;margin-left:auto;flex-shrink:0}
.nav-icon-btn{display:flex;flex-direction:column;align-items:center;gap:2px;padding:7px 12px;border-radius:8px;border:none;background:none;color:#374151;font-size:11.5px;font-weight:500;transition:background .15s;position:relative;white-space:nowrap;cursor:pointer;text-decoration:none}
.nav-icon-btn:hover{background:#f3f4f6;color:#0d6e39}
.nav-icon-btn svg{width:22px;height:22px;stroke:#374151;stroke-width:1.8;fill:none}
.nav-icon-btn:hover svg{stroke:#0d6e39}
.nav-badge{position:absolute;top:5px;right:8px;background:#e53935;color:#fff;font-size:10px;font-weight:700;min-width:17px;height:17px;border-radius:50%;display:flex;align-items:center;justify-content:center;border:2px solid #fff}
.btn-cart{background:#0d6e39;color:#fff;border-radius:10px;padding:9px 18px;font-size:13px;font-weight:600;border:none;display:flex;align-items:center;gap:8px;transition:background .2s;cursor:pointer;text-decoration:none}
.btn-cart:hover{background:#0a5a2e}
.btn-cart svg{width:18px;height:18px;stroke:#fff;stroke-width:2;fill:none}
.cart-count{background:rgba(255,255,255,.25);border-radius:5px;padding:1px 6px;font-size:12px;font-weight:700}

/* CAT NAV */
.cat-nav{background:#fff;border-bottom:1px solid #e8edf0}
.cat-nav-inner{max-width:1320px;margin:0 auto;padding:0 20px;display:flex;align-items:center;overflow-x:auto;scrollbar-width:none;gap:0}
.cat-nav-inner::-webkit-scrollbar{display:none}
.cat-link{display:flex;align-items:center;gap:6px;padding:11px 16px;font-size:13px;font-weight:500;color:#4b5563;white-space:nowrap;border-bottom:2.5px solid transparent;transition:all .15s;text-decoration:none}
.cat-link:hover,.cat-link.active{color:#0d6e39;border-bottom-color:#0d6e39}

/* ALERT */
.alert-success{background:#dcfce7;border-bottom:1px solid #bbf7d0;color:#15803d;padding:10px 20px;font-size:13px;font-weight:500}
.alert-error{background:#fef2f2;border-bottom:1px solid #fecaca;color:#dc2626;padding:10px 20px;font-size:13px;font-weight:500}

/* PAGE WRAP */
.page-wrap{max-width:1320px;margin:0 auto;padding:0 20px}

/* HERO */
.hero-section{padding:22px 0 0}
.hero-grid{display:grid;grid-template-columns:240px 1fr 280px;gap:16px;align-items:start}

/* SIDEBAR */
.sidebar-cats{background:#fff;border:1px solid #e8edf0;border-radius:12px;overflow:hidden}
.sidebar-cat-item{display:flex;align-items:center;justify-content:space-between;padding:11px 16px;font-size:13px;color:#374151;border-bottom:1px solid #f3f4f6;cursor:pointer;transition:background .15s;gap:10px;text-decoration:none}
.sidebar-cat-item:last-child{border-bottom:none}
.sidebar-cat-item:hover{background:#f0faf4;color:#0d6e39}
.sidebar-cat-left{display:flex;align-items:center;gap:10px}
.sidebar-cat-icon{width:32px;height:32px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:17px;flex-shrink:0}
.sidebar-cat-name{font-weight:500;font-size:13px}
.sidebar-chevron{color:#9ca3af;font-size:12px}

/* SLIDER */
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
.btn-white{background:#fff;color:#0d6e39;padding:12px 26px;border-radius:8px;font-size:13.5px;font-weight:700;border:none;transition:transform .15s,box-shadow .15s;display:inline-flex;align-items:center;gap:7px;text-decoration:none}
.btn-white:hover{transform:translateY(-1px);box-shadow:0 6px 20px rgba(0,0,0,.15)}
.btn-ghost{background:rgba(255,255,255,.15);color:#fff;padding:12px 22px;border-radius:8px;font-size:13.5px;font-weight:500;border:1px solid rgba(255,255,255,.3);backdrop-filter:blur(4px);transition:background .2s;display:inline-flex;align-items:center;gap:7px;text-decoration:none}
.btn-ghost:hover{background:rgba(255,255,255,.25)}
.slide-img{position:absolute;right:40px;top:50%;transform:translateY(-50%);font-size:150px;line-height:1;filter:drop-shadow(0 20px 40px rgba(0,0,0,.2));animation:float 3.5s ease-in-out infinite}
.slide-stats{display:flex;gap:24px;margin-top:24px;padding-top:20px;border-top:1px solid rgba(255,255,255,.15)}
.slide-stat-n{font-size:20px;font-weight:800;color:#fcd34d}
.slide-stat-l{font-size:11.5px;color:rgba(255,255,255,.65);margin-top:1px}
.slider-dots{position:absolute;bottom:16px;left:50%;transform:translateX(-50%);display:flex;gap:6px;z-index:10}
.dot{width:7px;height:7px;border-radius:50%;background:rgba(255,255,255,.4);cursor:pointer;transition:all .2s}
.dot.active{width:22px;border-radius:4px;background:#fff}
@keyframes float{0%,100%{transform:translateY(-50%)}50%{transform:translateY(calc(-50% - 10px))}}

/* MINI BANNERS */
.hero-right{display:flex;flex-direction:column;gap:14px}
.mini-card{border-radius:12px;padding:20px 18px;position:relative;overflow:hidden;cursor:pointer;transition:transform .2s,box-shadow .2s;min-height:110px;display:flex;flex-direction:column;justify-content:flex-end;text-decoration:none}
.mini-card:hover{transform:translateY(-3px);box-shadow:0 10px 30px rgba(0,0,0,.12)}
.mini-c1{background:linear-gradient(135deg,#fef3c7 0%,#fde68a 100%)}
.mini-c2{background:linear-gradient(135deg,#dbeafe 0%,#bfdbfe 100%)}
.mini-c3{background:linear-gradient(135deg,#fce7f3 0%,#fbcfe8 100%)}
.mini-emoji{position:absolute;right:14px;top:10px;font-size:46px;opacity:.85}
.mini-tag{font-size:10.5px;font-weight:600;color:#6b7280;text-transform:uppercase;letter-spacing:.5px;margin-bottom:3px}
.mini-title{font-size:15px;font-weight:700;color:#1a1a2e;line-height:1.25}
.mini-sub{font-size:12px;color:#6b7280;margin-top:3px}
.mini-cta{font-size:12px;font-weight:600;color:#0d6e39;margin-top:8px;display:flex;align-items:center;gap:3px}

/* FEATURES */
.features-bar{background:#fff;border-top:1px solid #e8edf0;border-bottom:1px solid #e8edf0;margin-top:22px}
.features-bar-inner{max-width:1320px;margin:0 auto;padding:0 20px;display:grid;grid-template-columns:repeat(4,1fr)}
.feat-item{display:flex;align-items:center;gap:13px;padding:16px 20px;border-right:1px solid #e8edf0;transition:background .15s}
.feat-item:last-child{border-right:none}
.feat-item:hover{background:#f0faf4}
.feat-icon{width:40px;height:40px;background:#f0faf4;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:19px;flex-shrink:0}
.feat-title{font-size:13.5px;font-weight:600;color:#111}
.feat-sub{font-size:12px;color:#6b7280;margin-top:1px}

/* SECTION */
.section{padding:36px 0 0}
.sec-header{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:18px}
.sec-title{font-size:22px;font-weight:800;color:#1a1a2e;letter-spacing:-.4px}
.sec-title span{color:#0d6e39}
.sec-sub{font-size:13px;color:#6b7280;margin-top:3px}
.sec-view-all{display:flex;align-items:center;gap:4px;font-size:13px;font-weight:600;color:#0d6e39;transition:gap .15s;text-decoration:none}
.sec-view-all:hover{gap:8px}
.tabs{display:flex;gap:6px;margin-bottom:20px;border-bottom:1.5px solid #e8edf0;padding-bottom:0}
.tab-btn{padding:8px 18px;border-radius:8px 8px 0 0;border:none;background:none;font-size:13px;font-weight:500;color:#6b7280;cursor:pointer;transition:all .15s;border-bottom:2.5px solid transparent;margin-bottom:-1.5px}
.tab-btn.active,.tab-btn:hover{color:#0d6e39;border-bottom-color:#0d6e39;font-weight:600}

/* CATEGORIES */
.cat-scroll{display:grid;grid-template-columns:repeat(10,1fr);gap:12px}
.cat-box{display:flex;flex-direction:column;align-items:center;gap:8px;padding:16px 8px;background:#fff;border:1.5px solid #e8edf0;border-radius:12px;cursor:pointer;transition:all .2s;text-decoration:none;color:inherit}
.cat-box:hover{border-color:#0d6e39;background:#f0faf4;transform:translateY(-3px);box-shadow:0 6px 20px rgba(13,110,57,.10)}
.cat-box-icon{width:52px;height:52px;border-radius:50%;background:#f3f4f6;display:flex;align-items:center;justify-content:center;font-size:24px;transition:background .2s;overflow:hidden}
.cat-box:hover .cat-box-icon{background:#0d6e39}
.cat-box-icon img{width:100%;height:100%;object-fit:cover}
.cat-box-name{font-size:12px;font-weight:600;color:#374151;text-align:center;line-height:1.3}
.cat-box-count{font-size:11px;color:#9ca3af}

/* PRODUCTS */
.products-row{display:grid;grid-template-columns:repeat(6,1fr);gap:14px}
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

/* OFFERS */
.offer-grid{display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px}
.offer-banner{border-radius:14px;padding:28px 30px;display:flex;align-items:center;justify-content:space-between;position:relative;overflow:hidden;cursor:pointer;transition:transform .2s,box-shadow .2s;text-decoration:none}
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

/* REVIEWS */
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

/* NEWSLETTER */
.newsletter{background:linear-gradient(120deg,#064e29 0%,#0d6e39 60%,#15803d 100%);padding:52px 20px;margin-top:40px}
.nl-inner{max-width:580px;margin:0 auto;text-align:center}
.nl-icon{font-size:40px;margin-bottom:16px}
.nl-title{font-size:28px;font-weight:800;color:#fff;margin-bottom:8px}
.nl-sub{font-size:14px;color:rgba(255,255,255,.75);margin-bottom:28px}
.nl-form{display:flex;gap:0;border-radius:10px;overflow:hidden;box-shadow:0 8px 32px rgba(0,0,0,.15)}
.nl-input{flex:1;border:none;padding:14px 20px;font-size:13.5px;outline:none;font-family:inherit}
.nl-btn{background:#fcd34d;color:#1a1a2e;border:none;padding:14px 28px;font-size:13.5px;font-weight:700;cursor:pointer;transition:background .2s;white-space:nowrap;font-family:inherit}
.nl-btn:hover{background:#fbbf24}

/* FOOTER */
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
.footer-bottom{border-top:1px solid rgba(255,255,255,.07);padding:20px 0;display:flex;justify-content:space-between;align-items:center}
.f-copy{font-size:12.5px}
.f-payments{display:flex;align-items:center;gap:6px}
.pay-tag{font-size:11px;margin-right:6px}
.pay-chip{background:rgba(255,255,255,.1);color:rgba(255,255,255,.8);font-size:11.5px;font-weight:600;padding:4px 11px;border-radius:5px}

/* WHATSAPP */
.wa-btn{position:fixed;bottom:24px;right:24px;width:54px;height:54px;background:#25d366;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:26px;z-index:999;box-shadow:0 4px 20px rgba(37,211,102,.45);transition:transform .2s,box-shadow .2s;text-decoration:none}
.wa-btn:hover{transform:scale(1.12);box-shadow:0 8px 30px rgba(37,211,102,.60)}
.wa-pulse{position:absolute;inset:0;border-radius:50%;background:#25d366;animation:waPulse 2.2s ease infinite;z-index:-1}
@keyframes waPulse{0%{transform:scale(1);opacity:.6}100%{transform:scale(1.6);opacity:0}}
.back-top{position:fixed;bottom:88px;right:26px;width:40px;height:40px;background:#fff;border:1.5px solid #e8edf0;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:16px;cursor:pointer;transition:all .2s;z-index:999;color:#374151;display:none}
.back-top:hover{background:#0d6e39;color:#fff;border-color:#0d6e39}

/* MOBILE */
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
.mob-nav-section{padding:8px 0}
.mob-nav-title{font-size:11px;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.6px;padding:8px 18px 4px}
.mob-nav-link{display:flex;align-items:center;gap:12px;padding:12px 18px;font-size:14px;color:#374151;font-weight:500;border-bottom:1px solid #f9fafb;transition:background .15s;text-decoration:none}
.mob-nav-link:hover{background:#f0faf4;color:#0d6e39}
.mob-nav-link .mob-icon{font-size:20px;width:28px;text-align:center}
.mob-nav-link .mob-arrow{margin-left:auto;color:#9ca3af;font-size:12px}
.mob-auth-btns{display:flex;gap:10px;padding:16px 18px}
.mob-btn-login{flex:1;padding:11px;border:1.5px solid #0d6e39;border-radius:8px;font-size:13.5px;font-weight:600;color:#0d6e39;background:none;text-align:center;cursor:pointer;text-decoration:none;display:block}
.mob-btn-reg{flex:1;padding:11px;background:#0d6e39;border:none;border-radius:8px;font-size:13.5px;font-weight:600;color:#fff;text-align:center;cursor:pointer;text-decoration:none;display:block}
.mob-cart-icon{display:none;align-items:center;justify-content:center;position:relative;width:40px;height:40px;border:1.5px solid #e8edf0;border-radius:8px;background:none;cursor:pointer;flex-shrink:0;text-decoration:none}
.mob-cart-icon svg{width:20px;height:20px;stroke:#374151;stroke-width:1.8;fill:none}
.mob-bottom-nav{display:none;position:fixed;bottom:0;left:0;right:0;background:#fff;border-top:1px solid #e8edf0;z-index:400;padding:6px 0 env(safe-area-inset-bottom)}
.mob-bottom-nav-inner{display:flex;justify-content:space-around}
.mob-nav-item{display:flex;flex-direction:column;align-items:center;gap:3px;padding:6px 16px;font-size:11px;font-weight:500;color:#6b7280;cursor:pointer;position:relative;min-width:56px;transition:color .15s;text-decoration:none}
.mob-nav-item.active,.mob-nav-item:hover{color:#0d6e39}
.mob-nav-item svg{width:22px;height:22px;stroke:currentColor;stroke-width:1.8;fill:none}
.mob-nav-badge{position:absolute;top:4px;right:10px;background:#e53935;color:#fff;font-size:9px;font-weight:700;min-width:15px;height:15px;border-radius:50%;display:flex;align-items:center;justify-content:center;border:2px solid #fff}

/* RESPONSIVE */
@media(max-width:1024px){
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
}
@media(max-width:768px){
  html{font-size:14px}
  .topbar{display:none}
  .navbar-inner{height:58px;gap:10px;padding:0 14px}
  .logo-sub{display:none}
  .logo-text{font-size:17px}
  .search-wrap{display:none}
  .nav-icon-btn{display:none}
  .btn-cart{display:none}
  .mob-menu-btn{display:flex}
  .mob-cart-icon{display:flex}
  .cat-nav-inner{padding:0 14px}
  .cat-link{padding:9px 12px;font-size:12.5px}
  .page-wrap{padding:0 14px}
  .hero-section{padding:14px 0 0}
  .hero-grid{display:block}
  .hero-right{display:none}
  .hero-slider{min-height:240px;border-radius:12px}
  .slide{padding:24px 22px}
  .slide-title{font-size:26px;letter-spacing:-.5px}
  .slide-desc{font-size:13px;margin-bottom:16px;max-width:240px}
  .slide-img{font-size:90px;right:16px}
  .slide-stats{gap:16px;margin-top:16px;padding-top:14px}
  .slide-stat-n{font-size:17px}
  .btn-white,.btn-ghost{padding:10px 18px;font-size:13px}
  .hero-right-mobile{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-top:12px}
  .mini-card{min-height:90px;padding:14px}
  .mini-emoji{font-size:36px;right:10px;top:8px}
  .mini-title{font-size:13px}
  .features-bar-inner{grid-template-columns:1fr 1fr}
  .feat-item{padding:12px 14px;border-right:none;border-bottom:1px solid #e8edf0}
  .feat-item:nth-child(odd){border-right:1px solid #e8edf0}
  .feat-item:nth-last-child(-n+2){border-bottom:none}
  .section{padding:24px 0 0}
  .sec-title{font-size:19px}
  .cat-scroll{grid-template-columns:repeat(4,1fr);gap:8px}
  .cat-box{padding:12px 6px}
  .cat-box-icon{width:44px;height:44px;font-size:20px}
  .cat-box-name{font-size:11px}
  .cat-box-count{display:none}
  .products-row{grid-template-columns:repeat(2,1fr);gap:10px}
  .prod-img-wrap{height:130px}
  .prod-emoji{font-size:58px}
  .prod-body{padding:10px}
  .prod-name{font-size:13px}
  .prod-price{font-size:15px}
  .tabs{overflow-x:auto;scrollbar-width:none;flex-wrap:nowrap}
  .tabs::-webkit-scrollbar{display:none}
  .offer-grid{grid-template-columns:1fr}
  .offer-banner{padding:22px 20px;min-height:130px}
  .ob-title{font-size:18px}
  .ob-emoji{font-size:56px}
  .reviews-bg{padding:28px 0}
  .reviews-grid{grid-template-columns:1fr;gap:12px}
  .newsletter{padding:36px 16px}
  .nl-title{font-size:22px}
  .nl-form{flex-direction:column;border-radius:10px;overflow:visible;gap:10px;box-shadow:none}
  .nl-input{border-radius:10px;border:none;box-shadow:0 2px 12px rgba(0,0,0,.1)}
  .nl-btn{border-radius:10px;padding:13px;font-size:14px}
  .footer-grid{grid-template-columns:1fr;gap:28px}
  .footer-bottom{flex-direction:column;gap:12px;text-align:center}
  .f-payments{flex-wrap:wrap;justify-content:center}
  .back-top{bottom:80px;right:16px}
  .wa-btn{bottom:80px;right:16px;width:48px;height:48px;font-size:22px}
  .mob-bottom-nav{display:block}
  body{padding-bottom:62px}
}
@media(max-width:480px){
  .cat-scroll{grid-template-columns:repeat(4,1fr);gap:7px}
  .products-row{grid-template-columns:repeat(2,1fr);gap:8px}
  .slide-title{font-size:22px}
  .slide-img{display:none}
  .slide-desc{max-width:100%}
  .hero-right-mobile{grid-template-columns:1fr}
  .offer-grid{grid-template-columns:1fr}
  .reviews-grid{grid-template-columns:1fr}
}
@media(min-width:1400px){
  .products-row{grid-template-columns:repeat(6,1fr)}
  .cat-scroll{grid-template-columns:repeat(10,1fr)}
}
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
      <div>
        <div class="logo-text">All You <span>Want</span></div>
        <span class="logo-sub">Fresh • Fast • Reliable</span>
      </div>
    </a>
    <div class="search-wrap">
      <form action="<?php echo e(route('shop.search')); ?>" method="GET" class="search-box">
        <select class="search-cat" name="category">
          <option value="">All Categories</option>
          <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($cat->id); ?>" <?php echo e(request('category')==$cat->id ? 'selected':''); ?>><?php echo e($cat->name); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <input class="search-input" type="text" name="q" placeholder="Search for milk, vegetables, fruits..." value="<?php echo e(request('q')); ?>">
        <button class="search-btn" type="submit">
          <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
          Search
        </button>
      </form>
    </div>
    <div class="nav-right">
      <?php if(auth()->guard()->check()): ?>
        <a href="<?php echo e(route('account.index')); ?>" class="nav-icon-btn">
          <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          Account
        </a>
      <?php else: ?>
        <a href="<?php echo e(route('login')); ?>" class="nav-icon-btn">
          <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          Login
        </a>
      <?php endif; ?>
      <a href="#" class="nav-icon-btn">
        <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
        Wishlist
      </a>
      <a href="<?php echo e(route('cart.index')); ?>" class="btn-cart">
        <svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
        My Cart
        <?php $cartCount = count(session('cart',[])); ?>
        <?php if($cartCount > 0): ?><span class="cart-count"><?php echo e($cartCount); ?></span><?php endif; ?>
      </a>
    </div>
    
    <a href="<?php echo e(route('cart.index')); ?>" class="mob-cart-icon">
      <svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
      <?php if($cartCount > 0): ?><span class="nav-badge"><?php echo e($cartCount); ?></span><?php endif; ?>
    </a>
    <button class="mob-menu-btn" id="menuBtn" onclick="openMenu()">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>


<div class="cat-nav">
  <div class="cat-nav-inner">
    <a href="<?php echo e(route('home')); ?>" class="cat-link active">🏠 Home</a>
    <a href="<?php echo e(route('shop')); ?>" class="cat-link">🛒 All Products</a>
    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php
        $icons = ['Vegetables'=>'🥬','Fruits'=>'🍎','Dairy & Eggs'=>'🥛','Meat & Fish'=>'🍗','Bakery'=>'🧁','Beverages'=>'🧃','Instant Food'=>'🍜','Personal Care'=>'🧴','Household'=>'🏠','Pet Care'=>'🐾'];
        $icon = $icons[$cat->name] ?? '🛒';
      ?>
      <a href="<?php echo e(route('category.show', $cat->slug)); ?>" class="cat-link"><?php echo e($icon); ?> <?php echo e($cat->name); ?></a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <a href="<?php echo e(route('offers')); ?>" class="cat-link" style="color:#e53935;border-bottom-color:#e53935">🔥 Offers</a>
  </div>
</div>


<?php if(session('success')): ?><div class="alert-success">✅ <?php echo e(session('success')); ?></div><?php endif; ?>
<?php if(session('error')): ?><div class="alert-error">❌ <?php echo e(session('error')); ?></div><?php endif; ?>


<div class="page-wrap">
  <div class="hero-section">
    <div class="hero-grid">

      
      <div class="sidebar-cats">
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $icons = ['Vegetables'=>'🥬','Fruits'=>'🍎','Dairy & Eggs'=>'🥛','Meat & Fish'=>'🍗','Bakery'=>'🧁','Beverages'=>'🧃','Instant Food'=>'🍜','Personal Care'=>'🧴','Household'=>'🏠','Pet Care'=>'🐾']; $icon = $icons[$cat->name] ?? '🛒'; $bg = ['Vegetables'=>'#f0faf4','Fruits'=>'#fff8f0','Dairy & Eggs'=>'#f0f8ff','Meat & Fish'=>'#fff0f0','Bakery'=>'#fffbf0','Beverages'=>'#f0f0ff','Instant Food'=>'#fff0fa','Personal Care'=>'#f5f0ff','Household'=>'#f0fff8','Pet Care'=>'#fff8f0'][$cat->name] ?? '#f3f4f6'; ?>
        <a href="<?php echo e(route('category.show', $cat->slug)); ?>" class="sidebar-cat-item">
          <div class="sidebar-cat-left">
            <div class="sidebar-cat-icon" style="background:<?php echo e($bg); ?>"><?php echo e($icon); ?></div>
            <span class="sidebar-cat-name"><?php echo e($cat->name); ?></span>
          </div>
          <span class="sidebar-chevron">›</span>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>

      
      <div class="hero-slider" id="heroSlider">
        <div class="slide slide-1 active" id="slide0">
          <div class="slide-eyebrow">🌿 100% Organic & Farm Fresh</div>
          <div class="slide-title">Fresh Groceries<br><em>Delivered in 60 min</em></div>
          <div class="slide-desc">Order fresh vegetables, fruits, dairy & daily essentials. Delivered at Mayur Vihar Phase-1.</div>
          <div class="slide-actions">
            <a href="<?php echo e(route('shop')); ?>" class="btn-white">🛍️ Shop Now</a>
            <a href="<?php echo e(route('offers')); ?>" class="btn-ghost">View Offers →</a>
          </div>
          <div class="slide-stats">
            <div><div class="slide-stat-n">10K+</div><div class="slide-stat-l">Happy Customers</div></div>
            <div><div class="slide-stat-n"><?php echo e($featured->count() + $bestsellers->count()); ?>+</div><div class="slide-stat-l">Fresh Products</div></div>
            <div><div class="slide-stat-n">60 min</div><div class="slide-stat-l">Express Delivery</div></div>
          </div>
          <div class="slide-img">🥗</div>
        </div>
        <div class="slide slide-2" id="slide1">
          <div class="slide-eyebrow">🔥 Today's Special Deal</div>
          <div class="slide-title">Flat 30% OFF<br><em>on All Fruits</em></div>
          <div class="slide-desc">Freshly sourced seasonal fruits delivered to your door every morning.</div>
          <div class="slide-actions">
            <?php $fruitCat = $categories->firstWhere('name','Fruits'); ?>
            <a href="<?php echo e($fruitCat ? route('category.show',$fruitCat->slug) : route('shop')); ?>" class="btn-white">🍎 Buy Fruits</a>
            <a href="<?php echo e(route('offers')); ?>" class="btn-ghost">All Offers →</a>
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
          <div class="slide-desc">Use code WELCOME100. Valid on min ₹299. Near Mitra Di Chap & Sameer Restaurant.</div>
          <div class="slide-actions">
            <a href="<?php echo e(route('register')); ?>" class="btn-white">Register Now</a>
            <a href="<?php echo e(route('shop')); ?>" class="btn-ghost">Browse Shop →</a>
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

      
      <div class="hero-right">
        <?php $vegCat = $categories->firstWhere('name','Vegetables'); $fruitCat2 = $categories->firstWhere('name','Fruits'); $dairyCat = $categories->firstWhere('name','Dairy & Eggs'); ?>
        <a href="<?php echo e($fruitCat2 ? route('category.show',$fruitCat2->slug) : route('shop')); ?>" class="mini-card mini-c1">
          <div class="mini-emoji">🍓</div>
          <div class="mini-tag">Fresh Picks</div>
          <div class="mini-title">Seasonal Fruits</div>
          <div class="mini-sub">Starting ₹49/kg</div>
          <div class="mini-cta">Shop Now →</div>
        </a>
        <a href="<?php echo e($vegCat ? route('category.show',$vegCat->slug) : route('shop')); ?>" class="mini-card mini-c2">
          <div class="mini-emoji">🥦</div>
          <div class="mini-tag">Farm Direct</div>
          <div class="mini-title">Organic Vegetables</div>
          <div class="mini-sub">Upto 25% OFF today</div>
          <div class="mini-cta">Shop Now →</div>
        </a>
        <a href="<?php echo e($dairyCat ? route('category.show',$dairyCat->slug) : route('shop')); ?>" class="mini-card mini-c3">
          <div class="mini-emoji">🥛</div>
          <div class="mini-tag">Daily Essentials</div>
          <div class="mini-title">Dairy & Eggs</div>
          <div class="mini-sub">Always fresh, always on time</div>
          <div class="mini-cta">Shop Now →</div>
        </a>
      </div>
    </div>

    
    <div class="hero-right-mobile" style="display:none">
      <a href="<?php echo e($fruitCat2 ? route('category.show',$fruitCat2->slug) : route('shop')); ?>" class="mini-card mini-c1"><div class="mini-emoji">🍓</div><div class="mini-tag">Fresh Picks</div><div class="mini-title">Seasonal Fruits</div><div class="mini-cta">Shop Now →</div></a>
      <a href="<?php echo e($vegCat ? route('category.show',$vegCat->slug) : route('shop')); ?>" class="mini-card mini-c2"><div class="mini-emoji">🥦</div><div class="mini-tag">Farm Direct</div><div class="mini-title">Organic Veggies</div><div class="mini-cta">Shop Now →</div></a>
    </div>
  </div>
</div>


<div class="features-bar" style="margin-top:20px">
  <div class="features-bar-inner">
    <div class="feat-item"><div class="feat-icon">🚚</div><div><div class="feat-title">Free Delivery</div><div class="feat-sub">On orders above ₹499</div></div></div>
    <div class="feat-item"><div class="feat-icon">⚡</div><div><div class="feat-title">60-Min Express</div><div class="feat-sub">Ultra-fast delivery</div></div></div>
    <div class="feat-item"><div class="feat-icon">🌿</div><div><div class="feat-title">100% Fresh</div><div class="feat-sub">Farm to your doorstep</div></div></div>
    <div class="feat-item"><div class="feat-icon">🔒</div><div><div class="feat-title">Secure Payment</div><div class="feat-sub">Razorpay, UPI & COD</div></div></div>
  </div>
</div>


<div class="page-wrap">
  <div class="section">
    <div class="sec-header">
      <div>
        <div class="sec-title">Shop by <span>Category</span></div>
        <div class="sec-sub">Browse from <?php echo e($categories->count()); ?>+ product categories</div>
      </div>
      <a href="<?php echo e(route('shop')); ?>" class="sec-view-all">View All Categories →</a>
    </div>
    <div class="cat-scroll">
      <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php $icons = ['Vegetables'=>'🥬','Fruits'=>'🍎','Dairy & Eggs'=>'🥛','Meat & Fish'=>'🍗','Bakery'=>'🧁','Beverages'=>'🧃','Instant Food'=>'🍜','Personal Care'=>'🧴','Household'=>'🏠','Pet Care'=>'🐾']; $icon = $icons[$cat->name] ?? '🛒'; ?>
      <a href="<?php echo e(route('category.show', $cat->slug)); ?>" class="cat-box">
        <div class="cat-box-icon">
          <?php if($cat->image): ?>
            <img src="<?php echo e(asset('storage/'.$cat->image)); ?>" alt="<?php echo e($cat->name); ?>">
          <?php else: ?>
            <?php echo e($icon); ?>

          <?php endif; ?>
        </div>
        <div class="cat-box-name"><?php echo e($cat->name); ?></div>
        <div class="cat-box-count"><?php echo e($cat->activeProducts->count()); ?> items</div>
      </a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>

  
  <div class="section">
    <div class="sec-header">
      <div>
        <div class="sec-title">Featured <span>Products</span></div>
        <div class="sec-sub">Handpicked fresh products for you</div>
      </div>
      <a href="<?php echo e(route('shop')); ?>" class="sec-view-all">View All →</a>
    </div>
    <div class="tabs">
      <button class="tab-btn active" onclick="setTab(this)">All</button>
      <button class="tab-btn" onclick="setTab(this)">Vegetables</button>
      <button class="tab-btn" onclick="setTab(this)">Fruits</button>
      <button class="tab-btn" onclick="setTab(this)">Dairy</button>
      <button class="tab-btn" onclick="setTab(this)">Bestsellers</button>
    </div>
    <div class="products-row">
      <?php $__empty_1 = true; $__currentLoopData = $featured; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <?php $icons = ['Vegetables'=>'🥬','Fruits'=>'🍎','Dairy & Eggs'=>'🥛','Meat & Fish'=>'🍗','Bakery'=>'🧁','Beverages'=>'🧃','Instant Food'=>'🍜','Personal Care'=>'🧴','Household'=>'🏠','Pet Care'=>'🐾']; $pIcon = $icons[$product->category->name ?? ''] ?? '🛒'; ?>
      <div class="prod-card">
        <?php if($product->is_on_sale): ?><div class="prod-badge badge-sale"><?php echo e($product->discount_percent); ?>% OFF</div>
        <?php elseif($product->is_new_arrival): ?><div class="prod-badge badge-new">NEW</div>
        <?php elseif($product->is_bestseller): ?><div class="prod-badge badge-hot">HOT</div><?php endif; ?>
        <button class="prod-wish" onclick="toggleWish(this)" title="Add to Wishlist">🤍</button>
        <a href="<?php echo e(route('product.show', $product->slug)); ?>">
          <div class="prod-img-wrap">
            <?php if($product->thumbnail): ?>
              <img src="<?php echo e(asset('storage/'.$product->thumbnail)); ?>" alt="<?php echo e($product->name); ?>">
            <?php else: ?>
              <div class="prod-emoji"><?php echo e($pIcon); ?></div>
            <?php endif; ?>
          </div>
        </a>
        <div class="prod-body">
          <div class="prod-cat-tag"><?php echo e($product->category->name ?? ''); ?></div>
          <a href="<?php echo e(route('product.show', $product->slug)); ?>" style="text-decoration:none;color:inherit">
            <div class="prod-name"><?php echo e($product->name); ?></div>
          </a>
          <div class="prod-weight"><?php echo e($product->weight); ?> · <?php echo e($product->unit); ?></div>
          <div class="prod-rating">
            <span class="stars">★★★★☆</span>
            <span class="rating-n">(<?php echo e($product->approvedReviews->count()); ?>)</span>
          </div>
          <div class="prod-footer">
            <div class="prod-price-wrap">
              <div class="prod-price">₹<?php echo e(number_format($product->current_price)); ?></div>
              <?php if($product->is_on_sale): ?><div class="prod-price-old">₹<?php echo e(number_format($product->price)); ?></div><?php endif; ?>
            </div>
            <?php if($product->is_in_stock): ?>
            <form action="<?php echo e(route('cart.add')); ?>" method="POST">
              <?php echo csrf_field(); ?>
              <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
              <input type="hidden" name="qty" value="1">
              <button type="submit" class="btn-add" onclick="addToCartAnim(this)">+</button>
            </form>
            <?php else: ?>
              <button class="btn-add" disabled style="background:#e2e8f0;color:#9ca3af;cursor:not-allowed">✕</button>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <div style="grid-column:1/-1;text-align:center;padding:48px;color:#9ca3af">
        <div style="font-size:48px;margin-bottom:12px">🛒</div>
        <div style="font-size:15px;font-weight:600;margin-bottom:8px">No products yet</div>
        <a href="<?php echo e(route('admin.products.create')); ?>" style="color:#0d6e39;font-weight:600">Add products from Admin Panel →</a>
      </div>
      <?php endif; ?>
    </div>
  </div>

  
  <?php if($bestsellers->count() > 0): ?>
  <div class="section">
    <div class="sec-header">
      <div>
        <div class="sec-title">🔥 <span>Bestsellers</span></div>
        <div class="sec-sub">Most loved products by our customers</div>
      </div>
      <a href="<?php echo e(route('shop')); ?>" class="sec-view-all">View All →</a>
    </div>
    <div class="products-row">
      <?php $__currentLoopData = $bestsellers->take(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php $pIcon = ['Vegetables'=>'🥬','Fruits'=>'🍎','Dairy & Eggs'=>'🥛','Meat & Fish'=>'🍗','Bakery'=>'🧁','Beverages'=>'🧃'][$product->category->name ?? ''] ?? '🛒'; ?>
      <div class="prod-card">
        <div class="prod-badge badge-hot">BEST</div>
        <button class="prod-wish" onclick="toggleWish(this)">🤍</button>
        <a href="<?php echo e(route('product.show', $product->slug)); ?>">
          <div class="prod-img-wrap">
            <?php if($product->thumbnail): ?><img src="<?php echo e(asset('storage/'.$product->thumbnail)); ?>" alt="<?php echo e($product->name); ?>">
            <?php else: ?><div class="prod-emoji"><?php echo e($pIcon); ?></div><?php endif; ?>
          </div>
        </a>
        <div class="prod-body">
          <div class="prod-cat-tag"><?php echo e($product->category->name ?? ''); ?></div>
          <a href="<?php echo e(route('product.show',$product->slug)); ?>" style="text-decoration:none;color:inherit"><div class="prod-name"><?php echo e($product->name); ?></div></a>
          <div class="prod-weight"><?php echo e($product->weight); ?> · <?php echo e($product->unit); ?></div>
          <div class="prod-footer">
            <div class="prod-price-wrap">
              <div class="prod-price">₹<?php echo e(number_format($product->current_price)); ?></div>
              <?php if($product->is_on_sale): ?><div class="prod-price-old">₹<?php echo e(number_format($product->price)); ?></div><?php endif; ?>
            </div>
            <?php if($product->is_in_stock): ?>
            <form action="<?php echo e(route('cart.add')); ?>" method="POST"><?php echo csrf_field(); ?><input type="hidden" name="product_id" value="<?php echo e($product->id); ?>"><input type="hidden" name="qty" value="1"><button type="submit" class="btn-add" onclick="addToCartAnim(this)">+</button></form>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
  <?php endif; ?>

  
  <div class="section pb-40" style="padding-bottom:40px">
    <div class="sec-header">
      <div>
        <div class="sec-title">🔥 Exclusive <span>Offers</span></div>
        <div class="sec-sub">Limited time deals — grab before they're gone!</div>
      </div>
    </div>
    <div class="offer-grid">
      <a href="<?php echo e(route('offers')); ?>" class="offer-banner ob-1">
        <div class="ob-glow"></div><div class="ob-glow2"></div>
        <div class="ob-text">
          <div class="ob-eyebrow">Weekend Special</div>
          <div class="ob-title">30% OFF<br>Fresh Veggies</div>
          <div class="ob-sub">Code: VEGGIE30 · Min. order ₹299</div>
          <div class="ob-btn">Grab Deal →</div>
        </div>
        <div class="ob-emoji">🥗</div>
      </a>
      <a href="<?php echo e(route('register')); ?>" class="offer-banner ob-2">
        <div class="ob-glow"></div><div class="ob-glow2"></div>
        <div class="ob-text">
          <div class="ob-eyebrow">First Order</div>
          <div class="ob-title">Flat ₹100<br>OFF Welcome</div>
          <div class="ob-sub">Code: WELCOME100 · Min. order ₹299</div>
          <div class="ob-btn">Register Now →</div>
        </div>
        <div class="ob-emoji">🎁</div>
      </a>
      <a href="<?php echo e(route('shop')); ?>" class="offer-banner ob-3">
        <div class="ob-glow"></div><div class="ob-glow2"></div>
        <div class="ob-text">
          <div class="ob-eyebrow">Near You</div>
          <div class="ob-title">Earn ₹50<br>Per Referral</div>
          <div class="ob-sub">Mayur Vihar Phase-1 · Near Mitra Di Chap</div>
          <div class="ob-btn">Start Earning →</div>
        </div>
        <div class="ob-emoji">💰</div>
      </a>
    </div>
  </div>
</div>


<div class="reviews-bg">
  <div class="page-wrap">
    <div class="sec-header">
      <div>
        <div class="sec-title">What Customers <span>Say</span></div>
        <div class="sec-sub">Trusted by 10,000+ happy customers</div>
      </div>
    </div>
    <div class="reviews-grid">
      <div class="rev-card"><div class="rev-top"><div class="rev-avatar">RK</div><div><div class="rev-name">Rahul Kumar</div><div class="rev-date">2 days ago</div></div></div><div class="rev-stars">★★★★★</div><div class="rev-text">Vegetables are super fresh! Delivery was on time. Highly recommend to everyone in Mayur Vihar!</div><div class="rev-prod">✔ Verified • Mixed Vegetables Pack</div></div>
      <div class="rev-card"><div class="rev-top"><div class="rev-avatar" style="background:#7c3aed">PS</div><div><div class="rev-name">Priya Sharma</div><div class="rev-date">5 days ago</div></div></div><div class="rev-stars">★★★★★</div><div class="rev-text">Best grocery delivery in our area! Fruits are always fresh and prices are very competitive.</div><div class="rev-prod">✔ Verified • Seasonal Fruit Basket</div></div>
      <div class="rev-card"><div class="rev-top"><div class="rev-avatar" style="background:#c2410c">AM</div><div><div class="rev-name">Amit Mehta</div><div class="rev-date">1 week ago</div></div></div><div class="rev-stars">★★★★☆</div><div class="rev-text">Dairy products are always fresh. Milk and paneer quality is outstanding. 60-min delivery is real!</div><div class="rev-prod">✔ Verified • Daily Dairy Pack</div></div>
      <div class="rev-card"><div class="rev-top"><div class="rev-avatar" style="background:#0369a1">SK</div><div><div class="rev-name">Sunita Kumari</div><div class="rev-date">3 days ago</div></div></div><div class="rev-stars">★★★★★</div><div class="rev-text">Been ordering weekly for 3 months. Never disappointed. Customer support is very responsive!</div><div class="rev-prod">✔ Verified • Weekly Grocery Bundle</div></div>
    </div>
  </div>
</div>


<div class="newsletter">
  <div class="nl-inner">
    <div class="nl-icon">📧</div>
    <div class="nl-title">Get Exclusive Deals in Your Inbox</div>
    <div class="nl-sub">Subscribe and get 10% OFF on your next order. No spam, only fresh deals!</div>
    <div class="nl-form">
      <input class="nl-input" type="email" placeholder="Enter your email address...">
      <button class="nl-btn" type="button">Subscribe →</button>
    </div>
  </div>
</div>


<footer>
  <div class="footer-inner">
    <div class="footer-grid">
      <div>
        <div class="f-logo">All You <span>Want</span></div>
        <div class="f-desc">Your trusted online grocery store in Mayur Vihar Phase-1. Fresh produce, dairy & daily essentials delivered to your doorstep with love.</div>
        <div style="font-size:12.5px;color:rgba(255,255,255,.5);margin-bottom:12px">📍 Near Mitra Di Chap & Sameer Restaurant, Mayur Vihar Phase-1</div>
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
          <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
          <li><a href="<?php echo e(route('shop')); ?>">Shop</a></li>
          <li><a href="<?php echo e(route('offers')); ?>">Offers & Deals</a></li>
          <?php $__currentLoopData = $categories->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li><a href="<?php echo e(route('category.show', $cat->slug)); ?>"><?php echo e($cat->name); ?></a></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
      <div class="f-col">
        <h5>My Account</h5>
        <ul>
          <?php if(auth()->guard()->check()): ?>
          <li><a href="<?php echo e(route('account.index')); ?>">Dashboard</a></li>
          <li><a href="<?php echo e(route('order.index')); ?>">My Orders</a></li>
          <li><a href="<?php echo e(route('cart.index')); ?>">My Cart</a></li>
          <?php else: ?>
          <li><a href="<?php echo e(route('login')); ?>">Login</a></li>
          <li><a href="<?php echo e(route('register')); ?>">Register Free</a></li>
          <li><a href="<?php echo e(route('cart.index')); ?>">My Cart</a></li>
          <?php endif; ?>
        </ul>
      </div>
      <div class="f-col">
        <h5>Support</h5>
        <ul>
          <li><a href="tel:9911011411">📞 9911011411</a></li>
          <li><a href="mailto:help@allyouwant.in">📧 help@allyouwant.in</a></li>
          <li><a href="#">📍 Mayur Vihar Phase-1</a></li>
          <li><a href="#">🕐 Mon–Sat: 8AM–10PM</a></li>
        </ul>
      </div>
      <div>
        <div class="f-app-title" style="color:#fff;font-size:13px;font-weight:600;margin-bottom:10px">Download Our App</div>
        <div class="f-app-btns">
          <div class="f-app-btn"><div class="f-app-icon">🍎</div><div><div class="f-app-lbl" style="font-size:10px;color:rgba(255,255,255,.55)">Download on the</div><div style="font-size:13px;font-weight:600;color:#fff">App Store</div></div></div>
          <div class="f-app-btn"><div class="f-app-icon">🤖</div><div><div class="f-app-lbl" style="font-size:10px;color:rgba(255,255,255,.55)">Get it on</div><div style="font-size:13px;font-weight:600;color:#fff">Google Play</div></div></div>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="f-copy">© <?php echo e(date('Y')); ?> All You Want. All rights reserved. Made with ❤️</div>
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


<div class="mob-drawer" id="mobDrawer">
  <div class="mob-overlay" onclick="closeMenu()"></div>
  <div class="mob-panel">
    <div class="mob-panel-head">
      <div class="mob-panel-logo">All You <span>Want</span></div>
      <button class="mob-close" onclick="closeMenu()">✕</button>
    </div>
    <div style="padding:14px 18px;border-bottom:1px solid #f3f4f6">
      <form action="<?php echo e(route('shop.search')); ?>" method="GET">
        <input type="text" name="q" placeholder="Search vegetables, fruits..." style="width:100%;padding:10px 14px;border:1.5px solid #d1d5db;border-radius:8px;font-size:13.5px;outline:none;font-family:inherit">
      </form>
    </div>
    <div style="display:flex;gap:10px;padding:16px 18px">
      <?php if(auth()->guard()->check()): ?>
        <a href="<?php echo e(route('account.index')); ?>" class="mob-btn-login">My Account</a>
        <form action="<?php echo e(route('logout')); ?>" method="POST" style="flex:1"><?php echo csrf_field(); ?><button type="submit" class="mob-btn-reg" style="width:100%">Logout</button></form>
      <?php else: ?>
        <a href="<?php echo e(route('login')); ?>" class="mob-btn-login">Login</a>
        <a href="<?php echo e(route('register')); ?>" class="mob-btn-reg">Register</a>
      <?php endif; ?>
    </div>
    <div class="mob-nav-section">
      <div class="mob-nav-title">Categories</div>
      <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php $icons = ['Vegetables'=>'🥬','Fruits'=>'🍎','Dairy & Eggs'=>'🥛','Meat & Fish'=>'🍗','Bakery'=>'🧁','Beverages'=>'🧃','Instant Food'=>'🍜','Personal Care'=>'🧴','Household'=>'🏠','Pet Care'=>'🐾']; ?>
      <a href="<?php echo e(route('category.show', $cat->slug)); ?>" class="mob-nav-link"><span class="mob-icon"><?php echo e($icons[$cat->name] ?? '🛒'); ?></span> <?php echo e($cat->name); ?> <span class="mob-arrow">›</span></a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="mob-nav-section" style="border-top:1px solid #f3f4f6">
      <div class="mob-nav-title">My Account</div>
      <?php if(auth()->guard()->check()): ?>
      <a href="<?php echo e(route('account.index')); ?>" class="mob-nav-link"><span class="mob-icon">👤</span> My Profile</a>
      <a href="<?php echo e(route('order.index')); ?>" class="mob-nav-link"><span class="mob-icon">📦</span> My Orders</a>
      <a href="<?php echo e(route('cart.index')); ?>" class="mob-nav-link"><span class="mob-icon">🛒</span> My Cart</a>
      <?php else: ?>
      <a href="<?php echo e(route('login')); ?>" class="mob-nav-link"><span class="mob-icon">🔐</span> Login</a>
      <a href="<?php echo e(route('register')); ?>" class="mob-nav-link"><span class="mob-icon">✅</span> Register Free</a>
      <?php endif; ?>
    </div>
    <div class="mob-nav-section" style="border-top:1px solid #f3f4f6">
      <div class="mob-nav-title">Help</div>
      <a href="tel:9911011411" class="mob-nav-link"><span class="mob-icon">📞</span> 9911011411</a>
      <a href="<?php echo e(route('offers')); ?>" class="mob-nav-link"><span class="mob-icon">🔥</span> Today's Offers</a>
    </div>
  </div>
</div>


<div class="mob-bottom-nav">
  <div class="mob-bottom-nav-inner">
    <a href="<?php echo e(route('home')); ?>" class="mob-nav-item active">
      <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
      Home
    </a>
    <a href="<?php echo e(route('shop')); ?>" class="mob-nav-item">
      <svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
      Shop
    </a>
    <a href="<?php echo e(route('cart.index')); ?>" class="mob-nav-item" style="position:relative">
      <svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
      Cart
      <?php if($cartCount > 0): ?><span class="mob-nav-badge"><?php echo e($cartCount); ?></span><?php endif; ?>
    </a>
    <a href="<?php echo e(route('offers')); ?>" class="mob-nav-item">
      <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
      Offers
    </a>
    <a href="<?php echo e(auth()->check() ? route('account.index') : route('login')); ?>" class="mob-nav-item">
      <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
      Account
    </a>
  </div>
</div>


<a href="https://wa.me/919911011411?text=Hi, I want to order from All You Want" class="wa-btn" target="_blank">
  <div class="wa-pulse"></div>💬
</a>
<div class="back-top" onclick="window.scrollTo({top:0,behavior:'smooth'})">↑</div>

<script>
// Mobile menu
function openMenu(){document.getElementById('mobDrawer').classList.add('open');document.getElementById('menuBtn').classList.add('open');document.body.style.overflow='hidden'}
function closeMenu(){document.getElementById('mobDrawer').classList.remove('open');document.getElementById('menuBtn').classList.remove('open');document.body.style.overflow=''}

// Responsive
function handleResize(){
  const m=window.innerWidth<=768;
  const mc=document.querySelector('.mob-cart-icon');
  const mb=document.querySelector('.mob-menu-btn');
  const mm=document.querySelector('.hero-right-mobile');
  if(mc)mc.style.display=m?'flex':'none';
  if(mb)mb.style.display=m?'flex':'none';
  if(mm)mm.style.display=m?'grid':'none';
}
handleResize();
window.addEventListener('resize',handleResize);

// Slider
let cur=0;
const slides=document.querySelectorAll('.slide');
const dots=document.querySelectorAll('.dot');
let timer;
function goSlide(n){slides[cur].classList.remove('active');dots[cur].classList.remove('active');cur=n;slides[cur].classList.add('active');dots[cur].classList.add('active');clearInterval(timer);timer=setInterval(()=>goSlide((cur+1)%slides.length),4500)}
timer=setInterval(()=>goSlide((cur+1)%slides.length),4500);

// Touch swipe
let tx=0;
const sl=document.getElementById('heroSlider');
if(sl){sl.addEventListener('touchstart',e=>{tx=e.changedTouches[0].screenX},{passive:true});sl.addEventListener('touchend',e=>{const d=tx-e.changedTouches[0].screenX;if(Math.abs(d)>50)goSlide(d>0?(cur+1)%slides.length:(cur-1+slides.length)%slides.length)})}

// Wishlist
function toggleWish(el){el.textContent=el.textContent==='🤍'?'❤️':'🤍';el.style.background=el.textContent==='❤️'?'#fff0f0':''}

// Cart animation
function addToCartAnim(btn){btn.textContent='✓';btn.style.background='#0a5a2e';setTimeout(()=>{btn.textContent='+';btn.style.background=''},1800)}

// Tabs
function setTab(el){document.querySelectorAll('.tab-btn').forEach(b=>b.classList.remove('active'));el.classList.add('active')}

// Scroll reveal
const io=new IntersectionObserver(entries=>entries.forEach(e=>{if(e.isIntersecting){e.target.style.opacity='1';e.target.style.transform='translateY(0)'}}),{threshold:.06});
document.querySelectorAll('.prod-card,.cat-box,.rev-card,.offer-banner,.feat-item').forEach(el=>{el.style.opacity='0';el.style.transform='translateY(16px)';el.style.transition='opacity .4s ease,transform .4s ease';io.observe(el)});

// Back to top
window.addEventListener('scroll',()=>{const b=document.querySelector('.back-top');if(b)b.style.display=window.scrollY>400?'flex':'none'});
</script>
</body>
</html><?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views/frontend/home.blade.php ENDPATH**/ ?>