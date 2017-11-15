<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Genre;
use App\Like;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{


    public function products($name)
    {
        $products = null;

        $products = Product::where('genre_name', $name)->paginate(3);

        if ($products->count()) {
            return view('products', compact(['products', 'name']));
        } else {
            return view('products', compact(['products', 'name']));
        }
    }


    public function product($genreName, $id)
    {
        $book = Product::where('genre_name', $genreName)->where('id', $id)->first();

        if (!$book) {
            abort(404);
        }

        $allComments = Product::find($id)->comments;
        $ratings = Like::showRating($allComments);

        return view('book', compact('book', 'comments', 'ratings'));

    }

    public function search()
    {
        $query = request()->input('query');
        $results = Product::search($query)->paginate(3);

        return view('search.index', compact('results'));
    }

    public function newBooks()
    {
        $newBooks = Product::orderBy('created_at', 'desc')->paginate(3);

        return view('e-shop', compact('newBooks'));
    }
}

