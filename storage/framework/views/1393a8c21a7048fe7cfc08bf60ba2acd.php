<?php $__env->startSection('title','Coupons'); ?><?php $__env->startSection('breadcrumb','Coupons'); ?>
<?php $__env->startSection('content'); ?>
<div class="page-header">
  <div><div class="page-title">🎟️ Coupons</div><div class="page-sub"><?php echo e($coupons->total()); ?> total coupons</div></div>
  <div class="page-actions"><a href="<?php echo e(route('admin.coupons.create')); ?>" class="btn btn-primary">+ Add Coupon</a></div>
</div>
<div class="card">
  <div class="table-wrap" style="border:none">
    <table>
      <thead><tr><th>Code</th><th>Type</th><th>Value</th><th>Min Order</th><th>Used</th><th>Expiry</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td><strong style="font-family:monospace;font-size:14px;color:var(--green)"><?php echo e($c->code); ?></strong><div class="td-sub"><?php echo e($c->description); ?></div></td>
          <td><span class="badge badge-info"><?php echo e(ucfirst($c->type)); ?></span></td>
          <td><strong><?php echo e($c->type==='percent' ? $c->value.'%' : '₹'.$c->value); ?></strong></td>
          <td>₹<?php echo e(number_format($c->min_order_amount)); ?></td>
          <td><?php echo e($c->used_count); ?><?php echo e($c->usage_limit ? '/'.$c->usage_limit : ''); ?></td>
          <td style="font-size:12px;color:var(--text-muted)"><?php echo e($c->end_date ? $c->end_date->format('d M Y') : '—'); ?></td>
          <td><span class="badge <?php echo e($c->is_active ? 'badge-success':'badge-secondary'); ?>"><?php echo e($c->is_active?'Active':'Off'); ?></span></td>
          <td>
            <div class="td-actions">
              <a href="<?php echo e(route('admin.coupons.edit',$c->id)); ?>" class="btn btn-secondary btn-sm">✏️</a>
              <form action="<?php echo e(route('admin.coupons.destroy',$c->id)); ?>" method="POST" onsubmit="return confirm('Delete?')"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="btn btn-danger btn-sm">🗑️</button></form>
            </div>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="8" style="text-align:center;padding:40px;color:var(--text-muted)">No coupons yet<br><a href="<?php echo e(route('admin.coupons.create')); ?>" class="btn btn-primary" style="margin-top:12px;display:inline-flex">+ Add Coupon</a></td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <?php if($coupons->hasPages()): ?><div class="card-footer"><?php echo e($coupons->links()); ?></div><?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views/admin/coupons/index.blade.php ENDPATH**/ ?>