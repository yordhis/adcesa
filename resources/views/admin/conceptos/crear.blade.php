@extends('layouts.app')

@section('title', 'Crear Concepto de pago')


@section('content')

    @if (session('mensaje'))
        @include('partials.alert')
    @endif

    <div class="container">
        <section class="section register d-flex flex-column align-items-center justify-content-center ">
            <div class="container">
                <div class="row justify-content-center">
                    <div class=" col-sm-8 d-flex flex-column align-items-center justify-content-center">

                        <div class="card ">

                            <div class="card-body">

                                <div class=" pb-2">
                                    <h5 class="card-title text-center pb-0 fs-2">Crear Concepto de pago</h5>
                                    <p class="text-center text-danger small">Rellene todos los campos</p>
                                </div>




                                <form action="/conceptos" method="post" class="row g-3 needs-validation"
                                    enctype="multipart/form-data" novalidate>
                                    @csrf
                                    @method('post')

                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Código
                                            <span class=" text-primary">(Ingrese un codigo)</span>
                                        </label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                                <i class="bi bi-upc-scan"></i>
                                            </span>
                                            <input type="text" name="codigo" class="form-control fs-5 text-danger"
                                                id="yourUsername" placeholder="Ingrese un código. Ejemplo: HF-1"
                                                value="{{ old('codigo') }}" required>
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
                                            value="{{ old('descripcion') }}" required>
                                        <div class="invalid-feedback">Por favor, Ingrese descripcion del concepto de pago!
                                        </div>
                                        @error('descripcion')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>






                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Crear Concepto de pago</button>
                                    </div>

                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>
    @endsection
