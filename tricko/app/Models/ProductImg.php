<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImg extends Model
{
    protected $fillable = [
        'product_id',
        'image',
        'order_number',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
