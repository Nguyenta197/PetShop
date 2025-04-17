<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// trang chủ
Route::get('/', [ProductController::class, 'home'])->name('client.products.home');
// login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [AuthController::class, 'login']);

// đăng ký
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register']);


//logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// phân quyền cho user
    // Route không cần đăng nhập
    Route::get('/', [ProductController::class, 'home'])->name('home');
    Route::get('/detail/{id}', [ProductController::class, 'clientDetail'])->name('client.products.detail');

    // Route cần đăng nhập
    Route::middleware('client')->group(function () {
        // Sản phẩm
        Route::get('/list', [ProductController::class, 'listClient'])->name('client.products.list');

        // Giỏ hàng
        Route::get('/cart', [CartController::class, 'index'])->name('client.cart.index');
        Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('client.cart.add');
        Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('client.cart.update');
        Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('client.cart.remove');

        // Mua ngay (Buy Now)
        Route::post('/buy-now/{id}', [CartController::class, 'buyNow'])->name('client.cart.buyNow');

        // Thanh toán (Checkout)
        Route::get('/checkout', [CartController::class, 'checkoutForm'])->name('client.cart.checkout.form');
        Route::post('/checkout', [CartController::class, 'processCheckout'])->name('client.cart.checkout.process');
    });


// phân quyền cho admin
Route::middleware('admin')->group(function () {
    // Dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Quản lý danh mục & sản phẩm
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('users', UserController::class);

    // Thêm các route admin khác tại đây nếu cần
});
