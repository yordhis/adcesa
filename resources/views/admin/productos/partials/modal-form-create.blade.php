<!-- Vertically centered Modal -->
<button type="button" class="btn btn-success " data-bs-toggle="modal" data-bs-target="#modalRegistrarproducto">
    <i class="bi bi-box-fill"></i> Crear producto
</button>

<div class="modal fade" id="modalRegistrarproducto" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Registrar producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                <p class="text-center text-info">
                    Llene todos los campos obligatorios señalados con un <b class="text-danger fs-6">(*)</b>
                </p>
                <form action="{{ route('admin.productos.store') }}" method="post" class="row g-3 needs-validation"
                    enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    <!-- Input Tipo de producto -->
                    <div class="col-12">
                        <label for="tipo_producto" class="form-label">Tipo de producto</label><span
                            class="text-danger fs-4">*</span>
                        <select class="form-select" name="tipo_producto" id="tipo_producto" required>
                            <option selected disabled value="">Seleccione el tipo</option>
                            <option value="1">Compuesto</option>
                            <option value="0">No Compuesto</option>
                        </select>
                        <div class="invalid-feedback">
                            Por favor, seleccione una almacen valida!.
                        </div>
                        @error('tipo_producto')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Código de barra -->
                    <div class="col-12">
                        <label for="codigo-barra" class="form-label">Código de barra </label>
                        <div class="input-group has-validation">
                            <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                <i class="bi bi-upc"></i>
                            </span>
                            <input type="text" name="codigo_barra" class="form-control text-uppercase"
                                id="codigo_barra" placeholder="Ingrese codigo de barra"
                                value="{{ old('codigo_barra') ?? '' }}">
                            <div class="invalid-feedback">Por favor, ingrese codigo de barra del producto! </div>
                            @error('codigo_barra')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Input Nombre -->
                    <div class="col-12">
                        <label for="yourUsername" class="form-label">Nombre del producto </label> <span
                            class="text-danger fs-4">*</span>
                        <div class="input-group has-validation">
                            <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                <i class="bi bi-box"></i>
                            </span>
                            <input type="text" name="nombre" class="form-control text-uppercase" id="nombre"
                                placeholder="Ingrese nombre del producto" value="{{ old('nombre') }}" required>
                            <div class="invalid-feedback">Por favor, ingrese nombre del producto! </div>
                        </div>
                        @error('nombre')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Descripcion -->
                    <div class="col-12">
                        <label for="yourUsername" class="form-label">Descripción del producto </label> 
                        <div class="input-group has-validation">
                            <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                <i class="bi bi-box"></i>
                            </span>
                            <input type="text" name="descripcion" class="form-control text-uppercase"
                                id="descripcion" placeholder="Ingrese descripción del producto"
                                value="{{ old('descripcion') }}" >
                            <div class="invalid-feedback">Por favor, ingrese descripción del producto! </div>
                        </div>
                        @error('descripcion')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Costo -->
                    <div class="col-sm-4 col-xs-12">
                        <label for="costo" class="form-label">Costo </label> <span class="text-danger fs-4">*</span>
                        <input type="number" step="any" name="costo" class="form-control" id="input-costo-create"
                            placeholder="Ingrese costo" value="{{ old('costo') ?? '' }}">
                        <div class="invalid-feedback">Por favor, Ingrese un costo valido!</div>
                        @error('costo')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Precio -->
                    <div class="col-sm-4 col-xs-12">
                        <label for="precio" class="form-label">Precio</label> <span class="text-danger fs-4">*</span>
                        <input type="number" step="any" name="precio" class="form-control" id="precio"
                            placeholder="Ingrese precio" value="{{ old('precio') ?? '' }}" required>
                        <div class="invalid-feedback">Por favor, Ingrese un precio valido!</div>
                        @error('precio')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input stock -->
                    <div class="col-sm-4 col-xs-12">
                        <label for="stock" class="form-label">Existencia real</label><span
                            class="text-danger fs-4">*</span>
                        <input type="number" step="any" name="stock" class="form-control" id="input-stock-create"
                            value="0">

                        @error('stock')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <!-- Input almacenes -->
                    <div class="col-12">
                        <label for="id_almacen" class="form-label">almacenes</label><span
                            class="text-danger fs-4">*</span>
                        <select class="form-select" name="id_almacen" id="id_almacen" required>
                            <option selected disabled value="">Seleccione almacen</option>
                            @foreach ($almacenes as $almacen)
                                @if (old('id_almacen') == $almacen['id'])
                                    <option value="{{ $almacen['id'] }}" selected>{{ $almacen['nombre'] }}</option>
                                @endif
                                <option value="{{ $almacen['id'] }}">{{ $almacen['nombre'] }}</option>
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
                                @if (old('id_marca') == $marca->id)
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
                                @if (old('id_categoria') == $categoria->id)
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
                        <label for="file" class="form-label">Subir Foto</label><span
                            class="text-danger fs-4">*</span>
                        <input type="file" name="file" class="form-control " id="file" accept="image/*">
                        @error('file')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">Crear producto</button>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->
