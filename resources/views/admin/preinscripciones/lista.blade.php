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
                <h2> Lista de Pre-Inscripciones </h2>
            </div>


            <div class="col-sm-9 col-xs-12">
                <form action="{{ route('admin.preinscripciones.index') }}" method="post">
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
                                    {{ $request->estatus == 1 ? 'Inscriptos' : '' }}
                                    {{ $request->estatus == 2 ? 'Pendientes' : '' }}
                                </option>
                            @endif
                            <option value="1">Inscriptos</option>
                            <option value="2">Pendientes</option>
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
                            <th scope="col">Plan</th>
                            <th scope="col">Nivel</th>
                            <th scope="col">Precio del nivel</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Estatus</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($preinscripciones as $preinscripcion)
                            <tr>
                                <td>{{ $preinscripcion->codigo }}</td>
                                <td>
                                    {{ $preinscripcion->estudiante->nombre ?? 'Sin nombre' }} <br>
                                    C.I.: {{ number_format($preinscripcion->estudiante->cedula, 0, ',', '.') }} <br>
                                    Telf: {{ $preinscripcion->estudiante->telefono ?? 'Sin telefono' }} <br>

                                </td>
                                <td class="fs-5">{{ $preinscripcion->nivel->nombre }} </td>
                                <td class="fs-5">{{ $preinscripcion->plan->nombre }} </td>
                                <td class="fs-5">
                                    {{ number_format($preinscripcion->nivel->precio, 2, ',', '.') }} $
                                </td>
                                <td class="fs-5">
                                    {{ $preinscripcion->created_at }} 
                                </td>
                           
                                <td
                                    class="
                                    {{ $preinscripcion->estatus == 1 ? 'table-success' : '' }}
                                    {{ $preinscripcion->estatus == 0 ? 'table-danger' : '' }}
                                ">
                                    {{ $preinscripcion->estatus == 1 ? 'Inscripto' : '' }}
                                    {{ $preinscripcion->estatus == 0 ? 'Pendiente' : '' }}
                                </td>
                                <td>

                                    @include('admin.preinscripciones.partials.modalVer')
                                    @include('admin.preinscripciones.partials.modalEditar')
                                    @include('admin.preinscripciones.partials.modalEliminar')

                               
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>

                            <td colspan="8" class="text-center table-secondary">
                                Total de Pre-inscripciones: {{ $preinscripciones->total() }} |
                                <a href="{{ route('admin.preinscripciones.index') }}" class="text-primary">
                                    Ver todo
                                </a>
                                <br>
                            </td>
                        </tr>
                    </tfoot>
                </table>

                <!-- End Table with stripped rows -->
                <div class="col-sm-6 col-xs-12">
                    {{ $preinscripciones->appends(['filtro' => $request->filtro, 'estatus' => $request->estatus])->links() }}
                </div>

            </div>
        </div>
    </section>


    {{-- <script src="{{ asset('assets/js/master.js') }}" defer></script>
    <script src="{{ asset('assets/js/pagos/create.js') }}" defer></script>
    <script src="{{ asset('assets/js/inscripciones/lista.js') }}" defer></script>
    <script src="{{ asset('assets/js/util/activarFormObservacion.js') }}"></script> --}}


@endsection
