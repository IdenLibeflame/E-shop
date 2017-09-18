<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    public function createComment(Request $request)
    {
//        $this->validate($request, [
//            'comment' => 'required|max: 1000'
//        ]);

//        dd($request);
//        $comment = new Comment();
//        $comment->user_id = $request->session()->previousUrl();
        $ca = Auth::id();
//        $c = $request->get('_productId');
//                $c = $request->input('_productId');

        $aa = Input::get('_productId');
//dd($aa);
//        $comment->comment = $request['comment'];
//        $request->user()->comments()->save($comment);
        return redirect()->back();
    }
}
