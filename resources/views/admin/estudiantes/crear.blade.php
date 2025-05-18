@extends('layouts.app')

@section('title', 'Crear Estudiante')


@section('content')

    @isset($respuesta)
        @include('partials.alert')
    @endisset

    <div class="container">

        <section class="section register d-flex flex-column align-items-center justify-content-center ">
            <div class="container">
                <div class="row justify-content-center">
                    <div class=" col-sm-8 d-flex flex-column align-items-center justify-content-center">

                        <div class="card ">

                            <div class="card-body">

                                <div class=" pb-2">
                                    <h5 class="card-title text-center pb-0 fs-2">Crear Estudiante</h5>
                                    <p class="text-center text-danger small">Rellene todos los campos</p>
                                </div>




                                <form action="{{ route('admin.estudiantes.store') }}" method="POST"
                                    class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
                                    {{--  --}}
                                    @csrf
                                    @method('POST')


                                    {{-- INICIO DE DATOS PERSONALES --}}
                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Nombre y apellido</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                                <i class="bi bi-people"></i>
                                            </span>
                                            <input type="text" name="nombre" class="form-control" id="yourUsername"
                                                placeholder="Ingrese su nombres y apellidos"
                                                value="{{ $request->nombre ?? old('nombre') }}" required>
                                            <div class="invalid-feedback">Por favor, ingrese nombre! </div>
                                            @error('nombre')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-4">
                                        <label for="validationCustom04" class="form-label">Nacionalidad</label>
                                        <select name="nacionalidad" class="form-select" id="validationCustom04" required>
                                            @if (isset($request->nacionalidad))
                                                <option value="{{ $request->nacionalidad }}" selected>
                                                    {{ $request->nacionalidad }} </option>
                                            @endif
                                            @error('nacionalidad')
                                                <option value="{{ old('nacionalidad') }}" selected> {{ old('nacionalidad') }}
                                                </option>
                                            @enderror


                                            <option value="">Seleccione Nacionalidad</option>
                                            <option value="V">V</option>
                                            <option value="E">E</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Por favor, ingresar nacionalidad!
                                        </div>
                                        @error('nacionalidad')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xs-12 col-sm-4">
                                        <label for="yourPassword" class="form-label">Cédula</label>
                                        <input type="number" name="cedula" class="form-control" id="yourUsername"
                                            placeholder="Ingrese número de cédula"
                                            value="{{ $request->cedula ?? old('cedula') }}" required>
                                        <div class="invalid-feedback">Por favor, Ingrese número de cédula!</div>
                                        @error('cedula')
                                            {{ $message }}
                                        @enderror
                                    </div>

                                    <div class="col-xs-12 col-sm-4">
                                        <label for="yourPassword" class="form-label">Teléfono</label>
                                        <input type="number" name="telefono" class="form-control" id="yourUsername"
                                            placeholder="Ingrese número de teléfono"
                                            value="{{ $request->telefono ?? old('telefono') }}" required>
                                        <div class="invalid-feedback">Por favor, Ingrese número de teléfono!</div>
                                        @error('telefono')
                                            {{ $message }}
                                        @enderror
                                    </div>

                                    <div class="col-xs-12 col-sm-4">
                                        <label for="yourPassword" class="form-label">E-mail</label>
                                        <input type="email" name="correo" class="form-control" id="yourUsername"
                                            placeholder="Ingrese dirección de correo."
                                            value="{{ $request->correo ?? old('correo') }}" required>
                                        <div class="invalid-feedback">Por favor, Ingrese dirección de correo!</div>
                                        @error('correo')
                                            <div class="text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>

                                    <div class="col-xs-12 col-sm-4">
                                        <label for="yourPassword" class="form-label">Fecha de nacimiento</label>
                                        <input type="date" name="nacimiento" class="form-control" id="yourUsername"
                                            placeholder="Ingrese fecha de nacimiento."
                                            value="{{ $request->nacimiento ?? old('nacimiento') }}" required>
                                        <div class="invalid-feedback">Por favor, ingrese fecha de nacimiento!</div>
                                        @error('nacimiento')
                                            {{ $message }}
                                        @enderror
                                    </div>

                                    <div class="col-xs-12 col-sm-4">
                                        <label for="yourPassword" class="form-label">Edad</label>
                                        <input type="number" name="edad" class="form-control" id="yourUsername"
                                            placeholder="Ingrese edad." value="{{ $request->edad ?? old('edad') }}"
                                            required>
                                        <div class="invalid-feedback">Por favor, Ingrese edad!</div>
                                        @error('edad')
                                            {{ $message }}
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Dirección de habitación</label>
                                        <input type="text" name="direccion" class="form-control" id="yourUsername"
                                            placeholder="Ingrese dirección de domicilio."
                                            value="{{ $request->direccion ?? old('direccion') }}" required>
                                        <div class="invalid-feedback">Por favor, Ingrese dirección!</div>
                                        @error('direccion')
                                            {{ $message }}
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Grado de estudio</label>
                                        <input type="text" name="grado" class="form-control" id="yourUsername"
                                            placeholder="Ingrese grado de estudio."
                                            value="{{ $request->grado ?? old('grado') }}" required>
                                        <div class="invalid-feedback">Por favor, Ingrese grado de estudio!</div>
                                        @error('grado')
                                            {{ $message }}
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Ocupación o profesión</label>
                                        <input type="text" name="ocupacion" class="form-control" id="yourUsername"
                                            placeholder="Ingrese ocupación."
                                            value="{{ $request->ocupacion ?? old('ocupacion') }}" required>
                                        <div class="invalid-feedback">Por favor, Ingrese ocupación!</div>
                                        @error('ocupacion')
                                            {{ $message }}
                                        @enderror
                                    </div>

                                    <div class="col-xs-12 col-sm-6">
                                        <label for="foto" class="form-label">Subir Foto (Opcional)</label>
                                        <input type="file" name="file" class="form-control " id="file"
                                            accept="image/*">
                                        @error('file')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xs-12 col-sm-6 d-flex flex-column ">
                                        <a class="text-primary" id="addRepre">
                                            <i class="bi bi-person-plus"></i>
                                            Agregar Representante
                                        </a>
                                        <a class="navbar text-primary" id="addDifi">
                                            <i class="bi bi-postcard-heart"></i>
                                            Agregar Dificultad de aprendizaje
                                        </a>
                                    </div> {{-- FIN DE DATOS PERSONALES --}}


                                    {{-- INICIO DE DATOS DEL REPRESENTANTE --}}
                                    <div id="agregar-representante" class="row">
                                        <div class="col-xs-8 col-sm-11">
                                            <h5 class="mt-3">Representante</h5>
                                            <hr>
                                        </div>
                                        <div class="col-1">
                                            <span class="btn btn-none text-danger fs-3" id="closeRepre">X</span>
                                        </div>

                                        <div class="col-sm-12">
                                            <label for="yourUsername" class="form-label">Cédula del
                                                representante</label><br>
                                            <input type="number" name="rep_cedula" class="form-control"
                                                value="{{ old('rep_cedula') }}" id="rep_cedula"
                                                placeholder="Ingrese la cédula del representante.">
                                            <p><small class="text-white card mt-2 p-2 bg-secondary"
                                                    id="mensajeRepresentante"> Si el representante ya existe los datos se
                                                    llenaran automáticamente. </small></p>
                                            <div class="invalid-feedback">Por favor, Ingrese la cédula del representante!
                                            </div>
                                        </div>
                                        {{-- Se muestra la precarga  --}}
                                        <span id="preload"></span>
                                        <div id="componenteRepresentante" class="row">
                                            <div class="col-sm-12">
                                                <label for="yourName" class="form-label">Nombre del representante</label>
                                                <input type="text" name="rep_nombre" class="form-control"
                                                    id="yourName" value="{{ old('rep_nombre') }}"
                                                    placeholder="Ingrese Nombre del representante.">
                                                <div class="invalid-feedback">Por favor, Nombre del representante!</div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6">
                                                <label for="yourUsername" class="form-label">Teléfono </label>
                                                <input type="number" name="rep_telefono" class="form-control"
                                                    value="{{ old('rep_telefono') }}" id="yourUsername"
                                                    placeholder="Ingrese teléfono del representante.">
                                                <div class="invalid-feedback">Por favor, Ingrese teléfono del
                                                    representante!
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6">
                                                <label for="yourUsername" class="form-label">Edad</label>
                                                <input type="number" name="rep_edad" class="form-control"
                                                    id="yourUsername" value="{{ old('rep_edad') }}"
                                                    placeholder="Ingrese edad.">
                                                <div class="invalid-feedback">Por favor, Ingrese edad!</div>
                                            </div>

                                            <div class="col-12">
                                                <label for="yourUsername" class="form-label">Ocupación</label>
                                                <input type="text" name="rep_ocupacion" class="form-control"
                                                    value="{{ old('rep_ocupacion') }}" id="yourUsername"
                                                    placeholder="Ingrese ocupación o oficio.">
                                                <div class="invalid-feedback">Por favor, ocupación o oficio!</div>
                                            </div>

                                            <div class="col-12">
                                                <label for="yourUsername" class="form-label">Dirección del
                                                    representante</label>
                                                <input type="text" name="rep_direccion" class="form-control"
                                                    value="{{ old('rep_direccion') }}" id="yourUsername"
                                                    placeholder="Ingrese dirección del representante.">
                                                <div class="invalid-feedback">Por favor, Ingrese dirección del
                                                    representante!
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="yourUsername" class="form-label">Correo</label>
                                                <input type="email" name="rep_correo" class="form-control"
                                                    value="{{ old('rep_correo') }}" id="yourUsername"
                                                    placeholder="Ingrese correo.">
                                                <div class="invalid-feedback">Por favor, Ingrese correo electrónico
                                                    correcto!
                                                </div>
                                            </div>
                                        </div>
                                    </div> {{-- FIN DE DATOS DEL REPRESENTANTE --}}

                                    {{-- INICIO DE DATOS DE DIFICULTAD DE APRENDIZAJE --}}
                                    <div id="agregar-dificultad" class="row">
                                        <div class="col-11">
                                            <h5 class="mt-3">Dificultad de aprendizaje</h5>
                                            <hr>
                                        </div>
                                        <div class="col-1">
                                            <span class="btn btn-none text-danger fs-3" id="closeDifi">X</span>
                                        </div>
                                        <div class="col-4">
                                            <label for="yourUsername" class="form-label">TDH</label>
                                            <input type="checkbox" name="dif_1" value="TDH" class="form-checkbox"
                                                id="yourUsername">
                                        </div>
                                        <div class="col-4">
                                            <label for="yourUsername" class="form-label">ASPERGER</label>
                                            <input type="checkbox" name="dif_2" value="ASPERGER" class="form-checkbox"
                                                id="yourUsername">
                                        </div>
                                        <div class="col-4">
                                            <label for="yourUsername" class="form-label">AUTISMO</label>
                                            <input type="checkbox" name="dif_3" value="AUTISMO" class="form-checkbox"
                                                id="yourUsername">
                                        </div>
                                    </div> {{-- INICIO DE DATOS DE DIFICULTAD DE APRENDIZAJE --}}



                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Crear Estudiante</button>
                                    </div>

                                </form>

                            </div>
                        </div>

                        {{-- <div class="credits"> --}}
                        <!-- All the links in the footer should remain intact. -->
                        <!-- You can delete the links only if you purchased the pro version. -->
                        <!-- Licensing information: https://bootstrapmade.com/license/ -->
                        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                        {{-- <a href="https://bootstrapmade.com/">BootstrapMade</a> --}}
                        {{-- </div> --}}

                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection
