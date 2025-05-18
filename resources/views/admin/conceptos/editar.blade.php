@extends('layouts.app')

@section('title', 'Editar concepto de pago')


@section('content')

    @if (session('mensaje'))
        @include('partials.alert')
    @endif

    <div id="alert"></div>

    <div class="container">
        <section class="section register d-flex flex-column align-items-center justify-content-center ">
            <div class="container">
                <div class="row justify-content-center">
                    <div class=" col-sm-8 d-flex flex-column align-items-center justify-content-center">

                        <div class="card ">

                            <div class="card-body">

                                <div class=" pb-2">
                                    <h5 class="card-title text-center pb-0 fs-2">Editar concepto de pago</h5>
                                    <p class="text-center text-danger small">Rellene todos los campos</p>
                                </div>




                                <form action="{{ route('admin.conceptos.update', $concepto->id) }}" method="post"
                                    class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
                                    @csrf
                                    @method('put')

                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Código
                                            <span class=" text-primary">(Ingrese un código)</span>
                                        </label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                                <i class="bi bi-upc-scan"></i>
                                            </span>
                                            <input type="text" name="codigo" class="form-control fs-5 text-danger"
                                                id="yourUsername" placeholder="Ingrese un código. Ejemplo: HF-1"
                                                value="{{ old('codigo') ?? $concepto['codigo'] }}" required>
                                            <div class="invalid-feedback">Por favor, ingrese codigo! </div>
                                        </div>
                                        @error('codigo')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Descripción del concepto de
                                            pago</label>
                                        <input type="text" name="descripcion" class="form-control" id="yourUsername"
                                            placeholder="Ingrese descripción del concepto de pago"
                                            value="{{ old('descripcion') ?? $concepto['descripcion'] }}" required>
                                        <div class="invalid-feedback">Por favor, Ingrese descripcion del concepto de pago!
                                        </div>
                                        @error('descripcion')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Estatus del concepto de
                                            pago</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" value="1" name="estatus" type="checkbox"
                                                id="flexSwitchCheckChecked" {{ $concepto['estatus'] ? 'checked' : '' }}>
                                            <label class="form-check-label" for="flexSwitchCheckChecked">
                                                {{ $concepto['estatus'] ? 'Activo' : 'Inactivo' }}
                                            </label>
                                        </div>
                                        <div class="invalid-feedback">Por favor, Ingrese descripcion del concepto de pago!
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Guardar cambios</button>
                                    </div>

                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>
    @endsection
