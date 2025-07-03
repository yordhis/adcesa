@extends('layouts.index')

@section('title', 'Página o sesión expiró (419)')

@section('content')
    <div class="card mt-5">
        <div class="card-body">
            <h1>Información del error:</h1>
            <p class="fs-5 text-danger">
                Página o sesión expiró <span class="text-danger">(419)</span>
            </p>

            <a href="{{ route('login.index') }}" class="btn btn-primary">Ir al login</a>
        </div>
    </div>
    
@endsection