@extends('layouts.header')

@section('content')
    <div align="center">
        {{ $name }}
    </div>


    <div class="row">
        @forelse($products as $product)
            @if($product->availability)
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
            {{--<a href="book/{{ $product->id }}">--}}
                <img src="{{ $product->image }}" alt="...">
            {{--</a>--}}
                <div class="caption">
                    <h4>"{{ $product->name }}" - {{ $product->writer }}</h4>
                    <p>{{ $product->description }}</p>
                    <p>
                        <div class="pull-left price">{{ $product->current_price }}</div>
                        <a href="{{ route('basket.addToBasket', ['id' => $product->id]) }}" class="btn btn-primary" role="button">Add to Cart</a>
                        <a href="{{ route('book', [$name, $product->id]) }}" class="btn btn-default pull-right" role="button">More info</a>
                    </p>
                </div>

            </div>

        </div>
            @else
                <div align="center">
                    <h1>We don't have books in genre {{ $name }}</h1>
                    <h2>Don't worry! It's temporary!</h2></div>
            @endif
        @empty
            <div align="center">
                <h1>We don't have books in genre {{ $name }}</h1>
                <h2>Don't worry! It's temporary!</h2>
            </div>
        @endforelse
            {!! $products->render() !!}

    </div>
@endsection

