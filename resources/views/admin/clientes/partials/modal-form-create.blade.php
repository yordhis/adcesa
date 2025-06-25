<!-- Vertically centered Modal -->
<button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#modalRegistrarCliente">
    <i class="bi bi-person-plus"></i> Registrar cliente
</button>

<div class="modal fade" id="modalRegistrarCliente" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Registrar cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                <p class="text-primary bg-light p-3 rounded-5">
                    <b>Nota:</b> El formulario de clientes le permite registrar y crear automaticamente una cuenta de
                    cliente
                    generando una contraseña por defecto que será enviada al correo registrado.
                </p>
                <form action="{{ route('admin.clientes.store') }}" method="post" class="row g-3 needs-validation"
                    enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    <!-- Input Nombres -->
                    <div class="col-12">
                        <label for="yourUsername" class="form-label">Nombres</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                <i class="bi bi-people"></i>
                            </span>
                            <input type="text" name="nombres" class="form-control" id="nombres"
                                placeholder="Ingrese sus nombres" value="{{ old('nombres') ?? '' }}" required>
                            <div class="invalid-feedback">Por favor, ingrese nombres! </div>
                            @error('nombres')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Input Apellidos -->
                    <div class="col-12">
                        <label for="yourUsername" class="form-label">Apellidos</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                <i class="bi bi-people"></i>
                            </span>
                            <input type="text" name="apellidos" class="form-control" id="apellidos"
                                placeholder="Ingrese sus apellidos" value="{{ old('apellidos') ?? '' }}" required>
                            <div class="invalid-feedback">Por favor, ingrese apellidos! </div>
                            @error('apellidos')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Input Nacionalidad -->
                    <div class="col-xs-12 col-sm-6">
                        <label for="nacionalidad" class="form-label">Nacionalidad</label>
                        <select name="nacionalidad" class="form-select" id="nacionalidad" required>
                            @if ($request->nacionalidad)
                                <option value="{{ $request->nacionalidad }}" selected>{{ $request->nacionalidad }}
                                </option>
                            @endif
                            <option value="">Seleccione Nacionalidad</option>
                            @if (old('nacionalidad'))
                                <option value="{{ old('nacionalidad') }}" selected>{{ old('nacionalidad') }}</option>
                            @endif
                            <option value="V">V</option>
                            <option value="E">E</option>
                            <option value="J">J</option>
                        </select>
                        <div class="invalid-feedback">
                            Por favor, ingresar nacionalidad!
                        </div>
                        @error('nacionalidad')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Cédula -->
                    <div class="col-xs-12 col-sm-6">
                        <label for="cedula" class="form-label">Cédula</label>
                        <input type="number" name="cedula" class="form-control" id="cedula"
                            placeholder="Ingrese número de cédula" value="{{ old('cedula') ?? '' }}" required>
                        <div class="invalid-feedback">Por favor, Ingrese número de cédula valido!</div>
                        @error('cedula')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Sexo -->
                    <div class="col-xs-12 col-sm-6">
                        <label for="sexo" class="form-label">Género</label>
                        <select name="sexo" class="form-select" id="sexo" required>
                            @if ($request->sexo)
                                <option value="{{ $request->sexo }}" selected>{{ $request->sexo }}
                                </option>
                            @endif
                            <option value="">Seleccione género</option>
                            @if (old('sexo'))
                                <option value="{{ old('sexo') }}" selected>{{ old('sexo') }}</option>
                            @endif
                            <option value="M">M</option>
                            <option value="F">F</option>
                        </select>
                        <div class="invalid-feedback">
                            Por favor, ingresar sexo!
                        </div>
                        @error('sexo')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Fecha de nacimiento -->
                    <div class="col-xs-12 col-sm-6">
                        <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                        <input type="date" name="fecha_nacimiento" class="form-control" id="fecha_nacimiento"
                            placeholder="Ingrese fecha de nacimiento." value="{{ old('fecha_nacimiento') ?? '' }}"
                            required>
                        <div class="invalid-feedback">Por favor, ingrese fecha de nacimiento!</div>
                        @error('fecha_nacimiento')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Teléfono -->
                    <div class="col-12">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="phone" name="telefono" class="form-control" id="telefono"
                            placeholder="Ingrese número de teléfono" value="{{ old('telefono') ?? '' }}" required>
                        <div class="invalid-feedback">Por favor, Ingrese número de teléfono valido!</div>
                        @error('telefono')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input E-mail -->
                    <div class="col-12">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="Ingrese su E-mail." value="{{ old('email') ?? '' }}" required>
                        <div class="invalid-feedback">Por favor, Ingrese dirección de email!</div>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Dirección -->
                    <div class="col-12">
                        <label for="direccion" class="form-label">Dirección de habitación</label>
                        <input type="text" name="direccion" class="form-control" id="direccion"
                            placeholder="Ingrese dirección de domicilio." value="{{ old('direccion') ?? '' }}"
                            required>
                        <div class="invalid-feedback">Por favor, Ingrese dirección!</div>
                        @error('direccion')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input País -->
                    <div class="col-12">
                        <label for="pais" class="form-label">País (Opcional)</label>
                        <input type="text" name="pais" class="form-control" id="pais"
                            placeholder="Ingrese país." value="{{ old('pais') ?? '' }}">
                        <div class="invalid-feedback">Por favor, Ingrese país!</div>
                        @error('pais')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Estado -->
                    <div class="col-12">
                        <label for="estado" class="form-label">Estado (Opcional)</label>
                        <input type="text" name="estado" class="form-control" id="estado"
                            placeholder="Ingrese Estado." value="{{ old('estado') ?? '' }}">
                        <div class="invalid-feedback">Por favor, Ingrese Estado!</div>
                        @error('estado')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Ciudad -->
                    <div class="col-12">
                        <label for="ciudad" class="form-label">Ciudad (Opcional)</label>
                        <input type="text" name="ciudad" class="form-control" id="ciudad"
                            placeholder="Ingrese ciudad." value="{{ old('ciudad') ?? '' }}">
                        <div class="invalid-feedback">Por favor, Ingrese ciudad!</div>
                        @error('ciudad')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input foto -->
                    <div class="col-12">
                        <label for="file" class="form-label">Subir Foto (Opcional)</label>
                        <input type="file" name="file" class="form-control " id="file" accept="image/*">
                        {{-- <div class="invalid-feedback">Ingrese una imagen valida</div> --}}
                        @error('file')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


            </div>
            <div class="modal-footer">
                <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">Guardar datos</button>
                </div>

                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->
