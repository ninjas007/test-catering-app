<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'quantity',
        'order_id',
        'subtotal'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }

    // attribute subtotal from menu quantity * price
    public function getSubtotalAttribute()
    {
        return $this->menu->price * $this->quantity;
    }

}
