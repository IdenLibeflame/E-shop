<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function category()
    {
        return $this->belongsTo('App\Genre');
    }
}
