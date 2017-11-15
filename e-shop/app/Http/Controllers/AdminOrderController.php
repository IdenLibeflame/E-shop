<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function showAllOrders()
    {
        $orders = Order::paginate(3);

        return view('admin.orders.showOrders', compact('orders'));
    }

    public function processedOrders()
    {
        $orders = Order::where('status', 1)->paginate(3);

        return view('admin.orders.processedOrders', compact('orders'));
    }

    public function unprocessedOrders()
    {
        $orders = Order::where('status', 0)->paginate(3);

        return view('admin.orders.unprocessedOrders', compact('orders'));
    }

    public function showOrder($orderId)
    {
        $order = Order::where('id', $orderId)->get();

        $order->transform(function ($order, $key) {
            $order->basket = unserialize($order->basket);
            return $order;
        });

        return view('admin.orders.processingOrder', compact('order'));
    }

    public function processingOrder(Request $request)
    {
        $order = Order::find($request->id);
        $order->status = $request->status;

        $order->update();

        return redirect()->to('admin/showOrders');

    }
}
