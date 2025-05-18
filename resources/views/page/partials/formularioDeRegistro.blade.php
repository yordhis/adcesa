<div class="container">
    <div class="row">
        <div class="col-12 text-center mt-5">
            <h2 class="fs-2 text-dark">Registre los datos del estudiante</h2>
        </div>

        <div class="col-12 my-1">
            @include('page.partials.modalFormCedulaEstudianteExistente')
        </div>

        <div class="col-12 p-2 ">
            <div class="card p-3">
                <form action="{{ route('page.preinscripcion.estudiante.store') }}" method="POST" id=""
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
                                value="{{ old('nombre') }}" required>
                            <div class="invalid-feedback">Por favor, ingrese nombre! </div>
                            @error('nombre')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-4">
                        <label for="validationCustom04" class="form-label">Nacionalidad</label>
                        <select name="nacionalidad" class="form-select" id="validationCustom04" required>
                            @if (old('nacionalidad'))
                                <option value="{{ old('nacionalidad') }}" selected>
                                    {{ old('nacionalidad') }}
                                </option>
                            @endif


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
                            placeholder="Ingrese número de cédula" value="{{ old('cedula') }}"
                            required>
                        <div class="invalid-feedback">Por favor, Ingrese número de cédula!</div>
                        @error('cedula')
                            <div class="text-danger"> {{ $message }} </div>
                        @enderror
                    </div>

                    <div class="col-xs-12 col-sm-4">
                        <label for="yourPassword" class="form-label">Teléfono</label>
                        <input type="text" name="telefono" class="form-control" id="yourUsername"
                            placeholder="Ingrese número de teléfono" value="{{ old('telefono') }}"
                            min="11" max="15" required>
                        <div class="invalid-feedback">Por favor, Ingrese número de teléfono!
                        </div>
                        @error('telefono')
                            <div class="text-danger"> {{ $message }} </div>
                        @enderror
                    </div>

                    <div class="col-xs-12 col-sm-4">
                        <label for="yourPassword" class="form-label">E-mail</label>
                        <input type="email" name="correo" class="form-control" id="yourUsername"
                            placeholder="Ingrese dirección de correo." value="{{ old('correo') }}"
                            required>
                        <div class="invalid-feedback">Por favor, Ingrese dirección de correo!
                        </div>
                        @error('correo')
                            <div class="text-danger"> {{ $message }} </div>
                        @enderror
                    </div>

                    <div class="col-xs-12 col-sm-4">
                        <label for="yourPassword" class="form-label">Fecha de nacimiento</label>
                        <input type="date" name="nacimiento" class="form-control" id="fecha_nacimiento"
                            placeholder="Ingrese fecha de nacimiento."
                            value="{{ old('nacimiento') }}" required>
                        <div class="invalid-feedback">Por favor, ingrese fecha de nacimiento!
                        </div>
                        @error('nacimiento')
                            <div class="text-danger"> {{ $message }} </div>
                        @enderror
                    </div>

                    <div class="col-xs-12 col-sm-4">
                        <label for="yourPassword" class="form-label">Edad</label>
                        <input type="number" name="edad" class="form-control" id="edad_estudiante"
                            placeholder="Ingrese edad." value="{{ old('edad') }}" min="1"
                            max="120" required>
                        <div class="invalid-feedback">Por favor, Ingrese edad!</div>
                        @error('edad')
                            <div class="text-danger"> {{ $message }} </div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="yourPassword" class="form-label">Dirección de
                            habitación</label>
                        <input type="text" name="direccion" class="form-control" id="yourUsername"
                            placeholder="Ingrese dirección de domicilio."
                            value="{{ $request->direccion ?? old('direccion') }}" required>
                        <div class="invalid-feedback">Por favor, Ingrese dirección!</div>
                        @error('direccion')
                            <div class="text-danger"> {{ $message }} </div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="yourPassword" class="form-label">Grado de estudio</label>
                        <input type="text" name="grado" class="form-control" id="yourUsername"
                            placeholder="Ingrese grado de estudio." value="{{ old('grado') }}"
                            required>
                        <div class="invalid-feedback">Por favor, Ingrese grado de estudio!
                        </div>
                        @error('grado')
                            <div class="text-danger"> {{ $message }} </div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="yourPassword" class="form-label">Ocupación o
                            profesión</label>
                        <input type="text" name="ocupacion" class="form-control" id="yourUsername"
                            placeholder="Ingrese ocupación." value="{{ old('ocupacion') }}"
                            required>
                        <div class="invalid-feedback">Por favor, Ingrese ocupación!</div>
                        @error('ocupacion')
                            <div class="text-danger"> {{ $message }} </div>
                        @enderror
                    </div>

                    <div class="col-xs-12 col-sm-6">
                        <label for="file" class="form-label">Subir Foto del estudiante (Opcional)</label>
                        <input type="file" name="file" class="form-control " id="file" accept="image/*">
                        @error('file')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <label for=""></label>
                        <p class="m-2">
                            <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseDificultades" aria-expanded="false"
                                aria-controls="collapseDificultades">
                                ¿Poseé alguna dificulta de aprendizaje? clic aquí
                            </button>
                        </p>
                        <div class="collapse" id="collapseDificultades">
                            <div class="card card-body">
                                <div class="d-flex flex-wrap">
                                    @foreach ($dificultades as $dificultad)
                                        <div class="m-2">
                                            <label for="yourUsername"
                                                class="form-label">{{ $dificultad->nombre }}</label>
                                            <input type="checkbox" name="dif_{{ $dificultad->id }}"
                                                value="{{ $dificultad->nombre }}" class="form-checkbox"
                                                id="yourUsername">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <label for=""></label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="terminos" value="1"
                                id="terms">
                            <label class="form-check-label" for="terms">
                                <a href="{{ asset('assets/documentos/terminos_y_condiciones_maryland.pdf') }}"
                                    target="_blank">
                                    Terminos y condiciones
                                </a>
                            </label>
                        </div>
                        @error('terminos')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">Guardar datos</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
