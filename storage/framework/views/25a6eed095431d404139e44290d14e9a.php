<?php $__env->startSection('title','Banners'); ?><?php $__env->startSection('breadcrumb','Banners'); ?>
<?php $__env->startSection('content'); ?>
<div class="page-header">
  <div><div class="page-title">🖼️ Banners</div><div class="page-sub">Homepage slider banners</div></div>
  <div class="page-actions"><a href="<?php echo e(route('admin.banners.create')); ?>" class="btn btn-primary">+ Add Banner</a></div>
</div>
<div class="card">
  <div class="table-wrap" style="border:none">
    <table>
      <thead><tr><th>#</th><th>Banner</th><th>Button</th><th>Sort</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td><?php echo e($b->id); ?></td>
          <td>
            <div class="td-flex">
              <?php if($b->image): ?><img src="<?php echo e(asset('storage/'.$b->image)); ?>" style="width:80px;height:44px;object-fit:cover;border-radius:6px">
              <?php else: ?><div class="td-img">🖼️</div><?php endif; ?>
              <div><div class="td-name"><?php echo e($b->title); ?></div><div class="td-sub"><?php echo e($b->subtitle); ?></div></div>
            </div>
          </td>
          <td><?php echo e($b->button_text); ?> → <?php echo e($b->button_link); ?></td>
          <td><?php echo e($b->sort_order); ?></td>
          <td><span class="badge <?php echo e($b->is_active ? 'badge-success' : 'badge-secondary'); ?>"><?php echo e($b->is_active ? 'Active' : 'Inactive'); ?></span></td>
          <td>
            <div class="td-actions">
              <a href="<?php echo e(route('admin.banners.edit',$b->id)); ?>" class="btn btn-secondary btn-sm">✏️ Edit</a>
              <form action="<?php echo e(route('admin.banners.destroy',$b->id)); ?>" method="POST" onsubmit="return confirm('Delete?')"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="btn btn-danger btn-sm">🗑️</button></form>
            </div>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="6" style="text-align:center;padding:40px;color:var(--text-muted)"><div style="font-size:36px;margin-bottom:10px">🖼️</div>No banners yet<br><a href="<?php echo e(route('admin.banners.create')); ?>" class="btn btn-primary" style="margin-top:12px;display:inline-flex">+ Add Banner</a></td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views\admin\banners\index.blade.php ENDPATH**/ ?>