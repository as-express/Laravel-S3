<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'imageUrl',
        'description',
        'price',
        'stock',
    ];
}
