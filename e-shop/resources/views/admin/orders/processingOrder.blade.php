@extends('layouts.header')

@section('content')
    <form action="{{ route('admin/processingOrder') }}" method="post">
        <input type="hidden" name="id" value="{{ $order[0]->id }}">
        <br>
        <p>Order date: <b>{{ $order[0]->created_at }}</b></p>
        <p>Customer name: : <b>{{ $order[0]->name }}</b></p>
        <p>Customer email: : <b>{{ $order[0]->email }}</b></p>
        <p>Customer country: : <b>{{ $order[0]->country }}</b></p>
        <p>Customer country code: : <b>{{ $order[0]->country_code }}</b></p>
        <p>Customer city: : <b>{{ $order[0]->city }}</b></p>
        <p>Customer street: : <b>{{ $order[0]->street }}</b></p>
        <p>Customer ZIP code: : <b>{{ $order[0]->zip_code }}</b></p>
        <p>Payment ID: : <b>{{ $order[0]->payment_id }}</b></p>
        <p>Customer payment ID: : <b>{{ $order[0]->customer_id }}</b></p>

        @foreach($order[0]->basket->items as $item)
            <ul>
                <p>Title: {{ $item['item']['name'] }}</p>
                <p>Author: {{ $item['item']['writer'] }}</p>
                <p>Quantity: {{$item['qty']}}</p>
                <p>Price: ${{ $item['price'] }} </p>
                <hr class="hr" style="width: 30%" align="left">

            </ul>
        @endforeach

        <p><b>Total Price:</b> {{ $order[0]->basket->totalPrice }}</p>

        <div>
            @if($order[0]->status)
                <p>Current status: Processed</p>
            @else
                <p>Current status: Unprocessed</p>
                <br>
            @endif
            <select name="status">
                <option value="{{ $order[0]->status }}" selected></option>
                <option value="1">Processed</option>
                <option value="0"> Unprocessed</option>
            </select>
        </div>
        <br>

        <button type="submit" class="btn btn-primary">Update order</button>
        {!! csrf_field() !!}
    </form>
@endsection


