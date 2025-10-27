<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB; // ใช้ DB สำหรับ Query Builder
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // ดึงข้อมูลจากตาราง users โดยใช้ Query Builder
        $users = DB::table('users')
                    ->where('status', 'active')
                    ->orderBy('created_at', 'desc')
                    ->get();

        // ส่งข้อมูลไปที่ view
        return view('users.index', ['users' => $users]);
    }
}
