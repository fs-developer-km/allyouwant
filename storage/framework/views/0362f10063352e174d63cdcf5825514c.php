<?php $__env->startSection('title','Categories'); ?>
<?php $__env->startSection('breadcrumb','Categories'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
  <div>
    <div class="page-title">🗂️ Categories</div>
    <div class="page-sub">Manage product categories (<?php echo e($categories->total()); ?> total)</div>
  </div>
  <div class="page-actions">
    <a href="<?php echo e(route('admin.categories.create')); ?>" class="btn btn-primary">+ Add Category</a>
  </div>
</div>


<div class="filters-bar">
  <form method="GET" action="<?php echo e(route('admin.categories.index')); ?>" style="display:flex;gap:10px;flex-wrap:wrap;width:100%">
    <div class="search-filter">
      🔍
      <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search categories...">
    </div>
    <select name="status" class="filter-select" onchange="this.form.submit()">
      <option value="">All Status</option>
      <option value="1" <?php echo e(request('status')==='1' ? 'selected' : ''); ?>>Active</option>
      <option value="0" <?php echo e(request('status')==='0' ? 'selected' : ''); ?>>Inactive</option>
    </select>
    <button type="submit" class="btn btn-secondary">Filter</button>
    <a href="<?php echo e(route('admin.categories.index')); ?>" class="btn btn-secondary">Reset</a>
  </form>
</div>


<div class="card">
  <div class="table-wrap" style="border:none">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Category</th>
          <th>Slug</th>
          <th>Parent</th>
          <th>Products</th>
          <th>Homepage</th>
          <th>Status</th>
          <th>Sort</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr id="cat-row-<?php echo e($cat->id); ?>">
          <td style="color:var(--text-muted)"><?php echo e($cat->id); ?></td>
          <td>
            <div class="td-flex">
              <?php if($cat->image): ?>
                <img src="<?php echo e(asset('storage/'.$cat->image)); ?>" alt="" class="td-img">
              <?php else: ?>
                <div class="td-img">🗂️</div>
              <?php endif; ?>
              <div>
                <div class="td-name"><?php echo e($cat->name); ?></div>
                <?php if($cat->description): ?>
                  <div class="td-sub"><?php echo e(Str::limit($cat->description, 40)); ?></div>
                <?php endif; ?>
              </div>
            </div>
          </td>
          <td><code style="font-size:12px;background:#f1f5f9;padding:2px 6px;border-radius:4px"><?php echo e($cat->slug); ?></code></td>
           <td>
  <?php if($cat->parent?->name): ?>
    <?php echo e($cat->parent->name); ?>

  <?php else: ?>
    <span style="color:var(--text-muted)">—</span>
  <?php endif; ?>
</td>
          <td>
            <a href="<?php echo e(route('admin.products.index')); ?>?category=<?php echo e($cat->id); ?>" class="badge badge-info" style="text-decoration:none">
              <?php echo e($cat->products_count); ?>

            </a>
          </td>
          <td>
            <?php if($cat->show_on_homepage): ?>
              <span class="badge badge-success">Yes</span>
            <?php else: ?>
              <span class="badge badge-secondary">No</span>
            <?php endif; ?>
          </td>
          <td>
            <label class="toggle-wrap" style="cursor:pointer">
              <div class="toggle">
                <input type="checkbox"
                  <?php echo e($cat->is_active ? 'checked' : ''); ?>

                  onchange="toggleStatus(<?php echo e($cat->id); ?>, this)">
                <span class="toggle-slider"></span>
              </div>
              <span class="toggle-label" id="status-lbl-<?php echo e($cat->id); ?>">
                <?php echo e($cat->is_active ? 'Active' : 'Inactive'); ?>

              </span>
            </label>
          </td>
          <td><?php echo e($cat->sort_order); ?></td>
          <td>
            <div class="td-actions">
              <a href="<?php echo e(route('admin.categories.edit', $cat->id)); ?>"
                class="btn btn-secondary btn-sm btn-icon" title="Edit">✏️</a>
              <form action="<?php echo e(route('admin.categories.destroy', $cat->id)); ?>"
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
            <div style="font-size:36px;margin-bottom:10px">🗂️</div>
            <div style="font-size:15px;font-weight:500;margin-bottom:6px">No categories yet</div>
            <a href="<?php echo e(route('admin.categories.create')); ?>" class="btn btn-primary" style="margin-top:8px">+ Add First Category</a>
          </td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <?php if($categories->hasPages()): ?>
  <div class="card-footer" style="display:flex;align-items:center;justify-content:space-between">
    <div style="font-size:13px;color:var(--text-muted)">
      Showing <?php echo e($categories->firstItem()); ?>–<?php echo e($categories->lastItem()); ?> of <?php echo e($categories->total()); ?>

    </div>
    <div class="pagination">
      <?php if($categories->onFirstPage()): ?>
        <div class="page-item disabled">‹</div>
      <?php else: ?>
        <a href="<?php echo e($categories->previousPageUrl()); ?>" class="page-item">‹</a>
      <?php endif; ?>
      <?php $__currentLoopData = $categories->getUrlRange(1, $categories->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e($url); ?>" class="page-item <?php echo e($categories->currentPage() == $page ? 'active' : ''); ?>"><?php echo e($page); ?></a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php if($categories->hasMorePages()): ?>
        <a href="<?php echo e($categories->nextPageUrl()); ?>" class="page-item">›</a>
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
  fetch(`/admin/categories/${id}/toggle`, {
    method: 'POST',
    headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json' },
  })
  .then(r => r.json())
  .then(d => {
    document.getElementById('status-lbl-' + id).textContent = d.status ? 'Active' : 'Inactive';
    showToast(d.message, 'success');
  })
  .catch(() => { checkbox.checked = !checkbox.checked; showToast('Something went wrong', 'error'); });
}
</script>
<?php $__env->stopPush(); ?>



<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>