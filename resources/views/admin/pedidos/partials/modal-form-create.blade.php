<!-- Vertically centered Modal -->
<button type="button" class="btn btn-success " data-bs-toggle="modal" data-bs-target="#modalRegistrarPedidos">
    <i class="bi bi-cart-check-fill"></i> Crear pedido
</button>

<div class="modal fade" id="modalRegistrarPedidos" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Registrar pedido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                <p class="text-center text-info">
                    Llene todos los campos obligatorios señalados con un <b class="text-danger fs-6">(*)</b>
                </p>
                <form action="{{ route('admin.pedidos.store') }}" method="post" class="row g-3 needs-validation"
                    enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    <!-- Input Nombres -->
                    <div class="col-4">
                        <label for="yourUsername" class="form-label">Buscar y cargar cliente al pedido </label> <span
                            class="text-danger fs-4">*</span>
                        <div class="input-group has-validation">
                            <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" name="nombres_cliente" class="form-control text-uppercase" id="nombre"
                                placeholder="Buscar cliente por: nombre, email o cédula" value="{{ old('nombres_cliente') }}" required>
                            <div class="invalid-feedback">Por favor, ingrese nombre del pedido! </div>
                        </div>
                        @error('nombres_cliente')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Apellidos -->
                    <div class="col-6">
                        <label for="yourUsername" class="form-label">Seleccione servicio </label> <span
                            class="text-danger fs-4">*</span>
                        <div class="input-group has-validation">
                            <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                <i class="bi bi-box"></i>
                            </span>
                            <input type="text" name="apellidos_cliente" class="form-control text-uppercase" id="apellidos"
                                placeholder="Ingrese apellidos del cliente" value="{{ old('apellidos_cliente') }}" required>
                            <div class="invalid-feedback">Por favor, ingrese apellidos del cliente! </div>
                        </div>
                        @error('apellidos_cliente')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Input Cedula -->
                    <div class="col-12">
                        <label for="yourUsername" class="form-label">Cédula del cliente </label> <span
                            class="text-danger fs-4">*</span>
                        <div class="input-group has-validation">
                            <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                <i class="bi bi-box"></i>
                            </span>
                            <input type="text" name="cedula_cliente" class="form-control text-uppercase" id="cedula"
                                placeholder="Ingrese cédula del cliente" value="{{ old('cedula_cliente') }}" required>
                            <div class="invalid-feedback">Por favor, ingrese cédula del cliente! </div>
                        </div>
                        @error('cedula_cliente')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Total a pagar -->
                    <div class="col-sm-4 col-xs-12">
                        <label for="total_a_pagar" class="form-label">Total a pagar</label> <span class="text-danger fs-4">*</span>
                        <input type="number" step="any" name="total_a_pagar" class="form-control" id="total_a_pagar"
                            placeholder="Ingrese total a pagar" value="{{ old('total_a_pagar') ?? '' }}" required>
                        <div class="invalid-feedback">Por favor, Ingrese un total valido!</div>
                        @error('total_a_pagar')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

        
                    <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">Registrar pedido</button>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->
