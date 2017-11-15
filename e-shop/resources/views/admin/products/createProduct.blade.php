@extends('layouts.header')

@section('content')
    <form action="{{ route('admin/addProduct') }}" method="post" enctype="multipart/form-data">
        <br>
        <p> Title: <input type="text" name="name"> </p>
        <p> Author: <input type="text" name="writer"> </p>
        {{--<p> Description: <input type="text" name="description"> </p>--}}
        <p> Description: <textarea wrap="hard" rows="3" cols="50" name="description" class="form-control" placeholder="Your comment" style="resize: none; width: 50%" ></textarea> </p>
        <p> Price: <input type="text" name="price"> </p>
        <p> Discount: <input type="text" name="discount"> </p>
        <br>
        <p>In stock?</p>

        <select name="availability">
            <option value="1">Present</option>
            <option value="0"> Absent </option>
        </select>
        
        <br>
        <br>
        <p>Choose genres:</p>
        <select name="genre_name">
            @foreach($genresList as $genre)
                {{--<p> {{ $genre->name }} <input type="checkbox" name="genre_name" value="{{ $genre->name }}"> </p>--}}
                <option value="{{ $genre->name }}">{{ $genre->name }}</option>
            @endforeach
        </select>
        <br>
        <br>

        <p> Download image: </p>

        <input type="file" name="image" required>
        <br>
        <button type="submit" class="btn btn-primary">Create new product</button>
        {!! csrf_field() !!}
    </form>
@endsection

