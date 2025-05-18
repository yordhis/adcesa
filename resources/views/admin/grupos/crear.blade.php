@extends('layouts.app')

@section('title', 'Crear Grupo de Estudio')


@section('content')
    @isset($respuesta)
        @include('partials.alert')
    @endisset
    <div id="alert"></div>
    <div class="container">
        <section class="section register d-flex flex-column align-items-center justify-content-center ">
            <div class="container">
                <div class="row justify-content-center">
                    <div class=" col-sm-12 d-flex flex-column align-items-center justify-content-center">

                        <div class="card ">

                            <div class="card-body">

                                <div class=" pb-2">
                                    <h5 class="card-title text-center pb-0 fs-2">Crear Grupo de estudio</h5>
                                    <p class="text-center text-danger small">Rellene todos los campos</p>
                                </div>




                                <form action="{{ route('admin.grupos.store') }}" method="post" class="row g-3 needs-validation"
                                    enctype="multipart/form-data" novalidate>
                                    @csrf
                                    @method('post')

                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Código
                                            <span class=" text-primary">(Es automático)</span>
                                        </label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                                <i class="bi bi-upc-scan"></i>
                                            </span>
                                            <input type="text" name="codigo" class="form-control fs-5 text-danger"
                                                id="yourUsername" value="{{ $codigo ?? $request->codigo }}" readonly
                                                required>
                                            <div class="invalid-feedback">Por favor, ingrese codigo! </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Nombre del grupo de estudio</label>
                                        <input type="text" name="nombre" class="form-control" id="yourUsername"
                                            placeholder="Ingrese nombre del grupo de estudio"
                                            value="{{ $request->nombre ?? '' }}" required>
                                        <div class="invalid-feedback">Por favor, Ingrese nombre del plan!</div>
                                    </div>

                                    <div class="col-12">
                                        <label for="validationCustom04" class="form-label">Asigne Nivel de estudio</label>
                                        <select name="codigo_nivel" class="form-select" id="validationCustom04" required>
                                            <option value="">Seleccione Nivel</option>

                                            @foreach ($niveles as $nivel)
                                                @if (isset($request->codigo_nivel))
                                                    @if ($request->codigo_nivel == $nivel->codigo)
                                                        <option value="{{ $nivel->codigo }}" selected>{{ $nivel->codigo }} -
                                                            {{ $nivel->nombre }} - Costo: {{ $nivel->precio }}</option>
                                                        @php continue; @endphp
                                                    @endif
                                                @endif
                                                <option value="{{ $nivel->codigo }}">{{ $nivel->codigo }} -
                                                    {{ $nivel->nombre }} - Costo: {{ $nivel->precio }}</option>
                                            @endforeach

                                        </select>
                                        <div class="invalid-feedback">
                                            Por favor, Seleccione Nivel de estudio!
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="validationCustom04" class="form-label">Asigne Profesor</label>
                                        <select name="cedula_profesor" class="form-select" id="validationCustom04" required>
                                            <option value="">Seleccione Profesor</option>

                                            @foreach ($profesores as $profesor)
                                                @if (isset($request->cedula_profesor))
                                                    @if ($request->cedula_profesor == $profesor->cedula)
                                                        <option value="{{ $profesor->cedula }}" selected>
                                                            {{ $profesor->cedula }} -
                                                            {{ $profesor->nombre }}</option>
                                                        @php continue; @endphp
                                                    @endif
                                                @endif
                                                <option value="{{ $profesor->cedula }}">{{ $profesor->cedula }} -
                                                    {{ $profesor->nombre }}</option>
                                            @endforeach

                                        </select>
                                        <div class="invalid-feedback">
                                            Por favor, Seleccione Profesor!
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <h3>Horario</h3>
                                        <hr>
                                    </div>

                                    <div class="col-6">
                                        <label for="yourPassword" class="form-label">De</label>
                                        <input type="time" name="hora_inicio" class="form-control" id="yourUsername"
                                            placeholder="Ingrese hora de inicio de clase."
                                            value="{{ $request->hora_inicio ?? '' }}" required>
                                        <div class="invalid-feedback">Por favor, Ingrese la descripción del grupo!</div>
                                    </div>

                                    <div class="col-6">
                                        <label for="yourPassword" class="form-label">Hasta</label>
                                        <input type="time" name="hora_fin" class="form-control" id="yourUsername"
                                            placeholder="Ingrese hora de finalización de clase."
                                            value="{{ $request->hora_fin ?? '' }}" required>
                                        <div class="invalid-feedback">Por favor, Ingrese la descripción del plan!</div>
                                    </div>

                                    <div class="col-12">
                                        <h5>Seleccione los Días de clase</h5>
                                    </div>

                                    <div class="col-12">
                                        @foreach ($dias as $dia)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="{{ $dia }}"
                                                    name="dia_{{ $dia }}" value="{{ $dia }}" id="metodos">
                                                <label class="form-check-label"
                                                    for="{{ $dia }}">{{ $dia }}</label>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="col-6">
                                        <label for="yourPassword" class="form-label">Inicio del curso</label>
                                        <input type="date" name="fecha_inicio" class="form-control" id="yourUsername"
                                            placeholder="Ingrese fecha de incio del curso."
                                            value="{{ $request->fecha_inicio ?? '' }}" required>
                                        <div class="invalid-feedback">Por favor, Ingrese fecha de incio del curso!</div>
                                    </div>
                                    <div class="col-6">
                                        <label for="yourPassword" class="form-label">Fin del curso</label>
                                        <input type="date" name="fecha_fin" class="form-control" id="yourUsername"
                                            placeholder="Ingrese fecha de finalización del curso."
                                            value="{{ $request->fecha_fin ?? '' }}" required>
                                        <div class="invalid-feedback">Por favor, Ingrese fecha de finalización del curso.!
                                        </div>
                                    </div>



                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Crear Grupo de
                                            estudio</button>
                                    </div>

                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>
    @endsection
