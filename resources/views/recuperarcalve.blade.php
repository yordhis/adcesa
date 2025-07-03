@extends('layouts.index')

@section('title', 'Adcesa - Login')

@section('content')
    @if (session('mensaje'))
        @include('partials.alert')
    @endif

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                    <div class="d-flex justify-content-center p-3">
                        <a href="{{ route('page.index') }}">
                            <img src="{{ asset('/assets/img/logo.png') }}" class="img" width="150" alt="logo"
                                id="logo">
                        </a>
                    </div><!-- End Logo -->

                    <div class="card mb-1">

                        <div class="card-body">

                            <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4 text-dark">Recuperación de contraseña</h5>
                                <p class="text-center small text-danger">Se le enviará un correo con un enlace de
                                    recuperación.</p>
                            </div>

                            <form action="{{ route('password.email') }}" method="post" class="row g-3 needs-validation"
                                novalidate>
                                @csrf
                                @method('post')

                                <div class="col-12">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group has-validation">
                                        <input type="email" name="email" placeholder="Ingrese E-mail de su cuenta"
                                            class="form-control" id="email" required>
                                    </div>
                                </div>




                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">Enviar enlace de
                                        recuperación</button>
                                </div>

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


                                <div class="col-12">
                                    <p class="small mb-0">No tienes una cuenta? <a
                                            href="{{ route('page.clientes.crear.sesion') }}">Registrarme</a>
                                    </p>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>
@endsection
