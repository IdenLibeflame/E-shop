@extends('layouts.header')

@section('content')
    <form action="{{ route('admin/processingOrder') }}" method="post">
        <input type="hidden" name="id" value="{{ $order[0]->id }}">

        <p>{{ $order[0]->name }}</p>
        <p>{{ $order[0]->email }}</p>
        <p>{{ $order[0]->address }}</p>

        @foreach($order[0]->basket->items as $item)
            <ul>

                <li>{{ $item['price'] }} $</li>
                {{ $item['item']['name'] }} | {{$item['qty']}}
                <ul>
                    <li>Total Price: {{ $order[0]->basket->totalPrice }}</li>
                </ul>
            </ul>
        @endforeach

        {{--<input type="hidden" name="payment_id" value="{{ $order[0]->payment_id }}">--}}
        <p>{{ $order[0]->status }}</p>
        <div>
            <p>Processed?</p>
            <p> Yes <input type="radio" name="status" value="1"> </p>
            <p> No <input type="radio" name="status" value="0"> </p>
        </div>


        <button type="submit" class="btn btn-primary">Update order</button>
        {!! csrf_field() !!}
    </form>
@endsection


