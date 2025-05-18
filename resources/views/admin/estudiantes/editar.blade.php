@extends('layouts.app')

@section('title', 'Editar Estudiante')


@section('content')

    @if (session('mensaje'))
        @include('partials.alert')
    @endif

    <div class="container">

        <section class="section register d-flex flex-column align-items-center justify-content-center ">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 text-center">
                        <a href="{{ route('admin.estudiantes.index') }}">Volver a la lista de estudiantes</a>

                    </div>
                    <div class=" col-sm-10 d-flex flex-column align-items-center justify-content-center">
                        @if ($estudiante)
                            <div class="card">

                                <div class="card-header">
                                    <div class=" pb-2">
                                        <h5 class="card-title text-center pb-0 fs-2">Actualizar Estudiante</h5>
                                        <p class="text-center text-danger small">Rellene todos los campos </p>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <img src="{{ asset($estudiante->foto) }}" class="img-thumbnail" width="75"
                                            alt="Foto">

                                    </div>
                                </div>
                                <div class="card-body">

                                    <form action="{{ route('admin.estudiantes.update', $estudiante->id) }}" method="POST"
                                        id="formularioCrearEstudiante" class="row g-3 needs-validation"
                                        enctype="multipart/form-data" novalidate>
                                        {{--  --}}
                                        @csrf
                                        @method('PUT')


                                        {{-- INICIO DE DATOS PERSONALES --}}
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Nombre y apellido</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                                    <i class="bi bi-people"></i>
                                                </span>
                                                <input type="text" name="nombre" class="form-control" id="yourUsername"
                                                    placeholder="Ingrese su nombres y apellidos"
                                                    value="{{ old('nombre') ?? $estudiante->nombre }}" required>
                                                <div class="invalid-feedback">Por favor, ingrese nombre! </div>
                                                @error('nombre')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-4">
                                            <label for="validationCustom04" class="form-label">Nacionalidad</label>
                                            <select name="nacionalidad" class="form-select" id="validationCustom04"
                                                required>
                                                @if (old('nacionalidad'))
                                                    <option value="{{ old('nacionalidad') }}" selected>
                                                        {{ old('nacionalidad') }}
                                                    </option>
                                                @endif
                                                @if ($estudiante->nacionalidad)
                                                    <option value="{{ $estudiante->nacionalidad }}" selected>
                                                        {{ old('nacionalidad') ?? $estudiante->nacionalidad }}
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
                                            <div class="input-group">
                                                <input type="text" name="cedula" class="form-control bg-muted"
                                                    id="inputCedula" placeholder="Ingrese cédula"
                                                    value="{{ old('password') ?? $estudiante->cedula }}" disabled readonly
                                                    required>
                                                <button type="button" class="btn btn-warning" id="activarEdicionDeCedula">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                            </div>
                                            <div class="invalid-feedback">Por favor, Ingrese número de cédula!</div>
                                            @error('cedula')
                                                <div class="text-danger"> {{ $message }} </div>
                                            @enderror
                                        </div>

                                        <div class="col-xs-12 col-sm-4">
                                            <label for="yourPassword" class="form-label">Teléfono</label>
                                            <input type="text" name="telefono" class="form-control" id="yourUsername"
                                                placeholder="Ingrese número de teléfono"
                                                value="{{ old('telefono') ?? $estudiante->telefono }}" min="11"
                                                max="15" required>
                                            <div class="invalid-feedback">Por favor, Ingrese número de teléfono!
                                            </div>
                                            @error('telefono')
                                                <div class="text-danger"> {{ $message }} </div>
                                            @enderror
                                        </div>

                                        <div class="col-xs-12 col-sm-4">
                                            <label for="yourPassword" class="form-label">E-mail</label>
                                            <input type="email" name="correo" class="form-control" id="yourUsername"
                                                placeholder="Ingrese dirección de correo."
                                                value="{{ old('correo') ?? $estudiante->correo }}" required>
                                            <div class="invalid-feedback">Por favor, Ingrese dirección de correo!
                                            </div>
                                            @error('correo')
                                                <div class="text-danger"> {{ $message }} </div>
                                            @enderror
                                        </div>

                                        <div class="col-xs-12 col-sm-4">
                                            <label for="yourPassword" class="form-label">Fecha de nacimiento</label>
                                            <input type="date" name="nacimiento" class="form-control"
                                                id="fecha_nacimiento_estudiante" placeholder="Ingrese fecha de nacimiento."
                                                value="{{ old('nacimiento') ?? $estudiante->nacimiento }}" required>
                                            <div class="invalid-feedback">Por favor, ingrese fecha de nacimiento!
                                            </div>
                                            @error('nacimiento')
                                                <div class="text-danger"> {{ $message }} </div>
                                            @enderror
                                        </div>

                                        <div class="col-xs-12 col-sm-4">
                                            <label for="yourPassword" class="form-label">Edad</label>
                                            <input type="number" name="edad" class="form-control"
                                                id="edad_estudiante" placeholder="Ingrese edad."
                                                value="{{ old('edad') ?? $estudiante->edad }}" min="1"
                                                max="120" required>
                                            <div class="invalid-feedback">Por favor, Ingrese edad!</div>
                                            @error('edad')
                                                <div class="text-danger"> {{ $message }} </div>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Dirección de
                                                habitación</label>
                                            <input type="text" name="direccion" class="form-control"
                                                id="yourUsername" placeholder="Ingrese dirección de domicilio."
                                                value="{{ old('direccion') ?? $estudiante->direccion }}" required>
                                            <div class="invalid-feedback">Por favor, Ingrese dirección!</div>
                                            @error('direccion')
                                                <div class="text-danger"> {{ $message }} </div>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Grado de estudio</label>
                                            <input type="text" name="grado" class="form-control" id="yourUsername"
                                                placeholder="Ingrese grado de estudio."
                                                value="{{ old('grado') ?? $estudiante->grado }}" required>
                                            <div class="invalid-feedback">Por favor, Ingrese grado de estudio!
                                            </div>
                                            @error('grado')
                                                <div class="text-danger"> {{ $message }} </div>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Ocupación o
                                                profesión</label>
                                            <input type="text" name="ocupacion" class="form-control"
                                                id="yourUsername" placeholder="Ingrese ocupación."
                                                value="{{ old('ocupacion') ?? $estudiante->ocupacion }}" required>
                                            <div class="invalid-feedback">Por favor, Ingrese ocupación!</div>
                                            @error('ocupacion')
                                                <div class="text-danger"> {{ $message }} </div>
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

                                        {{-- FIN DE DATOS PERSONALES --}}


                                        @if ($estudiante->representante)
                                            <div class="card">
                                                <h5 class="card-header">Representante</h5>
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        {{ $estudiante->representante->nombre }}</h5>
                                                    <p class="card-text">Cédula:
                                                        {{ 'V-' . $estudiante->representante->cedula }}</p>
                                                    <p class="card-text">Teléfono:
                                                        {{ $estudiante->representante->telefono }}</p>
                                                    <p class="card-text">Correo:
                                                        {{ $estudiante->representante->correo ?? 'No asignado' }}
                                                    </p>
                                                    <p class="card-text">Cumpleaños:
                                                        <span
                                                            id="fecha_cumpleanio">{{ $estudiante->representante->nacimiento }}</span>
                                                        🥳
                                                    </p>
                                                    <p class="card-text">Edad:
                                                        {{ $estudiante->representante->edad }}</p>
                                                    <p class="card-text">Dirección:
                                                        {{ $estudiante->representante->direccion }}</p>
                                                    <p class="card-text">Ocupación:
                                                        {{ $estudiante->representante->ocupacion }}</p>

                                                    {{-- Boton de editar representante --}}

                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#modalEditarRepresentante">
                                                        <i class="bi bi-pencil fs-3"></i>
                                                    </button>


                                                    {{-- Boton de eliminar representante --}}
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#modalEliminarRepresentante">
                                                        <i class="bi bi-trash fs-3"></i>
                                                    </button>

                                                </div>
                                            </div>
                                        @else
                                            <button type="button" class="btn btn-primary fs-3" data-bs-toggle="modal"
                                                data-bs-target="#modalAddRepresentante">
                                                <i class="bi bi-person-fill-add "></i>
                                                Agregar o asignar representante
                                            </button>
                                        @endif

                                        <div class="col-12">
                                            <h5 class="mt-3">Editar dificultad de aprendizaje</h5>
                                            <hr>
                                        </div>

                                        @foreach ($estudiante->dificultades as $key => $dificultad)
                                            <div class="col-xs-12 col-sm-4">
                                                <label for="yourUsername"
                                                    class="form-label">{{ $dificultad->dificultad }}</label>
                                                <input type="checkbox" name="dif_{{ $key + 1 }}"
                                                    value="{{ $dificultad->dificultad }}" class="form-checkbox"
                                                    {{ $dificultad->estatus ? 'checked' : '' }} id="yourUsername">
                                            </div>
                                        @endforeach





                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Guardar datos</button>
                                        </div>


                                    </form>

                                </div>

                            </div>
                        @endif


                    </div>
                </div>
            </div>

            @if ($estudiante->representante)
                <!-- Modal  Editar Representante -->
                <div class="modal fade" id="modalEditarRepresentante" tabindex="-1"
                    aria-labelledby="modalEditarRepresentante" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEditarRepresentante">
                                    Editar datos del representante
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.representantes.update', $estudiante->representante->id) }}"
                                    method="post" id="formulario_de_representante" class="needs-validation" novalidate>
                                    @csrf
                                    @method('PUT')
                                    <div class="col-12">
                                        <label for="yourName" class="form-label">Nombre del representante</label>
                                        <input type="text" name="rep_nombre" class="form-control" id="rep_nombre"
                                            placeholder="Ingrese Nombre del representante."
                                            value="{{ old('rep_nombre') ?? $estudiante->representante->nombre }}"
                                            required>
                                        <span></span>
                                        <div class="invalid-feedback">Por favor, Nombre del representante!</div>
                                        @error('rep_nombre')
                                            <div class="text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Cédula </label>
                                        <input type="number" name="rep_cedula" class="form-control" id="rep_cedula"
                                            placeholder="Ingrese teléfono del representante."
                                            value="{{ old('rep_cedula') ?? $estudiante->representante->cedula }}"
                                            required>
                                        <span></span>
                                        <div class="invalid-feedback">Por favor, Ingrese teléfono del representante!</div>
                                        @error('rep_cedula')
                                            <div class="text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Teléfono </label>
                                        <input type="text" name="rep_telefono" class="form-control" id="yourUsername"
                                            placeholder="Ingrese teléfono del representante."
                                            value="{{ old('rep_telefono') ?? $estudiante->representante->telefono }}"
                                            required>
                                        <span></span>
                                        <div class="invalid-feedback">Por favor, Ingrese teléfono del representante!</div>
                                        @error('rep_telefono')
                                            <div class="text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Fecha de nacimiento</label>
                                        <input type="date" name="rep_nacimiento" class="form-control"
                                            id="rep_nacimiento" placeholder="Ingrese fecha de cumpleaños."
                                            value="{{ old('rep_nacimiento') ?? $estudiante->representante->nacimiento }}"
                                            required>
                                        <span></span>
                                        <div class="invalid-feedback">Por favor, Ingrese fecha de nacimiento!</div>
                                        @error('rep_nacimiento')
                                            <div class="text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Edad</label>
                                        <input type="number" name="rep_edad" class="form-control" id="rep_edad"
                                            placeholder="Ingrese edad."
                                            value="{{ old('rep_edad') ?? $estudiante->representante->edad }}" required>
                                        <span></span>
                                        <div class="invalid-feedback">Por favor, Ingrese edad!</div>
                                        @error('rep_edad')
                                            <div class="text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Ocupación</label>
                                        <input type="text" name="rep_ocupacion" class="form-control"
                                            id="rep_ocupacion" placeholder="Ingrese ocupación o oficio."
                                            value="{{ old('rep_ocupacion') ?? $estudiante->representante->ocupacion }}"
                                            required>
                                        <span></span>
                                        <div class="invalid-feedback">Por favor, ocupación o oficio!</div>
                                        @error('rep_ocupacion')
                                            <div class="text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Dirección del
                                            representante</label>
                                        <input type="text" name="rep_direccion" class="form-control"
                                            id="rep_direccion" placeholder="Ingrese dirección del representante."
                                            value="{{ old('rep_direccion') ?? $estudiante->representante->direccion }}"
                                            required>
                                        <span></span>
                                        <div class="invalid-feedback">Por favor, Ingrese dirección del representante!</div>
                                        @error('rep_direccion')
                                            <div class="text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Correo</label>
                                        <input type="text" name="rep_correo" class="form-control" id="rep_correo"
                                            placeholder="Ingrese correo."
                                            value="{{ old('rep_correo') ?? $estudiante->representante->correo }}"
                                            required>
                                        <span></span>
                                        <div class="invalid-feedback">Por favor, Ingrese correo del representante!</div>
                                        @error('rep_correo')
                                            <div class="text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">
                                    Guardar cambios
                                </button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Cancelar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal ELIMINAR REPRESENTANTE -->
                <div class="modal fade" id="modalEliminarRepresentante" tabindex="-1"
                    aria-labelledby="modalEliminarRepresentante" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEliminarRepresentante">
                                    Representante
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                En los siguientes botones puedes eliminar y desasignar el
                                representante del estudiante.
                                <ul>
                                    <li>
                                        Si das click en el botón de <span class="text-danger">Desasignar</span> el
                                        representante seguira registrado en el sistema y
                                        solo sera desasignado del estudiante.
                                    </li>
                                    <li>
                                        Si das click en <span class="text-danger">Elimianar
                                        </span>
                                        el representante sera desasignado y eliminado de los
                                        registros del sistema.
                                    </li>
                                </ul>



                            </div>
                            <div class="modal-footer">

                                <form action="{{ route('admin.representantes.destroy', $estudiante->representante->id) }}"
                                    method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-primary">
                                        Si, Elimianar.
                                    </button>
                                </form>

                                <form
                                    action="{{ route('admin.reprsentanteEstudiates.destroy', $estudiante->representante->idRelacionPibote) }}"
                                    method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-primary">
                                        Si; pero solo desasignar el representate.
                                    </button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Cancelar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Modal  Agregar o asignar Representante -->
                <div class="modal fade" id="modalAddRepresentante" tabindex="-1"
                    aria-labelledby="modalAddRepresentante" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalAddRepresentante">
                                    Agregar y asignar representante
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.representantes.store') }}" method="post"
                                    id="formulario_add_representante" class="needs-validation" novalidate>
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="rep_cedula_estudiante"
                                        value="{{ $estudiante->cedula }}">
                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Cédula <span class="text-danger">(Si
                                                la cédula coinside con un representante se cargaran los datos del
                                                representante)</span></label>
                                        <input type="number" name="rep_cedula" class="form-control" id="rep_cedula"
                                            placeholder="Ingrese cédula del representante."
                                            value="{{ old('rep_cedula') ?? '' }}" required>
                                        <span></span>
                                        <div class="invalid-feedback">Por favor, Ingrese teléfono del representante!</div>
                                        @error('rep_cedula')
                                            <div class="text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                    <div id="preload"></div>
                                    <div class="my-2 p-2 text-white" id="mensajeRepresentante"></div>

                                    <div id="componenteCardRepresentante"></div>

                                    <div id="componenteRepresentante" class="d-none">

                                        <div class="col-12">
                                            <label for="yourName" class="form-label">Nombre del representante</label>
                                            <input type="text" name="rep_nombre" class="form-control" id="rep_nombre"
                                                placeholder="Ingrese Nombre del representante."
                                                value="{{ old('rep_nombre') ?? '' }}" required>
                                            <span></span>
                                            <div class="invalid-feedback">Por favor, Nombre del representante!</div>
                                            @error('rep_nombre')
                                                <div class="text-danger"> {{ $message }} </div>
                                            @enderror
                                        </div>
                                        {{-- input Teléfono --}}
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Teléfono </label>
                                            <input type="phone" name="rep_telefono" class="form-control"
                                                id="rep_telefono" placeholder="Ingrese teléfono del representante."
                                                value="{{ old('rep_telefono') ?? '' }}" required>
                                            <span></span>
                                            <div class="invalid-feedback">Por favor, Ingrese teléfono del representante!
                                            </div>
                                            @error('rep_telefono')
                                                <div class="text-danger"> {{ $message }} </div>
                                            @enderror
                                        </div>

                                        {{-- input Fecha de nacimiento --}}
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Fecha de nacimiento</label>
                                            <input type="date" name="rep_nacimiento" class="form-control"
                                                id="rep_nacimiento" placeholder="Ingrese fecha de cumpleaños."
                                                min="1940-01-01" max="{{ date('Y-m-d') }}"
                                                value="{{ old('rep_nacimiento') ?? '' }}" required>
                                            <span></span>
                                            <div class="invalid-feedback">Por favor, Ingrese fecha de nacimiento valida.
                                            </div>
                                            @error('rep_nacimiento')
                                                <div class="text-danger"> {{ $message }} </div>
                                            @enderror
                                        </div>

                                        {{--  --}}
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Edad</label>
                                            <input type="number" name="rep_edad" class="form-control" id="rep_edad"
                                                placeholder="Ingrese edad." value="{{ old('rep_edad') ?? '' }}"
                                                min="1" max="120" required>
                                            <span></span>
                                            <div class="invalid-feedback">Por favor, Ingrese una edad valida.</div>
                                            @error('rep_edad')
                                                <div class="text-danger"> {{ $message }} </div>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Ocupación</label>
                                            <input type="text" name="rep_ocupacion" class="form-control"
                                                id="rep_ocupacion" placeholder="Ingrese ocupación o oficio."
                                                value="{{ old('rep_ocupacion') ?? '' }}" required>
                                            <span></span>
                                            <div class="invalid-feedback">Por favor, ocupación o oficio!</div>
                                            @error('rep_ocupacion')
                                                <div class="text-danger"> {{ $message }} </div>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Dirección del
                                                representante</label>
                                            <input type="text" name="rep_direccion" class="form-control"
                                                id="rep_direccion" placeholder="Ingrese dirección del representante."
                                                value="{{ old('rep_direccion') ?? '' }}" required>
                                            <span></span>
                                            <div class="invalid-feedback">Por favor, Ingrese dirección del representante!
                                            </div>
                                            @error('rep_direccion')
                                                <div class="text-danger"> {{ $message }} </div>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Correo</label>
                                            <input type="text" name="rep_correo" class="form-control" id="rep_correo"
                                                placeholder="Ingrese correo." value="{{ old('rep_correo') ?? '' }}"
                                                required>
                                            <span></span>
                                            <div class="invalid-feedback">Por favor, Ingrese correo del representante!
                                            </div>
                                            @error('rep_correo')
                                                <div class="text-danger"> {{ $message }} </div>
                                            @enderror
                                        </div>
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">
                                    Registrar y asignar representante
                                </button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Cancelar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </section>

        <script src="{{ asset('assets/js/representantes/getRepresentanteEdit.js') }}"></script>
        <script src="{{ asset('assets/js/profesores/editar.js') }}"></script>
        <script src="{{ asset('assets/js/estudiantes/editar.js') }}"></script>
    </div>
@endsection
