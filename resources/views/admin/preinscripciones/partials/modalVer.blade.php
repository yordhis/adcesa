<!-- Vertically centered Modal -->
<a type="button" class="text-info" data-bs-toggle="modal" data-bs-target="#modalVer{{ $preinscripcion->id }}">
    <i class="bi bi-eye fs-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Procesar pago"></i>
</a>



<div class="modal fade" id="modalVer{{ $preinscripcion->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white fw-bold">Información de Pre-inscripción</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body table-resposive">
                <table class="table table-hover">
                    <tr class="table-dark">
                        <td colspan="2" class="text-center fs-4 fw-bold">Datos del Estudiante</td>
                    </tr>
                    <tr>
                        <td class="table-secondary fs-5 fw-semibold">Nombres y Apellidos:</td>
                        <td>{{ $preinscripcion->estudiante->nombre }}</td>
                    </tr>
                    <tr>
                        <td class="table-secondary fs-5 fw-semibold">Cédula:</td>
                        <td>{{ $preinscripcion->estudiante->cedula }}</td>
                    </tr>
                    <tr>
                        <td class="table-secondary fs-5 fw-semibold">Teléfono:</td>
                        <td>{{ $preinscripcion->estudiante->telefono }}</td>
                    </tr>
                    <tr>
                        <td class="table-secondary fs-5 fw-semibold">Ocupación:</td>
                        <td>{{ $preinscripcion->estudiante->ocupacion }}</td>
                    </tr>
                    <tr>
                        <td class="table-secondary fs-5 fw-semibold">Grado de instrucción:</td>
                        <td>{{ $preinscripcion->estudiante->grado }}</td>
                    </tr>

                    <tr class="table-dark">
                        <td colspan="2" class="text-center fs-4 fw-bold">Plan de Estudio</td>
                    </tr>

                    <tr>
                        <td class="table-secondary fs-5 fw-semibold">Nivel:</td>
                        <td>{{ $preinscripcion->nivel->nombre }}</td>
                    </tr>
                    <tr>
                        <td class="table-secondary fs-5 fw-semibold">Plan:</td>
                        <td>{{ $preinscripcion->plan->nombre }}</td>
                    </tr>

                </table>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->
