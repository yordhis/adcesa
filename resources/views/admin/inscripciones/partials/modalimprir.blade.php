<!-- Vertically centered Modal -->
<a type="button" class="text-dark" data-bs-toggle="modal" data-bs-target="#modalPrint{{ $inscripcion->id }}">
    <i class="bi bi-printer-fill fs-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Imprimir comprobantes"></i>

</a>

<div class="modal fade" id="modalPrint{{ $inscripcion->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Imprimir archivos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex">
                    <a href="{{ route('admin.inscripciones.pdf', [
                        'cedula' => $inscripcion->cedula_estudiante,
                        'codigo' => $inscripcion->codigo,
                    ]) }}"
                        class="btn btn-warning w-50 m-2" data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-title="Imprimir Planilla de inscripción" target="_blank">
                        <i class="bi bi-file-earmark-ppt-fill fs-2"></i>

                    </a>
                    <a href="{{ route('admin.pagos.recibopdf', [
                        'cedula_estudiante' => $inscripcion->cedula_estudiante,
                        'codigo_inscripcion' => $inscripcion->codigo,
                    ]) }}"
                        class="btn btn-primary w-50 m-2" data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-title="Imprimir Recibo de control de pagos" target="_blank">
                        <i class="bi bi-card-checklist fs-2"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div><!-- End Vertically centered Modal-->
