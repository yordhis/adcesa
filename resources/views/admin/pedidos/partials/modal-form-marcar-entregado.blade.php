<!-- Vertically centered Modal -->
<button type="button" class="btn btn-outline-dark fw-bold mb-3" data-bs-toggle="modal"
    data-bs-target="#modalEntregar{{ $pedido->id }}"
    >
    Entregar
</button>


<div class="modal fade" id="modalEntregar{{ $pedido->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Entregar el pedido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-title">
                    <h5>Código de pedido: #{{$pedido->codigo}}</h5>
                    <p class="text-muted bg-light p-3 border rounded-5">
                        Este formulario es para estableser la fecha de entrega y estableser el pedido como entregado.
                    </p>
                </div>
                <form action="{{ route('admin.pedidos.marcar.como.entregado') }}" method="post">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="estatus" value="ENTREGADO">
                    <input type="hidden" name="id_pedido" value="{{ $pedido->id }}">

                    <div class="input-group m-2">
                        <span class="input-group-text" id="visible-addon">
                            <i class="bi bi-calendar-check"> Fecha de entrega </i>
                        </span>
                        <input name="fecha_entrega" type="date" class="form-control" value="{{ $pedido->fecha_entrega ?? ''}}" aria-label="fecha_entrega"
                            aria-describedby="visible-addon" required>
                    </div>

                    <button type="submit" class="btn btn-primary m-2">Entregar pedido</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->
