@extends('layouts.page')

@section('title', 'Adcesa')

@section('content')
    @if (session('mensaje'))
        @include('partials.alert')
    @endif

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

    <div class="p-5">
        <div class="pagetitle">
            <h1>Mi perfil</h1>
        </div><!-- End Page Title -->

        <section class="section profile ">
            <div class="row">
                <!-- Tarjeta de nombre y foto -->
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                            <img src="{{ Auth::user()->foto ? asset(Auth::user()->foto) : asset('assets/img/avatar-' . Auth::user()->sexo . '.png') }}"
                                alt="Profile" class="rounded-circle">
                            <h2>{{ Auth::user()->nombres }}</h2>
                            <h3>{{ Auth::user()->apellidos }}</h3>

                        </div>
                    </div>
                </div> <!-- Fin Tarjeta de nombre y foto -->

                <!-- Tarjeta de informacion del cliente y sus pedidos-->
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Menu de navegación de perfil - Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Pedidos</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">
                                        Editar perfil
                                    </button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#profile-change-password">Actualizar contraseña</button>
                                </li>

                            </ul>

                            <div class="tab-content pt-2">

                                <!-- Tabla de pedidos -->
                                @include('page.clientes.partials.lista-pedidos')
                                <!-- fin Tabla de pedidos -->

                                <!-- Datos del perfil y permite editar -->
                                @include('page.clientes.partials.form-cliente-edit-perfil')
                                <!-- Fin Datos del perfil y permite editar -->

                                <!-- Actualizar contraseña -->
                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <!-- Change Password Form -->
                                    <form action="{{ route('page.clientes.update.password', $cliente->id) }}" method="post"
                                        class="row g-3 needs-validation" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="row mb-3">
                                            <label for="password_actual" class="col-md-4 col-lg-3 col-form-label">Contraseña
                                                actual</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password_actual" type="password" class="form-control"
                                                    placeholder="Ingrese su contraseña actual" id="password_actual">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="new_password" class="col-md-4 col-lg-3 col-form-label">Nueva
                                                Contraseña</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="new_password" type="password" class="form-control"
                                                    placeholder="Ingrese su nueva contraseña" id="new_password">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="renew_password" class="col-md-4 col-lg-3 col-form-label">Reingrese
                                                nueva contraseña</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="renew_password" type="password" class="form-control"
                                                    placeholder="Ingrese de nuevo su contraseña nueva" id="renew_password">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Cambiar contraseña</button>
                                        </div>
                                    </form><!-- End Change Password Form -->

                                </div> <!-- Fin Actualizar contraseña -->

                            </div><!-- End Bordered Tabs -->
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>


@endsection
