@extends('layouts.page')

@section('title', 'Adcesa')

@section('content')
    @if (session('mensaje'))
        @include('partials.alert')
    @endif

    <!-- CAROUSEL -->
    @include('page.home.partials.carousel')
    @include('page.home.partials.we')
    @include('page.home.partials.servicios')

@endsection
