<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title')</title>
<link href="{{ asset('assets/img/logo-img-circulo.png') }}" rel="icon">
<link href="{{ asset('assets/img/logo-img-circulo.png') }}" rel="apple-touch-icon">

@vite(['resources/css/app.css', 'resources/js/app.js'])

{{-- <link href="{{ asset('/css/jquery-confirm.css') }}" rel="stylesheet"> --}}
<script src="{{ asset('js/jquery.min.js') }}" defer></script>
<script src="{{ asset('js/jquery-confirm.js') }}" defer></script>
