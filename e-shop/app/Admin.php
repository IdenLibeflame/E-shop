<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
//    public function getAllGenres()
//    {
//        $genres = Genre::all();
//    }

//    public function getAllProducts()
//    {
//        $products = Product::all();
//    }

    public function genres()
    {
        return $this->hasMany('App\Genre');
    }
}
