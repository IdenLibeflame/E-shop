@extends('layouts.header')

@section('content')

    {{--@foreach($bestsellers as $list)--}}

        {{--@foreach($list->basket->items as $item)--}}
            {{--<ul>--}}
                {{--<li>{{ $item['price'] }} $</li>--}}
                {{--{{ $item['item']['name'] }} | {{$item['qty']}}--}}
                {{--<ul>--}}
                    {{--<li>Total Price: {{ $list->basket->totalPrice }}</li>--}}
                {{--</ul>--}}
            {{--</ul>--}}
        {{--@endforeach--}}
    {{--@endforeach--}}



    <div class="container">
        <div class="col-xs-6 col-md-4 col-lg-3 cat" style="width: 220px">
            <a href="#" class="thumbnail" >
                <img src="https://www.e-reading.club/cover/1039/1039410.jpg" alt="...">
            </a>
        </div>

        <div class="col-xs-6 col-md-4 col-lg-3 cat">
            <a href="#" class="thumbnail" >
                <img src="https://www.e-reading.club/cover/1039/1039410.jpg" alt="...">
            </a>
        </div>

        <div class="col-xs-6 col-md-4 col-lg-3 cat" >
            <a href="#" class="thumbnail" >
                <img src="https://www.e-reading.club/cover/1039/1039410.jpg" alt="...">
            </a>
        </div>

        <div class="col-xs-6 col-md-4 col-lg-3 cat">
            <a href="#" class="thumbnail" >
                <img src="https://www.e-reading.club/cover/1039/1039410.jpg" alt="...">
            </a>
        </div>

        <div class="col-xs-6 col-md-4 col-lg-3 cat" style="margin: 10px -10px 0px 5px;">
            <a href="#" class="thumbnail" >
                <img src="https://www.e-reading.club/cover/1039/1039410.jpg" alt="...">
            </a>
        </div>

        <div class="col-xs-6 col-md-4 col-lg-3 cat" style="margin: 10px -10px 0px 5px;">
            <a href="#" class="thumbnail" >
                <img src="https://www.e-reading.club/cover/1039/1039410.jpg" alt="...">
            </a>
        </div>

        <div class="col-xs-6 col-md-4 col-lg-3 cat" style="margin: 10px -10px 0px 5px;">
            <a href="#" class="thumbnail" >
                <img src="https://www.e-reading.club/cover/1039/1039410.jpg" alt="...">
            </a>
        </div>
    </div>

@endsection
