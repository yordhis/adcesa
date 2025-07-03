<!-- Vertically centered Modal -->

<button type="button" class="btn btn-outline-info fw-bold mb-3" data-bs-toggle="modal"
    data-bs-target="#modalVer{{ $pedido->id }}">
    Ver 
</button>

<div class="modal fade" id="modalVer{{ $pedido->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Datos del pedido</h5>
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
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" class="text-end fw-bold">Total a pagar REF:</td>
                                        <td class="text-end">{{ number_format($pedido->total_a_pagar, 2, ',', '.') }} $
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-end fw-bold">Tasa:</td>
                                        <td class="text-start ">{{ number_format($pedido->tasa, 2, ',', '.') }} Bs</td>
                                        <td class="text-end fw-bold">Total a pagar:</td>
                                        <td class="text-end">
                                            {{ number_format($pedido->total_a_pagar * $pedido->tasa, 2, ',', '.') }} Bs</td>
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
