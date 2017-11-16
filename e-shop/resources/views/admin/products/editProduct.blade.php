@extends('layouts.header')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin/updateProduct') }}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="{{ $product->id }}">
        <br>
        <p>Current name: <input type="text" name="name" value="{{ $product->name }}" required></p>

        <br>
        <p>Current writer: <input type="text" name="writer" value="{{ $product->writer }}" required></p>

        <br>
        <p>Current description: <textarea wrap="hard" rows="3" cols="50" name="description" class="form-control" placeholder="Your comment" style="resize: none; width: 50%" required>{{ $product->description }}</textarea></p>

        <br>
        <p>Total price: <input type="text" name="price" value="{{ $product->price }}" required></p>
        <br>
        <p>Current price: {{ $product->current_price }}</p>
        <br>
        <p>Current discount: <input type="text" name="discount" value="{{ $product->discount }}" required></p>
        <br>
        @if($product->availability)
            <p>Current availability: Present</p>
        @else
            <p>Current availability: Absent</p>
            <br>
        @endif
        <select name="availability" required>
            <option value="{{ $product->availability }}"></option>
            <option value="1">Present</option>
            <option value="0"> Absent</option>
        </select>
        <br>
        <p>Current genre: {{ $product->genre_name }}</p>
        <select name="genre_name" required>
            <option value="{{ $product->genre_name }}" selected>{{ $product->genre_name }}</option>
            @foreach($genresList as $genre)

                <option value="{{ $genre->name }}">{{ $genre->name }}</option>
            @endforeach
        </select>
        <br>
        <br>

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
