@extends('layouts.page')

@section('title', 'MARYLAND')

@section('content')
    @if (session('mensaje'))
        @include('partials.alert')
    @endif


    @include('page.partials.barra')
    @include('page.partials.tarjetasPlanes')
    @include('page.partials.carrito')
@endsection
