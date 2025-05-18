@extends('layouts.app')

@section('title', 'Recibo de Pagos')

@section('content')

    @isset($respuesta)
        @include('partials.alert')
    @endisset
    <div id="alert"></div>

    <section class="section">
        <div class="row">



            <div class="col-sm-12">
                <h2> Recibo de pago <span class="fs-6 text-muted">(Pre-visualización)</span> </h2>
            </div>



            <div class="col-lg-12">

                <div id="reciboPDF">
                    <div class="card p-4">
                        <div class="card border border-1 border-dark">
                            <div class="card-header border border-0 mb-0 pb-0">
                                <div class="d-flex d-row bd-highlight">

                                    {{-- Logo --}}
                                    <img src="assets/img/logo-academia-vertical.png" class="align-self-center"
                                        alt="">

                                    {{-- Membrete de la academia --}}
                                    <div class="d-flex flex-column flex-fill align-self-center text-center text-dark mx-5">
                                        <p class="m-0">ACADEMIA DE FORMACIÓN E IDIOMAS</p>
                                        <h2 class="text-primary">MARYLAND</h2>
                                        <div class="text-center bg-primary mx-5" style="height: 3px;"></div>
                                        <h5 class="m-0">RIF V- 12.204.759-4</h5>
                                        <p>
                                            COMERCIAL: Av. Los Andes C/C Blonval Lopéz C.C. <br>
                                            Pereira Edif. Bella Vista, 1er Piso, frente a Mc Donald’s, <br>
                                            Alto Barinas Edo. Barinas <br>
                                            Telf: 0416-277.67.67 / 0412-555.30.73 <br>
                                            N° de Registro de MPPE: RBA0504008A
                                        </p>

                                    </div> {{-- Cierre Membrete de la academia --}}

                                    {{-- Fecha de pago --}}
                                    <div class="d-flex flex-column text-center align-self-center">

                                        <table class="table table-bordered border-dark">
                                            <thead class="bg-primary text-white ">
                                                <tr>
                                                    <th>Lugar de emisión</th>
                                                    <th>Días</th>
                                                    <th>Mes</th>
                                                    <th>Años</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td>Barinas</td>
                                                    <td>{{ explode('-', $pago->fecha)[2] ?? '' }}</td>
                                                    <td>{{ explode('-', $pago->fecha)[1] ?? '' }}</td>
                                                    <td>{{ explode('-', $pago->fecha)[0] ?? '' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        {{-- Numero de control de pago --}}
                                        <h4 class="bg-primary text-white p-2">Control de Pago</h4>
                                        <div class="card shadow-none border border-1">
                                            <div class="card-text fs-3 text-danger">N° {{ $pago->codigo ?? '' }}</div>
                                        </div>

                                    </div> {{-- Cierre de Fecha de pago y control de pago --}}


                                </div>
                            </div>
                            <div class="card-body">

                                <div class="card shadow-none">
                                    <div class="card-body  border border-dark rounded-top">
                                        <div class="d-flex d-inline-flex ">
                                            <div class="card-text">
                                                Nombre del estudiante:
                                            </div>
                                            <span class="ms-2 mt-2 fs-5">{{ $pago->estudiante['nombre'] ?? '' }}</span>
                                        </div>
                                    </div>
                                    <div class="card-body border-dark border-end border-start ">
                                        <div class="d-flex d-inline-flex ">
                                            <div class="card-text">
                                                Representante:
                                            </div>
                                            <span
                                                class="ms-2 mt-2 fs-5">{{ $pago->estudiante->representantes[0]['nombre'] ?? '' }}</span>
                                        </div>
                                        <div class="d-flex d-inline-flex ms-5">
                                            <div class="card-text">
                                                Horario:
                                            </div>
                                            @isset($pago->horario['horas'])
                                                <span class="ms-2 mt-2"> {{ $pago->horario['horas'] ?? '' }} </span>
                                                <span class="ms-2 mt-2">| Dias: {{ $pago->horario['dias'] ?? '' }}</span>
                                            @endisset
                                        </div>
                                    </div>

                                    <div class="card-body  border border-dark rounded-bottom">
                                        <div class="d-flex d-inline-flex ">
                                            <div class="card-text">
                                                Teléfono:
                                            </div>
                                            <span
                                                class="ms-2 mt-2 fs-5">{{ '(' . substr($pago->estudiante['telefono'], 0, 4) . ')' . ' ' . substr($pago->estudiante['telefono'], 5, 3) . '-' . substr($pago->estudiante['telefono'], 6, 4) ?? '' }}
                                            </span>
                                        </div>

                                        <div class="d-flex d-inline-flex ">
                                            <div class="card-text">
                                                Documento o Rif:
                                            </div>
                                            <span class="mx-2 mt-2 fs-5">{{ $pago->estudiante['cedula'] ?? '' }}</span>
                                        </div>

                                        <div class="d-flex d-inline-flex">
                                            <div class="card-text">
                                                Formas de pago:
                                            </div>
                                            @isset($metodos)
                                                @foreach ($metodos as $metodo)
                                                    <div class="form-check form-check-inline mt-2">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="{{ $metodo['metodo'] }}" name="met_{{ $metodo['metodo'] }}"
                                                            value="{{ $metodo['metodo'] }}"
                                                            {{ $metodo['activo'] ? 'checked' : '' }} disabled>
                                                        <label class="form-check-label" style="font-size: 10px;"
                                                            for="{{ $metodo['metodo'] }}">{{ $metodo['metodo'] }}</label>
                                                    </div>
                                                @endforeach
                                            @endisset
                                        </div>

                                    </div>
                                </div>

                                <table class="table table-bordered border-dark">
                                    <thead>
                                        <tr>
                                            <th>Cantidad</th>
                                            <th>Descripción</th>
                                            <th>Divisas ($)</th>
                                            <th>Bolivares (Bs)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>01</td>
                                            <td>{{ $pago->concepto ?? '' }}</td>
                                            <td>{{ $pago->monto[1] ?? '' }}</td>
                                            <td>{{ $pago->monto[0] ?? '' }}</td>
                                        </tr>
                                        <tr style="height: 35px;">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr style="height: 35px;">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" class="text-end fs-5">Total</td>
                                            <td>{{ $pago->monto[1] ?? '' }}</td>
                                            <td>{{ $pago->monto[0] ?? '' }}</td>
                                        </tr>

                                    </tfoot>
                                </table>

                            </div>

                        </div>

                        <div class="card-footer text-center ">

                            <div class="card-text  ">
                                <a href="/generarReciboDePago/{{ $pago->id }}/recibopdf"
                                    class="btn btn-primary btn-lg d-inline me-3" id="imprimirRecibo" target="_self">
                                    <i class="bi bi-printer"></i>
                                    Imprimir Recibo de pago
                                </a>

                                @isset($_GET['codigoInscripcion'])
                                    <a href="/inscripciones/{{ $pago->cedula_estudiante }}/{{ $_GET['codigoInscripcion'] ?? '0000' }}"
                                        class="btn btn-primary btn-lg d-inline" target="_self" id="imprimirRecibo">
                                        <i class="bi bi-printer"></i>
                                        Imprimir Planilla de Inscripción
                                    </a>
                                @endisset
                            </div>
                        </div>

                    </div>
                </div>

            </div>



        </div>
    </section>





@endsection
