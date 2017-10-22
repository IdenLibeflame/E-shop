@extends('layouts.header')
@section('content')
    @foreach($orderList as $list)

            @foreach($list->basket->items as $item)
                <ul>
                    <li>{{ $item['price'] }} $</li>
                    {{ $item['item']['name'] }} | {{$item['qty']}}
                    <ul>
                        <li>Total Price: {{ $list->basket->totalPrice }}</li>
                    </ul>
                </ul>
            @endforeach
    @endforeach
@endsection
