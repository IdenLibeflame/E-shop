@extends('layouts.header')

@section('content')
    <div class="container-fluid">

    <form action="{{ route('sendFeedback') }}" method="post" class="navbar-form">
        {{ csrf_field() }}
        <input type="text" name="subject" class="form-control" placeholder="Enter subject of your mail" required>
        <br>
        <br>
        <input type="text" name="message" class="form-control" placeholder="Enter your message" required>
        <input type="hidden" name="name" value="{{ Auth::user()->name }}">
        <input type="hidden" name="email" value="{{ Auth::user()->email }}">
        <br>
        <br>
        <button type="submit" class="btn btn-success">Send the mail</button>
    </form>
    </div>
@endsection



    {{--<form class="navbar-form" action="/search/result" method="GET">--}}
        {{--<div class="form-group" >--}}
            {{--<input type="text" class="form-control" placeholder="Enter title or writer's name" name="query" value="" required>--}}
        {{--</div>--}}
        {{--<button type="submit" class="btn btn-default">Submit</button>--}}
        {{--{!! csrf_field() !!}--}}
    {{--</form>--}}
