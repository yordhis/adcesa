@extends('layouts.app')

@section('title', 'Registrar Pago')


@section('content')
    @isset($respuesta)
        @include('partials.alert')
    @endisset

    <div class="container">
        <section class="section register d-flex flex-column align-items-center justify-content-center ">
            <div class="container">
                <div class="row justify-content-center">
                    <div class=" col-sm-12 d-flex flex-column align-items-center justify-content-center">

                        <div class="card ">

                            <div class="card-body">

                                <div class=" pb-2">
                                    <h5 class="card-title text-center pb-0 fs-2">Registrar Pago</h5>
                                    <p class="text-center text-danger small">Rellene todos los campos</p>
                                </div>




                                <form action="{{ route('admin.pagos.store') }}" method="post" class="row g-3 needs-validation"
                                    enctype="multipart/form-data" novalidate>
                                    @csrf
                                    @method('post')

                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Número de control
                                            <span class=" text-primary">(Es automático)</span>
                                        </label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                                <i class="bi bi-upc-scan"></i>
                                            </span>
                                            <input type="text" name="codigo" class="form-control fs-5 text-danger"
                                                id="yourUsername" value="{{ $codigo }}" readonly required>
                                            <div class="invalid-feedback">Por favor, ingrese codigo! </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Cédula del estudiante</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                                <a href="#" target="_self" class="text-white fs-5"
                                                    id="buscarEstudiante">
                                                    <i class="bi bi-search"></i>
                                                </a>
                                            </span>
                                            <input type="text" name="cedula_estudiante" class="form-control fs-5"
                                                id="cedula" value="{{ $estudiante[0]->cedula ?? '' }}"
                                                placeholder="Ingrese Cédula del estudiante" required>
                                            <div class="invalid-feedback">Por favor, Ingrese cédula del estudiante!</div>
                                        </div>


                                    </div>

                                    {{-- Mostramos la tarjeta informativa del estudiante --}}
                                    <div id="dataEstudiante">

                                    </div>{{-- ##FIN la tarjeta informativa del estudiante --}}

                                    {{-- Mostramos las cuotas pendiente del estudiante --}}
                                    <div id="cuotasEstudiante">

                                    </div>{{-- ##FIN cuotas pendiente del estudiante --}}

                                    <div class="col-12">
                                        <label for="validationCustom04" class="form-label">Asigne concepto de pago</label>
                                        <select name="concepto" class="form-select" id="validationCustom04" required>
                                            <option selected disabled value="">Seleccione Concepto</option>

                                            @foreach ($conceptos as $concepto)
                                                <option value="{{ $concepto->descripcion }}">{{ $concepto->codigo }} -
                                                    {{ $concepto->descripcion }}</option>
                                            @endforeach

                                        </select>
                                        <div class="invalid-feedback">
                                            Por favor, Seleccione Concepto de pago!
                                        </div>
                                    </div>


                                    <div class="col-12" id="divMetodos">
                                        <label for="yourPassword" class="form-label">Métodos de pago</label><br>
                                        @foreach ($metodos as $metodo)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input metodo" type="checkbox"
                                                    id="{{ $metodo['metodo'] }}" name="met_{{ $metodo['metodo'] }}"
                                                    value="{{ $metodo['metodo'] }}" required>
                                                <label class="form-check-label"
                                                    for="{{ $metodo['metodo'] }}">{{ $metodo['metodo'] }}</label>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="col-6">
                                        <label for="yourPassword" class="form-label">Fecha de pago</label>
                                        <input type="date" name="fecha" class="form-control" id="yourUsername"
                                            placeholder="Ingrese fecha de pago." required>
                                        <div class="invalid-feedback">Por favor, Ingrese fecha de pago!</div>
                                    </div>

                                    <div class="col-6">
                                        <label for="yourPassword" class="form-label">N° Referencia del pago</label>
                                        <input type="text" name="referencia" class="form-control" id="referencia"
                                            placeholder="Ingrese N° referencia del pago.">
                                        <div class="invalid-feedback">Por favor, Ingrese N° referencia del pago!</div>
                                    </div>


                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Monto Bs</label>
                                        <input type="text" name="mon_bs" class="form-control" id="monto_bs"
                                            placeholder="Ingrese monto a pagar en Bolivares.">
                                        <div class="invalid-feedback">Por favor, Ingrese monto a pagar!</div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Monto Usd</label>
                                        <input type="text" name="mon_usd" class="form-control" id="monto_usd"
                                            placeholder="Ingrese monto a pagar en USD.">
                                        <div class="invalid-feedback">Por favor, Ingrese monto a pagar!</div>
                                    </div>

                                    <!-- Se envia un codigo de inscripcion en caso de que exista -->
                                    @if (isset($codigoInscripcion))
                                        <input type="hidden" name="codigoInscripcion" value="{{ $codigoInscripcion }}">
                                    @endif



                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Procesar pago</button>
                                    </div>

                                </form>



                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>
    @endsection
