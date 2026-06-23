<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\OrderController as FrontOrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController   as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController    as AdminProductController;
use App\Http\Controllers\Admin\OrderController      as AdminOrderController;
use App\Http\Controllers\Admin\BannerController     as AdminBannerController;
use App\Http\Controllers\Admin\CouponController     as AdminCouponController;
use App\Http\Controllers\Admin\InventoryController  as AdminInventoryController;

// ══════════════════════════════════════
// FRONTEND ROUTES
// ══════════════════════════════════════

Route::get('/',        [HomeController::class, 'index'])->name('home');
Route::get('/shop',    [ProductController::class, 'index'])->name('shop');
Route::get('/all-categories', [ProductController::class, 'allCategories'])->name('categories.all');
Route::get('/offers',  [ProductController::class, 'offers'])->name('offers');
Route::get('/category/{slug}', [ProductController::class, 'category'])->name('category.show');
Route::get('/product/{slug}',  [ProductController::class, 'show'])->name('product.show');
Route::get('/search',          [ProductController::class, 'search'])->name('shop.search');



// Cart
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/',              [CartController::class, 'index'])->name('index');
    Route::post('/add',          [CartController::class, 'add'])->name('add');
    Route::patch('/update/{id}', [CartController::class, 'update'])->name('update');
    Route::delete('/remove/{id}',[CartController::class, 'remove'])->name('remove');
    Route::post('/coupon',       [CartController::class, 'applyCoupon'])->name('coupon.apply');
    Route::delete('/clear',      [CartController::class, 'clear'])->name('clear');  // ← ADD
});

Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
// ya
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register'])->name('register.post');
    Route::get('/forgot-password',  [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Customer area (auth needed)
Route::middleware('auth')->group(function () {
    Route::get('/my-account',         [AuthController::class, 'dashboard'])->name('account.index');
    Route::get('/my-account/orders',  [FrontOrderController::class, 'index'])->name('order.index');
    Route::get('/my-account/orders/{id}', [FrontOrderController::class, 'show'])->name('order.show');
    Route::get('/checkout',           [CartController::class, 'checkout'])->name('checkout.index');
    Route::post('/checkout/place',    [CartController::class, 'placeOrder'])->name('checkout.place');
    Route::get('/checkout/success/{order}', [CartController::class, 'success'])->name('checkout.success');
});



// Public AJAX - location/pincode check (login required nahi, kyunki user checkout pe jaane se pehle bhi check kar sakta hai)
Route::post('/check-delivery-area', [CheckoutController::class, 'checkDeliveryArea'])->name('delivery.check');

// Customer area (auth needed) — ye block already hai, isme replace karo
Route::middleware('auth')->group(function () {
    Route::get('/my-account',         [AuthController::class, 'dashboard'])->name('account.index');
    Route::get('/my-account/orders',  [FrontOrderController::class, 'index'])->name('order.index');
    Route::get('/my-account/orders/{id}', [FrontOrderController::class, 'show'])->name('order.show');

    Route::get('/checkout',           [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/place',    [CheckoutController::class, 'placeOrder'])->name('checkout.place');
    Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');
});

// ══════════════════════════════════════
// ADMIN ROUTES
// ══════════════════════════════════════

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Categories
    Route::resource('categories', AdminCategoryController::class);
    Route::post('categories/{id}/toggle', [AdminCategoryController::class, 'toggleStatus'])->name('categories.toggle');

    // Products
    Route::resource('products', AdminProductController::class);
    Route::post('products/{id}/toggle',   [AdminProductController::class, 'toggleStatus'])->name('products.toggle');
    Route::delete('products/image/{id}',  [AdminProductController::class, 'deleteImage'])->name('products.image.delete');

    // Orders
    Route::get('orders',          [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{id}',     [AdminOrderController::class, 'show'])->name('orders.show');
    Route::put('orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.status');
    Route::get('orders/{id}/invoice',[AdminOrderController::class, 'invoice'])->name('orders.invoice');

    // Banners
    Route::resource('banners', AdminBannerController::class);
    Route::post('banners/{id}/toggle', [AdminBannerController::class, 'toggleStatus'])->name('banners.toggle');

    // Coupons
    Route::resource('coupons', AdminCouponController::class);
    Route::post('coupons/{id}/toggle', [AdminCouponController::class, 'toggleStatus'])->name('coupons.toggle');

    // Inventory
    Route::get('inventory',             [AdminInventoryController::class, 'index'])->name('inventory.index');
    Route::get('inventory/low-stock',   [AdminInventoryController::class, 'lowStock'])->name('inventory.low');
    Route::post('inventory/update/{id}',[AdminInventoryController::class, 'update'])->name('inventory.update');

    // Customers
    Route::get('customers',         [\App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('customers.index');
    Route::get('customers/{id}',    [\App\Http\Controllers\Admin\CustomerController::class, 'show'])->name('customers.show');

    // Reviews
    Route::get('reviews',               [\App\Http\Controllers\Admin\ReviewController::class, 'index'])->name('reviews.index');
    Route::post('reviews/{id}/approve', [\App\Http\Controllers\Admin\ReviewController::class, 'approve'])->name('reviews.approve');
    Route::delete('reviews/{id}',       [\App\Http\Controllers\Admin\ReviewController::class, 'destroy'])->name('reviews.destroy');

    // Reports
    Route::get('reports/sales',    [\App\Http\Controllers\Admin\ReportController::class, 'sales'])->name('reports.sales');
    Route::get('reports/products', [\App\Http\Controllers\Admin\ReportController::class, 'products'])->name('reports.products');

    // Settings
    Route::get('settings',         [\App\Http\Controllers\Admin\SettingController::class, 'general'])->name('settings.general');
    Route::post('settings',        [\App\Http\Controllers\Admin\SettingController::class, 'updateGeneral'])->name('settings.general.update');
    Route::get('settings/delivery',[\App\Http\Controllers\Admin\SettingController::class, 'delivery'])->name('settings.delivery');
    Route::post('settings/delivery',[\App\Http\Controllers\Admin\SettingController::class, 'updateDelivery'])->name('settings.delivery.update');
});