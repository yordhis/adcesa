@extends('layouts.app')

@section('title', 'Editar Usuario')


@section('content')
    <div class="container">



        @if (session('mensaje'))
            @include('partials.alert')
        @endif

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

        <section class="section register d-flex flex-column align-items-center justify-content-center ">
            <div class="container">
                <div class="row justify-content-center">
                    <div class=" col-sm-8 d-flex flex-column align-items-center justify-content-center">


                        <div class="card ">

                            <div class="card-body">

                                <div class=" pb-2">
                                    <h5 class="card-title text-center pb-0 fs-2">Editar Usuario</h5>
                                    <p class="text-center text-danger small">Rellene todos los campos</p>
                                </div>

                                <form action="{{ route('admin.users.update', $user->id) }}" method="post"
                                    enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                                    @csrf
                                    @method('put')

                                    <!-- E-mail o usuario -->
                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">E-mail o usuario</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text text-white bg-primary"
                                                id="inputGroupPrepend">@</span>
                                            <input type="text" name="email" class="form-control" id="yourUsername"
                                                placeholder="Ingrese su email" value="{{ old('email') ?? $user->email }}"
                                                required>
                                            <div class="invalid-feedback">Por favor ingrese su nombre de usuario! </div>
                                        </div>
                                        @error('email')
                                            <div class="text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>

                                    <!-- Nombres y Apellidos -->
                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Nombres y Apellidos</label>
                                        <div class="input-group has-validation">
                                            <input type="text" name="nombres" class="form-control" id="yourUsername"
                                                placeholder="Ingrese Nombres y Apellidos"
                                                value="{{ old('nombres') ?? $user->nombres }}" required>
                                            <div class="invalid-feedback">Por favor ingrese su nombre de usuario! </div>
                                        </div>
                                        @error('nombres')
                                            <div class="text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>

                                    <!-- Nueva Contraseña -->
                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Nueva Contraseña</label>
                                        <div class="input-group">
                                            <!-- Input Bombilla -->
                                            <input type="password" name="password" class="form-control bg-muted"
                                                id="input-lightbulb" placeholder="Ingrese nueva contraseña"
                                                value="{{ old('password') }}" disabled readonly required>

                                            <!-- Boton interruptor -->
                                            <button type="button" class="btn btn-warning" id="btn-switch">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        </div>
                                        <div class="invalid-feedback">Por favor ingrese su Nueva contraseña!</div>
                                        @error('password')
                                            <div class="text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>

                                    <!-- Roles del usuario -->
                                    <div class="col-12">
                                        <label for="yourName" class="form-label">Rol del usuario</label>
                                        <select name="rol" id="rol" class="form-select" required>
                                            <option value="">Seleccione un rol</option>
                                            @foreach ($roles as $rol)
                                                @if (old('rol'))
                                                    @if (old('rol') == $rol->id)
                                                        <option value="{{ $rol->id }}" selected>{{ $rol->nombre }}
                                                        </option>
                                                    @endif
                                                @endif
                                                @isset($user->rol)
                                                    @if ($user->rol == $rol->id)
                                                        <option value="{{ $rol->id }}" selected>{{ $rol->nombre }}
                                                        </option>
                                                    @endif
                                                @endisset

                                                <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                                            @endforeach


                                        </select>
                                        <div class="invalid-feedback">Por favor, Seleccione el Rol del usuario!</div>
                                        @error('rol')
                                            <div class="text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>

                                    <!-- Subir Foto (Opcional) -->
                                    <div class="col-sm-12">
                                        <label for="foto" class="form-label">Subir Foto (Opcional)</label>
                                        <input type="file" name="file" class="form-control " id="foto">
                                        <div class="invalid-feedback">Ingrese una imagen valida</div>
                                        @error('file')
                                            <div class="text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>

                                    <!-- Foto Actual -->
                                    <div class="col-sm-12">
                                        <label for="foto" class="form-label">Foto Actual</label>
                                        <img src="{{ $user->foto }}" class="rounded mx-auto d-block" width="200"
                                            alt="foto">
                                    </div>




                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Actualizar datos</button>
                                    </div>

                                    <div class="col-12">
                                        <a class="btn btn-outline-danger w-100"
                                            href="{{ route('admin.users.index') }}">Volver a la lista</a>
                                    </div>
                                </form>

                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <script src="{{ asset('assets/js/profesores/editar.js') }}"></script>
        </section>
    @endsection
