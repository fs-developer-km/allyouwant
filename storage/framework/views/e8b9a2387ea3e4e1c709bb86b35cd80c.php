<?php $__env->startSection('title','Customer Detail'); ?><?php $__env->startSection('breadcrumb','Customer Detail'); ?>
<?php $__env->startSection('content'); ?>
<div class="page-header">
  <div><div class="page-title">👤 <?php echo e($customer->name); ?></div><div class="page-sub"><?php echo e($customer->email); ?></div></div>
  <a href="<?php echo e(route('admin.customers.index')); ?>" class="btn btn-secondary">← Back</a>
</div>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
  <div class="card">
    <div class="card-header"><div class="card-title">Customer Info</div></div>
    <div class="card-body" style="font-size:13px;display:flex;flex-direction:column;gap:10px">
      <div style="display:flex;justify-content:space-between"><span style="color:var(--text-muted)">Name</span><strong><?php echo e($customer->name); ?></strong></div>
      <div style="display:flex;justify-content:space-between"><span style="color:var(--text-muted)">Email</span><span><?php echo e($customer->email); ?></span></div>
      <div style="display:flex;justify-content:space-between"><span style="color:var(--text-muted)">Phone</span><span><?php echo e($customer->phone ?? '—'); ?></span></div>
      <div style="display:flex;justify-content:space-between"><span style="color:var(--text-muted)">Joined</span><span><?php echo e($customer->created_at->format('d M Y')); ?></span></div>
      <div style="display:flex;justify-content:space-between"><span style="color:var(--text-muted)">Total Orders</span><strong><?php echo e($customer->orders->count()); ?></strong></div>
      <div style="display:flex;justify-content:space-between"><span style="color:var(--text-muted)">Total Spent</span><strong style="color:var(--green)">₹<?php echo e(number_format($customer->orders->sum('total'))); ?></strong></div>
    </div>
  </div>
  <div class="card">
    <div class="card-header"><div class="card-title">Recent Orders</div></div>
    <div class="table-wrap" style="border:none">
      <table>
        <thead><tr><th>Order #</th><th>Total</th><th>Status</th><th>Date</th></tr></thead>
        <tbody>
          <?php $__empty_1 = true; $__currentLoopData = $customer->orders->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr>
            <td><a href="<?php echo e(route('admin.orders.show',$o->id)); ?>" style="color:var(--green)">#<?php echo e($o->order_number); ?></a></td>
            <td>₹<?php echo e(number_format($o->total)); ?></td>
            <td><span class="badge badge-<?php echo e($o->status_badge_color); ?>"><?php echo e($o->status_label); ?></span></td>
            <td style="font-size:12px;color:var(--text-muted)"><?php echo e($o->created_at->format('d M Y')); ?></td>
          </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <tr><td colspan="4" style="text-align:center;padding:20px;color:var(--text-muted)">No orders yet</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views\admin\customers\show.blade.php ENDPATH**/ ?>