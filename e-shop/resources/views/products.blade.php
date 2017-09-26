@extends('layouts.header')

@section('content')
    <div align="center">
        {{ $name }}
    </div>


    <div class="row">
        @forelse($temps as $temp)
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
            {{--<a href="book/{{ $temp->id }}">--}}
                <img src="{{ $temp->image }}" alt="...">
            {{--</a>--}}
                <div class="caption">
                    <h4>"{{ $temp->name }}" - {{ $temp->writer }}</h4>
                    <p>{{ $temp->description }}</p>
                    <p>
                        <div class="pull-left price">{{ $temp->price }}</div>
                        <a href="{{ route('basket.addToBasket', ['id' => $temp->id]) }}" class="btn btn-primary" role="button">Add to Cart</a>
                        <a href="book/{{ $temp->id }}" class="btn btn-default pull-right" role="button">More info</a>
                    </p>
                </div>

            </div>

        </div>
        @empty
            <div align="center"><h1>We don't have books in genre {{ $name }}</h1></div>
        @endforelse
    </div>



    {{--<div class="row" align="center">--}}

        {{--@forelse($temps as $temp)--}}
            {{--<div class="col-xs-6 col-md-4 col-lg-3 cat" style="width: 220px">--}}

                {{--<a href="book/{{ $temp->id }}" class="thumbnail" >--}}

                         {{--<ul>--}}
                            {{--<img src="{{ $temp->image }}" alt="..." style="max-height: 250px;">--}}
                            {{--<li>{{ $temp->id }}</li>--}}
                            {{--<li>{{ $temp->name }}</li>--}}
                            {{--<li>{{ $temp->writer }}</li>--}}
                            {{--<li>{{ $temp->description }}</li>--}}
                            {{--<li>{{ $temp->price }}</li>--}}
                            {{--@if($temp->discount > 0)--}}
                                {{--<li>{{ $temp->discount }}</li>--}}
                                {{--<li>{{ $temp->current_price }}</li>--}}
                            {{--@endif--}}
                            {{--<li>{{ $temp->availability }}</li>--}}
                        {{--</ul>--}}

                {{--</a>--}}
            {{--</div>--}}

        {{--@empty--}}
            {{--<div align="center"><h1>We don't have books in genre {{ $name }}</h1></div>--}}
        {{--@endforelse--}}

    {{--</div>--}}
</div>
    @endsection
</body>
</html>
