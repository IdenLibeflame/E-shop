<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{

    public function genres()
    {
        return $this->hasMany('App\Genre');
    }

    public function products()
    {
        return $this->hasMany('App\Genre');
    }
}
