@extends('layouts.header')

@section('content')


    <div class="alert alert-danger {{ !Session::has('error') ? 'hidden' : '' }}" id="charge-error">
        {{ Session::get('error') }}
    </div>
    @if(Session::has('basket'))

        @if(Session::has('success'))
            <div class="row">
                <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
                    <div id="charge-message" class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                </div>
            </div>
        @endif
        <br>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <ul class="list-group">
                    @foreach($products as $product)
                        <li class="list-group-item">
                            <span class="badge">{{ $product['qty'] }}</span>
                            <strong>{{ $product['item']['name'] }}</strong>
                            <span class="label label-success">{{ $product['price'] }}</span>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    {{--<li><a href="{{ route('/reduce/{id}', ['id' => $product['item']['id']]) }}">Reduce by 1</a></li>--}}
                                    <li><a href="/reduce/{{ $product['item']['id'] }}">Reduce by 1</a></li>
                                    <li><a href="/remove/{{ $product['item']['id'] }}">Reduce All</a></li>
                                </ul>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <ul class="list-group">
                    <li class="list-group-item">
                        <strong>Total price: {{ $totalPrice }}</strong>
                    </li>
                </ul>
            </div>
        </div>

        {{--<hr>--}}

        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">

                @if(auth()->user())

                <form action="{{ route('checkout') }}" method="POST" id="checkout-form">
                    {{ csrf_field() }}

                    <input type="hidden" name="stripeToken" id="stripeToken">
                    <input type="hidden" name="stripeEmail" id="stripeEmail">
                    {{--<input type="hidden" name="billing_name" id="billing_name">--}}
                    {{--<input type="hidden" name="billing_address_line1" id="billing_address_line1">--}}
                    {{--<input type="hidden" name="billing_address_zip" id="billing_address_zip">--}}
                    {{--<input type="hidden" name="billing_address_state" id="billing_address_state">--}}
                    {{--<input type="hidden" name="billing_address_city" id="billing_address_city">--}}
                    {{--<input type="hidden" name="billing_address_country" id="billing_address_country">--}}
                    {{--<input type="hidden" name="billing_address_country_code" id="billing_address_country_code">--}}
                    <input type="hidden" name="shipping_name" id="shipping_name">
                    <input type="hidden" name="shipping_address_line1" id="shipping_address_line1">
                    <input type="hidden" name="shipping_address_zip" id="shipping_address_zip">
                    <input type="hidden" name="shipping_address_state" id="shipping_address_state">
                    <input type="hidden" name="shipping_address_city" id="shipping_address_city">
                    <input type="hidden" name="shipping_address_country" id="shipping_address_country">
                    <input type="hidden" name="shipping_address_country_code" id="shipping_address_country_code">

                    <button type="submit" id="button" class="btn btn-primary">Buy</button>
                    {{--<p class="help in-danger" v-show="status" v-text="status"></p>--}}
                </form>
                @else
                    <p class="alert alert-danger">You have to Login or Register for payment</p>
                @endif

                <script src="https://checkout.stripe.com/checkout.js"></script>
                <script>
                    let stripe = StripeCheckout.configure({
                        key: "{{ config('services.stripe.key') }}",
                        image: "https://stripe.com/img/documentation/checkout/marketplace.png",
                        locale: "auto",
                        email: eShop.user.email,
                        shippingAddress: true,
                        token: function (token, args) {

                            document.getElementById('stripeEmail').value = token.email;
                            document.getElementById('stripeToken').value = token.id;
//                            document.getElementById('billing_name').value = token.billing_name;
//                            document.getElementById('billing_address_line1').value = token.billing_address_line1;
//                            document.getElementById('billing_address_zip').value = token.billing_address_zip;
//                            document.getElementById('billing_address_state').value = token.billing_address_state;
//                            document.getElementById('billing_address_city').value = token.billing_address_city;
//                            document.getElementById('billing_address_country').value = token.billing_address_country;
//                            document.getElementById('billing_address_country_code').value = token.billing_address_country_code;
                            args = {
                                "shipping_name": document.getElementById('shipping_name').value = args.shipping_name,
                                "shipping_address_country": document.getElementById('shipping_address_country').value = args.shipping_address_country,
                                "shipping_address_zip": document.getElementById('shipping_address_zip').value = args.shipping_address_zip,
                                "shipping_address_state": document.getElementById('shipping_address_state').value = args.shipping_address_state,
                                "shipping_address_line1": document.getElementById('shipping_address_line1').value = args.shipping_address_line1,
                                "shipping_address_city": document.getElementById('shipping_address_city').value = args.shipping_address_city,
                                "shipping_address_country_code": document.getElementById('shipping_address_country_code').value = args.shipping_address_country_code,





//                                document.getElementById('shipping_name').value = token.shipping_name;
//                                document.getElementById('shipping_address_line1').value = token.shipping_address_line1;
//                                document.getElementById('shipping_address_zip').value = token.shipping_address_zip;
//                                document.getElementById('shipping_address_state').value = token.shipping_address_state;
//                                document.getElementById('shipping_address_city').value = token.shipping_address_city;

//                                document.getElementById('shipping_address_country_code').value = token.shipping_address_country_code;
                            };

                            document.getElementById('checkout-form').submit();
                        }
                    });

                    document.getElementById('button').addEventListener('click', function (e) {
                        stripe.open({
                            name: "Buy from e-shop",
                            description: "Payment",
//                            zipCode: true,
//                            shippingAddress: true,
                            amount: "{{ $totalPrice * 100 }}",

                        });

                        e.preventDefault();

                    });

                    window.addEventListener('popstate', function() {
                        stripe.close();
                    });


                </script>


            </div>
        </div>
    @else
        <div class="row alert alert-danger">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <h2 align="center">No Items in Basket</h2>
            </div>
        </div>
    @endif
@endsection

@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
@endsection



{{--<script--}}
        {{--src="https://checkout.stripe.com/checkout.js" class="stripe-button"--}}
        {{--data-key="{{ config('services.stripe.key') }}"--}}
        {{--data-amount="{{ $totalPrice * 100 }}"--}}
        {{--data-name="Buy from e-shop"--}}
        {{--data-description="Payment"--}}
        {{--data-image="https://stripe.com/img/documentation/checkout/marketplace.png"--}}
        {{--data-locale="auto"--}}
        {{--data-address="Ditch">--}}
{{--</script>--}}