<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">

<title>@yield('title')</title>

{{-- SEO --}}
<meta content="" name="description">
<meta content="" name="keywords">

<!-- Favicons -->
<link href="{{ asset('assets/img/logo-img-circulo.png') }}" rel="icon">
<link href="{{ asset('assets/img/logo-img-circulo.png') }}" rel="apple-touch-icon">

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200..800&display=swap" rel="stylesheet">

@vite(['resources/scss/app.scss', 'resources/js/app.js'])
