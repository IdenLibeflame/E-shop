@extends('layouts.header')

@section('content')





    <form action="/search/result" method="POST">
        <input type="text" name="name" value="" required/>
        <button type="submit">Submit</button>
        {!! csrf_field() !!}
    </form>

    @if(!$results->isEmpty())
        <ul>
            @foreach($results as $result)
                <li>{{ $result->name }}</li>
                <li>{{ $result->writer }}</li>

            @endforeach
        </ul>
    @endif

@endsection