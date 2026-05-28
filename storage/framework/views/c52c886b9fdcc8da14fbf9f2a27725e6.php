

<?php $__env->startSection('content'); ?>

<div class="container">
    <h1><?php echo e($product->name); ?></h1>
    <p><?php echo e($product->description); ?></p>
    <p>Price: ₹<?php echo e($product->sale_price ?? $product->price); ?></p>

    
    <?php if($related->count()): ?>
    <h3>Related Products</h3>
    <?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <p><?php echo e($item->name); ?></p>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views/frontend/products/product.blade.php ENDPATH**/ ?>