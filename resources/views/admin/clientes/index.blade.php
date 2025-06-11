@extends('layouts.app')

@section('title', 'Lista de clientes')

@section('content')

    @if (session('mensaje'))
        @include('partials.alert')
    @endif
    <div id="alert">
    </div>

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
            <div class="col-sm-4 col-xs-12 ">
                @include('admin.clientes.partials.modal-form-create')
            </div>

            <!-- Filtro de clientes -->
            <div class="col-sm-8 col-xs-12">
                <form action="{{ route('admin.clientes.index') }}" method="post">
                    @csrf
                    @method('GET')
                    <div class="input-group mb-3">
                        <label for="filtro" class="text-primary p-2">Buscar</label>
                        <input type="text" class="form-control w-50" name="filtro" value="{{ $request->filtro }}"
                            placeholder="Buscar por: Nombre, E-mail y Cédula" aria-label="Filtrar"
                            aria-describedby="button-addon2">
                        <!-- Selector del limite a listar en la tabla -->
                        <select name="limit" id="limit" class="form-select">
                            @if ($request->limit)
                                <option value="{{ $request->limit }}" selected>{{ $request->limit }}</option>
                            @else
                                <option disabled selected>Limite</option>
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
                                <th scope="row">{{ ($clientes->currentPage() - 1) * $clientes->perPage() + $key + 1 }}
                                </th>
                                <td>{{ $cliente->nombres . ' ' . $cliente->apellidos }}</td>
                                <td>{{ $cliente->nacionalidad . '-' . number_format($cliente->cedula, 0, '', '.') }}</td>
                                <td>
                                    @if ($cliente->telefono)
                                        {{ preg_replace('/^(\d{4})(\d{3})(\d{4})$/', '($1)-$2-$3', $cliente->telefono) }}
                                    @else
                                        No asignado
                                    @endif
                                </td>
                                <td>{{ $cliente->email }}</td>

                                <td>
                                    @include('admin.clientes.partials.modal-show')
                                    @include('admin.clientes.partials.modal-form-edit')

                                    


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
