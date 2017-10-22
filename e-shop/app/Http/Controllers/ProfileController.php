<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
//        dd(auth()->id());
        $orderList = Order::where('user_id', auth()->id())->get();
        $orderList->transform(function ($order, $key) {
            $order->basket = unserialize($order->basket);
            return $order;
        });
//        dd($orderList);
        return view('user.profile', compact('orderList'));
    }
}
