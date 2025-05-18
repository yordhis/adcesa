
        
<!-- Vertically centered Modal -->
<a type="button" class="text-primary" data-bs-toggle="modal" data-bs-target="#modalRestaurar_{{ $inscripcion->id }}">
    <i class="bi bi-arrow-clockwise fs-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Restaurar Inscripción"></i>
</a>
    


<div class="modal fade" id="modalRestaurar_{{ $inscripcion->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Eliminar Datos de Inscripción</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('admin.inscripciones.reset', $inscripcion->id) }}" method="post" >
            @csrf
            @method('put')
            <div class="modal-body">
                <p>
                   Está seguro que desea RESTAURAR los datos de inscripción del estudiante 
                   <b>{{ $inscripcion->estudiante_nombre ?? ''}}</b> 
                   <br>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success">Si, Proceder a restaurar</button>
            </div>
        </form>
    </div>
    </div>
</div><!-- End Vertically centered Modal-->


