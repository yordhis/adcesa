@extends('layouts.app')

{{-- @section('title', 'Lista de Profesores') --}}

@section('content')
    @isset($respuesta)
        @include('partials.alert')
    @endisset
    <div id="alert"></div>

    <!-- Card with header and footer -->
    <div class="card rounded-5">
        <div class="card-header rounded-5 shadow bg-primary">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <h2 class="text-white">Grupo {{ $grupo->nombre }}</h2>
                        <p class="text-white">
                            <b class="text-warning">Nivel:</b> {{ $grupo->nivel['nombre'] }} <br>
                            <b class="text-warning">Libro:</b> {{ $grupo->nivel['libro'] }} <br>
                            <b class="text-warning">Inversión:</b> {{ $grupo->nivel['precio'] }} $ <br>
                            <b class="text-warning">Matricula:</b> {{ $grupo->matricula }} estudiantes
                        </p>

                    </div>

                    <div class="col-sm-6 text-end">
                        <h2 class="text-white">Código: <b class="text-warning">{{ $grupo->codigo }}</b></h2>
                        <p class="text-white">
                            <b class="text-warning">Profesor:</b> {{ $grupo->profesor['nombre'] }} <br>
                            <b class="text-warning">Fecha de Inicio del curso:</b> {{ $grupo->fecha_inicio }} <br>
                            <b class="text-warning">Fecha de Finalización del curso:</b> {{ $grupo->fecha_fin }} <br>
                            <b class="text-warning">Horario:</b> De: {{ $grupo->hora_inicio }} hasta {{ $grupo->hora_fin }}
                            <br>
                            <b class="text-warning">Días:</b> {{ $grupo->dias }}

                        </p>
                    </div>

                </div>
            </div>
        </div>
        <div class="card-body">
            <h5 class="card-title">Estudiantes</h5>

            @foreach ($grupo->estudiantes as $estudiante)
                <div class="card mb-3 rounded-5 shadow">
                    <div class="row g-0">
                        <div class="col-md-2">
                            <img src="{{ $estudiante->foto }}" class="img-fluid rounded-start" alt="foto">
                        </div>

                        <div class="col-md-4">
                            <div class="card-body">
                                <p class="card-text">
                                <h5 class="card-text text-dark">Estudiante</h5>
                                <b class="fs-5 text-primary"> {{ $estudiante->nombre }} </b> <br>
                                <small class="text-muted fs-6">{{ $estudiante->cedula }}</small> <br>
                                <small class="text-muted fs-6">{{ $estudiante->edad }} años</small>
                                </p>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card-body">
                                <p class="card-text">
                                <h5 class="card-text text-dark">Contacto</h5>
                                <b class="fs-5 text-primary"> {{ $estudiante->telefono }} </b> <br>
                                <small class="text-muted fs-6">{{ $estudiante->correo }}</small> <br>
                                </p>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card-body">
                                <p class="card-text">
                                <h5 class="card-text text-dark">Pagos</h5>
                                <b class="fs-5 text-primary"> Pendientes </b> <br>
                                <small class="text-danger fs-6"> 2023-08-10 | 50$</small> <br>
                                <small class="text-danger fs-6"> 2023-09-10 | 50$</small>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card-body">
                                <h5 class="card-header text-success">Abonado: 50$</h5>
                                <p class=" d-flex d-inline">
                                    <a href="#" target="_self">
                                        @include('admin.grupos.partials.modalEstudiante')
                                    </a>
                                    <a href="/pagos/{{ $estudiante->cedula }}" target="_self">
                                        <i class="bi bi-paypal fs-3"></i>
                                    </a>
                                </p>
                            </div>
                        </div>


                    </div>
                </div>
            @endforeach

        </div>
        <div class="card-footer">
            <p class="text-center fs-6">
                Total de estudiantes: {{ $grupo->matricula }}
            </p>
        </div>
    </div><!-- End Card with header and footer -->
@endsection
