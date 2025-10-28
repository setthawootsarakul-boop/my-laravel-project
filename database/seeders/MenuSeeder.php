<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // เพิ่มเมนูตัวอย่าง
        DB::table('menu_items')->insert([
            [
                'name' => 'Crispy Fried Chicken',
                'description' => 'ไก่ทอดกรอบนอกนุ่มใน',
                'price' => 129.00,
                'image' => '/images/friedchicken.jpg',
                'category' => 'fried',
                'is_popular' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Grilled Chicken',
                'description' => 'ไก่ย่างสูตรเด็ด',
                'price' => 139.00,
                'image' => '/images/grilledchicken.jpg',
                'category' => 'grill',
                'is_popular' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'French Fries',
                'description' => 'เฟรนช์ฟรายส์กรอบ',
                'price' => 49.00,
                'image' => '/images/fries.jpg',
                'category' => 'sides',
                'is_popular' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Fresh Salad',
                'description' => 'สลัดผักสด น้ำสลัดโฮมเมด',
                'price' => 89.00,
                'image' => '/images/salad.jpg',
                'category' => 'salad',
                'is_popular' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // เพิ่มเมนูอื่น ๆ ได้ตามต้องการ
        ]);

        // เพิ่มรีวิวตัวอย่าง
        DB::table('reviews')->insert([
            [
                'name' => 'Somchai',
                'rating' => 5,
                'comment' => 'อร่อยมาก! ไก่ทอดกรอบสุด ๆ',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Amina',
                'rating' => 4,
                'comment' => 'บริการดี รสชาติดี',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
