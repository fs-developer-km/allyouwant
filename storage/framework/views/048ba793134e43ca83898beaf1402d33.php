<?php $__env->startSection('title', 'Shop'); ?>

<?php $__env->startSection('content'); ?>


<div class="breadcrumb">
  <div class="bc-inner">
    <a href="<?php echo e(route('home')); ?>">Home</a><span>›</span>
    <?php if(request('category') && $categories->find(request('category'))): ?>
      <a href="<?php echo e(route('shop')); ?>">Shop</a><span>›</span>
      <span style="color:#374151"><?php echo e($categories->find(request('category'))->name); ?></span>
    <?php else: ?>
      <span style="color:#374151">Shop</span>
    <?php endif; ?>
  </div>
</div>

<div class="wrap">
  <div class="shop-layout">

    
    <aside class="sidebar">
      <form method="GET" action="<?php echo e(route('shop')); ?>" id="filterForm">
        <div class="sidebar-section">
          <div class="sidebar-title">🗂️ Categories</div>
          <a href="<?php echo e(route('shop')); ?>" class="cat-item <?php echo e(!request('category') ? 'active' : ''); ?>">
            All Products
            <span class="cat-count"><?php echo e($products->total()); ?></span>
          </a>
          <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <a href="<?php echo e(route('shop')); ?>?category=<?php echo e($cat->id); ?><?php echo e(request('sort') ? '&sort='.request('sort') : ''); ?>"
            class="cat-item <?php echo e(request('category') == $cat->id ? 'active' : ''); ?>">
            <?php echo e($cat->name); ?>

            <span class="cat-count"><?php echo e($cat->activeProducts->count()); ?></span>
          </a>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="sidebar-section">
          <div class="sidebar-title">💰 Price Range</div>
          <div class="price-range">
            <input type="number" name="min_price" class="price-input" placeholder="Min ₹" value="<?php echo e(request('min_price')); ?>">
            <span style="color:#9ca3af;font-size:13px">to</span>
            <input type="number" name="max_price" class="price-input" placeholder="Max ₹" value="<?php echo e(request('max_price')); ?>">
          </div>
          <input type="hidden" name="category" value="<?php echo e(request('category')); ?>">
          <input type="hidden" name="sort" value="<?php echo e(request('sort')); ?>">
          <button type="submit" class="filter-btn">Apply Filter</button>
          <a href="<?php echo e(route('shop')); ?>" class="clear-btn" style="display:block;text-align:center">Clear All</a>
        </div>
        <div class="sidebar-section">
          <div class="sidebar-title">📦 Availability</div>
          <a href="<?php echo e(route('shop')); ?>?<?php echo e(http_build_query(array_merge(request()->except(['stock','page']), ['stock'=>'instock']))); ?>"
            class="cat-item <?php echo e(request('stock')==='instock' ? 'active' : ''); ?>">✅ In Stock Only</a>
          <a href="<?php echo e(route('shop')); ?>?<?php echo e(http_build_query(array_merge(request()->except(['stock','page']), ['stock'=>'sale']))); ?>"
            class="cat-item <?php echo e(request('stock')==='sale' ? 'active' : ''); ?>">🏷️ On Sale</a>
        </div>
      </form>
    </aside>

    
    <div>
      <div class="topbar-shop">
        <div class="results-info">
          Showing <strong><?php echo e($products->count()); ?></strong> of <strong><?php echo e($products->total()); ?></strong> products
        </div>
        <select class="sort-select" onchange="window.location='<?php echo e(route('shop')); ?>?'+new URLSearchParams({...Object.fromEntries(new URLSearchParams(location.search)),...{sort:this.value}}).toString()">
          <option value="" <?php echo e(!request('sort') ? 'selected':''); ?>>Latest First</option>
          <option value="price_asc"  <?php echo e(request('sort')==='price_asc'  ? 'selected':''); ?>>Price: Low to High</option>
          <option value="price_desc" <?php echo e(request('sort')==='price_desc' ? 'selected':''); ?>>Price: High to Low</option>
          <option value="bestseller" <?php echo e(request('sort')==='bestseller' ? 'selected':''); ?>>Bestsellers</option>
          <option value="newest"     <?php echo e(request('sort')==='newest'     ? 'selected':''); ?>>New Arrivals</option>
        </select>
      </div>

      <div class="products-grid">
        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="prod-card">
          <?php if(!$product->is_in_stock): ?>
            <div class="prod-badge out-badge">OUT OF STOCK</div>
          <?php elseif($product->is_on_sale): ?>
            <div class="prod-badge badge-sale"><?php echo e($product->discount_percent); ?>% OFF</div>
          <?php elseif($product->is_new_arrival): ?>
            <div class="prod-badge badge-new">NEW</div>
          <?php elseif($product->is_bestseller): ?>
            <div class="prod-badge badge-hot">BEST</div>
          <?php endif; ?>
          <a href="<?php echo e(route('product.show', $product->slug)); ?>">
            <div class="prod-img">
              <?php if($product->thumbnail): ?>
                <img src="<?php echo e(asset('storage/'.$product->thumbnail)); ?>" alt="<?php echo e($product->name); ?>">
              <?php else: ?>
                <?php echo e(['Vegetables'=>'🥬','Fruits'=>'🍎','Dairy & Eggs'=>'🥛','Meat & Fish'=>'🍗','Bakery'=>'🧁','Beverages'=>'🧃','Instant Food'=>'🍜','Personal Care'=>'🧴','Household'=>'🏠','Pet Care'=>'🐾'][$product->category->name ?? ''] ?? '🛒'); ?>

              <?php endif; ?>
            </div>
          </a>
          <div class="prod-body">
            <div class="prod-cat"><?php echo e($product->category->name ?? ''); ?></div>
            <a href="<?php echo e(route('product.show', $product->slug)); ?>" style="text-decoration:none">
              <div class="prod-name"><?php echo e($product->name); ?></div>
            </a>
            <div class="prod-weight"><?php echo e($product->weight); ?> · per <?php echo e($product->unit); ?></div>
            <div class="prod-footer">
              <div>
                <div class="prod-price">₹<?php echo e(number_format($product->current_price)); ?></div>
                <?php if($product->is_on_sale): ?>
                  <div class="prod-old">₹<?php echo e(number_format($product->price)); ?></div>
                <?php endif; ?>
              </div>
              <?php if($product->is_in_stock): ?>
                <form action="<?php echo e(route('cart.add')); ?>" method="POST">
                  <?php echo csrf_field(); ?>
                  <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                  <input type="hidden" name="qty" value="1">
                  <button type="submit" class="add-btn">+</button>
                </form>
              <?php else: ?>
                <button class="add-btn" disabled>✕</button>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="empty">
          <div class="empty-icon">🔍</div>
          <div class="empty-title">No products found</div>
          <div class="empty-sub">Try a different search or filter</div>
          <a href="<?php echo e(route('shop')); ?>" style="display:inline-block;margin-top:16px;background:var(--green);color:#fff;padding:10px 24px;border-radius:8px;font-weight:600;font-size:13px">Clear Filters</a>
        </div>
        <?php endif; ?>
      </div>

      <?php if($products->hasPages()): ?>
      <div class="pagination-wrap">
        <div class="pagination">
          <?php if($products->onFirstPage()): ?>
            <span class="page-item disabled">‹</span>
          <?php else: ?>
            <a href="<?php echo e($products->previousPageUrl()); ?>" class="page-item">‹</a>
          <?php endif; ?>
          <?php $__currentLoopData = $products->getUrlRange(max(1,$products->currentPage()-2), min($products->lastPage(),$products->currentPage()+2)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e($url); ?>" class="page-item <?php echo e($products->currentPage()==$page ? 'active':''); ?>"><?php echo e($page); ?></a>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php if($products->hasMorePages()): ?>
            <a href="<?php echo e($products->nextPageUrl()); ?>" class="page-item">›</a>
          <?php else: ?>
            <span class="page-item disabled">›</span>
          <?php endif; ?>
        </div>
      </div>
      <?php endif; ?>
    </div>

  </div>
</div>


<?php $__env->startPush('styles'); ?>
<style>
:root{--green:#16a34a;--green-dark:#15803d;--green-light:#dcfce7;--border:#e2e8f0}
.breadcrumb{background:#fff;border-bottom:1px solid var(--border);padding:10px 0}
.bc-inner{max-width:1280px;margin:0 auto;padding:0 20px;display:flex;align-items:center;gap:6px;font-size:13px;color:#9ca3af}
.bc-inner a{color:#16a34a;font-weight:500}
.wrap{max-width:1280px;margin:0 auto;padding:24px 20px}
.shop-layout{display:grid;grid-template-columns:240px 1fr;gap:24px;align-items:start}
.sidebar{background:#fff;border:1px solid var(--border);border-radius:12px;overflow:hidden;position:sticky;top:80px}
.sidebar-section{padding:18px 20px;border-bottom:1px solid #f1f5f9}
.sidebar-title{font-size:13px;font-weight:700;color:#374151;margin-bottom:14px}
.cat-item{display:flex;align-items:center;justify-content:space-between;padding:7px 10px;border-radius:7px;font-size:13px;color:#4b5563;transition:all .15s;text-decoration:none;margin-bottom:2px}
.cat-item:hover,.cat-item.active{background:var(--green-light);color:var(--green);font-weight:600}
.cat-count{background:#f1f5f9;color:#9ca3af;font-size:11px;padding:1px 7px;border-radius:10px;font-weight:600}
.price-range{display:flex;gap:8px;align-items:center}
.price-input{width:80px;padding:7px 10px;border:1.5px solid var(--border);border-radius:7px;font-size:13px;outline:none}
.filter-btn{width:100%;background:var(--green);color:#fff;border:none;padding:9px;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;margin-top:10px}
.clear-btn{width:100%;background:#f1f5f9;color:#64748b;border:none;padding:8px;border-radius:8px;font-size:13px;cursor:pointer;margin-top:6px}
.topbar-shop{display:flex;align-items:center;justify-content:space-between;margin-bottom:18px}
.results-info{font-size:13.5px;color:#64748b}
.sort-select{padding:8px 14px;border:1.5px solid var(--border);border-radius:8px;font-size:13px;outline:none;background:#fff}
.products-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px}
.prod-card{background:#fff;border:1.5px solid var(--border);border-radius:12px;overflow:hidden;transition:all .2s;position:relative}
.prod-card:hover{transform:translateY(-4px);box-shadow:0 12px 32px rgba(0,0,0,.10)}
.prod-badge{position:absolute;top:10px;left:10px;font-size:10.5px;font-weight:700;padding:3px 9px;border-radius:5px;z-index:2}
.badge-sale{background:#ef4444;color:#fff}.badge-new{background:var(--green);color:#fff}.badge-hot{background:#f97316;color:#fff}.out-badge{background:#94a3b8;color:#fff}
.prod-img{height:160px;background:#f8fafc;display:flex;align-items:center;justify-content:center;overflow:hidden;font-size:70px}
.prod-img img{width:100%;height:100%;object-fit:cover}
.prod-body{padding:13px}
.prod-cat{font-size:11px;color:var(--green);font-weight:600;text-transform:uppercase;margin-bottom:4px}
.prod-name{font-size:13.5px;font-weight:600;color:#1a1a2e;line-height:1.35;margin-bottom:3px}
.prod-weight{font-size:12px;color:#9ca3af;margin-bottom:8px}
.prod-footer{display:flex;align-items:center;justify-content:space-between}
.prod-price{font-size:18px;font-weight:800;color:var(--green)}
.prod-old{font-size:12px;color:#9ca3af;text-decoration:line-through}
.add-btn{width:34px;height:34px;background:var(--green);border:none;border-radius:8px;color:#fff;font-size:20px;display:flex;align-items:center;justify-content:center;cursor:pointer}
.add-btn:disabled{background:#e2e8f0;color:#9ca3af;cursor:not-allowed}
.empty{text-align:center;padding:64px 20px;grid-column:1/-1}
.pagination-wrap{margin-top:28px;display:flex;justify-content:center}
.pagination{display:flex;gap:4px}
.page-item{width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:13px;border:1.5px solid var(--border);color:#374151;background:#fff;text-decoration:none;transition:all .15s}
.page-item.active{background:var(--green);color:#fff;border-color:var(--green)}
.page-item.disabled{opacity:.45;pointer-events:none}
@media(max-width:768px){.shop-layout{grid-template-columns:1fr}.sidebar{display:none}.products-grid{grid-template-columns:repeat(2,1fr)}}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views/frontend/shop.blade.php ENDPATH**/ ?>