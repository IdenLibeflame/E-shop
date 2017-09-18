@extends('layouts.header')

@section('content')

    <div class="row" align="center">
        @foreach($book as $b)
            <div class="col-xs-6 col-md-4 col-lg-3 cat" style="width: 220px">
                <ul>
                    <img src="{{ $b->image }}" alt="..." style="max-height: 250px;">
                    <li>{{ $b->id }}</li>
                    <li>{{ $b->name }}</li>
                    <li>{{ $b->writer }}</li>
                    <li>{{ $b->description }}</li>
                    <li>{{ $b->price }}</li>
                    @if($b->discount > 0)
                        <li>{{ $b->discount }}</li>
                        <li>{{ $b->current_price }}</li>
                    @endif
                    <li>{{ $b->availability }}</li>





                    <div class="btn-group btn-group-justified" style="height: 30px; width: 150px">
                        <a href="#" class="btn btn-warning">Add to basket</a>
                    </div>
                </ul>

                <section class="row new-post">
                    <div class="col-md-6 col-md-offset-3">
                        <form action="{{ route('comment.create') }}" method="post">
                            <div class="form-group">
                                <textarea name="new-post" id="new-post" rows="2" class="form-control" placeholder="Your comment"></textarea>
                                <br>
{{--                                <text>{{ Имя автора }}</text>--}}
                                <input type="hidden" value="{{ Auth::id() }}" name="_userId">
                                <input type="hidden" value="{{ $book_id }}" name="_productId">
                                <button type="submit" class="btn btn-primary">Create comment</button>
                                <input type="hidden" value="{{ Session::token() }}" name="_token">
                            </div>
                        </form>
                    </div>
                </section>

                <section class="row posts">
                    <div class="col-md-6 col-md-offset-3">
                        <header><h3>What other people thinks</h3></header>
                        {{--@foreach($commentsByIdUnic as $commentById)--}}
                            {{--@if($commentById == $b->id)--}}
                                {{--@foreach($productComments as $productComment)--}}
                                    {{--@foreach($postedByName as $pbn)--}}
                                    {{--<article class="post">{{ $productComment }}</article>--}}
                                    {{--<div class="interaction">--}}
                                        {{--<a href="#">--}}
                                            {{--Like--}}
                                        {{--</a>--}}
                                        {{--<a href="#">--}}
                                            {{--Dislike--}}
                                        {{--</a>--}}
                                        {{--total--}}
                                    {{--</div>--}}
                                    {{--<div class="info">--}}
                                        {{--@foreach($postedByIdUnic as $postedById)--}}
                                            {{--@if($postedById == $b->id)--}}
                                                {{--@foreach($postedByNameUnic as $postedByName)--}}
                                                    {{--Posted by {{ $postedByName }}--}}
                                                {{--@endforeach--}}
                                            {{--@endif--}}
                                        {{--@endforeach--}}
                                            {{--@foreach($array as $id => $name)--}}
                                                {{--@if($id == $b->id)--}}
                                                    {{--Posted by {{ $name }}--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}

                                                {{--Posted by {{ $pbn }}--}}

                                    {{--</div>--}}
                                    {{--@endforeach--}}
                                {{--@endforeach--}}
                            {{--@endif--}}
                        {{--@endforeach--}}

{{--                        @for($i = 0; $i < $count; $i++)--}}
{{--                            @for()--}}
{{--                            @foreach($commentsByIdUnic as $commentById)--}}
{{--                                @if($commentById == $b->id)--}}

                                    @foreach($comments as $comment)
{{--                                        @foreach($postedByName as $pbn)--}}



                                            <article class="post">{{ $comment->comment}}</article>
                                            {{--<article class="post">{{ $productComments[$i] }}</article>--}}


                                            <div class="interaction">
                                                <a href="#">
                                                    Like
                                                </a>
                                                <a href="#">
                                                    Dislike
                                                </a>
                                                total
                                            </div>
                                            <div class="info">

{{--                                                Posted by {{ $nameOfWriterComment[$i] }}--}}
                                                Posted by {{ $comment->user->name }}


                                            </div>
                                        {{--@endforeach--}}
                                    {{--@endforeach--}}
                                {{--@endif--}}
                                    {{--@endfor--}}
                            @endforeach
                        {{--@endfor--}}



                    </div>
                </section>



                {{--@foreach($test as $t)--}}
                    {{--@if($t == $b->id)--}}
                        {{--@foreach($productComments as $productComment)--}}
                            {{--<ul>--}}
                                {{--<li>{{ $productComment }}</li>--}}

                                {{--<a href="#">--}}
                                    {{--Like--}}
                                {{--</a>--}}
                                {{--<a href="#">--}}
                                    {{--Dislike--}}
                                {{--</a>--}}
                                {{--total--}}
                            {{--</ul>--}}
                        {{--@endforeach--}}
                    {{--@endif--}}
                {{--@endforeach--}}
            </div>

        @endforeach

    </div>
    </div>
    @endsection
    </body>
    </html>
