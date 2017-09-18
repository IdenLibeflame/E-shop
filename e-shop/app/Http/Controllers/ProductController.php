<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Genre;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function product($name)
    {
//        $products = Product::all();

        $products = DB::table('products')->get();
//        $comments = DB::table('comments')->get();
        static $count = 0;
//        static $productComments = [];



        foreach ($products as $product) {
            if ($product->genre_name == $name) {
                if ($product->discount > 0) {
                    $product->current_price = $product->price - $product->price * $product->discount;
                    DB::table('products')
                        ->where('id', $product->id)
                        ->update(['current_price' => $product->current_price]);

                    $temps = DB::table('products')
                        ->where('genre_name', $name)->get();

                    $count++;

//                    foreach ($comments as $comment) {
//                        if ($comment->product_id = $product->id)
//                            array_push($productComments, $comment->comment);
//                            array_push($commentsById, $comment->product_id);
//
//                    }
//
//                    $test = array_unique($commentsById);


//                    return view('products', compact(['temps', 'name', 'productComments', 'test']));

                    return view('products', compact(['temps', 'name']));

                } else {
                    $product->current_price = $product->price;
                    DB::table('product')
                        ->where('id', $product->id)
                        ->update('current_price', $product->current_price);

                    $temps = DB::table('products')
                        ->where('genre_name', $name)->get();

                    $count++;

//                    foreach ($comments as $comment) {
//                        if ($comment->product_id = $product->id)
//                            array_push($productComments, $comment->comment);
//                            array_push($commentsById, $comment->product_id);
//                    }

//                    $test = array_unique($commentsById);

//                    return view('products', compact(['temps', 'name', 'productComments', 'test']));

                    return view('products', compact(['temps', 'name']));

                }
            }
        }
        if ($count === 0) {
            return view("empty");
        }
    }


    public function book($a, $book_id)
    {


//        static $productComments = [];
//        static $writerComments = [];
//        static $count = 0;
        static $unique_product_id = [];

//        $comments = DB::table('comments')
//                            ->where('product_id', $book_id)
//                            ->get();

        $comments = Comment::all()->where('product_id', $book_id);

//        $book = DB::table('products')
//                        ->where('id', $book_id)
//                        ->get();


        $book = Product::all()->where('id', $book_id);


//            foreach ($comments as $comment) {
//                $user_products_ID = DB::table('users')
//                                            ->where('id', $comment->user_id)
//                                            ->get();
//                array_push($productComments, $comment->comment);
////                array_push($writerComments, $user_products_ID);
//
////                $count++;
//            }


//            foreach ($writerComments as $writerComment) {
//                foreach ($writerComment as $item) {
//                    array_push($nameOfWriterComment, $item->name);
//                }
//            }

        return view('book', compact(['book', 'comments', 'book_id']));
//        return view('book', compact(['book', 'productComments', 'nameOfWriterComment', 'count']));

    }
}

