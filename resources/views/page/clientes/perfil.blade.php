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
                <div class="col-sm-4 col-xs-12">
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                            <img src="{{ Auth::user()->foto ? asset(Auth::user()->foto) : asset('assets/img/avatar-' . Auth::user()->sexo . '.png') }}"
                                alt="Profile" class="rounded-circle">
                            <h2>{{ Auth::user()->nombres }}</h2>
                            <h3>{{ Auth::user()->apellidos }}</h3>

                        </div>
                    </div>

                    <!-- CHAT -->
                    <div class="card shadow-sm border-0" style="max-width: 400px;">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">
                                <i class="bi bi-chat-dots-fill me-2"></i> Soporte en Línea
                            </h5>
                        </div>
                        <div class="card-body p-0" style="height: 300px; overflow-y: auto; background-color: #f8f9fa;">
                            <div class="p-3">
                                @foreach ($mensajes as $mjs)
                                    @if (Auth::user()->id == $mjs->id_emisor)
                                        <div class="d-flex justify-content-end mb-2">
                                            <div class="bg-primary text-white rounded py-2 px-3" style="max-width: 75%;">
                                                {{ $mjs->mensaje }}
                                                <small class="d-block text-end mt-1"
                                                    style="font-size: 0.75em; opacity: 0.8;">
                                                    {{ \Carbon\Carbon::parse($mjs->created_at)->format('d-m-Y h:ia') }}
                                                </small>
                                            </div>
                                        </div>
                                    @else
                                        <div class="d-flex justify-content-start mb-2">
                                            <div class="bg-light border rounded py-2 px-3" style="max-width: 75%;">
                                                {{ $mjs->mensaje }}
                                                <small class="d-block text-start mt-1 text-muted"
                                                    style="font-size: 0.75em;">
                                                    {{ \Carbon\Carbon::parse($mjs->created_at)->format('d-m-Y h:ia') }}</small>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                            </div>
                        </div>
                        <div class="card-footer bg-light p-3">
                            <div class="input-group">
                                <form action="{{ route('chat.enviar.mensaje') }}" method="post">
                                    @csrf
                                    @method('POST')
                                    <div class="d-flex justify-content-between">
                                        <input type="hidden" name="id_emisor" value="{{ Auth::user()->id }}">
                                        <input name="mensaje" type="text" class="form-control mx-3"
                                            placeholder="Escribe tu mensaje..." aria-label="Escribe tu mensaje">
                                        <button class="btn btn-primary" type="submit" id="button-addon2">
                                            <i class="bi bi-send-fill"></i> Enviar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div> <!-- Fin Tarjeta de nombre y foto -->


                <!-- Tarjeta de informacion del cliente y sus pedidos-->
                <div class="col-sm-8 col-xs-12">
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
                                    <form action="{{ route('page.clientes.update.password', $cliente->id) }}"
                                        method="post" class="row g-3 needs-validation" enctype="multipart/form-data">
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
