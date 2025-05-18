@extends('layouts.page')

@section('title', 'MARYLAND')

@section('content')
    @if (session('mensaje'))
        @include('partials.alert')
    @endif


    @include('page.partials.barra')

    <div class="d-flex justify-content-center">
        <div class="card m-5 text-center" style="width: 30rem">
            <img src="{{ asset('assets/img/registro.png') }}" class="card-img-top" alt="banner_fin">
            <div class="card-body">
                <h5 class="card-title fs-3">{{ $mensaje }}</h5>
                <p class="card-text">Para concretar el proceso de inscripción contactenos por Whatsapp.</p>
                <p class="card-text"><small class="text-muted">
                        <a href="{{ route('page.index') }}" class="text-primary">Volver al catalogo de cursos</a>
                    </small></p>
            </div>
        </div>

    </div>

@endsection
