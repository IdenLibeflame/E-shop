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

    // Мутатор

    public function getCurrentPriceAttribute()
    {
        return $this->discount > 0 ? $this->price - $this->price * $this->discount : $this->price;

    }
}
