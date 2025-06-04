<!-- Vertically centered Modal -->
<button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#modalRegistrarinsumo">
    <i class="bi bi-box"></i> Crear insumo
</button>

<div class="modal fade" id="modalRegistrarinsumo" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Registrar insumo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                <form action="{{ route('admin.insumos.store') }}" method="post" 
                    class="row g-3 needs-validation"
                    enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    <!-- Input Nombre -->
                    <div class="col-12">
                        <label for="yourUsername" class="form-label">Nombre del insumo</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                <i class="bi bi-people"></i>
                            </span>
                            <input type="text" name="nombre" class="form-control" id="nombre"
                                placeholder="Ingrese nombre del insumo" value="{{ old('nombre') ?? '' }}" required>
                            <div class="invalid-feedback">Por favor, ingrese nombre del insumo! </div>
                            @error('nombre')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Input Costo -->
                    <div class="col-12">
                        <label for="costo" class="form-label">Costo</label>
                        <input type="number" step="any" name="costo" class="form-control" id="costo"
                            placeholder="Ingrese costo" value="{{ old('costo') ?? '' }}" required>
                        <div class="invalid-feedback">Por favor, Ingrese un costo valido!</div>
                        @error('costo')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Precio -->
                    <div class="col-12">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" step="any" name="precio" class="form-control" id="precio"
                            placeholder="Ingrese precio" value="{{ old('precio') ?? '' }}" required>
                        <div class="invalid-feedback">Por favor, Ingrese un precio valido!</div>
                        @error('precio')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Cantidad -->
                    <div class="col-12">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" step="any" name="cantidad" class="form-control" id="cantidad"
                            placeholder="Ingrese cantidad" value="{{ old('cantidad') ?? '' }}" required>
                        <div class="invalid-feedback">Por favor, Ingrese una cantidad valida!</div>
                        @error('cantidad')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input marcas -->
                    <div class="col-12">
                        <label for="marca" class="form-label">Marcas</label>
                        <select class="form-select" name="marca" id="marca" required>
                            <option selected disabled value="">Seleccione marca</option>
                            @foreach ($marcas as $marca)
                                @if (old('marca') == $marca->id)
                                    <option value="{{ $marca->id }}" selected>{{ $marca->nombre }}</option>
                                @endif
                                <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Por favor, seleccione una marca valida!.
                        </div>
                        @error('marca')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input categorias -->
                    <div class="col-12">
                        <label for="categoria" class="form-label">Categorias</label>
                        <select class="form-select" name="categoria" id="categoria" required>
                            <option selected disabled value="">Seleccione categoria</option>
                            @foreach ($categorias as $categoria)
                                @if (old('categoria') == $categoria->id)
                                    <option value="{{ $categoria->id }}" selected>{{ $categoria->nombre }}</option>
                                @endif
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Por favor, seleccione una categoria valida!.
                        </div>
                        @error('categoria')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input imagen -->
                    <div class="col-12">
                        <label for="file" class="form-label">Subir Foto (Opcional)</label>
                        <input type="file" name="file" class="form-control " id="file" accept="image/*">
                        @error('file')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">Crear insumo</button>
                    </div>

                </form>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->
