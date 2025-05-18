@extends('layouts.app')

@section('title', 'Registrar inscripción')


@section('content')
    @if (session('mensaje'))
        @include('partials.alert')
    @endif
    <div id="alert"></div>

    <div class="container">
        <section class="section register d-flex flex-column align-items-center justify-content-center ">
            <div class="container">
                <div class="row justify-content-center">
                    <div class=" col-sm-12 d-flex flex-column align-items-center justify-content-center">

                        <div class="card ">

                            @if ($errors->any())
                                <div class="alert alert-danger text-start">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif


                            <div class="card-body">

                                <div class=" pb-2">
                                    <h5 class="card-title text-center pb-0 fs-2">Cargar estudiantes a la inscripción</h5>
                                    <p class="text-center text-danger small">Ingrese la cédula del estudiante para cargarlo
                                        a la planilla, en caso de no estar registrado puede registrar lo con el botón de
                                        Registrar estudiante.</p>
                                </div>
                                <form action="#estudiante" class="row g-3 needs-validation" method="post" novalidate>
                                    <div class="col-md-12">
                                        <label for="validationCustomUsername" class="form-label">Cédula o rif</label>

                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend">
                                                <i class="bi bi-credit-card"></i>
                                            </span>

                                            <input type="text" class="form-control" name="cedula_estudiante"
                                                id="cedula" aria-describedby="inputGroupPrepend"
                                                placeholder="Ingrese número de identificación." min="6"
                                                max="9" required>

                                            <button class="input-group-text btn btn-primary" type="submit"
                                                id="buscarEstudiante">Cargar</button>

                                            <div class="invalid-feedback">
                                                Por favor ingrese número de identificación.
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <dic class="card-foot p-2 text-center">
                                {{-- Modal Formulario registrar estudiante --}}
                                @include('admin.estudiantes.partials.modalFormulario')
                                {{-- Cierre de agregar estudiante --}}
                            </dic>
                        </div>


                        {{-- Mostramos la tarjeta informativa del estudiante --}}
                        <span id="preload_inscriciones"></span>
                        <div class="" id="dataEstudiante">
                        </div>{{-- ##FIN la tarjeta informativa del estudiante --}}

                        <a href="{{ route('admin.inscripciones.create') }}" class="btn btn-success"
                            id="botonProcesarInscripcion">
                            Procesar inscripción
                            <i class="bi bi-arrow-right"></i>
                        </a>

                    </div>
                </div>
            </div>

        </section>

        <script src="{{ asset('assets/js/master.js') }}" defer></script>
        <script src="{{ asset('assets/js/estudiantes/componentes/AccordionComponente.js') }}" defer></script>
        <script src="{{ asset('assets/js/estudiantes/agregarPlanilla.js') }}" defer></script>
        <script src="{{ asset('assets/js/estudiantes/create.js') }}" defer></script>
        <script src="{{ asset('assets/js/representantes/getRepresentante.js') }}" defer></script>
    @endsection
