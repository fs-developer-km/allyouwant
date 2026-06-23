<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<title><?php echo e($product->name); ?> — GroceryMart</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
html{scroll-behavior:smooth;font-size:15px}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Inter',sans-serif;background:#f8f9fa;color:#1a1a2e;-webkit-font-smoothing:antialiased}
a{text-decoration:none;color:inherit}
ul{list-style:none}

:root{
  --g:#0d6e39;--gd:#0a5a2f;--gl:#e8f5ee;--gm:#c6e8d3;
  --white:#fff;--bg:#f8f9fa;--border:#e2e8f0;--bg:rgba(13,110,57,.18);
  --text:#1a1a2e;--muted:#64748b;--muted2:#94a3b8;
  --red:#dc2626;--gold:#f59e0b;
  --r:12px;--rs:8px;--rl:16px;
  --sh:0 1px 3px rgba(0,0,0,.06),0 4px 16px rgba(0,0,0,.06);
}

/* NAVBAR */
.navbar{background:#fff;border-bottom:1px solid #e2e8f0;position:sticky;top:0;z-index:500;box-shadow:0 1px 4px rgba(0,0,0,.05)}
.nav-in{max-width:1320px;margin:0 auto;padding:0 20px;height:60px;display:flex;align-items:center;gap:12px}
.logo{font-size:20px;font-weight:800;white-space:nowrap;flex-shrink:0}
.logo span{color:var(--g)}
.nsearch{flex:1;max-width:440px;position:relative;margin:0 8px}
.nsearch input{width:100%;border:1.5px solid #e2e8f0;border-radius:50px;padding:8px 16px 8px 38px;font-size:13.5px;font-family:inherit;background:#f8f9fa;color:var(--text);outline:none;transition:border-color .2s,background .2s}
.nsearch input:focus{border-color:var(--g);background:#fff}
.nsearch input::placeholder{color:var(--muted2)}
.nsearch-ic{position:absolute;left:12px;top:50%;transform:translateY(-50%);color:var(--muted2);font-size:14px;pointer-events:none}
.nav-r{display:flex;align-items:center;gap:4px;margin-left:auto}
.nav-lnk{font-size:13.5px;font-weight:500;color:var(--muted);padding:7px 12px;border-radius:var(--rs);transition:all .2s;white-space:nowrap}
.nav-lnk:hover{color:var(--g);background:#e8f5ee}
.btn-cart{background:var(--g);color:#fff;padding:8px 16px;border-radius:50px;font-size:13px;font-weight:600;display:flex;align-items:center;gap:6px;box-shadow:0 2px 8px rgba(13,110,57,.25);transition:all .2s;white-space:nowrap}
.btn-cart:hover{background:var(--gd);transform:translateY(-1px)}
.cart-ct{background:rgba(255,255,255,.25);border-radius:50px;padding:0 7px;font-size:11px;font-weight:700}

/* BREADCRUMB */
.bc{background:#fff;border-bottom:1px solid #e2e8f0;padding:10px 0}
.bc-in{max-width:1320px;margin:0 auto;padding:0 20px;display:flex;align-items:center;gap:5px;font-size:12.5px;color:var(--muted2);flex-wrap:wrap}
.bc-in a{color:var(--g);font-weight:500}
.bc-sep{color:#d1d5db}

/* FLASH */
.flash{background:#e8f5ee;color:var(--g);border-bottom:2px solid #c6e8d3;padding:12px 20px;font-size:13.5px;font-weight:500;display:flex;align-items:center;gap:8px}

/* WRAP */
.wrap{max-width:1320px;margin:24px auto;padding:0 20px}

/* HERO GRID */
.hero{display:grid;grid-template-columns:500px 1fr;gap:32px;margin-bottom:28px;align-items:start}

/* GALLERY */
.gallery{position:sticky;top:72px}
.main-img{background:#fff;border:1px solid #e2e8f0;border-radius:var(--rl);overflow:hidden;aspect-ratio:1/1;position:relative;cursor:zoom-in;box-shadow:var(--sh)}
.main-img img{width:100%;height:100%;object-fit:contain;transition:transform .4s ease,opacity .15s}
.main-img:hover img{transform:scale(1.06)}
.img-emoji{font-size:110px;display:flex;align-items:center;justify-content:center;height:100%}
.badge-stack{position:absolute;top:12px;left:12px;display:flex;flex-direction:column;gap:5px;z-index:2}
.pb{display:inline-flex;padding:4px 10px;border-radius:50px;font-size:11px;font-weight:700;letter-spacing:.3px}
.pb-sale{background:var(--red);color:#fff}
.pb-new{background:var(--g);color:#fff}
.pb-best{background:var(--gold);color:#fff}
.zoom-tip{position:absolute;bottom:10px;right:10px;background:rgba(0,0,0,.4);color:#fff;font-size:11px;padding:4px 10px;border-radius:50px;pointer-events:none}
.thumbs{display:flex;gap:8px;margin-top:10px;flex-wrap:wrap}
.thumb{width:68px;height:68px;border-radius:var(--rs);border:2px solid #e2e8f0;overflow:hidden;cursor:pointer;background:#f8f9fa;display:flex;align-items:center;justify-content:center;font-size:24px;transition:all .2s;flex-shrink:0}
.thumb img{width:100%;height:100%;object-fit:cover}
.thumb:hover,.thumb.active{border-color:var(--g)}
.thumb.active{box-shadow:0 0 0 1px var(--g)}
.trust-row{display:grid;grid-template-columns:repeat(4,1fr);background:#fff;border:1px solid #e2e8f0;border-radius:var(--r);overflow:hidden;margin-top:12px;box-shadow:var(--sh)}
.ti{display:flex;flex-direction:column;align-items:center;padding:11px 6px;gap:3px;border-right:1px solid #e2e8f0;text-align:center}
.ti:last-child{border-right:none}
.ti-ic{font-size:18px}
.ti-t{font-size:12px;font-weight:700}
.ti-s{font-size:11px;color:var(--muted2);line-height:1.3}

/* INFO */
.cat-line{display:flex;align-items:center;gap:6px;margin-bottom:10px;flex-wrap:wrap}
.cat-tag{font-size:12px;font-weight:600;color:var(--g);background:#e8f5ee;padding:3px 10px;border-radius:50px;border:1px solid rgba(13,110,57,.2)}
.prod-title{font-size:26px;font-weight:800;line-height:1.2;margin-bottom:14px;letter-spacing:-.4px}
.rating-row{display:flex;align-items:center;gap:10px;flex-wrap:wrap;padding-bottom:16px;border-bottom:1px solid #e2e8f0;margin-bottom:16px}
.stars span{font-size:14px;color:var(--gold)}
.stars span.e{color:#e2e8f0}
.r-score{font-size:14px;font-weight:700}
.r-cnt{font-size:13px;color:var(--muted2)}
.stock-pill{display:inline-flex;align-items:center;gap:5px;padding:4px 12px;border-radius:50px;font-size:12.5px;font-weight:600;margin-left:auto}
.in-s{background:#e8f5ee;color:var(--g);border:1px solid rgba(13,110,57,.2)}
.out-s{background:#fef2f2;color:var(--red);border:1px solid rgba(220,38,38,.2)}
.pulse-dot{width:7px;height:7px;border-radius:50%;background:var(--g);animation:pulse 1.8s infinite;flex-shrink:0}
@keyframes pulse{0%,100%{opacity:1}50%{opacity:.3}}
.price-box{background:#e8f5ee;border:1px solid rgba(13,110,57,.2);border-radius:var(--r);padding:16px 18px;margin-bottom:16px}
.price-main{display:flex;align-items:baseline;gap:10px;flex-wrap:wrap;margin-bottom:6px}
.price-now{font-size:38px;font-weight:800;color:var(--g);line-height:1;letter-spacing:-1px}
.price-was{font-size:18px;color:var(--muted2);text-decoration:line-through;font-weight:400}
.price-save{background:var(--red);color:#fff;font-size:12px;font-weight:700;padding:3px 9px;border-radius:5px}
.price-meta{display:flex;gap:14px;font-size:12.5px;color:var(--muted);flex-wrap:wrap}
.qty-row{display:flex;align-items:center;gap:12px;margin:16px 0;flex-wrap:wrap}
.qty-lbl{font-size:13.5px;font-weight:600}
.qty-ctrl{display:flex;align-items:center;border:1.5px solid #e2e8f0;border-radius:var(--rs);overflow:hidden;background:#fff}
.qty-btn{width:40px;height:40px;border:none;background:none;font-size:18px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background .15s;font-family:inherit}
.qty-btn:hover{background:#e8f5ee;color:var(--g)}
.qty-inp{width:48px;height:40px;border:none;border-left:1px solid #e2e8f0;border-right:1px solid #e2e8f0;text-align:center;font-size:15px;font-weight:700;font-family:inherit;color:var(--text);outline:none;background:#fff}
.qty-av{font-size:12px;color:var(--muted2)}
.action-row{display:flex;gap:10px;margin-bottom:10px}
.btn-atc{flex:1;background:var(--g);color:#fff;border:none;padding:13px 20px;border-radius:var(--r);font-size:14.5px;font-weight:700;cursor:pointer;font-family:inherit;display:flex;align-items:center;justify-content:center;gap:8px;transition:all .2s;box-shadow:0 4px 14px rgba(13,110,57,.25)}
.btn-atc:hover{background:var(--gd);transform:translateY(-1px);box-shadow:0 6px 20px rgba(13,110,57,.35)}
.btn-atc:disabled{background:#e2e8f0;color:var(--muted2);cursor:not-allowed;transform:none;box-shadow:none}
.btn-wish{width:48px;height:48px;border:1.5px solid #e2e8f0;border-radius:var(--r);background:#fff;font-size:20px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .2s;flex-shrink:0}
.btn-wish:hover,.btn-wish.on{border-color:var(--red);background:#fef2f2}
.btn-buy{width:100%;background:#fff;color:var(--g);border:1.5px solid var(--g);padding:12px 20px;border-radius:var(--r);font-size:14px;font-weight:700;cursor:pointer;font-family:inherit;display:flex;align-items:center;justify-content:center;gap:8px;transition:all .2s;margin-bottom:14px}
.btn-buy:hover{background:#e8f5ee}
.btn-notify{width:100%;background:#fff;color:var(--g);border:1.5px solid rgba(13,110,57,.3);padding:12px 20px;border-radius:var(--r);font-size:14px;font-weight:700;cursor:pointer;font-family:inherit;display:flex;align-items:center;justify-content:center;gap:8px;transition:all .2s}
.btn-notify:hover{background:#e8f5ee}
.share-row{display:flex;align-items:center;gap:8px;padding-top:14px;border-top:1px solid #e2e8f0;flex-wrap:wrap}
.share-lbl{font-size:12.5px;font-weight:600;color:var(--muted)}
.share-btn{width:32px;height:32px;border:1px solid #e2e8f0;border-radius:7px;background:#fff;font-size:13px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .2s}
.share-btn:hover{border-color:var(--g);background:#e8f5ee}
.meta-grid{display:grid;grid-template-columns:1fr 1fr;gap:6px;margin-top:16px}
.mc{background:#f8f9fa;border:1px solid #e2e8f0;border-radius:var(--rs);padding:10px 13px}
.mk{font-size:11px;color:var(--muted2);font-weight:500;text-transform:uppercase;letter-spacing:.4px;margin-bottom:3px}
.mv{font-size:13px;font-weight:600}
.highlights{display:flex;gap:7px;flex-wrap:wrap;margin-top:12px}
.hl{background:#fff;border:1px solid #e2e8f0;border-radius:50px;padding:5px 13px;font-size:12px;font-weight:600;display:flex;align-items:center;gap:5px}
.hl-ck{color:var(--g)}

/* TABS */
.tabs-wrap{background:#fff;border-radius:var(--rl);border:1px solid #e2e8f0;margin-bottom:28px;box-shadow:var(--sh);overflow:hidden}
.tabs-hdr{overflow-x:auto;-webkit-overflow-scrolling:touch;scrollbar-width:none;border-bottom:2px solid #e2e8f0;background:#fff}
.tabs-hdr::-webkit-scrollbar{display:none}
.tabs-nav{display:flex;min-width:max-content;padding:0 16px}
.tab-btn{padding:14px 16px;font-size:13.5px;font-weight:500;color:var(--muted);cursor:pointer;border:none;background:none;border-bottom:2.5px solid transparent;margin-bottom:-2px;transition:all .2s;font-family:inherit;white-space:nowrap}
.tab-btn:hover{color:var(--text)}
.tab-btn.active{color:var(--g);border-bottom-color:var(--g);font-weight:700}
.tab-body{padding:24px}
.tab-pane{display:none}
.tab-pane.active{display:block;animation:fi .25s ease}
@keyframes fi{from{opacity:0;transform:translateY(6px)}to{opacity:1;transform:none}}
.desc-text{font-size:14px;color:#374151;line-height:1.85;max-width:760px;margin-bottom:20px}
.desc-cards{display:grid;grid-template-columns:repeat(3,1fr);gap:12px}
.dc{background:#f8f9fa;border:1px solid #e2e8f0;border-radius:var(--r);padding:16px;text-align:center}
.dc-ic{font-size:26px;margin-bottom:8px}
.dc-t{font-size:13px;font-weight:700;margin-bottom:4px}
.dc-s{font-size:12px;color:var(--muted2);line-height:1.5}
.dtable{width:100%;border-collapse:collapse;font-size:13.5px;max-width:640px}
.dtable tr{border-bottom:1px solid #e2e8f0}
.dtable tr:last-child{border-bottom:none}
.dtable td{padding:11px 12px;vertical-align:top}
.dtable td:first-child{color:var(--muted);font-weight:500;width:170px;white-space:nowrap}
.dtable td:last-child{font-weight:500}
.dtable tr:hover td{background:#f8f9fa}
.nut-wrap{display:grid;grid-template-columns:280px 1fr;gap:20px}
.nut-tbl{border:1px solid #e2e8f0;border-radius:var(--r);overflow:hidden;font-size:13.5px}
.nt-hd{background:var(--g);color:#fff;padding:11px 16px;font-weight:700;font-size:14px}
.nt-row{display:flex;justify-content:space-between;padding:9px 16px;border-top:1px solid #e2e8f0;align-items:center}
.nt-row:hover{background:#f8f9fa}
.nt-sub{padding-left:28px}
.nt-sub .nk{font-size:12.5px;color:var(--muted2)}
.nk{color:var(--muted)}.nv{font-weight:700}
.ben-box{background:#e8f5ee;border:1px solid rgba(13,110,57,.2);border-radius:var(--r);padding:18px}
.ben-title{font-size:13.5px;font-weight:700;color:var(--g);margin-bottom:14px}
.ben-item{display:flex;gap:8px;font-size:13px;color:#374151;align-items:flex-start;margin-bottom:9px}
.ben-item:last-child{margin-bottom:0}
.ben-ck{color:var(--g);flex-shrink:0}
.del-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-bottom:16px}
.del-card{border:1px solid #e2e8f0;border-radius:var(--r);padding:18px;text-align:center;background:#f8f9fa}
.del-ic{font-size:28px;margin-bottom:10px}
.del-t{font-size:13.5px;font-weight:700;margin-bottom:6px}
.del-s{font-size:12.5px;color:var(--muted2);line-height:1.6}
.ret-box{background:#e8f5ee;border:1px solid rgba(13,110,57,.2);border-radius:var(--r);padding:16px 18px;font-size:13.5px;color:#374151;line-height:1.75;margin-bottom:10px}
.ret-box strong{color:var(--g)}
.warn-box{background:#fffbeb;border:1px solid rgba(245,158,11,.25);border-radius:var(--r);padding:14px 18px;font-size:13px;color:#78350f;line-height:1.65}
.rev-sum{display:flex;gap:28px;margin-bottom:24px;padding-bottom:22px;border-bottom:1px solid #e2e8f0;flex-wrap:wrap;align-items:flex-start}
.rev-big-n{font-size:56px;font-weight:800;color:var(--g);line-height:1;letter-spacing:-2px}
.rev-big-s{display:flex;gap:2px;margin-top:4px;font-size:18px;color:var(--gold)}
.rev-big-l{font-size:12px;color:var(--muted2);margin-top:4px}
.rev-bars{flex:1;min-width:180px;display:flex;flex-direction:column;gap:7px}
.rbr{display:flex;align-items:center;gap:8px;font-size:12.5px}
.rbl{color:var(--muted2);width:18px;text-align:right;flex-shrink:0}
.rbs{color:var(--gold);font-size:11px;width:10px;flex-shrink:0}
.rbt{flex:1;height:7px;background:#f1f5f9;border-radius:4px;overflow:hidden}
.rbf{height:100%;background:linear-gradient(90deg,var(--gold),#f97316);border-radius:4px;transition:width 1s cubic-bezier(.4,0,.2,1)}
.rbc{color:var(--muted2);width:18px;font-size:12px;flex-shrink:0}
.rev-card{padding:18px 0;border-bottom:1px solid #e2e8f0}
.rev-card:last-child{border-bottom:none}
.rev-top{display:flex;align-items:flex-start;gap:12px;margin-bottom:10px}
.rev-av{width:40px;height:40px;border-radius:50%;background:var(--g);color:#fff;font-size:13px;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.rev-name{font-size:13.5px;font-weight:700}
.rev-meta{font-size:12px;color:var(--muted2);margin-top:3px}
.veri{background:#e8f5ee;color:var(--g);font-size:11px;font-weight:600;padding:1px 7px;border-radius:4px}
.rev-sr{display:flex;gap:1px;margin-left:auto;font-size:13px;color:var(--gold);flex-shrink:0}
.rev-title{font-size:13.5px;font-weight:600;margin-bottom:5px}
.rev-body{font-size:13.5px;color:#4b5563;line-height:1.7}
.rev-hlp{display:flex;align-items:center;gap:8px;margin-top:10px;font-size:12px;color:var(--muted2)}
.hlp-btn{background:#f8f9fa;border:1px solid #e2e8f0;color:var(--muted);padding:4px 11px;border-radius:50px;cursor:pointer;font-size:12px;font-family:inherit;transition:all .2s}
.hlp-btn:hover{border-color:var(--g);color:var(--g);background:#e8f5ee}
.no-rev{text-align:center;padding:40px 20px;color:var(--muted2)}
.write-box{background:#f8f9fa;border:1.5px solid #e2e8f0;border-radius:var(--r);padding:20px;margin-top:20px}
.write-title{font-size:14.5px;font-weight:700;margin-bottom:14px}
.wr-stars{display:flex;gap:6px;font-size:28px;cursor:pointer;margin-bottom:14px}
.wr-stars span{color:#e2e8f0;transition:color .12s}
.wr-stars span.on{color:var(--gold)}
.field{width:100%;background:#fff;border:1.5px solid #e2e8f0;border-radius:var(--rs);padding:10px 13px;font-size:13.5px;color:var(--text);font-family:inherit;outline:none;transition:border-color .2s;margin-bottom:10px;resize:vertical}
.field:focus{border-color:var(--g)}
.field::placeholder{color:var(--muted2)}
.btn-sub{background:var(--g);color:#fff;border:none;padding:10px 24px;border-radius:var(--rs);font-size:13.5px;font-weight:600;cursor:pointer;font-family:inherit;transition:all .2s}
.btn-sub:hover{background:var(--gd)}
.login-p{text-align:center;padding:16px;background:#e8f5ee;border-radius:var(--rs);font-size:13.5px;color:var(--muted);margin-top:16px}
.login-p a{color:var(--g);font-weight:600}
.faq-item{border:1px solid #e2e8f0;border-radius:var(--r);overflow:hidden;margin-bottom:8px}
.faq-q{padding:14px 16px;font-size:14px;font-weight:600;cursor:pointer;display:flex;justify-content:space-between;align-items:center;background:#fff;gap:10px;transition:background .15s;user-select:none}
.faq-q:hover{background:#f8f9fa}
.faq-ic{font-size:18px;color:var(--g);transition:transform .25s;flex-shrink:0;line-height:1;font-weight:400}
.faq-a{display:none;padding:0 16px 14px;font-size:13.5px;color:#4b5563;line-height:1.75;background:#fff}

/* RELATED */
.rel-sec{background:#fff;border-radius:var(--rl);border:1px solid #e2e8f0;padding:24px;box-shadow:var(--sh)}
.sec-hd{display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;gap:12px}
.sec-title{font-size:18px;font-weight:800;letter-spacing:-.3px}
.sec-title span{color:var(--g)}
.see-all{font-size:13px;color:var(--g);font-weight:600;border:1.5px solid rgba(13,110,57,.2);padding:6px 16px;border-radius:50px;transition:all .2s;white-space:nowrap}
.see-all:hover{background:#e8f5ee}
.rel-grid{display:grid;grid-template-columns:repeat(6,1fr);gap:12px}
.rel-card{background:#fff;border:1px solid #e2e8f0;border-radius:var(--r);overflow:hidden;transition:all .22s;position:relative}
.rel-card:hover{border-color:rgba(13,110,57,.25);transform:translateY(-3px);box-shadow:0 8px 24px rgba(13,110,57,.1)}
.rel-card a{display:block;color:inherit}
.rel-img{aspect-ratio:1/1;background:#f8f9fa;display:flex;align-items:center;justify-content:center;font-size:38px;overflow:hidden;position:relative}
.rel-img img{width:100%;height:100%;object-fit:cover;transition:transform .3s}
.rel-card:hover .rel-img img{transform:scale(1.05)}
.rel-sale-t{position:absolute;top:6px;left:6px;background:var(--red);color:#fff;font-size:10px;font-weight:700;padding:2px 7px;border-radius:4px}
.rel-body{padding:9px 10px}
.rel-cat{font-size:10.5px;color:var(--muted2);font-weight:500;margin-bottom:2px}
.rel-name{font-size:12.5px;font-weight:600;line-height:1.35;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;margin-bottom:6px}
.rel-foot{display:flex;align-items:flex-end;justify-content:space-between;gap:4px}
.rel-p{font-size:13.5px;font-weight:700;color:var(--g)}
.rel-old-p{font-size:11px;color:var(--muted2);text-decoration:line-through}
.rel-st{font-size:10.5px;color:var(--gold)}
.rel-add{position:absolute;bottom:8px;right:8px;width:28px;height:28px;background:var(--g);border-radius:50%;border:none;color:#fff;font-size:16px;font-weight:700;cursor:pointer;display:flex;align-items:center;justify-content:center;opacity:0;transform:scale(.6);transition:all .2s;font-family:inherit;z-index:2}
.rel-card:hover .rel-add{opacity:1;transform:scale(1)}
.rel-add:hover{background:var(--gd)}

/* STICKY BAR */
.sticky-bar{position:fixed;bottom:-80px;left:0;right:0;z-index:400;background:rgba(255,255,255,.97);backdrop-filter:blur(12px);border-top:1px solid #e2e8f0;padding:12px 20px;display:flex;align-items:center;gap:14px;transition:bottom .3s cubic-bezier(.4,0,.2,1);box-shadow:0 -4px 20px rgba(0,0,0,.08)}
.sticky-bar.show{bottom:0}
.sticky-name{font-size:14px;font-weight:600;flex:1;overflow:hidden;white-space:nowrap;text-overflow:ellipsis}
.sticky-price{font-size:20px;font-weight:800;color:var(--g);white-space:nowrap;letter-spacing:-.5px}
.sticky-btn{background:var(--g);color:#fff;border:none;padding:10px 22px;border-radius:var(--rs);font-size:14px;font-weight:700;cursor:pointer;font-family:inherit;white-space:nowrap;transition:all .2s}
.sticky-btn:hover{background:var(--gd)}
.sticky-btn:disabled{background:#e2e8f0;color:var(--muted2);cursor:default}

/* TOAST */
.toast{position:fixed;top:72px;right:20px;z-index:999;background:#fff;border:1px solid #e2e8f0;border-left:3px solid var(--g);border-radius:var(--r);padding:12px 16px;font-size:13.5px;font-weight:500;display:flex;align-items:center;gap:10px;box-shadow:0 8px 24px rgba(0,0,0,.1);transform:translateX(140%);transition:transform .3s cubic-bezier(.4,0,.2,1);max-width:280px;pointer-events:none}
.toast.show{transform:none}

/* FOOTER */
footer{background:#fff;border-top:1px solid #e2e8f0;padding:20px;text-align:center;font-size:13px;color:var(--muted2);margin-top:20px}
footer a{color:var(--g);font-weight:500}

/* RESPONSIVE */
@media(max-width:1100px){
  .hero{grid-template-columns:420px 1fr;gap:24px}
  .rel-grid{grid-template-columns:repeat(4,1fr)}
}
@media(max-width:900px){
  .hero{grid-template-columns:1fr;gap:20px}
  .gallery{position:static}
  .rel-grid{grid-template-columns:repeat(3,1fr)}
  .desc-cards{grid-template-columns:1fr 1fr}
  .nut-wrap{grid-template-columns:1fr}
  .del-grid{grid-template-columns:1fr 1fr}
}
@media(max-width:640px){
  .wrap{padding:0 12px;margin-top:16px}
  .nav-in{padding:0 12px;height:54px;gap:6px}
  .logo{font-size:17px}
  .nsearch,.nav-lnk{display:none}
  .btn-cart{padding:7px 14px;font-size:12.5px}
  .bc{padding:8px 0}
  .bc-in{padding:0 12px;font-size:12px}
  .prod-title{font-size:20px}
  .price-now{font-size:30px}
  .rel-grid{grid-template-columns:repeat(2,1fr);gap:10px}
  .tabs-nav{padding:0 4px}
  .tab-btn{padding:12px 12px;font-size:13px}
  .tab-body{padding:16px}
  .desc-cards{grid-template-columns:1fr}
  .del-grid{grid-template-columns:1fr}
  .nut-wrap{grid-template-columns:1fr}
  .rev-sum{flex-direction:column;gap:16px}
  .rev-bars{min-width:100%}
  .trust-row{grid-template-columns:1fr 1fr}
  .ti{border-right:none !important;border-bottom:1px solid #e2e8f0}
  .ti:nth-child(odd){border-right:1px solid #e2e8f0 !important}
  .ti:nth-last-child(-n+2){border-bottom:none}
  .thumbs .thumb{width:54px;height:54px}
  .rel-sec{padding:16px}
  .action-row{gap:8px}
  .sticky-name{display:none}
  .sticky-bar{padding:10px 12px;gap:10px}
  .sec-title{font-size:16px}
  .meta-grid{grid-template-columns:1fr 1fr}
}
@media(max-width:400px){
  .rel-grid{grid-template-columns:repeat(2,1fr);gap:8px}
  .price-now{font-size:26px}
  .prod-title{font-size:18px}
  .meta-grid{grid-template-columns:1fr}
}
</style>
</head>
<body>

<!-- TOAST -->
<div class="toast" id="toast"><span id="t-ic">✅</span><span id="t-msg">Done!</span></div>

<!-- STICKY BAR -->
<div class="sticky-bar" id="stickyBar">
  <span class="sticky-name"><?php echo e($product->name); ?></span>
  <span class="sticky-price">₹<?php echo e(number_format($product->current_price)); ?></span>
  <?php if($product->is_in_stock): ?>
  <form action="<?php echo e(route('cart.add')); ?>" method="POST" style="margin:0">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
    <input type="hidden" name="qty" value="1">
    <button type="submit" class="sticky-btn">🛒 Add to Cart</button>
  </form>
  <?php else: ?>
  <button class="sticky-btn" disabled>Out of Stock</button>
  <?php endif; ?>
</div>

<!-- NAVBAR -->
<nav class="navbar">
  <div class="nav-in">
    <a href="<?php echo e(route('home')); ?>" class="logo">Grocery<span>Mart</span></a>
    <div class="nsearch">
      <span class="nsearch-ic">🔍</span>
      <input type="text" placeholder="Search fresh products..." onkeydown="if(event.key==='Enter')window.location='<?php echo e(route('shop')); ?>?q='+this.value">
    </div>
    <div class="nav-r">
      <a href="<?php echo e(route('shop')); ?>" class="nav-lnk">Shop</a>
      <?php if(auth()->guard()->check()): ?>
        <a href="<?php echo e(route('account.index')); ?>" class="nav-lnk">👤 Account</a>
      <?php else: ?>
        <a href="<?php echo e(route('login')); ?>" class="nav-lnk">Login</a>
      <?php endif; ?>
      <a href="<?php echo e(route('cart.index')); ?>" class="btn-cart">
        🛒 Cart
        <?php $cc = count(session('cart',[])); ?>
        <?php if($cc > 0): ?><span class="cart-ct"><?php echo e($cc); ?></span><?php endif; ?>
      </a>
    </div>
  </div>
</nav>

<?php if(session('success')): ?>
<div class="flash">✅ <?php echo e(session('success')); ?></div>
<?php endif; ?>

<!-- BREADCRUMB -->
<div class="bc">
  <div class="bc-in">
    <a href="<?php echo e(route('home')); ?>">Home</a>
    <span class="bc-sep">›</span>
    <a href="<?php echo e(route('shop')); ?>">Shop</a>
    <?php if($product->category): ?>
    <span class="bc-sep">›</span>
    <a href="<?php echo e(route('category.show', $product->category->slug)); ?>"><?php echo e($product->category->name); ?></a>
    <?php endif; ?>
    <span class="bc-sep">›</span>
    <span style="color:var(--muted)"><?php echo e(Str::limit($product->name, 35)); ?></span>
  </div>
</div>

<div class="wrap">

  <!-- HERO -->
  <div class="hero" id="productTop">

    <!-- GALLERY -->
    <div class="gallery">
      <div class="main-img" onmousemove="handleZoom(event,this)" onmouseleave="resetZoom(this)">
        <?php if($product->thumbnail): ?>
          <img src="<?php echo e(asset('storage/'.$product->thumbnail)); ?>" alt="<?php echo e($product->name); ?>" id="mainImg" style="transition:opacity .15s,transform .4s ease">
        <?php else: ?>
          <div class="img-emoji"><?php echo e(['Vegetables'=>'🥬','Fruits'=>'🍎','Dairy & Eggs'=>'🥛','Meat & Fish'=>'🍗','Bakery'=>'🧁','Beverages'=>'🧃'][$product->category->name ?? ''] ?? '🛒'); ?></div>
        <?php endif; ?>
        <div class="badge-stack">
          <?php if($product->is_on_sale): ?><span class="pb pb-sale"><?php echo e($product->discount_percent); ?>% OFF</span><?php endif; ?>
          <?php if($product->is_new_arrival): ?><span class="pb pb-new">NEW</span><?php endif; ?>
          <?php if($product->is_bestseller): ?><span class="pb pb-best">🔥 BESTSELLER</span><?php endif; ?>
        </div>
        <?php if($product->thumbnail): ?><div class="zoom-tip">🔍 Hover to zoom</div><?php endif; ?>
      </div>
      <?php if($product->images->count() > 0): ?>
      <div class="thumbs">
        <?php if($product->thumbnail): ?>
        <div class="thumb active" onclick="switchImg('<?php echo e(asset('storage/'.$product->thumbnail)); ?>',this)">
          <img src="<?php echo e(asset('storage/'.$product->thumbnail)); ?>" alt="">
        </div>
        <?php endif; ?>
        <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="thumb" onclick="switchImg('<?php echo e($img->image_url); ?>',this)">
          <img src="<?php echo e($img->image_url); ?>" alt="">
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <?php endif; ?>
      <div class="trust-row">
        <div class="ti"><div class="ti-ic">🚚</div><div class="ti-t">Free Delivery</div><div class="ti-s">On orders ₹499+</div></div>
        <div class="ti"><div class="ti-ic">🔄</div><div class="ti-t">Easy Returns</div><div class="ti-s">Within 7 days</div></div>
        <div class="ti"><div class="ti-ic">✅</div><div class="ti-t">100% Fresh</div><div class="ti-s">Guaranteed</div></div>
        <div class="ti"><div class="ti-ic">🔒</div><div class="ti-t">Secure Pay</div><div class="ti-s">SSL encrypted</div></div>
      </div>
    </div>

    <!-- INFO -->
    <div>
      <div class="cat-line">
        <?php if($product->category): ?>
        <a href="<?php echo e(route('category.show', $product->category->slug)); ?>" class="cat-tag"><?php echo e($product->category->name); ?></a>
        <?php endif; ?>
        <?php if($product->is_bestseller): ?><span class="cat-tag" style="background:#fff8e1;color:#92400e;border-color:rgba(245,158,11,.3)">🔥 Bestseller</span><?php endif; ?>
        <?php if($product->is_new_arrival): ?><span class="cat-tag">✨ New Arrival</span><?php endif; ?>
      </div>

      <h1 class="prod-title"><?php echo e($product->name); ?></h1>

      <?php
        $avgRating = $product->approvedReviews->avg('rating') ?: 0;
        $reviewCount = $product->approvedReviews->count();
        $fullS = floor($avgRating);
      ?>
      <div class="rating-row">
        <div class="stars">
          <?php for($i=1;$i<=5;$i++): ?><span class="<?php echo e($i > $fullS ? 'e' : ''); ?>">★</span><?php endfor; ?>
        </div>
        <span class="r-score"><?php echo e(number_format($avgRating,1)); ?></span>
        <span class="r-cnt">(<?php echo e($reviewCount); ?> reviews)</span>
        <span class="stock-pill <?php echo e($product->is_in_stock ? 'in-s' : 'out-s'); ?>">
          <?php if($product->is_in_stock): ?><span class="pulse-dot"></span> In Stock@else❌ Out of Stock@endif
        </span>
      </div>

      <div class="price-box">
        <div class="price-main">
          <span class="price-now">₹<?php echo e(number_format($product->current_price)); ?></span>
          <?php if($product->is_on_sale): ?>
            <span class="price-was">₹<?php echo e(number_format($product->price)); ?></span>
            <span class="price-save">Save ₹<?php echo e(number_format($product->price - $product->current_price)); ?></span>
          <?php endif; ?>
        </div>
        <div class="price-meta">
          <span>📦 Per <?php echo e($product->unit); ?><?php echo e($product->weight ? ' · '.$product->weight : ''); ?></span>
          <span>🚚 Free delivery above ₹499</span>
        </div>
      </div>

      <?php if($product->is_in_stock): ?>
      <form action="<?php echo e(route('cart.add')); ?>" method="POST" id="mainCartForm" style="margin:0">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
        <div class="qty-row">
          <span class="qty-lbl">Quantity</span>
          <div class="qty-ctrl">
            <button type="button" class="qty-btn" onclick="adjustQty(-1)">−</button>
            <input type="number" name="qty" class="qty-inp" value="1" min="1" max="<?php echo e($product->stock_quantity); ?>" id="qtyInput">
            <button type="button" class="qty-btn" onclick="adjustQty(1)">+</button>
          </div>
          <span class="qty-av"><?php echo e($product->stock_quantity); ?> left</span>
        </div>
        <div class="action-row">
          <button type="submit" class="btn-atc" id="atcBtn">🛒 Add to Cart</button>
          <button type="button" class="btn-wish" id="wishBtn" onclick="toggleWish(this)" title="Wishlist">🤍</button>
        </div>
        <button type="button" class="btn-buy" onclick="this.closest('form').submit()">⚡ Buy Now</button>
      </form>
      <?php else: ?>
      <div style="margin:16px 0;display:flex;flex-direction:column;gap:10px">
        <button class="btn-atc" disabled>❌ Currently Out of Stock</button>
        <button type="button" class="btn-notify">🔔 Notify When Available</button>
      </div>
      <?php endif; ?>

      <div class="share-row">
        <span class="share-lbl">Share:</span>
        <button class="share-btn" onclick="shareWA()" title="WhatsApp">💬</button>
        <button class="share-btn" onclick="copyLink()" title="Copy Link">🔗</button>
        <button class="share-btn" title="Facebook">📘</button>
        <button class="share-btn" title="Twitter">🐦</button>
      </div>

      <div class="meta-grid">
        <?php if($product->sku): ?><div class="mc"><div class="mk">SKU</div><div class="mv"><?php echo e($product->sku); ?></div></div><?php endif; ?>
        <?php if($product->weight): ?><div class="mc"><div class="mk">Weight</div><div class="mv"><?php echo e($product->weight); ?></div></div><?php endif; ?>
        <div class="mc"><div class="mk">Unit</div><div class="mv">Per <?php echo e($product->unit); ?></div></div>
        <div class="mc"><div class="mk">Category</div><div class="mv"><?php echo e($product->category->name ?? '—'); ?></div></div>
        <div class="mc"><div class="mk">Origin</div><div class="mv">🇮🇳 India</div></div>
        <div class="mc"><div class="mk">Stock</div><div class="mv" style="color:<?php echo e($product->is_in_stock ? 'var(--g)' : 'var(--red)'); ?>"><?php echo e($product->is_in_stock ? $product->stock_quantity.' units' : 'Out of Stock'); ?></div></div>
      </div>

      <div class="highlights">
        <span class="hl"><span class="hl-ck">✓</span> 100% Natural</span>
        <span class="hl"><span class="hl-ck">✓</span> No Preservatives</span>
        <span class="hl"><span class="hl-ck">✓</span> Quality Checked</span>
        <span class="hl"><span class="hl-ck">✓</span> Farm Fresh</span>
      </div>
    </div>
  </div>

  <!-- TABS -->
  <div class="tabs-wrap">
    <div class="tabs-hdr">
      <div class="tabs-nav">
        <button class="tab-btn active" onclick="openTab('desc',this)">📄 Description</button>
        <button class="tab-btn" onclick="openTab('details',this)">📋 Details</button>
        <button class="tab-btn" onclick="openTab('nutrition',this)">🥗 Nutrition</button>
        <button class="tab-btn" onclick="openTab('delivery',this)">🚚 Delivery</button>
        <button class="tab-btn" onclick="openTab('reviews',this)">⭐ Reviews (<?php echo e($reviewCount); ?>)</button>
        <button class="tab-btn" onclick="openTab('qa',this)">❓ Q&amp;A</button>
      </div>
    </div>
    <div class="tab-body">

      <div class="tab-pane active" id="tab-desc">
        <?php if($product->description): ?>
          <p class="desc-text"><?php echo e($product->description); ?></p>
        <?php else: ?>
          <p class="desc-text">Experience the finest quality fresh produce sourced directly from verified farms. Each item is carefully graded, cleaned, and packed to ensure maximum freshness reaches your doorstep. We work directly with farmers to bring you seasonal, locally-grown goodness.</p>
        <?php endif; ?>
        <div class="desc-cards">
          <div class="dc"><div class="dc-ic">🌿</div><div class="dc-t">100% Natural</div><div class="dc-s">No artificial additives or preservatives used</div></div>
          <div class="dc"><div class="dc-ic">🏆</div><div class="dc-t">Premium Quality</div><div class="dc-s">Hand-picked and quality checked by experts</div></div>
          <div class="dc"><div class="dc-ic">⚡</div><div class="dc-t">Same Day Fresh</div><div class="dc-s">Sourced fresh every morning from local farms</div></div>
        </div>
      </div>

      <div class="tab-pane" id="tab-details">
        <table class="dtable">
          <tr><td>Product Name</td><td><?php echo e($product->name); ?></td></tr>
          <?php if($product->category): ?><tr><td>Category</td><td><?php echo e($product->category->name); ?></td></tr><?php endif; ?>
          <?php if($product->weight): ?><tr><td>Weight / Size</td><td><?php echo e($product->weight); ?></td></tr><?php endif; ?>
          <tr><td>Sold Per</td><td><?php echo e($product->unit); ?></td></tr>
          <?php if($product->sku): ?><tr><td>SKU / Code</td><td><?php echo e($product->sku); ?></td></tr><?php endif; ?>
          <tr><td>Availability</td><td style="color:<?php echo e($product->is_in_stock ? 'var(--g)' : 'var(--red)'); ?>;font-weight:700"><?php echo e($product->is_in_stock ? '✅ In Stock ('.$product->stock_quantity.' available)' : '❌ Out of Stock'); ?></td></tr>
          <tr><td>MRP</td><td>₹<?php echo e(number_format($product->price)); ?> per <?php echo e($product->unit); ?></td></tr>
          <?php if($product->is_on_sale): ?><tr><td>Sale Price</td><td style="color:var(--g);font-weight:700">₹<?php echo e(number_format($product->current_price)); ?> (<?php echo e($product->discount_percent); ?>% off)</td></tr><?php endif; ?>
          <tr><td>Country of Origin</td><td>🇮🇳 India</td></tr>
          <tr><td>Storage</td><td>Store in cool &amp; dry place</td></tr>
          <tr><td>Shelf Life</td><td>3–5 days from delivery (refrigerate for best freshness)</td></tr>
          <tr><td>Free Delivery</td><td>On orders above ₹499</td></tr>
          <tr><td>Return Policy</td><td>7-day return on quality issues</td></tr>
        </table>
      </div>

      <div class="tab-pane" id="tab-nutrition">
        <div class="nut-wrap">
          <div>
            <div class="nut-tbl">
              <div class="nt-hd">Nutrition Facts · Per 100g</div>
              <div class="nt-row"><span class="nk">Calories</span><span class="nv">~45 kcal</span></div>
              <div class="nt-row"><span class="nk">Total Fat</span><span class="nv">0.4 g</span></div>
              <div class="nt-row nt-sub"><span class="nk">Saturated Fat</span><span class="nv">0.1 g</span></div>
              <div class="nt-row nt-sub"><span class="nk">Trans Fat</span><span class="nv">0 g</span></div>
              <div class="nt-row"><span class="nk">Cholesterol</span><span class="nv">0 mg</span></div>
              <div class="nt-row"><span class="nk">Sodium</span><span class="nv">15 mg</span></div>
              <div class="nt-row"><span class="nk">Total Carbohydrates</span><span class="nv">10.4 g</span></div>
              <div class="nt-row nt-sub"><span class="nk">Dietary Fiber</span><span class="nv">2.2 g</span></div>
              <div class="nt-row nt-sub"><span class="nk">Total Sugars</span><span class="nv">6.8 g</span></div>
              <div class="nt-row"><span class="nk">Protein</span><span class="nv">1.1 g</span></div>
              <div class="nt-row"><span class="nk">Vitamin C</span><span class="nv">14% DV</span></div>
              <div class="nt-row"><span class="nk">Potassium</span><span class="nv">8% DV</span></div>
            </div>
            <p style="font-size:11.5px;color:var(--muted2);margin-top:8px">* Approximate values. May vary by season &amp; variety.</p>
          </div>
          <div class="ben-box">
            <div class="ben-title">🌿 Health Benefits</div>
            <div class="ben-item"><span class="ben-ck">✓</span> Rich in essential vitamins &amp; minerals</div>
            <div class="ben-item"><span class="ben-ck">✓</span> Good source of dietary fiber</div>
            <div class="ben-item"><span class="ben-ck">✓</span> Supports digestive health</div>
            <div class="ben-item"><span class="ben-ck">✓</span> Low in calories, high in nutrients</div>
            <div class="ben-item"><span class="ben-ck">✓</span> Contains natural antioxidants</div>
            <div class="ben-item"><span class="ben-ck">✓</span> Naturally gluten-free</div>
            <div class="ben-item"><span class="ben-ck">✓</span> Vegan &amp; vegetarian friendly</div>
          </div>
        </div>
      </div>

      <div class="tab-pane" id="tab-delivery">
        <div class="del-grid">
          <div class="del-card"><div class="del-ic">🚚</div><div class="del-t">Standard Delivery</div><div class="del-s">Free on orders above ₹499<br>₹40 charge below ₹499<br>Delivered in 24–48 hours</div></div>
          <div class="del-card"><div class="del-ic">⚡</div><div class="del-t">Express Delivery</div><div class="del-s">2–4 hour delivery<br>₹79 flat charge<br>Available in select areas</div></div>
          <div class="del-card"><div class="del-ic">📅</div><div class="del-t">Scheduled Delivery</div><div class="del-s">Choose your preferred slot<br>Morning, Afternoon or Evening<br>Free for orders above ₹699</div></div>
        </div>
        <div class="ret-box">
          <strong>🔄 Return &amp; Refund Policy:</strong><br>
          We accept returns within <strong>7 days</strong> of delivery for quality issues. If you receive a damaged, spoiled or incorrect product, raise a return request from your account. Refunds processed within <strong>3–5 business days</strong>. For perishables, report within <strong>24 hours</strong> with a photo.
        </div>
        <div class="warn-box">
          ⚠️ <strong>Handling Note:</strong> Fresh produce may have natural variation in size, colour and appearance. This is completely normal and does not affect quality. Our team hand-selects every item for best freshness before packing.
        </div>
      </div>

      <div class="tab-pane" id="tab-reviews">
        <?php
          $bd = [5=>0,4=>0,3=>0,2=>0,1=>0];
          foreach($product->approvedReviews as $r){ $bd[$r->rating] = ($bd[$r->rating]??0) + 1; }
        ?>
        <div class="rev-sum">
          <div>
            <div class="rev-big-n"><?php echo e(number_format($avgRating,1)); ?></div>
            <div class="rev-big-s"><?php for($i=1;$i<=5;$i++): ?><span><?php echo e($i<=$fullS?'★':'☆'); ?></span><?php endfor; ?></div>
            <div class="rev-big-l"><?php echo e($reviewCount); ?> <?php echo e($reviewCount===1?'review':'reviews'); ?></div>
          </div>
          <div class="rev-bars">
            <?php $__currentLoopData = [5,4,3,2,1]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $cnt=$bd[$s]??0; $pct=$reviewCount>0?round($cnt/$reviewCount*100):0; ?>
            <div class="rbr">
              <span class="rbl"><?php echo e($s); ?></span>
              <span class="rbs">★</span>
              <div class="rbt"><div class="rbf" data-w="<?php echo e($pct); ?>" style="width:0%"></div></div>
              <span class="rbc"><?php echo e($cnt); ?></span>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
        <?php $__empty_1 = true; $__currentLoopData = $product->approvedReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="rev-card">
          <div class="rev-top">
            <div class="rev-av"><?php echo e(strtoupper(substr($review->user->name ?? 'U',0,2))); ?></div>
            <div style="flex:1;min-width:0">
              <div class="rev-name"><?php echo e($review->user->name ?? 'Customer'); ?> <span class="veri">✓ Verified</span></div>
              <div class="rev-meta"><?php echo e($review->created_at->format('d M Y')); ?></div>
            </div>
            <div class="rev-sr"><?php for($i=1;$i<=5;$i++): ?><span><?php echo e($i<=$review->rating?'★':'☆'); ?></span><?php endfor; ?></div>
          </div>
          <?php if($review->title): ?><div class="rev-title"><?php echo e($review->title); ?></div><?php endif; ?>
          <div class="rev-body"><?php echo e($review->body); ?></div>
          <div class="rev-hlp">Helpful? <button class="hlp-btn" type="button">👍 Yes</button> <button class="hlp-btn" type="button">👎 No</button></div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="no-rev">
          <div style="font-size:36px;margin-bottom:10px">⭐</div>
          <div style="font-size:15px;font-weight:600;margin-bottom:5px">No reviews yet</div>
          <div style="font-size:13px">Be the first to review this product!</div>
        </div>
        <?php endif; ?>
        <?php if(auth()->guard()->check()): ?>
        <div class="write-box">
          <div class="write-title">✍️ Write a Review</div>
          <form action="#" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
            <div style="font-size:13px;color:var(--muted);font-weight:500;margin-bottom:8px">Your Rating:</div>
            <div class="wr-stars" id="wrStars"><?php for($i=1;$i<=5;$i++): ?><span data-v="<?php echo e($i); ?>" onclick="setWrRating(<?php echo e($i); ?>)">★</span><?php endfor; ?></div>
            <input type="hidden" name="rating" id="wrRating" value="5">
            <input type="text" name="title" class="field" placeholder="Review title (e.g. Great quality!)">
            <textarea name="body" class="field" rows="4" placeholder="Share your experience with this product..."></textarea>
            <button type="submit" class="btn-sub">Submit Review →</button>
          </form>
        </div>
        <?php else: ?>
        <div class="login-p"><a href="<?php echo e(route('login')); ?>">Login</a> or <a href="#">Register</a> to write a review</div>
        <?php endif; ?>
      </div>

      <div class="tab-pane" id="tab-qa">
        <div style="font-size:14.5px;font-weight:700;margin-bottom:16px">Customer Questions &amp; Answers</div>
        <?php $faqs=[
          ['q'=>'Is this product organically grown?','a'=>'Our products are sourced from verified farms using sustainable practices. While not all are certified organic, they are grown with minimal pesticide use and are quality-checked before dispatch.'],
          ['q'=>'How is this packaged for delivery?','a'=>'We use eco-friendly packaging that maintains freshness during transit. Products are packed in clean, food-grade material and sealed to prevent contamination.'],
          ['q'=>'What is the shelf life after delivery?','a'=>'Freshness varies by product. Generally, leafy greens stay fresh 2–3 days, root vegetables 5–7 days, and fruits 3–5 days when stored properly in a refrigerator.'],
          ['q'=>'Can I cancel or modify my order?','a'=>'Orders can be modified or cancelled within 2 hours of placement. After that, the order enters processing. Contact our support team for any urgent changes.'],
        ]; ?>
        <div style="max-width:760px">
          <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="faq-item">
            <div class="faq-q" onclick="toggleFaq(this)"><span><?php echo e($faq['q']); ?></span><span class="faq-ic">+</span></div>
            <div class="faq-a"><?php echo e($faq['a']); ?></div>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php if(auth()->guard()->check()): ?>
        <div style="margin-top:18px;max-width:560px">
          <div style="font-size:13.5px;font-weight:600;margin-bottom:10px">Ask a Question</div>
          <textarea class="field" rows="3" placeholder="Type your question about this product..."></textarea>
          <button class="btn-sub" type="button">Ask Question →</button>
        </div>
        <?php endif; ?>
      </div>

    </div>
  </div>

  <!-- RELATED PRODUCTS -->
  <?php if($related->count() > 0): ?>
  <div class="rel-sec">
    <div class="sec-hd">
      <div class="sec-title">You May Also <span>Like</span></div>
      <a href="<?php echo e(route('category.show', $product->category->slug ?? '#')); ?>" class="see-all">View All →</a>
    </div>
    <div class="rel-grid">
      <?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="rel-card">
        <a href="<?php echo e(route('product.show', $rel->slug)); ?>">
          <div class="rel-img">
            <?php if($rel->thumbnail): ?>
              <img src="<?php echo e(asset('storage/'.$rel->thumbnail)); ?>" alt="<?php echo e($rel->name); ?>" loading="lazy">
            <?php else: ?>
              <?php echo e(['Vegetables'=>'🥬','Fruits'=>'🍎','Dairy & Eggs'=>'🥛','Meat & Fish'=>'🍗','Bakery'=>'🧁','Beverages'=>'🧃'][$rel->category->name ?? ''] ?? '🛒'); ?>

            <?php endif; ?>
            <?php if($rel->is_on_sale): ?><div class="rel-sale-t"><?php echo e($rel->discount_percent); ?>%</div><?php endif; ?>
          </div>
          <div class="rel-body">
            <div class="rel-cat"><?php echo e($rel->category->name ?? ''); ?></div>
            <div class="rel-name"><?php echo e($rel->name); ?></div>
            <div class="rel-foot">
              <div>
                <div class="rel-p">₹<?php echo e(number_format($rel->current_price)); ?></div>
                <?php if($rel->is_on_sale): ?><div class="rel-old-p">₹<?php echo e(number_format($rel->price)); ?></div><?php endif; ?>
              </div>
              <div class="rel-st">★★★★☆</div>
            </div>
          </div>
        </a>
        <form action="<?php echo e(route('cart.add')); ?>" method="POST" style="margin:0">
          <?php echo csrf_field(); ?>
          <input type="hidden" name="product_id" value="<?php echo e($rel->id); ?>">
          <input type="hidden" name="qty" value="1">
          <button type="submit" class="rel-add" title="Quick Add">+</button>
        </form>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
  <?php endif; ?>

</div>

<footer>
  © <?php echo e(date('Y')); ?> GroceryMart — Delivering Freshness Every Day &nbsp;·&nbsp;
  <a href="<?php echo e(route('home')); ?>">Home</a> &nbsp;·&nbsp;
  <a href="<?php echo e(route('shop')); ?>">Shop</a>
</footer>

<script>
function adjustQty(d){
  var i=document.getElementById('qtyInput');
  var v=parseInt(i.value)+d,mx=parseInt(i.max)||99;
  if(v<1)v=1;if(v>mx)v=mx;i.value=v;
}
function switchImg(src,el){
  var img=document.getElementById('mainImg');
  if(img){img.style.opacity='0';setTimeout(function(){img.src=src;img.style.opacity='1';},140);}
  document.querySelectorAll('.thumb').forEach(function(t){t.classList.remove('active');});
  el.classList.add('active');
}
function handleZoom(e,w){
  var img=w.querySelector('img');if(!img)return;
  var r=w.getBoundingClientRect();
  img.style.transformOrigin=((e.clientX-r.left)/r.width*100)+'% '+((e.clientY-r.top)/r.height*100)+'%';
  img.style.transform='scale(1.8)';
}
function resetZoom(w){
  var img=w.querySelector('img');if(!img)return;
  img.style.transform='';img.style.transformOrigin='center center';
}
function openTab(id,btn){
  document.querySelectorAll('.tab-pane').forEach(function(p){p.classList.remove('active');});
  document.querySelectorAll('.tab-btn').forEach(function(b){b.classList.remove('active');});
  document.getElementById('tab-'+id).classList.add('active');
  btn.classList.add('active');
  if(id==='reviews'){
    setTimeout(function(){
      document.querySelectorAll('.rbf').forEach(function(b){
        b.style.width='0%';
        setTimeout(function(){b.style.width=b.getAttribute('data-w')+'%';},60);
      });
    },100);
  }
}
var sb=document.getElementById('stickyBar');
window.addEventListener('scroll',function(){
  var top=document.getElementById('productTop');
  if(!top)return;
  if(top.getBoundingClientRect().bottom<0)sb.classList.add('show');
  else sb.classList.remove('show');
},{passive:true});
function showToast(msg,ic){
  var t=document.getElementById('toast');
  document.getElementById('t-ic').textContent=ic||'✅';
  document.getElementById('t-msg').textContent=msg;
  t.classList.add('show');
  clearTimeout(t._t);
  t._t=setTimeout(function(){t.classList.remove('show');},2800);
}
var mf=document.getElementById('mainCartForm');
if(mf){
  mf.addEventListener('submit',function(){
    var b=document.getElementById('atcBtn');
    b.textContent='✅ Added!';
    showToast('Added to cart!','🛒');
    setTimeout(function(){b.textContent='🛒 Add to Cart';},2000);
  });
}
function toggleWish(btn){
  var on=btn.classList.toggle('on');
  btn.textContent=on?'❤️':'🤍';
  showToast(on?'Added to wishlist!':'Removed from wishlist',on?'❤️':'💔');
}
function setWrRating(v){
  document.getElementById('wrRating').value=v;
  document.querySelectorAll('#wrStars span').forEach(function(s,i){s.classList.toggle('on',i<v);});
}
setWrRating(5);
function toggleFaq(h){
  var b=h.nextElementSibling,ic=h.querySelector('.faq-ic'),open=b.style.display==='block';
  b.style.display=open?'none':'block';
  ic.style.transform=open?'rotate(0deg)':'rotate(45deg)';
}
function shareWA(){window.open('https://wa.me/?text='+encodeURIComponent('Check out: '+document.title+' - '+location.href),'_blank');}
function copyLink(){if(navigator.clipboard)navigator.clipboard.writeText(location.href).then(function(){showToast('Link copied!','🔗');});}
</script>
</body>
</html><?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views\frontend\product-detail.blade.php ENDPATH**/ ?>