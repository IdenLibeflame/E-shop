@extends('layouts.header')

@section('content')

    <br>
    <a href="{{ route('admin/createProduct') }}" class="btn btn-info">Create a new product</a>

        {{--<div class="container-fluid">--}}
            <form class="navbar-form" action="{{ route('adminSearch') }}" method="GET" style="display: inline">
                <div class="form-group" >
                    <input type="text" class="form-control" placeholder="Enter title or writer's name" name="query" value="" required>
                </div>
                <button type="submit" class="btn btn-default">Search</button>
                {!! csrf_field() !!}
            </form>
        {{--</div>--}}
    @if(isset($results))
    <div class="container ">
        <div class="row" align="center">
            <br>

                @foreach($results as $result)
                    <div class="col-xs-6 col-md-4 col-lg-4 ">
                        <h3>"{{ $result->name }}"</h3>
                        <cite><h4 align="right">{{ $result->writer }}</h4></cite>
                        <img src="{{ $result->image }}" alt="...">
                        <br>
                        <br>
                        <div>
                            <a href="{{ route('admin/editProduct', ['product_id' => $result->id]) }}" class="btn btn-warning">Edit product</a>
                            <a href="{{ route('admin/deleteProduct', ['product_id' => $result->id]) }}" class="btn my-btn">Delete product</a>
                        </div>
                    </div>
                @endforeach
        </div>

    </div>
    <div align="center">{!! $results->render() !!}</div>

            @else
        <div class="container ">
            <div class="row" align="center">
                @foreach($products as $product)
                    <div class="col-xs-6 col-md-4 col-lg-4 ">
                        <h3>"{{ $product->name }}"</h3>
                        <h3>{{ $product->writer }}</h3>
                        <img src="{{ $product->image }}" alt="...">
                        <br>
                        <br>
                        <div>
                            <a href="{{ route('admin/editProduct', ['product_id' => $product->id]) }}" class="btn btn-warning">Edit product</a>
                            <a href="{{ route('admin/deleteProduct', ['product_id' => $product->id]) }}" class="btn my-btn">Delete product</a>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
        <div align="center">{!! $products->render() !!}</div>

    @endif


        {{--@if(isset($results))--}}

                {{--@foreach($results as $result)--}}
                    {{--<h1>{{ $result->name }}</h1>--}}
                    {{--{{ $result->id }}--}}
                    {{--{{ $result->writer }}--}}
                    {{--{{ $result->price }}--}}
                    {{--{{ $result->current_price }}--}}
                    {{--{{ $result->discount }}--}}
                    {{--{{ $result->genre_name }}--}}
                    {{--<img src="{{ $result->image }}" alt="..." style="max-height: 250px; max-width: 150px">--}}
                    {{--<a href="{{ route('admin/editProduct', ['product_id' => $result->id]) }}">Edit product</a>--}}
                    {{--<a href="{{ route('admin/deleteProduct', ['product_id' => $result->id]) }}">Delete product</a>--}}
                {{--@endforeach--}}
                {{--{!! $results->render() !!}--}}

        {{--@else--}}
            {{--@foreach($products as $product)--}}
                {{--<h1>{{ $product->name }}</h1>--}}
                {{--{{ $product->id }}--}}
                {{--{{ $product->writer }}--}}
                {{--{{ $product->price }}--}}
                {{--{{ $product->current_price }}--}}
                {{--{{ $product->discount }}--}}
                {{--{{ $product->genre_name }}--}}
                {{--<img src="{{ $product->image }}" alt="..." style="max-height: 250px; max-width: 150px">--}}
                {{--<a href="{{ route('admin/editProduct', ['product_id' => $product->id]) }}">Edit product</a>--}}
                {{--<a href="{{ route('admin/deleteProduct', ['product_id' => $product->id]) }}">Delete product</a>--}}
            {{--@endforeach--}}
            {{--{!! $products->render() !!}--}}
        {{--@endif--}}




        {{--@if(session('results'))--}}
            {{--<ul>--}}
                {{--@foreach(session('results') as $result)--}}
                    {{--<li><h1>{{ $result->name }}</h1>--}}
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




@endsection

