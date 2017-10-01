@extends('layouts.header')
@section('content')


    <div class="container">
        <div class="row" align="center">
            @foreach($genres as $genre)
            <div class="col-xs-6 col-md-4 col-lg-3 cat" style="width: 220px">
                <a href="genre/{{ $genre->name }}" class="thumbnail" >
                    <img src="{{ $genre->image }}" alt="...">

                    <h1>Genre: {{ $genre->name }}</h1>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    @endsection

    </body>
</html>
