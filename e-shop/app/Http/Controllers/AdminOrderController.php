<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function showAllOrders()
    {
        $orders = Order::paginate(10);

        return view('admin.orders.showOrders', compact('orders'));
    }

    public function processedOrders()
    {
        $orders = Order::where('status', 1)->get();

        return view('admin.orders.processedOrders', compact('orders'));
    }

    public function unprocessedOrders()
    {
        $orders = Order::where('status', 0)->get();

        return view('admin.orders.unprocessedOrders', compact('orders'));
    }

    public function showOrder($orderId)
    {
        $order = Order::where('id', $orderId)->get();

        $order->transform(function ($order, $key) {
            $order->basket = unserialize($order->basket);
            return $order;
        });

//        dd($order);

        return view('admin.orders.processingOrder', compact('order'));
    }

    public function processingOrder(Request $request)
    {
        $order = Order::find($request->id);
//        $order->user_id = $request->user_id;
//        $order->name = $request->name;
//        $order->email = $request->email;
//        $order->address = $request->address;
//        $order->basket = serialize($request->basket);
//        $order->payment_id = $request->payment_id;
        $order->status = $request->status;

        $order->update();

        return redirect()->to('admin/showOrders');

    }
}
