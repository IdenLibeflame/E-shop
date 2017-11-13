<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $dates = [
        'published_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function setPublishedAtAttribute($date)
    {
        $this->attributes['published_at'] = Carbon::createFromFormat('D-m-y', $date);
    }
}
