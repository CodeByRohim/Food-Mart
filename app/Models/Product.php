<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    // use HashFactory;
    protected $fillable = [
        'name',
        'discount',
        'image',
        'description/unit',
        'price',
        'amount',
        'stock',
        'is_active',
        ];
}
