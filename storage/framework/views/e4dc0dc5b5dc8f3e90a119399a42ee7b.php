<?php $__env->startSection('title', isset($coupon)?'Edit Coupon':'Add Coupon'); ?>
<?php $__env->startSection('breadcrumb', isset($coupon)?'Edit Coupon':'Add Coupon'); ?>
<?php $__env->startSection('content'); ?>
<div class="page-header">
  <div><div class="page-title"><?php echo e(isset($coupon)?'✏️ Edit Coupon':'➕ Add Coupon'); ?></div></div>
  <a href="<?php echo e(route('admin.coupons.index')); ?>" class="btn btn-secondary">← Back</a>
</div>
<form action="<?php echo e(isset($coupon)?route('admin.coupons.update',$coupon->id):route('admin.coupons.store')); ?>" method="POST" style="max-width:600px">
  <?php echo csrf_field(); ?> <?php if(isset($coupon)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>
  <div class="card">
    <div class="card-body">
      <div class="form-grid">
        <div class="form-group">
          <label class="form-label">Coupon Code <span>*</span></label>
          <input type="text" name="code" class="form-control" value="<?php echo e(old('code',$coupon->code??'')); ?>" placeholder="e.g. SAVE20" required style="text-transform:uppercase">
        </div>
        <div class="form-group">
          <label class="form-label">Description</label>
          <input type="text" name="description" class="form-control" value="<?php echo e(old('description',$coupon->description??'')); ?>">
        </div>
        <div class="form-group">
          <label class="form-label">Discount Type <span>*</span></label>
          <select name="type" class="form-control" required>
            <option value="percent" <?php echo e(old('type',$coupon->type??'')=='percent'?'selected':''); ?>>Percentage (%)</option>
            <option value="fixed"   <?php echo e(old('type',$coupon->type??'')=='fixed'?'selected':''); ?>>Fixed Amount (₹)</option>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label">Discount Value <span>*</span></label>
          <input type="number" name="value" class="form-control" value="<?php echo e(old('value',$coupon->value??'')); ?>" min="0" step="0.01" required>
        </div>
        <div class="form-group">
          <label class="form-label">Min Order Amount (₹)</label>
          <input type="number" name="min_order_amount" class="form-control" value="<?php echo e(old('min_order_amount',$coupon->min_order_amount??0)); ?>" min="0">
        </div>
        <div class="form-group">
          <label class="form-label">Max Discount (₹)</label>
          <input type="number" name="max_discount" class="form-control" value="<?php echo e(old('max_discount',$coupon->max_discount??'')); ?>" min="0">
          <div class="form-hint">For % type — cap the max discount</div>
        </div>
        <div class="form-group">
          <label class="form-label">Usage Limit (total)</label>
          <input type="number" name="usage_limit" class="form-control" value="<?php echo e(old('usage_limit',$coupon->usage_limit??'')); ?>" min="0">
        </div>
        <div class="form-group">
          <label class="form-label">Per User Limit</label>
          <input type="number" name="per_user_limit" class="form-control" value="<?php echo e(old('per_user_limit',$coupon->per_user_limit??1)); ?>" min="1">
        </div>
        <div class="form-group">
          <label class="form-label">Start Date</label>
          <input type="date" name="start_date" class="form-control" value="<?php echo e(old('start_date',$coupon->start_date??'')); ?>">
        </div>
        <div class="form-group">
          <label class="form-label">End Date</label>
          <input type="date" name="end_date" class="form-control" value="<?php echo e(old('end_date',$coupon->end_date??'')); ?>">
        </div>
        <div class="form-group form-full">
          <div class="toggle-wrap">
            <label class="toggle"><input type="checkbox" name="is_active" <?php echo e(old('is_active',$coupon->is_active??true)?'checked':''); ?>><span class="toggle-slider"></span></label>
            <span class="toggle-label">Active coupon</span>
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-primary" style="margin-top:8px"><?php echo e(isset($coupon)?'💾 Update':'✅ Create Coupon'); ?></button>
    </div>
  </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views\admin\coupons\edit.blade.php ENDPATH**/ ?>