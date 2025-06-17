<!-- Vertically centered Modal -->
<a type="button" data-bs-toggle="modal" data-bs-target="#modalRegistrar{{$almacen->id}}">
    <i class="bi bi-pencil fs-3 text-warning"></i>
</a>

<div class="modal fade" id="modalRegistrar{{$almacen->id}}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Editar almacen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                <form action="{{ route('admin.almacenes.update', $almacen->id) }}" method="post" class="row g-3 needs-validation "
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <!-- Input Nombre -->
                    <div class="col-12">
                        <label for="nombre" class="form-label">Nombre de la almacen</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                <i class="bi bi-bookmarks"></i>
                            </span>
                            <input type="text" name="nombre" class="form-control" id="nombre"
                                placeholder="Ingrese almacen" value="{{ $almacen->nombre ?? old('nombre') }}" required>
                            <div class="invalid-feedback">Por favor, ingrese nombre de la almacen! </div>
                        </div>
                        @error('nombre')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
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
