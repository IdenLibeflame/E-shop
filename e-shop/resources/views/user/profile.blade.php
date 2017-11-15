@extends('layouts.header')
@section('content')
    <br>
    <div class="panel panel-info book_info" style="width: 45%; display:inline-block; float: left">
        <div class="panel-heading">Your name:</div>
        <div class="panel-body"> {{ auth()->user()->name }}</div>
    </div>
    <div class="panel panel-info book_info" style="width: 45%; display:inline-block; float: right">
        <div class="panel-heading">Your email:</div>
        <div class="panel-body"> {{ auth()->user()->email }}</div>
    </div>

    @foreach($orderList as $list)
        {{--<hr class="hr">--}}

        <div class="panel panel-info book_info3" >
            <div class="panel-heading">Date of purchase:</div>
            <div class="panel-body"> {{ $list->created_at }}</div>
        </div>


            @foreach($list->basket->items as $item)
                <ul>
{{--                    <li>Data: {{ $item['created_at'] }}</li>--}}
                    <div class="panel panel-primary book_info2" >
                        <div class="panel-heading">Title:</div>
                        <div class="panel-body" >"{{ $item['item']['name'] }}"</div>
                    </div>
                    <div class="panel panel-success book_info3" >
                        <div class="panel-heading">Author:</div>
                        <div class="panel-body">{{ $item['item']['writer'] }}</div>
                    </div>
                    <div class="panel panel-info book_info3" >
                        <div class="panel-heading">Quantity:</div>
                        <div class="panel-body">{{ $item['qty'] }}</div>
                    </div>
                    <div class="panel panel-danger book_info3">
                        <div class="panel-heading">Price:</div>
                        <div class="panel-body price">${{ $item['price'] }}</div>
                    </div>
                </ul>
            @endforeach
        <div class="panel panel-danger book_info">
            <div class="panel-heading">Total Price:</div>
            <div class="panel-body price">${{ $list->basket->totalPrice }}</div>
        </div>
        <hr class="hr" color="black">
    @endforeach
@endsection







