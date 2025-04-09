<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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
Route::middleware('client')->group(function () {
    // Route::get('/', [ProductController::class, 'home'])->name('client.products');
    Route::get('/list', [ProductController::class, 'listClient'])->name('client.products.list');
    Route::get('/detail/{id}', [ProductController::class, 'clientDetail'])->name('client.products.detail');
    Route::get('/cart', [CartController::class, 'index'])->name('client.cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('client.cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('client.cart.update');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('client.cart.remove');
});

// phân quyền cho admin
Route::middleware('admin')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
});
