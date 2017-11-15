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

        // Валидация

        $comment = $request['new-post'];
        $user_id = $request['_userId'];
        $product_id = $request['_productId'];

        Comment::insert(['comment' => $comment, 'user_id' => $user_id, 'product_id' => $product_id]);

//        DB::table('comments')->insert([
//            'comment' => $comment, 'user_id' => $user_id, 'product_id' => $product_id
//        ]);

        return redirect()->back();
    }

    public function deleteComment($comment_id)
    {
//        DB::table('comments')->where('id', $comment_id)->delete();
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
        $comment_id = $request['commentId'];
        $is_like = $request['isLike'] === 'true';
        $comment = Comment::find($comment_id);
        if (!$comment) {
            return null;
        }

        $user = Auth::user();
        $like = $user->likes()->where('comment_id', $comment_id)->first();

        if ($like) {
            // Получаем значение поля "лайк", хранящееся в базе
            // (если он есть для этого коммента от этого юзера)
            $already_like = $like->rating;
//            $update = true;
            if ($already_like == $is_like) {
                // Если значение поля "лайк" в базе равно значению,
                // Переданному через форму - удаляем его (снимаем лайк)
                $like->delete();

                return response()->json(['rating' => $comment->rating()], 200);
            }
        } else {
            $like = new Like();
        }

        $like->rating = $is_like;
        $like->user_id = $user->id;
        $like->comment_id = $comment_id;

        $like->save();

        return response()->json(['rating' => $comment->rating()], 200);
    }

}
