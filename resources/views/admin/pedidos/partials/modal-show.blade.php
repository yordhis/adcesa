<!-- Vertically centered Modal -->
<a type="button" class="mb-3" data-bs-toggle="modal" data-bs-target="#modalVer{{ $pedido->id }}">
    <i class="bi bi-eye fs-4"></i>
</a>

<div class="modal fade" id="modalVer{{ $pedido->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Datos del pedido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card align-items-center">
                    <div class="card-body">
                        <h5 class="card-title fs-2"><b>Código:</b> {{ $pedido->codigo }}</h5>
                        <p class="card-text"> <b>Total a pagar:</b> {{ $pedido->total_a_pagar ?? 0 }} </p>
                        <p class="card-text"> <b>Fecha de emisión del pedido:</b> {{ $pedido->fecha_inicio ?? 0 }} </p>
                        <hr>
                        <p>Datos del cliente</p>
                        <p class="card-text"> <b>Nombres:</b> {{ $pedido->nombres_cliente ?? 'SIN NOMBRE' }} </p>
                        <p class="card-text"> <b>Apellidos:</b> {{ $pedido->apellidos_cliente ?? 'SIN APELLIDO' }} </p>
                        <p class="card-text"> <b>Cédula:</b> {{ $pedido->nacionalidad_cliente ?? '' }}  {{ $pedido->cedula_cliente ?? 'SIN CÉDULA' }} </p>
                        <p class="card-text"> <b>Teléfono:</b> {{ $pedido->telefono_cliente ?? 'SIN TELÉFONO' }} </p>
                        <p class="card-text"> <b>Email:</b> {{ $pedido->email_cliente ?? 'SIN EMAIL' }} </p>
                        <p class="card-text"> <b>Dirección:</b> {{ $pedido->direccion_cliente ?? 'SIN DIRECCIÓN' }} </p>
                        <p class="card-text"> <b>Estatus:</b> {{ $pedido->estatus }} </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->
