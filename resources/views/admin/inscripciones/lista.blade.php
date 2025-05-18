@extends('layouts.app')

@section('title', 'Lista de Inscripciones')

@section('content')

    @if (session('mensaje'))
        @include('partials.alert')
    @endif

    <div id="alert"></div>

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
                <h2> Lista de Inscripciones </h2>
            </div>

            <div class="col-sm-3 col-xs-12">
                <a href="{{ route('admin.inscripciones.createEstudiante') }}" class="btn btn-primary">Procesar
                    inscripción</a>
            </div>
            <div class="col-sm-9 col-xs-12">
                <form action="{{ route('admin.inscripciones.index') }}" method="post">
                    @csrf
                    @method('get')
                    <div class="input-group mb-3">
                        <!-- Filtro -->
                        <input type="text" class="form-control w-75" name="filtro" placeholder="Buscar"
                            aria-label="Filtrar" aria-describedby="button-addon2"
                            value="{{ $request->filtro ?? '' }}"><!-- End filtro-->

                        <!-- Filtro Estatus -->
                        <select name="estatus" id="estatus" class="form-select">
                            <option disabled selected> Filtre por estatus </option>
                            @if ($request->estatus)
                                <option value="{{ $request->estatus }}" selected>
                                    {{ $request->estatus == 1 ? 'Activo' : '' }}
                                    {{ $request->estatus == 2 ? 'Inactivo' : '' }}
                                    {{ $request->estatus == 3 ? 'Borrados' : '' }}
                                </option>
                            @endif
                            <option value="1">Activo</option>
                            <option value="2">Inactivo</option>
                            @if (Auth::user()->rol == 1)
                                <option value="3">Borrados</option>
                            @endif
                        </select><!-- End Filtro Estatus -->

                        <button class="btn btn-primary" type="submit" id="button-addon2">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div class="col-lg-12 table-responsive">
                <!-- Table with stripped rows -->

                <table class="table table-hover mt-2">
                    <thead>
                        <tr class="table-dark text-white">
                            <th scope="col">Código</th>
                            <th scope="col">Estudiante</th>
                            <th scope="col">Total</th>
                            <th scope="col">Abonado</th>
                            <th scope="col">Pendientes</th>
                            <th scope="col">Proximo pago</th>
                            <th scope="col">Estatus</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($inscripciones as $inscripcion)
                            <tr>
                                <td>{{ $inscripcion->codigo }}</td>
                                <td>
                                    {{ $inscripcion->estudiante_nombre ?? 'Sin nombre' }} <br>
                                    C.I.:{{ number_format($inscripcion->cedula_estudiante, 0, ',', '.') }}
                                </td>
                                <td class="fs-5 table-info">{{ number_format($inscripcion->total, 2, ',', '.') }} $</td>
                                <td class="fs-5 table-success">{{ number_format($inscripcion->abono, 2, ',', '.') }} $</td>
                                <td class="fs-5 table-danger">
                                    {{ number_format($inscripcion->total - $inscripcion->abono, 2, ',', '.') }} $</td>
                                <td class="fs-5">
                                    @if ($inscripcion->proxima_fecha_pago == 'PAGADO')
                                        <i class='bi bi-check2-square text-success fs-4'></i>
                                        {{ $inscripcion->proxima_fecha_pago }}
                                    @else
                                        @include('admin.inscripciones.partials.modalcuotas')
                                    @endif
                                </td>
                                <td
                                    class="
                                    {{ $inscripcion->estatus == 1 ? 'table-success' : '' }}
                                    {{ $inscripcion->estatus == 2 ? 'table-danger' : '' }}
                                    {{ $inscripcion->estatus == 0 ? 'table-secondary' : '' }}
                                ">
                                    {{ $inscripcion->estatus == 1 ? 'Activo' : '' }}
                                    {{ $inscripcion->estatus == 2 ? 'Inactivo' : '' }}
                                    {{ $inscripcion->estatus == 0 ? 'Borrados' : '' }}
                                </td>
                                <td>

                                    @if ($inscripcion->proxima_fecha_pago != 'PAGADO')
                                        @include('admin.inscripciones.partials.modalpagar')
                                    @endif



                                    @include('admin.inscripciones.partials.modalVer')
                                    @include('admin.inscripciones.partials.modalimprir')

                                    @if ($inscripcion->estatus >= 1)
                                        @if ($inscripcion->estatus_reasignar)
                                            @include('admin.inscripciones.partials.modalreasignargrupo')
                                        @endif
                                        @include('admin.inscripciones.partials.modal')

                                        @if (Auth::user()->rol == 1)
                                            @include('admin.inscripciones.partials.modalEliminar')
                                        @endif
                                    @endif
                                    @if ($inscripcion->estatus == 0 || $inscripcion->estatus == 2)
                                        @if (Auth::user()->rol == 1)
                                            @include('admin.inscripciones.partials.modalRestaurar')
                                        @endif
                                    @endif

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>

                            <td colspan="8" class="text-center table-secondary">
                                Total de inscripciones: {{ $inscripciones->total() }} |
                                <a href="{{ route('admin.inscripciones.index') }}" class="text-primary">
                                    Ver todo
                                </a>
                                <br>
                            </td>
                        </tr>
                    </tfoot>
                </table>

                <!-- End Table with stripped rows -->
                <div class="col-sm-6 col-xs-12">
                    {{ $inscripciones->appends(['filtro' => $request->filtro, 'estatus' => $request->estatus])->links() }}
                </div>

            </div>
        </div>
    </section>


    <script src="{{ asset('assets/js/master.js') }}" defer></script>
    <script src="{{ asset('assets/js/pagos/create.js') }}" defer></script>
    <script src="{{ asset('assets/js/inscripciones/lista.js') }}" defer></script>
    <script src="{{ asset('assets/js/util/activarFormObservacion.js') }}"></script>


@endsection
