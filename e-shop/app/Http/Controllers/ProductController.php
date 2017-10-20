<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Genre;
use App\Like;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{


    public function products($name)
    {
        $products = null;

        $products = Product::where('genre_name', $name)->paginate(5);

        if ($products->count()) {
            return view('products', compact(['products', 'name']));
        } else {
            return view('products', compact(['products', 'name']));
        }
    }


    public function product($genreName, $id)
    {
//        $comments = DB::table('comments')
//                            ->where('product_id', $book_id)
//                            ->get();
        $book = Product::where('genre_name', $genreName)->where('id', $id)->first();

        if (!$book) {
            abort(404);
        }

        $allComments = Product::find(1)->comments->where('product_id', $id);
//        dd($allComments[1]->comment);
        $ratings = Like::showRating($allComments);
//        dd($rating);
//        $book = Product::where('id', $id)->get();


        return view('book', compact('book', 'comments', 'ratings'));
//        return view('book', compact(['book', 'productComments', 'nameOfWriterComment', 'count']));

    }

    public function search()
    {

        $name = request()->input('name');

        $results = Product::search($name)->get();

        return back()->with('results', $results);
    }
}

