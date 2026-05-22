<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Register — GroceryMart</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}body{font-family:'Inter',sans-serif;background:#f0f2f5;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px}
.card{background:#fff;border-radius:16px;padding:40px;width:100%;max-width:480px;box-shadow:0 4px 24px rgba(0,0,0,.10)}
.logo{text-align:center;margin-bottom:24px}.logo-text{font-size:26px;font-weight:800;color:#1a1a2e}.logo-text span{color:#16a34a}
h2{font-size:20px;font-weight:700;text-align:center;margin-bottom:6px}
.subtitle{font-size:13px;color:#64748b;text-align:center;margin-bottom:24px}
.form-group{margin-bottom:14px}.form-label{display:block;font-size:13px;font-weight:500;margin-bottom:5px;color:#374151}
.form-control{width:100%;padding:11px 14px;border:1.5px solid #d1d5db;border-radius:9px;font-size:14px;font-family:inherit;outline:none;transition:border-color .2s}
.form-control:focus{border-color:#16a34a;box-shadow:0 0 0 3px rgba(22,163,74,.10)}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:12px}
.btn{width:100%;padding:13px;background:#16a34a;color:#fff;border:none;border-radius:9px;font-size:15px;font-weight:600;cursor:pointer;transition:background .2s;margin-top:6px}
.btn:hover{background:#15803d}
.link{text-align:center;margin-top:16px;font-size:13px;color:#64748b}.link a{color:#16a34a;font-weight:600}
.alert{padding:12px 16px;border-radius:8px;font-size:13px;margin-bottom:14px}
.alert-error{background:#fef2f2;border:1px solid #fecaca;color:#dc2626}
.form-error{font-size:12px;color:#dc2626;margin-top:3px}
</style>
</head>
<body>
<div class="card">
  <div class="logo"><div class="logo-text">Grocery<span>Mart</span></div></div>
  <h2>Create Account</h2>
  <p class="subtitle">Join thousands of happy customers</p>

  <?php if($errors->any()): ?>
  <div class="alert alert-error"><?php echo e($errors->first()); ?></div>
  <?php endif; ?>

  <form action="<?php echo e(route('register.post')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div class="form-group">
      <label class="form-label">Full Name</label>
      <input type="text" name="name" class="form-control" placeholder="Your full name" value="<?php echo e(old('name')); ?>" required>
      <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" placeholder="your@email.com" value="<?php echo e(old('email')); ?>" required>
        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>
      <div class="form-group">
        <label class="form-label">Phone</label>
        <input type="text" name="phone" class="form-control" placeholder="10-digit number" value="<?php echo e(old('phone')); ?>" required>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Min 6 characters" required>
        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>
      <div class="form-group">
        <label class="form-label">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat password" required>
      </div>
    </div>
    <button type="submit" class="btn">✅ Create My Account</button>
  </form>
  <div class="link">Already have an account? <a href="<?php echo e(route('login')); ?>">Login here</a></div>
  <div class="link" style="margin-top:8px"><a href="<?php echo e(route('home')); ?>">← Back to Home</a></div>
</div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views/frontend/auth/register.blade.php ENDPATH**/ ?>