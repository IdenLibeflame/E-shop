<?php

namespace App\Http\Controllers;

use App\Basket;
use App\Events\OrderShipped;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Session;
use Stripe\Customer;
use Stripe\Error\Card;
use Stripe\Stripe;
use Stripe\Charge;

class BasketController extends Controller
{
    public function addToBasket(Request $request, $id)
    {
        $product = Product::find($id);
        $oldBasket = Session::has('basket') ? Session::get('basket') : null;
        $basket = new Basket($oldBasket);
        $basket->add($product, $product->id);
        $request->session()->put('basket', $basket);

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
    }

    public function postCheckout()
    {
        if (!Session::has('basket')) {
            return redirect()->route('basket.index');
        }
        $oldBasket = Session::get('basket');
        $basket = new Basket($oldBasket);

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $customer = Customer::create([
                'email' => request('stripeEmail'),
                'source' => request('stripeToken'),
            ]);

            $charge = Charge::create([
                'customer' => $customer->id,
                'amount' => $basket->totalPrice * 100,
                'currency' => 'usd'
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        $order = new Order();
        $order->user_id = auth()->id();
        $order->name = Auth::user()->name;
        $order->email = Auth::user()->email;
        $order->country = request('shipping_address_country');
        $order->country_code = request('shipping_address_country_code');
        $order->city = request('shipping_address_city');
        $order->street = request('shipping_address_line1');
        $order->zip_code = request('shipping_address_zip');
        $order->basket = serialize($basket);
        $order->payment_id = $charge->id;
        $order->customer_id = $charge->customer;

        $newOrder = Auth::user()->orders()->save($order);

        event(new OrderShipped($newOrder->id));

        Session::forget('basket');
        Session::flash('Success', 'Payment was successful!');

        return redirect()->route('/');


    }
}