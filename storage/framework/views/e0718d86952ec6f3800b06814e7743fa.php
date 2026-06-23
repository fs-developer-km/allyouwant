<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth;-webkit-text-size-adjust:100%}
body{font-family:'Inter',sans-serif;background:#f0f2f2;color:#0F1111;-webkit-font-smoothing:antialiased;overflow-x:hidden}
a{text-decoration:none;color:inherit}
img{display:block;max-width:100%}
button,input,textarea,select{font-family:inherit;outline:none}
:root{
  --green:#007600;--green2:#00a650;--green-lt:#f0fff4;
  --orange:#c45500;--red:#B12704;--gold:#f5a623;
  --blue:#007185;--blue2:#0066c0;
  --border:#ddd;--border2:#e7e7e7;
  --bg:#f0f2f2;--white:#fff;
  --text:#0F1111;--text2:#565959;--muted:#767676;
  --shadow:0 2px 5px rgba(213,217,217,.5);
  --shadow2:0 2px 8px rgba(0,0,0,.15);
  --r:8px;
}

/* ─── NAVBAR ──────────────────────────────── */


/* ─── BREADCRUMB ──────────────────────────── */
.breadcrumb{background:#fff;padding:8px 0;border-bottom:1px solid var(--border2)}
.bc-inner{max-width:1500px;margin:0 auto;padding:0 20px;display:flex;align-items:center;gap:4px;font-size:12.5px;color:var(--muted);flex-wrap:wrap}
.bc-inner a{color:var(--blue);transition:color .1s}
.bc-inner a:hover{color:#c45500;text-decoration:underline}
.bc-sep{color:#ccc;font-size:11px}

/* ─── ALERT ───────────────────────────────── */
.alert{padding:10px 20px;font-size:13px;font-weight:500}
.alert-success{background:#e7f9e7;color:#007600;border-bottom:1px solid #b6dfb6}
.alert-error{background:#fff3f3;color:#c0392b;border-bottom:1px solid #f5c6cb}

/* ─── MAIN PAGE WRAP ──────────────────────── */
.page-wrap{max-width:1500px;margin:0 auto;padding:16px 20px}

/* ─── PRODUCT LAYOUT (Amazon Style) ────────── */
/* Desktop: Left image strip | Middle main img | Right info | Far right buy box */
.prod-layout{display:grid;grid-template-columns:60px 1fr 1fr 300px;gap:0;background:var(--white);border-radius:var(--r);padding:20px 16px;box-shadow:var(--shadow)}
/* Thumb strip */
.thumb-col{display:flex;flex-direction:column;gap:7px;padding-right:10px}
.thumb-wrap{width:54px;height:54px;border:2px solid var(--border);border-radius:5px;overflow:hidden;cursor:pointer;display:flex;align-items:center;justify-content:center;background:#f8f8f8;font-size:22px;transition:border-color .15s;flex-shrink:0}
.thumb-wrap:hover,.thumb-wrap.active{border-color:#c45500;box-shadow:0 0 0 3px rgba(196,85,0,.15)}
.thumb-wrap img{width:100%;height:100%;object-fit:contain}
/* Main image */
.main-img-col{padding:0 16px 0 6px;display:flex;flex-direction:column;align-items:center;justify-content:flex-start}
.main-img-box{position:relative;width:100%;max-width:440px;aspect-ratio:1;border:1px solid var(--border2);border-radius:6px;overflow:hidden;background:#fff;cursor:zoom-in;display:flex;align-items:center;justify-content:center}
.main-img-box img{max-width:100%;max-height:100%;object-fit:contain;transition:transform .3s ease}
.main-img-box:hover img{transform:scale(1.08)}
.main-img-emoji{font-size:160px;line-height:1}
.img-badges{position:absolute;top:10px;left:10px;display:flex;flex-direction:column;gap:5px;z-index:3}
.img-badge{font-size:10.5px;font-weight:800;padding:3px 10px;border-radius:4px;display:inline-block}
.ib-deal{background:#cc0c39;color:#fff}
.ib-new{background:var(--green);color:#fff}
.ib-hot{background:#c45500;color:#fff}
.ib-out{background:#555;color:#fff}
.main-img-actions{display:flex;gap:10px;margin-top:12px;width:100%;max-width:440px}
.img-action-btn{flex:1;display:flex;align-items:center;justify-content:center;gap:5px;padding:8px 12px;border:1px solid var(--border);border-radius:20px;font-size:12.5px;font-weight:600;color:var(--blue2);cursor:pointer;background:var(--white);transition:all .15s}
.img-action-btn:hover{background:#f5f5f5;border-color:var(--blue2)}
.img-action-btn svg{width:15px;height:15px;stroke:currentColor;fill:none;stroke-width:2}
.img-action-btn.wishlisted{color:#c7511f;border-color:#c7511f}

/* ─── INFO COLUMN ─────────────────────────── */
.info-col{padding:0 20px 0 16px;border-left:1px solid var(--border2)}
.prod-cat-link{font-size:12px;color:var(--blue2);margin-bottom:6px;display:block}
.prod-cat-link:hover{color:var(--orange);text-decoration:underline}
.prod-h1{font-size:21px;font-weight:400;color:var(--text);line-height:1.35;margin-bottom:10px}
.prod-brand{font-size:13px;color:var(--blue2);margin-bottom:10px}
.prod-brand:hover{text-decoration:underline;cursor:pointer}
/* Rating bar */
.rating-row{display:flex;align-items:center;gap:8px;margin-bottom:12px;padding-bottom:12px;border-bottom:1px solid var(--border2);flex-wrap:wrap}
.stars-display{display:flex;align-items:center;gap:2px}
.star-icons{color:#e47911;font-size:15px;letter-spacing:-1px;line-height:1}
.star-val{font-size:13px;color:var(--blue2);cursor:pointer;text-decoration:none}
.star-val:hover{text-decoration:underline;color:var(--orange)}
.review-cnt{font-size:13px;color:var(--blue2);cursor:pointer}
.review-cnt:hover{text-decoration:underline;color:var(--orange)}
.sep-dot{color:var(--border);font-size:16px}
.badge-bestseller{background:#e0a800;color:#111;font-size:11px;font-weight:800;padding:2px 9px;border-radius:3px;display:inline-flex;align-items:center;gap:4px}
/* Price section */
.price-section{padding:10px 0;margin-bottom:10px}
.deal-label{font-size:12.5px;font-weight:600;color:#cc0c39;background:#fff5f5;border:1px solid #ffc0c0;padding:3px 9px;border-radius:3px;display:inline-block;margin-bottom:8px}
.price-row{display:flex;align-items:baseline;gap:10px;flex-wrap:wrap;margin-bottom:4px}
.price-current{font-size:28px;font-weight:400;color:#B12704;line-height:1}
.price-current .p-symbol{font-size:14px;vertical-align:super;line-height:1;margin-right:1px}
.price-mrp-row{font-size:13px;color:var(--text2);margin-bottom:3px}
.price-mrp{text-decoration:line-through;color:var(--muted)}
.saving-text{font-size:13px;color:var(--green);font-weight:600}
.price-unit{font-size:12.5px;color:var(--muted);margin-top:4px}
.emi-text{font-size:12.5px;color:var(--blue2);margin-top:6px;cursor:pointer}
.emi-text:hover{text-decoration:underline}
/* Stock */
.stock-row{margin:10px 0;font-size:16px;font-weight:700}
.in-stock-txt{color:var(--green)}
.out-stock-txt{color:var(--red)}
.low-stock-txt{color:#c45500}
/* Size/Variant */
.size-section{margin-bottom:14px}
.size-label{font-size:13px;font-weight:700;color:var(--text);margin-bottom:8px}
.size-label span{font-weight:400;color:var(--text2)}
.size-pills{display:flex;gap:7px;flex-wrap:wrap}
.size-pill{padding:7px 14px;border:1.5px solid var(--border);border-radius:var(--r);font-size:13px;color:var(--text);cursor:pointer;transition:all .15s;background:var(--white)}
.size-pill:hover{border-color:#c45500}
.size-pill.active{border-color:#c45500;border-width:2px;box-shadow:0 0 0 2px rgba(196,85,0,.15)}
/* Highlights */
.highlights{margin:12px 0;padding:0}
.highlight-item{display:flex;gap:8px;font-size:13px;color:var(--text2);padding:5px 0;line-height:1.5}
.highlight-icon{color:var(--green);flex-shrink:0;font-size:14px;margin-top:1px}
/* About */
.about-section{margin:14px 0;border-top:1px solid var(--border2);padding-top:14px}
.about-title{font-size:16px;font-weight:700;color:var(--text);margin-bottom:10px}
.about-list{padding-left:18px}
.about-list li{font-size:13.5px;color:var(--text2);margin-bottom:6px;line-height:1.5}
/* Full Description */
.desc-collapse{margin-top:10px}
.desc-text{font-size:13.5px;color:var(--text2);line-height:1.75;overflow:hidden;transition:max-height .3s}
.desc-read-more{color:var(--blue2);font-size:13px;font-weight:600;cursor:pointer;margin-top:6px;display:inline-block}
.desc-read-more:hover{color:var(--orange);text-decoration:underline}

/* ─── BUY BOX (Right) ─────────────────────── */
.buy-box{border:1px solid var(--border);border-radius:var(--r);padding:18px;background:var(--white);position:sticky;top:70px}
.buy-price{font-size:26px;font-weight:400;color:#B12704;margin-bottom:2px}
.buy-price .bp-sym{font-size:14px;vertical-align:super}
.buy-mrp-row{font-size:12.5px;color:var(--muted);margin-bottom:6px}
.buy-saving{font-size:13px;color:var(--green);font-weight:600;margin-bottom:12px}
.buy-delivery-row{font-size:13px;color:var(--text2);margin-bottom:6px;line-height:1.5}
.buy-delivery-row a{color:var(--blue2);text-decoration:none}
.buy-delivery-row a:hover{color:var(--orange);text-decoration:underline}
.buy-stock{font-size:17px;font-weight:700;color:var(--green);margin:10px 0}
.buy-stock.out{color:var(--red)}
.buy-stock.low{color:#c45500}
/* Qty selector */
.buy-qty-row{display:flex;align-items:center;gap:10px;margin:12px 0}
.buy-qty-label{font-size:13px;font-weight:600;color:var(--text);flex-shrink:0}
.qty-ctrl{display:flex;align-items:center;border:1px solid var(--border);border-radius:var(--r);overflow:hidden;background:#f0f2f2}
.qty-btn{width:34px;height:34px;background:transparent;border:none;font-size:18px;cursor:pointer;display:flex;align-items:center;justify-content:center;color:var(--text);transition:background .15s}
.qty-btn:hover{background:#e3e6e6}
.qty-val{width:40px;height:34px;border:none;border-left:1px solid var(--border);border-right:1px solid var(--border);text-align:center;font-size:14px;font-weight:700;background:#fff}
/* Buy buttons */
.btn-add-cart{width:100%;background:#0d6e39;border:1px solid #1d431d;border-radius:20px;padding:11px 18px;font-size:14px;font-weight:500;color:#fff;cursor:pointer;margin-bottom:9px;transition:background .15s;display:flex;align-items:center;justify-content:center;gap:7px}
.btn-add-cart:hover{background:#4b9638}
.btn-add-cart:disabled{background:#f0f2f2;border-color:#ddd;color:#999;cursor:not-allowed}
.btn-buy-now{width:100%;background:#ff9900;border:1px solid #e68a00;border-radius:20px;padding:11px 18px;font-size:14px;font-weight:500;color:#111;cursor:pointer;margin-bottom:12px;transition:background .15s;display:block;text-align:center}
.btn-buy-now:hover{background:#f09000}
.buy-box-info{font-size:12.5px;color:var(--text2);border-top:1px solid var(--border2);padding-top:10px;margin-top:6px}
.buy-box-row{display:flex;justify-content:space-between;margin-bottom:5px;font-size:12.5px}
.buy-box-row span:first-child{font-weight:600;color:var(--text)}
.buy-box-row a{color:var(--blue2);text-decoration:none}
.buy-box-row a:hover{text-decoration:underline;color:var(--orange)}
/* Coupon */
.coupon-row{margin:10px 0;font-size:13px;display:flex;align-items:center;gap:8px;flex-wrap:wrap}
.coupon-cb{width:15px;height:15px;cursor:pointer;accent-color:var(--green)}
.coupon-label{color:var(--text2)}
.coupon-code{background:#f5f5f5;border:1px dashed var(--green);color:var(--green);font-weight:800;font-size:12px;padding:2px 8px;border-radius:4px;letter-spacing:.3px}
/* Pincode */
.pincode-row{margin:10px 0;font-size:13px;color:var(--text2)}
.pincode-inp-row{display:flex;gap:8px;margin-top:6px}
.pincode-inp{flex:1;padding:7px 11px;border:1px solid var(--border);border-radius:5px;font-size:13px}
.pincode-inp:focus{border-color:#c45500;box-shadow:0 0 0 2px rgba(196,85,0,.1)}
.pincode-check-btn{padding:7px 14px;background:#fff;border:1px solid var(--blue2);border-radius:5px;color:var(--blue2);font-size:13px;font-weight:600;cursor:pointer;transition:all .15s;white-space:nowrap}
.pincode-check-btn:hover{background:var(--blue2);color:#fff}
.pincode-result{font-size:12.5px;margin-top:6px;display:none}
/* Secure badge */
.secure-badge{display:flex;align-items:center;gap:6px;background:#f0f2f2;border-radius:5px;padding:8px 12px;margin-top:10px;font-size:12px;color:var(--text2)}

/* ─── TABS / PRODUCT INFO SECTION ─────────── */
.info-tabs-section{background:var(--white);border-radius:var(--r);margin-top:16px;box-shadow:var(--shadow);overflow:hidden}
.tab-nav-bar{display:flex;border-bottom:2px solid var(--border2);padding:0 20px;overflow-x:auto;scrollbar-width:none;background:#fff}
.tab-nav-bar::-webkit-scrollbar{display:none}
.tab-nav-btn{padding:14px 20px;font-size:14px;font-weight:600;color:var(--muted);cursor:pointer;border:none;background:none;border-bottom:3px solid transparent;margin-bottom:-2px;transition:all .2s;white-space:nowrap;font-family:inherit}
.tab-nav-btn:hover{color:var(--text)}
.tab-nav-btn.active{color:#c45500;border-bottom-color:#c45500}
.tab-content-wrap{padding:24px}
.tab-pane{display:none}
.tab-pane.active{display:block}
/* Spec table */
.spec-table{width:100%;border-collapse:collapse;max-width:700px}
.spec-table tr{border-bottom:1px solid var(--border2)}
.spec-table tr:last-child{border-bottom:none}
.spec-table tr:nth-child(odd) td:first-child{background:#f8f8f8}
.spec-table tr:nth-child(even) td:first-child{background:#f0f2f2}
.spec-table td{padding:11px 16px;font-size:13.5px;vertical-align:top}
.spec-table td:first-child{color:var(--text);font-weight:600;width:200px;border-right:1px solid var(--border2)}
.spec-table td:last-child{color:var(--text2)}
/* Nutrition */
.nutrition-table{max-width:400px;border:2px solid var(--text);border-radius:4px;overflow:hidden;margin-top:8px}
.nt-head{background:var(--text);color:#fff;padding:10px 14px;font-size:16px;font-weight:900}
.nt-sub{padding:5px 14px;background:#f8f8f8;font-size:12px;color:var(--muted);border-bottom:6px solid var(--text)}
.nt-row{display:flex;justify-content:space-between;align-items:center;padding:8px 14px;border-bottom:1px solid var(--border2);font-size:13px}
.nt-row:last-child{border-bottom:none}
.nt-row.heavy{border-top:4px solid var(--text)}
.nt-key{color:var(--text2)}
.nt-val{font-weight:700;color:var(--text)}
.nt-row.total{font-weight:800;background:#f8f8f8}
/* Reviews */
.reviews-header{display:flex;gap:40px;margin-bottom:24px;flex-wrap:wrap}
.rating-overview{text-align:center;min-width:100px}
.big-rating{font-size:60px;font-weight:400;color:var(--text);line-height:1}
.big-stars{color:#e47911;font-size:24px;letter-spacing:-1px;margin:6px 0}
.big-total{font-size:13px;color:var(--muted)}
.rating-breakdown{flex:1;min-width:200px}
.rb-row{display:flex;align-items:center;gap:10px;margin-bottom:8px;cursor:pointer}
.rb-label{font-size:12.5px;color:var(--blue2);width:50px;flex-shrink:0;text-decoration:underline}
.rb-track{flex:1;height:8px;background:#e8e8e8;border-radius:4px;overflow:hidden}
.rb-fill{height:100%;border-radius:4px;background:#e47911;transition:width .6s}
.rb-cnt{font-size:12px;color:var(--muted);width:28px}
.review-item{border-top:1px solid var(--border2);padding:18px 0}
.ri-head{display:flex;align-items:center;gap:10px;margin-bottom:8px}
.ri-avatar{width:38px;height:38px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;font-weight:700;flex-shrink:0}
.ri-name{font-size:13.5px;font-weight:700;color:var(--text)}
.ri-stars{color:#e47911;font-size:13px;letter-spacing:-.5px;margin-right:6px}
.ri-title{font-size:14px;font-weight:700;color:var(--text);margin-bottom:4px}
.ri-date{font-size:12px;color:var(--muted)}
.ri-verified{font-size:12px;color:var(--green);margin-bottom:6px;display:flex;align-items:center;gap:4px}
.ri-body{font-size:13.5px;color:var(--text2);line-height:1.7}
.ri-helpful{display:flex;align-items:center;gap:8px;margin-top:10px;font-size:13px;color:var(--muted)}
.helpful-btn{padding:4px 12px;border:1px solid var(--border);border-radius:4px;background:#f7f7f7;font-size:12.5px;font-weight:600;cursor:pointer;color:var(--text2);transition:all .15s;font-family:inherit}
.helpful-btn:hover{background:#e8e8e8}
/* Write Review */
.wr-box{background:#f9f9f9;border:1px solid var(--border2);border-radius:var(--r);padding:22px;margin-top:22px}
.wr-title{font-size:17px;font-weight:700;color:var(--text);margin-bottom:16px}
.wr-stars-row{display:flex;gap:8px;margin-bottom:14px}
.wr-star{font-size:30px;color:#ddd;cursor:pointer;transition:color .1s;line-height:1}
.wr-star.active,.wr-star:hover{color:#e47911}
.wr-label{font-size:13px;font-weight:700;color:var(--text);margin-bottom:5px;display:block}
.wr-inp{width:100%;padding:10px 13px;border:1px solid var(--border);border-radius:5px;font-size:13.5px;background:#fff;color:var(--text);margin-bottom:12px;resize:vertical}
.wr-inp:focus{border-color:#c45500;box-shadow:0 0 0 2px rgba(196,85,0,.1)}
.wr-submit{background:#ffd814;border:1px solid #fcd200;border-radius:20px;padding:10px 24px;font-size:14px;font-weight:600;cursor:pointer;color:#111;transition:background .15s}
.wr-submit:hover{background:#f7ca00}
/* Q&A */
.qa-item{border-top:1px solid var(--border2);padding:14px 0}
.qa-q{font-size:14px;font-weight:700;color:var(--text);margin-bottom:8px;display:flex;gap:8px}
.qa-q-icon{color:var(--orange);flex-shrink:0}
.qa-a{font-size:13.5px;color:var(--text2);padding-left:22px;border-left:3px solid var(--green);line-height:1.65}
.qa-by{font-size:12px;color:var(--muted);margin-top:4px}
/* Shipping */
.ship-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:14px}
.ship-card{border:1px solid var(--border2);border-radius:var(--r);padding:16px;background:#fafafa}
.ship-icon{font-size:22px;margin-bottom:8px}
.ship-title{font-size:14px;font-weight:700;color:var(--text);margin-bottom:6px}
.ship-body{font-size:13px;color:var(--text2);line-height:1.65}
.ship-tag{font-size:12px;font-weight:700;color:var(--green);margin-top:6px}

/* ─── RELATED PRODUCTS SECTION ────────────── */
.related-section{background:var(--white);border-radius:var(--r);margin-top:16px;padding:20px;box-shadow:var(--shadow)}
.related-section-title{font-size:20px;font-weight:700;color:var(--text);margin-bottom:16px;padding-bottom:10px;border-bottom:1px solid var(--border2)}
/* Amazon style product grid */
.prod-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:0;border-top:1px solid var(--border2);border-left:1px solid var(--border2)}
.prod-grid-card{border-right:1px solid var(--border2);border-bottom:1px solid var(--border2);padding:14px;position:relative;background:var(--white);transition:box-shadow .2s;display:flex;flex-direction:column}
.prod-grid-card:hover{box-shadow:0 2px 12px rgba(0,0,0,.12);z-index:2}
.pgc-img{width:100%;aspect-ratio:1;display:flex;align-items:center;justify-content:center;overflow:hidden;background:#f8f8f8;border-radius:4px;margin-bottom:10px;font-size:60px;position:relative}
.pgc-img img{width:100%;height:100%;object-fit:contain;transition:transform .3s}
.prod-grid-card:hover .pgc-img img{transform:scale(1.05)}
.pgc-badge{position:absolute;top:6px;left:6px;font-size:10px;font-weight:800;padding:2px 8px;border-radius:3px}
.pgcb-deal{background:#cc0c39;color:#fff}
.pgcb-new{background:var(--green);color:#fff}
.pgc-name{font-size:13px;color:var(--blue2);line-height:1.35;margin-bottom:5px;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;flex:1;cursor:pointer}
.pgc-name:hover{color:var(--orange)}
.pgc-stars{color:#e47911;font-size:12px;letter-spacing:-.5px;margin-bottom:5px;display:flex;align-items:center;gap:5px}
.pgc-stars span{font-size:11.5px;color:var(--blue2)}
.pgc-price-row{display:flex;align-items:baseline;gap:6px;margin-bottom:6px;flex-wrap:wrap}
.pgc-price{font-size:17px;font-weight:400;color:#B12704}
.pgc-price .pcs{font-size:11px;vertical-align:super}
.pgc-price-old{font-size:12px;color:var(--muted);text-decoration:line-through}
.pgc-discount{font-size:12px;color:var(--green);font-weight:600}
.pgc-add-btn{width:100%;background:#0d6e39;border:1px solid #001309;border-radius:20px;padding:7px 14px;font-size:13px;font-weight:500;color:#fff;cursor:pointer;margin-top:auto;transition:background .15s}
.pgc-add-btn:hover{background:#038841}
.pgc-add-btn:disabled{background:#f0f2f2;border-color:#ddd;color:#999;cursor:not-allowed}

/* ─── TOAST ───────────────────────────────── */
.toast-container{position:fixed;bottom:20px;left:50%;transform:translateX(-50%);z-index:9999;display:flex;flex-direction:column;align-items:center;gap:8px;pointer-events:none}
.toast{background:#333;color:#fff;padding:12px 24px;border-radius:6px;font-size:14px;font-weight:500;display:flex;align-items:center;gap:8px;box-shadow:0 4px 20px rgba(0,0,0,.3);animation:tIn .3s ease;pointer-events:all;white-space:nowrap;max-width:90vw}
.toast.green{background:#007600}
.toast.red{background:#B12704}
.toast.orange{background:#c45500}
@keyframes tIn{from{opacity:0;transform:translateY(14px)}to{opacity:1;transform:translateY(0)}}

/* ─── STICKY MOBILE BAR ───────────────────── */
.mob-sticky{position:fixed;bottom:0;left:0;right:0;background:var(--white);border-top:1px solid var(--border);padding:10px 16px;z-index:500;display:none;gap:10px;align-items:center;box-shadow:0 -3px 12px rgba(0,0,0,.08)}
.mob-sticky-info{flex:1;min-width:0}
.mob-sticky-name{font-size:13px;font-weight:700;color:var(--text);white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.mob-sticky-price{font-size:16px;font-weight:700;color:#B12704}
.mob-sticky-btn{background:#0d6e39;border:1px solid #0d6e39;border-radius:20px;padding:11px 20px;font-size:14px;font-weight:600;cursor:pointer;white-space:nowrap;color:#fff}
.mob-sticky-btn:hover{background:#0d6e39}

/* ─── WHATSAPP ────────────────────────────── */
.wa-btn{position:fixed;bottom:76px;right:16px;width:50px;height:50px;background:#25d366;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:24px;z-index:999;box-shadow:0 3px 16px rgba(37,211,102,.45);text-decoration:none;transition:transform .2s}
.wa-btn:hover{transform:scale(1.1)}
.back-top-btn{position:fixed;bottom:76px;right:76px;width:38px;height:38px;background:rgba(0,0,0,.4);border-radius:50%;display:none;align-items:center;justify-content:center;color:#fff;font-size:16px;cursor:pointer;z-index:999;transition:background .15s;border:none}
.back-top-btn:hover{background:rgba(0,0,0,.6)}

/* ─── RESPONSIVE ──────────────────────────── */
@media(max-width:1280px){
  .prod-layout{grid-template-columns:60px 1fr 1fr 280px}
  .prod-grid{grid-template-columns:repeat(4,1fr)}
}
@media(max-width:1100px){
  .prod-layout{grid-template-columns:56px 1fr 1fr 260px;padding:16px 12px}
  .prod-grid{grid-template-columns:repeat(4,1fr)}
  .info-col{padding:0 14px}
}
@media(max-width:900px){
  .prod-layout{grid-template-columns:50px 1fr 1fr;gap:0}
  .buy-box-col{display:none}
  .mob-sticky{display:flex}
  body{padding-bottom:72px}
  .prod-grid{grid-template-columns:repeat(3,1fr)}
}
@media(max-width:700px){
  .navbar .nav-top{padding:8px 12px;gap:6px}
  .deliver-box{display:none}
  .nav-right .nav-link-box:not(.cart-link){display:none}
  .prod-layout{grid-template-columns:48px 1fr;gap:0;padding:12px}
  .info-col{padding:0 0 0 10px;border-left:none;width: 320px}
  .main-img-box{max-width:100%;aspect-ratio:1}
  .main-img-col{padding:0 0 12px 15px}
  .main-img-actions{max-width:100%}
  .prod-h1{font-size:17px}
  .price-current{font-size:22px}
  .info-tabs-section .tab-content-wrap{padding:16px}
  .ship-grid{grid-template-columns:1fr}
  .prod-grid{grid-template-columns:repeat(2,1fr)}
  .reviews-header{gap:20px}
  .big-rating{font-size:48px}
  .spec-table{font-size:12.5px}
  .spec-table td{padding:9px 10px}
}
@media(max-width:480px){
  .prod-layout{grid-template-columns:44px 1fr;padding:10px 10px}
  .thumb-wrap{width:44px;height:44px}
  .prod-grid{grid-template-columns:repeat(2,1fr)}
  .pgc-img{font-size:44px}
  .prod-h1{font-size:16px}
  .page-wrap{padding:10px 12px}
  .bc-inner{font-size:12px;padding:0 12px}
  .related-section{padding:14px}
}
</style>
</head>
<body>



<?php $__env->startSection('content'); ?>


<div class="breadcrumb">
  <div class="bc-inner">
    <a href="<?php echo e(route('home')); ?>">All You Want</a>
    <span class="bc-sep">›</span>
    <?php if($product->category): ?>
      <a href="<?php echo e(route('category.show',$product->category->slug)); ?>"><?php echo e($product->category->name); ?></a>
      <span class="bc-sep">›</span>
    <?php endif; ?>
    <span style="color:var(--text2)"><?php echo e(Str::limit($product->name, 60)); ?></span>
  </div>
</div>

<?php if(session('success')): ?><div class="alert alert-success">✅ <?php echo e(session('success')); ?></div><?php endif; ?>
<?php if(session('error')): ?><div class="alert alert-error">❌ <?php echo e(session('error')); ?></div><?php endif; ?>

<div class="page-wrap">

  
  <div class="prod-layout">

    
    <div class="thumb-col">
      <?php if($product->thumbnail): ?>
      <div class="thumb-wrap active" onclick="changeImg('<?php echo e(asset('storage/'.$product->thumbnail)); ?>',this)">
        <img src="<?php echo e(asset('storage/'.$product->thumbnail)); ?>" alt="Main">
      </div>
      <?php endif; ?>
      <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="thumb-wrap" onclick="changeImg('<?php echo e(asset('storage/'.$img->image)); ?>',this)">
        <img src="<?php echo e(asset('storage/'.$img->image)); ?>" alt="">
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php if(!$product->thumbnail && $product->images->count() === 0): ?>
        <?php $pIcon = ['Vegetables'=>'🥬','Fruits'=>'🍎','Dairy & Eggs'=>'🥛','Meat & Fish'=>'🍗','Bakery'=>'🧁','Beverages'=>'🧃','Instant Food'=>'🍜','Personal Care'=>'🧴','Household'=>'🏠','Pet Care'=>'🐾'][$product->category->name??'']??'🛒'; ?>
        <div class="thumb-wrap active"><?php echo e($pIcon); ?></div>
      <?php endif; ?>
    </div>

    
    <div class="main-img-col">
      <div class="main-img-box">
        <div class="img-badges">
          <?php if(!$product->is_in_stock): ?><span class="img-badge ib-out">Out of Stock</span>
          <?php elseif($product->is_on_sale): ?><span class="img-badge ib-deal"><?php echo e($product->discount_percent); ?>% off</span><?php endif; ?>
          <?php if($product->is_new_arrival): ?><span class="img-badge ib-new">New</span><?php endif; ?>
          <?php if($product->is_bestseller): ?><span class="img-badge ib-hot">Best Seller</span><?php endif; ?>
        </div>
        <?php if($product->thumbnail): ?>
          <img src="<?php echo e(asset('storage/'.$product->thumbnail)); ?>" alt="<?php echo e($product->name); ?>" id="mainImgEl">
        <?php else: ?>
          <?php $pIcon = ['Vegetables'=>'🥬','Fruits'=>'🍎','Dairy & Eggs'=>'🥛','Meat & Fish'=>'🍗','Bakery'=>'🧁','Beverages'=>'🧃','Instant Food'=>'🍜','Personal Care'=>'🧴','Household'=>'🏠','Pet Care'=>'🐾'][$product->category->name??'']??'🛒'; ?>
          <div class="main-img-emoji"><?php echo e($pIcon); ?></div>
        <?php endif; ?>
      </div>
      <div class="main-img-actions">
        <button class="img-action-btn" id="wishBtn" onclick="toggleWishlist(<?php echo e($product->id); ?>)">
          <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
          Add to Wish List
        </button>
        <button class="img-action-btn" onclick="shareProduct()">
          <svg viewBox="0 0 24 24"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
          Share
        </button>
      </div>
    </div>

    
    <div class="info-col">
      <?php if($product->category): ?>
        <a href="<?php echo e(route('category.show',$product->category->slug)); ?>" class="prod-cat-link">
          <?php echo e($product->category->name); ?>

        </a>
      <?php endif; ?>
      <h1 class="prod-h1"><?php echo e($product->name); ?></h1>
      <div class="prod-brand">
        Brand: <a href="<?php echo e(route('category.show',$product->category->slug ?? '#')); ?>" style="color:var(--blue2)">All You Want Grocery</a>
        <?php if($product->sku): ?> &nbsp;|&nbsp; SKU: <?php echo e($product->sku); ?><?php endif; ?>
      </div>
      
      <?php
        $avgRating = $product->approvedReviews->avg('rating') ?: 0;
        $reviewCount = $product->approvedReviews->count();
      ?>
      <div class="rating-row">
        <div class="stars-display">
          <div class="star-icons">
            <?php for($i=1;$i<=5;$i++): ?><?php echo e($i<=round($avgRating)?'★':'☆'); ?><?php endfor; ?>
          </div>
          <a href="#tab-reviews" onclick="openTab('reviews',document.querySelector('[data-tab=reviews]'))" class="star-val"><?php echo e(number_format($avgRating,1)); ?></a>
        </div>
        <a href="#tab-reviews" class="review-cnt"><?php echo e($reviewCount); ?> ratings</a>
        <?php if($product->is_bestseller): ?>
          <span class="badge-bestseller">#1 Best Seller</span>
        <?php endif; ?>
      </div>
      
      <div class="price-section" style="border-top:1px solid var(--border2);padding-top:14px">
        <?php if($product->is_on_sale): ?>
          <div class="deal-label">🏷️ Limited Time Deal</div>
        <?php endif; ?>
        <div class="price-row">
          <div class="price-current">
            <span class="p-symbol">₹</span><?php echo e(number_format($product->current_price)); ?>

          </div>
          <?php if($product->is_on_sale): ?>
            <div style="font-size:14px;color:var(--green);font-weight:700;align-self:center"><?php echo e($product->discount_percent); ?>% off</div>
          <?php endif; ?>
        </div>
        <?php if($product->is_on_sale): ?>
          <div class="price-mrp-row">
            M.R.P.: <span class="price-mrp">₹<?php echo e(number_format($product->price)); ?></span>
          </div>
          <div class="saving-text">You Save: ₹<?php echo e(number_format($product->price - $product->current_price)); ?> (<?php echo e($product->discount_percent); ?>%)</div>
        <?php endif; ?>
        <div class="price-unit">Per <?php echo e($product->unit); ?><?php echo e($product->weight ? ' · '.$product->weight : ''); ?></div>
        <div class="emi-text">No Cost EMI available. <a href="#" style="color:var(--blue2)">See all EMI options</a></div>
      </div>
      
      <div class="stock-row">
        <?php if($product->is_in_stock): ?>
          <?php if($product->stock_quantity <= 10): ?>
            <span class="low-stock-txt">Only <?php echo e($product->stock_quantity); ?> left in stock — order soon!</span>
          <?php else: ?>
            <span class="in-stock-txt">In Stock</span>
          <?php endif; ?>
        <?php else: ?>
          <span class="out-stock-txt">Currently unavailable</span>
        <?php endif; ?>
      </div>
      
      <?php if($product->weight): ?>
      <div class="size-section">
        <div class="size-label">Size: <span><?php echo e($product->weight); ?></span></div>
        <div class="size-pills">
          <div class="size-pill active"><?php echo e($product->weight); ?></div>
        </div>
      </div>
      <?php endif; ?>
      
      <div class="highlights">
        <div class="highlight-item"><span class="highlight-icon">✅</span>100% Fresh — Farm sourced & quality checked</div>
        <div class="highlight-item"><span class="highlight-icon">🚚</span>Express delivery in 60 minutes at Mayur Vihar Phase-1</div>
        <div class="highlight-item"><span class="highlight-icon">↩️</span>7-day easy return & refund policy</div>
        <div class="highlight-item"><span class="highlight-icon">🔒</span>Secure payment — UPI, Cards, Net Banking, COD</div>
        <?php if($product->is_on_sale): ?>
          <div class="highlight-item"><span class="highlight-icon">🏷️</span>On sale — <?php echo e($product->discount_percent); ?>% discount applied</div>
        <?php endif; ?>
      </div>
      
      <?php if($product->description): ?>
      <div class="about-section">
        <div class="about-title">About this item</div>
        <ul class="about-list">
          <?php $__currentLoopData = array_filter(array_map('trim', explode('.', $product->description))); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(strlen($line) > 5): ?>
              <li><?php echo e($line); ?>.</li>
            <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
      <?php else: ?>
      <div class="about-section">
        <div class="about-title">About this item</div>
        <ul class="about-list">
          <li>Fresh <?php echo e($product->category->name ?? 'grocery'); ?> product — sourced daily</li>
          <li>Weight: <?php echo e($product->weight ?? 'As per packaging'); ?> per <?php echo e($product->unit); ?></li>
          <li>Quality checked before every delivery</li>
          <li>Best before: Check packaging for expiry date</li>
          <li>Delivered fresh to your doorstep in Mayur Vihar Phase-1</li>
        </ul>
      </div>
      <?php endif; ?>
    </div>

    
    <div class="buy-box-col">
      <div class="buy-box">
        
        <div class="buy-price">
          <span class="bp-sym">₹</span><?php echo e(number_format($product->current_price)); ?>

        </div>
        <?php if($product->is_on_sale): ?>
          <div class="buy-mrp-row">M.R.P.: <span style="text-decoration:line-through;color:var(--muted)">₹<?php echo e(number_format($product->price)); ?></span></div>
          <div class="buy-saving">You save: ₹<?php echo e(number_format($product->price - $product->current_price)); ?></div>
        <?php else: ?>
          <div style="margin-bottom:12px"></div>
        <?php endif; ?>
        
        <div class="buy-delivery-row">
          🚚 <strong>FREE Delivery</strong> on orders above ₹499
        </div>
        <div class="buy-delivery-row">
          ⚡ <strong>Express 60-min</strong> delivery available
        </div>
        <div class="buy-delivery-row">
          📍 Delivers to <a href="#">Mayur Vihar Phase-1</a>
        </div>
        
        <?php if($product->is_in_stock): ?>
          <?php if($product->stock_quantity <= 10): ?>
            <div class="buy-stock low">Only <?php echo e($product->stock_quantity); ?> left!</div>
          <?php else: ?>
            <div class="buy-stock">In Stock</div>
          <?php endif; ?>
        <?php else: ?>
          <div class="buy-stock out">Currently unavailable</div>
        <?php endif; ?>
        
        <div class="coupon-row">
          <input type="checkbox" class="coupon-cb" id="couponCb" onchange="applyCoupon(this)">
          <label for="couponCb" class="coupon-label">Apply coupon <span class="coupon-code">WELCOME100</span> — save ₹100</label>
        </div>
        
        <?php if($product->is_in_stock): ?>
        <div class="buy-qty-row">
          <span class="buy-qty-label">Qty:</span>
          <div class="qty-ctrl">
            <button type="button" class="qty-btn" onclick="changeQty(-1)">−</button>
            <input type="number" class="qty-val" id="qtyInput" value="1" min="1" max="<?php echo e($product->stock_quantity); ?>">
            <button type="button" class="qty-btn" onclick="changeQty(1)">+</button>
          </div>
        </div>
        <form action="<?php echo e(route('cart.add')); ?>" method="POST" id="addCartForm">
          <?php echo csrf_field(); ?>
          <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
          <input type="hidden" name="qty" value="1" id="cartQty">
          <button type="submit" class="btn-add-cart" id="addCartBtn">Add to Cart</button>
        </form>
        <a href="<?php echo e(route('checkout.index')); ?>" class="btn-buy-now">Buy Now</a>
        <?php else: ?>
          <button class="btn-add-cart" disabled style="margin-top:14px">Currently Unavailable</button>
        <?php endif; ?>
        
        <div class="pincode-row">
          <div>📍 Check delivery in your area:</div>
          <div class="pincode-inp-row">
            <input type="text" class="pincode-inp" id="pinInput" placeholder="Enter pincode" maxlength="6">
            <button class="pincode-check-btn" onclick="checkPin()">Check</button>
          </div>
          <div id="pinResult" class="pincode-result"></div>
        </div>
        
        <div class="secure-badge">
          🔒 Secure transaction · Sold by <strong style="margin-left:4px">All You Want</strong>
        </div>
        
        <div class="buy-box-info" style="margin-top:12px">
          <div class="buy-box-row"><span>Ships from</span><span>All You Want Grocery</span></div>
          <div class="buy-box-row"><span>Sold by</span><span><a href="#">All You Want</a></span></div>
          <div class="buy-box-row"><span>Returns</span><span><a href="#">7-day return policy</a></span></div>
          <div class="buy-box-row"><span>Payment</span><span>Secure transaction</span></div>
        </div>
        
        <div style="margin-top:12px;text-align:center">
          <button onclick="shareProduct()" style="background:none;border:none;color:var(--blue2);font-size:13px;cursor:pointer;font-family:inherit;text-decoration:underline">Share this product</button>
        </div>
      </div>
    </div>
  </div>

  
  <div class="info-tabs-section">
    <div class="tab-nav-bar">
      <button class="tab-nav-btn active" onclick="openTab('specs',this)" data-tab="specs">Product Details</button>
      <button class="tab-nav-btn" onclick="openTab('nutrition',this)" data-tab="nutrition">Nutritional Info</button>
      <button class="tab-nav-btn" onclick="openTab('reviews',this)" data-tab="reviews">Customer Reviews (<?php echo e($reviewCount); ?>)</button>
      <button class="tab-nav-btn" onclick="openTab('qa',this)" data-tab="qa">Questions & Answers</button>
      <button class="tab-nav-btn" onclick="openTab('shipping',this)" data-tab="shipping">Shipping & Returns</button>
    </div>
    <div class="tab-content-wrap">

      
      <div class="tab-pane active" id="tab-specs">
        <table class="spec-table">
          <tr><td>Product Name</td><td><?php echo e($product->name); ?></td></tr>
          <?php if($product->category): ?><tr><td>Category</td><td><?php echo e($product->category->name); ?></td></tr><?php endif; ?>
          <?php if($product->weight): ?><tr><td>Net Weight</td><td><?php echo e($product->weight); ?></td></tr><?php endif; ?>
          <tr><td>Unit</td><td>Per <?php echo e($product->unit); ?></td></tr>
          <?php if($product->sku): ?><tr><td>Item model number</td><td><?php echo e($product->sku); ?></td></tr><?php endif; ?>
          <tr><td>Availability</td><td style="font-weight:700;color:<?php echo e($product->is_in_stock?'var(--green)':'var(--red)'); ?>"><?php echo e($product->is_in_stock ? 'In Stock ('.$product->stock_quantity.' units available)' : 'Out of Stock'); ?></td></tr>
          <tr><td>Country of Origin</td><td>India 🇮🇳</td></tr>
          <tr><td>Storage Instructions</td><td>Store in cool, dry place away from direct sunlight</td></tr>
          <tr><td>Shelf Life</td><td>As indicated on package</td></tr>
          <tr><td>Delivery Time</td><td>Express: 60 min · Standard: 2-4 hours</td></tr>
          <tr><td>Return Window</td><td>7 days from delivery</td></tr>
          <tr><td>Seller</td><td>All You Want Grocery, Mayur Vihar Phase-1, Delhi</td></tr>
        </table>
        <?php if($product->description): ?>
        <div style="margin-top:20px">
          <div style="font-size:16px;font-weight:700;color:var(--text);margin-bottom:10px">Product Description</div>
          <div style="font-size:14px;color:var(--text2);line-height:1.85"><?php echo e($product->description); ?></div>
        </div>
        <?php endif; ?>
      </div>

      
      <div class="tab-pane" id="tab-nutrition">
        <div style="font-size:13.5px;color:var(--text2);margin-bottom:14px">Approximate nutritional values per 100g serving. Actual values may vary based on product variety.</div>
        <div class="nutrition-table">
          <div class="nt-head">Nutrition Facts</div>
          <div class="nt-sub">Serving size 100g</div>
          <div class="nt-row total"><span class="nt-key" style="font-weight:800">Calories</span><span class="nt-val">~85 kcal</span></div>
          <div class="nt-row"><span class="nt-key">Total Fat</span><span class="nt-val">0.2g</span></div>
          <div class="nt-row" style="padding-left:28px"><span class="nt-key" style="font-size:12.5px">Saturated Fat</span><span class="nt-val">0g</span></div>
          <div class="nt-row" style="padding-left:28px"><span class="nt-key" style="font-size:12.5px">Trans Fat</span><span class="nt-val">0g</span></div>
          <div class="nt-row heavy"><span class="nt-key">Total Carbohydrate</span><span class="nt-val">19.5g</span></div>
          <div class="nt-row" style="padding-left:28px"><span class="nt-key" style="font-size:12.5px">Dietary Fiber</span><span class="nt-val">2.4g</span></div>
          <div class="nt-row" style="padding-left:28px"><span class="nt-key" style="font-size:12.5px">Total Sugars</span><span class="nt-val">9g</span></div>
          <div class="nt-row heavy"><span class="nt-key">Protein</span><span class="nt-val">1.1g</span></div>
          <div class="nt-row"><span class="nt-key">Sodium</span><span class="nt-val">1mg (0% DV)</span></div>
          <div class="nt-row"><span class="nt-key">Vitamin C</span><span class="nt-val">8% DV</span></div>
          <div class="nt-row"><span class="nt-key">Calcium</span><span class="nt-val">1% DV</span></div>
          <div class="nt-row"><span class="nt-key">Iron</span><span class="nt-val">1% DV</span></div>
        </div>
        <div style="font-size:11.5px;color:var(--muted);margin-top:12px">*Percent Daily Values based on 2,000 calorie diet. Values may vary based on product variety.</div>
      </div>

      
      <div class="tab-pane" id="tab-reviews">
        <div class="reviews-header">
          <div class="rating-overview">
            <div class="big-rating"><?php echo e(number_format($avgRating,1)); ?></div>
            <div class="big-stars"><?php for($i=1;$i<=5;$i++): ?><?php echo e($i<=round($avgRating)?'★':'☆'); ?><?php endfor; ?></div>
            <div class="big-total">out of 5</div>
            <div style="font-size:13px;color:var(--muted);margin-top:4px"><?php echo e($reviewCount); ?> global ratings</div>
          </div>
          <div class="rating-breakdown">
            <?php $starCounts=[5=>0,4=>0,3=>0,2=>0,1=>0]; foreach($product->approvedReviews as $rev){ $starCounts[(int)$rev->rating]++; } ?>
            <?php $__currentLoopData = [5,4,3,2,1]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $star): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="rb-row" onclick="document.querySelector('#tab-reviews .review-item')?.scrollIntoView({behavior:'smooth'})">
              <span class="rb-label"><?php echo e($star); ?> star</span>
              <div class="rb-track"><div class="rb-fill" style="width:<?php echo e($reviewCount>0?round($starCounts[$star]/$reviewCount*100):0); ?>%"></div></div>
              <span class="rb-cnt"><?php echo e($reviewCount>0?round($starCounts[$star]/$reviewCount*100):0); ?>%</span>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
        
        <?php $ri_colors=['#007600','#7c3aed','#c45500','#007185','#cc0c39','#0d9488']; ?>
        <?php $__empty_1 = true; $__currentLoopData = $product->approvedReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="review-item">
          <div class="ri-head">
            <div class="ri-avatar" style="background:<?php echo e($ri_colors[$i%6]); ?>"><?php echo e(strtoupper(substr($review->user->name??'U',0,2))); ?></div>
            <div><div class="ri-name"><?php echo e($review->user->name ?? 'Customer'); ?></div></div>
          </div>
          <div style="display:flex;align-items:center;gap:8px;margin-bottom:6px;flex-wrap:wrap">
            <span class="ri-stars"><?php for($s=1;$s<=5;$s++): ?><?php echo e($s<=$review->rating?'★':'☆'); ?><?php endfor; ?></span>
            <?php if($review->title): ?><span class="ri-title" style="font-size:14px;margin:0"><?php echo e($review->title); ?></span><?php endif; ?>
          </div>
          <div class="ri-verified">✅ Verified Purchase &nbsp;|&nbsp; <span class="ri-date"><?php echo e($review->created_at->format('d M Y')); ?></span></div>
          <div class="ri-body"><?php echo e($review->body); ?></div>
          <div class="ri-helpful">
            <span>Was this review helpful?</span>
            <button class="helpful-btn" onclick="this.textContent='👍 Yes ('+((parseInt(this.textContent.match(/\d+/)?.[0])||0)+1)+')';this.disabled=true">👍 Yes (<?php echo e(rand(2,24)); ?>)</button>
            <button class="helpful-btn" onclick="this.disabled=true">👎 No</button>
            <button class="helpful-btn" style="color:var(--blue2)" onclick="showToast('Report submitted','orange')">Report abuse</button>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div style="text-align:center;padding:40px 20px;color:var(--muted)">
          <div style="font-size:48px;margin-bottom:12px">⭐</div>
          <div style="font-size:17px;font-weight:700;color:var(--text);margin-bottom:6px">No customer reviews yet</div>
          <div style="font-size:14px">Be the first to review this product!</div>
        </div>
        <?php endif; ?>
        
        <?php if(auth()->guard()->check()): ?>
        <div class="wr-box">
          <div class="wr-title">Review this product</div>
          <div style="font-size:13.5px;color:var(--text2);margin-bottom:12px">Share your thoughts with other customers</div>
          <form action="#" method="POST" onsubmit="submitReview(event)">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
            <input type="hidden" name="rating" id="ratingVal" value="5">
            <label class="wr-label">Overall rating</label>
            <div class="wr-stars-row" id="wrStars">
              <?php for($i=1;$i<=5;$i++): ?>
                <span class="wr-star active" onclick="setRating(<?php echo e($i); ?>)">★</span>
              <?php endfor; ?>
            </div>
            <label class="wr-label">Add a headline</label>
            <input type="text" name="title" class="wr-inp" placeholder="What's most important to know?">
            <label class="wr-label">Add a written review</label>
            <textarea name="body" class="wr-inp" rows="5" placeholder="What did you like or dislike? What did you use this product for?"></textarea>
            <button type="submit" class="wr-submit">Submit Review</button>
          </form>
        </div>
        <?php else: ?>
        <div style="margin-top:20px;padding:18px;background:#f9f9f9;border:1px solid var(--border2);border-radius:var(--r);text-align:center;font-size:14px;color:var(--text2)">
          <a href="<?php echo e(route('login')); ?>" style="color:var(--blue2);font-weight:700">Sign in</a> to write a customer review
        </div>
        <?php endif; ?>
      </div>

      
      <div class="tab-pane" id="tab-qa">
        <div style="font-size:17px;font-weight:700;color:var(--text);margin-bottom:16px">Customer questions & answers</div>
        <div class="qa-item">
          <div class="qa-q"><span class="qa-q-icon">Q:</span>Is this product fresh and sourced daily?</div>
          <div class="qa-a">Yes! All our products are sourced directly from farms and local markets every morning before 6 AM. We guarantee freshness on every delivery.<div class="qa-by">Answer by All You Want Team · Helpful? <button class="helpful-btn" style="font-size:12px">Yes (14)</button></div></div>
        </div>
        <div class="qa-item">
          <div class="qa-q"><span class="qa-q-icon">Q:</span>What is the delivery time to Mayur Vihar Phase-1?</div>
          <div class="qa-a">We deliver within 60 minutes for express orders in Mayur Vihar Phase-1. Standard delivery takes 2-4 hours. Delivery is free above ₹499.<div class="qa-by">Answer by All You Want Team · Helpful? <button class="helpful-btn" style="font-size:12px">Yes (9)</button></div></div>
        </div>
        <div class="qa-item">
          <div class="qa-q"><span class="qa-q-icon">Q:</span>Can I return if the product is not fresh?</div>
          <div class="qa-a">Absolutely! We offer a 7-day return policy. If you're not satisfied with freshness, contact us at 9911011411 or WhatsApp us and we'll arrange immediate replacement or full refund.<div class="qa-by">Answer by All You Want Team · Helpful? <button class="helpful-btn" style="font-size:12px">Yes (6)</button></div></div>
        </div>
        <?php if(auth()->guard()->check()): ?>
        <div style="background:#f9f9f9;border:1px solid var(--border2);border-radius:var(--r);padding:18px;margin-top:16px">
          <div style="font-size:14px;font-weight:700;color:var(--text);margin-bottom:12px">💬 Have a question?</div>
          <div style="display:flex;gap:10px">
            <input type="text" class="wr-inp" placeholder="Type your question here..." style="margin-bottom:0">
            <button class="wr-submit" style="white-space:nowrap" onclick="showToast('✅ Question submitted! We reply within 24 hours.','green')">Ask</button>
          </div>
        </div>
        <?php else: ?>
        <div style="margin-top:16px;padding:14px;background:#f9f9f9;border:1px solid var(--border2);border-radius:var(--r);font-size:14px;color:var(--text2);text-align:center">
          <a href="<?php echo e(route('login')); ?>" style="color:var(--blue2);font-weight:700">Sign in</a> to ask a question
        </div>
        <?php endif; ?>
      </div>

      
      <div class="tab-pane" id="tab-shipping">
        <div class="ship-grid">
          <div class="ship-card">
            <div class="ship-icon">🚚</div>
            <div class="ship-title">Express Delivery</div>
            <div class="ship-body">60-minute delivery available in Mayur Vihar Phase-1. Order before 8 PM for same-day delivery.</div>
            <div class="ship-tag">FREE above ₹499 · ₹40 below ₹499</div>
          </div>
          <div class="ship-card">
            <div class="ship-icon">📦</div>
            <div class="ship-title">Standard Delivery</div>
            <div class="ship-body">2-4 hour delivery across our service area. Schedule delivery at your preferred time slot.</div>
            <div class="ship-tag">₹40 delivery charge · FREE above ₹499</div>
          </div>
          <div class="ship-card">
            <div class="ship-icon">↩️</div>
            <div class="ship-title">Return Policy</div>
            <div class="ship-body">7-day easy return for quality issues. Simply contact us and we'll arrange immediate replacement or full refund.</div>
            <div class="ship-tag">Instant refund to original payment method</div>
          </div>
          <div class="ship-card">
            <div class="ship-icon">💳</div>
            <div class="ship-title">Payment Options</div>
            <div class="ship-body">UPI, Debit/Credit Cards, Net Banking, Cash on Delivery available. 100% secure transactions via Razorpay.</div>
            <div class="ship-tag">COD available on all orders</div>
          </div>
          <div class="ship-card">
            <div class="ship-icon">📞</div>
            <div class="ship-title">Customer Support</div>
            <div class="ship-body">Call <strong>9911011411</strong> or WhatsApp us anytime. Mon–Sat 8AM–10PM. Near Mitra Di Chap & Sameer Restaurant.</div>
            <div class="ship-tag">Response within 30 minutes</div>
          </div>
          <div class="ship-card">
            <div class="ship-icon">🔒</div>
            <div class="ship-title">Buyer Protection</div>
            <div class="ship-body">100% buyer protection on all orders. Your money is safe — get refund if order not delivered or not as described.</div>
            <div class="ship-tag">Zero risk shopping</div>
          </div>
        </div>
      </div>

    </div>
  </div>

  
  <?php if($related->count() > 0): ?>
  <div class="related-section">
    <div class="related-section-title">
      Customers who viewed this item also viewed
    </div>
    <div class="prod-grid">
      <?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php $rIcon=['Vegetables'=>'🥬','Fruits'=>'🍎','Dairy & Eggs'=>'🥛','Meat & Fish'=>'🍗','Bakery'=>'🧁','Beverages'=>'🧃','Instant Food'=>'🍜','Personal Care'=>'🧴','Household'=>'🏠','Pet Care'=>'🐾'][$rel->category->name??'']??'🛒'; ?>
      <div class="prod-grid-card">
        <?php if($rel->is_on_sale): ?><span class="pgc-badge pgcb-deal"><?php echo e($rel->discount_percent); ?>% off</span>
        <?php elseif($rel->is_new_arrival): ?><span class="pgc-badge pgcb-new">New</span><?php endif; ?>
        <a href="<?php echo e(route('product.show',$rel->slug)); ?>">
          <div class="pgc-img">
            <?php if($rel->thumbnail): ?><img src="<?php echo e(asset('storage/'.$rel->thumbnail)); ?>" alt="<?php echo e($rel->name); ?>" loading="lazy">
            <?php else: ?><?php echo e($rIcon); ?><?php endif; ?>
          </div>
        </a>
        <a href="<?php echo e(route('product.show',$rel->slug)); ?>" class="pgc-name"><?php echo e($rel->name); ?></a>
        <div class="pgc-stars">
          ★★★★☆
          <span><?php echo e(rand(10,200)); ?></span>
        </div>
        <div class="pgc-price-row">
          <div class="pgc-price"><span class="pcs">₹</span><?php echo e(number_format($rel->current_price)); ?></div>
          <?php if($rel->is_on_sale): ?>
            <div class="pgc-price-old">₹<?php echo e(number_format($rel->price)); ?></div>
            <div class="pgc-discount"><?php echo e($rel->discount_percent); ?>% off</div>
          <?php endif; ?>
        </div>
        <div style="font-size:12px;color:var(--green);margin-bottom:8px">🚚 FREE Delivery</div>
        <?php if($rel->is_in_stock): ?>
          <form action="<?php echo e(route('cart.add')); ?>" method="POST">
            <?php echo csrf_field(); ?><input type="hidden" name="product_id" value="<?php echo e($rel->id); ?>"><input type="hidden" name="qty" value="1">
            <button type="submit" class="pgc-add-btn" onclick="relCartAnim(this)">Add to Cart</button>
          </form>
        <?php else: ?>
          <button class="pgc-add-btn" disabled>Unavailable</button>
        <?php endif; ?>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
  <?php endif; ?>

</div>




<div class="mob-sticky" id="mobSticky">
  <div class="mob-sticky-info">
    <div class="mob-sticky-name"><?php echo e($product->name); ?></div>
    <div class="mob-sticky-price">₹<?php echo e(number_format($product->current_price)); ?></div>
  </div>
  <?php if($product->is_in_stock): ?>
    <button class="mob-sticky-btn" onclick="document.getElementById('addCartBtn')?.click()">Add to Cart</button>
  <?php else: ?>
    <button class="mob-sticky-btn" style="background:#f0f2f2;border-color:#ddd;color:#999;cursor:not-allowed" disabled>Unavailable</button>
  <?php endif; ?>
</div>


<a href="https://wa.me/919911011411?text=Hi! I want to know about <?php echo e(rawurlencode($product->name)); ?>" class="wa-btn" target="_blank" rel="noopener">💬</a>
<button class="back-top-btn" id="backTopBtn" onclick="window.scrollTo({top:0,behavior:'smooth'})">↑</button>


<div class="toast-container" id="toastContainer"></div>

<?php $__env->stopSection(); ?>
<script>
// ── QTY ──────────────────────────────────────
function changeQty(d){
  const inp=document.getElementById('qtyInput');
  if(!inp) return;
  const max=parseInt(inp.max)||999;
  let v=parseInt(inp.value||1)+d;
  if(v<1)v=1;
  if(v>max){showToast('Only '+max+' units available','orange');v=max;}
  inp.value=v;
  const ch=document.getElementById('cartQty');
  if(ch) ch.value=v;
}
// sync hidden qty on manual input
document.getElementById('qtyInput')?.addEventListener('input',function(){
  const ch=document.getElementById('cartQty');
  if(ch) ch.value=this.value;
});

// ── IMAGE CHANGE ─────────────────────────────
function changeImg(src,el){
  const m=document.getElementById('mainImgEl');
  if(m){
    m.style.opacity='0'; m.style.transform='scale(.95)'; m.style.transition='all .18s';
    setTimeout(()=>{m.src=src; m.style.opacity='1'; m.style.transform='scale(1)';},170);
  }
  document.querySelectorAll('.thumb-wrap').forEach(t=>t.classList.remove('active'));
  el.classList.add('active');
}

// ── TABS ─────────────────────────────────────
function openTab(id,btn){
  document.querySelectorAll('.tab-pane').forEach(p=>p.classList.remove('active'));
  document.querySelectorAll('.tab-nav-btn').forEach(b=>b.classList.remove('active'));
  const pane=document.getElementById('tab-'+id);
  if(pane) pane.classList.add('active');
  if(btn) btn.classList.add('active');
}

// ── WISHLIST ─────────────────────────────────
function toggleWishlist(id){
  const btn=document.getElementById('wishBtn');
  if(!btn) return;
  btn.classList.toggle('wishlisted');
  if(btn.classList.contains('wishlisted')){
    btn.innerHTML=btn.innerHTML.replace('Add to Wish List','Wishlisted ✓');
    showToast('Added to Wish List!','green');
  } else {
    btn.innerHTML=btn.innerHTML.replace('Wishlisted ✓','Add to Wish List');
    showToast('Removed from Wish List','orange');
  }
  <?php if(auth()->guard()->check()): ?>
  fetch('/wishlist/toggle/'+id,{method:'POST',headers:{'X-CSRF-TOKEN':document.querySelector('meta[name=csrf-token]')?.content||''}}).catch(()=>{});
  <?php endif; ?>
}

// ── SHARE ────────────────────────────────────
function shareProduct(){
  if(navigator.share){
    navigator.share({title:'<?php echo e(addslashes($product->name)); ?>',text:'Check this out on All You Want Grocery!',url:window.location.href}).catch(()=>{});
  } else {
    navigator.clipboard?.writeText(window.location.href).then(()=>showToast('Link copied!','green')).catch(()=>showToast('Copy: '+window.location.href,'orange'));
  }
}

// ── PINCODE ──────────────────────────────────
function checkPin(){
  const pin=document.getElementById('pinInput')?.value.trim();
  const res=document.getElementById('pinResult');
  if(!res) return;
  if(!pin||pin.length!==6||isNaN(pin)){
    res.textContent='❌ Enter valid 6-digit pincode'; res.style.color='#cc0c39'; res.style.display='block'; return;
  }
  const ok=['110091','110092','110093','110095'].includes(pin);
  res.textContent=ok?'✅ Express 60-min delivery available!':'📦 Standard delivery available (2-4 hrs)';
  res.style.color=ok?'#007600':'#c45500';
  res.style.display='block';
}
document.getElementById('pinInput')?.addEventListener('keypress',e=>{if(e.key==='Enter')checkPin();});

// ── COUPON ───────────────────────────────────
function applyCoupon(cb){
  if(cb.checked) showToast('Coupon WELCOME100 applied! ₹100 off on order.','green');
  else showToast('Coupon removed','orange');
}

// ── ADD TO CART ──────────────────────────────
document.getElementById('addCartForm')?.addEventListener('submit',function(){
  const btn=document.getElementById('addCartBtn');
  if(btn){ btn.textContent='Added to Cart ✓'; btn.style.background='#f0f2f2'; btn.disabled=true; }
  showToast('Added to cart!','green');
  // update cart count
  document.querySelectorAll('.cart-count').forEach(el=>{
    el.textContent=(parseInt(el.textContent)||0)+(parseInt(document.getElementById('qtyInput')?.value)||1);
  });
  setTimeout(()=>{ if(btn){ btn.textContent='Add to Cart'; btn.style.background=''; btn.disabled=false; } },2500);
});

// ── RELATED CART ─────────────────────────────
function relCartAnim(btn){
  btn.textContent='Added ✓'; btn.style.background='#f0f2f2'; btn.disabled=true;
  showToast('Added to cart!','green');
  setTimeout(()=>{ btn.textContent='Add to Cart'; btn.style.background=''; btn.disabled=false; },2000);
}

// ── RATING STARS ─────────────────────────────
function setRating(v){
  document.getElementById('ratingVal').value=v;
  document.querySelectorAll('.wr-star').forEach((s,i)=>{
    s.classList.toggle('active',i<v);
    s.style.color=i<v?'#e47911':'#ddd';
  });
}
setRating(5);

// ── SUBMIT REVIEW ────────────────────────────
function submitReview(e){
  e.preventDefault();
  showToast('Review submitted! It will appear after approval.','green');
  e.target.reset(); setRating(5);
}

// ── TOAST ────────────────────────────────────
function showToast(msg,type='green'){
  const c=document.getElementById('toastContainer');
  if(!c) return;
  const t=document.createElement('div');
  t.className='toast '+type;
  t.textContent=msg;
  c.appendChild(t);
  setTimeout(()=>{t.style.opacity='0';t.style.transform='translateY(12px)';t.style.transition='all .3s';setTimeout(()=>t.remove(),300);},2800);
}

// ── BACK TO TOP ──────────────────────────────
window.addEventListener('scroll',()=>{
  const b=document.getElementById('backTopBtn');
  if(b) b.style.display=window.scrollY>500?'flex':'none';
});

// ── MOBILE STICKY ────────────────────────────
(()=>{
  const buyCol=document.querySelector('.buy-box-col');
  const sticky=document.getElementById('mobSticky');
  if(!sticky) return;
  if(window.innerWidth<=900){
    const purchaseEl=document.querySelector('.btn-add-cart');
    if(purchaseEl){
      const obs=new IntersectionObserver(entries=>{
        entries.forEach(e=>{ sticky.style.display=e.isIntersecting?'none':'flex'; });
      },{threshold:0.1});
      obs.observe(purchaseEl);
    }
  }
})();

// ── SCROLL REVEAL ────────────────────────────
const io=new IntersectionObserver(entries=>{
  entries.forEach((e,i)=>{
    if(e.isIntersecting){
      setTimeout(()=>{ e.target.style.opacity='1'; e.target.style.transform='translateY(0)'; },i*50);
      io.unobserve(e.target);
    }
  });
},{threshold:0.05});
document.querySelectorAll('.prod-grid-card,.review-item,.ship-card,.qa-item').forEach((el,i)=>{
  el.style.opacity='0'; el.style.transform='translateY(16px)';
  el.style.transition='opacity .4s ease, transform .4s ease'; io.observe(el);
});

// ── KEYBOARD ─────────────────────────────────
document.addEventListener('keydown',e=>{
  const inp=document.getElementById('qtyInput');
  if(document.activeElement!==inp){
    if(e.key==='+'||e.key==='=') changeQty(1);
    if(e.key==='-') changeQty(-1);
  }
});
</script>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views/frontend/product-detail.blade.php ENDPATH**/ ?>