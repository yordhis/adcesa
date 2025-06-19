@extends('layouts.page')

@section('title', 'Crear Pedido')

@section('content')
    @if (session('mensaje'))
        @include('partials.alert')
    @endif

    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-xs-12">

            </div>
            <div class="col-sm-6 col-xs-12">
                <form action="{{ route('pedidos.store') }}" method="post">
                    @csrf
                   
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad" min="1" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </form>
            </div>
        </div>
    </div>


@endsection
