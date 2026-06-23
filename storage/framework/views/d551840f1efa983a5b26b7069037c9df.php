<?php $__env->startSection('title','Delivery Settings'); ?><?php $__env->startSection('breadcrumb','Delivery Settings'); ?>
<?php $__env->startSection('content'); ?>
<div class="page-header"><div><div class="page-title">🚚 Delivery Settings</div></div></div>
<div class="card" style="max-width:500px">
  <form action="<?php echo e(route('admin.settings.delivery.update')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div class="card-body">
      <div class="form-group" style="margin-bottom:14px">
        <label class="form-label">Free Delivery Above (₹)</label>
        <input type="number" name="free_delivery_above" class="form-control" value="<?php echo e($settings['free_delivery_above'] ?? 499); ?>">
      </div>
      <div class="form-group" style="margin-bottom:14px">
        <label class="form-label">Delivery Charge (₹)</label>
        <input type="number" name="delivery_charge" class="form-control" value="<?php echo e($settings['delivery_charge'] ?? 40); ?>">
      </div>
      <button type="submit" class="btn btn-primary">💾 Save</button>
    </div>
  </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views\admin\settings\delivery.blade.php ENDPATH**/ ?>