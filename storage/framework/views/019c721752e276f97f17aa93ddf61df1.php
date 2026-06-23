<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>

<?php $__env->startSection('content'); ?>


<div class="location-bar" id="locationBar">
  <div class="location-bar-inner">
    <div class="loc-left" onclick="openLocationModal()">
      <div class="loc-icon">📍</div>
      <div class="loc-text">
        <div class="loc-label" id="locLabel">Detect your location</div>
        <div class="loc-sub" id="locSub">Tap to check delivery availability</div>
      </div>
    </div>
    <button type="button" class="loc-change-btn" onclick="openLocationModal()">Change</button>
  </div>
</div>


<div id="locationModal" class="loc-modal-overlay" onclick="if(event.target===this) closeLocationModal()">
  <div class="loc-modal">
    <div class="loc-modal-header">
      <div class="loc-modal-title">📍 Set Delivery Location</div>
      <button class="loc-modal-close" onclick="closeLocationModal()">×</button>
    </div>
    <div class="loc-modal-body">

      <button type="button" class="loc-detect-btn" id="locDetectBtn" onclick="detectCurrentLocation()">
        <span class="loc-detect-icon">📡</span>
        <span>Use my current location</span>
      </button>

      <div class="loc-divider"><span>OR</span></div>

      <div class="loc-pincode-row">
        <input type="text" id="locPincodeInput" class="loc-pincode-input" placeholder="Enter pincode (e.g. 110091)" maxlength="6" inputmode="numeric">
        <button type="button" class="loc-pincode-btn" onclick="checkPincodeHome()">Check</button>
      </div>

      <div id="locResultBox" class="loc-result-box" style="display:none">
        <div class="loc-result-icon" id="locResultIcon">✅</div>
        <div class="loc-result-text">
          <div class="loc-result-title" id="locResultTitle"></div>
          <div class="loc-result-sub" id="locResultSub"></div>
        </div>
      </div>

      <div class="loc-area-note">
        🏠 We currently deliver within <strong>10km</strong> of <strong>Mayur Vihar Phase-1, Delhi</strong>
      </div>

    </div>
  </div>
</div>



<div class="page-wrap">
  <div class="hero-section">
    <div class="hero-grid">

      
      <div class="sidebar-cats">
        <?php $__currentLoopData = $categories->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
          $icons = ['Vegetables'=>'🥬','Fruits'=>'🍎','Dairy & Eggs'=>'🥛','Meat & Fish'=>'🍗','Bakery'=>'🧁','Beverages'=>'🧃','Instant Food'=>'🍜','Personal Care'=>'🧴','Household'=>'🏠','Pet Care'=>'🐾'];
          $icon = $icons[$cat->name] ?? '🛒';
          $bg = ['Vegetables'=>'#f0faf4','Fruits'=>'#fff8f0','Dairy & Eggs'=>'#f0f8ff','Meat & Fish'=>'#fff0f0','Bakery'=>'#fffbf0','Beverages'=>'#f0f0ff','Instant Food'=>'#fff0fa','Personal Care'=>'#f5f0ff','Household'=>'#f0fff8','Pet Care'=>'#fff8f0'][$cat->name] ?? '#f3f4f6';
        ?>
        <a href="<?php echo e(route('category.show', $cat->slug)); ?>" class="sidebar-cat-item">
          <div class="sidebar-cat-left">
            <div class="sidebar-cat-icon" >
              <?php if($cat->image): ?>
                <img src="<?php echo e(asset('storage/'.$cat->image)); ?>" alt="<?php echo e($cat->name); ?>" style="width:100%;height:100%;object-fit:cover;border-radius:6px">
              <?php else: ?>
                <?php echo e($icon); ?>

              <?php endif; ?>
            </div>
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
          
          <img class="slide-img" src="<?php echo e(asset('assets/images/second bucket.png')); ?>" alt="Bucket" style="height: 280px; width:280px">
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
        <?php
          $vegCat   = $categories->firstWhere('name','Vegetables');
          $fruitCat2= $categories->firstWhere('name','Fruits');
          $dairyCat = $categories->firstWhere('name','Dairy & Eggs');
        ?>
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
      <a href="<?php echo e($fruitCat2 ? route('category.show',$fruitCat2->slug) : route('shop')); ?>" class="mini-card mini-c1">
        <div class="mini-emoji">🍓</div><div class="mini-tag">Fresh Picks</div><div class="mini-title">Seasonal Fruits</div><div class="mini-cta">Shop Now →</div>
      </a>
      <a href="<?php echo e($vegCat ? route('category.show',$vegCat->slug) : route('shop')); ?>" class="mini-card mini-c2">
        <div class="mini-emoji">🥦</div><div class="mini-tag">Farm Direct</div><div class="mini-title">Organic Veggies</div><div class="mini-cta">Shop Now →</div>
      </a>
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
      
      <a href="<?php echo e(route('categories.all')); ?>" class="sec-view-all">
    View All Categories →
