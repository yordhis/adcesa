@extends('layouts.page')

@section('title', 'Adcesa')

@section('content')
    @if (session('mensaje'))
        @include('partials.alert')
    @endif

    <!-- CAROUSEL -->
    @include('page.partials.carousel')

    <!-- CURSOS -->
    @include('page.partials.cursos')
@endsection
