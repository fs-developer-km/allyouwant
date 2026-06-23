

<?php $__env->startSection('title', 'Shop'); ?>



<?php $__env->startSection('content'); ?>
<div class="wrap" style="max-width:1280px;margin:0 auto;padding:24px 20px">

  
  <div style="margin-bottom:20px">
    <h2 style="font-size:20px;font-weight:700;color:#1a1a2e">
      Search Results
      <?php if($q): ?>
        for "<span style="color:#16a34a"><?php echo e($q); ?></span>"
      <?php endif; ?>
    </h2>
    <p style="color:#9ca3af;font-size:13px;margin-top:4px">
      <?php echo e($products->total()); ?> products found
    </p>
  </div>

  
  <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px">
    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div style="background:#fff;border:1.5px solid #e2e8f0;border-radius:12px;overflow:hidden">
      <a href="<?php echo e(route('product.show', $product->slug)); ?>">
        <div style="height:160px;background:#f8fafc;display:flex;align-items:center;justify-content:center;font-size:60px">
          <?php if($product->thumbnail): ?>
            <img src="<?php echo e(asset('storage/'.$product->thumbnail)); ?>" alt="<?php echo e($product->name); ?>"
              style="width:100%;height:100%;object-fit:cover">
          <?php else: ?>
            🛒
          <?php endif; ?>
        </div>
      </a>
      <div style="padding:13px">
        <div style="font-size:11px;color:#16a34a;font-weight:600;margin-bottom:4px">
          <?php echo e($product->category->name ?? ''); ?>

        </div>
        <a href="<?php echo e(route('product.show', $product->slug)); ?>" style="text-decoration:none;color:#1a1a2e;font-size:13.5px;font-weight:600">
          <?php echo e($product->name); ?>

        </a>
        <div style="display:flex;align-items:center;justify-content:space-between;margin-top:10px">
          <div>
            <div style="font-size:18px;font-weight:800;color:#16a34a">
              ₹<?php echo e(number_format($product->sale_price ?? $product->price)); ?>

            </div>
            <?php if($product->sale_price): ?>
              <div style="font-size:12px;color:#9ca3af;text-decoration:line-through">
                ₹<?php echo e(number_format($product->price)); ?>

              </div>
            <?php endif; ?>
          </div>
          <form action="<?php echo e(route('cart.add')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
            <input type="hidden" name="qty" value="1">
            <button type="submit"
              style="width:34px;height:34px;background:#16a34a;border:none;border-radius:8px;color:#fff;font-size:20px;cursor:pointer">
              +
            </button>
          </form>
        </div>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div style="text-align:center;padding:64px 20px;grid-column:1/-1">
      <div style="font-size:56px;margin-bottom:16px">🔍</div>
      <div style="font-size:18px;font-weight:600;color:#374151">No products found</div>
      <div style="font-size:14px;color:#9ca3af;margin-top:6px">Try a different keyword</div>
      <a href="<?php echo e(route('shop')); ?>"
        style="display:inline-block;margin-top:16px;background:#16a34a;color:#fff;padding:10px 24px;border-radius:8px;font-weight:600;font-size:13px">
        Browse All Products
      </a>
    </div>
    <?php endif; ?>
  </div>

  
  <?php if($products->hasPages()): ?>
  <div style="margin-top:28px;display:flex;justify-content:center;gap:4px">
    <?php if(!$products->onFirstPage()): ?>
      <a href="<?php echo e($products->previousPageUrl()); ?>"
        style="width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center;border:1.5px solid #e2e8f0;color:#374151;text-decoration:none">‹</a>
    <?php endif; ?>
    <?php $__currentLoopData = $products->getUrlRange(1, $products->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <a href="<?php echo e($url); ?>"
        style="width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center;border:1.5px solid <?php echo e($products->currentPage()==$page ? '#16a34a' : '#e2e8f0'); ?>;background:<?php echo e($products->currentPage()==$page ? '#16a34a' : '#fff'); ?>;color:<?php echo e($products->currentPage()==$page ? '#fff' : '#374151'); ?>;text-decoration:none;font-size:13px;font-weight:500">
        <?php echo e($page); ?>

      </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php if($products->hasMorePages()): ?>
      <a href="<?php echo e($products->nextPageUrl()); ?>"
        style="width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center;border:1.5px solid #e2e8f0;color:#374151;text-decoration:none">›</a>
    <?php endif; ?>
  </div>
  <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views\frontend\search.blade.php ENDPATH**/ ?>