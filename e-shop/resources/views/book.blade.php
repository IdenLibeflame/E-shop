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
                                <input type="hidden" value="{{ Auth::id() }}" name="_userId">
                                <input type="hidden" value="{{ $book_id }}" name="_productId">
                                <button type="submit" class="btn btn-primary">Create comment</button>
                                <input type="hidden" value="{{ Session::token() }}" name="_token">
                            </div>
                        </form>
                    </div>
                </section>
            </div>
                <section class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <header><h3>What other people thinks</h3></header>
                            @foreach($comments as $comment)
                                            <article class="post" data-commentid={{ $comment->id }}>{{ $comment->comment}}
{{--                            <article class="post">{{ $commenTt->comment}}--}}
                                        @if(Auth::user())

                                            <div class="interaction">
                                                <a href="#">Like</a>
                                                <a href="#">Dislike</a>
                                                total

                                                <br>
                                                {{--<div class="info">--}}
                                                    Posted by {{ $comment->user->name }}
                                                {{--</div>--}}
                                            </div>
                                        @endif
                                        @if(Auth::user() == $comment->user)

                                            <div class="test">
                                                <a href="#" class="edit">Edit</a>
                                                <a href="{{ route('comment.delete', ['comment_id' => $comment->id]) }}">Delete</a>
                                            </div>

                                        @endif
                                            </article>
                            @endforeach
                        {{--@endfor--}}
                    </div>
                </section>
        @endforeach

    </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Comment</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="comment">Edit the Comment</label>
                            <textarea class="form-control" name="comment" id="comment" rows="5"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
        var token = "{{ Session::token() }}";
        var url = "{{ route('edit') }}";
    </script>
    @endsection
    </body>
    </html>
