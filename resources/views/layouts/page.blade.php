<!DOCTYPE html>
<html lang="es">

<head>
    @include('page.partials.head')
</head>

<body>
    @include('page.partials.header')
    
    @yield('content')
    
    @include('page.partials.footer')

</body>

</html>
