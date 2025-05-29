<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


use App\Http\Controllers\Admin\AdminController; 
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\Product\ProductController;


// Admin dashboard và hồ sơ
// Đăng ký và đăng nhập

use App\Http\Controllers\Admin\Auth\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Admin;

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Đăng xuất
Route::post ('/logout', function () {
    Auth::logout();
    return redirect()->route('welcome')->with('success', 'Đăng xuất thành công!');
})->name('logout');



// Middleware cho admin
Route::middleware(['auth','admin'])->group(function () {

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
Route::resource('categories', CategoryController::class)->names('admin.category');

    Route::get('/users',  [UserController::class, 'index'])->name('admin.users');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});


// Đăng ký và đăng nhập

// Middleware cho admin
Route::middleware(['auth','admin'])->group(function () {

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
    Route::get('/users',  [UserController::class, 'index'])->name('admin.users');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});


Route::prefix('admin')->group(function(){
    Route::resource('products', ProductController::class)->except(['show']);
} );