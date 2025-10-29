<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $table = 'menu_items';

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category',
        'is_popular',
        'discount'
    ];
}
