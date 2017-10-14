<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>E-SHOP</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    {{--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>--}}

    <!-- Styles -->

    <link rel="stylesheet" href="{{ URL::to('\src\img\img.css') }}">
    @yield('styles')
</head>
<body>
<div align="center">
    <div class="btn-group btn-group-justified">
        <a href="/" class="btn btn-danger">My shop!</a>
    </div>
</div>

<div class="container">
    <div class="row" align="center">
        <div class="btn-group btn-group-justified">
            <a href="/basket" class="btn btn-warning">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i> basket
                <span class="badge">{{ Session::has('basket') ? Session::get('basket')->totalQuantity : '' }}</span>
            </a>
            <a href="/search" class="btn btn-warning">search</a>
            <a href="/genre" class="btn btn-warning">genre</a>


            @if (Route::has('login'))
                @auth
                <a href="#" class="btn btn-warning">profile</a>
                <a href="{{ route('/feedback') }}" class="btn btn-warning">Contact us</a>

                @if(Auth::user()->isAdmin == 1)
                    <a href="{{ route('admin/index') }}" class="btn btn-warning">Panel of Power!</a>
                @endif

                <a href="{{ route('logout') }}" class="btn btn-warning"
                   onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">Logout </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>

            @else
                <a href="{{ route('login') }}" class="btn btn-danger btn-lg">Login</a>
                <a href="{{ route('register') }}" class="btn btn-danger btn-lg">Register</a>
                @endauth
            @endif
            {{--<a href="#" class="btn btn-warning">{{ $name }}</a>--}}


        </div>
    </div>
    @if(Session::has('Success'))
        <div class="alert alert-success" align="center"> {{ Session::get('Success') }}</div>
    @endif
    @yield('content')


</div>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://use.fontawesome.com/b3a03bdfa0.js"></script>
<script src="{{ URL::to('src/js/app.js') }}"></script>
@yield('scripts')
</body>
</html>
