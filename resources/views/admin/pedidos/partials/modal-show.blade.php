<!-- Vertically centered Modal -->
<a type="button" class="mb-3" data-bs-toggle="modal" data-bs-target="#modalVer{{ $producto->id }}">
    <i class="bi bi-eye fs-4"></i>
</a>

<div class="modal fade" id="modalVer{{ $producto->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Datos del producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card align-items-center">
                    <img src="{{ asset( $producto->imagen  ?? 'assets/img/producto.png' ) }}"
                        class="card-img-top w-100" alt="imagen-producto">
                    <div class="card-body">
                        <h5 class="card-title fs-2">{{ $producto->nombre }}</h5>
                        <p class="card-text"> <b>Código de barra:</b> {{ $producto->codigo_barra == '' ? 'CÓDIGO NO ASIGNADO' : $producto->codigo_barra }} </p>
                        <p class="card-text"> <b>Costo:</b> {{ $producto->costo ?? 0 }} </p>
                        <p class="card-text"> <b>Precio:</b> {{ $producto->precio ?? 0 }} </p>
                        <p class="card-text"> <b>Cantidad:</b> {{ $producto->cantidad ?? 0 }} </p>
                        <p class="card-text"> <b>Medida/Unidad:</b> {{ $producto->unidad ?? 'SIN UNIDAD' }} </p>
                        <p class="card-text"> <b>Stock:</b> {{ $producto->stock ?? 0 }} </p>
                        <p class="card-text"> <b>Categoria:</b> {{ $producto->categoria ?? 'SIN CATEGORÍA' }} </p>
                        <p class="card-text"> <b>Marca:</b> {{ $producto->marca ?? 'SIN MARCA' }} </p>
                        <p class="card-text"> <b>Almacen:</b> {{ $producto->almacen ?? 'SIN ALMACÉN' }} </p>
                        <p class="card-text"> <b>Estatus:</b> {{ $producto->estatus == 'ACTIVO' ? 'ACTIVO' : 'INACTIVO' }} </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->
