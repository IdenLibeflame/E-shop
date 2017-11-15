@extends('layouts.header')

@section('content')

    <div class="alert alert-info">
        <h4 align="center">Last added Books </h4>
    </div>

    <div class="row">
        @forelse($newBooks as $newBook)
            @if($newBook->availability)
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        {{--<a href="book/{{ $product->id }}">--}}
                        <img src="{{ $newBook->image }}" alt="...">
                        {{--</a>--}}
                        <div class="caption">
                            <h4>"{{ $newBook->name }}"</h4>
                            <cite><h4 align="right">{{ $newBook->writer }}</h4></cite>
                            <p class="price">Price: ${{ $newBook->current_price }}</p>
                            <p>
                            <a href="{{ route('basket.addToBasket', ['id' => $newBook->id]) }}" class="btn btn-primary" role="button">Add to Basket</a>
                            <a href="{{ route('book', [$newBook->genre_name, $newBook->id]) }}" class="btn btn-default pull-right" role="button">More info</a>
                            </p>
                        </div>

                    </div>

                </div>
            @endif
        @empty
            <p class="alert alert-danger" align="center">We don't have new books, but it's temporary!</p>
        @endforelse
    </div>
    <div align="center">{{ $newBooks->render() }} </div>



    {{--<div class="container">--}}
        {{--<div class="col-xs-6 col-md-4 col-lg-3 cat" style="width: 220px">--}}
            {{--<a href="#" class="thumbnail" >--}}
                {{--<img src="https://www.e-reading.club/cover/1039/1039410.jpg" alt="...">--}}
            {{--</a>--}}
        {{--</div>--}}

        {{--<div class="col-xs-6 col-md-4 col-lg-3 cat">--}}
            {{--<a href="#" class="thumbnail" >--}}
                {{--<img src="https://www.e-reading.club/cover/1039/1039410.jpg" alt="...">--}}
            {{--</a>--}}
        {{--</div>--}}

        {{--<div class="col-xs-6 col-md-4 col-lg-3 cat" >--}}
            {{--<a href="#" class="thumbnail" >--}}
                {{--<img src="https://www.e-reading.club/cover/1039/1039410.jpg" alt="...">--}}
            {{--</a>--}}
        {{--</div>--}}

        {{--<div class="col-xs-6 col-md-4 col-lg-3 cat">--}}
            {{--<a href="#" class="thumbnail" >--}}
                {{--<img src="https://www.e-reading.club/cover/1039/1039410.jpg" alt="...">--}}
            {{--</a>--}}
        {{--</div>--}}

        {{--<div class="col-xs-6 col-md-4 col-lg-3 cat" style="margin: 10px -10px 0px 5px;">--}}
            {{--<a href="#" class="thumbnail" >--}}
                {{--<img src="https://www.e-reading.club/cover/1039/1039410.jpg" alt="...">--}}
            {{--</a>--}}
        {{--</div>--}}

        {{--<div class="col-xs-6 col-md-4 col-lg-3 cat" style="margin: 10px -10px 0px 5px;">--}}
            {{--<a href="#" class="thumbnail" >--}}
                {{--<img src="https://www.e-reading.club/cover/1039/1039410.jpg" alt="...">--}}
            {{--</a>--}}
        {{--</div>--}}

        {{--<div class="col-xs-6 col-md-4 col-lg-3 cat" style="margin: 10px -10px 0px 5px;">--}}
            {{--<a href="#" class="thumbnail" >--}}
                {{--<img src="https://www.e-reading.club/cover/1039/1039410.jpg" alt="...">--}}
            {{--</a>--}}
        {{--</div>--}}
    {{--</div>--}}

@endsection
