@extends('layouts.app')

@section('title', 'Lista de profesores')

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
                <h2> Lista de profesores</h2>
            </div>

            <div class="col-sm-3 col-xs-12 ">
                @include('admin.clientes.partials.modalform')
            </div>

            <div class="col-sm-3 col-xs-12">

                <form action="{{ route('admin.clientes.index') }}" method="post" class="row g-3 needs-validation"
                    novalidate>
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
                <form action="{{ route('admin.clientes.index') }}" method="post">
                    @csrf
                    @method('GET')
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="filtro" placeholder="Buscar" aria-label="Filtrar"
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

                        @foreach ($clientes as $cliente)
                            <tr class="{{ $cliente->estatus == 2 ? 'table-danger' : '' }}
                                {{ $cliente->estatus == 0 ? 'table-secondary' : '' }}">
                                <th scope="row">{{ $cliente->id }}</th>
                                <td>{{ $cliente->nombres }}</td>
                                <td>{{ $cliente->cedula }}</td>
                                <td>{{ $cliente->telefono }}</td>
                


                                <td>
                                    @include('admin.clientes.partials.modalver')

                                    <a href="{{ route('admin.clientes.edit', $cliente->id) }}">
                                        <i class="bi bi-pencil text-warning"></i>
                                    </a>


                                    @include('admin.clientes.partials.modal')


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
