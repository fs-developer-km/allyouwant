

<?php $__env->startSection('title','Order #'.$order->order_number); ?>
<?php $__env->startSection('breadcrumb','Order Detail'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
  <div>
    <div class="page-title">Order #<?php echo e($order->order_number); ?></div>
    <div class="page-sub">Placed on <?php echo e(optional($order->created_at)->format('d M Y, h:i A') ?? 'N/A'); ?></div>
  </div>
  <div class="page-actions">
    <a href="<?php echo e(route('admin.orders.index')); ?>" class="btn btn-secondary">← Back</a>
    <a href="<?php echo e(route('admin.orders.invoice', $order->id)); ?>" target="_blank" class="btn btn-secondary">🖨️ Print Invoice</a>
  </div>
</div>

<div style="display:grid;grid-template-columns:1fr 320px;gap:20px;align-items:start">

  
  <div style="display:flex;flex-direction:column;gap:16px">

    
    <div class="card">
      <div class="card-header"><div class="card-title">🛒 Order Items</div></div>
      <div class="table-wrap" style="border:none">
        <table>
          <thead><tr><th>Product</th><th>Price</th><th>Qty</th><th>Subtotal</th></tr></thead>
          <tbody>
            <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td>
                <div class="td-flex">
                  <?php if($item->product_image): ?>
                    <img src="<?php echo e(asset('storage/'.$item->product_image)); ?>" class="td-img" style="object-fit:cover">
                  <?php else: ?>
                    <div class="td-img">🛒</div>
                  <?php endif; ?>
                  <div class="td-name"><?php echo e($item->product_name); ?></div>
                </div>
              </td>
              <td>₹<?php echo e(number_format($item->price)); ?></td>
              <td>× <?php echo e($item->quantity); ?></td>
              <td><strong>₹<?php echo e(number_format($item->subtotal)); ?></strong></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
      <div class="card-footer">
        <div style="max-width:250px;margin-left:auto">
          <div style="display:flex;justify-content:space-between;font-size:13px;padding:5px 0;border-bottom:1px solid var(--border)">
            <span>Subtotal</span><span>₹<?php echo e(number_format($order->subtotal)); ?></span>
          </div>
          <div style="display:flex;justify-content:space-between;font-size:13px;padding:5px 0;border-bottom:1px solid var(--border)">
            <span>Delivery</span><span><?php echo e($order->delivery_charge > 0 ? '₹'.number_format($order->delivery_charge) : 'FREE'); ?></span>
          </div>
          <?php if($order->discount > 0): ?>
          <div style="display:flex;justify-content:space-between;font-size:13px;padding:5px 0;border-bottom:1px solid var(--border);color:#16a34a">
            <span>Discount <?php echo e($order->coupon_code ? '('.$order->coupon_code.')' : ''); ?></span>
            <span>-₹<?php echo e(number_format($order->discount)); ?></span>
          </div>
          <?php endif; ?>
          <div style="display:flex;justify-content:space-between;font-size:15px;font-weight:700;padding:8px 0">
            <span>Total</span><span>₹<?php echo e(number_format($order->total)); ?></span>
          </div>
        </div>
      </div>
    </div>

    
    <div class="card">
      <div class="card-header"><div class="card-title">📋 Status History</div></div>
      <div class="card-body">
        <?php $__currentLoopData = $order->statusHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div style="display:flex;gap:14px;padding:10px 0;border-bottom:1px solid #f1f5f9">
          <div style="width:10px;height:10px;border-radius:50%;background:var(--green);margin-top:4px;flex-shrink:0"></div>
          <div style="flex:1">
            <div style="font-weight:600;font-size:13px"><?php echo e(ucwords(str_replace('_',' ',$history->status))); ?></div>
            <div style="font-size:12px;color:var(--text-muted)"><?php echo e($history->comment); ?></div>
            <div style="font-size:11.5px;color:var(--text-muted);margin-top:3px">
              <?php echo e($history->created_at->format('d M Y h:i A')); ?>

              <?php if($history->updatedBy): ?> · by <?php echo e($history->updatedBy->name); ?> <?php endif; ?>
            </div>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </div>

  
  <div style="display:flex;flex-direction:column;gap:16px">

    
    <div class="card">
      <div class="card-header"><div class="card-title">🔄 Update Status</div></div>
      <div class="card-body">
        <form action="<?php echo e(route('admin.orders.status', $order->id)); ?>" method="POST">
          <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
          <div class="form-group" style="margin-bottom:12px">
            <label class="form-label">New Status</label>
            <select name="status" class="form-control">
              <?php $__currentLoopData = ['pending','confirmed','processing','shipped','out_for_delivery','delivered','cancelled','refunded']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($s); ?>" <?php echo e($order->status === $s ? 'selected' : ''); ?>>
                  <?php echo e(ucwords(str_replace('_',' ',$s))); ?>

                </option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
          <div class="form-group" style="margin-bottom:14px">
            <label class="form-label">Comment (optional)</label>
            <textarea name="comment" class="form-control" rows="2" placeholder="Add a note..."></textarea>
          </div>
          <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center">
            Update Status
          </button>
        </form>
      </div>
    </div>

    
    <div class="card">
      <div class="card-header"><div class="card-title">👤 Customer</div></div>
      <div class="card-body" style="font-size:13px">
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:14px">
          <div style="width:40px;height:40px;border-radius:50%;background:#dcfce7;color:#16a34a;display:flex;align-items:center;justify-content:center;font-weight:700">
            <?php echo e(substr($order->user->name ?? 'U', 0, 2)); ?>

          </div>
          <div>
            <div style="font-weight:600"><?php echo e($order->user->name ?? 'N/A'); ?></div>
            <div style="color:var(--text-muted)"><?php echo e($order->user->email ?? ''); ?></div>
          </div>
        </div>
        <div style="display:flex;flex-direction:column;gap:8px;color:var(--text-muted)">
          <div>📞 <?php echo e($order->delivery_phone); ?></div>
          <div>📍 <?php echo e($order->delivery_address); ?>, <?php echo e($order->delivery_city); ?>, <?php echo e($order->delivery_state); ?> - <?php echo e($order->delivery_pincode); ?></div>
        </div>
      </div>
    </div>

    
    <div class="card">
      <div class="card-header"><div class="card-title">💳 Payment</div></div>
      <div class="card-body" style="font-size:13px;display:flex;flex-direction:column;gap:8px">
        <div style="display:flex;justify-content:space-between">
          <span style="color:var(--text-muted)">Method</span>
          <span class="badge <?php echo e($order->payment_method==='cod' ? 'badge-secondary' : 'badge-info'); ?>"><?php echo e(strtoupper($order->payment_method)); ?></span>
        </div>
        <div style="display:flex;justify-content:space-between">
          <span style="color:var(--text-muted)">Status</span>
          <span class="badge <?php echo e($order->payment_status==='paid' ? 'badge-success' : 'badge-warning'); ?>"><?php echo e(ucfirst($order->payment_status)); ?></span>
        </div>
        <?php if($order->payment_id): ?>
        <div style="display:flex;justify-content:space-between">
          <span style="color:var(--text-muted)">Payment ID</span>
          <code style="font-size:11px"><?php echo e($order->payment_id); ?></code>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>