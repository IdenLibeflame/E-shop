@extends('layouts.header')

@section('content')

    <div class="row" align="center">
{{--        @foreach($bookook as $book)--}}
            <div class="col-xs-6 col-md-4 col-lg-3 cat" style="width: 220px">
                <ul>
                    <img src="{{ $book->image }}" alt="..." style="max-height: 250px;">
                    <li>{{ $book->id }}</li>
                    <li>{{ $book->name }}</li>
                    <li>{{ $book->writer }}</li>
                    <li>{{ $book->description }}</li>
                    <li>{{ $book->price }}</li>
                    @if($book->discount > 0)
                        <li>{{ $book->discount }}</li>
                        <li>{{ $book->current_price }}</li>
                    @endif
                    <li>{{ $book->availability }}</li>





                    <div class="btn-group btn-group-justified" style="height: 30px; width: 150px">
                        <a href="{{ route('basket.addToBasket', ['id' => $book->id]) }}" class="btn btn-warning">Add to basket</a>
                    </div>
                </ul>
                @if(Auth::user() && Auth::user()->isAdmin == 0)
                <section class="row new-post">
                    <div class="col-md-6 col-md-offset-3">
                        <form action="{{ route('comment.create') }}" method="post">
                            <div class="form-group">
                                <textarea name="new-post" id="new-post" rows="2" class="form-control" placeholder="Your comment"></textarea>
                                <br>
                                <input type="hidden" value="{{ Auth::id() }}" name="_userId">
                                <input type="hidden" value="{{ $book->id }}" name="_productId">
                                <button type="submit" class="btn btn-primary">Create comment</button>
                                <input type="hidden" value="{{ Session::token() }}" name="_token">
                            </div>
                        </form>
                    </div>
                </section>
                @endif
            </div>
                <section class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <header><h3>What other people thinks</h3></header>
                            @foreach($book->comments as $comment)
                                            <article class="post" data-commentId="{{ $comment->id }}"><span>{{ $comment->comment}}</span>
{{--                            <article class="post">{{ $commenTt->comment}}--}}
                                                <br>
                                                Posted by {{ $comment->user->name }}

                                        @if(Auth::user())

                                            <div class="interaction">
                                                <a href="#" class="like">{{ Auth::user()->likes()->where('comment_id', $comment->id)->first() ? Auth::user()->likes()->where('comment_id', $comment->id)->first()->rating == 1 ? 'You like this comment' : 'Like' : 'Like' }}</a>
                                                <a href="#" class="like">{{ Auth::user()->likes()->where('comment_id', $comment->id)->first() ? Auth::user()->likes()->where('comment_id', $comment->id)->first()->rating == 0 ? 'You don\'t like this comment' : 'Dislike' : 'Dislike' }}</a>
                                                @foreach($ratings as $id => $rating )
                                                    @if($comment->id == $id)
                                                        <p id="rating">Reputation {{ $rating }}</p>
                                                    @endif
                                                @endforeach
                                                <br>
                                                {{--<div class="info">--}}

                                                {{--</div>--}}
                                            </div>


                                            @if(Auth::user()->isAdmin == 1)
                                                 <a href="{{ route('comment.delete', ['comment_id' => $comment->id]) }}">Delete</a>
                                            @elseif(Auth::user() == $comment->user)

                                            <div class="test">
                                                <a href="#" class="edit">Edit</a>
                                                <a href="{{ route('comment.delete', ['comment_id' => $comment->id]) }}">Delete</a>
                                            </div>
                                                        <hr/>
                                            @endif
                                        @endif
                                            </article>
                            @endforeach
                        {{--@endfor--}}
                    </div>
                </section>
        {{--@endforeach--}}

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
        var urlLike = "{{ route('like') }}";
    </script>
@endsection
