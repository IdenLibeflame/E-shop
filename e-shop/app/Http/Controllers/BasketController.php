<?php

namespace App\Http\Controllers;

use App\Basket;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Stripe\Customer;
use Stripe\Stripe;
use Stripe\Charge;

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

    public function reduceByOne($id)
    {
        $oldBasket = Session::has('basket') ? Session::get('basket') : null;
        $basket = new Basket($oldBasket);
        $basket->reduceByOne($id);

        if (count($basket->items)) {
            Session::put('basket', $basket);
        } else {
            Session::forget('basket');
        }

        return redirect()->back();
    }

    public function removeItem($id)
    {
        $oldBasket = Session::has('basket') ? Session::get('basket') : null;
        $basket = new Basket($oldBasket);
        $basket->reduceItem($id);

        if (count($basket->items)) {
            Session::put('basket', $basket);
        } else {
            Session::forget('basket');
        }

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

    public function getCheckout()
    {
        if (!Session::has('basket')) {
            return view('basket.index');
        }

        $oldBasket = Session::get('basket');
        $basket = new Basket($oldBasket);
        $total = $basket->totalPrice;
        return view('basket.checkout', compact('total'));
    }

    public function postCheckout(Request $request)
    {
        if (!Session::has('basket')) {
            return redirect()->route('basket.index');
        }
        $oldBasket = Session::get('basket');
        $basket = new Basket($oldBasket);

        Stripe::setApiKey('sk_test_oZVNrFVvcQ7W7MujpdSO9uCA');
        try {
            $charge = Charge::create(array(
                "amount" => $basket->totalPrice * 100,
                "currency" => "usd",
                "source" => $request->input('stripeToken'), // obtained with Stripe.js
                "description" => "Test Charge"
            ));

            $order = new Order();
            $order->basket = serialize($basket);
            $order->address = $request->input('address');
            $order->name = $request->input('name');
            $order->payment_id = $charge->id;
            Auth::user()->orders()->save($order);

        } catch (\Exception $e) {
            return redirect()->route('checkout')->with('error', $e->getMessage());
        }


        Session::forget('basket');
        return redirect()->route('basket.index')->with('success', 'Successfully purchased products!');
    }
}