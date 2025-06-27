<!-- Vertically centered Modal -->
<button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#modalRegistrartasa">
    <i class="bi bi-currency-exchange"></i> Crear tasa
</button>

<div class="modal fade" id="modalRegistrartasa" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Crear tasa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                <form action="{{ route('admin.tasas.store') }}" method="post" class="row g-3 needs-validation "
                    enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    <!-- Input Tasa -->
                    <div class="col-12">
                        <label for="tasa" class="form-label">Tasa</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                <i class="bi bi-currency-exchange"></i>
                            </span>
                            <input type="number" step="any" name="tasa" class="form-control" id="tasa"
                                placeholder="Ingrese tasa" value="{{ old('tasa') ?? '' }}" required>
                        </div>
                        @error('tasa')
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
