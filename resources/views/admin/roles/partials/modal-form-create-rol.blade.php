<!-- Vertically centered Modal -->
<button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#modalRegistrarRol">
    <i class="bi bi-person-rolodex"></i> Crear rol
</button>

<div class="modal fade" id="modalRegistrarRol" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Crear rol</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                <form action="{{ route('admin.roles.store') }}" method="post" class="row g-3 needs-validation"
                    enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    <div class="col-12">
                        <label for="nombre" class="form-label">Nombre del rol</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                <i class="bi bi-people"></i>
                            </span>
                            <input type="text" name="nombre" class="form-control" id="nombre"
                                placeholder="Ingrese nombre del rol" value="{{ old('nombre') ?? '' }}" required>
                            <div class="invalid-feedback">Por favor, ingrese nombre del rol! </div>
                        </div>
                        @error('nombre')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <hr>
                    <div class="col-12" >
                        <p class="text-dark fs-3">Asigne Permisos:</p>
                        <div class="">
                            @foreach ($permisos as $permiso)
                                <div class="form-check form-switch m-2">
                                    <input class="form-check-input check_permisos" name="per_{{ $permiso->nombre }}"
                                        value="{{ $permiso->id }}" type="checkbox" id="{{ $permiso->id }}">
                                    <label class="form-check-label"
                                        for="{{ $permiso->id }}">{{ $permiso->nombre }}</label>
                                </div>
                            @endforeach
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
