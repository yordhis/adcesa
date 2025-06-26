@extends('layouts.page')

@section('title', 'Adcesa')

@section('content')
    @if (session('mensaje'))
        @include('partials.alert')
    @endif

    <!-- Formulario -->
    @include('page.clientes.partials.form-cliente')


@endsection
