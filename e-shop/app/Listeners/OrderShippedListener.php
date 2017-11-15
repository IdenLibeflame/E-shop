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
        $orderData = Order::where('id', $event->orderId)->get();
        $orderData->transform(function ($order, $key) {
            $order->basket = unserialize($order->basket);
            return $order;
        });

        Mail::to($orderData[0]->email)->send(new \App\Mail\OrderShipped($orderData));

    }
}
