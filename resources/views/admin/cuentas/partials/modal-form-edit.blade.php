<!-- Vertically centered Modal -->
<a type="button" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $cuenta->id }}">
    <i class="bi bi-pencil fs-3 text-warning"></i>
</a>

<div class="modal fade" id="modalEdit{{ $cuenta->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Editar cuenta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                <form action="{{ route('admin.cuentas.update', $cuenta->id) }}" method="post"
                    class="row g-3 needs-validation " enctype="multipart/form-data">
                    @csrf
                    @method('put')


                    <!-- Input Método -->
                    <div class="col-12">
                        <label for="metodo" class="form-label">Método</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                <i class="bi bi-fonts"></i>
                            </span>
                            <input type="text" name="metodo" class="form-control" id="metodo"
                                placeholder="Ingrese nombre del metodo de pago"
                                value="{{ old('metodo') ?? $cuenta->metodo }}" required>
                            <div class="invalid-feedback">Por favor, ingrese método de la cuenta! </div>
                        </div>
                        @error('metodo')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Codigo del banco -->
                    <div class="col-12">
                        <label for="codigo_banco" class="form-label">Código del banco</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                <i class="bi bi-bank"></i>
                            </span>
                            <input type="text" name="codigo_banco" class="form-control" id="codigo_banco"
                                min="4" max="4" placeholder="Ingrese código del banco, Ejem: 0102"
                                value="{{ old('codigo_banco') ?? $cuenta->codigo_banco }}" required>
                        </div>
                        @error('codigo_banco')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Nombre del banco -->
                    <div class="col-12">
                        <label for="nombre_banco" class="form-label">Nombre del banco</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                               <i class="bi bi-bank"></i>
                            </span>
                            <input type="text" name="nombre_banco" class="form-control" id="nombre_banco"
                                placeholder="Ingrese nombre del banco" value="{{ old('nombre_banco') ?? $cuenta->nombre_banco }}" required>
                            <div class="invalid-feedback">Por favor, ingrese nombre_banco de la cuenta! </div>
                        </div>
                        @error('nombre_banco')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Titular -->
                    <div class="col-12">
                        <label for="titular" class="form-label">Nombre del titular de la cuenta</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                <i class="bi bi-people"></i>
                            </span>
                            <input type="text" name="titular" class="form-control" id="titular"
                                placeholder="Ingrese nombre del titular" value="{{ old('titular') ?? $cuenta->titular }}" required>
                            <div class="invalid-feedback">Por favor, ingrese titular de la cuenta! </div>
                        </div>
                        @error('titular')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Tipo cuenta -->
                    <div class="col-12">
                        <label for="tipo_cuenta" class="form-label">Tipo de cuenta</label>
                        <div class="input-group has-validation">
                            <select class="form-select form-select-lg mb-3" name="tipo_cuenta"
                                aria-label="Large select example">
                                <option disabled selected>Seleccione tipo de cuenta</option>
                                <option value="CORRIENTE" {{ (old('tipo_cuenta') == 'CORRIENTE' | $cuenta->nombre_banco == 'CORRIENTE') ? 'selected' : '' }}>
                                    CORRIENTE</option>
                                <option value="AHORRO" {{ (old('tipo_cuenta') == 'AHORRO' | $cuenta->nombre_banco == 'AHORRO') ? 'selected' : '' }}>AHORRO
                                </option>
                            </select>
                        </div>
                        @error('tipo_cuenta')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input N° cuenta -->
                    <div class="col-12">
                        <label for="numero_cuenta" class="form-label">Número de cuenta</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                <i class="bi bi-hash"></i>
                            </span>
                            <input type="text" name="numero_cuenta" class="form-control" id="numero_cuenta"
                                placeholder="Ingrese número de cuenta" value="{{ old('numero_cuenta') ?? $cuenta->numero_cuenta }}">
                            <div class="invalid-feedback">Por favor, ingrese numero cuenta de la cuenta! </div>
                        </div>
                        @error('numero_cuenta')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Télefono -->
                    <div class="col-12">
                        <label for="telefono" class="form-label">Número de télefono</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                <i class="bi bi-phone"></i>
                            </span>
                            <input type="text" name="telefono" class="form-control" id="telefono"
                                placeholder="Ingrese número de cuenta" value="{{ old('telefono') ?? $cuenta->telefono }}">
                            <div class="invalid-feedback">Por favor, ingrese numero cuenta de la cuenta! </div>
                        </div>
                        @error('telefono')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">Guardar</button>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->
