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
//    public function index()
//    {
//        $products = Product::all();
//        dd($products);
//        return view('basket.index', compact('products'));
//    }

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

//    public function getCheckout()
//    {
//        if (!Session::has('basket')) {
//            return view('basket.index');
//        }
//
//        $oldBasket = Session::get('basket');
//        $basket = new Basket($oldBasket);
//        $total = $basket->totalPrice;
//        return view('basket.checkout', compact('total'));
//    }

    public function postCheckout()
    {


        if (!Session::has('basket')) {
            return redirect()->route('basket.index');
        }
        $oldBasket = Session::get('basket');
        $basket = new Basket($oldBasket);

        Stripe::setApiKey(config('services.stripe.secret'));

        $customer = Customer::create([
           'email' => request('stripeEmail'),
            'source' => request('stripeToken')
        ]);

        $charge = Charge::create([
            'customer' => $customer->id,
            'amount' => $basket->totalPrice * 100,
            'currency' => 'usd'
        ]);


        $order = new Order();
        $order->user_id = auth()->id();
        $order->name = Auth::user()->name;
        $order->email = Auth::user()->email;
        $order->address = Auth::user()->address;
        $order->basket = serialize($basket);
        $order->payment_id = $charge->id;

        $newOrder = Auth::user()->orders()->save($order);

        event(new OrderShipped($newOrder->id));

        Session::forget('basket');
        Session::flash('Success' ,'Payment was successful!');
        return redirect()->route('/');


//        try {
//            Charge::create(array(
//                "amount" => $basket->totalPrice * 100,
//                "currency" => "usd",
//                "source" => $request->input('stripeToken'), // obtained with Stripe.js
//                "description" => "Test Charge",
//                "customer" => auth()->id()
//            ));
//
////            $order = new Order();
////            $order->basket = serialize($basket);
////            $order->address = $request->input('address');
////            $order->name = $request->input('name');
////            $order->payment_id = $charge->id;
////            Auth::user()->orders()->save($order);
//
//        } catch (\Exception $e) {
//            return redirect()->route('checkout')->with('error', $e->getMessage());
//        }
//
//
//        Session::forget('basket');
//        return redirect()->route('basket.index')->with('success', 'Successfully purchased products!');
    }

//    public function postCheckout(Request $request)
//    {
//        if (!Session::has('basket')) {
//            return redirect()->route('basket.index');
//        }
//        $oldBasket = Session::get('basket');
//        $basket = new Basket($oldBasket);
//
//        return $this->chargeCustomer($basket->items, $basket->totalQuantity, $basket->totalPrice, $request->input('stripeToken'));
//    }
//
//    public function chargeCustomer($items, $totalQuantity, $totalPrice, $token)
//    {
//        Stripe::setApiKey(env('STRIPE_SECRET'));
//
//        if (!$this->isStripeCustomer())
//        {
//            $customer = $this->createStripeCustomer($token);
//        }
//        else
//        {
//            $customer = Customer::retrieve(Auth::user()->stripe_id);
//        }
//
//        return $this->createStripeCharge($items, $totalQuantity, $totalPrice, $customer);
//    }
//
//    public function createStripeCharge($items, $totalQuantity, $totalPrice, $customer)
//    {
//        try {
//            $charge = Charge::create(array(
//                "amount" => $totalPrice,
//                "currency" => "brl",
//                "customer" => $customer->id,
//                "description" => $items
//            ));
//        } catch(Card $e) {
//            return redirect()
//                ->route('/')
//                ->with('error', 'Your credit card was been declined. Please try again or contact us.');
//        }
//
//        return $this->postStoreOrder($items);
//    }
//
//    public function createStripeCustomer($token)
//    {
//        Stripe::setApiKey(env('STRIPE_SECRET'));
//
//        $customer = Customer::create(array(
//            "description" => Auth::user()->email,
//            "source" => $token
//        ));
//
//        Auth::user()->stripe_id = $customer->id;
//        Auth::user()->save();
//
//        return $customer;
//    }
//
//    public function isStripeCustomer()
//    {
//        return Auth::user() && User::where('id', Auth::user()->id)->whereNotNull('stripe_id')->first();
//    }
//
//    public function postStoreOrder($product_name)
//    {
//        Order::create([
//            'email' => Auth::user()->email,
//            'product' => $product_name
//        ]);
//
//        return redirect()
//            ->route('/')
//            ->with('msg', 'Thanks for your purchase!');
//    }
}