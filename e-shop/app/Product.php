<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use Searchable;

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function category()
    {
        return $this->belongsTo('App\Genre');
    }

    public function searchableAs()
    {
        return 'name';
    }

    // Мутаторы

    public function getCurrentPriceAttribute()
    {
        if ($this->discount > 0) {
            return number_format($current_price = $this->price - $this->price * $this->discount, 2);
        } else {
            return number_format($current_price = $this->price, 2);
        }

    }

    public function getImageNameAttribute()
    {
        return $this->imageName = explode('/', $this->image);
    }
}
