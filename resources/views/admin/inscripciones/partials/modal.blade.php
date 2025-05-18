
        
<!-- Vertically centered Modal -->
<a type="button" class="text-success" data-bs-toggle="modal" data-bs-target="#verticalycentered{{$inscripcion->id}}">
    <i class="bi bi-journal-plus fs-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Asignar nota"></i>
</a>
    
<div class="modal fade" id="verticalycentered{{$inscripcion->id}}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Asignar nota</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action=" {{ route( 'admin.notas.update', $inscripcion->id ) }}" method="post" class="row g-3 needs-validation" novalidate>
            @csrf
            @method('put')
            <div class="modal-body">
                <div class="col-12">
                <p>
                    Esta nota será asignada a la inscripción del Nivel <b>{{$inscripcion->nivel_nombre}}</b> <br>
                    del estudiante <b> {{ $inscripcion->estudiante_nombre ?? ''}}</b>.
                </p>
                    
                    <label for="yourPassword" class="form-label">Ingrese nota</label>
                    <input type="number" step="0.01" min="1" max="100" name="nota" class="form-control" id="yourUsername" 
                    placeholder="Ingrese nota del estudiante"
                    value="{{ explode("/", $inscripcion->nota)[0] ?? "" }}"
                    required>
                    <div class="invalid-feedback">Por favor, Ingrese nota!</div>
                </div>
                <div class="col-12">
                    <label for="yourPassword" class="form-label">Ingrese Sobre cuanto se evaluó</label>
                    <input type="number" step="0.01" min="1" max="100" name="notaMaxima" class="form-control" id="yourUsername" 
                    placeholder="Ingrese sobre cuanto se evaluó."
                    value="{{ explode("/", $inscripcion->nota)[1] ?? "" }}"
                    required>
                    <div class="invalid-feedback">Por favor, Ingrese sobre cuanto se evaluó!</div>
                </div>
            </div>
            <div class="modal-footer">
                <small class="text-danger"></small>
              
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Asignar nota</button>
            </div>
        </form>
    </div>
    </div>
</div><!-- End Vertically centered Modal-->


