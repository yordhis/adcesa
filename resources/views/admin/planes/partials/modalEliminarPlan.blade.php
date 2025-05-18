
        
<!-- Vertically centered Modal -->
<a type="button" class="text-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered{{$plane->id}}">
    <i class="bi bi-trash"
    data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar plan"></i>
</a>

<div class="modal fade" id="verticalycentered{{$plane->id}}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Eliminando</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            ¿Esta seguro que desea eliminar el plan <span class="text-danger fs-5">{{$plane->nombre}}</span>? 
        </div>
        <div class="modal-footer">
            <form action="{{ route('admin.planes.destroy', $plane->id) }}" method="post">
            @csrf
            @method('delete')
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Si, proceder a eliminar.</button>
            </form>
        </div>
    </div>
    </div>
</div><!-- End Vertically centered Modal-->


