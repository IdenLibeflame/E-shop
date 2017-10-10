@extends('layouts.header')

@section('content')
    <form action="{{ route('admin/addProduct') }}" method="post">
        <p> title <input type="text" name="name"> </p>
        <p> writer <input type="text" name="writer"> </p>
        <p> description <input type="text" name="description"> </p>
        <p> price <input type="text" name="price"> </p>
        <p> discount <input type="text" name="discount"> </p>
        <br>
        <div>
            <p>In stock?</p>
            <p> Yes <input type="radio" name="availability" value="1"> </p>
            <p> No <input type="radio" name="availability" value="0"> </p>
        </div>
        <br>
        <p>Choose genres</p>
        @foreach($genresList as $genre)
            <p> {{ $genre->name }} <input type="checkbox" name="genre_name" value="{{ $genre->name }}"> </p>
        @endforeach
        <p> image <input type="text" name="image"> </p>
        <button type="submit" class="btn btn-primary">Create new product</button>
        {!! csrf_field() !!}
    </form>
@endsection

