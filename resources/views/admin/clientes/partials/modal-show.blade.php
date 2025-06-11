<!-- Vertically centered Modal -->
<a type="button" class="mb-3" data-bs-toggle="modal" data-bs-target="#modalVer{{ $cliente->id }}">
    <i class="bi bi-eye"></i>
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
                        <p class="card-text"> <b>Cédula:</b> {{ $cliente->nacionalidad . '-' . number_format($cliente->cedula, 0, '', '.') }} </p>
                        <p class="card-text"> <b>Sexo:</b> {{ $cliente->sexo }} </p>
                        <p class="card-text"> <b>Fecha de nacimiento:</b>
                            {{ $cliente->fecha_nacimiento ? \Carbon\Carbon::parse($cliente->fecha_nacimiento)->format('d-m-Y') : 'No asignado' }}
                        </p>
                        <p class="card-text"> <b>Edad:</b>
                            <span>{{ \Carbon\Carbon::parse($cliente->fecha_nacimiento)->age }}</span> Años</p>
                        <p class="card-text"> <b>Teléfono:</b>
                            @if ($cliente->telefono)
                                {{ preg_replace('/^(\d{4})(\d{3})(\d{4})$/', '($1)-$2-$3', $cliente->telefono) }}
                            @else
                                No asignado
                            @endif
                        </p>
                        <p class="card-text"> <b>Correo:</b> {{ $cliente->email ? $cliente->email : 'No asignado' }}
                        </p>
                        <p class="card-text"> <b>Dirección:</b>
                            {{ $cliente->direccion ? $cliente->direccion : 'No asignado' }} </p>
                        <p class="card-text"> <b>País:</b> {{ $cliente->pais ? $cliente->pais : 'No asignado' }} </p>
                        <p class="card-text"> <b>Estado:</b> {{ $cliente->estado ? $cliente->estado : 'No asignado' }}
                        </p>
                        <p class="card-text"> <b>Ciudad:</b> {{ $cliente->ciudad ? $cliente->ciudad : 'No asignado' }}
                        </p>
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
