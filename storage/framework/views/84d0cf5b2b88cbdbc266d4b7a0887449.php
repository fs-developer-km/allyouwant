<?php $__env->startSection('title','Product Report'); ?><?php $__env->startSection('breadcrumb','Product Report'); ?>
<?php $__env->startSection('content'); ?>
<div class="page-header"><div><div class="page-title">📦 Product Report</div></div></div>
<div class="card">
  <div class="table-wrap" style="border:none">
    <table>
      <thead><tr><th>Product</th><th>Category</th><th>Price</th><th>Stock</th><th>Orders</th><th>Revenue</th></tr></thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td><strong><?php echo e($p->name); ?></strong></td>
          <td><?php echo e($p->category->name ?? '—'); ?></td>
          <td>₹<?php echo e(number_format($p->current_price)); ?></td>
          <td><span class="badge <?php echo e($p->stock_quantity > 10 ? 'badge-success' : 'badge-warning'); ?>"><?php echo e($p->stock_quantity); ?></span></td>
          <td><?php echo e($p->order_items_count ?? 0); ?></td>
          <td><strong style="color:var(--green)">₹<?php echo e(number_format($p->order_items_sum_subtotal ?? 0)); ?></strong></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="6" style="text-align:center;padding:40px;color:var(--text-muted)">No data</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views\admin\reports\products.blade.php ENDPATH**/ ?>