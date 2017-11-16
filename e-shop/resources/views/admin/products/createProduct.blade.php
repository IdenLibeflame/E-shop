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

    <form action="{{ route('admin/addProduct') }}" method="post" enctype="multipart/form-data">
        <br>
        <p> Title: <input type="text" name="name" required></p>
        <p> Author: <input type="text" name="writer" required></p>
        <p> Description: <textarea wrap="hard" rows="3" cols="50" name="description" class="form-control" placeholder="Your comment" style="resize: none; width: 50%" required></textarea></p>
        <p> Price: <input type="text" name="price" required></p>
        <p> Discount: <input type="text" name="discount"></p>
        <br>
        <p>In stock?</p>

        <select name="availability" required>
            <option value="1">Present</option>
            <option value="0"> Absent</option>
        </select>

        <br>
        <br>
        <p>Choose genres:</p>
        <select name="genre_name" required>
            @foreach($genresList as $genre)
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

