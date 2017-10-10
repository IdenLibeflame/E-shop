@extends('layouts.header')

@section('content')
    <ul>
        <a href="createGenre">Create a new genre</a>
            @foreach($genres as $genre)
                <li><h1>{{ $genre->name }}</h1></li>
                <img src="{{ $genre->image }}" alt="..." style="max-height: 250px; max-width: 150px">
            <a href="{{ route('admin/editGenre', ['genre_id' => $genre->id]) }}">Edit genre</a>
{{--            <a href="{{ route('admin/{name}/updateGenre/') }}">Update genre</a>--}}
{{--            <a href="{{ route('admin/{name}/updateGenre/{genre_id}', ['genre_name' => $genre->name, 'genre_id' => $genre->id]) }}/updateGenre">Update genre</a>--}}

            <a href="{{ route('admin/deleteGenre', ['genre_id' => $genre->id]) }}">Delete genre</a>
            @endforeach

    </ul>

    {!! $genres->render() !!}
@endsection

