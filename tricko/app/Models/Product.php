<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category',
        'gender',
        'price',
        'color',
        //'image',
    ];

    public function sizes()
    {
        return $this->hasMany(Size::class);
    }

    public function imgs()
    {
        return $this->hasMany(ProductImg::class);
    }
}
