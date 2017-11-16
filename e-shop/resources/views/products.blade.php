@extends('layouts.header')

@section('content')
    <div align="center" class="alert alert-success">
        <h4>{{ $name }}</h4>
    </div>


    <div class="row">
        @forelse($products as $product)
            @if($product->availability)
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="{{ $product->image }}" alt="...">
                        <div class="caption">
                            <h4>"{{ $product->name }}"</h4>
                            <cite><h4 align="right">{{ $product->writer }}</h4></cite>
                            <p class="price">Price: ${{ $product->current_price }}</p>
                            <p>
                                <a href="{{ route('basket.addToBasket', ['id' => $product->id]) }}"
                                   class="btn btn-primary" role="button">Add to Basket</a>
                                <a href="{{ route('book', [$product->genre_name, $product->id]) }}"
                                   class="btn btn-default pull-right" role="button">More info</a>
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <div align="center">
                <h1>We don't have books in genre {{ $name }}</h1>
                <h2>Don't worry! It's temporary!</h2>
            </div>
        @endforelse
    </div>
    <div align="center">{!! $products->render() !!}</div>
@endsection

