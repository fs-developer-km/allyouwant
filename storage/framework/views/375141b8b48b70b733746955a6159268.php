<?php $__env->startSection('title','Low Stock'); ?><?php $__env->startSection('breadcrumb','Low Stock'); ?>
<?php $__env->startSection('content'); ?>
<div class="page-header">
  <div><div class="page-title">⚠️ Low Stock Items</div><div class="page-sub"><?php echo e($products->total()); ?> products need restocking</div></div>
  <a href="<?php echo e(route('admin.inventory.index')); ?>" class="btn btn-secondary">← All Inventory</a>
</div>
<div class="card">
  <div class="table-wrap" style="border:none">
    <table>
      <thead><tr><th>Product</th><th>Category</th><th>Current Stock</th><th>Alert Level</th><th>Update Stock</th></tr></thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr style="background:#fffbeb">
          <td><div class="td-name"><?php echo e($p->name); ?></div></td>
          <td><?php echo e($p->category->name ?? '—'); ?></td>
          <td><span class="badge <?php echo e($p->stock_quantity==0?'badge-danger':'badge-warning'); ?>"><?php echo e($p->stock_quantity == 0 ? 'OUT' : $p->stock_quantity); ?></span></td>
          <td><?php echo e($p->low_stock_alert); ?></td>
          <td>
            <form action="<?php echo e(route('admin.inventory.update',$p->id)); ?>" method="POST" style="display:flex;gap:8px">
              <?php echo csrf_field(); ?>
              <input type="number" name="stock_quantity" value="<?php echo e($p->stock_quantity); ?>" min="0" style="width:80px;padding:6px;border:1px solid #d1d5db;border-radius:6px;font-size:13px">
              <button type="submit" class="btn btn-primary btn-sm">Update</button>
            </form>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="5" style="text-align:center;padding:40px;color:var(--text-muted)">✅ All products have sufficient stock!</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views/admin/inventory/low.blade.php ENDPATH**/ ?>