@extends('layouts.header')

@section('content')

    <div class="container-fluid">
        <form class="navbar-form" action="/search/result" method="GET">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Enter title or writer's name" name="query" value=""
                       required>
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
                            <img src="{{ $result->image }}" alt="...">
                            <div class="caption">
                                <h4>"{{ $result->name }}"</h4>
                                <cite><h4 align="right">{{ $result->writer }}</h4></cite>
                                <p class="price">Price: ${{ $result->current_price }}</p>
                                <p>
                                    <a href="{{ route('basket.addToBasket', ['id' => $result->id]) }}"
                                       class="btn btn-primary" role="button">Add to Basket</a>
                                    <a href="{{ route('book', [$result->genre_name, $result->id]) }}"
                                       class="btn btn-default pull-right" role="button">More info</a>
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div align="center">{{ $results->render()  }} </div>
    @endif
@endsection