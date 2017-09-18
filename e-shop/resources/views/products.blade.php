@extends('layouts.header')

@section('content')
    <div align="center">
        {{ $name }}
    </div>

    <div class="row" align="center">

        @forelse($temps as $temp)
            <div class="col-xs-6 col-md-4 col-lg-3 cat" style="width: 220px">

                <a href="book/{{ $temp->id }}" class="thumbnail" >

                         <ul>
                            <img src="{{ $temp->image }}" alt="..." style="max-height: 250px;">
                            <li>{{ $temp->id }}</li>
                            <li>{{ $temp->name }}</li>
                            <li>{{ $temp->writer }}</li>
                            <li>{{ $temp->description }}</li>
                            <li>{{ $temp->price }}</li>
                            @if($temp->discount > 0)
                                <li>{{ $temp->discount }}</li>
                                <li>{{ $temp->current_price }}</li>
                            @endif
                            <li>{{ $temp->availability }}</li>
                        </ul>

                </a>
            </div>

        @empty
            <div align="center"><h1>We don't have books in genre {{ $name }}</h1></div>
        @endforelse

    </div>
</div>
    @endsection
</body>
</html>