</a>
    </div>

    <div class="cat-scroll">
      <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php
        $icons = ['Vegetables'=>'🥬','Fruits'=>'🍎','Dairy & Eggs'=>'🥛','Meat & Fish'=>'🍗','Bakery'=>'🧁','Beverages'=>'🧃','Instant Food'=>'🍜','Personal Care'=>'🧴','Household'=>'🏠','Pet Care'=>'🐾'];
        $icon = $icons[$cat->name] ?? '🛒';
      ?>
      <a href="<?php echo e(route('category.show', $cat->slug)); ?>" class="cat-box">
        <div class="cat-box-icon">
          <?php if($cat->image): ?>
            <img src="<?php echo e(asset('storage/'.$cat->image)); ?>" alt="<?php echo e($cat->name); ?>">
          <?php else: ?>
            <span style="font-size:24px"><?php echo e($icon); ?></span>
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
      <?php
        $pIcon = ['Vegetables'=>'🥬','Fruits'=>'🍎','Dairy & Eggs'=>'🥛','Meat & Fish'=>'🍗','Bakery'=>'🧁','Beverages'=>'🧃','Instant Food'=>'🍜','Personal Care'=>'🧴','Household'=>'🏠','Pet Care'=>'🐾'][$product->category->name ?? ''] ?? '🛒';
      ?>
      <div class="prod-card">
        <?php if($product->is_on_sale): ?>
          <div class="prod-badge badge-sale"><?php echo e($product->discount_percent); ?>% OFF</div>
        <?php elseif($product->is_new_arrival): ?>
          <div class="prod-badge badge-new">NEW</div>
        <?php elseif($product->is_bestseller): ?>
          <div class="prod-badge badge-hot">HOT</div>
        <?php endif; ?>
        <button class="prod-wish" onclick="toggleWish(this)" title="Wishlist">🤍</button>
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
              <?php if($product->is_on_sale): ?>
                <div class="prod-price-old">₹<?php echo e(number_format($product->price)); ?></div>
              <?php endif; ?>
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
            <?php if($product->thumbnail): ?>
              <img src="<?php echo e(asset('storage/'.$product->thumbnail)); ?>" alt="<?php echo e($product->name); ?>">
            <?php else: ?>
              <div class="prod-emoji"><?php echo e($pIcon); ?></div>
            <?php endif; ?>
          </div>
        </a>
        <div class="prod-body">
          <div class="prod-cat-tag"><?php echo e($product->category->name ?? ''); ?></div>
          <a href="<?php echo e(route('product.show',$product->slug)); ?>" style="text-decoration:none;color:inherit">
            <div class="prod-name"><?php echo e($product->name); ?></div>
          </a>
          <div class="prod-weight"><?php echo e($product->weight); ?> · <?php echo e($product->unit); ?></div>
          <div class="prod-footer">
            <div class="prod-price-wrap">
              <div class="prod-price">₹<?php echo e(number_format($product->current_price)); ?></div>
              <?php if($product->is_on_sale): ?>
                <div class="prod-price-old">₹<?php echo e(number_format($product->price)); ?></div>
              <?php endif; ?>
            </div>
            <?php if($product->is_in_stock): ?>
            <form action="<?php echo e(route('cart.add')); ?>" method="POST">
              <?php echo csrf_field(); ?>
              <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
              <input type="hidden" name="qty" value="1">
              <button type="submit" class="btn-add" onclick="addToCartAnim(this)">+</button>
            </form>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
  <?php endif; ?>

  
  <div class="section" style="padding-bottom:40px">
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

