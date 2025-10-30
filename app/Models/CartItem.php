<?php

namespace App\Models;
        
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = ['menu_item_id', 'quantity'];

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class, 'menu_item_id');
    }
}
