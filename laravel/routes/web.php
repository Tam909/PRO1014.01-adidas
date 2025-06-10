<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\Product\ProductController;

use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\CheckoutController;
use App\Http\Controllers\User\Product\ProductController as ProductProductController;

// Đăng ký và đăng nhập
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Đăng xuất
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('home')->with('success', 'Đăng xuất thành công!');
})->name('logout');

// Middleware cho admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');

    // Quản lý sản phẩm
    Route::get('/admin/products', [ProductController::class, 'index'])->name('products.index');

    // Quản lý đơn hàng
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('orders.index');

    Route::post('/orders/confirm/{id}', [OrderController::class, 'confirm'])->name('orders.confirm');

    // Quản lý người dùng
    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    // Quản lý danh mục
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::resource('categories', CategoryController::class)->names('admin.category');
});

// Thêm sản phẩm vào giỏ hàng
Route::post('/cart/add/{product}', [OrderController::class, 'addToCart'])->name('cart.add');
// Xoa sản phẩm khỏi giỏ hàng
Route::delete('/cart/destroy/{id_detail}', [OrderController::class, 'destroy'])->name('cart.destroy');
// Resource cho quản lý sản phẩm (trừ show)
Route::prefix('admin')->group(function () {
    Route::resource('products', ProductController::class)->except(['show']);
});

// Người dùng - Trang chủ
Route::get('/', [ProductProductController::class, 'index'])->name('home');

// Trang chi tiết sản phẩm
Route::get('/products/{id}', [ProductProductController::class, 'show'])->name('products.show');

// Hiển thị giỏ hàng
Route::get('/cart', [OrderController::class, 'showCart'])->name('carts.index')->middleware('auth');

Route::get('/checkout', [CheckoutController::class, 'showForm'])->name('checkout.index');



Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');



Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
