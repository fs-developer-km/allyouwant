<?php $__env->startSection('title','Settings'); ?><?php $__env->startSection('breadcrumb','General Settings'); ?>
<?php $__env->startSection('content'); ?>
<div class="page-header"><div><div class="page-title">⚙️ General Settings</div></div></div>
<div class="card" style="max-width:600px">
  <form action="<?php echo e(route('admin.settings.general.update')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div class="card-header"><div class="card-title">Site Information</div></div>
    <div class="card-body">
      <?php $__currentLoopData = ['site_name'=>'Site Name','site_tagline'=>'Tagline','site_email'=>'Email','site_phone'=>'Phone','site_address'=>'Address','whatsapp_number'=>'WhatsApp Number']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="form-group" style="margin-bottom:14px">
        <label class="form-label"><?php echo e($label); ?></label>
        <input type="text" name="<?php echo e($key); ?>" class="form-control" value="<?php echo e($settings[$key] ?? ''); ?>">
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <button type="submit" class="btn btn-primary">💾 Save Settings</button>
    </div>
  </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views/admin/settings/general.blade.php ENDPATH**/ ?>