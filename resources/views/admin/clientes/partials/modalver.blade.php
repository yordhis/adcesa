<!-- Vertically centered Modal -->
<a type="button" class="mb-3" data-bs-toggle="modal" data-bs-target="#modalVer{{ $cliente->id }}">
    <i class="bi bi-eye "></i>
</a>

<div class="modal fade" id="modalVer{{ $cliente->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Datos del cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card align-items-center">
                    <img src="{{ asset($cliente->sexo === 'M' ? '/assets/img/avatar-m.png' : '/assets/img/avatar-f.png') }}"
                        class="card-img-top w-25" alt="foto">
                    <div class="card-body">
                        <h5 class="card-title fs-2">{{ $cliente->nombres }} {{ $cliente->apellidos }}</h5>
                        <p class="card-text"> <b>Cédula:</b> {{ $cliente->nacionalidad . '-' . $cliente->cedula }} </p>
                        <p class="card-text"> <b>Sexo:</b> {{ $cliente->sexo }} </p>
                        <p class="card-text"> <b>Teléfono:</b> {{ $cliente->telefono }} </p>
                        <p class="card-text"> <b>Correo:</b> {{ $cliente->email }} </p>
                        <p class="card-text"> <b>Dirección:</b> {{ $cliente->direccion }} </p>
                        <p class="card-text"> <b>País:</b> {{ $cliente->pais }} </p>
                        <p class="card-text"> <b>Estado:</b> {{ $cliente->estado }} </p>
                        <p class="card-text"> <b>Ciudad:</b> {{ $cliente->ciudad }} </p>
                        <p class="card-text"> <b>Estatus:</b> {{ $cliente->estatus ? 'Activo' : 'Inactivo' }} </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->
