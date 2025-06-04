<!-- Vertically centered Modal -->
<a type="button" class="mb-3" data-bs-toggle="modal" data-bs-target="#verticalycentered{{ $categoria->id }}">
    <i class="bi bi-trash fs-3 text-danger"></i>
</a>

<div class="modal fade" id="verticalycentered{{ $categoria->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Eliminando</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Esta seguro que desea eliminar la categoria <span class="text-danger fs-5">{{ $categoria->nombre }}</span>?
                <form action="{{ route('admin.categorias.destroy', $categoria->id) }}" method="post">
                    @csrf
                    @method('delete')
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger my-3">Si, proceder a eliminar.</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->
