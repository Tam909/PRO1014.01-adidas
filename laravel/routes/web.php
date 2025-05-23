<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');
});

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;

// Admin dashboard và hồ sơ
Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');

// Quản lý sản phẩm
Route::get('/admin/products', [ProductController::class, 'index'])->name('products.index');

// Quản lý đơn hàng
Route::get('/admin/orders', [OrderController::class, 'index'])->name('orders.index');

// Quản lý người dùng
Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');

// Quản lý danh mục
Route::get('/admin/categories', [CategoryController::class, 'index'])->name('categories.index');
