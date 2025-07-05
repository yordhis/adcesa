<!-- Vertically centered Modal -->
<a type="button" class="mb-3" data-bs-toggle="modal" data-bs-target="#modalAsignarInsumo{{ $producto->id }}">
    <i class="bi bi-database-fill-add fs-6 text-success"> Asignar insumos </i>
</a>

<div class="modal fade" id="modalAsignarInsumo{{ $producto->id }}" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Asignar insumos a:  | {{ $producto->nombre }} |</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('admin.insumostoproductos.store') }}" method="post" class="row g-3 needs-validation"
                    enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    <!-- input id_producto -->
                    <input type="hidden" name="id_producto" value="{{ $producto->id }}">

                    <div class="row g-2">
                        <!-- insumo -->
                        <div class="col-md">
                            <div class="form-floating">
                                <select class="form-select select-insumo" name="id_insumo" id="floatingSelectGrid">
                                    @foreach ($insumos as $item)
                                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                    @endforeach
                                </select>
                                <label for="floatingSelectGrid">Asignar Insumos</label>
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
                <h2 class="fs-5">Lista de insumos</h2>
                 <!-- Tabla de variantes (lista) -->
                <table class="table table-hover  bg-white mt-2">
                    <thead>
                        <tr class="table-dark text-white">
                            
                            <th scope="col">Nombre</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($producto->insumos as $insumo)
                            <tr>

                                <td>{{ $insumo->nombre }}</td>
                                <td>
                                    <form action="{{ route('admin.insumostoproductos.destroy', $insumo->id) }}" method="POST" class="d-inline">
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
