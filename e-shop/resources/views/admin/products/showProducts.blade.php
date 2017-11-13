@extends('layouts.header')

@section('content')
    <ul>
        <a href="createProduct">Create a new product</a>

        <form action="{{ route('adminSearch') }}" method="GET">
            <input type="text" name="query" required/>
            <button type="submit">Search</button>
            {!! csrf_field() !!}
        </form>

        @if(isset($results))
            <ul>
                @foreach($results as $result)
                    <li><h1>{{ $result->name }}</h1></li>
                    <li>{{ $result->id }}</li>
                    <li>{{ $result->writer }}</li>
                    <li>{{ $result->description }}</li>
                    <li>{{ $result->price }}</li>
                    <li>{{ $result->current_price }}</li>
                    <li>{{ $result->discount }}</li>
                    <li>{{ $result->genre_name }}</li>
                    <img src="{{ $result->image }}" alt="..." style="max-height: 250px; max-width: 150px">
                    <a href="{{ route('admin/editProduct', ['product_id' => $result->id]) }}">Edit product</a>
                    <a href="{{ route('admin/deleteProduct', ['product_id' => $result->id]) }}">Delete product</a>
                @endforeach
                {!! $results->render() !!}
            </ul>
        @else
            @foreach($products as $product)
                <li><h1>{{ $product->name }}</h1></li>
                <li>{{ $product->id }}</li>
                <li>{{ $product->writer }}</li>
                <li>{{ $product->description }}</li>
                <li>{{ $product->price }}</li>
                <li>{{ $product->current_price }}</li>
                <li>{{ $product->discount }}</li>
                <li>{{ $product->genre_name }}</li>
                <img src="{{ $product->image }}" alt="..." style="max-height: 250px; max-width: 150px">
                <a href="{{ route('admin/editProduct', ['product_id' => $product->id]) }}">Edit product</a>
                <a href="{{ route('admin/deleteProduct', ['product_id' => $product->id]) }}">Delete product</a>
            @endforeach
            {!! $products->render() !!}
        @endif




        {{--@if(session('results'))--}}
            {{--<ul>--}}
                {{--@foreach(session('results') as $result)--}}
                    {{--<li><h1>{{ $result->name }}</h1></li>--}}
                    {{--<li>{{ $result->id }}</li>--}}
                    {{--<li>{{ $result->writer }}</li>--}}
                    {{--<li>{{ $result->description }}</li>--}}
                    {{--<li>{{ $result->price }}</li>--}}
                    {{--<li>{{ $result->current_price }}</li>--}}
                    {{--<li>{{ $result->discount }}</li>--}}
                    {{--<li>{{ $result->genre_name }}</li>--}}
                    {{--<img src="{{ $result->image }}" alt="..." style="max-height: 250px; max-width: 150px">--}}
                    {{--<a href="{{ route('admin/editProduct', ['product_id' => $result->id]) }}">Edit product</a>--}}
                    {{--<a href="{{ route('admin/deleteProduct', ['product_id' => $result->id]) }}">Delete product</a>--}}
                {{--@endforeach--}}
            {{--</ul>--}}
        {{--@else--}}
            {{--@foreach($products as $product)--}}
                {{--<li><h1>{{ $product->name }}</h1></li>--}}
                {{--<li>{{ $product->id }}</li>--}}
                {{--<li>{{ $product->writer }}</li>--}}
                {{--<li>{{ $product->description }}</li>--}}
                {{--<li>{{ $product->price }}</li>--}}
                {{--<li>{{ $product->current_price }}</li>--}}
                {{--<li>{{ $product->discount }}</li>--}}
                {{--<li>{{ $product->genre_name }}</li>--}}
                {{--<img src="{{ $product->image }}" alt="..." style="max-height: 250px; max-width: 150px">--}}
                {{--<a href="{{ route('admin/editProduct', ['product_id' => $product->id]) }}">Edit product</a>--}}
                {{--<a href="{{ route('admin/deleteProduct', ['product_id' => $product->id]) }}">Delete product</a>--}}
            {{--@endforeach--}}
                {{--{!! $products->render() !!}--}}
        {{--@endif--}}


    </ul>

@endsection

