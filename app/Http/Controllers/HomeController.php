<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // 🍗 เมนูยอดนิยม (Our Menu Specials)
        $popular = DB::table('menu_items')
            ->where('is_popular', 1)
            ->limit(2)
            ->get();

        // 🍽️ เมนูทั่วไป (Our Menu)
        $menu = DB::table('menu_items')
            ->where('is_popular', 0)
            ->limit(8)
            ->get();

        // 💬 รีวิวลูกค้า
        $reviews = DB::table('reviews')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        return view('home', compact('popular', 'menu', 'reviews'));
    }

    public function about()
    {
        return view('about');
    }

    public function reviews()
    {
        $reviews = DB::table('reviews')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('reviews', compact('reviews'));
    }
}
