<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemInOrder extends Model
{
    protected $table = 'items_in_orders';

    protected $fillable = [
        'order_id',
        'item_id',
        'quantity',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'item_id');
    }
}
