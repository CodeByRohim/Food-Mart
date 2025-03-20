<?php

namespace App\Models;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    // use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'discount',
        'image',
        'description_unit',
        'price',
        'amount',
        'stock',
        'is_active',
        ];
}
