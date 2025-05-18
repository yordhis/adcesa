@php
    if (session('estatus')) {
        $respuesta['estatus'] = session('estatus');
        $respuesta['mensaje'] = session('mensaje');
    }
@endphp

<div aria-live="polite" aria-atomic="true" class="position-relative">

    <div class="toast-container position-absolute top-0 end-0 p-3">

        <!-- Then put toasts within -->
        <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header text-white {{ $respuesta['clases'][$respuesta['estatus']] }}">
                <i class="{{ $respuesta['icono'][$respuesta['estatus']] }}"></i>
                <strong class="me-auto fs-5 m-2">Alerta</strong>
                <small class="text-muted"></small>
                <button type="button" class="btn-close fs-3 text-white" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body text-dark fs-5">
                {!! $respuesta['mensaje'] !!}
            </div>
        </div>
    </div>
</div>
