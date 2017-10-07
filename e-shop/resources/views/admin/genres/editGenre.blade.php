@extends('layouts.header')

@section('content')
    <form action="{{ route('admin/updateGenre') }}" method="post">
    {{--<form action="" method="post">--}}

        {{--<input type="text" name="name" value="{{ $genre->name }}">--}}
        {{--<br>--}}
        {{--<img src="{{ $genre->image }}" alt="" style="max-height: 250px">--}}
        {{--<br>--}}
        {{--<input type="text" name="image" value="{{ $genre->image }}">--}}
        {{--<button type="submit" class="btn btn-primary">Update genre</button>--}}
        {{--{!! csrf_field() !!}--}}
        <input type="hidden" name="id" value="{{ $genre->id }}">

        <p>Current name: {{ $genre->name }}</p>
        <input type="text" name="name" value="">
        <br>
        <img src="{{ $genre->image }}" alt="" style="max-height: 250px">
        <br>
        <p>Current image address: {{ $genre->image }}</p>
        <input type="text" name="image" value="">
        <button type="submit" class="btn btn-primary">Update genre</button>
        {!! csrf_field() !!}
    </form>
@endsection


