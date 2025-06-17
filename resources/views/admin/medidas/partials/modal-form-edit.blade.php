<!-- Vertically centered Modal -->
<a type="button" data-bs-toggle="modal" data-bs-target="#modalRegistrar{{$medida->id}}">
    <i class="bi bi-pencil fs-3 text-warning"></i>
</a>

<div class="modal fade" id="modalRegistrar{{$medida->id}}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Editar medida</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                <form action="{{ route('admin.medidas.update', $medida->id) }}" method="post" class="row g-3 needs-validation "
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <!-- Input Nombre -->
                    <div class="col-12">
                        <label for="nombre" class="form-label">Nombre de la medida</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                <i class="bi bi-rulers"></i>
                            </span>
                            <input type="text" name="nombre" class="form-control" id="nombre"
                                placeholder="Ingrese medida" value="{{ $medida->nombre ?? old('nombre') }}" required>
                            <div class="invalid-feedback">Por favor, ingrese nombre de la medida! </div>
                        </div>
                        @error('nombre')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Input Simbolo -->
                    <div class="col-12">
                        <label for="simbolo" class="form-label">Símbolo de la medida</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                <i class="bi bi-unity"></i>
                            </span>
                            <input type="text" name="simbolo" class="form-control" id="simbolo"
                                placeholder="Ingrese símbolo" value="{{ $medida->simbolo ?? old('simbolo') }}" required>
                            <div class="invalid-feedback">Por favor, ingrese símbolo de la medida! </div>
                        </div>
                        @error('simbolo')
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
