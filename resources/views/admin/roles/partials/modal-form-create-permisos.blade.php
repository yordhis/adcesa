<!-- Vertically centered Modal -->
<button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#modalRegistrarPermiso">
    <i class="bi bi-key-fill"></i> Crear permiso
</button>

<div class="modal fade" id="modalRegistrarPermiso" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Crear permiso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                <form action="{{ route('admin.permisos.store') }}" method="post" class="row g-3 needs-validation"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('post')

                    <div class="col-12">
                        <label for="nombre" class="form-label">Nombre del permiso</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                <i class="bi bi-key-fill"></i>
                            </span>
                            <input type="text" name="nombre" class="form-control" id="nombre"
                                placeholder="Ingrese nombres del permiso" value="{{ old('nombre') ?? '' }}" required>
                            <div class="invalid-feedback">Por favor, ingrese nombre del rol! </div>
                            @error('nombre')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">Guardar</button>
                    </div>

                </form>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->
