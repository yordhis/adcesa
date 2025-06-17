@extends('layouts.app')

@section('title', 'Pedidos')

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

            <div class="col-12 my-3">
                <!-- Formulario de registro de pedidos -->
                @include('admin.pedidos.partials.modal-form-create')
          
            </div>

            <!-- Filtro de pedidos  -->
            <div class="col-12">
                <form action="{{ route('admin.pedidos.index') }}" method="post" id="filtro">
                    @csrf
                    @method('GET')
                    <div class="input-group mb-3">
                        <label for="filtro" class="text-primary p-2">Buscar</label>
                        <!-- #### FILTRO #### -->
                        <input type="text" class="form-control w-50" name="filtro" value="{{ $request->filtro ?? '' }}"
                            placeholder="Buscar por: Descripcion o código de barra" aria-label="Filtrar"
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
                        <button class="btn btn-danger" type="button" id="reset-filtro">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </form>
            </div>


            <div class="col-lg-12 table-responsive">

                <!-- Tabla de pedidos (lista) -->
                <table class="table table-hover  bg-white mt-2">
                    <thead>
                        <tr class="table-dark text-white">
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Tipo de pedido</th>
                            <th scope="col">Existencia Real</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Estatus</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($pedidos as $key => $pedido)
                            <tr>
                                <th scope="row">{{ ($pedidos->currentPage() - 1) * $pedidos->perPage() + $key + 1 }}
                                </th>
                                <td>{{ $pedido->nombre }}</td>
                                <td>{{ $pedido->descripcion }}</td>
                                <td>{{ $pedido->precio }}</td>
                                <td>{{ $pedido->tipo_pedido ? 'Compuesto' : 'No Compuesto' }}</td>
                                <td>{{ $pedido->stock }}</td>
                                <td>{{ $pedido->categoria ?? 'SIN CATEGORÍA' }}</td>
                                <td>{{ $pedido->estatus }}</td>

                                <td>
                                    @include('admin.pedidos.partials.modal-show')
                                    {{-- @include('admin.pedidos.partials.modal-form-edit') --}}
                                    @include('admin.pedidos.partials.modal-form-delete')
                                    @include('admin.pedidos.partials.modal-form-procesar-pago')
                                    {{-- @include('admin.pedidos.partials.modal-form-asignar-insumo') --}}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>

                            <td colspan="10" class="text-center table-secondary">
                                Total de pedidos: {{ $pedidos->total() }} |
                                <a href="{{ route('admin.pedidos.index') }}" class="text-primary">
                                    Ver todo
                                </a>
                                <br>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <!-- Fin Tabla de pedidos -->

                <!-- Paginación -->
                <div class="col-sm-6 col-xs-12">
                    {{ $pedidos->appends(['filtro' => $request->filtro])->links() }}
                </div>
                <!-- Fin Paginación -->

            </div>

        </div>

    </section>

@endsection
