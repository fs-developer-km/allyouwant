<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<title><?php echo e($product->name); ?> — GroceryMart</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Inter',sans-serif;background:#f8f9fa;color:#1a1a2e}
a{text-decoration:none;color:inherit}
:root{--green:#16a34a;--green-dark:#15803d;--green-light:#dcfce7;--border:#e2e8f0}
.navbar{background:#fff;border-bottom:1px solid var(--border);position:sticky;top:0;z-index:200;box-shadow:0 1px 4px rgba(0,0,0,.06)}
.nav-inner{max-width:1280px;margin:0 auto;padding:0 20px;height:60px;display:flex;align-items:center;gap:16px}
.logo{font-size:20px;font-weight:800;color:#1a1a2e}.logo span{color:var(--green)}
.nav-right{display:flex;align-items:center;gap:8px;margin-left:auto}
.nav-link{font-size:13px;font-weight:500;color:#374151;padding:7px 12px;border-radius:7px;transition:all .15s}
.nav-link:hover{background:var(--green-light);color:var(--green)}
.btn-cart{background:var(--green);color:#fff;padding:8px 16px;border-radius:8px;font-size:13px;font-weight:600;display:flex;align-items:center;gap:6px}
.breadcrumb{background:#fff;border-bottom:1px solid var(--border);padding:10px 0}
.bc-inner{max-width:1280px;margin:0 auto;padding:0 20px;display:flex;align-items:center;gap:6px;font-size:13px;color:#9ca3af}
.bc-inner a{color:var(--green);font-weight:500}.bc-inner span{color:#d1d5db}
.wrap{max-width:1280px;margin:24px auto;padding:0 20px}
.alert{padding:10px 20px;font-size:13px}
.alert-success{background:#dcfce7;color:#15803d;border-bottom:1px solid #bbf7d0}

/* PRODUCT DETAIL */
.product-box{display:grid;grid-template-columns:1fr 1fr;gap:40px;background:#fff;border-radius:16px;padding:36px;border:1px solid var(--border);margin-bottom:24px}
.img-section{}
.main-img{background:#f8fafc;border-radius:14px;height:380px;display:flex;align-items:center;justify-content:center;overflow:hidden;margin-bottom:12px;border:1px solid var(--border)}
.main-img img{width:100%;height:100%;object-fit:contain}
.main-img-emoji{font-size:160px}
.thumb-row{display:flex;gap:8px}
.thumb{width:68px;height:68px;border-radius:8px;border:2px solid var(--border);overflow:hidden;cursor:pointer;display:flex;align-items:center;justify-content:center;background:#f8fafc;font-size:28px;transition:border-color .15s}
.thumb:hover,.thumb.active{border-color:var(--green)}
.thumb img{width:100%;height:100%;object-fit:cover}

/* INFO SECTION */
.prod-cat-tag{font-size:12px;font-weight:600;color:var(--green);text-transform:uppercase;letter-spacing:.4px;margin-bottom:8px;display:flex;align-items:center;gap:6px}
.prod-title{font-size:26px;font-weight:800;color:#1a1a2e;line-height:1.2;margin-bottom:12px}
.prod-rating-row{display:flex;align-items:center;gap:12px;margin-bottom:16px;padding-bottom:16px;border-bottom:1px solid #f1f5f9}
.stars{color:#f59e0b;font-size:15px}
.rating-count{font-size:13px;color:#9ca3af}
.in-stock-badge{display:inline-flex;align-items:center;gap:5px;background:#dcfce7;color:#15803d;font-size:12.5px;font-weight:600;padding:4px 12px;border-radius:20px}
.out-stock-badge{display:inline-flex;align-items:center;gap:5px;background:#fef2f2;color:#dc2626;font-size:12.5px;font-weight:600;padding:4px 12px;border-radius:20px}
.price-section{margin:18px 0}
.price-current{font-size:34px;font-weight:800;color:var(--green);line-height:1}
.price-old{font-size:18px;color:#9ca3af;text-decoration:line-through;margin-left:10px}
.discount-tag{background:#fef2f2;color:#dc2626;font-size:13px;font-weight:700;padding:3px 10px;border-radius:6px;margin-left:8px}
.price-per{font-size:13px;color:#9ca3af;margin-top:6px}
.qty-section{display:flex;align-items:center;gap:14px;margin:20px 0}
.qty-label{font-size:13.5px;font-weight:600;color:#374151}
.qty-ctrl{display:flex;align-items:center;gap:0;border:1.5px solid var(--border);border-radius:9px;overflow:hidden}
.qty-btn{width:38px;height:38px;background:#f8fafc;border:none;font-size:18px;cursor:pointer;transition:background .15s;display:flex;align-items:center;justify-content:center;font-family:inherit}
.qty-btn:hover{background:var(--green-light)}
.qty-val{width:44px;height:38px;border:none;border-left:1px solid var(--border);border-right:1px solid var(--border);text-align:center;font-size:15px;font-weight:700;outline:none;font-family:inherit}
.action-btns{display:flex;flex-direction:column;gap:10px;margin-top:8px}
.btn-add-cart{background:var(--green);color:#fff;border:none;padding:14px 28px;border-radius:10px;font-size:15px;font-weight:700;cursor:pointer;width:100%;transition:background .2s,transform .15s;font-family:inherit;display:flex;align-items:center;justify-content:center;gap:8px}
.btn-add-cart:hover{background:var(--green-dark);transform:translateY(-1px)}
.btn-add-cart:disabled{background:#e2e8f0;color:#9ca3af;cursor:not-allowed;transform:none}
.btn-wishlist{background:#fff;color:#374151;border:1.5px solid var(--border);padding:12px 28px;border-radius:10px;font-size:14px;font-weight:600;cursor:pointer;width:100%;transition:all .2s;font-family:inherit}
.btn-wishlist:hover{border-color:#f97316;color:#f97316;background:#fff7ed}
.prod-meta{display:flex;flex-direction:column;gap:8px;margin-top:20px;padding-top:18px;border-top:1px solid #f1f5f9;font-size:13px}
.meta-row{display:flex;gap:10px}
.meta-label{color:#9ca3af;min-width:80px;font-weight:500}
.meta-val{color:#374151;font-weight:500}
.prod-desc{margin-top:18px;padding-top:18px;border-top:1px solid #f1f5f9}
.desc-title{font-size:14px;font-weight:700;color:#374151;margin-bottom:8px}
.desc-text{font-size:13.5px;color:#4b5563;line-height:1.75}

/* TABS */
.tabs-section{background:#fff;border-radius:14px;padding:28px 32px;margin-bottom:24px;border:1px solid var(--border)}
.tabs{display:flex;gap:0;border-bottom:2px solid #f1f5f9;margin-bottom:24px}
.tab-btn{padding:10px 22px;font-size:14px;font-weight:500;color:#9ca3af;cursor:pointer;border:none;background:none;border-bottom:2.5px solid transparent;margin-bottom:-2px;transition:all .15s;font-family:inherit}
.tab-btn.active,.tab-btn:hover{color:var(--green);border-bottom-color:var(--green);font-weight:600}
.tab-content{display:none}
.tab-content.active{display:block}

/* REVIEWS */
.review-item{padding:18px 0;border-bottom:1px solid #f1f5f9}
.review-item:last-child{border-bottom:none}
.rev-top{display:flex;align-items:center;gap:12px;margin-bottom:8px}
.rev-avatar{width:38px;height:38px;border-radius:50%;background:var(--green);color:#fff;font-size:13px;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.rev-name{font-size:13.5px;font-weight:600}
.rev-date{font-size:12px;color:#9ca3af;margin-top:1px}
.rev-stars{color:#f59e0b;font-size:13px;margin-bottom:6px;letter-spacing:-.5px}
.rev-text{font-size:13px;color:#4b5563;line-height:1.65}
.no-reviews{text-align:center;padding:32px;color:#9ca3af;font-size:14px}
.write-review{background:#f8fafc;border:1.5px solid var(--border);border-radius:10px;padding:20px;margin-top:16px}
.write-review h4{font-size:14px;font-weight:700;margin-bottom:14px}
.star-select{display:flex;gap:6px;margin-bottom:12px;font-size:24px;cursor:pointer}
.star-select span{color:#d1d5db;transition:color .1s}
.star-select span.active,.star-select span:hover{color:#f59e0b}
.form-control{width:100%;padding:9px 13px;border:1.5px solid var(--border);border-radius:8px;font-size:13.5px;font-family:inherit;outline:none;transition:border-color .2s}
.form-control:focus{border-color:var(--green)}
.submit-btn{background:var(--green);color:#fff;border:none;padding:10px 24px;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;margin-top:10px;font-family:inherit}

/* RELATED */
.related-section{background:#fff;border-radius:14px;padding:28px 32px;border:1px solid var(--border)}
.rel-title{font-size:18px;font-weight:700;margin-bottom:20px}
.related-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:14px}
.rel-card{border:1.5px solid var(--border);border-radius:10px;overflow:hidden;transition:all .2s;text-decoration:none;color:inherit;display:block}
.rel-card:hover{transform:translateY(-3px);box-shadow:0 8px 24px rgba(0,0,0,.08);border-color:#bbf7d0}
.rel-img{height:120px;background:#f8fafc;display:flex;align-items:center;justify-content:center;font-size:52px;overflow:hidden}
.rel-img img{width:100%;height:100%;object-fit:cover}
.rel-body{padding:10px}
.rel-name{font-size:12.5px;font-weight:600;margin-bottom:4px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
.rel-price{font-size:14px;font-weight:700;color:var(--green)}

@media(max-width:1024px){.related-grid{grid-template-columns:repeat(3,1fr)}}
@media(max-width:768px){
  .product-box{grid-template-columns:1fr;padding:20px;gap:24px}
  .main-img{height:260px}
  .related-grid{grid-template-columns:repeat(2,1fr)}
}
</style>
</head>
<body>
<nav class="navbar">
  <div class="nav-inner">
    <a href="<?php echo e(route('home')); ?>" class="logo">Grocery<span>Mart</span></a>
    <div class="nav-right">
      <a href="<?php echo e(route('shop')); ?>" class="nav-link">Shop</a>
      <?php if(auth()->guard()->check()): ?>
        <a href="<?php echo e(route('account.index')); ?>" class="nav-link">👤 Account</a>
      <?php else: ?>
        <a href="<?php echo e(route('login')); ?>" class="nav-link">Login</a>
      <?php endif; ?>
      <a href="<?php echo e(route('cart.index')); ?>" class="btn-cart">
        🛒 Cart
        <?php $c=count(session('cart',[]));?>
        <?php if($c>0): ?><span style="background:rgba(255,255,255,.25);border-radius:4px;padding:1px 6px;font-size:11px;font-weight:700"><?php echo e($c); ?></span><?php endif; ?>
      </a>
    </div>
  </div>
</nav>

<?php if(session('success')): ?><div class="alert alert-success">✅ <?php echo e(session('success')); ?></div><?php endif; ?>

<div class="breadcrumb">
  <div class="bc-inner">
    <a href="<?php echo e(route('home')); ?>">Home</a><span>›</span>
    <a href="<?php echo e(route('shop')); ?>">Shop</a><span>›</span>
    <?php if($product->category): ?>
      <a href="<?php echo e(route('category.show', $product->category->slug)); ?>"><?php echo e($product->category->name); ?></a><span>›</span>
    <?php endif; ?>
    <span style="color:#374151"><?php echo e(Str::limit($product->name, 40)); ?></span>
  </div>
</div>

<div class="wrap">
  
  <div class="product-box">

    
    <div class="img-section">
      <div class="main-img" id="mainImg">
        <?php if($product->thumbnail): ?>
          <img src="<?php echo e(asset('storage/'.$product->thumbnail)); ?>" alt="<?php echo e($product->name); ?>" id="mainImgEl">
        <?php else: ?>
          <div class="main-img-emoji"><?php echo e(['Vegetables'=>'🥬','Fruits'=>'🍎','Dairy & Eggs'=>'🥛','Meat & Fish'=>'🍗','Bakery'=>'🧁','Beverages'=>'🧃'][$product->category->name ?? ''] ?? '🛒'); ?></div>
        <?php endif; ?>
      </div>
      <?php if($product->images->count() > 0): ?>
      <div class="thumb-row">
        <?php if($product->thumbnail): ?>
        <div class="thumb active" onclick="changeImg('<?php echo e(asset('storage/'.$product->thumbnail)); ?>', this)">
          <img src="<?php echo e(asset('storage/'.$product->thumbnail)); ?>" alt="Main">
        </div>
        <?php endif; ?>
        <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="thumb" onclick="changeImg('<?php echo e($img->image_url); ?>', this)">
          <img src="<?php echo e($img->image_url); ?>" alt="Image">
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <?php endif; ?>
    </div>

    
    <div>
      <div class="prod-cat-tag">
        <?php if($product->category): ?><a href="<?php echo e(route('category.show', $product->category->slug)); ?>" style="color:var(--green)"><?php echo e($product->category->name); ?></a><?php endif; ?>
        <?php if($product->is_bestseller): ?> &nbsp;· 🔥 Bestseller <?php endif; ?>
        <?php if($product->is_new_arrival): ?> &nbsp;· ✨ New Arrival <?php endif; ?>
      </div>
      <h1 class="prod-title"><?php echo e($product->name); ?></h1>

      <div class="prod-rating-row">
        <?php $avgRating = $product->approvedReviews->avg('rating') ?: 0; $reviewCount = $product->approvedReviews->count(); ?>
        <div class="stars">
          <?php for($i=1;$i<=5;$i++): ?><?php echo e($i <= round($avgRating) ? '★' : '☆'); ?><?php endfor; ?>
        </div>
        <span class="rating-count"><?php echo e(number_format($avgRating,1)); ?> (<?php echo e($reviewCount); ?> reviews)</span>
        <?php if($product->is_in_stock): ?>
          <span class="in-stock-badge">✅ In Stock</span>
        <?php else: ?>
          <span class="out-stock-badge">❌ Out of Stock</span>
        <?php endif; ?>
      </div>

      <div class="price-section">
        <div style="display:flex;align-items:baseline;flex-wrap:wrap;gap:4px">
          <span class="price-current">₹<?php echo e(number_format($product->current_price)); ?></span>
          <?php if($product->is_on_sale): ?>
            <span class="price-old">₹<?php echo e(number_format($product->price)); ?></span>
            <span class="discount-tag"><?php echo e($product->discount_percent); ?>% OFF</span>
          <?php endif; ?>
        </div>
        <div class="price-per">Per <?php echo e($product->unit); ?><?php echo e($product->weight ? ' · '.$product->weight : ''); ?></div>
      </div>

      <?php if($product->is_in_stock): ?>
      <form action="<?php echo e(route('cart.add')); ?>" method="POST" id="addCartForm">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
        <div class="qty-section">
          <span class="qty-label">Quantity:</span>
          <div class="qty-ctrl">
            <button type="button" class="qty-btn" onclick="changeQty(-1)">−</button>
            <input type="number" name="qty" class="qty-val" value="1" min="1" max="<?php echo e($product->stock_quantity); ?>" id="qtyInput">
            <button type="button" class="qty-btn" onclick="changeQty(1)">+</button>
          </div>
          <span style="font-size:12px;color:#9ca3af"><?php echo e($product->stock_quantity); ?> available</span>
        </div>
        <div class="action-btns">
          <button type="submit" class="btn-add-cart">🛒 Add to Cart</button>
          <button type="button" class="btn-wishlist">🤍 Add to Wishlist</button>
        </div>
      </form>
      <?php else: ?>
        <div class="action-btns" style="margin-top:16px">
          <button class="btn-add-cart" disabled>❌ Out of Stock</button>
        </div>
      <?php endif; ?>

      <div class="prod-meta">
        <?php if($product->sku): ?><div class="meta-row"><span class="meta-label">SKU:</span><span class="meta-val"><?php echo e($product->sku); ?></span></div><?php endif; ?>
        <?php if($product->category): ?><div class="meta-row"><span class="meta-label">Category:</span><span class="meta-val"><a href="<?php echo e(route('category.show',$product->category->slug)); ?>" style="color:var(--green)"><?php echo e($product->category->name); ?></a></span></div><?php endif; ?>
        <div class="meta-row"><span class="meta-label">Unit:</span><span class="meta-val"><?php echo e($product->weight); ?> per <?php echo e($product->unit); ?></span></div>
        <div class="meta-row"><span class="meta-label">Delivery:</span><span class="meta-val">🚚 Free delivery above ₹499</span></div>
      </div>

      <?php if($product->description): ?>
      <div class="prod-desc">
        <div class="desc-title">About this product</div>
        <div class="desc-text"><?php echo e($product->description); ?></div>
      </div>
      <?php endif; ?>
    </div>
  </div>

  
  <div class="tabs-section">
    <div class="tabs">
      <button class="tab-btn active" onclick="showTab('details', this)">📋 Product Details</button>
      <button class="tab-btn" onclick="showTab('reviews', this)">⭐ Reviews (<?php echo e($reviewCount); ?>)</button>
    </div>

    <div class="tab-content active" id="tab-details">
      <table style="font-size:13.5px;border-collapse:collapse;width:100%;max-width:500px">
        <?php if($product->name): ?><tr><td style="padding:8px 16px 8px 0;color:#9ca3af;font-weight:500;width:140px">Product Name</td><td style="color:#374151;font-weight:500"><?php echo e($product->name); ?></td></tr><?php endif; ?>
        <?php if($product->category): ?><tr><td style="padding:8px 16px 8px 0;color:#9ca3af;font-weight:500">Category</td><td style="color:#374151;font-weight:500"><?php echo e($product->category->name); ?></td></tr><?php endif; ?>
        <?php if($product->weight): ?><tr><td style="padding:8px 16px 8px 0;color:#9ca3af;font-weight:500">Weight/Size</td><td style="color:#374151;font-weight:500"><?php echo e($product->weight); ?></td></tr><?php endif; ?>
        <tr><td style="padding:8px 16px 8px 0;color:#9ca3af;font-weight:500">Unit</td><td style="color:#374151;font-weight:500">Per <?php echo e($product->unit); ?></td></tr>
        <?php if($product->sku): ?><tr><td style="padding:8px 16px 8px 0;color:#9ca3af;font-weight:500">SKU</td><td style="color:#374151;font-weight:500"><?php echo e($product->sku); ?></td></tr><?php endif; ?>
        <tr><td style="padding:8px 16px 8px 0;color:#9ca3af;font-weight:500">Availability</td><td style="font-weight:600;color:<?php echo e($product->is_in_stock ? '#16a34a' : '#dc2626'); ?>"><?php echo e($product->is_in_stock ? '✅ In Stock ('.$product->stock_quantity.' units)' : '❌ Out of Stock'); ?></td></tr>
        <tr><td style="padding:8px 16px 8px 0;color:#9ca3af;font-weight:500">Delivery</td><td style="color:#374151;font-weight:500">🚚 Free above ₹499 · ₹40 below ₹499</td></tr>
      </table>
    </div>

    <div class="tab-content" id="tab-reviews">
      <?php $__empty_1 = true; $__currentLoopData = $product->approvedReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="review-item">
        <div class="rev-top">
          <div class="rev-avatar"><?php echo e(substr($review->user->name ?? 'U', 0, 2)); ?></div>
          <div><div class="rev-name"><?php echo e($review->user->name ?? 'Customer'); ?></div><div class="rev-date"><?php echo e($review->created_at->format('d M Y')); ?></div></div>
        </div>
        <div class="rev-stars"><?php echo e(str_repeat('★', $review->rating)); ?><?php echo e(str_repeat('☆', 5-$review->rating)); ?></div>
        <?php if($review->title): ?><div style="font-size:13.5px;font-weight:600;margin-bottom:4px"><?php echo e($review->title); ?></div><?php endif; ?>
        <div class="rev-text"><?php echo e($review->body); ?></div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <div class="no-reviews">⭐ No reviews yet. Be the first to review this product!</div>
      <?php endif; ?>

      <?php if(auth()->guard()->check()): ?>
      <div class="write-review">
        <h4>✍️ Write a Review</h4>
        <form action="#" method="POST">
          <?php echo csrf_field(); ?>
          <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
          <div class="star-select" id="starSelect">
            <?php for($i=1;$i<=5;$i++): ?><span data-val="<?php echo e($i); ?>" onclick="setRating(<?php echo e($i); ?>)">★</span><?php endfor; ?>
          </div>
          <input type="hidden" name="rating" id="ratingVal" value="5">
          <input type="text" name="title" class="form-control" placeholder="Review title..." style="margin-bottom:10px">
          <textarea name="body" class="form-control" rows="4" placeholder="Share your experience..."></textarea>
          <button type="submit" class="submit-btn">Submit Review</button>
        </form>
      </div>
      <?php else: ?>
      <div style="text-align:center;padding:16px;background:#f8fafc;border-radius:8px;margin-top:16px;font-size:13.5px;color:#64748b">
        <a href="<?php echo e(route('login')); ?>" style="color:var(--green);font-weight:600">Login</a> to write a review
      </div>
      <?php endif; ?>
    </div>
  </div>

  
  <?php if($related->count() > 0): ?>
  <div class="related-section">
    <div class="rel-title">🛒 Related Products</div>
    <div class="related-grid">
      <?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <a href="<?php echo e(route('product.show', $rel->slug)); ?>" class="rel-card">
        <div class="rel-img">
          <?php if($rel->thumbnail): ?>
            <img src="<?php echo e(asset('storage/'.$rel->thumbnail)); ?>" alt="<?php echo e($rel->name); ?>">
          <?php else: ?>
            <?php echo e(['Vegetables'=>'🥬','Fruits'=>'🍎','Dairy & Eggs'=>'🥛','Meat & Fish'=>'🍗','Bakery'=>'🧁','Beverages'=>'🧃'][$rel->category->name ?? ''] ?? '🛒'); ?>

          <?php endif; ?>
        </div>
        <div class="rel-body">
          <div class="rel-name"><?php echo e($rel->name); ?></div>
          <div class="rel-price">₹<?php echo e(number_format($rel->current_price)); ?></div>
        </div>
      </a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
  <?php endif; ?>
</div>

<div style="background:#0f1c14;color:rgba(255,255,255,.6);text-align:center;padding:20px;font-size:13px;margin-top:24px">
  © <?php echo e(date('Y')); ?> GroceryMart — <a href="<?php echo e(route('home')); ?>" style="color:#4ade80">Home</a> · <a href="<?php echo e(route('shop')); ?>" style="color:#4ade80">Shop</a>
</div>

<script>
function changeQty(val) {
  const input = document.getElementById('qtyInput');
  const max = parseInt(input.max);
  let newVal = parseInt(input.value) + val;
  if (newVal < 1) newVal = 1;
  if (newVal > max) newVal = max;
  input.value = newVal;
}
function changeImg(src, el) {
  document.getElementById('mainImgEl') && (document.getElementById('mainImgEl').src = src);
  document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
  el.classList.add('active');
}
function showTab(tab, btn) {
  document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
  document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
  document.getElementById('tab-'+tab).classList.add('active');
  btn.classList.add('active');
}
function setRating(val) {
  document.getElementById('ratingVal').value = val;
  document.querySelectorAll('#starSelect span').forEach((s,i) => {
    s.classList.toggle('active', i < val);
    s.style.color = i < val ? '#f59e0b' : '#d1d5db';
  });
}
setRating(5);
// Add to cart feedback
document.getElementById('addCartForm')?.addEventListener('submit', function() {
  const btn = this.querySelector('.btn-add-cart');
  btn.textContent = '✅ Added to Cart!';
  btn.style.background = '#15803d';
});
</script>
</body>
</html><?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views/frontend/product-detail.blade.php ENDPATH**/ ?>