@extends('layouts.app')

@section('title', 'Lista de Planes')

@section('content')

    @if( session('mensaje') )
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
                <h2> Lista de Planes de pago </h2>
            </div>

            <div class="col-sm-6 col-xs-12">
                @include('admin.planes.partials.modalFormularioCrearPlan')
            </div>
            <div class="col-sm-6 col-xs-12">
                <form action="{{ route('admin.planes.index') }}" method="post">
                @csrf
                @method('get')
                <div class="input-group mb-3">
                    <input type="text" class="form-control" 
                    name="filtro"
                    placeholder="Buscar" 
                    aria-label="Filtrar" 
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
                            <th scope="col">Código</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Cuotas</th>
                            <th scope="col">Plazo</th>
                            <th scope="col">Descuento</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
               
                        @foreach ($planes as $plane)
                            <tr>
                                <td scope="row">{{ $plane->codigo }}</td>
                                <td>{{ $plane->nombre }}</td>
                                <td>{{ $plane->cantidad_cuotas }}</td>
                                <td>{{ $plane->plazo }} Dias</td>
                                
                                <td class="text-break">{{ $plane->porcentaje_descuento }} %</td>

                                <td>
                                    @include('admin.planes.partials.modalVerInfoDelPlan')

                                    <a href="{{ route('admin.planes.edit', $plane->id) }}">
                                        <i class="bi bi-pencil"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Editar plan">
                                        </i>
                                    </a>


                                    @include('admin.planes.partials.modalEliminarPlan')


                                    @if ($plane->estatus == 2)
                                        <i class="bi bi-wifi text-success"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Visible en la página web">
                                        </i>
                                    @else
                                        <i class="bi bi-wifi-off text-danger"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="No disponoble para la página web">
                                        </i>
                                    @endif

                                </td>
                            </tr>
                           
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>

                            <td colspan="8" class="text-center table-secondary">
                                Total de planes: {{ $planes->total() }} | 
                                <a href="{{ route('admin.planes.index') }}"
                                   class="text-primary" >
                                    Ver todo
                                </a>
                                <br>
                            </td>
                        </tr>
                    </tfoot>
                </table>

                <!-- End Table with stripped rows -->
                <div class="col-sm-6 col-xs-12">
                    {{ $planes->appends(['filtro'=> $request->filtro])->links() }}
                </div>

            </div>

           
            
        </div>

       

    </section>


    


@endsection
