
        
<!-- Vertically centered Modal -->
<a type="button" class="text-primary" data-bs-toggle="modal" data-bs-target="#modalEliminar_{{ $preinscripcion->id }}">
    <i class="bi bi-trash fs-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar inscripción"></i>
</a>
    


<div class="modal fade" id="modalEliminar_{{ $preinscripcion->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Eliminar Datos de Inscripción</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('admin.preinscripciones.destroy', $preinscripcion->id) }}" method="post" >
            @csrf
            @method('delete')
            <div class="modal-body">
                <p>
                   Está seguro que desea eliminar los datos de Pre-inscripción del estudiante 
                   <b>{{ $preinscripcion->estudiante->nombre ?? ''}}</b> 
                   <br>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-danger">Si, Proceder a eleminar</button>
            </div>
        </form>
    </div>
    </div>
</div><!-- End Vertically centered Modal-->


