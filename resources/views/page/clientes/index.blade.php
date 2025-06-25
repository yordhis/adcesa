@extends('layouts.page')

@section('title', 'Adcesa')

@section('content')
    @if (session('mensaje'))
        @include('partials.alert')
    @endif

    <!-- CAROUSEL -->
    @include('page.clientes.partials.form-cliente')


@endsection
