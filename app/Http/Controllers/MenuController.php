<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index()
    {
        $menu = DB::table('menu_items')
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('menu', compact('menu'));
    }
    
    public function show($id)
    {
        $item = \App\Models\MenuItem::findOrFail($id);
        return response()->json($item);
    }
    
}
