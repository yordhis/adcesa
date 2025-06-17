<!-- Vertically centered Modal -->
<a type="button" class="" data-bs-toggle="modal" data-bs-target="#modal-edit-{{ $insumo->id }}">
    <i class="bi bi-pencil text-warning fs-4"></i>
</a>

<div class="modal fade" id="modal-edit-{{ $insumo->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Registrar insumo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                <p class="text-center text-info">
                    Llene todos los campos obligatorios señalados con un <b class="text-danger fs-6">(*)</b>
                </p>
                <form action="{{ route('admin.insumos.update', $insumo->id) }}" method="post"
                    class="row g-3 needs-validation" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Input Código de barra -->
                    <div class="col-12">
                        <label for="codigo-barra" class="form-label">Código de barra </label>
                        <div class="input-group has-validation">
                            <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                <i class="bi bi-upc"></i>
                            </span>
                            <input type="text" name="codigo_barra" class="form-control text-uppercase"
                                id="codigo_barra" placeholder="Ingrese codigo de barra"
                                value="{{ old('codigo_barra') ?? $insumo->codigo_barra }}">
                            <div class="invalid-feedback">Por favor, ingrese codigo de barra del insumo! </div>
                            @error('codigo_barra')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Input Nombre -->
                    <div class="col-12">
                        <label for="yourUsername" class="form-label">Nombre del insumo </label> <span
                            class="text-danger fs-4">*</span>
                        <div class="input-group has-validation">
                            <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                <i class="bi bi-box"></i>
                            </span>
                            <input type="text" name="nombre" class="form-control text-uppercase" id="nombre"
                                placeholder="Ingrese nombre del insumo" value="{{ old('nombre') ?? $insumo->nombre }}"
                                required>
                            <div class="invalid-feedback">Por favor, ingrese nombre del insumo! </div>
                        </div>
                        @error('nombre')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Costo -->
                    <div class="col-sm-4 col-xs-12">
                        <label for="costo" class="form-label">Costo </label> <span class="text-danger fs-4">*</span>
                        <input type="number" step="any" name="costo" class="form-control" id="costo"
                            placeholder="Ingrese costo" value="{{ old('costo') ?? $insumo->costo }}" required>
                        <div class="invalid-feedback">Por favor, Ingrese un costo valido!</div>
                        @error('costo')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Precio -->
                    <div class="col-sm-4 col-xs-12">
                        <label for="precio" class="form-label">Precio</label> <span class="text-danger fs-4">*</span>
                        <input type="number" step="any" name="precio" class="form-control" id="precio"
                            placeholder="Ingrese precio" value="{{ old('precio') ?? $insumo->precio }}" required>
                        <div class="invalid-feedback">Por favor, Ingrese un precio valido!</div>
                        @error('precio')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Cantidad -->
                    <div class="col-sm-4 col-xs-12">
                        <label for="cantidad" class="form-label">Cantidad</label><span class="text-danger fs-4">*</span>
                        <input type="number" step="any" name="cantidad" class="form-control cantidad-edit" id=""
                            placeholder="Ingrese cantidad" value="{{ old('cantidad') ?? $insumo->cantidad }}" required>
                        <div class="invalid-feedback">Por favor, Ingrese una cantidad valida!</div>
                        @error('cantidad')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Medida -->
                    <div class="col-sm-4 col-xs-12">
                        <label for="medida" class="form-label">Medidas</label><span class="text-danger fs-4">*</span>
                        <select class="form-select" name="id_medida" id="medida-edit" required>
                            <option selected disabled value="">Seleccione medida </option>
                            @foreach ($medidas as $medida)
                                @if (old('medida') == $medida['id'] || $insumo->medida == $medida['id'])
                                    <option value="{{ $medida['id'] }}" selected>{{ $medida['simbolo'] . ' - ' . $medida['nombre'] }}</option>
                                @endif
                                <option value="{{ $medida['id'] }}">{{ $medida['simbolo'] . ' - ' . $medida['nombre'] }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Por favor, seleccione una medida valida!.
                        </div>
                        @error('medida')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input unidad -->
                    <div class="col-sm-4 col-xs-12">
                        <label for="unidad" class="form-label">Unidad</label><span
                            class="text-danger fs-4">*</span>
                        <input type="number" step="any" name="unidad" class="form-control unidad-edit" id=""
                            placeholder="Ingrese unidad" value="{{ old('unidad') ?? $insumo->unidad }}" required>
                        <div class="invalid-feedback">Por favor, Ingrese una unidad valida!</div>
                        @error('unidad')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input stock -->
                    <div class="col-sm-4 col-xs-12">
                        <label for="stock" class="form-label">Existencia total</label><span
                            class="text-danger fs-4">*</span>
                        <input type="number" step="any" class="form-control stock-edit"
                            value="{{ $insumo->stock }}" readonly>
                        <input type="hidden" name="stock" value="{{ $insumo->stock }}" class="stock-edit">
                        @error('stock')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <!-- Input almacenes -->
                    <div class="col-12">
                        <label for="id_almacen" class="form-label">almacenes </label><span
                            class="text-danger fs-4">*</span>
                        <select class="form-select" name="id_almacen" id="id_almacen" required>
                            <option disabled value="">Seleccione almacen</option>
                            @foreach ($almacenes as $almacen)
                                @if (old('id_almacen') == $almacen['id'] || $insumo->id_almacen == $almacen['id'])
                                    <option value="{{ $almacen['id'] }}" selected>{{ $almacen['nombre'] }}</option>
                                @else
                                    <option value="{{ $almacen['id'] }}">{{ $almacen['nombre'] }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Por favor, seleccione una almacen valida!.
                        </div>
                        @error('id_almacen')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input marcas -->
                    <div class="col-12">
                        <label for="id_marca" class="form-label">Marcas</label><span
                            class="text-danger fs-4">*</span>
                        <select class="form-select" name="id_marca" id="id_marca" required>
                            <option selected disabled value="">Seleccione marca</option>
                            @foreach ($marcas as $marca)
                                @if (old('id_marca') == $marca->id || $insumo->id_marca == $marca->id)
                                    <option value="{{ $marca->id }}" selected>{{ $marca->nombre }}</option>
                                @endif
                                <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Por favor, seleccione una marca valida!.
                        </div>
                        @error('id_marca')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input categorias -->
                    <div class="col-12">
                        <label for="id_categoria" class="form-label">Categorias</label> <span
                            class="text-danger fs-4">*</span>
                        <select class="form-select" name="id_categoria" id="id_categoria" required>
                            <option selected disabled value="">Seleccione categoria</option>
                            @foreach ($categorias as $categoria)
                                @if (old('id_categoria') == $categoria->id || $insumo->id_categoria == $categoria->id)
                                    <option value="{{ $categoria->id }}" selected>{{ $categoria->nombre }}</option>
                                @endif
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Por favor, seleccione una categoria valida!.
                        </div>
                        @error('id_categoria')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input imagen -->
                    <div class="col-12">
                        <label for="file" class="form-label">Subir Foto</label>
                        <input type="file" name="file" class="form-control " id="file" accept="image/*">
                        @error('file')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <p>Imagen actual *</p>
                        <img src="{{ asset($insumo->imagen) }}" class="card-img-top w-100" alt="imagen-insumo">
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
