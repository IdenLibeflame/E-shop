<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $orderList = Order::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();
        $orderList->transform(function ($order, $key) {
            $order->basket = unserialize($order->basket);
            return $order;
        });
        return view('user.profile', compact('orderList'));
    }
}
