@extends('layouts.header')

@section('content')
    <div class="alert alert-danger">
        <h4 align="center">Unprocessed orders </h4>
    </div>
    <div class="container ">

        @forelse($orders as $order)
            <div class="col-xs-6 col-md-4 col-lg-4">
                <h3>{{ $order->name }}</h3>
                <p>{{ $order->created_at }}</p>
                <a href="{{ route('admin/showOrder', ['order_id' => $order->id]) }}" class="btn btn-warning">Change
                    status</a>
            </div>
        @empty
            <div align="center">
                <p class="alert alert-info">All orders are successfully processed!</p>
            </div>
        @endforelse
    </div>
    <div align="center">{{ $orders->render() }} </div>
@endsection



