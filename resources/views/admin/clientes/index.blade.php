@extends('layouts.app')

@section('title', 'Lista de clientes')

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

            <!-- Botón para abrir el modal formulario de registro de cliente -->
            <div class="col-sm-6 col-xs-12 ">
                @include('admin.clientes.partials.modal-form-create')
            </div>

            <!-- Filtro de clientes -->
            <div class="col-sm-6 col-xs-12">
                <form action="{{ route('admin.clientes.index') }}" method="post">
                    @csrf
                    @method('GET')
                    <div class="input-group mb-3">
                        <label for="filtro" class="text-primary p-2">Buscar</label>
                        <input type="text" class="form-control" name="filtro"
                            placeholder="Buscar por: Nombres, Cédula o E-mail" aria-label="Filtrar"
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
                            <th scope="col">E-mail</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($clientes as $key => $cliente)
                            <tr
                                class="{{ $cliente->estatus == 2 ? 'table-danger' : '' }}
                                {{ $cliente->estatus == 0 ? 'table-secondary' : '' }}">
                                <th scope="row">{{ ($clientes->currentPage() - 1) * $clientes->perPage() + $key + 1 }}</th>
                                <td>{{ $cliente->nombres . ' ' . $cliente->apellidos }}</td>
                                <td>{{ $cliente->nacionalidad . '-'. $cliente->cedula }}</td>
                                <td>{{ $cliente->telefono }}</td>
                                <td>{{ $cliente->email }}</td>

                                <td>
                                    @include('admin.clientes.partials.modal-show')

                                    <a href="{{ route('admin.clientes.index', $cliente->id) }}">
                                        <i class="bi bi-pencil text-warning"></i>
                                    </a>


                                    @include('admin.clientes.partials.modal-delete')


                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>

                            <td colspan="7" class="text-center table-secondary">
                                Total de clientes: {{ $clientes->total() }} |
                                <a href="{{ route('admin.clientes.index') }}" class="text-primary">
                                    Ver todo
                                </a>
                                <br>
                            </td>
                        </tr>
                    </tfoot>
                </table>

                <!-- End Table with stripped rows -->
                <div class="col-sm-6 col-xs-12">
                    {{ $clientes->appends(['filtro' => $request->filtro])->links() }}
                </div>

            </div>

        </div>

    </section>

@endsection
