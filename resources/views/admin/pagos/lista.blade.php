@extends('layouts.app')

@section('title', 'Lista de Pagos')

@section('content')

    @isset($respuesta)
        @include('partials.alert')
    @endisset
    <div id="alert"></div>
    <section class="section">
        <div class="row">



            <div class="col-sm-12">
                <h2> Lista de Pagos </h2>
            </div>



            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body table-responsive">

                        <!-- Table with stripped rows -->

                        <table class="table datatable ">
                            <thead>
                                <tr class="table-dark text-white">
                                    <th scope="col">#</th>
                                    <th scope="col">N°. Pago</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Cédula</th>
                                    <th scope="col">Abonó</th>
                                    <th scope="col">Fecha de pago</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $contador = 1; @endphp
                                @foreach ($pagos as $pago)
                                    <tr>
                                        <th scope="row">{{ $contador }}</th>
                                        <td>{{ $pago->codigo }}</td>
                                        <td>{{ $pago->estudiante['nombre'] }}</td>
                                        <td>{{ $pago->estudiante['cedula'] }}</td>
                                        <td>{{ $pago->monto }}</td>

                                        <td>{{ $pago->fecha }}</td>


                                        <td>

                                            <a href="/pagos/{{ $pago->id }}" target="_self">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            {{-- <a href="/pagos/{{ $pago->id }}/edit" target="_self">
                                                    <i class="bi bi-pencil"></i>
                                                </a> --}}


                                            @include('admin.pagos.partials.modal')


                                        </td>
                                    </tr>
                                    @php $contador++; @endphp
                                @endforeach

                            </tbody>
                        </table>

                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>



        </div>
    </section>





@endsection
