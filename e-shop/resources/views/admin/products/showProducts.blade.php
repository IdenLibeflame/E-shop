@extends('layouts.header')

@section('content')

    <br>
    <a href="{{ route('admin/createProduct') }}" class="btn btn-info">Create a new product</a>
    <form class="navbar-form" action="{{ route('adminSearch') }}" method="GET" style="display: inline">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Enter title or writer's name" name="query" value=""
                   required>
        </div>
        <button type="submit" class="btn btn-default">Search</button>
        {!! csrf_field() !!}
    </form>
    <br>
    <br>
    @if(isset($results))
        <div class="container ">
            <div class="row" align="center">
                @foreach($results as $result)
                    <div class="col-xs-6 col-md-4 col-lg-4 ">
                        <h4>"{{ $result->name }}"</h4>
                        <cite><h4 align="center">{{ $result->writer }}</h4></cite>
                        <img src="{{ $result->image }}" alt="...">
                        <br>
                        <br>
                        <div>
                            <a href="{{ route('admin/editProduct', ['product_id' => $result->id]) }}"
                               class="btn btn-warning">Edit product</a>
                            <a href="{{ route('admin/deleteProduct', ['product_id' => $result->id]) }}"
                               class="btn my-btn">Delete product</a>
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
                        <h4>"{{ $product->name }}"</h4>
                        <cite><h4 align="center">{{ $product->writer }}</h4></cite>
                        <img src="{{ $product->image }}" alt="...">
                        <br>
                        <br>
                        <div>
                            <a href="{{ route('admin/editProduct', ['product_id' => $product->id]) }}"
                               class="btn btn-warning">Edit product</a>
                            <a href="{{ route('admin/deleteProduct', ['product_id' => $product->id]) }}"
                               class="btn my-btn">Delete product</a>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
        <div align="center">{!! $products->render() !!}</div>
    @endif
@endsection

