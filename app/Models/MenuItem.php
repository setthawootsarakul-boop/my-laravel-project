<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    // กำหนดชื่อตารางในฐานข้อมูล
    protected $table = 'menu_items';

    // ระบุฟิลด์ที่สามารถกรอกข้อมูลได้ (Mass Assignment)
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category',
        'is_popular',
    ];
}
