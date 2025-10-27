<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// แสดงรายการผู้ใช้
Route::get('/users', function () {
    $users = DB::table('users')->get();
    return view('users', ['users' => $users]);
});

// หน้าฟอร์มเพิ่มผู้ใช้ใหม่
Route::get('/users/add', function () {
    return view('add_user');
});

// บันทึกข้อมูลผู้ใช้ใหม่ลงฐานข้อมูล
Route::post('/users/add', function (Request $request) {
    DB::table('users')->insert([
        'name' => $request->name,
        'email' => $request->email,
        'status' => $request->status,
    ]);
    return redirect('/users')->with('success', 'เพิ่มข้อมูลเรียบร้อยแล้ว!');
});
