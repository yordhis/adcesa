<!-- Vertically centered Modal -->
<a type="button" class="text-info" data-bs-toggle="modal" data-bs-target="#modalVer{{ $inscripcion->id }}">
    <i class="bi bi-eye fs-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Procesar pago"></i>
</a>



<div class="modal fade" id="modalVer{{ $inscripcion->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white fw-bold">Información de inscripción</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body table-resposive">
                <table class="table table-hover">
                    <tr class="table-dark">
                        <td colspan="2" class="text-center fs-4 fw-bold">Datos del Estudiante</td>
                    </tr>
                    <tr>
                        <td class="table-secondary fs-5 fw-semibold">Nombres y Apellidos:</td>
                        <td>{{ $inscripcion->estudiante_nombre }}</td>
                    </tr>
                    <tr>
                        <td class="table-secondary fs-5 fw-semibold">Cédula:</td>
                        <td>{{ $inscripcion->cedula_estudiante }}</td>
                    </tr>
                    <tr>
                        <td class="table-secondary fs-5 fw-semibold">Teléfono:</td>
                        <td>{{ $inscripcion->estudiante_telefono }}</td>
                    </tr>
                    <tr>
                        <td class="table-secondary fs-5 fw-semibold">Ocupación:</td>
                        <td>{{ $inscripcion->estudiante_ocupacion }}</td>
                    </tr>
                    <tr>
                        <td class="table-secondary fs-5 fw-semibold">Grado de instrucción:</td>
                        <td>{{ $inscripcion->estudiante_grado }}</td>
                    </tr>

                    <tr class="table-dark">
                        <td colspan="2" class="text-center fs-4 fw-bold">Plan de Estudio</td>
                    </tr>

                    <tr>
                        <td class="table-secondary fs-5 fw-semibold">Nivel:</td>
                        <td>{{ $inscripcion->nivel_nombre }}</td>
                    </tr>
                    <tr>
                        <td class="table-secondary fs-5 fw-semibold">Grupo de estudio:</td>
                        <td>
                            <a href="{{ route('admin.grupos.index', ['filtro' => $inscripcion->codigo_grupo]) }}">
                                {{ $inscripcion->codigo_grupo . '-' . $inscripcion->grupo_nombre }} <i
                                    class="bi  bi-box-arrow-up-right"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-secondary fs-5 fw-semibold">Horario:</td>
                        <td>
                            Horas: {{ $inscripcion->grupo_hora_inicio . ' - ' . $inscripcion->grupo_hora_fin }}
                            | Días: {{ $inscripcion->grupo_dias }}

                        </td>
                    </tr>
                    <tr>
                        <td class="table-secondary fs-5 fw-semibold">Lapzo del grupo:</td>
                        <td>
                            <b>Inicia:</b> {{ date_format(date_create($inscripcion->grupo_fecha_inicio), 'd/m/Y') }}

                            | <b>Culmina:</b> {{ date_format(date_create($inscripcion->grupo_fecha_fin), 'd/m/Y') }}
                        </td>
                    </tr>
                    <td class="table-secondary fs-5 fw-semibold">Estatus del grupo:</td>
                    <td>
                        @if ($inscripcion->grupo_estatus == 1)
                            <div class="bg-success w-25 text-center p-2 text-white fw-bold">
                                ACTIVO
                            </div>
                        @else
                            <div class="bg-danger w-25 text-center p-2 text-white fw-bold">
                                CURSO CULMINADO
                            </div>
                        @endif
                    </td>


                    <tr class="table-dark">
                        <td colspan="2" class="text-center fs-4 fw-bold">Información de inscripcción</td>
                    </tr>
                    <tr>
                        <td class="table-secondary fs-5 fw-semibold">Estatus:</td>
                        <td>
                            @if ($inscripcion->estatus == 1)
                                <div class="bg-success w-25 text-center p-2 text-white fw-bold">
                                    ACTIVO
                                </div>
                            @else
                                <div class="bg-danger w-25 text-center p-2 text-white fw-bold">
                                    INACTIVO
                                </div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="table-secondary fs-5 fw-semibold">Nota:</td>
                        <td class="text-success fs-4">
                            {{ $inscripcion->nota ?? 'En curso' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="table-secondary fs-5 fw-semibold">Observación:</td>
                        <td
                            class="
                            {{ $inscripcion->extras[4] ? 'text-dark' : 'text-danger' }}
                        fs-6">
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="" id="observacon">
                                    {{ $inscripcion->extras[4] ? $inscripcion->extras[4] : 'Sin observacion' }}
                                </p>
                                <button class="btn btn-none text-warning btn_edit_observacion"
                                    id="{{ $inscripcion->id }}">
                                    <i class="bi bi-pencil fs-3" id="{{ $inscripcion->id }}"></i>
                                </button>

                            </div>
                        </td>
                    </tr>
                    <tr id="textarea_{{ $inscripcion->id }}" class="table-white d-none">
                        <td colspan="2">
                            <form action="{{ route('admin.update.observacion', $inscripcion->id) }}" class="p-2"
                                method="post">
                                @csrf
                                @method('put')
                                <div class="form-floating my-2">
                                    <textarea class="form-control" name="observacion" cols="30" rows="25" style="height: 100px"
                                        id="floatingTextarea">{{ $inscripcion->extras[4] ? $inscripcion->extras[4] : 'Sin observacion' }}</textarea>
                                    <label for="floatingTextarea">Observación</label>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-success">Guardar Obsevación</button>
                                    <button type="button" class="btn btn-danger"
                                        id="btn_closed_{{ $inscripcion->id }}">Ocultar</button>
                                </div>
                            </form>


                        </td>
                    </tr>

                </table>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->
