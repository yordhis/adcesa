<!-- Vertically centered Modal -->
<button type="button" class="btn btn-outline-warning fw-bold mb-3" data-bs-toggle="modal"
    data-bs-target="#modalVerificarPago{{ $pedido->id }}">
    Verificar pago
</button>

<div class="modal fade" id="modalVerificarPago{{ $pedido->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Datos de pago</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card ">
                    <div class="card-body">
                        <h5 class="card-title fs-2"><b>Código de pedido:</b> #<span
                                class="text-danger fs-2">{{ $pedido->codigo }}</span></h5>

                        <p class="card-text fs-4"> <b>Fecha del pago:</b>
                            {{ \Carbon\Carbon::parse($pedido->pago->fecha)->format('d-m-Y') }} </p>

                        <p class="card-text fs-4"> <b>Estatus del pago:</b>
                            <button
                                class="fw-bold btn
                                 {{ $pedido->pago->estatus == 0 ? 'btn-danger' : '' }}    
                                 {{ $pedido->pago->estatus == 1 ? 'btn-success' : '' }}    
                                 {{ $pedido->pago->estatus == 2 ? 'btn-danger' : '' }}    
                            ">
                                {{ $pedido->pago->estatus == 0 ? 'POR VERIFICAR' : '' }}
                                {{ $pedido->pago->estatus == 1 ? 'PAGO VERIFICADO' : '' }}
                                {{ $pedido->pago->estatus == 2 ? 'PAGO RECHAZADO' : '' }}
                            </button>
                        </p>

                        <hr>

                        <p class="fs-3">Pago</p>
                        <div class="table-responsive">
                            <table class="table table-hover m5">
                                <thead>
                                    <tr>
                                        <td class="table-dark fw-bold">Método de pago:</td>
                                        <td colspan="4"> {{ $pedido->pago->metodo_pago ?? 'No asignado' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="table-dark fw-bold">Banco receptor:</td>
                                        <td colspan="4"> ({{ $pedido->pago->codigo_cuenta ?? 'No asignado' }})
                                            {{ $pedido->pago->nombre_cuenta ?? 'No asignado' }} </td>
                                    </tr>
                                    <tr>
                                        <td class="table-dark fw-bold">Titular receptor:</td>
                                        <td colspan="4"> {{ $pedido->pago->titular_cuenta ?? 'No asignado' }} </td>
                                    </tr>
                                    <tr>
                                        <td class="table-dark fw-bold">Cédula o RIF receptor:</td>
                                        <td colspan="4">
                                            {{ $pedido->pago->cuenta->nacionalidad ?? 'SIN nacionalidad' }}-
                                            {{ $pedido->pago->cedula_titular ?? 'SIN CÉDULA' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="table-dark fw-bold">Teléfono receptor:</td>
                                        <td colspan="4">
                                            @if ($pedido->pago->telefono_cuenta)
                                                {{ preg_replace('/^(\d{4})(\d{3})(\d{4})$/', '($1)-$2-$3', $pedido->pago->telefono_cuenta) }}
                                            @else
                                                No asignado
                                            @endif
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="table-dark fw-bold">Número de cuenta receptor</td>
                                        <td colspan="4">
                                            {{ $pedido->pago->cuenta->TIPO_CUENTA ?? '' }}
                                            {{ $pedido->pago->numero_cuenta ?? 'SIN NUMERO DE CUENTA' }}
                                        </td>
                                    </tr>

                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="table-dark fw-bold">Tasa del día</td>
                                        <td colspan="4">
                                            {{ number_format(107, 2,',','.') }} Bs
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="table-dark fw-bold">Monto cancelado</td>
                                        <td colspan="2">
                                            {{ number_format($pedido->pago->monto, 2,',','.') }} $
                                        </td>
                                        <td colspan="2">
                                            {{ number_format($pedido->pago->monto * 107, 2,',','.') }} Bs
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="table-dark fw-bold">Comprobante</td>
                                        <td colspan="4">
                                            <img src="{{ asset($pedido->pago->comprobante) }}" class="img w-100" alt="comprobante">
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5">
                                            <div class="d-flex justify-content-between">
                                                <form action="{{ route('admin.pagos.update', $pedido->pago->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="estatus" value="1">
                                                    <button type="submit" class="btn btn-outline-success m-3" >Aprobar pago</button>
                                                </form>
    
                                                <form action="{{ route('admin.pagos.update', $pedido->pago->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="estatus" value="0">
                                                    <button type="submit" class="btn btn-outline-secondary m-3" >Dejar como pendiente</button>
                                                </form>

                                                <form action="{{ route('admin.pagos.update', $pedido->pago->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="estatus" value="2">
                                                    <button type="submit" class="btn btn-outline-danger m-3" >Rechazar pago</button>
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
