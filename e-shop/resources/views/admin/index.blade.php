@extends('layouts.header')

@section('content')
    <h1 class="alert alert-success" align="center">You are admin!</h1>
    <a href="{{ route('admin/showGenres') }}" class="btn btn-primary my-btn2" role="button">Show Genres</a>
    <a href="{{ route('admin/showProducts') }}" class="btn btn-info my-btn2" role="button">Show Products</a>
    <a href="{{ route('admin/showOrders') }}" class="btn btn-success my-btn2" role="button">Show Orders</a>
@endsection

