<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
    	'slug', 'title', 'image', 'bg_color', 'text_color', 'icon', 'hot'
    ];

    public function products()
    {
    	return $this->hasMany('App\Models\Product', 'category_id', 'id');
    }
}
