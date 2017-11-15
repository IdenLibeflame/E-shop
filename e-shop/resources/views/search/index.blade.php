@extends('layouts.header')

@section('content')


    {{--{{  Form::open(['method'=>'GET','url'=>'search','class'=>'navbar-form navbar-left','role'=>'search'])  }}--}}
    {{--<a href="{{ url('search/{query}') }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Add</a>--}}

    {{--<div class="input-group custom-search-form">--}}
        {{--<input type="text" class="form-control" name="search" placeholder="Search...">--}}
        {{--<span class="input-group-btn">--}}
        {{--<button class="btn btn-default-sm" type="submit">--}}
            {{--<i class="fa fa-search"><!--<span class="hiddenGrammarError" pre="" data-mce-bogus="1"--></i>--}}
        {{--</button>--}}
    {{--</span>--}}
    {{--</div>--}}
    {{--{{ Form::close() }}--}}


    {{--<form action="/search/result" method="GET">--}}
        {{--<input type="text" name="query" value="" required/>--}}
        {{--<button type="submit">Submit</button>--}}
        {{--{!! csrf_field() !!}--}}
    {{--</form>--}}

<div class="container-fluid">
    <form class="navbar-form" action="/search/result" method="GET">
        <div class="form-group" >
            <input type="text" class="form-control" placeholder="Enter title or writer's name" name="query" value="" required>
        </div>
        <button type="submit" class="btn btn-default">Search</button>
        {!! csrf_field() !!}
    </form>
</div>
    @if(isset($results))
        <div class="row">
            @foreach($results as $result)
                @if($result->availability)
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            {{--<a href="book/{{ $product->id }}">--}}
                            <img src="{{ $result->image }}" alt="...">
                            {{--</a>--}}
                            <div class="caption">
                                <h4>"{{ $result->name }}"</h4>
                                <cite><h4 align="right">{{ $result->writer }}</h4></cite>
                                <p>
                                    <a href="{{ route('basket.addToBasket', ['id' => $result->id]) }}" class="btn btn-primary" role="button">Add to Basket</a>
                                    <a href="{{ route('book', [$result->genre_name, $result->id]) }}" class="btn btn-default pull-right" role="button">More info</a>
                                </p>
                            </div>

                        </div>

                    </div>
                @endif


            @endforeach

        </div>
        <div align="center">{{ $results->render()  }} </div>

    @endif




    {{--@foreach($newBooks as $newBook)--}}
        {{--@if($newBook->availability)--}}
            {{--<div class="col-sm-6 col-md-4">--}}
                {{--<div class="thumbnail">--}}
                    {{--<a href="book/{{ $product->id }}">--}}
                    {{--<img src="{{ $newBook->image }}" alt="...">--}}
                    {{--</a>--}}
                    {{--<div class="caption">--}}
                        {{--<h4>"{{ $newBook->name }}" - {{ $newBook->writer }}</h4>--}}
                        {{--<p>{{ $newBook->description }}</p>--}}
                        {{--<p>--}}
                        {{--<div class="pull-left price">{{ $newBook->current_price }}</div>--}}
                        {{--<a href="{{ route('basket.addToBasket', ['id' => $newBook->id]) }}" class="btn btn-primary" role="button">Add to Basket</a>--}}
                        {{--<a href="{{ route('book', [$newBook->genre_name, $newBook->id]) }}" class="btn btn-default pull-right" role="button">More info</a>--}}
                        {{--</p>--}}
                    {{--</div>--}}

                {{--</div>--}}

            {{--</div>--}}
        {{--@else--}}
            {{--<div align="center">--}}
                {{--<h1>We don't have books in genre {{ $name }}</h1>--}}
                {{--<h2>Don't worry! It's temporary!</h2></div>--}}
        {{--@endif--}}

    {{--@endforeach--}}

    {{--<form action="{{ route('/search/q'), ['q' => name] }}">--}}
        {{--<input type="text" name="name" placeholder="Input the title of book" value=""/>--}}
        {{--<input type="submit" name="submit" class="btn btn-default" value="Search"/>--}}
    {{--</form>--}}


@endsection