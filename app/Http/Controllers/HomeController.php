<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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
            ->limit(8)
            ->get();

        // 🔹 หมวดหมู่ของเมนู (เพิ่มปุ่ม All ด้วย)
        $categories = ['All', 'Chicken', 'Sides', 'Combo', 'Burger', 'Snacks'];

        // 💬 รีวิวลูกค้า
        $reviews = DB::table('reviews')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        return view('home', compact('popular', 'menu', 'reviews', 'categories'));
    }

    // 🧭 ฟังก์ชันกรองหมวดหมู่เมนู (AJAX)
    public function filterMenu($category = null)
    {
        if ($category === 'All' || !$category) {
            $menu = DB::table('menu_items')->get();
        } else {
            $menu = DB::table('menu_items')
                ->where('category', $category)
                ->get();
        }

        return response()->json([
            'html' => view('partials.menu_cards', compact('menu'))->render()
        ]);
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
