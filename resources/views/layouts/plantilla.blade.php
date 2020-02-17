<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Braintly Viajes</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header class="boxHeader">
    <div class="container my-3">
        <a class="float-left" href="{{ url('/') }}">
            <img class="logo" src="{{ asset('images/logo.png') }}" alt="">
        </a>
        <a class="float-right" href="{{ url('/reservation') }}">
            Vuelos reservados
        </a>
        <div class="clearfix"></div>
    </div>
</header>
@yield('content')

<footer>
    <div>#BraintlyViajes {{ now()->year }}</div>
</footer>

</body>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
</html>
