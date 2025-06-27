<div class="col-sm-6 col-xs-12">
    <div class="card" >
        <div class="card-header bg-primary p-0 m-0">
            <p class="card-title fs-3 text-center text-white">Carrito de compra</p>
        </div>
        <div class="card-body" style="max-height: 400px; overflow-y: auto;">
            @php
                $totalPagar = 0;
            @endphp
            @foreach (session('carrito') as $producto)
                @php
                    $totalPagar = $totalPagar + $producto['subtotal'];
                @endphp

                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset($producto['imagen']) }}" height="90" class="img-fluid rounded-start"
                                alt="{{ $producto['nombre_producto'] }}">
                        </div>
                        <div class="col-md-8" >
                            <div class="card-body" >
                                <h5 class="card-title">{{ $producto['nombre_producto'] }}</h5>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card-footer d-flex justify-content-between">
                                <p class="card-text">Precio Unitario: {{ $producto['precio'] }}</p>
                                <p class="card-text">Cantidad: {{ $producto['cantidad'] }}</p>
                                <p class="card-text">Subtotal: {{ $producto['subtotal'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="card-footer bg-light">
            <!-- total a pagar -->
            <div class="text-center m-2 fs-5 text-success">
                <p>Total a pagar: {{ $totalPagar }} $</p>
            </div>
        </div>
    </div>
</div>
