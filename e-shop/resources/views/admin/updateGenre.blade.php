@extends('layouts.header')

@section('content')
    <form action="{{ route('admin/updateGenre') }}" method="post">
        <input type="text" name="name" value="{{ $request->name }}">
        <input type="text" name="image" value="{{ $request->image }}">
        <button type="submit" class="btn btn-primary">update genre</button>
        {!! csrf_field() !!}
    </form>
@endsection

