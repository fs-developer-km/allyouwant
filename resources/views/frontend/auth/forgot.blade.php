<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Forgot Password — GroceryMart</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}body{font-family:'Inter',sans-serif;background:#f0f2f5;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px}
.card{background:#fff;border-radius:16px;padding:40px;width:100%;max-width:420px;box-shadow:0 4px 24px rgba(0,0,0,.10);text-align:center}
.logo-text{font-size:26px;font-weight:800;color:#1a1a2e;margin-bottom:24px}.logo-text span{color:#16a34a}
h2{font-size:20px;font-weight:700;margin-bottom:8px}p{font-size:13px;color:#64748b;margin-bottom:24px}
.form-control{width:100%;padding:12px 14px;border:1.5px solid #d1d5db;border-radius:9px;font-size:14px;outline:none;margin-bottom:14px;font-family:inherit}
.form-control:focus{border-color:#16a34a}
.btn{width:100%;padding:13px;background:#16a34a;color:#fff;border:none;border-radius:9px;font-size:14px;font-weight:600;cursor:pointer}
.link{margin-top:16px;font-size:13px;color:#64748b}.link a{color:#16a34a;font-weight:600}
.alert-success{background:#dcfce7;border:1px solid #bbf7d0;color:#15803d;padding:12px;border-radius:8px;font-size:13px;margin-bottom:16px}
</style>
</head>
<body>
<div class="card">
  <div class="logo-text">Grocery<span>Mart</span></div>
  <h2>🔒 Forgot Password?</h2>
  <p>Enter your email and we'll send you a reset link</p>
  @if(session('status'))<div class="alert-success">{{ session('status') }}</div>@endif
  <form action="{{ route('password.email') }}" method="POST">
    @csrf
    <input type="email" name="email" class="form-control" placeholder="your@email.com" required>
    <button type="submit" class="btn">Send Reset Link</button>
  </form>
  <div class="link"><a href="{{ route('login') }}">← Back to Login</a></div>
</div>
</body>
</html>
