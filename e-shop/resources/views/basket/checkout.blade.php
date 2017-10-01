@extends('layouts.header')

@section('content')
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
            <h1>Checkout</h1>
            <h4>Total price: {{ $total }}$</h4>
            <div class="alert alert-danger {{ !Session::has('error') ? 'hidden' : '' }}" id="charge-error">
                {{ Session::get('error') }}
            </div>

            <form action="{{ route('checkout') }}" method="post" id="checkout-form">
                <div class="rov">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" class="form-control" name="name" required>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" class="form-control" name="address" required>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="card-name">Card Name</label>
                        <input type="text" id="card-name" class="form-control" required>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="card-number">Card Number</label>
                        <input type="text" id="card-number" class="form-control" required>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="row"></div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="card-expiry-month">Expiration Month</label>
                                <input type="text" id="card-expiry-month" class="form-control" required>
                            </div>
                        </div>

                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="card-expiry-year">Expiration Year</label>
                            <input type="text" id="card-expiry-year" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="card-cvc">CVC</label>
                            <input type="text" id="card-cvc" class="form-control" required>
                        </div>
                    </div>
                </div>
                {{ csrf_field() }}
                <button class="btn btn-success" type="submit">Buy Now</button>
            </form>
        </div>
    </div>

    <input type="hidden" id="user-id" value="{{ auth()->id() }}">


@endsection

@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ URL::to('src/js/checkout.js') }}"></script>
@endsection
