<?php $__env->startSection('title','Customers'); ?><?php $__env->startSection('breadcrumb','Customers'); ?>
<?php $__env->startSection('content'); ?>
<div class="page-header"><div><div class="page-title">👥 Customers</div><div class="page-sub"><?php echo e($customers->total()); ?> total customers</div></div></div>
<div class="card">
  <div class="table-wrap" style="border:none">
    <table>
      <thead><tr><th>#</th><th>Name</th><th>Email</th><th>Phone</th><th>Orders</th><th>Joined</th></tr></thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td><?php echo e($c->id); ?></td>
          <td><strong><?php echo e($c->name); ?></strong></td>
          <td><?php echo e($c->email); ?></td>
          <td><?php echo e($c->phone ?? '—'); ?></td>
          <td><span class="badge badge-info"><?php echo e($c->orders->count()); ?></span></td>
          <td style="color:var(--text-muted)"><?php echo e($c->created_at->format('d M Y')); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="6" style="text-align:center;padding:40px;color:var(--text-muted)">No customers yet</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <?php if($customers->hasPages()): ?><div class="card-footer"><?php echo e($customers->links()); ?></div><?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views/admin/customers/index.blade.php ENDPATH**/ ?>