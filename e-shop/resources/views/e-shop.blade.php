@extends('layouts.header')

@section('content')

    <div class="alert alert-info">
        <h4 align="center">New added Books </h4>
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
                                <a href="{{ route('basket.addToBasket', ['id' => $newBook->id]) }}"
                                   class="btn btn-primary" role="button">Add to Basket</a>
                                <a href="{{ route('book', [$newBook->genre_name, $newBook->id]) }}"
                                   class="btn btn-default pull-right" role="button">More info</a>
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
@endsection
