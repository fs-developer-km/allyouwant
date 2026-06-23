<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>My Account — GroceryMart</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>*{box-sizing:border-box;margin:0;padding:0}body{font-family:'Inter',sans-serif;background:#f0f2f5}
.navbar{background:#fff;padding:14px 24px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid #e2e8f0}
.logo{font-size:20px;font-weight:800;color:#1a1a2e;text-decoration:none}.logo span{color:#16a34a}
.nav-links{display:flex;gap:16px}.nav-links a{font-size:13.5px;color:#374151;text-decoration:none}
.wrap{max-width:1000px;margin:24px auto;padding:0 20px}
.card{background:#fff;border-radius:12px;padding:24px;border:1px solid #e2e8f0;margin-bottom:16px}
.welcome{font-size:22px;font-weight:700;margin-bottom:4px}
.grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:14px}
.stat-card{background:#f0faf4;border-radius:10px;padding:18px;text-align:center}
.stat-num{font-size:28px;font-weight:800;color:#16a34a}.stat-lbl{font-size:12px;color:#64748b;margin-top:3px}
table{width:100%;border-collapse:collapse;font-size:13px}
th{text-align:left;padding:10px;background:#f8fafc;color:#64748b;font-size:12px;text-transform:uppercase;letter-spacing:.4px;border-bottom:1px solid #e2e8f0}
td{padding:12px 10px;border-bottom:1px solid #f1f5f9}
.badge{padding:3px 10px;border-radius:20px;font-size:11.5px;font-weight:600}
.badge-warning{background:#fef9c3;color:#ca8a04}.badge-success{background:#dcfce7;color:#16a34a}.badge-danger{background:#fef2f2;color:#dc2626}.badge-info{background:#dbeafe;color:#2563eb}
</style>
</head>
<body>
<nav class="navbar">
  <a href="<?php echo e(route('home')); ?>" class="logo">Grocery<span>Mart</span></a>
  <div class="nav-links">
    <a href="<?php echo e(route('home')); ?>">Home</a>
    <a href="<?php echo e(route('shop')); ?>">Shop</a>
    <a href="<?php echo e(route('cart.index')); ?>">🛒 Cart</a>
    <a href="<?php echo e(route('order.index')); ?>">My Orders</a>
    <form action="<?php echo e(route('logout')); ?>" method="POST" style="display:inline"><?php echo csrf_field(); ?><button style="background:none;border:none;color:#374151;cursor:pointer;font-size:13.5px">Logout</button></form>
  </div>
</nav>
<div class="wrap">
  <div class="card">
    <div class="welcome">👋 Hello, <?php echo e($user->name); ?>!</div>
    <div style="font-size:13px;color:#64748b;margin-top:4px"><?php echo e($user->email); ?> · <?php echo e($user->phone); ?></div>
  </div>
  <div class="grid-3" style="margin-bottom:16px">
    <div class="stat-card"><div class="stat-num"><?php echo e($orders->count()); ?></div><div class="stat-lbl">Total Orders</div></div>
    <div class="stat-card"><div class="stat-num"><?php echo e($orders->where('status','delivered')->count()); ?></div><div class="stat-lbl">Delivered</div></div>
    <div class="stat-card"><div class="stat-num"><?php echo e($orders->where('status','pending')->count()); ?></div><div class="stat-lbl">Pending</div></div>
  </div>
  <div class="card">
    <div style="font-size:16px;font-weight:700;margin-bottom:16px">Recent Orders</div>
    <?php if($orders->count()): ?>
    <table>
      <thead><tr><th>Order #</th><th>Date</th><th>Amount</th><th>Payment</th><th>Status</th></tr></thead>
      <tbody>
        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td><strong style="color:#16a34a">#<?php echo e($order->order_number); ?></strong></td>
          <td><?php echo e($order->created_at->format('d M Y')); ?></td>
          <td><strong>₹<?php echo e(number_format($order->total)); ?></strong></td>
          <td><?php echo e(strtoupper($order->payment_method)); ?></td>
          <td><span class="badge badge-<?php echo e($order->status_badge_color); ?>"><?php echo e($order->status_label); ?></span></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
    </table>
    <?php else: ?>
    <div style="text-align:center;padding:32px;color:#9ca3af">No orders yet. <a href="<?php echo e(route('shop')); ?>" style="color:#16a34a">Start shopping!</a></div>
    <?php endif; ?>
  </div>
</div>
</body></html>
<?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views\frontend\account\dashboard.blade.php ENDPATH**/ ?>