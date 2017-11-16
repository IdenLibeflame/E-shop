@extends('layouts.header')

@section('content')

    <div class="row" align="center">
        <div class="col-xs-6 col-md-6 col-lg-3" style="width: 50%">
            <br>
            <img src="{{ $book->image }}" alt="...">
            <br>
            <br>
            @if($book->availability)
                <div class="btn-group btn-group-justified" style="height: 30px; width: 150px">
                    <a href="{{ route('basket.addToBasket', ['id' => $book->id]) }}" class="btn btn-warning">Add to
                        Basket</a>
                </div>
            @else
                <p class="alert alert-danger">This book isn't available</p>
            @endif
            <br>
            <br>
            <div class="panel panel-primary book_info">
                <div class="panel-heading">Title:</div>
                <div class="panel-body">"{{ $book->name }}"</div>
            </div>

            <div class="panel panel-success book_info">
                <div class="panel-heading">Author:</div>
                <div class="panel-body">{{ $book->writer }}</div>
            </div>
            <div class="panel panel-info book_info1">
                <div class="panel-heading">Description:</div>
                <div class="panel-body">{{ $book->description }}</div>
            </div>
            <div class="panel panel-danger book_info">
                <div class="panel-heading">Price:</div>
                <div class="panel-body price">${{ $book->price }}</div>
            </div>
            @if($book->discount > 0)
                <div class="panel panel-warning book_info">
                    <div class="panel-heading">Discount:</div>
                    <div class="panel-body">{{ $book->discount*100 }} %</div>
                </div>
                <div class="panel panel-danger book_info">
                    <div class="panel-heading">Current price:</div>
                    <div class="panel-body price">${{ $book->current_price }}</div>
                </div>
            @endif
        </div>
        <div class="col-xs-6 col-md-6 col-lg-3" style="width: 50%">
            <br>
            @if(Auth::user() && Auth::user()->isAdmin == 0)
                <section class="row new-post">
                    <div class="col-md-6" style="width:100%;">
                        <form action="{{ route('commentCreate') }}" method="post">
                            <div class="form-group">
                                <textarea wrap="hard" rows="6" cols="150" name="new-post" id="new-post"
                                          class="form-control" placeholder="Your comment"
                                          style="resize: none;"></textarea>
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
            <header><p class="h3">What other people think:</p></header>
            @foreach($book->comments as $comment)
                <article class="post" data-commentId="{{ $comment->id }}"><span id="span_comment" class="label-comment list-group-item list-group-item-success">{{ $comment->comment}}</span>
                    <br>
                    <small class="posted-size">Posted by <cite>{{ $comment->user->name }}</cite></small>
                    <br>
                    <br>
                    @if(Auth::user() && Auth::user()->isAdmin == 1)
                        <a href="{{ route('commentDelete', ['comment_id' => $comment->id]) }}" class="btn btn-warning">Delete</a>
                        <br>
                    @elseif(Auth::user() == $comment->user)

                        <div class="test">
                            <a href="#" class="edit btn btn-warning">Edit</a>
                            <a href="{{ route('commentDelete', ['comment_id' => $comment->id]) }}" class="btn"
                               style="background: grey; color: white">Delete</a>
                        </div>
                    @endif
                    <br>

                    @if(Auth::user())

                        <div class="interaction">
                            <a href="#"
                               class="like btn btn-success">{{ Auth::user()->likes()->where('comment_id', $comment->id)->first() ? Auth::user()->likes()->where('comment_id', $comment->id)->first()->rating == 1 ? 'You like this comment' : 'Like' : 'Like' }}</a>
                            <a href="#"
                               class="like btn btn-danger">{{ Auth::user()->likes()->where('comment_id', $comment->id)->first() ? Auth::user()->likes()->where('comment_id', $comment->id)->first()->rating == 0 ? 'You don\'t like this comment' : 'Dislike' : 'Dislike' }}</a>
                            <br><br>
                            @foreach($ratings as $id => $rating )
                                @if($comment->id == $id)

                                    <div><p><span class="rating list-group-item price"
                                                  id="rating-{{ $id }}">Rating: {{ $rating }}</span></p></div>
                                    <script>
                                        var rating = "{{ $rating }}"
                                    </script>
                                @endif
                            @endforeach
                            <br>
                            <br>
                        </div>
                    @endif
                </article>
            @endforeach
        </div>
    </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
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
        var urlRating = "{{ route('rating') }}";
    </script>

@endsection
