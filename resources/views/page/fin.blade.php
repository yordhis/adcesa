@extends('layouts.page')

@section('title', 'Adcesa')

@section('content')
    @if (session('mensaje'))
        @include('partials.alert')
    @endif

    <div class="d-flex justify-content-center">
        <div class="card m-5 text-center" style="width: 30rem">
            <img src="{{ asset('assets/img/ok.png') }}" class="card-img-top" alt="banner_fin">
            <div class="card-body">
                {{-- <h5 class="card-title fs-3">{{ $mensaje }}</h5> --}}
                <p class="card-text">¡Gracias por su compra!</p>
                <p class="card-text"><small class="text-muted">
                        <a href="{{ route('page.index', '#servicios') }}" class="text-primary">Ver mas productos</a>
                    </small></p>
            </div>
        </div>

    </div>

@endsection
