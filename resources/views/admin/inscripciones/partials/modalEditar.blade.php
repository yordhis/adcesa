
        
<!-- Vertically centered Modal -->
<a type="button" class="text-warning" data-bs-toggle="modal" data-bs-target="#modalObservacion{{ $inscripcione->id }}">
    <i class="bi bi-pencil fs-3"></i>
</a>
    


<div class="modal fade" id="modalObservacion{{ $inscripcione->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Asignar Observación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('admin.inscripciones.update', $inscripcione->id) }}" method="post">
            @csrf
            @method('put')
            <div class="modal-body">
                <div class="col-12">
                    
                    <label for="observacion" class="form-label">Agregar o Actualizar Observación de la inscripción</label>
                    
                    <div class="form-floating mb-3">
                        <textarea class="form-control" 
                        name="observacion"
                        placeholder="Deja tu observación aquí!" 
                        id="floatingTextarea" 
                        style="height: 200px;">
                        
                        </textarea>
                        <label for="floatingTextarea">
                            Observación
                        </label>
                    </div>     
                    
                    <p>
                        <h5> Observación Actual</h5>
                        <span class="text-muted">
                            {{explode(",", $inscripcione->extras)[4] ? explode(",", $inscripcione->extras)[4] : "No hay observación asignada"}}
                        </span>
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary ">Guardar observación</button>
            </div>
        </form>
    </div>
    </div>

  

    
</div><!-- End Vertically centered Modal-->




