<!-- Vertically centered Modal -->
<a type="button" class="text-info" data-bs-toggle="modal" data-bs-target="#modalVerMasInfo{{ $nivel->id }}">
    <i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver más información del plan"></i>
</a>

<div class="modal fade" id="modalVerMasInfo{{ $nivel->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Información del nivel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">



                <!-- Card with an image on top -->
                <div class="card" bis_skin_checked="1">
                    <img src="{{ asset($nivel->imagen) }}" class="card-img-top" alt="...">
                    <div class="card-body" bis_skin_checked="1">
                        <h5 class="card-title fs-2">{{ $nivel->nombre }}</h5>
                        <p class="card-text">
                        <p>
                            <strong class="text-primary">Código:</strong>
                            {{ $nivel->codigo }}
                        </p>
                        <p>
                            <strong class="text-primary">Precio:</strong>
                            {{ $nivel->precio }} %
                        </p>
                        <p>
                            <strong class="text-primary">Libro:</strong>
                            {{ $nivel->libro }}
                        </p>
                        <p>
                            <strong class="text-primary">Duración:</strong>
                            {{ $nivel->duracion }} -
                            {{ $nivel->tipo_duracion }}
                        </p>
                        <p>
                            <strong class="text-primary">Tipo:</strong>
                            {{ $nivel->tipo_nivel }}
                        </p>
                        <p>
                            <strong class="text-primary">Estado:</strong>
                            {{ $nivel->estatus ? 'ACTIVO' : 'INACTIVO' }}
                        </p>
                        </p>
                    </div>
                </div><!-- End Card with an image on top -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->
