<!-- Vertically centered Modal -->
<a type="button" class="text-info" data-bs-toggle="modal" data-bs-target="#modalVerGrupo{{ $grupo->id }}">
    <i class="bi bi-eye fs-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver información de grupo"></i>
</a>



<div class="modal fade" id="modalVerGrupo{{ $grupo->id }}" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Información del grupo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table ">
                    <thead>
                        <tr class="table-dark fs-4">
                            <td class="bg-primary text-white ">Grupo:</td>
                            <td colspan="2">{{ $grupo->nombre }}</td>
                            <td class="bg-primary text-white">Código:</td>
                            <td class="text-danger" colspan="2">{{ $grupo->codigo }}</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="bg-primary text-white">Profesor:</td>
                            <td>{{ $grupo->profesor_nombre }}</td>
                            <td class="bg-primary text-white">C.I.:</td>
                            <td>{{ $grupo->profesor_cedula }}</td>
                            <td class="bg-primary text-white">Teléfono:</td>
                            <td class="">{{ $grupo->profesor_telefono }}</td>
                        </tr>
                        <tr>
                            <td class="bg-primary text-white">Nivel:</td>
                            <td>{{ $grupo->nivel_nombre }}</td>
                            <td class="bg-primary text-white">Duración:</td>
                            <td>{{ $grupo->nivel_duracion . " " . $grupo->nivel_tipo_duracion }}</td>
                            <td class="bg-primary text-white">Libro:</td>
                            <td class="">{{ $grupo->nivel_libro }}</td>
                        </tr>
                        <tr>
                            <td colspan="6" class="bg-dark text-white text-center fs-5">Horario</td>
                        </tr>
                        <tr>
                            <td class="bg-primary text-white">Días:</td>
                            <td colspan="3">{{ $grupo->dias }}</td>
                            <td class="bg-primary text-white">Hora:</td>
                            <td>{{ $grupo->hora_init . " hasta " . $grupo->hora_end }}</td>
                        </tr>
                        <tr>
                            <td class="bg-primary text-white">Incio del curso:</td>
                            <td colspan="2">{{ $grupo->fecha_init }}</td>
                            <td class="bg-primary text-white">Fin del curso:</td>
                            <td colspan="2" class="text-danger">{{ $grupo->fecha_end }}</td>
                        </tr>
                    </tbody>
                </table>

                <blockquote class="blockquote">
                    <p>Matrícula de estudiantes</p>
                </blockquote>

                <table class="table">
                    <thead>
                        <tr class="table-dark">
                            <td>Estudiante</td>
                            <td>Teléfono</td>
                            <td>Nota</td>
                            <td>Abonado</td>
                            <td>Pendiente</td>
                            <td>Acciones</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($grupo->estudiantes as $estudiante)
                        <tr>
                            <td>
                                {{ $estudiante->estudiante_nombre }}
                                - C.I.:{{  $estudiante->cedula_estudiante }}
                            </td>
                            <td>{{ $estudiante->estudiante_telefono}}</td>
                            <td>{{ $estudiante->inscripcion->nota}}</td>
                            <td class="table-success">{{ $estudiante->inscripcion->abono}}</td>
                            <td  class="table-danger">{{ $estudiante->inscripcion->total - $estudiante->inscripcion->abono }}</td>
                            <td class="d-flex">
                                <form action="{{ route('admin.grupoEstudiantes.destroy', $estudiante->id_grupo_estudiante) }}" method="post">
                                    @csrf
                                    @method('delete')
                                        <button type="submit" class="btn btn-none"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar estudiante del grupo">
                                            <i class="bi bi-trash "></i>
                                        </button>
                                    </form>

                                <form action="{{ route('admin.inscripciones.index') }}">
                                    @csrf
                                    @method('GET')
                                    <input type="hidden" name="filtro" value="{{ $estudiante->cedula_estudiante }}" 
                                    required>
                                    <button class="btn btn-none" type="submit" id="button-addon2"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Ir al módulo de pago">
                                        <i class="bi bi-paypal "></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div><!-- End Vertically centered Modal-->
