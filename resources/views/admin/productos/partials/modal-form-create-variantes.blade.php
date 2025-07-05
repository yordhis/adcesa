<!-- Vertically centered Modal -->
<a type="button" class="mb-3" data-bs-toggle="modal" data-bs-target="#modalCrearVariante{{ $producto->id }}">
    <i class="bi bi-node-plus fs-4">Crear varientes</i>
</a>

<div class="modal fade" id="modalCrearVariante{{ $producto->id }}" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Crear Variante para {{ $producto->nombre }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('admin.variantes.store') }}" method="post" class="row g-3 needs-validation"
                    enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    <!-- input id_producto -->
                    <input type="hidden" name="id_producto" value="{{ $producto->id }}">

                    <div class="row g-2">
                        <!-- Ancho -->
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="number" class="form-control input-ancho" id="floatingInputGrid" placeholder="Ancho"
                                    value="" step="any" name="ancho" required>
                                <label for="floatingInputGrid">Ancho</label>
                            </div>
                        </div>

                        <!-- Alto -->
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="number" class="form-control input-alto" id="floatingInputGrid" placeholder="Alto"
                                    value="" step="any" name="alto" required>
                                <label for="floatingInputGrid">Alto</label>
                            </div>
                        </div>

                        <!-- Precio -->
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="floatingInputGrid" placeholder="Precio"
                                    value="" step="any" name="precio" required>
                                <label for="floatingInputGrid">Precio</label>
                            </div>
                        </div>

                        <!-- Medidas -->
                        <div class="col-md">
                            <div class="form-floating">
                                <select class="form-select select-medida" name="id_medida" id="floatingSelectGrid">
                                    @foreach ($medidas as $item)
                                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                    @endforeach
                                </select>
                                <label for="floatingSelectGrid">Medidas</label>
                            </div>
                        </div>

                        <!-- Área -->
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInputGridArea" placeholder="Área"
                                    name="area" step="any" value="0" readonly>
                                <label for="floatingInputGridArea">Área</label>
                            </div>
                        </div>

                        <!-- Botón de agregar Variante -->
                        <div class="col-md">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-plus fs-3"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <hr>
                <h2 class="fs-5">Lista de Variantes</h2>
                 <!-- Tabla de variantes (lista) -->
                <table class="table table-hover  bg-white mt-2">
                    <thead>
                        <tr class="table-dark text-white">
                            
                            <th scope="col">Ancho</th>
                            <th scope="col">Alto</th>
                            <th scope="col">Área</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($producto->variantes as $variante)
                            <tr>
                                
                                <td>{{ $variante->ancho }}</td>
                                <td>{{ $variante->alto }}</td>
                                <td>{{ $variante->alto * $variante->ancho }} {{ $variante->simbolo ?? '' }} ^2</td>
                                <td>{{ $variante->precio }}</td>
                                <td>
                                    <form action="{{ route('admin.variantes.destroy', $variante->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta variante?')">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>

                            <td colspan="8" class="text-center table-secondary">
                                Total de variantes: {{ count($producto->variantes) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <!-- Fin Tabla de variantes -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->
