@extends('layouts.header')

@section('content')
    <form action="{{ route('admin/updateProduct') }}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="{{ $product->id }}">
        <br>
        <p>Current name: <input type="text" name="name" value="{{ $product->name }}"></p>

        <br>
        <p>Current writer: <input type="text" name="writer" value="{{ $product->writer }}"></p>

        <br>
        {{--<p>Current description: <input type="text" name="description" value="{{ $product->description }}"></p>--}}
        <p>Current description: <textarea wrap="hard" rows="3" cols="50" name="description" class="form-control" placeholder="Your comment" style="resize: none; width: 50%" >{{ $product->description }}</textarea></p>

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
            <option value="{{ $product->genre_name }}" selected>{{ $product->genre_name }}</option>
            @foreach($genresList as $genre)

                {{--<p> {{ $genre->name }} <input type="checkbox" name="genre_name" value="{{ $genre->name }}"> </p>--}}
                <option value="{{ $genre->name }}">{{ $genre->name }}</option>
            @endforeach
        </select>
        <br>
        <br>

{{--        <img src="{{ '/'.$product->image[1].'/'.$product->image[2].'/'.$product->image[3].'/'.$product->image[4] }}" alt="">--}}
        <img src="{{ $product->image }}" alt="">
        <br>
        <br>
        <p>Image name: {{ $product->imageName[4] }}</p>

        <input type="file" name="image">
        <br>
        <button type="submit" class="btn btn-primary">Update product</button>
        <br>
        <br>
        <br>
        {!! csrf_field() !!}
    </form>
@endsection
