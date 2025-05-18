
        
<!-- Vertically centered Modal -->
<a type="button" class="text-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered{{$estudiante->id}}">
    <i class="bi bi-trash  fs-3"></i>
</a>

<div class="modal fade" id="verticalycentered{{$estudiante->id}}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Eliminando</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            ¿Esta seguro que desea eliminar el estudiante: <span class="text-danger fs-5">{{$estudiante->nombre}} - {{$estudiante->cedula}}</span>
            Del grupo {{$grupo->nombre}}? 
        </div>
        <div class="modal-footer">
            <form action="grupoEstudiantes/{{$estudiante->id}}" method="post" target="_self">
            @csrf
            @method('delete')
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Si, proceder a eliminar.</button>
            </form>
        </div>
    </div>
    </div>
</div><!-- End Vertically centered Modal-->


