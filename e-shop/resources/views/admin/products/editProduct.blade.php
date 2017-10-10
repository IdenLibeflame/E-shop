@extends('layouts.header')

@section('content')
    <form action="{{ route('admin/updateProduct') }}" method="post">
        <input type="hidden" name="id" value="{{ $product->id }}">

        <p>Current name: <input type="text" name="name" value="{{ $product->name }}"></p>

        <br>
        <p>Current writer: <input type="text" name="writer" value="{{ $product->writer }}"></p>

        <br>
        <p>Current description: <input type="text" name="description" value="{{ $product->description }}"></p>

        <br>
        <p>Total price: <input type="text" name="price" value="{{ $product->price }}"> </p>
        <br>
        <p>Current price: {{ $product->current_price }}</p>
        <br>
        <p>Current discount: <input type="text" name="discount" value="{{ $product->discount }}"></p>
        <br>
        <p>Current availability: {{ $product->availability }}</p>
            <div>
                <p>In stock?</p>
                <p> Yes <input type="radio" name="availability" value="1"> </p>
                <p> No <input type="radio" name="availability" value="0"> </p>
            </div>
        <br>
        <p>Current genre: {{ $product->genre_name }}</p>
        @foreach($genresList as $genre)
            <p> {{ $genre->name }} <input type="checkbox" name="genre_name" value="{{ $genre->name }}"> </p>
        @endforeach
        <br>
        <img src="{{ $product->image }}" alt="" style="max-height: 250px">
        <br>
        <p>Current image address: {{ $product->image }}</p>
        <input type="text" name="image" value="{{ $product->image }}">
        <button type="submit" class="btn btn-primary">Update product</button>
        {!! csrf_field() !!}
    </form>
@endsection
