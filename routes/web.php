<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| 🌐 หน้าเว็บหลัก
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/reviews', [HomeController::class, 'reviews'])->name('reviews');

/*
|--------------------------------------------------------------------------
| 🍔 เมนูอาหาร
|--------------------------------------------------------------------------
*/
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/menu/{id}', [MenuController::class, 'show'])->name('menu.show');
Route::get('/filter-menu/{category?}', [HomeController::class, 'filterMenu'])->name('filter.menu');

/*
|--------------------------------------------------------------------------
| 🛒 ระบบตะกร้า (Cart)
|--------------------------------------------------------------------------
*/
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// ✅ เพิ่มสินค้า (ใช้ AJAX POST)
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

// ✅ ปรับจำนวนสินค้า (+/-)
Route::post('/cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');

// ✅ ลบสินค้า (ใช้ AJAX POST)
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

/*
|--------------------------------------------------------------------------
| 🧾 ระบบสั่งซื้อ (Order)
|--------------------------------------------------------------------------
*/
Route::post('/order/checkout', [OrderController::class, 'checkout'])->name('order.checkout');

