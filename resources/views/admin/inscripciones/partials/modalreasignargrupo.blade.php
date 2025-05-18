<!-- Vertically centered Modal -->
<a type="button" class="text-primary" data-bs-toggle="modal" data-bs-target="#modalReasignar{{ $inscripcion->id }}">
 
    <i class="bi bi-person-fill-add fs-3 " data-bs-toggle="tooltip" data-bs-placement="top" title="Reasignar estudiante a un grupo"></i>
</a>



<div class="modal fade" id="modalReasignar{{ $inscripcion->id }}" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reasignar a un grupo</h5>
             
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h1>Estudiante: {{ $inscripcion->estudiante_nombre }} </h1>
                <p class="text-danger">El estudiante puede ser reasignado a otro grupo del mismo nivel con su inscripción actual. </p>

                <form action="{{ route('admin.inscripciones.reasignarGrupo') }}" method="post" class="row g-3 needs-validation"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('put')
                    {{-- Cedula del estudiante  --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Cédula del estudiante</span>
                        <input type="text" name="cedula_estudiante" class="form-control" readonly value="{{ $inscripcion->cedula_estudiante }}">
                    </div>
                    {{-- codigo de inscripcion --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Código de inscripción</span>
                        <input type="text" name="codigo_inscripcion" class="form-control text-danger" readonly value="{{ $inscripcion->codigo }}">
                    </div>
                      
                    {{-- Grupos de estudio --}}
                    <div class="col-12">
                        {{-- <label for="validationCustom04" class="form-label"></label> --}}
                        <select name="codigo_grupo" class="form-select" id="codigo_grupo" required>
                            <option selected disabled value="">Seleccione Grupo</option>

                            @foreach ($grupos as $grupo)
                                {{-- @if ($grupo->codigo_nivel == $inscripcion->codigo_nivel) --}}
                                    
                                    <option value="{{ $grupo->codigo }}">
                                        {{ $grupo->codigo }} -
                                        {{ $grupo->nombre }} - 
                                        Matricula: {{ $grupo->matricula }} - {{ $grupo->nivel_nombre }}
                                    </option>
                                {{-- @endif --}}
                            @endforeach

                        </select>
                        <div class="invalid-feedback">
                            Por favor, Seleccione Grupo de estudio!
                        </div>
                    </div>

               

                 
              
                    <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">Reasignar</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div><!-- End Vertically centered Modal-->
