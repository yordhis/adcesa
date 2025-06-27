<div class="col-sm-6 col-xs-12">
    <div class="card">
        <div class="card-header text-center fs-3 text-white bg-primary">Formulario de pago</div>
        <div class="card-body">
            <form action="{{ route('page.pedidos.store') }}" class="row g-3" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')

                <p class="fs-4"><b>Datos del cliente</b></p>
                @if (!Auth::user())
                    <!-- Input E-mail -->
                    <div class="col-12">
                        <label for="email_cliente" class="form-label">E-mail</label>
                        <input type="email" name="email_cliente" class="form-control" id="email_cliente"
                            placeholder="Ingrese su E-mail." value="{{ old('email_cliente') ?? '' }}" required>
                        <div class="invalid-feedback">Por favor, Ingrese dirección de email!</div>
                        @error('email_cliente')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Nombres -->
                    <div class="col-12">
                        <label for="yourUsername" class="form-label">Nombres</label>
                        <div class="input-group has-validation">

                            <input type="text" name="nombres_cliente" class="form-control" id="nombres"
                                placeholder="Ingrese sus nombres" value="{{ old('nombres_cliente') ?? '' }}" required>
                            <div class="invalid-feedback">Por favor, ingrese nombres! </div>
                            @error('nombres_cliente')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Input Apellidos -->
                    <div class="col-12">
                        <label for="apellidos_cliente" class="form-label">Apellidos</label>
                        <div class="input-group has-validation">

                            <input type="text" name="apellidos_cliente" class="form-control" id="apellidos_cliente"
                                placeholder="Ingrese sus apellidos" value="{{ old('apellidos_cliente') ?? '' }}"
                                required>
                            <div class="invalid-feedback">Por favor, ingrese apellidos! </div>
                            @error('apellidos_cliente')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Input Nacionalidad -->
                    <div class="col-sm-6 col-xs-12 ">
                        <label for="nacionalidad_cliente" class="form-label">Nacionalidad</label>
                        <select name="nacionalidad_cliente" class="form-select" id="nacionalidad_cliente" required>
                            <option value="">Seleccione Nacionalidad</option>
                            @if (old('nacionalidad_cliente'))
                                <option value="{{ old('nacionalidad_cliente') }}" selected>
                                    {{ old('nacionalidad_cliente') }}</option>
                            @endif
                            <option value="V">V</option>
                            <option value="E">E</option>
                            <option value="J">J</option>
                        </select>
                        <div class="invalid-feedback">
                            Por favor, ingresar nacionalidad!
                        </div>
                        @error('nacionalidad_cliente')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Cédula -->
                    <div class="col-sm-6 col-xs-12">
                        <label for="cedula" class="form-label">Cédula</label>
                        <input type="number" name="cedula" class="form-control" id="cedula"
                            placeholder="Ingrese número de cédula" value="{{ old('cedula') ?? '' }}" required>
                        <div class="invalid-feedback">Por favor, Ingrese número de cédula valido!</div>
                        @error('cedula')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Teléfono -->
                    <div class="col-12">
                        <label for="telefono_cliente" class="form-label">Teléfono</label>
                        <input type="phone" name="telefono_cliente" class="form-control" id="telefono_cliente"
                            placeholder="Ingrese número de teléfono" value="{{ old('telefono_cliente') ?? '' }}"
                            required>
                        <div class="invalid-feedback">Por favor, Ingrese número de teléfono valido!</div>
                        @error('telefono_cliente')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Dirección -->
                    <div class="col-12">
                        <label for="direccion_cliente" class="form-label">Dirección de habitación</label>
                        <input type="text" name="direccion_cliente" class="form-control" id="direccion_cliente"
                            placeholder="Ingrese dirección de domicilio." value="{{ old('direccion_cliente') ?? '' }}"
                            required>
                        <div class="invalid-feedback">Por favor, Ingrese dirección!</div>
                        @error('direccion_cliente')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Activar para crear cuenta -->
                    <div class="col-12">
                        <input class="form-check-input" type="checkbox" name="crear_cuenta" value="true"
                            id="crear_cuenta" />
                        <label class="form-check-label" for=""> Click en check si deseas crear cuenta con
                            estos datos
                        </label>
                    </div>
                @else
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item fs-4">
                            <b>{{ Auth::user()->nombres . ' ' . Auth::user()->apellidos }}</b>
                        </li>
                        <li class="list-group-item">

                            📲 <b>Teléfono:</b>
                            @if (Auth::user()->telefono)
                                {{ preg_replace('/^(\d{4})(\d{3})(\d{4})$/', '($1)-$2-$3', Auth::user()->telefono) }}
                            @else
                                No asignado
                            @endif
                        </li>
                        <li class="list-group-item">
                            🏦 <b>Dirección:</b> {{ Auth::user()->direccion }}
                        </li>
                        <li class="list-group-item">
                            📧 <b>E-mail:</b> {{ Auth::user()->email }}
                        </li>
                    </ul>
                @endif

                <p class="fs-4 mt-5"><b>Informaciòn de pago</b></p>
                <div class="mb-1">
                    <label for="" class="form-label">Referencia</label>
                    <input type="text" class="form-control" name="referencia" value="{{ old('referencia') }}"
                        placeholder="Ingrese número de referencia" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Monto</label>
                    @php
                        $totalPagar = 0;
                    @endphp
                    @foreach (session('carrito') as $producto)
                        @php
                            $totalPagar = $totalPagar + $producto['subtotal'];
                        @endphp
                    @endforeach
                    <input type="number" class="form-control" name="monto" min="0"
                        value="{{ $totalPagar }}" readonly />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Comprobante</label>
                    <input type="file" class="form-control" name="file" value="{{ old('file') ?? '' }}" />
                </div>


                <button type="submit" class="btn btn-primary w-100">
                    Finalizar
                </button>

                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </form>
        </div>
        {{-- <div class="card-footer text-muted">
            <p>
                <button class="btn btn-dark w-100 mt-4" type="button" data-bs-toggle="collapse"
                    data-bs-target="#contentId" aria-expanded="false" aria-controls="contentId">
                    Ver datos de pago
                </button>
            </p>
            <div class="collapse" id="contentId">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item fs-4"><b>Pago movil</b></li>
                    <li class="list-group-item">
                        🏦 <b>Banco:</b> (0102) Venezuela
                    </li>
                    <li class="list-group-item">
                        📲 <b>Teléfono:</b> 0414-123-45-67
                    </li>
                    <li class="list-group-item">
                        🪪 <b>Cédula:</b> 12.345.678
                    </li>
                </ul>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item fs-4"><b>Zelle</b></li>
                    <li class="list-group-item">📧 <b>Correo:</b> zelle@gmail.com</li>
                    <li class="list-group-item">🧔 <b>Titular:</b> Zelleson</li>
                </ul>
            </div>
        </div> --}}
    </div>
</div>
