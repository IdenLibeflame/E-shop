@extends('layouts.header')

@section('content')
    @if(auth()->user())
        <div class="container-fluid">
            <form action="{{ route('sendFeedback') }}" method="post" class="navbar-form">
                {{ csrf_field() }}
                <input type="text" name="subject" class="form-control" placeholder="Enter subject of your mail" required>
                <br>
                <br>
                <textarea wrap="hard" rows="6" cols="75" name="message" class="form-control" placeholder="Enter your message" style="resize: none;" required></textarea>
                <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                <br>
                <br>
                <button type="submit" class="btn btn-success">Send the mail</button>
            </form>
        </div>
    @else
        <p class="alert alert-danger">You have to Login or Register for sending email</p>
    @endif
@endsection

