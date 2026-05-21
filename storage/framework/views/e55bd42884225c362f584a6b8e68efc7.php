

<?php $__env->startSection('title','Orders'); ?>
<?php $__env->startSection('breadcrumb','Orders'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
  <div>
    <div class="page-title">🧾 Orders</div>
    <div class="page-sub">Manage all customer orders</div>
  </div>
</div>


<div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:16px">
  <?php $__currentLoopData = [
    'all'=>['label'=>'All','color'=>'secondary'],
    'pending'=>['label'=>'Pending','color'=>'warning'],
    'confirmed'=>['label'=>'Confirmed','color'=>'info'],
    'processing'=>['label'=>'Processing','color'=>'info'],
    'shipped'=>['label'=>'Shipped','color'=>'secondary'],
    'out_for_delivery'=>['label'=>'Out for Delivery','color'=>'info'],
    'delivered'=>['label'=>'Delivered','color'=>'success'],
    'cancelled'=>['label'=>'Cancelled','color'=>'danger'],
  ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <a href="<?php echo e(route('admin.orders.index')); ?>?status=<?php echo e($key === 'all' ? '' : $key); ?>&search=<?php echo e(request('search')); ?>"
    class="badge badge-<?php echo e($info['color']); ?>"
    style="padding:6px 14px;font-size:12.5px;cursor:pointer;text-decoration:none;<?php echo e(request('status', 'all') === $key ? 'outline:2px solid currentColor' : ''); ?>">
    <?php echo e($info['label']); ?> (<?php echo e($statusCounts[$key] ?? 0); ?>)
  </a>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>


<div class="filters-bar">
  <form method="GET" style="display:flex;gap:10px;flex-wrap:wrap;width:100%">
    <input type="hidden" name="status" value="<?php echo e(request('status')); ?>">
    <div class="search-filter">
      🔍
      <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Order # or customer name...">
    </div>
    <select name="payment" class="filter-select" onchange="this.form.submit()">
      <option value="">All Payments</option>
      <option value="cod" <?php echo e(request('payment')==='cod' ? 'selected' : ''); ?>>COD</option>
      <option value="online" <?php echo e(request('payment')==='online' ? 'selected' : ''); ?>>Online</option>
    </select>
    <input type="date" name="date_from" value="<?php echo e(request('date_from')); ?>" class="filter-select">
    <input type="date" name="date_to" value="<?php echo e(request('date_to')); ?>" class="filter-select">
    <button type="submit" class="btn btn-secondary">Filter</button>
    <a href="<?php echo e(route('admin.orders.index')); ?>" class="btn btn-secondary">Reset</a>
  </form>
</div>

<div class="card">
  <div class="table-wrap" style="border:none">
    <table>
      <thead>
        <tr>
          <th>Order #</th>
          <th>Customer</th>
          <th>Items</th>
          <th>Total</th>
          <th>Payment</th>
          <th>Status</th>
          <th>Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td><strong style="color:var(--green)">#<?php echo e($order->order_number); ?></strong></td>
          <td>
            <div class="td-name"><?php echo e($order->delivery_name); ?></div>
            <div class="td-sub"><?php echo e($order->user->email ?? ''); ?></div>
          </td>
          <td style="color:var(--text-muted)"><?php echo e($order->items->count()); ?> items</td>
          <td>
            <strong>₹<?php echo e(number_format($order->total)); ?></strong>
            <?php if($order->discount > 0): ?>
              <div style="font-size:11px;color:#16a34a">-₹<?php echo e(number_format($order->discount)); ?> off</div>
            <?php endif; ?>
          </td>
          <td>
            <span class="badge <?php echo e($order->payment_method === 'cod' ? 'badge-secondary' : 'badge-info'); ?>">
              <?php echo e(strtoupper($order->payment_method)); ?>

            </span>
            <div>
              <span class="badge <?php echo e($order->payment_status === 'paid' ? 'badge-success' : 'badge-warning'); ?>" style="margin-top:3px">
                <?php echo e(ucfirst($order->payment_status)); ?>

              </span>
            </div>
          </td>
          <td>
            <span class="badge badge-<?php echo e($order->status_badge_color); ?>">
              <?php echo e($order->status_label); ?>

            </span>
          </td>
          <td style="color:var(--text-muted);font-size:12px;white-space:nowrap">
            <?php echo e($order->created_at->format('d M Y')); ?><br>
            <?php echo e($order->created_at->format('h:i A')); ?>

          </td>
          <td>
            <div class="td-actions">
              <a href="<?php echo e(route('admin.orders.show', $order->id)); ?>"
                class="btn btn-secondary btn-sm">View</a>
              <a href="<?php echo e(route('admin.orders.invoice', $order->id)); ?>" target="_blank"
                class="btn btn-secondary btn-sm btn-icon" title="Invoice">🖨️</a>
            </div>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
          <td colspan="8" style="text-align:center;padding:48px;color:var(--text-muted)">
            <div style="font-size:36px;margin-bottom:10px">🧾</div>
            No orders found
          </td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <?php if($orders->hasPages()): ?>
  <div class="card-footer" style="display:flex;align-items:center;justify-content:space-between">
    <div style="font-size:13px;color:var(--text-muted)"><?php echo e($orders->firstItem()); ?>–<?php echo e($orders->lastItem()); ?> of <?php echo e($orders->total()); ?></div>
    <div class="pagination">
      <?php if(!$orders->onFirstPage()): ?><a href="<?php echo e($orders->previousPageUrl()); ?>" class="page-item">‹</a><?php else: ?><div class="page-item disabled">‹</div><?php endif; ?>
      <?php $__currentLoopData = $orders->getUrlRange(max(1,$orders->currentPage()-2), min($orders->lastPage(),$orders->currentPage()+2)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e($url); ?>" class="page-item <?php echo e($orders->currentPage()==$page ? 'active' : ''); ?>"><?php echo e($page); ?></a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php if($orders->hasMorePages()): ?><a href="<?php echo e($orders->nextPageUrl()); ?>" class="page-item">›</a><?php else: ?><div class="page-item disabled">›</div><?php endif; ?>
    </div>
  </div>
  <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>