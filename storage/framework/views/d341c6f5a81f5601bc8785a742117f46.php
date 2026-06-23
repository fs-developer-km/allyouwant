<?php $__env->startSection('title','Reviews'); ?><?php $__env->startSection('breadcrumb','Reviews'); ?>
<?php $__env->startSection('content'); ?>
<div class="page-header"><div><div class="page-title">⭐ Reviews</div></div></div>
<div class="card">
  <div class="table-wrap" style="border:none">
    <table>
      <thead><tr><th>Product</th><th>Customer</th><th>Rating</th><th>Review</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td><?php echo e($r->product->name ?? '—'); ?></td>
          <td><?php echo e($r->user->name ?? '—'); ?></td>
          <td style="color:#f59e0b"><?php echo e(str_repeat('★',$r->rating)); ?></td>
          <td style="max-width:200px"><?php echo e(Str::limit($r->body,60)); ?></td>
          <td><span class="badge <?php echo e($r->is_approved ? 'badge-success' : 'badge-warning'); ?>"><?php echo e($r->is_approved ? 'Approved' : 'Pending'); ?></span></td>
          <td>
            <form action="<?php echo e(route('admin.reviews.approve',$r->id)); ?>" method="POST" style="display:inline"><?php echo csrf_field(); ?><button type="submit" class="btn btn-secondary btn-sm"><?php echo e($r->is_approved ? 'Unapprove' : 'Approve'); ?></button></form>
            <form action="<?php echo e(route('admin.reviews.destroy',$r->id)); ?>" method="POST" style="display:inline" onsubmit="return confirm('Delete?')"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button type="submit" class="btn btn-danger btn-sm">Delete</button></form>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="6" style="text-align:center;padding:40px;color:var(--text-muted)">No reviews yet</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views\admin\reviews\index.blade.php ENDPATH**/ ?>