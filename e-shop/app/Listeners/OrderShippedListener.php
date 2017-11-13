<?php

namespace App\Listeners;

use App\Events\OrderShipped;
use App\Order;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class OrderShippedListener
{
    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderShipped  $event
     * @return void
     */
    public function handle(OrderShipped $event)
    {
//        $order = Order::find(1)->where('id', $event->orderId);
        $orderData = Order::where('id', $event->orderId)->get();
        $orderData->transform(function ($order, $key) {
            $order->basket = unserialize($order->basket);
            return $order;
        });

//        dispatch(new SendEmail($orderData));
//        $orderData = [
//            'name' => $order->name,
//            'email' => $order->email,
//            'address' => $order->address,
//            'basket' => unserialize($order->basket),
//        ];
//        dd($orderData[0]->email);
        Mail::to($orderData[0]->email)->send(new \App\Mail\OrderShipped($orderData));

    }
}
