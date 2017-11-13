@extends('layouts.header')

@section('content')
    <form action="{{ route('admin/addGenre') }}" method="post" enctype="multipart/form-data">
        <input type="text" name="name" required>
        <input type="file" name="image" required>
        <button type="submit" class="btn btn-primary">Create new genre</button>
        {!! csrf_field() !!}
    </form>
@endsection

