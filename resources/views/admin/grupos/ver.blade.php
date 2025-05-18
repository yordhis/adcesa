@extends('layouts.app')

{{-- @section('title', 'Lista de Profesores') --}}

@section('content')
    @isset($respuesta['activo'])
        @include('partials.alert')
    @endisset

    <div id="alert"></div>

    <!-- Card with header and footer -->
    <div class="card rounded-5">
        <div class="card-header rounded-5 shadow bg-primary">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <h2 class="text-white">Grupo {{ $grupo->nombre }} {{ $mensaje ?? '' }}</h2>
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
                            <b class="text-warning">Horario:</b> De: {{ $grupo->hora_inicio }} hasta
                            {{ $grupo->hora_fin }}
                            <br>
                            <b class="text-warning">Días:</b> {{ $grupo->dias }}

                        </p>
                    </div>

                </div>
            </div>
        </div>
        <div class="card-body">
            <h5 class="card-title">Estudiantes</h5>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="bg-primary text-white">Nombre</th>
                        <th class="bg-primary text-white">Cédula</th>
                        <th class="bg-success text-white">Abonado</th>
                        <th class="bg-danger text-white">Pendiente</th>
                        <th class="bg-primary text-white">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grupo->estudiantes as $estudiante)
                        <tr>
                            <td>
                                {{ $estudiante->nombre }}
                            </td>
                            <td>
                                {{ $estudiante->nacionalidad . "-" . $estudiante->cedulaFormateada }}
                            </td>
                            <td class="table-success">
                                100
                            </td>
                            <td class="table-danger">
                                50
                            </td>
                            <td>
                                <div class="d-flex flex-row-reverse "> 
                                    @include('admin.grupos.partials.modalEstudiante')

                                    <a href="{{ route('admin.pagos.process', [ $estudiante->cedula, "estudiante"]) }}" >
                                        <i class="bi bi-paypal fs-3 "></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <div class="card-footer">
            <p class="text-center fs-6">
                Total de estudiantes: {{ $grupo->matricula }}
            </p>
        </div>
    </div><!-- End Card with header and footer -->
@endsection
