@extends('layouts.header')

@section('content')
    <form action="{{ route('admin/updateProduct') }}" method="post" enctype="multipart/form-data">
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
        @if($product->availability)
            <p>Current availability: In stock</p>
        @else
            <p>Current availability: Absent</p>
        <br>
        @endif
        <select name="availability">
            <option value="1">Present</option>
            <option value="0"> Absent </option>
        </select>
        <br>
        <p>Current genre: {{ $product->genre_name }}</p>
        <select name="genre_name">
            @foreach($genresList as $genre)
                {{--<p> {{ $genre->name }} <input type="checkbox" name="genre_name" value="{{ $genre->name }}"> </p>--}}
                <option value="{{ $genre->name }}">{{ $genre->name }}</option>
            @endforeach
        </select>
        <br>
        <img src="{{ $product->image }}" alt="" style="max-height: 250px">
        <br>
        <p>Current image address: {{ $product->image }}</p>
        <input type="file" name="image" value="{{ $product->image }}" required>
        <br>
        <button type="submit" class="btn btn-primary">Update product</button>
        {!! csrf_field() !!}
    </form>
@endsection
