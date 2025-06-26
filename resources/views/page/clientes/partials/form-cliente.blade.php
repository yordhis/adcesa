<div class="container">

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-xs-12 d-flex flex-column align-items-center justify-content-center">
                    <!-- Bienvenido -->
                    <div class="d-flex justify-content-center py-4">
                        <a href="index.html" class="logo d-flex align-items-center w-auto">
                            <span class="">¡Bienvenido!</span>
                        </a>
                    </div><!-- End bienvenido -->

                    <div class="card mb-3">
                        <div class="card-body">

                            <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Crea tu cuenta Adcesa</h5>
                                <p class="text-center small">Y disfruta de nuestra tienda siguiendo tus pedidos y compras</p>
                            </div>


                            <form action="{{ route('page.clientes.crear.cuenta') }}" method="post"
                                class="row g-3 needs-validation" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="desdeLaWeb" value="true">
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

                                <!-- Input Contraseña -->
                                <div class="col-12">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input type="password" name="password" class="form-control" id="password"
                                        placeholder="Ingrese su contraseña." value="{{ old('password') ?? '' }}"
                                        required>
                                    <div class="invalid-feedback">Por favor, Ingrese dirección de password!</div>
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Input Nombres -->
                                <div class="col-12">
                                    <label for="yourUsername" class="form-label">Nombres</label>
                                    <div class="input-group has-validation">

                                        <input type="text" name="nombres" class="form-control" id="nombres"
                                            placeholder="Ingrese sus nombres" value="{{ old('nombres') ?? '' }}"
                                            required>
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

                                        <input type="text" name="apellidos" class="form-control" id="apellidos"
                                            placeholder="Ingrese sus apellidos" value="{{ old('apellidos') ?? '' }}"
                                            required>
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
                                        <option value="">Seleccione Nacionalidad</option>
                                        @if (old('nacionalidad'))
                                            <option value="{{ old('nacionalidad') }}" selected>
                                                {{ old('nacionalidad') }}</option>
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
                                        placeholder="Ingrese número de cédula" value="{{ old('cedula') ?? '' }}"
                                        required>
                                    <div class="invalid-feedback">Por favor, Ingrese número de cédula valido!</div>
                                    @error('cedula')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Input Sexo -->
                                <div class="col-xs-12 col-sm-6">
                                    <label for="sexo" class="form-label">Género</label>
                                    <select name="sexo" class="form-select" id="sexo" required>

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
                                    <input type="date" name="fecha_nacimiento" class="form-control"
                                        id="fecha_nacimiento" placeholder="Ingrese fecha de nacimiento."
                                        value="{{ old('fecha_nacimiento') ?? '' }}" required>
                                    <div class="invalid-feedback">Por favor, ingrese fecha de nacimiento!</div>
                                    @error('fecha_nacimiento')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Input Teléfono -->
                                <div class="col-12">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input type="phone" name="telefono" class="form-control" id="telefono"
                                        placeholder="Ingrese número de teléfono" value="{{ old('telefono') ?? '' }}"
                                        required>
                                    <div class="invalid-feedback">Por favor, Ingrese número de teléfono valido!</div>
                                    @error('telefono')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Input Dirección -->
                                <div class="col-12">
                                    <label for="direccion" class="form-label">Dirección de habitación</label>
                                    <input type="text" name="direccion" class="form-control" id="direccion"
                                        placeholder="Ingrese dirección de domicilio."
                                        value="{{ old('direccion') ?? '' }}" required>
                                    <div class="invalid-feedback">Por favor, Ingrese dirección!</div>
                                    @error('direccion')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Input foto -->
                                <div class="col-12">
                                    <label for="file" class="form-label">Subir Foto (Opcional)</label>
                                    <input type="file" name="file" class="form-control " id="file"
                                        accept="image/*">
                                    {{-- <div class="invalid-feedback">Ingrese una imagen valida</div> --}}
                                    @error('file')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Terminos -->
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" name="terms" type="checkbox"
                                            value="" id="acceptTerms" required>
                                        <label class="form-check-label" for="acceptTerms">Estoy de acuerdo y acepto los <a
                                                href="{{asset('assets/documentos/terminos_y_condiciones.pdf')}}" target="_blank">términos y condiciones</a></label>
                                        <div class="invalid-feedback">You must agree before submitting.</div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">Guardar datos</button>
                                </div>

                                <div class="col-12">
                                    <p class="small mb-0">Ya tienes una cuenta? <a href="{{route('login.index')}}">Iniciar sesión</a>
                                    </p>
                                </div>


                            </form>

                        </div>
                        <div class="modal-footer text-center p-4">
                            <div class="credits">
                                ¡Hacemos que tus ideas cobren forma, color y presencia en el mundo real! <a
                                    href="/">Adcesa Publicidad</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
