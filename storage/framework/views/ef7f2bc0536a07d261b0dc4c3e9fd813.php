<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title>Order Detail — GroceryMart</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>*{box-sizing:border-box;margin:0;padding:0}body{font-family:'Inter',sans-serif;background:#f0f2f5}
.navbar{background:#fff;padding:14px 24px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid #e2e8f0}
.logo{font-size:20px;font-weight:800;color:#1a1a2e;text-decoration:none}.logo span{color:#16a34a}
.wrap{max-width:900px;margin:24px auto;padding:0 20px}
.card{background:#fff;border-radius:12px;padding:24px;border:1px solid #e2e8f0;margin-bottom:16px}
table{width:100%;border-collapse:collapse;font-size:13px}
th{padding:10px;background:#f8fafc;color:#64748b;font-size:12px;border-bottom:1px solid #e2e8f0;text-align:left}
td{padding:12px 10px;border-bottom:1px solid #f1f5f9}
.badge{padding:3px 10px;border-radius:20px;font-size:11.5px;font-weight:600}
.badge-warning{background:#fef9c3;color:#ca8a04}.badge-success{background:#dcfce7;color:#16a34a}.badge-danger{background:#fef2f2;color:#dc2626}.badge-info{background:#dbeafe;color:#2563eb}.badge-secondary{background:#f1f5f9;color:#64748b}
</style>
</head>
<body>
<nav class="navbar">
  <a href="<?php echo e(route('home')); ?>" class="logo">Grocery<span>Mart</span></a>
  <div style="display:flex;gap:16px;font-size:13.5px"><a href="<?php echo e(route('order.index')); ?>" style="color:#16a34a">← My Orders</a></div>
</nav>
<div class="wrap">
  <h1 style="font-size:22px;font-weight:700;margin-bottom:16px">Order #<?php echo e($order->order_number); ?></h1>
  <div class="card">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px">
      <div style="font-size:13px;color:#64748b">Placed on <?php echo e($order->created_at->format('d M Y, h:i A')); ?></div>
      <span class="badge badge-<?php echo e($order->status_badge_color); ?>"><?php echo e($order->status_label); ?></span>
    </div>
    <table>
      <thead><tr><th>Product</th><th>Price</th><th>Qty</th><th>Total</th></tr></thead>
      <tbody>
        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr><td><?php echo e($item->product_name); ?></td><td>₹<?php echo e(number_format($item->price)); ?></td><td>× <?php echo e($item->quantity); ?></td><td><strong>₹<?php echo e(number_format($item->subtotal)); ?></strong></td></tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
    </table>
    <div style="margin-top:16px;max-width:250px;margin-left:auto">
      <div style="display:flex;justify-content:space-between;font-size:13px;padding:6px 0;border-bottom:1px solid #f1f5f9"><span>Subtotal</span><span>₹<?php echo e(number_format($order->subtotal)); ?></span></div>
      <div style="display:flex;justify-content:space-between;font-size:13px;padding:6px 0;border-bottom:1px solid #f1f5f9"><span>Delivery</span><span><?php echo e($order->delivery_charge > 0 ? '₹'.$order->delivery_charge : 'FREE'); ?></span></div>
      <div style="display:flex;justify-content:space-between;font-size:15px;font-weight:700;padding:10px 0"><span>Total</span><span style="color:#16a34a">₹<?php echo e(number_format($order->total)); ?></span></div>
    </div>
  </div>
  <div class="card">
    <div style="font-size:15px;font-weight:600;margin-bottom:12px">📍 Delivery Address</div>
    <div style="font-size:13px;color:#374151;line-height:1.8">
      <strong><?php echo e($order->delivery_name); ?></strong> · <?php echo e($order->delivery_phone); ?><br>
      <?php echo e($order->delivery_address); ?>, <?php echo e($order->delivery_city); ?>, <?php echo e($order->delivery_state); ?> - <?php echo e($order->delivery_pincode); ?>

    </div>
  </div>
</div>
</body></html>
<?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views/frontend/account/order-detail.blade.php ENDPATH**/ ?>