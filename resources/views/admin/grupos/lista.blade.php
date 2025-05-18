@extends('layouts.app')

@section('title', 'Lista de grupos')

@section('content')

    @if (session('mensaje'))
        @include('partials.alert')
    @endif
    <div id="alert"></div>
    {{-- respuestas de las validaciones --}}
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

    <section class="section">
        <div class="row">

            <div class="col-12">
                <h2> Lista de grupos de estudio </h2>
            </div>

            <div class="col-sm-3 col-xs-12">
                @include('admin.grupos.partials.modalformulario')
            </div>
            <div class="col-sm-3 col-xs-12">

                <form action="{{ route('admin.grupos.index') }}" method="post" class="row g-3 needs-validation" novalidate>
                    @csrf
                    @method('GET')

                    <div class="input-group mb-3">
                        <label for="validationCustom01" class="form-label"></label>
                        <select class="form-select" id="validationCustom01" name="estatus" required>
                            <option selected disabled>Seleccione filtro</option>
                            <option value="1">Activos</option>
                            <option value="2">Inactivos</option>
                            <option value="3">Borrado temporal</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid state.
                        </div>
                        <button class="btn btn-primary" type="submit" id="button-addon2">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div class="col-sm-6 col-xs-12">
                <form action="{{ route('admin.grupos.index') }}" method="post">
                    @csrf
                    @method('get')
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="filtro"
                            placeholder="Filtrar (Por cédula, Por nombre del grupo y codigo de grupo)" aria-label="Filtrar"
                            aria-describedby="button-addon2" required>
                        <button class="btn btn-primary" type="submit" id="button-addon2">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div class="col-lg-12 table-responsive">
                <!-- Table with stripped rows -->

                <table class="table table-hover  bg-white mt-2">
                    <thead>
                        <tr class="table-dark text-white">

                            <th scope="col">Código</th>
                            <th scope="col">Grupo</th>
                            <th scope="col">Profesor</th>
                            <th scope="col">Nivel</th>
                            <th scope="col">Matricula</th>
                            <th scope="col">Estatus</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($grupos as $grupo)
                            <tr>
                                <td>{{ $grupo->codigo }}</td>
                                <td>{{ $grupo->nombre }}</td>
                                <td>{!! $grupo->profesor_nombre . '<br>' . 'C.I.:' . $grupo->profesor_cedula !!}
                                </td>
                                <td>{{ $grupo->nivel_nombre }} </td>
                                <td>{{ $grupo->matricula }} </td>
                                <td>
                                    @if ($grupo->estatus == 1)
                                        <div class="bg-success w-100 text-center p-2 text-white fw-bold">
                                            ACTIVO
                                        </div>
                                    @else
                                        <div class="bg-danger w-100 text-center p-2 text-white fw-bold">
                                            INACTIVO
                                        </div>
                                    @endif
                                </td>


                                <td>

                                    @include('admin.grupos.partials.modalVerGrupo')

                                    <a href="{{ route('admin.grupos.edit', $grupo->id) }}">
                                        <i class="bi bi-pencil fs-3 text-warning"></i>
                                    </a>

                                    @include('admin.grupos.partials.modalimprir')
                                    @include('admin.grupos.partials.modal')


                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>

                            <td colspan="8" class="text-center table-secondary">
                                Total de grupos de estudios: {{ $grupos->total() }} |
                                <a href="{{ route('admin.grupos.index') }}" class="text-primary">
                                    Ver todo
                                </a>
                                <br>
                            </td>
                        </tr>
                    </tfoot>
                </table>

                <!-- End Table with stripped rows -->
                <div class="col-sm-6 col-xs-12">
                    {{ $grupos->appends([
                            'filtro' => $request->filtro,
                            'estatus' => $request->estatus
                        ])->links() }}
                </div>

            </div>
        </div>
    </section>
@endsection
