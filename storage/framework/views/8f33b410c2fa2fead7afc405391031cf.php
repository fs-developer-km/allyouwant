<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Checkout — GroceryMart</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>*{box-sizing:border-box;margin:0;padding:0}body{font-family:'Inter',sans-serif;background:#f0f2f5}
.navbar{background:#fff;padding:14px 24px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid #e2e8f0}
.logo{font-size:20px;font-weight:800;color:#1a1a2e;text-decoration:none}.logo span{color:#16a34a}
.wrap{max-width:1000px;margin:24px auto;padding:0 20px;display:grid;grid-template-columns:1fr 300px;gap:20px;align-items:start}
.card{background:#fff;border-radius:12px;padding:24px;border:1px solid #e2e8f0;margin-bottom:16px}
.card-title{font-size:16px;font-weight:700;margin-bottom:18px}
.form-group{margin-bottom:14px}.form-label{display:block;font-size:13px;font-weight:500;margin-bottom:5px;color:#374151}
.form-control{width:100%;padding:10px 13px;border:1.5px solid #d1d5db;border-radius:8px;font-size:13.5px;outline:none;font-family:inherit}
.form-control:focus{border-color:#16a34a}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:12px}
.pay-opt{display:flex;align-items:center;gap:10px;padding:14px;border:1.5px solid #d1d5db;border-radius:9px;cursor:pointer;margin-bottom:10px;transition:border-color .2s}
.pay-opt.selected,.pay-opt:has(input:checked){border-color:#16a34a;background:#f0faf4}
.pay-opt input{accent-color:#16a34a}
.summary-row{display:flex;justify-content:space-between;font-size:14px;padding:8px 0;border-bottom:1px solid #f1f5f9}
.summary-total{display:flex;justify-content:space-between;font-size:16px;font-weight:700;padding:12px 0}
.btn-order{width:100%;background:#16a34a;color:#fff;border:none;padding:14px;border-radius:10px;font-size:15px;font-weight:600;cursor:pointer;margin-top:14px}
.btn-order:hover{background:#15803d}
</style>
</head>
<body>
<nav class="navbar">
  <a href="<?php echo e(route('home')); ?>" class="logo">Grocery<span>Mart</span></a>
</nav>
<div style="max-width:1000px;margin:24px auto;padding:0 20px">
  <h1 style="font-size:22px;font-weight:700;margin-bottom:20px">Checkout</h1>
  <form action="<?php echo e(route('checkout.place')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div style="display:grid;grid-template-columns:1fr 300px;gap:20px;align-items:start">
      <div>
        <div class="card">
          <div class="card-title">📍 Delivery Address</div>
          <div class="form-group"><label class="form-label">Full Name *</label><input type="text" name="name" class="form-control" value="<?php echo e(auth()->user()->name); ?>" required></div>
          <div class="form-group"><label class="form-label">Phone *</label><input type="text" name="phone" class="form-control" value="<?php echo e(auth()->user()->phone); ?>" required></div>
          <div class="form-group"><label class="form-label">Address *</label><input type="text" name="address" class="form-control" placeholder="House no, Street, Area" required></div>
          <div class="form-row">
            <div class="form-group"><label class="form-label">City *</label><input type="text" name="city" class="form-control" required></div>
            <div class="form-group"><label class="form-label">State *</label><input type="text" name="state" class="form-control" required></div>
          </div>
          <div class="form-group"><label class="form-label">Pincode *</label><input type="text" name="pincode" class="form-control" required></div>
        </div>
        <div class="card">
          <div class="card-title">💳 Payment Method</div>
          <label class="pay-opt"><input type="radio" name="payment" value="cod" checked> <div><div style="font-weight:600">Cash on Delivery (COD)</div><div style="font-size:12px;color:#64748b">Pay when your order arrives</div></div></label>
          <label class="pay-opt"><input type="radio" name="payment" value="online"> <div><div style="font-weight:600">Online Payment</div><div style="font-size:12px;color:#64748b">UPI, Card, Net Banking via Razorpay</div></div></label>
        </div>
      </div>
      <div class="card">
        <div class="card-title">📋 Order Summary</div>
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div style="display:flex;justify-content:space-between;font-size:13px;padding:6px 0;border-bottom:1px solid #f9fafb">
          <span><?php echo e($item['product']->name); ?> × <?php echo e($item['qty']); ?></span>
          <span>₹<?php echo e(number_format($item['product']->current_price * $item['qty'])); ?></span>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="summary-row" style="margin-top:8px"><span>Subtotal</span><span>₹<?php echo e(number_format($subtotal)); ?></span></div>
        <div class="summary-row"><span>Delivery</span><span><?php echo e($delivery == 0 ? 'FREE' : '₹'.$delivery); ?></span></div>
        <div class="summary-total"><span>Total</span><span style="color:#16a34a">₹<?php echo e(number_format($total)); ?></span></div>
        <button type="submit" class="btn-order">✅ Place Order</button>
      </div>
    </div>
  </form>
</div>
</body></html>
<?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views\frontend\checkout.blade.php ENDPATH**/ ?>