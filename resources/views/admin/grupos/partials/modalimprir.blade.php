
        
<!-- Vertically centered Modal -->
<a type="button" class="text-dark" data-bs-toggle="modal" data-bs-target="#modalPrint{{$grupo->id}}">
    <i class="bi bi-printer-fill fs-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Imprimir matricula de estudiantes"></i>
 
</a>
    
<div class="modal fade" id="modalPrint{{$grupo->id}}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Imprimir archivos</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="d-flex">
                <a href="{{ route('admin.grupos.imprimir', [
                    "codigoGrupo" => $grupo->codigo
                ])}}"
                class="btn btn-warning w-50 m-2"
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Imprimir Matricula del grupo"
                > 
                    <i class="bi bi-file-earmark-ppt-fill fs-2"></i>
                    
                </a>
                
            </div>
        </div>
       
    </div>
    </div>
</div><!-- End Vertically centered Modal-->


