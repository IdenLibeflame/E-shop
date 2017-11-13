@extends('layouts.header')

@section('content')
    <form action="{{ route('admin/updateGenre') }}" method="post" enctype="multipart/form-data">

        <input type="hidden" name="id" value="{{ $genre->id }}">

        <p>Current name: {{ $genre->name }}</p>
        <input type="text" name="name" value="{{ $genre->name }}">
        <br>
        <img src="{{ $genre->image }}" alt="" style="max-height: 250px">
        <br>
        <p>Current image address: {{ $genre->image }}</p>
        <input type="file" name="image" value="" required>
        <button type="submit" class="btn btn-primary">Update genre</button>
        {!! csrf_field() !!}
    </form>
@endsection


