<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
    public function createComment(Request $request)
    {
        $this->validate($request, [
            'comment' => 'max:4096',
        ]);

        $comment = $request['new-post'];
        $userId = $request['_userId'];
        $productId = $request['_productId'];

        Comment::insert(['comment' => $comment, 'user_id' => $userId, 'product_id' => $productId]);


        return redirect()->back();
    }

    public function deleteComment($comment_id)
    {
        $comment = Comment::where('id', $comment_id);
        $comment->delete();

        return redirect()->back();
    }


    public function editComment(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required'
        ]);

        $comment = Comment::find($request['commentId']);
        $comment->comment = $request['comment'];
        $comment->update();

        return response()->json(['new_comment' => $comment->comment], 200);
    }

    public function likeComment(Request $request)
    {
        $commentId = $request['commentId'];
        $isLike = $request['isLike'] === 'true';
        $comment = Comment::find($commentId);
        if (!$comment) {
            return null;
        }

        $user = Auth::user();
        $like = $user->likes()->where('comment_id', $commentId)->first();

        if ($like) {
            // Получаем значение поля "лайк", хранящееся в базе
            // (если он есть для этого коммента от этого юзера)
            $alreadyLike = $like->rating;
//            $update = true;
            if ($alreadyLike == $isLike) {
                // Если значение поля "лайк" в базе равно значению,
                // Переданному через форму - удаляем его (снимаем лайк)
                $like->delete();

                return response()->json(['rating' => $comment->rating()], 200);
            }
        } else {
            $like = new Like();
        }

        $like->rating = $isLike;
        $like->user_id = $user->id;
        $like->comment_id = $commentId;

        $like->save();

        return response()->json(['rating' => $comment->rating()], 200);
    }

}
