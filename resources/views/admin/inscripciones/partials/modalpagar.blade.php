<!-- Vertically centered Modal -->
<a type="button" class="text-info" data-bs-toggle="modal" data-bs-target="#modalPagar{{ $inscripcion->id }}">
    <i class="bi bi-paypal fs-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Procesar pago"></i>
</a>



<div class="modal fade" id="modalPagar{{ $inscripcion->id }}" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Procesar pago</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h1>Estudiante: {{ $inscripcion->estudiante_nombre }} </h1>

                <form action="{{ route('admin.pagos.store') }}" method="post" class="row g-3 needs-validation"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('post')
                    {{-- Código del pago (número de control de pago) --}}
                    <div class="col-xs-12 col-sm-6">
                        <label for="yourUsername" class="form-label">Número de control de pago
                            <span class=" text-primary">(Es automático)</span>
                        </label>
                        <div class="input-group has-validation">
                            <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                <i class="bi bi-upc-scan"></i>
                            </span>
                            <input type="text" name="codigo_pago" class="form-control fs-5 text-danger" id="codigo_pago"
                                value="{{ $codigoDePago }}" readonly required>
                            <div class="invalid-feedback">Por favor, ingrese codigo! </div>
                        </div>
                    </div>

                    {{-- Código de inscripcion --}}
                    <div class="col-xs-12 col-sm-6">
                        <label for="yourUsername" class="form-label">Código de inscripción
                            <span class=" text-primary">(Es automático)</span>
                        </label>
                        <div class="input-group has-validation">
                            <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                <i class="bi bi-upc-scan"></i>
                            </span>
                            <input type="text" name="codigo_inscripcion" class="form-control fs-5 text-danger" id="codigo_inscripcion"
                                value="{{ $inscripcion->codigo }}" readonly required>
                            <div class="invalid-feedback">Por favor, ingrese codigo! </div>
                        </div>
                    </div>

                    {{-- Cedula del estudian --}}
                    <div class="col-xs-12 col-sm-6">
                        <label for="yourPassword" class="form-label">Cédula del estudiante</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">

                                <i class="bi bi-people"></i>

                            </span>
                            <input type="text" name="cedula_estudiante" class="form-control fs-5" id="cedula_estudiante"
                                value="{{ $inscripcion->cedula_estudiante ?? '' }}"
                                placeholder="Ingrese Cédula del estudiante" readonly required>
                            <div class="invalid-feedback">Por favor, Ingrese cédula del estudiante!</div>
                        </div>


                    </div>

                    {{-- Fecha del pago --}}
                    <div class="col-xs-12 col-sm-6">
                        <label for="yourPassword" class="form-label">Fecha de pago</label>
                        <input type="date" name="fecha" class="form-control" id="yourUsername"
                            placeholder="Ingrese fecha de pago." value="{{ date('Y-m-d') }}" required>
                        <div class="invalid-feedback">Por favor, Ingrese fecha de pago!</div>
                    </div>

                    {{-- Conceptos de pago --}}
                    <div class="col-12 ">
                        <label for="validationCustom04" class="form-label">Asigne concepto de pago</label>
                        <select name="concepto" class="form-select" id="validationCustom04" required>
                            <option selected disabled value="">Seleccione Concepto</option>
                            @if (old('concepto'))
                            <option value="{{ old('concepto') }}" selected>
                                {{ old('concepto') }}
                            </option>
                            @endif
                            @foreach ($conceptos as $concepto)
                                <option value="{{  $concepto->codigo . " - " .$concepto->descripcion }}">
                                    {{ $concepto->codigo }} -
                                    {{ $concepto->descripcion }}
                                </option>
                            @endforeach

                        </select>
                        <div class="invalid-feedback">
                            Por favor, Seleccione Concepto de pago!
                        </div>
                    </div>



                    {{-- Monto pendiente --}}
                    <div class="col-xs-12 col-sm-6">
                        <label for="yourPassword" class="form-label">Monto pendiente</label>
                        <input type="text" name="total" class="form-control border border-danger text-danger fs-3"
                            id="total" value="{{ $inscripcion->total - $inscripcion->abono }}" readonly>
                        <div class="invalid-feedback">Monto total</div>
                    </div>

                    {{-- Total de abono --}}
                    <div class="col-xs-12 col-sm-6">
                        <label for="yourPassword" class="form-label">Monto ha abonar </label>
                        <input type="text" name="abono"
                            class="form-control border border-success text-success fs-3" id="total"
                            value="0" readonly>
                        <div class="invalid-feedback">Monto total</div>
                    </div>

                    <div class="col-12">
                        <h4>Agregar abono</h4>
                        <hr>
                    </div>
                 

                        @for ($i = 1; $i <= 3; $i++)
                        <div class="d-flex flex-inline">
                            <div class="col-1">
                                {!! "<h2>{$i}</h2>"  !!}
                            </div>

                            {{-- Seleccione forma de pago --}}
                            <div class="mx-1 form-floating">
                                <select class="form-select formas" id="formas_pagos_{{ $i }}" name="formas_pagos_{{ $i }}"
                                    aria-label="Formas de pago">
    
                                    <option selected disabled>Seleccione forma de pago</option>
                                    @foreach ($metodos as $metodo)
                                        <option value="{{ $metodo }}">{{ $metodo }}</option>
                                    @endforeach
    
                                </select>
                                <label for="floatingSelectGrid">Seleccione forma de pago</label>
                            </div>
    
                            {{-- Monto del abono --}}
                            <div class="mx-1 form-floating">
                                <input type="number" name="monto_{{ $i }}" step="0.01" class="form-control formas"
                                    id="monto_{{ $i }}">
                                <label for="floatingInputGrid">Ingrese Monto en divisas</label>
                            </div>
    
                            {{-- Tasa de cambio --}}
                            <div class="mx-1 form-floating">
                                <input type="number" name="tasa_{{ $i }}" step="0.01" class="form-control formas"
                                    id="tasa_{{ $i }}" value="0">
                                <label for="floatingInputGrid">Ingrese tasa</label>
                            </div>
    
                            {{-- Monto en bolivares --}}
                            <div class="mx-1 form-floating">
                                <input type="number" name="monto_bolivares_{{ $i }}" step="0.01" class="form-control formas"
                                    id="monto_bolivares_{{ $i }}" value="0" readonly>
                                <label for="floatingInputGrid">Monto en bolivares</label>
                            </div>
    
                            {{-- Referencia --}}
                            <div class="mx-1 form-floating">
                                <input type="text" name="referencia_{{ $i }}" class="form-control formas" id="referencia_{{ $i }}">
                                <label for="floatingInputGrid">Referencia del pago</label>
                            </div>
                        </div>
                            <hr>
                            
                        @endfor
                    
                    <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">Procesar pago</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div><!-- End Vertically centered Modal-->
