@extends('layouts.header')

@section('content')
    <ul>
        @forelse($orders as $order)
            <li><h1>{{ $order->name }}</h1></li>
            <img src="{{ $order->image }}" alt="..." style="max-height: 250px; max-width: 150px">
            <a href="{{ route('admin/showOrder', ['order_id' => $order->id]) }}">Processing</a>
        @empty
            <div align="center">
                <h1>All orders are successfully processed!</h1>
            </div>
        @endforelse

    </ul>

    {{--{!! $orders->render() !!}--}}
@endsection

