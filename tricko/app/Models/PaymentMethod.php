<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = [
        'type',
        'card_number',
        'expiration_date_month',
        'expiration_date_year',
        'cvv',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
