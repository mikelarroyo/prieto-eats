<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'date_delivery',
        'time_delivery',
        'datetime_limit'
    ];

    protected $casts = [
        'date_delivery' => 'date',
    ];

    public function productsOffer()
    {
        return $this->hasMany(ProductOffer::class);
    }
}
