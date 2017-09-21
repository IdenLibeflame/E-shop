<?php

namespace App\Http\Controllers;

use App\Comment;
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

//        Разобрать
//        $user_id = Auth::id();
//
//        $product_id = Input::get('_productId');

        DB::table('comments')->insert([
            'comment' => $comment, 'user_id' => $user_id, 'product_id' => $product_id
        ]);

        return redirect()->back();
    }

    public function deleteComment($comment_id)
    {
        DB::table('comments')->where('id', $comment_id)->delete();

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

//        return response()->json(['new_comment' => $comment->comment], 200);
        return Response::json(['new_comment' => $comment->comment]);
    }
}
