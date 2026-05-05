<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryMethod extends Model
{
    protected $fillable = [
        'type',
        'country',
        'city',
        'postal_code',
        'address',
        'phone_number',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
