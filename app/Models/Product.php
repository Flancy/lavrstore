<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    	'title', 'image', 'gallery', 'content', 'short_content', 'article', 'rating', 'regular_price', 'discount_price', 'category_id', 'hot'
    ];

    public function categories()
    {
    	return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }
}
