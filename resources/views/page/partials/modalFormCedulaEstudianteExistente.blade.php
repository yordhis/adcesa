<!-- Vertically centered Modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFormCedulaEstudianteExistente">
    <i class="bi bi-user"></i> Ya estoy registrado
</button>

<div class="modal fade" id="modalFormCedulaEstudianteExistente" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Estudiante</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form action="{{ route('page.preinscripcion.asignar.estudiante') }}" method="post"
                    class="row g-3 needs-validation">
                    @csrf
                    @method('post')
                    <div class="form-floating mb-3">
                        <input type="number" name="cedulaExistente" class="form-control" id="cedulaExistente"
                            placeholder="Ingres cédula o DNI" value="{{ old('cedulaExistente') }}">
                        <label for="floatingInput">Ingrese cédula o número de documento de identidad</label>
                    </div>
                    <div class="invalid-feedback">Por favor, ingrese un número de cédula valido! </div>
                    @error('nombre')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <button type="submit" class="btn btn-primary">Cargar mis datos</button>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->