<?php $__env->startPush('styles'); ?>
<style>

/* ── LOCATION BAR ── */
.location-bar {
  background: #ffffff;
  border-bottom: 1px solid #e4e9f0;
  position: sticky;
  top: 0;
  z-index: 50;
}
.location-bar-inner {
  max-width: 1280px;
  margin: 0 auto;
  padding: 10px 20px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
}
.loc-left {
  display: flex;
  align-items: center;
  gap: 10px;
  cursor: pointer;
  flex: 1;
  min-width: 0;
}
.loc-icon {
  font-size: 22px;
  flex-shrink: 0;
}
.loc-text { min-width: 0; }
.loc-label {
  font-size: 13px;
  font-weight: 800;
  color: #1a202c;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.loc-sub {
  font-size: 11px;
  color: #64748b;
  font-weight: 500;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.location-bar.serviceable .loc-icon { color: #0d6e39; }
.location-bar.serviceable .loc-sub { color: #0d6e39; font-weight: 700; }
.location-bar.unserviceable .loc-sub { color: #ef4444; font-weight: 700; }

.loc-change-btn {
  background: #e6f4ec;
  color: #0d6e39;
  border: none;
  padding: 8px 16px;
  border-radius: 8px;
  font-size: 12px;
  font-weight: 800;
  cursor: pointer;
  flex-shrink: 0;
  font-family: 'Nunito', sans-serif;
  transition: background .2s;
}
.loc-change-btn:hover { background: #d4ecdf; }

/* ── LOCATION MODAL ── */
.loc-modal-overlay {
  display: none;
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,.5);
  z-index: 2000;
  align-items: center;
  justify-content: center;
  padding: 16px;
}
.loc-modal-overlay.active { display: flex; }
.loc-modal {
  background: #fff;
  border-radius: 16px;
  width: 100%;
  max-width: 420px;
  overflow: hidden;
  animation: locFadeIn .25s ease;
}
@keyframes locFadeIn { from { opacity:0; transform: translateY(12px); } to { opacity:1; transform: translateY(0); } }
.loc-modal-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 18px 20px;
  border-bottom: 1px solid #e4e9f0;
}
.loc-modal-title { font-size: 16px; font-weight: 800; color: #1a202c; }
.loc-modal-close {
  background: none; border: none; font-size: 24px; cursor: pointer; color: #94a3b8; line-height: 1;
}
.loc-modal-body { padding: 20px; }

.loc-detect-btn {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  background: linear-gradient(135deg, #0d6e39, #095c2f);
  color: #fff;
  border: none;
  padding: 14px 18px;
  border-radius: 11px;
  font-size: 14px;
  font-weight: 800;
  cursor: pointer;
  font-family: 'Nunito', sans-serif;
  transition: transform .2s, box-shadow .2s;
}
.loc-detect-btn:hover { transform: translateY(-1px); box-shadow: 0 4px 14px rgba(13,110,57,.3); }
.loc-detect-btn:disabled { opacity: .7; cursor: not-allowed; transform: none; }
.loc-detect-icon { font-size: 18px; }

.loc-divider {
  text-align: center;
  font-size: 11px;
  font-weight: 700;
  color: #94a3b8;
  margin: 16px 0;
  position: relative;
}
.loc-divider::before, .loc-divider::after {
  content: '';
  position: absolute;
  top: 50%;
  width: 40%;
  height: 1px;
  background: #e4e9f0;
}
.loc-divider::before { left: 0; }
.loc-divider::after { right: 0; }

.loc-pincode-row { display: flex; gap: 8px; }
.loc-pincode-input {
  flex: 1;
  padding: 12px 14px;
  border: 1.5px solid #e4e9f0;
  border-radius: 10px;
  font-size: 14px;
  font-weight: 700;
  font-family: 'Nunito', sans-serif;
  outline: none;
}
.loc-pincode-input:focus { border-color: #0d6e39; box-shadow: 0 0 0 3px rgba(13,110,57,.1); }
.loc-pincode-btn {
  background: #1a202c;
  color: #fff;
  border: none;
  padding: 12px 20px;
  border-radius: 10px;
  font-size: 13px;
  font-weight: 800;
  cursor: pointer;
  font-family: 'Nunito', sans-serif;
}

.loc-result-box {
  margin-top: 14px;
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 14px;
  border-radius: 10px;
  border: 1px solid #c6e9d5;
  background: #f0faf4;
}
.loc-result-box.error { background: #fef2f2; border-color: #fecaca; }
.loc-result-icon { font-size: 24px; flex-shrink: 0; }
.loc-result-title { font-size: 13px; font-weight: 800; color: #15803d; }
.loc-result-box.error .loc-result-title { color: #ef4444; }
.loc-result-sub { font-size: 11px; color: #64748b; font-weight: 600; margin-top: 2px; }

.loc-area-note {
  margin-top: 16px;
  font-size: 11px;
  color: #94a3b8;
  text-align: center;
  font-weight: 600;
  line-height: 1.6;
}
.loc-area-note strong { color: #0d6e39; }

@media (max-width: 600px) {
  .location-bar-inner { padding: 8px 14px; }
  .loc-label { font-size: 12px; }
  .loc-sub { font-size: 10px; }
}

/* Category cards — proper image support */
.cat-box-icon {
  width: 100%;
  height: auto;
  border-radius: 10%;
  background: #f3f4f6;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  transition: background .2s;
  flex-shrink: 0;
}
.cat-box-icon img {
  width: auto;
  height: auto;
  object-fit: cover;
  border-radius: 10%;
  display: block;
}
.cat-box:hover .cat-box-icon {
  background: #e8f5ee;
}
/* Sidebar icon images */
.sidebar-cat-icon img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 6px;
  display: block;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>

// ══════════════════════════════════
// LOCATION BAR LOGIC (Blinkit-style)
// ══════════════════════════════════
const LOC_STORAGE_KEY = 'gm_delivery_location';

function openLocationModal() {
  document.getElementById('locationModal').classList.add('active');
}
function closeLocationModal() {
  document.getElementById('locationModal').classList.remove('active');
}

function setLocationBarUI(status, label, sub) {
  const bar = document.getElementById('locationBar');
  const lbl = document.getElementById('locLabel');
  const subEl = document.getElementById('locSub');
  bar.classList.remove('serviceable', 'unserviceable');
  if (status) bar.classList.add(status);
  lbl.textContent = label;
  subEl.textContent = sub;
}

function showLocResult(success, title, sub) {
  const box = document.getElementById('locResultBox');
  const icon = document.getElementById('locResultIcon');
  const t = document.getElementById('locResultTitle');
  const s = document.getElementById('locResultSub');
  box.style.display = 'flex';
  box.classList.toggle('error', !success);
  icon.textContent = success ? '✅' : '❌';
  t.textContent = title;
  s.textContent = sub || '';
}

function sendDeliveryCheck(payload, onResult) {
  fetch("<?php echo e(route('delivery.check')); ?>", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
    },
    body: JSON.stringify(payload)
  })
  .then(r => r.json())
  .then(data => onResult(data))
  .catch(() => onResult({ serviceable: false, message: '⚠️ Could not check delivery area', sub: 'Please try again' }));
}

function detectCurrentLocation() {
  const btn = document.getElementById('locDetectBtn');
  if (!navigator.geolocation) {
    showLocResult(false, 'Geolocation not supported', 'Please enter your pincode instead');
    return;
  }
  btn.disabled = true;
  btn.querySelector('span:last-child').textContent = 'Detecting...';

  navigator.geolocation.getCurrentPosition(function(pos) {
    sendDeliveryCheck({ lat: pos.coords.latitude, lng: pos.coords.longitude }, function(data) {
      btn.disabled = false;
      btn.querySelector('span:last-child').textContent = 'Use my current location';
      handleLocationResult(data, 'gps');
    });
  }, function() {
    btn.disabled = false;
    btn.querySelector('span:last-child').textContent = 'Use my current location';
    showLocResult(false, 'Location permission denied', 'Please enter your pincode below');
  });
}

function checkPincodeHome() {
  const val = document.getElementById('locPincodeInput').value.trim();
  if (!/^\d{6}$/.test(val)) {
    showLocResult(false, 'Invalid pincode', 'Enter a valid 6-digit pincode');
    return;
  }
  sendDeliveryCheck({ pincode: val }, function(data) {
    handleLocationResult(data, 'pincode', val);
  });
}

function handleLocationResult(data, source, pincode) {
  if (data.serviceable) {
    showLocResult(true, data.message, data.sub);
    const label = data.area ? `Delivering to ${data.area}` : 'Delivery available!';
    setLocationBarUI('serviceable', label, `~${data.km}km away · ${data.charge == 0 ? 'FREE delivery' : '₹' + data.charge + ' delivery fee'}`);

    // Save to localStorage for persistence across pages
    localStorage.setItem(LOC_STORAGE_KEY, JSON.stringify({
      serviceable: true,
      area: data.area,
      km: data.km,
      charge: data.charge,
      pincode: pincode || '',
      source: source,
      ts: Date.now()
    }));

    setTimeout(closeLocationModal, 1200);
  } else {
    showLocResult(false, data.message, data.sub);
    setLocationBarUI('unserviceable', 'Delivery not available here', data.message);

    localStorage.setItem(LOC_STORAGE_KEY, JSON.stringify({
      serviceable: false,
      ts: Date.now()
    }));
  }
}

// On page load — restore saved location
document.addEventListener('DOMContentLoaded', function() {
  const saved = localStorage.getItem(LOC_STORAGE_KEY);
  if (saved) {
    try {
      const data = JSON.parse(saved);
      // Re-validate if older than 1 hour
      const isStale = (Date.now() - (data.ts || 0)) > 60 * 60 * 1000;
      if (!isStale) {
        if (data.serviceable) {
          const label = data.area ? `Delivering to ${data.area}` : 'Delivery available!';
          setLocationBarUI('serviceable', label, `~${data.km}km away · ${data.charge == 0 ? 'FREE delivery' : '₹' + data.charge + ' delivery fee'}`);
        } else {
          setLocationBarUI('unserviceable', 'Delivery not available here', 'Tap to check another location');
        }
        return;
      }
    } catch(e) {}
  }
  setLocationBarUI('', 'Detect your location', 'Tap to check delivery availability');
});

// Slider
let cur=0;
const slides=document.querySelectorAll('.slide');
const dots=document.querySelectorAll('.dot');
let timer;
function goSlide(n){
  slides[cur].classList.remove('active');
  dots[cur].classList.remove('active');
  cur=n;
  slides[cur].classList.add('active');
  dots[cur].classList.add('active');
  clearInterval(timer);
  timer=setInterval(()=>goSlide((cur+1)%slides.length),4500);
}
timer=setInterval(()=>goSlide((cur+1)%slides.length),4500);

// Touch swipe on slider
let tx=0;
const sl=document.getElementById('heroSlider');
if(sl){
  sl.addEventListener('touchstart',e=>{tx=e.changedTouches[0].screenX},{passive:true});
  sl.addEventListener('touchend',e=>{
    const d=tx-e.changedTouches[0].screenX;
    if(Math.abs(d)>50) goSlide(d>0?(cur+1)%slides.length:(cur-1+slides.length)%slides.length);
  });
}

// Scroll reveal
const io=new IntersectionObserver(entries=>entries.forEach(e=>{
  if(e.isIntersecting){e.target.style.opacity='1';e.target.style.transform='translateY(0)'}
}),{threshold:.06});
document.querySelectorAll('.prod-card,.cat-box,.rev-card,.offer-banner,.feat-item').forEach(el=>{
  el.style.opacity='0';
  el.style.transform='translateY(16px)';
  el.style.transition='opacity .4s ease,transform .4s ease';
  io.observe(el);
});
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views/frontend/home.blade.php ENDPATH**/ ?>