@extends('layouts.header')

@section('content')
    <br>
    <a href="{{ route('admin/createGenre') }}" class="btn btn-info">Create a new genre</a>
    <div class="container ">
        <div class="row" align="center">
            <br>
            @foreach($genres as $genre)
                <div class="col-xs-6 col-md-4 col-lg-4 ">
                    <h1>{{ $genre->name }}</h1>
                    <img src="{{ $genre->image }}" alt="...">
                    <br>
                    <br>
                    <div>
                        <a href="{{ route('admin/editGenre', ['genre_id' => $genre->id]) }}" class="btn btn-warning">Edit genre</a>
                        <a href="{{ route('admin/deleteGenre', ['genre_id' => $genre->id]) }}" class="btn my-btn">Delete genre</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div align="center">{!! $genres->render() !!}</div>
@endsection
