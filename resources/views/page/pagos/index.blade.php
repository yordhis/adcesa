@extends('layouts.page')

@section('title', 'Adcesa - Pago')

@section('content')
    @if (session('mensaje'))
        @include('partials.alert')
    @endif

    <!-- Seccion de pago -->
    <div class="container-fluid p-5">
        <div class="row">
            <div class="col-12">
                @if ($errors->any())
                    <div class="alert alert-danger text-start">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            
            @include('page.partials.carrito')
            @include('page.partials.formularioDePago')
        </div>
    </div>

@endsection
