<!-- Vertically centered Modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFormCreateGrupo">
    <i class="bi bi-plus "></i>  Crear Grupo
</button>

<div class="modal fade" id="modalFormCreateGrupo" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear Grupo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                <form action="{{ route('admin.grupos.store') }}" method="post" class="row g-3 needs-validation"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('post')

                    <div class="col-12">
                        <label for="yourUsername" class="form-label">Código
                            <span class=" text-primary">(Es automático)</span>
                        </label>
                        <div class="input-group has-validation">
                            <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                <i class="bi bi-upc-scan"></i>
                            </span>
                            <input type="text" name="codigo" class="form-control fs-5 text-danger" id="yourUsername"
                                value="{{ $codigo ?? $request->codigo }}" readonly required>
                            <div class="invalid-feedback">Por favor, ingrese codigo! </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="yourPassword" class="form-label">Nombre del grupo de estudio</label>
                        <input type="text" name="nombre" class="form-control" id="yourUsername"
                            placeholder="Ingrese nombre del grupo de estudio" value="{{ old('nombre') ?? $request->nombre }}"
                            required>
                        <div class="invalid-feedback">Por favor, Ingrese nombre del plan!</div>
                    </div>

                    <div class="col-12">
                        <label for="validationCustom04" class="form-label">Asigne Nivel de estudio</label>
                        <select name="codigo_nivel" class="form-select" id="validationCustom04" required>
                            <option value="">Seleccione Nivel</option>

                            @foreach ($niveles as $nivel)
                                @if (old('codigo_nivel'))
                                    @if (old('codigo_nivel') == $nivel->codigo)
                                        <option value="{{ $nivel->codigo }}" selected>{{ $nivel->codigo }} -
                                            {{ $nivel->nombre }} - Costo: {{ $nivel->precio }}</option>
                                        @php continue; @endphp
                                    @endif
                                @endif

                                <option value="{{ $nivel->codigo }}">{{ $nivel->codigo }} -
                                    {{ $nivel->nombre }} - Costo: {{ $nivel->precio }}</option>
                            @endforeach

                        </select>
                        <div class="invalid-feedback">
                            Por favor, Seleccione Nivel de estudio!
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="validationCustom04" class="form-label">Asigne Profesor</label>
                        <select name="cedula_profesor" class="form-select" id="validationCustom04" required>
                            <option value="">Seleccione Profesor</option>

                            @foreach ($profesores as $profesor)
                                @if (old('cedula_profesor'))
                                    @if (old('cedula_profesor') == $profesor->cedula)
                                        <option value="{{ $profesor->cedula }}" selected>
                                            {{ $profesor->cedula }} -
                                            {{ $profesor->nombre }}</option>
                                        @php continue; @endphp
                                    @endif
                                @endif
                                <option value="{{ $profesor->cedula }}">{{ $profesor->cedula }} -
                                    {{ $profesor->nombre }}</option>
                            @endforeach

                        </select>
                        <div class="invalid-feedback">
                            Por favor, Seleccione Profesor!
                        </div>
                    </div>

                    <div class="col-12">
                        <h3>Horario</h3>
                        <hr>
                    </div>

                    <div class="col-6">
                        <label for="yourPassword" class="form-label">De</label>
                        <input type="time" name="hora_inicio" class="form-control" id="yourUsername"
                            placeholder="Ingrese hora de inicio de clase." value="{{ old('hora_inicio') ?? $request->hora_inicio  }}"
                            required>
                        <div class="invalid-feedback">Por favor, Ingrese la descripción del grupo!</div>
                    </div>

                    <div class="col-6">
                        <label for="yourPassword" class="form-label">Hasta</label>
                        <input type="time" name="hora_fin" class="form-control" id="yourUsername"
                            placeholder="Ingrese hora de finalización de clase." value="{{ old('hora_fin') ?? $request->hora_fin  }}"
                            required>
                        <div class="invalid-feedback">Por favor, Ingrese la descripción del plan!</div>
                    </div>

                    <div class="col-12">
                        <h5>Seleccione los Días de clase</h5>
                    </div>

                    <div class="col-12">
                        @foreach ($dias as $dia)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="{{ $dia }}"
                                    name="dia_{{ $dia }}" value="{{ $dia }}" id="metodos">
                                <label class="form-check-label" for="{{ $dia }}">{{ $dia }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="col-6">
                        <label for="yourPassword" class="form-label">Inicio del curso</label>
                        <input type="date" name="fecha_inicio" class="form-control" id="yourUsername"
                            placeholder="Ingrese fecha de incio del curso."
                            value="{{ old('fecha_inicio') ?? $request->fecha_inicio }}" required>
                        <div class="invalid-feedback">Por favor, Ingrese fecha de incio del curso!</div>
                    </div>
                    <div class="col-6">
                        <label for="yourPassword" class="form-label">Fin del curso</label>
                        <input type="date" name="fecha_fin" class="form-control" id="yourUsername"
                            placeholder="Ingrese fecha de finalización del curso."
                            value="{{ old('fecha_fin') ?? $request->fecha_fin }}" required>
                        <div class="invalid-feedback">Por favor, Ingrese fecha de finalización del curso.!
                        </div>
                    </div>



                    <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">Crear Grupo de
                            estudio</button>
                    </div>

                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->
