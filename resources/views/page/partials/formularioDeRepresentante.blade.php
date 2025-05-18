<div class="container">
    <div class="row">
        <div class="col-12 text-center mt-5">
            <h2 class="fs-2 text-dark">Registre los datos del Representante</h2>
        </div>
        <div class="card p-5 mt-5">
            <form action="{{ route('page.registrar.representante') }}" class="row g-3 needs-validation" method="post"
                id="formRepresentante">
                @csrf
                @method('post')
                <div class="col-sm-12">
                    <label for="yourUsername" class="form-label">Cédula del representante</label><br>
                    <input type="number" name="rep_cedula" class="form-control" value="{{ old('rep_cedula') }}"
                        id="rep_cedula" placeholder="Ingrese la cédula del representante.">
                    <p><small class="text-white card mt-2 p-2 bg-secondary" id="mensajeRepresentante"> Si el
                            representante ya
                            existe los datos se llenaran automáticamente. </small></p>
                    <div class="invalid-feedback">Por favor, Ingrese la cédula del representante!
                    </div>
                </div>
                <span id="preload"></span>
                <div id="componenteCardRepresentante"></div>
                <div id="componenteRepresentante">
                    <div class="col-12">
                        <label for="rep_nombre" class="form-label">Nombre del representante</label>
                        <input type="text" name="rep_nombre" class="form-control" id="rep_nombre"
                            value="{{ old('rep_nombre') }}" placeholder="Ingrese Nombre del representante.">
                        <div class="invalid-feedback">Por favor, Nombre del representante!</div>
                        @error('rep_nombre')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="rep_telefono" class="form-label">Teléfono </label>
                        <input type="number" name="rep_telefono" class="form-control" value="{{ old('rep_telefono') }}"
                            id="rep_telefono" placeholder="Ingrese teléfono del representante.">
                        <div class="invalid-feedback">Por favor, Ingrese teléfono del representante!
                        </div>
                        @error('rep_telefono')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 ">
                        <label for="yourPassword" class="form-label">Fecha de nacimiento</label>
                        <input type="date" name="rep_nacimiento" class="form-control" id="fecha_nacimiento"
                            placeholder="Ingrese fecha de nacimiento." value="{{ old('rep_nacimiento') }}" required>
                        <div class="invalid-feedback">Por favor, ingrese fecha de nacimiento!
                        </div>
                        @error('rep_nacimiento')
                            <div class="text-danger"> {{ $message }} </div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="rep_edad" class="form-label">Edad</label>
                        <input type="number" name="rep_edad" class="form-control" id="edad_estudiante"
                            value="{{ old('rep_edad') }}" placeholder="Ingrese edad.">
                        <div class="invalid-feedback">Por favor, Ingrese edad!</div>
                        @error('rep_edad')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="rep_ocupacion" class="form-label">Ocupación</label>
                        <input type="text" name="rep_ocupacion" class="form-control"
                            value="{{ old('rep_ocupacion') }}" id="rep_ocupacion"
                            placeholder="Ingrese ocupación o oficio.">
                        <div class="invalid-feedback">Por favor, ocupación o oficio!</div>
                        @error('rep_ocupacion')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="rep_direccion" class="form-label">Dirección del
                            representante</label>
                        <input type="text" name="rep_direccion" class="form-control"
                            value="{{ old('rep_direccion') }}" id="rep_direccion"
                            placeholder="Ingrese dirección del representante.">
                        <div class="invalid-feedback">Por favor, Ingrese dirección del representante!
                        </div>
                        @error('rep_ocupacion')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="rep_correo" class="form-label">Correo</label>
                        <input type="email" name="rep_correo" class="form-control" value="{{ old('rep_correo') }}"
                            id="rep_correo" placeholder="Ingrese correo.">
                        <div class="invalid-feedback">Por favor, Ingrese correo electrónico correcto!
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <button class="btn btn-primary w-100" type="submit" id="botonRegistrarRepresentante">Registrar y asignar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/representantes/getRepresentantePage.js') }}"></script>
