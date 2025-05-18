@extends('layouts.page')

@section('title', 'MARYLAND')

@section('content')
    <!--Mensajes de error -->
    @if (session('mensaje'))
        @include('partials.alert')
    @endif

    <!-- Barra de progreso -->
    @include('page.partials.barra')

    <!-- Validamos si los estudiantes del plan fueron todos registrados -->
    @if ($totalDeRegistros < $planSolicitado->cantidad_estudiantes)
        <!-- Formulario de registro de estudiante -->
        @include('page.partials.formularioDeRegistro')
    @endif

    <!-- Validamos si es menor de edad -->
    @if (session('esMenorDeEdad'))
        <!-- Formulario de representante -->
        @include('page.partials.formularioDeRepresentante')
    @endif

    <!-- Sección de carrito, aqui se muestra todo lo registrado y el monto a pagar -->
    @include('page.partials.carrito')

    <!-- Script que calcula la edad -->
    <script src="{{ asset('assets/js/util/calcularEdad.js') }}"></script>
@endsection
