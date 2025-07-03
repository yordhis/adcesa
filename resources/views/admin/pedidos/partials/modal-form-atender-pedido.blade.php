<!-- Vertically centered Modal -->
<button type="button" class="btn btn-outline-primary fw-bold mb-3" data-bs-toggle="modal"
    data-bs-target="#modalAtenderPedido{{ $pedido->id }}" 
    {{ $pedido->estatus == 'APROBADO' ?  'disabled' : ''}}
    {{ $pedido->estatus == 'EN PROCESO' ?  'disabled' : ''}}
    {{ $pedido->estatus == 'ENTREGADO' ?  'disabled' : ''}}
    {{ $pedido->estatus == 'RECHAZADO' ?  'disabled' : ''}}
    {{ $pedido->estatus == 'PAGO RECHAZADO' ?  'disabled' : ''}}
    {{ $pedido->estatus == 'PENDIENTE' ?  'disabled' : ''}}
    >
    Atender pedido
</button>

<div class="modal fade" id="modalAtenderPedido{{ $pedido->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Atender pedido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card ">
                    <div class="card-body">
                        <h5 class="card-title fs-2"><b>Código de pedido:</b> #<span
                                class="text-danger fs-2">{{ $pedido->codigo }}</span></h5>

                        <p class="card-text fs-4"> <b>Fecha de emisión del pedido:</b>
                            {{ \Carbon\Carbon::parse($pedido->created_at)->format('d-m-Y H:ia') }} </p>

                        <p class="card-text fs-4"> <b>Estatus del pedido:</b>
                            <button
                                class="fw-bold btn
                                 {{ $pedido->estatus == 'PENDIENTE' ? 'btn-danger' : '' }}    
                                 {{ $pedido->estatus == 'APROBADO' ? 'btn-success' : '' }}    
                                 {{ $pedido->estatus == 'PAGO VERIFICADO' ? 'btn-success' : '' }}    
                                 {{ $pedido->estatus == 'EN PROCESO' ? 'btn-warning' : '' }}    
                                 {{ $pedido->estatus == 'ENTREGADO' ? 'btn-primary' : '' }}    
                                 {{ $pedido->estatus == 'RECHAZADO' ? 'btn-secondary' : '' }}    
                            ">
                                {{ $pedido->estatus }}
                            </button>
                        </p>

                        <hr>

                        <p class="fs-3">Datos del pedido</p>
                        <div class="table-responsive">
                            <table class="table table-hover m5">
                                <thead>
                                    <tr>
                                        <td class="table-dark fw-bold">Cliente:</td>
                                        <td colspan="4"> {{ $pedido->nombres_cliente ?? 'SIN NOMBRE' }}
                                            {{ $pedido->apellidos_cliente ?? 'SIN APELLIDO' }} </td>
                                    </tr>
                                    <tr>
                                        <td class="table-dark fw-bold">Cédula o Rif:</td>
                                        <td> {{ $pedido->nacionalidad_cliente ?? '' }}-{{ $pedido->cedula_cliente ?? 'SIN CÉDULA' }}
                                        </td>
                                        <td class="table-dark fw-bold">Teléfono:</td>
                                        <td colspan="2">
                                            @if ($pedido->telefono_cliente)
                                                {{ preg_replace('/^(\d{4})(\d{3})(\d{4})$/', '($1)-$2-$3', $pedido->telefono_cliente) }}
                                            @else
                                                No asignado
                                            @endif
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="table-dark fw-bold">Email</td>
                                        <td colspan="4">{{ $pedido->email_cliente ?? 'SIN EMAIL' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-dark fw-bold">Dirección:</td>
                                        <td colspan="4">{{ $pedido->direccion_cliente ?? 'SIN DIRECCIÓN' }}</td>
                                    </tr>
                                    <tr class="table-dark">
                                        <th><strong>Producto:</strong></th>
                                        <th><strong>Cantidad:</strong></th>
                                        <th><strong>Precio:</strong></th>
                                        <th><strong>Adicional:</strong></th>
                                        <th><strong>Subtotal:</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pedido->carrito as $item)
                                        @php
                                            $precioAdicional = count($item->imagenes_adicionales)
                                                ? count($item->imagenes_adicionales) * 10
                                                : 0;
                                        @endphp
                                        <tr>
                                            <td> {{ $item->nombre_producto }}</td>
                                            <td class="text-end"> {{ $item->cantidad }}</td>
                                            <td class="text-end"> {{ $item->precio }}</td>
                                            <td class="text-end"> {{ number_format($precioAdicional, 2, ',', '.') }}$
                                            </td>
                                            <td class="text-end">
                                                {{ number_format($item->sub_total + $precioAdicional, 2, ',', '.') }}$
                                            </td>

                                        </tr>
                                        <tr>
                                            <td colspan="5">
                                                @if ($item['tipo_producto'])
                                                    <div class="accordion accordion-flush"
                                                        id="accordionFlushExample{{ $item['id_producto'] }}">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header border p-1">
                                                                <button class="accordion-button collapsed"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#flush-collapseOne{{ $item['id_producto'] }}"
                                                                    aria-expanded="false"
                                                                    aria-controls="flush-collapseOne{{ $item['id_producto'] }}">
                                                                    Detalles del pedido:
                                                                </button>
                                                            </h2>
                                                            <div id="flush-collapseOne{{ $item['id_producto'] }}"
                                                                class="accordion-collapse collapse"
                                                                data-bs-parent="#accordionFlushExample{{ $item['id_producto'] }}">
                                                                <div class="accordion-body p-3">
                                                                    <p class="card-text">
                                                                        <b>Imagen adicional:</b>
                                                                        {{ count($item['imagenes_adicionales']) }}
                                                                        <br>
                                                                        <b>Medida:</b>
                                                                        {{ $item['ancho_variante'] . 'x' . $item['alto_variante'] }}
                                                                        <b>Área:</b>
                                                                        {{ $item['ancho_variante'] * $item['alto_variante'] . ' ' . $item['medida_variante'] }}
                                                                        ^2 <br>
                                                                        @foreach ($item['mas_detalles'] as $key => $itemDetalles)
                                                                            @if (str_contains($key, 'color'))
                                                                                <b>{{ ucfirst(implode(' ', explode('_', $key))) }}:
                                                                                </b>
                                                                                <input type="color" class="m-1"
                                                                                    value="{{ $itemDetalles }}"
                                                                                    disabled> <br>
                                                                            @else
                                                                                <b>{{ ucfirst(implode(' ', explode('_', $key))) }}:
                                                                                </b>
                                                                                {{ $itemDetalles }} <br>
                                                                            @endif
                                                                        @endforeach
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                        @if ($item->tipo_producto)
                                            <tr>
                                                <td colspan="5" class="table-secondary text-center">
                                                    Insumos requeridos de {{ $item->nombre_producto }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Insumo</td>
                                                <td>Existencia real</td>
                                                <td>Requerir</td>
                                                <td colspan="2">Atender stock</td>
                                            </tr>
                                            <form action="{{ route('admin.pedidos.update', $pedido->id) }}"
                                                method="post" id="{{ $pedido->id }}">
                                                @csrf
                                                @method('PUT')
                                                @foreach ($item->insumos as $insumo)
                                                    <tr>
                                                        <td>{{ $insumo->nombre }}</td>
                                                        <td>{{ $insumo->stock . ' ' . $insumo->medida->simbolo }}</td>
                                                        <td>
                                                            {{-- el value = cantidad y el id = id_insumo --}}

                                                            <input type="number" value="0" step="any"
                                                                class="input-insumos" class="form-control"
                                                                name="{{ $insumo->id }}_cantidad"
                                                                id="{{ $pedido->id }}-{{ $insumo->id }}">
                                                        </td>
                                                        <td colspan="2">
                                                            <a class="btn btn-primary"
                                                                href="{{ route('admin.insumos.index') }}?filtro={{ $insumo->nombre }}">
                                                                Ir a insumos
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                        @endif
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5">
                                            <div class="d-flex justify-content-between">
                                                {{-- <form action="{{ route('admin.pedidos.update', $pedido->id) }}"
                                                    method="post" id="{{ $pedido->id }}">
                                                    @csrf --}}
                                                @method('PUT')
                                                <input type="hidden" name="estatus" value="APROBADO">
                                                <button type="submit" class="btn btn-outline-success m-3">Aprobar
                                                    pedido</button>
                                                </form>


                                                <form action="{{ route('admin.pedidos.update', $pedido->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="estatus" value="RECHAZADO">
                                                    <button type="submit" class="btn btn-outline-danger m-3">Rechazar
                                                        pedido</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>


                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->
