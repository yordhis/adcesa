@extends('layouts.app')

@section('title', 'Tasas')

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
                <!-- Formulario de registro de tasas -->
                @include('admin.tasas.partials.modal-form-create')
            </div>

         


            <div class="col-lg-12 table-responsive">

                <!-- Tabla de tasas (lista) -->
                <table class="table table-hover  bg-white mt-2">
                    <thead>
                        <tr class="table-dark text-white">
                            
                            <th scope="col">Tasa BCV</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($tasas as $key => $tasa)
                            <tr>
                                <td>{{ $tasa->tasa }}</td>
                                <td>
                                    @include('admin.tasas.partials.modal-form-edit')
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                   
                </table>
                <!-- Fin Tabla de tasas -->


            </div>

        </div>

    </section>

@endsection
