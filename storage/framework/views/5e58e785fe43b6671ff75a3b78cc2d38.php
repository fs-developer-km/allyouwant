<?php $__env->startSection('title','Sales Report'); ?><?php $__env->startSection('breadcrumb','Sales Report'); ?>
<?php $__env->startSection('content'); ?>
<div class="page-header"><div><div class="page-title">📈 Sales Report</div><div class="page-sub">Total revenue: ₹<?php echo e(number_format($total)); ?></div></div></div>
<div class="card">
  <div class="table-wrap" style="border:none">
    <table>
      <thead><tr><th>Order #</th><th>Customer</th><th>Total</th><th>Date</th><th>Status</th></tr></thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td><strong style="color:var(--green)">#<?php echo e($order->order_number); ?></strong></td>
          <td><?php echo e($order->user->name ?? 'N/A'); ?></td>
          <td><strong>₹<?php echo e(number_format($order->total)); ?></strong></td>
          <td><?php echo e($order->created_at->format('d M Y')); ?></td>
          <td><span class="badge badge-success">Delivered</span></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="5" style="text-align:center;padding:40px;color:var(--text-muted)">No delivered orders yet</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views\admin\reports\sales.blade.php ENDPATH**/ ?>