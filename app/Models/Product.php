<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'image'
    ];

    public function productsOffer()
    {
        return $this->hasMany(ProductOffer::class);
    }
}