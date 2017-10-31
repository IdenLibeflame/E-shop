@extends('layouts.header')

@section('content')
    <ul>
        <a href="{{ route('admin/processedOrders') }}">Show processed orders</a>
        <a href="{{ route('admin/unprocessedOrders') }}">Show unprocessed orders</a>
        @foreach($orders as $order)
            <li><h1>{{ $order->name }}</h1></li>
            <img src="{{ $order->image }}" alt="..." style="max-height: 250px; max-width: 150px">
            <a href="{{ route('admin/showOrder', ['order_id' => $order->id]) }}">Processing</a>
        
        @endforeach

    </ul>

    {!! $orders->render() !!}
@endsection

