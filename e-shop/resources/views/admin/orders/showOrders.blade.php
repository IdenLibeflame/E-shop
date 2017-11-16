@extends('layouts.header')

@section('content')
    <div>
        <br>
        <a href="{{ route('admin/processedOrders') }}" class="btn btn-success">Show processed orders</a>
        <a href="{{ route('admin/unprocessedOrders') }}" class="btn btn-danger">Show unprocessed orders</a>
    </div>
    <div class="container ">
        @foreach($orders as $order)
            <div class="col-xs-6 col-md-4 col-lg-4">
                <h3>{{ $order->name }}</h3>
                <p>{{ $order->created_at }}</p>
                <a href="{{ route('admin/showOrder', ['order_id' => $order->id]) }}" class="btn btn-warning">Change
                    status</a>
            </div>
        @endforeach

    </div>
    <div align="center">{{ $orders->render() }}</div>
@endsection
