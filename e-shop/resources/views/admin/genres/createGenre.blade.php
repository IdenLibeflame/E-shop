@extends('layouts.header')

@section('content')
    <form action="{{ route('admin/addGenre') }}" method="post">
        <input type="text" name="name">
        <input type="text" name="image">
        <button type="submit" class="btn btn-primary">Create genre</button>
        {!! csrf_field() !!}
    </form>
@endsection

