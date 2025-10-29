<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/reviews', [HomeController::class, 'reviews'])->name('reviews');
Route::get('/filter-menu/{category?}', [HomeController::class, 'filterMenu'])->name('filter.menu');

// 🛒 Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add'); // ← เปลี่ยนเป็น POST
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/menu/{id}', [MenuController::class, 'show'])->name('menu.show');
