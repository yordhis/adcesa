<!-- Vertically centered Modal -->
<a type="button" class="mb-3" data-bs-toggle="modal" data-bs-target="#modalVer{{ $rol->id }}">
    <i class="bi bi-pencil fs-3 text-dark"></i>
</a>

<div class="modal fade" id="modalVer{{ $rol->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
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
                        <p class="text-dark fs-4">Permisos: </p>

                        @foreach ($rol->permisos as $permiso)
                            <div class="form-check form-switch">
                                <input class="form-check-input check_permisos" type="checkbox" id="{{ $permiso->id }}" {{ $permiso->estatus_rp ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ $permiso->id }}">{{ $permiso->permiso }}</label>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->
