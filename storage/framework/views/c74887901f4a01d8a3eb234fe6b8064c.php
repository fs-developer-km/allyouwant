<?php $__env->startSection('title', isset($banner) ? 'Edit Banner' : 'Add Banner'); ?>
<?php $__env->startSection('breadcrumb', isset($banner) ? 'Edit Banner' : 'Add Banner'); ?>
<?php $__env->startSection('content'); ?>
<div class="page-header">
  <div><div class="page-title"><?php echo e(isset($banner) ? '✏️ Edit Banner' : '➕ Add Banner'); ?></div></div>
  <div class="page-actions"><a href="<?php echo e(route('admin.banners.index')); ?>" class="btn btn-secondary">← Back</a></div>
</div>
<form action="<?php echo e(isset($banner) ? route('admin.banners.update',$banner->id) : route('admin.banners.store')); ?>" method="POST" enctype="multipart/form-data" style="max-width:700px">
  <?php echo csrf_field(); ?> <?php if(isset($banner)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>
  <div class="card">
    <div class="card-body">
      <div class="form-grid">
        <div class="form-group form-full">
          <label class="form-label">Title <span>*</span></label>
          <input type="text" name="title" class="form-control" value="<?php echo e(old('title',$banner->title??'')); ?>" required>
        </div>
        <div class="form-group form-full">
          <label class="form-label">Subtitle</label>
          <input type="text" name="subtitle" class="form-control" value="<?php echo e(old('subtitle',$banner->subtitle??'')); ?>">
        </div>
        <div class="form-group">
          <label class="form-label">Button Text</label>
          <input type="text" name="button_text" class="form-control" value="<?php echo e(old('button_text',$banner->button_text??'Shop Now')); ?>">
        </div>
        <div class="form-group">
          <label class="form-label">Button Link</label>
          <input type="text" name="button_link" class="form-control" value="<?php echo e(old('button_link',$banner->button_link??'/shop')); ?>">
        </div>
        <div class="form-group">
          <label class="form-label">Badge Text (e.g. "20% OFF")</label>
          <input type="text" name="badge_text" class="form-control" value="<?php echo e(old('badge_text',$banner->badge_text??'')); ?>">
        </div>
        <div class="form-group">
          <label class="form-label">Sort Order</label>
          <input type="number" name="sort_order" class="form-control" value="<?php echo e(old('sort_order',$banner->sort_order??0)); ?>" min="0">
        </div>
        <div class="form-group form-full">
          <label class="form-label">Banner Image</label>
          <?php if(isset($banner) && $banner->image): ?>
            <img src="<?php echo e(asset('storage/'.$banner->image)); ?>" style="width:200px;border-radius:8px;margin-bottom:10px;display:block">
          <?php endif; ?>
          <input type="file" name="image" class="form-control" accept="image/*">
          <div class="form-hint">Recommended: 1200×450px, JPG/PNG</div>
        </div>
        <div class="form-group form-full">
          <div class="toggle-wrap">
            <label class="toggle"><input type="checkbox" name="is_active" <?php echo e(old('is_active', $banner->is_active??true) ? 'checked' : ''); ?>><span class="toggle-slider"></span></label>
            <span class="toggle-label">Active — show on homepage</span>
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-primary" style="margin-top:8px"><?php echo e(isset($banner) ? '💾 Update Banner' : '✅ Create Banner'); ?></button>
    </div>
  </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views\admin\banners\create.blade.php ENDPATH**/ ?>