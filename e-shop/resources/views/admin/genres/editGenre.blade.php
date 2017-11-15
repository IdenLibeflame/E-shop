@extends('layouts.header')

@section('content')
    <form action="{{ route('admin/updateGenre') }}" method="post" enctype="multipart/form-data">

        <input type="hidden" name="id" value="{{ $genre->id }}">
        <br>
        <p>Genre name: <input type="text" name="name" value="{{ $genre->name }}" required></p>

        <br>
        <img src="{{ $genre->image }}" alt="">
        <br>
        <?php $genre->image = explode('/', $genre->image);?>
        <p>Current image address: {{ $genre->image[4] }}</p>
        <input type="file" name="image">
        <br>
        <button type="submit" class="btn btn-primary">Update genre</button>
        {!! csrf_field() !!}
    </form>
@endsection


