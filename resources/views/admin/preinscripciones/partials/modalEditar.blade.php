<!-- Vertically centered Modal -->
<a type="button" class="text-warning" data-bs-toggle="modal" data-bs-target="#verticalycentered{{ $preinscripcion->id }}">
    <i class="bi bi-pencil fs-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Asignar nota"></i>
</a>

<div class="modal fade" id="verticalycentered{{ $preinscripcion->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Actualizar datos de Pre-inscripción</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
                <div class="modal-body">

                    <form action=" {{ route('admin.preinscripciones.update', $preinscripcion->id) }}" method="post"
                        class="row g-3 needs-validation" novalidate>
                        @csrf
                        @method('put')
                        
                        {{-- Selector de NIVEL --}}
                        <div class="col-md-12">
                            <label for="nivel" class="form-label">Nivel</label>
                            <select class="form-select" name="codigo_nivel" id="nivel" required>
                                <option selected disabled>Seleccione un nivel</option>
                                @foreach ($niveles as $nivel)
                                    <option value="{{ $nivel->codigo }}"
                                        {{ $nivel->codigo == $preinscripcion->nivel->codigo ? 'selected' : '' }}>
                                        {{ $nivel->nombre }}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                Por favor, seleccione un nivel.
                            </div>
                        </div>

                        {{-- Selector de PLAN --}}
                        <div class="col-md-12">
                            <label for="plan" class="form-label">Plan de pago</label>
                            <select class="form-select" name="codigo_plan" id="plan" required>
                                <option selected disabled>Seleccione un plan</option>
                                @foreach ($planes as $plan)
                                    <option value="{{ $plan->codigo }}"
                                        {{ $plan->codigo == $preinscripcion->plan->codigo ? 'selected' : '' }}>
                                        {{ $plan->nombre }}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                Por favor, seleccione un plan.
                            </div>
                        </div>
                       
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>


                </div>
                <div class="modal-footer">
                    <small class="text-danger"></small>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    
                </div>
            </form>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->
