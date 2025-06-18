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

           

            <!-- Formulario cliente  -->
            <div class="col-sm-6 col-xs-12">
                <form action="{{ route('admin.pedidos.buscar.cliente') }}" method="post" id="buscar_cliente">
                    @csrf
                    @method('POST')
                    <div class="input-group mb-3">
                        <label for="buscar_cliente" class="text-primary p-2">Buscar cliente</label>
                        <!-- #### Buscar cliente #### -->
                        <input type="number" class="form-control w-50" name="buscar_cliente"
                            placeholder="Ingrese cédula" aria-label="Filtrar"
                            aria-describedby="button-addon2">

                        <button class="btn btn-primary" type="submit" id="button-addon2">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- formulario de buscar y agregar producto-->
            <div class="col-sm-6 col-xs-12">
                <form action="{{ route('admin.pedidos.buscar.producto') }}" method="post" id="buscar_producto">
                    @csrf
                    @method('POST')
                    <div class="input-group mb-3">
                        <label for="filtro" class="text-primary p-2">Buscar producto</label>
                        <!-- #### BUSCAR PRODUCTO #### -->
                        <input type="text" class="form-control w-50" name="buscar_producto"
                            placeholder="Buscar por: código de barra, descripción y nombre" aria-label="Filtrar"
                            aria-describedby="button-addon2">

                        <button class="btn btn-primary" type="submit" id="button-addon2">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>


            <div class="col-lg-12 table-responsive">

                <!-- Tabla de pedidos (lista) -->
                <table class="table table-hover border bg-white mt-2">

                    <thead>
                        @if ($clienteSolicitado)
                            <tr>
                                <th class="table-dark">Nombre del cliente:</th>
                                <th colspan="5"> {{ $clienteSolicitado->nombres . ' ' . $clienteSolicitado->apellidos }}</th>
                            </tr>
                            <tr>
                                <th class="table-dark">Cédula:</th>
                                <th> {{ $clienteSolicitado->cedula }}</th>
                                <th class="table-dark">Telf:</th>
                                <th> {{ $clienteSolicitado->telefono }}</th>
                                <th class="table-dark">E-mail:</th>
                                <th> {{ $clienteSolicitado->email }}</th>
                            </tr>
                            <tr>
                                <th class="table-dark">Dirección:</th>
                                <th colspan="5"> {{ $clienteSolicitado->direccion }}</th>
                            </tr>
                        
                        @endif

                        <tr class="table-dark text-white">
                            <th scope="col">#</th>
                            <th scope="col">Descripción producto</th>
                            <th scope="col">Variante</th>
                            <th scope="col">Insumos a utilizar</th>
                            <th scope="col">Precio Venta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($carritos)
                            @foreach ($carritos as $key => $item)
                                <tr>
                                    <th scope="row">{{ ($pedidos->currentPage() - 1) * $pedidos->perPage() + $key + 1 }}
                                    </th>
                                    <td>{{ $item->nombre }}</td>
                                    <td>{{ $item->precio }}</td>
    
                                    <td>
                                        {{-- @include('admin.pedidos.partials.modal-show') --}}
                                        {{-- @include('admin.pedidos.partials.modal-form-edit') --}}
                                        {{-- @include('admin.pedidos.partials.modal-form-delete') --}}
                                        {{-- @include('admin.pedidos.partials.modal-form-procesar-pago') --}}
                                        {{-- @include('admin.pedidos.partials.modal-form-asignar-insumo') --}}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                             <tr>
                                <td colspan="4" class="text-center">No hay productos en el carrito</td>
                            </tr>
                        @endif

                    </tbody>
                    <tfoot>
                        
                    </tfoot>
                </table>
                <!-- Fin Tabla de pedidos -->

            </div>

        </div>
         <div class="col-12 my-3">
                <!-- Volver a la lista de pedidos -->
                <a href="{{ route('admin.pedidos.index') }}" class="btn btn-danger ">
                    <i class="bi bi-back"></i> volver a pedidos
                </a>

            </div>
    </section>

@endsection
