<!-- Vertically centered Modal -->
<a type="button" class="mb-3" data-bs-toggle="modal" data-bs-target="#modalVer{{ $rol->id }}">
    <i class="bi bi-pencil fs-3 text-warning"></i>
</a>

<div class="modal fade" id="modalVer{{ $rol->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Datos del rol</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card align-items-center">
                    <div class="card-body">
                        <h5 class="card-title fs-2">{{ $rol->nombre }}</h5>
                        <hr>
                        <form action="{{ route('admin.roles.update', $rol->id) }}" method="post"
                            class="row g-3 needs-validation" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-12">
                                @if ($rol->nombre != 'CLIENTE')
                                    <label for="nombre" class="form-label">Cambiar nombre</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                            <i class="bi bi-person-rolodex"></i>
                                        </span>
                                        <input type="text" name="nombre" class="form-control" id="nombre"
                                            placeholder="Ingrese nombre del rol"
                                            value="{{ old('nombre') ?? $rol->nombre }}" required>
                                        <div class="invalid-feedback">Por favor, ingrese nombre del rol! </div>
                                    </div>
                                    @error('nombre')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                            <p class="text-dark fs-3">Permisos:</p>
                            <div class="col-sm-6 col-xs-12">
                                <div class="">
                                    @foreach ($permisos as $permiso)
                                        @foreach ($rol->permisos as $rolPermiso)
                                            @if ($permiso->id == $rolPermiso->id_permiso)
                                                <div class="form-check form-switch m-2">
                                                    <input class="form-check-input check_permisos"
                                                        name="per_{{ $permiso->nombre }}" value="{{ $permiso->id }}"
                                                        type="checkbox" id="{{ $permiso->id }}" checked>
                                                    <label class="form-check-label"
                                                        for="{{ $permiso->id }}">{{ $permiso->nombre }}</label>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                @foreach ($permisos as $permiso)
                                    @php
                                        $asignado = $rol->permisos->contains('id_permiso', $permiso->id);
                                    @endphp
                                    @if (!$asignado)
                                        <div class="form-check form-switch m-2">
                                            <input class="form-check-input check_permisos"
                                                name="per_{{ $permiso->nombre }}" value="{{ $permiso->id }}"
                                                type="checkbox" id="{{ $permiso->id }}">
                                            <label class="form-check-label"
                                                for="{{ $permiso->id }}">{{ $permiso->nombre }}</label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit">Guardar</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->
