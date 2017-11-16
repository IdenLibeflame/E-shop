@extends('layouts.header')
@section('content')
    <div class="container ">
        <div class="row" align="center">
            <br>
            @foreach($genres as $genre)
                <div class="col-xs-6 col-md-4 col-lg-4">
                    <a href="genre/{{ $genre->name }}" class="thumbnail">
                        <img src="{{ $genre->image }}" alt="...">
                        <h1 class=""> {{ $genre->name }}</h1>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <div align="center">{!! $genres->render() !!}</div>
@endsection
