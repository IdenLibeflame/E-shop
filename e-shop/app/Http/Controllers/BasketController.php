<?php

namespace App\Http\Controllers;

use App\Basket;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BasketController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('basket.index', compact('products'));
    }

    public function addToBasket(Request $request, $id)
    {
        $product = Product::find($id);
        $oldBasket = Session::has('basket') ? Session::get('basket') : null;
        $basket = new Basket($oldBasket);
        $basket->add($product, $product->id);
//        dd($basket);
        $request->session()->put('basket', $basket);
//        dd($request->session()->get('basket'));
        return redirect()->back();
    }

    public function getBasket()
    {
        if (!Session::has('basket')) {
            return view('basket.index');
        }

        $oldBasket = Session::get('basket');
        $basket = new Basket($oldBasket);

        return view('basket.index', ['products' => $basket->items, 'totalPrice' => $basket->totalPrice,]);
//        return view('basket.index', compact(['items', 'totalPrice']));

    }
}