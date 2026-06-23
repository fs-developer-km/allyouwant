<?php $__env->startSection('title','Inventory'); ?><?php $__env->startSection('breadcrumb','Inventory'); ?>
<?php $__env->startSection('content'); ?>
<div class="page-header">
  <div><div class="page-title">📦 Inventory</div><div class="page-sub">Manage stock levels</div></div>
  <a href="<?php echo e(route('admin.inventory.low')); ?>" class="btn btn-danger">⚠️ Low Stock</a>
</div>
<div class="card">
  <div class="table-wrap" style="border:none">
    <table>
      <thead><tr><th>Product</th><th>Category</th><th>SKU</th><th>Stock</th><th>Alert At</th><th>Status</th><th>Update Stock</th></tr></thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td><div class="td-name"><?php echo e($p->name); ?></div><div class="td-sub"><?php echo e($p->unit); ?> · <?php echo e($p->weight); ?></div></td>
          <td><?php echo e($p->category->name ?? '—'); ?></td>
          <td><code style="font-size:12px"><?php echo e($p->sku ?? '—'); ?></code></td>
          <td>
            <?php if($p->stock_quantity == 0): ?> <span class="badge badge-danger">Out of Stock</span>
            <?php elseif($p->stock_quantity <= $p->low_stock_alert): ?> <span class="badge badge-warning">Low: <?php echo e($p->stock_quantity); ?></span>
            <?php else: ?> <span class="badge badge-success"><?php echo e($p->stock_quantity); ?></span>
            <?php endif; ?>
          </td>
          <td><?php echo e($p->low_stock_alert); ?></td>
          <td><span class="badge <?php echo e($p->is_active?'badge-success':'badge-secondary'); ?>"><?php echo e($p->is_active?'Active':'Off'); ?></span></td>
          <td>
            <form action="<?php echo e(route('admin.inventory.update',$p->id)); ?>" method="POST" style="display:flex;gap:8px;align-items:center">
              <?php echo csrf_field(); ?>
              <input type="number" name="stock_quantity" value="<?php echo e($p->stock_quantity); ?>" min="0" style="width:80px;padding:6px 8px;border:1px solid #d1d5db;border-radius:6px;font-size:13px">
              <button type="submit" class="btn btn-primary btn-sm">Save</button>
            </form>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="7" style="text-align:center;padding:40px;color:var(--text-muted)">No products found</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <?php if($products->hasPages()): ?><div class="card-footer"><?php echo e($products->links()); ?></div><?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views\admin\inventory\index.blade.php ENDPATH**/ ?>