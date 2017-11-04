<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function likesCount()
    {
        return $this->likes()->where('rating', 1)->count();
    }

    public function dislikesCount()
    {
        return $this->likes()->where('rating', 0)->count();
    }

    public function rating()
    {
        return $this->likesCount() - $this->dislikesCount();
    }
}
