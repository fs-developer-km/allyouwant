<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Login — GroceryMart</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}body{font-family:'Inter',sans-serif;background:#f0f2f5;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px}
.card{background:#fff;border-radius:16px;padding:40px;width:100%;max-width:440px;box-shadow:0 4px 24px rgba(0,0,0,.10)}
.logo{text-align:center;margin-bottom:28px}.logo-text{font-size:26px;font-weight:800;color:#1a1a2e}.logo-text span{color:#16a34a}
.logo-sub{font-size:13px;color:#64748b;margin-top:4px}
h2{font-size:20px;font-weight:700;text-align:center;margin-bottom:6px}
.subtitle{font-size:13px;color:#64748b;text-align:center;margin-bottom:28px}
.form-group{margin-bottom:16px}.form-label{display:block;font-size:13px;font-weight:500;margin-bottom:6px;color:#374151}
.form-control{width:100%;padding:11px 14px;border:1.5px solid #d1d5db;border-radius:9px;font-size:14px;font-family:inherit;outline:none;transition:border-color .2s}
.form-control:focus{border-color:#16a34a;box-shadow:0 0 0 3px rgba(22,163,74,.10)}
.btn{width:100%;padding:13px;background:#16a34a;color:#fff;border:none;border-radius:9px;font-size:15px;font-weight:600;cursor:pointer;transition:background .2s;margin-top:6px}
.btn:hover{background:#15803d}.divider{text-align:center;margin:20px 0;color:#9ca3af;font-size:13px;position:relative}
.divider::before,.divider::after{content:'';position:absolute;top:50%;width:42%;height:1px;background:#e5e7eb}
.divider::before{left:0}.divider::after{right:0}
.link{text-align:center;margin-top:18px;font-size:13px;color:#64748b}.link a{color:#16a34a;font-weight:600}
.alert{padding:12px 16px;border-radius:8px;font-size:13px;margin-bottom:16px}
.alert-error{background:#fef2f2;border:1px solid #fecaca;color:#dc2626}
.remember{display:flex;align-items:center;justify-content:space-between;font-size:13px}
.remember label{display:flex;align-items:center;gap:6px;cursor:pointer}
.back-home{text-align:center;margin-bottom:20px}
.back-home a{font-size:13px;color:#16a34a;font-weight:500}
</style>
</head>
<body>
<div class="card">
  <div class="logo">
    <div class="logo-text">Grocery<span>Mart</span></div>
    <div class="logo-sub">Fresh • Fast • Reliable</div>
  </div>
  <h2>Welcome Back!</h2>
  <p class="subtitle">Login to your account to continue</p>

  <?php if($errors->any()): ?>
  <div class="alert alert-error"><?php echo e($errors->first()); ?></div>
  <?php endif; ?>
  <?php if(session('error')): ?>
  <div class="alert alert-error"><?php echo e(session('error')); ?></div>
  <?php endif; ?>

  <form action="<?php echo e(route('login.post')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div class="form-group">
      <label class="form-label">Email Address</label>
      <input type="email" name="email" class="form-control" placeholder="Enter your email" value="<?php echo e(old('email')); ?>" required>
    </div>
    <div class="form-group">
      <label class="form-label">Password</label>
      <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
    </div>
    <div class="remember">
      <label><input type="checkbox" name="remember"> Remember me</label>
      <a href="<?php echo e(route('password.request')); ?>" style="color:#16a34a">Forgot password?</a>
    </div>
    <button type="submit" class="btn">🔐 Login to Account</button>
  </form>

  <div class="divider">or</div>
  <div class="link">Don't have an account? <a href="<?php echo e(route('register')); ?>">Register Free</a></div>
  <div class="link" style="margin-top:10px"><a href="<?php echo e(route('home')); ?>">← Back to Home</a></div>
</div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views/frontend/auth/login.blade.php ENDPATH**/ ?>