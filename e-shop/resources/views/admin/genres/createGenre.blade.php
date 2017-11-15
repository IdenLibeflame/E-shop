@extends('layouts.header')

@section('content')
    <form action="{{ route('admin/addGenre') }}" method="post" enctype="multipart/form-data">
        <br>
        <p>Genre name: <input type="text" name="name" required></p>
        <br>
        <p>Download image:</p>
        <input type="file" name="image" required>
        <br>
        <button type="submit" class="btn btn-primary">Create new genre</button>
        {!! csrf_field() !!}
    </form>
@endsection

