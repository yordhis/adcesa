@extends('layouts.app')

@section('title', 'Lista de Conceptos de Pago')

@section('content')
    @if (session('mensaje'))
        @include('partials.alert')
    @endif

    <section class="section">
        <div class="row">


            <div class="col-sm-12">
                <h2>Lista de Conceptos de Pago</h2>
            </div>



            <div class="col-lg-12">


                <div class="table-responsive">

                    <!-- Table with stripped rows -->

                    <table class="table">
                        <thead class="table-dark">
                            <tr class="text-white">
                                <th scope="col">#</th>
                                <th scope="col">Código</th>
                                <th scope="col">Descripción de concepto de pago</th>
                                <th scope="col">Estatus</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $contador = 1; @endphp
                            @foreach ($conceptos as $concepto)
                                <tr>
                                    <th scope="row">{{ $contador }}</th>
                                    <td>{{ $concepto->codigo }}</td>
                                    <td>{{ $concepto->descripcion }}</td>
                                    <td>{{ $concepto->estatus }}</td>
                                    <td>

                                        <a href="{{ route('admin.conceptos.edit', $concepto->id) }}">
                                            <i class="bi bi-pencil fs-4"></i>
                                        </a>

                                        @include('admin.conceptos.partials.modal')

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
    </section>





@endsection
