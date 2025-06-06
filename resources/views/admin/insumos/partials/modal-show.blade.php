<!-- Vertically centered Modal -->
<a type="button" class="mb-3" data-bs-toggle="modal" data-bs-target="#modalVer{{ $insumo->id }}">
    <i class="bi bi-eye fs-4"></i>
</a>

<div class="modal fade" id="modalVer{{ $insumo->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Datos del insumo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card align-items-center">
                    <img src="{{ asset( $insumo->imagen ) }}"
                        class="card-img-top w-100" alt="imagen-insumo">
                    <div class="card-body">
                        <h5 class="card-title fs-2">{{ $insumo->nombre }}</h5>
                        <p class="card-text"> <b>Código de barra:</b> {{ $insumo->codigo_barra == '' ? 'No tiene codigo' : $insumo->codigo_barra }} </p>
                        <p class="card-text"> <b>Costo:</b> {{ $insumo->costo }} </p>
                        <p class="card-text"> <b>Precio:</b> {{ $insumo->precio }} </p>
                        <p class="card-text"> <b>Cantidad:</b> {{ $insumo->cantidad }} </p>
                        <p class="card-text"> <b>Unidad:</b> {{ $insumo->unidad }} </p>
                        <p class="card-text"> <b>Medida:</b> {{ $insumo->medida }} </p>
                        <p class="card-text"> <b>Stock:</b> {{ $insumo->stock }} </p>
                        <p class="card-text"> <b>Categoria:</b> {{ $insumo->categoria }} </p>
                        <p class="card-text"> <b>Marca:</b> {{ $insumo->marca }} </p>
                        <p class="card-text"> <b>Almacen:</b> {{ $insumo->almacen }} </p>
                        <p class="card-text"> <b>Estatus:</b> {{ $insumo->estatus ? 'Activo' : 'Inactivo' }} </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->
