@extends('layouts.app')

@section('title', 'Panel Principal')

@section('content')
    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Sales Card -->
                    <div class="col-sm-4">
                        <div class="card info-card sales-card rounded-3">

                            <div class="card-body">
                                <h5 class="card-title">Grupos de Estudios</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center ">
                                        <i class="bi bi-ui-checks text-primary"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$dataTarjetas['grupos']}}</h6>
                                        <span class="text-muted small pt-2 ps-1">Activos</span>
                                        {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> --}}

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->
                    
                    <!-- Sales Card -->
                    <div class="col-sm-4">
                        <div class="card info-card sales-card rounded-3">

                            <div class="card-body">
                                <h5 class="card-title">Estudiantes</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center ">
                                        <i class="bi bi-person-video3 text-danger"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$dataTarjetas['estudiantes']}}</h6>
                                        <span class="text-muted small pt-2 ps-1">Activos</span>
                                        {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> --}}

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Sales Card -->
                    <div class="col-sm-4">
                        <div class="card info-card sales-card rounded-3">

                            <div class="card-body">
                                <h5 class="card-title">Profesores</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center ">
                                        <i class="bi bi-person-vcard text-info"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$dataTarjetas['profesores']}}</h6>
                                        <span class="text-muted small pt-2 ps-1">Activos</span>
                                        {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> --}}

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Sales Card -->
                    <div class="col-sm-4">
                        <div class="card info-card sales-card rounded-3">

                            <div class="card-body">
                                <h5 class="card-title">Cuotas Atrazadas</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center ">
                                        <i class="bi bi-palette2 text-warning"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$dataTarjetas['cuotas']}}</h6>
                                        <span class="text-muted small pt-2 ps-1">
                                            <a href="/cuotas" target="_self">
                                                Ver lista
                                            </a>    
                                        </span>
                                        {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> --}}

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Sales Card -->
                    <div class="col-sm-4">
                        <div class="card info-card sales-card rounded-3">

                            <div class="card-body">
                                <h5 class="card-title">Pagos Recibidos | {{date('m/Y')}}</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center ">
                                        <i class="bi bi-cash text-success"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$dataTarjetas['pagos']}}</h6>
                                        <span class="text-muted small pt-2 ps-1">Activos</span>
                                        {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> --}}

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Sales Card -->
                    <div class="col-sm-4">
                        <div class="card info-card sales-card bg-primary rounded-3">
                            <a href="{{ route('admin.inscripciones.index') }}" >
                                <div class="card-body">
                                    <h5 class="card-title"></span></h5>
    
                                    <div class="d-flex align-items-center">
                                        <div class="ps-3">
                                            <h2 class="text-warning">Procesar Pago</h6>
                                        </div>
    
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center ">
                                            <i class="bi bi-paypal text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>

                        </div>
                    </div><!-- End Sales Card -->
                   
                </div>
            </div>
        </div>
    </section>
    
@endsection