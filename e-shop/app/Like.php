<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

    public function comment()
    {
        return $this->belongsTo('App\Comment');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function showRating($commentsId)
    {
        static $results = [];
        foreach ($commentsId as $commentId) {

            $likes = Like::where('comment_id', $commentId->id)->where('rating', 1)->count();

            $dislikes = Like::where('comment_id', $commentId->id)->where('rating', 0)->count();

            $result = $likes - $dislikes;

            $results = array_add($results, $commentId->id, $result);
        }

        return $results;

//        $likes = Like::where('comment_id', $commentId)->where('rating', 1)->count();
//
//
//
//        if (Like::where('comment_id', $commentId)) {
//            $likes = Like::where('comment_id', $commentId)->where('rating', 1)->count();
//
//            $dislikes = Like::where('comment_id', $commentId)->where('rating', 0)->count();
//
//            return $result = $likes - $dislikes;
//        } else {
//            return $result = 0;
//        }




    }
}
