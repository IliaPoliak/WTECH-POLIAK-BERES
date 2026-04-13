<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemInBasket extends Model
{
    protected $table = 'items_in_basket';

    protected $fillable = [
        'user_id',
        'item_id',
        'quantity',
    ];

    public function size()
    {
        return $this->belongsTo(Size::class, 'item_id');
    }
}
