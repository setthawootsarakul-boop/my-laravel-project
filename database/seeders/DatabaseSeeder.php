<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ตัวอย่างเมนู
        DB::table('menu_items')->insert([
            ['name' => 'Fried Chicken', 'category' => 'Chicken', 'description' => 'Crispy golden fried chicken.', 'price' => 59.00, 'image' => 'chicken-fried.jpg', 'is_popular' => true],
            ['name' => 'Grilled Chicken', 'category' => 'Chicken', 'description' => 'Smoky grilled chicken with herbs.', 'price' => 69.00, 'image' => 'chicken-grilled.jpg', 'is_popular' => true],
            ['name' => 'French Fries', 'category' => 'Sides', 'description' => 'Crispy golden fries.', 'price' => 39.00, 'image' => 'fries.jpg', 'is_popular' => true],
            ['name' => 'Salad', 'category' => 'Sides', 'description' => 'Fresh vegetables with dressing.', 'price' => 45.00, 'image' => 'salad.jpg', 'is_popular' => false],
        ]);

        // ตัวอย่างรีวิว
        DB::table('reviews')->insert([
            ['customer_name' => 'John Doe', 'customer_image' => 'customer1.jpg', 'comment' => 'The chicken is amazing!', 'rating' => 5],
            ['customer_name' => 'Jane Smith', 'customer_image' => 'customer2.jpg', 'comment' => 'Loved the grilled menu!', 'rating' => 4],
        ]);
    }
}
