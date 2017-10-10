@extends('layouts.header')

@section('content')


    {{--{{  Form::open(['method'=>'GET','url'=>'search','class'=>'navbar-form navbar-left','role'=>'search'])  }}--}}
    {{--<a href="{{ url('search/{query}') }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Add</a>--}}

    {{--<div class="input-group custom-search-form">--}}
        {{--<input type="text" class="form-control" name="search" placeholder="Search...">--}}
        {{--<span class="input-group-btn">--}}
        {{--<button class="btn btn-default-sm" type="submit">--}}
            {{--<i class="fa fa-search"><!--<span class="hiddenGrammarError" pre="" data-mce-bogus="1"--></i>--}}
        {{--</button>--}}
    {{--</span>--}}
    {{--</div>--}}
    {{--{{ Form::close() }}--}}


    <form action="/search/result" method="POST">
        <input type="text" name="query" value="" required/>
        <button type="submit">Submit</button>
        {!! csrf_field() !!}
    </form>


    @if(session('results'))
        <ul>
            @foreach(session('results') as $result)
                <li>{{ $result->name }}</li>
                <li>{{ $result->writer }}</li>

            @endforeach
        </ul>
    @endif

    {{--<form action="{{ route('/search/q'), ['q' => name] }}">--}}
        {{--<input type="text" name="name" placeholder="Input the title of book" value=""/>--}}
        {{--<input type="submit" name="submit" class="btn btn-default" value="Search"/>--}}
    {{--</form>--}}


@endsection