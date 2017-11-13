@extends('layouts.header')

@section('content')
    <form action="{{ route('admin/addProduct') }}" method="post" enctype="multipart/form-data">
        <p> title <input type="text" name="name"> </p>
        <p> writer <input type="text" name="writer"> </p>
        <p> description <input type="text" name="description"> </p>
        <p> price <input type="text" name="price"> </p>
        <p> discount <input type="text" name="discount"> </p>
        <br>
        <p>In stock?</p>
            <br>

        <select name="availability">
            <option value="1">Present</option>
            <option value="0"> Absent </option>
        </select>
        
        <br>
        <p>Choose genres</p>
        <select name="genre_name">
            @foreach($genresList as $genre)
                {{--<p> {{ $genre->name }} <input type="checkbox" name="genre_name" value="{{ $genre->name }}"> </p>--}}
                <option value="{{ $genre->name }}">{{ $genre->name }}</option>
            @endforeach
        </select>
        <br>
        <br>

        <p> image <input type="file" name="image" required> </p>
        <button type="submit" class="btn btn-primary">Create new product</button>
        {!! csrf_field() !!}
    </form>
@endsection

