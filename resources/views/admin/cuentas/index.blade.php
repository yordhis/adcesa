@extends('layouts.app')

@section('title', 'Cuentas Bancarias')

@section('content')

    <!-- Sección de alertas de transacciones -->
    @if (session('mensaje'))
        @include('partials.alert')
    @endif
    <div id="alert"></div>

    <!-- Sección de alertas de errores de formularios -->
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



            <div class="col-sm-4 col-xs-12 ">
                <!-- Formulario de registro de cuentas -->
                @include('admin.cuentas.partials.modal-form-create')
            </div>

            <!-- Filtro de cuentas -->
            <div class="col-sm-8 col-xs-12">
                <form action="{{ route('admin.cuentas.index') }}" method="post">
                    @csrf
                    @method('GET')
                    <div class="input-group mb-3">
                        <label for="filtro" class="text-primary p-2">Buscar</label>
                        <!-- Input Filtro-->
                        <input type="text" class="form-control" value="{{ $request->filtro ?? '' }}" name="filtro"
                            placeholder="Buscar por: Nombre" aria-label="Filtrar" aria-describedby="button-addon2">

                        <!-- Selector del limite a listar en la tabla -->
                        <select name="limit" id="limit" class="form-select">
                            @if ($request->limit)
                                <option value="{{ $request->limit }}" selected>{{ $request->limit }}</option>
                            @else
                                <option disabled selected>Seleccione limite</option>
                            @endif
                            <option value="12">12</option>
                            <option value="24">24</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>

                        <!-- Selector de Ordenar lista -->
                        <select name="order" id="order" class="form-select">
                            @if ($request->order)
                                <option value="{{ $request->order }}" selected>
                                    {{ $request->order == 'DESC' ? 'Z-A' : 'A-Z' }}</option>
                            @else
                                <option disabled selected>Ordenar por</option>
                            @endif
                            <option value="ASC">A-Z</option>
                            <option value="DESC">Z-A</option>
                        </select>

                        <button class="btn btn-primary" type="submit" id="button-addon2">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>


            <div class="col-lg-12 table-responsive">

                <!-- Tabla de cuentas (lista) -->
                <table class="table table-hover  bg-white mt-2">
                    <thead>
                        <tr class="table-dark text-white">
                            <th scope="col">#</th>
                            <th scope="col">Método</th>
                            <th scope="col">Código</th>
                            <th scope="col">Banco</th>
                            <th scope="col">Titular</th>
                            <th scope="col">Tipo cuenta</th>
                            <th scope="col">Numero de cuenta</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($cuentas as $key => $cuenta)
                            <tr>
                                <th scope="row">{{ ($cuentas->currentPage() - 1) * $cuentas->perPage() + $key + 1 }}</th>
                                <td>{{ $cuenta->metodo }}</td>
                                <td>{{ $cuenta->codigo_banco }}</td>
                                <td>{{ $cuenta->nombre_banco }}</td>
                                <td>{{ $cuenta->titular }}</td>
                                <td>{{ $cuenta->tipo_cuenta }}</td>
                                <td>
                                    @if ($cuenta->numero_cuenta)
                                        {{ preg_replace('/^(\d{4})(\d{4})(\d{2})(\d{10})$/', '$1-$2-$3-$4', $cuenta->numero_cuenta) }}
                                    @else
                                        No asignado
                                    @endif
                                </td>
                                <td>
                                    @if ($cuenta->telefono)
                                        {{ preg_replace('/^(\d{4})(\d{3})(\d{4})$/', '($1)-$2-$3', $cuenta->telefono) }}
                                    @else
                                        No asignado
                                    @endif
                                </td>
                                <td>
                                    @include('admin.cuentas.partials.modal-form-edit')
                                    @include('admin.cuentas.partials.modal-delete')
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>

                            <td colspan="9" class="text-center table-secondary">
                                Total de cuentas: {{ $cuentas->total() }} |
                                <a href="{{ route('admin.cuentas.index') }}" class="text-primary">
                                    Ver todo
                                </a>
                                <br>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <!-- Fin Tabla de cuentas -->

                <!-- Paginación -->
                <div class="col-sm-6 col-xs-12">
                    {{ $cuentas->appends(['filtro' => $request->filtro, 'limit' => $request->limit])->links() }}
                </div>
                <!-- Fin Paginación -->

            </div>

        </div>

    </section>

@endsection
