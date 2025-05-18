<div class="card">
    <div class="card-header text-center fs-3 text-white bg-primary">Formulario de pago</div>
    <div class="card-body">
        {{-- <p>
            <button class="btn btn-primary w-100 mt-4" type="button" data-bs-toggle="collapse" data-bs-target="#contentId"
                aria-expanded="false" aria-controls="contentId">
                Ver los datos de pago
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
        </div> --}}

        <p class="card-text">
        <ul class="list-group list-group-flush">
            <li class="list-group-item fs-4"><b>Resumen</b></li>
            <li class="list-group-item">🚀 <b>Nivel:</b> {{ $nivelSolicitado->nombre }} </li>
            <li class="list-group-item">📑 <b>Mátriculados:</b> {{ count($estudiantesRegistrados) }} </li>
            {{-- <li class="list-group-item"> 🚀 <b>Descuento:</b> {{ $planSolicitado->porcentaje_descuento }} %</li> --}}
            {{-- <li class="list-group-item fs-3 text-success"> <b>Total a pagar:</b>
                {{ (($nivelSolicitado->precio - (($planSolicitado->porcentaje_descuento / 100) * $nivelSolicitado->precio)) * count($estudiantesRegistrados)) }}
                $
                <p class="fs-6 fw-light">Por {{ count($estudiantesRegistrados) }} estudiante </p>
            </li> --}}
        </ul>
        </p>

    </div>
    <div class="card-footer text-muted">
        <form action="{{ route('page.preinscripcion.store') }}" class="form-control" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('post')

            {{-- <div class="mb-3">
                <label for="" class="form-label">Referencia</label>
                <input type="text" class="form-control" name="referencia" value="{{ old('referencia') }}" aria-describedby="helpId"
                    placeholder="Ingrese número de referencia" />
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Monto</label>
                <input type="number" class="form-control" name="abono" min="0" value="{{ old('abono') ?? 0 }}" aria-describedby="helpId"
                    placeholder="Ingrese el monto cancelado" />
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Comprobante</label>
                <input type="file" class="form-control" name="comprobante"  />
            </div> --}}
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="checkbox" value="academia" id="pago" checked readonly />
                <label class="form-check-label" for=""> Acordar precio y pago con la académia. </label>
            </div>

            {{-- Data para la preinscripcion --}}
            <input type="hidden" name="codigo_plan" value="{{ $planSolicitado->codigo }}">
            <input type="hidden" name="codigo_nivel" value="{{ $nivelSolicitado->codigo }}">
            <input type="hidden" name="total" value=" {{ $nivelSolicitado->precio }}">
            <button type="submit" class="btn btn-primary w-100">
                Procesar Pre-inscripción
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
</div>
