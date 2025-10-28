<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/reviews', [HomeController::class, 'reviews'])->name('reviews');
Route::get('/filter-menu/{category?}', [HomeController::class, 'filterMenu'])->name('filter.menu');
// เพิ่มเส้นทางอื่น ๆ ตามต้องการ  