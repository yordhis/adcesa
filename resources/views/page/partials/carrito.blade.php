<div class="col-sm-6 col-xs-12">
    <div class="card">
        <div class="card-header bg-primary p-0 m-0">
            <p class="card-title fs-3 text-center text-white">Carrito de compra</p>
        </div>
        <div class="card-body" style="max-height: 400px; overflow-y: auto;">
            @php
                $totalPagar = 0;
                $totalAdicional = 0;
            @endphp
            @if (count(session('carrito')))
                @foreach (session('carrito') as $producto)
                    @php
                        $totalPagar = $totalPagar + $producto['subtotal'];
                        $totalAdicional = $totalAdicional + $producto['precio_adicional'];
                    @endphp

                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ asset($producto['imagen']) }}" height="90"
                                    class="img-fluid rounded-start" alt="{{ $producto['nombre_producto'] }}">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="sticky-top text-end">
                                        <form action="{{ route('page.remover.producto.carrito')}}" method="post">
                                            @csrf
                                            @method('POST')
                                            <input type="hidden" name="id_producto"
                                                value="{{ $producto['id_producto'] }}">
                                            <button type="submit" class="btn btn-none" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                data-bs-title="Eliminar producto del carrito de compra">
                                                <i class="bi bi-trash text-danger fs-5"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <h5 class="card-title">{{ $producto['nombre_producto'] }}</h5>

                                    @if ($producto['tipo_producto'])
                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header border p-1">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseOne{{$producto['id_producto']}}"
                                                        aria-expanded="false" aria-controls="flush-collapseOne{{$producto['id_producto']}}">
                                                        Detalles del pedido:
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseOne{{$producto['id_producto']}}" class="accordion-collapse collapse"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                                        <p class="card-text">
                                                            <b>Imagen adicional:</b>
                                                            {{ count($producto['imagenes_adicionales']) }} <br>
                                                            <b>Medida:</b>
                                                            {{ $producto['ancho_variante'] . 'x' . $producto['alto_variante'] }}
                                                            <b>Área:</b>
                                                            {{ $producto['ancho_variante'] * $producto['alto_variante'] . ' ' . $producto['medida_variante'] }}
                                                            ^2 <br>
                                                            @foreach ($producto['mas_detalles'] as $key => $item)
                                                                @if (str_contains($key, 'color'))
                                                                    <b>{{ ucfirst(implode(' ', explode('_', $key))) }}:
                                                                    </b>
                                                                    <input type="color" class="m-1"
                                                                        value="{{ $item }}" disabled> <br>
                                                                @else
                                                                    <b>{{ ucfirst(implode(' ', explode('_', $key))) }}:
                                                                    </b>
                                                                    {{ $item }} <br>
                                                                @endif
                                                            @endforeach
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card-footer d-flex justify-content-between">
                                    <p class="card-text">Precio C/U: {{ $producto['precio'] }} $</p>
                                    <p class="card-text text-danger">Adicional: {{ $producto['precio_adicional'] ?? 0 }}
                                        $</p>
                                    <p class="card-text">Cantidad: {{ $producto['cantidad'] }}</p>
                                    <p class="card-text">Subtotal:
                                        {{ $producto['subtotal'] + $producto['precio_adicional'] }} $</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="card-footer bg-light">
            <!-- total a pagar -->
            <div class="text-center m-2 fs-5 text-success">
                <p>Total a pagar: {{ $totalPagar + $totalAdicional }} $</p>
            </div>
        </div>
    </div>
</div>
