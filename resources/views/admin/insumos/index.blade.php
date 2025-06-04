@extends('layouts.app')

@section('title', 'Insumos')

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

            <div class="col-12">
                <h2> Insumos </h2>
            </div>

            <div class="col-sm-6 col-xs-12 ">
                @include('admin.insumos.partials.modalform')
            </div>

            <!-- Filtro de insumos -->
            <div class="col-sm-6 col-xs-12">
                <form action="{{ route('admin.insumos.index') }}" method="post">
                    @csrf
                    @method('GET')
                    <div class="input-group mb-3">
                        <label for="filtro" class="text-primary p-2">Buscar</label>
                        <input type="text" class="form-control" name="filtro" placeholder="Buscar por: Nombres, Cédula o E-mail" aria-label="Filtrar"
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
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Cédula</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($insumos as $insumo)
                            <tr class="{{ $insumo->estatus == 2 ? 'table-danger' : '' }}
                                {{ $insumo->estatus == 0 ? 'table-secondary' : '' }}">
                                <th scope="row">{{ $insumo->id }}</th>
                                <td>{{ $insumo->nombres }}</td>
                                <td>{{ $insumo->cedula }}</td>
                                <td>{{ $insumo->telefono }}</td>
                


                                <td>
                                    @include('admin.insumos.partials.modalver')

                                    <a href="{{ route('admin.insumos.edit', $insumo->id) }}">
                                        <i class="bi bi-pencil text-warning"></i>
                                    </a>


                                    @include('admin.insumos.partials.modal')


                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>

                            <td colspan="7" class="text-center table-secondary">
                                Total de insumos: {{ $insumos->total() }} |
                                <a href="{{ route('admin.insumos.index') }}" class="text-primary">
                                    Ver todo
                                </a>
                                <br>
                            </td>
                        </tr>
                    </tfoot>
                </table>

                <!-- End Table with stripped rows -->
                <div class="col-sm-6 col-xs-12">
                    {{ $insumos->appends(['filtro' => $request->filtro])->links() }}
                </div>

            </div>

        </div>

    </section>

@endsection
