

<?php $__env->startSection('title','Products'); ?>
<?php $__env->startSection('breadcrumb','Products'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
  <div>
    <div class="page-title">🛒 Products</div>
    <div class="page-sub">Manage all products (<?php echo e($products->total()); ?> total)</div>
  </div>
  <div class="page-actions">
    <a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-primary">+ Add Product</a>
  </div>
</div>


<div class="filters-bar">
  <form method="GET" action="<?php echo e(route('admin.products.index')); ?>" style="display:flex;gap:10px;flex-wrap:wrap;width:100%">
    <div class="search-filter" style="max-width:280px">
      🔍
      <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search name or SKU...">
    </div>
    <select name="category" class="filter-select" onchange="this.form.submit()">
      <option value="">All Categories</option>
      <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($cat->id); ?>" <?php echo e(request('category') == $cat->id ? 'selected' : ''); ?>>
          <?php echo e($cat->name); ?>

        </option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <select name="status" class="filter-select" onchange="this.form.submit()">
      <option value="">All Status</option>
      <option value="1" <?php echo e(request('status')==='1' ? 'selected' : ''); ?>>Active</option>
      <option value="0" <?php echo e(request('status')==='0' ? 'selected' : ''); ?>>Inactive</option>
    </select>
    <select name="stock" class="filter-select" onchange="this.form.submit()">
      <option value="">All Stock</option>
      <option value="low" <?php echo e(request('stock')==='low' ? 'selected' : ''); ?>>Low Stock</option>
      <option value="out" <?php echo e(request('stock')==='out' ? 'selected' : ''); ?>>Out of Stock</option>
    </select>
    <button type="submit" class="btn btn-secondary">Filter</button>
    <a href="<?php echo e(route('admin.products.index')); ?>" class="btn btn-secondary">Reset</a>
  </form>
</div>


<div class="card">
  <div class="table-wrap" style="border:none">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Product</th>
          <th>Category</th>
          <th>Price</th>
          <th>Stock</th>
          <th>Sales</th>
          <th>Badges</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td style="color:var(--text-muted)"><?php echo e($product->id); ?></td>

          <td>
            <div class="td-flex">
              <?php if($product->thumbnail): ?>
                <img src="<?php echo e(asset('storage/'.$product->thumbnail)); ?>"
                  class="td-img" alt="<?php echo e($product->name); ?>" style="object-fit:cover">
              <?php else: ?>
                <div class="td-img">🛒</div>
              <?php endif; ?>
              <div>
                <div class="td-name"><?php echo e($product->name); ?></div>
                <div class="td-sub">SKU: <?php echo e($product->sku ?? '—'); ?> · <?php echo e($product->unit); ?></div>
              </div>
            </div>
          </td>

          <td>
            <span class="badge badge-info"><?php echo e($product->category->name ?? '—'); ?></span>
          </td>

          <td>
            <div style="font-weight:700;color:var(--green)">₹<?php echo e(number_format($product->current_price)); ?></div>
            <?php if($product->is_on_sale): ?>
              <div style="font-size:12px;color:var(--text-muted);text-decoration:line-through">₹<?php echo e(number_format($product->price)); ?></div>
              <div style="font-size:11px;font-weight:600;color:#dc2626"><?php echo e($product->discount_percent); ?>% OFF</div>
            <?php endif; ?>
          </td>

          <td>
            <?php if($product->stock_quantity == 0): ?>
              <span class="badge badge-danger">Out of Stock</span>
            <?php elseif($product->stock_quantity <= $product->low_stock_alert): ?>
              <span class="badge badge-warning">Low: <?php echo e($product->stock_quantity); ?></span>
            <?php else: ?>
              <span class="badge badge-success"><?php echo e($product->stock_quantity); ?></span>
            <?php endif; ?>
          </td>

          <td style="color:var(--text-muted)">
            <?php echo e($product->order_items_count ?? 0); ?> sold
          </td>

          <td>
            <div style="display:flex;gap:4px;flex-wrap:wrap">
              <?php if($product->is_featured): ?>   <span class="badge badge-purple">⭐ Featured</span>  <?php endif; ?>
              <?php if($product->is_bestseller): ?> <span class="badge badge-warning">🔥 Best</span>     <?php endif; ?>
              <?php if($product->is_new_arrival): ?><span class="badge badge-info">✨ New</span>          <?php endif; ?>
            </div>
          </td>

          <td>
            <label class="toggle-wrap" style="cursor:pointer">
              <div class="toggle">
                <input type="checkbox"
                  <?php echo e($product->is_active ? 'checked' : ''); ?>

                  onchange="toggleStatus(<?php echo e($product->id); ?>, this)">
                <span class="toggle-slider"></span>
              </div>
              <span style="font-size:12px;color:var(--text-muted)" id="plbl-<?php echo e($product->id); ?>">
                <?php echo e($product->is_active ? 'On' : 'Off'); ?>

              </span>
            </label>
          </td>

          <td>
            <div class="td-actions">
              <a href="<?php echo e(route('admin.products.edit', $product->id)); ?>"
                class="btn btn-secondary btn-sm btn-icon" title="Edit">✏️</a>
              <a href="<?php echo e(route('product.show', $product->slug)); ?>" target="_blank"
                class="btn btn-secondary btn-sm btn-icon" title="View on site">👁</a>
              <form action="<?php echo e(route('admin.products.destroy', $product->id)); ?>"
                method="POST" onsubmit="return confirmDelete(this)">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-danger btn-sm btn-icon" title="Delete">🗑️</button>
              </form>
            </div>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
          <td colspan="9" style="text-align:center;padding:48px;color:var(--text-muted)">
            <div style="font-size:36px;margin-bottom:10px">🛒</div>
            <div style="font-size:15px;font-weight:500;margin-bottom:6px">No products yet</div>
            <a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-primary" style="margin-top:8px">+ Add First Product</a>
          </td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <?php if($products->hasPages()): ?>
  <div class="card-footer" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px">
    <div style="font-size:13px;color:var(--text-muted)">
      Showing <?php echo e($products->firstItem()); ?>–<?php echo e($products->lastItem()); ?> of <?php echo e($products->total()); ?>

    </div>
    <div class="pagination">
      <?php if($products->onFirstPage()): ?>
        <div class="page-item disabled">‹</div>
      <?php else: ?>
        <a href="<?php echo e($products->previousPageUrl()); ?>" class="page-item">‹</a>
      <?php endif; ?>
      <?php $__currentLoopData = $products->getUrlRange(1, $products->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e($url); ?>" class="page-item <?php echo e($products->currentPage() == $page ? 'active' : ''); ?>"><?php echo e($page); ?></a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php if($products->hasMorePages()): ?>
        <a href="<?php echo e($products->nextPageUrl()); ?>" class="page-item">›</a>
      <?php else: ?>
        <div class="page-item disabled">›</div>
      <?php endif; ?>
    </div>
  </div>
  <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function toggleStatus(id, checkbox) {
  fetch(`/admin/products/${id}/toggle`, {
    method: 'POST',
    headers: { 'X-CSRF-TOKEN': csrfToken },
  })
  .then(r => r.json())
  .then(d => {
    document.getElementById('plbl-' + id).textContent = d.status ? 'On' : 'Off';
    showToast(d.message, 'success');
  })
  .catch(() => { checkbox.checked = !checkbox.checked; showToast('Error occurred', 'error'); });
}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views\admin\products\index.blade.php ENDPATH**/ ?>