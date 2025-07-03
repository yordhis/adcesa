@extends('layouts.app')

@section('title', 'Panel Principal')

@section('content')
    @if (session('mensaje'))
        @include('partials.alert')
    @endif
    <div id="alert"></div>
    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Tarjeta de Clientes -->
                    <div class="col-sm-4">
                        <div class="card info-card sales-card rounded-3">

                            <div class="card-body">
                                <h5 class="card-title">Clientes</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center ">
                                        <i class="bi bi-people-fill text-primary"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $dataTarjetas['clientes'] }}</h6>
                                        <span class="text-muted small pt-2 ps-1">Activos</span>
                                        {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> --}}

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- Fin Tarjeta de Clientes -->

                    <!-- Tarjeta de Productos -->
                    <div class="col-sm-4">
                        <div class="card info-card sales-card rounded-3">

                            <div class="card-body">
                                <h5 class="card-title">Productos</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center ">
                                        <i class="bi bi-box text-dark"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $dataTarjetas['productos'] }}</h6>
                                        <span class="text-muted small pt-2 ps-1">Activos</span>
                                        {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> --}}

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- Fin Tarjeta de Productos-->

                    <!-- Tarjeta de Ventas -->
                    <div class="col-sm-4">
                        <div class="card info-card sales-card rounded-3">

                            <div class="card-body">
                                <h5 class="card-title">Ventas</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center ">
                                        <i class="bi bi-cart-check-fill text-success"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $dataTarjetas['pedidos_entregado'] }}</h6>
                                        <span class="text-muted small pt-2 ps-1">Pedidos entregados</span>
                                        {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> --}}

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- Fin Tarjeta de Ventas-->

                    <!-- Tarjeta de Pedidos pendientes -->
                    <div class="col-sm-4">
                        <div class="card info-card sales-card rounded-3">

                            <div class="card-body">
                                <h5 class="card-title">Pedidos pendientes</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center ">
                                        <i class="bi bi-ui-checks-grid text-danger"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $dataTarjetas['pedidos'] }}</h6>
                                        <span class="text-muted small pt-2 ps-1">
                                            <a href="{{ route('admin.pedidos.index') }}">
                                                Ver lista
                                            </a>
                                        </span>
                                        {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> --}}

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- Fin Tarjeta de Pedidos pendientes -->

                    <!-- Tarjeta de Pedidos por entregar -->
                    <div class="col-sm-4">
                        <div class="card info-card sales-card rounded-3">

                            <div class="card-body">
                                <h5 class="card-title">Pedidos por entregar </span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center ">
                                        <i class="bi bi-truck text-dark"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $dataTarjetas['pedidos_enproceso'] }}</h6>
                                        <span class="text-muted small pt-2 ps-1">En proceso</span>
                                        {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> --}}

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- Fin Tarjeta de Pedidos por entregar -->

                    <!-- Tarjeta de Atender pedido -->
                    <div class="col-sm-4">
                        <div class="card info-card sales-card bg-primary rounded-3">
                            <a href="{{ route('admin.pedidos.index') }}">
                                <div class="card-body">
                                    <h5 class="card-title"></span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="ps-3">
                                            <h2 class="text-white">Atender pedidos</h6>
                                        </div>

                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center ">
                                            <i class="bi bi-clipboard-fill text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>

                        </div>
                    </div><!-- Fin Tarjeta de Atender pedido -->
                </div>
            </div>
        </div>
    </section>

@endsection
