<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    	'oblast', 'city', 'postcode', 'street', 'phone', 'email', 'comment', 'pay', 'total', 'products', 'promocode'
    ];

    protected $casts = [
        'products' => 'array'
    ];
}
