@extends('layouts.header')

@section('content')
    <form action="{{ route('sendFeedback') }}" method="post">
        {{ csrf_field() }}
        <p>Enter subject of your mail</p>
        <input type="text" name="subject">
        <br>
        <p>Enter your message</p>
        <input type="text" name="message">
        <input type="hidden" name="name" value="{{ Auth::user()->name }}">
        <input type="hidden" name="email" value="{{ Auth::user()->email }}">
        <br>
        <br>
        <button type="submit">Send the mail</button>
    </form>
@endsection
