<!-- Vertically centered Modal -->

<button type="button" class="btn btn-outline-info fw-bold mb-3 position-relative" data-bs-toggle="modal"
    data-bs-target="#modalChat{{ $pedido->id }}">
    Chat

    @if ($pedido['ultimo_mensaje'])
        <span
            class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
            <span class="visually-hidden">New alerts</span>
        </span>
    @endif
</button>

<div class="modal fade" id="modalChat{{ $pedido->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Chat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- CHAT -->
                <div class="card shadow-sm border-0 w-100" style="">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="bi bi-chat-dots-fill me-2"></i> Soporte en Línea
                        </h5>
                    </div>
                    <div class="card-body p-0" style="height: 300px; overflow-y: auto; background-color: #f8f9fa;">
                        <div class="p-3">
                            @foreach ($pedido['mensajes'] as $mjs)
                                @if ($pedido->id_cliente == $mjs->id_emisor)
                                    <div class="d-flex justify-content-end mb-2">
                                        <div class="bg-primary text-white rounded py-2 px-3" style="max-width: 75%;">
                                            {{ $mjs->mensaje }}
                                            <small class="d-block text-end mt-1"
                                                style="font-size: 0.75em; opacity: 0.8;">
                                                {{ \Carbon\Carbon::parse($mjs->created_at)->format('d-m-Y h:ia') }}
                                            </small>
                                        </div>
                                    </div>
                                @else
                                    <div class="d-flex justify-content-start mb-2">
                                        <div class="bg-light border rounded py-2 px-3" style="max-width: 75%;">
                                            {{ $mjs->mensaje }}
                                            <small class="d-block text-start mt-1 text-muted"
                                                style="font-size: 0.75em;">
                                                {{ \Carbon\Carbon::parse($mjs->created_at)->format('d-m-Y h:ia') }}</small>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        </div>
                    </div>
                    <div class="card-footer bg-light p-3">
                        <div class="input-group">
                            <form action="{{ route('chat.enviar.mensaje') }}" method="post">
                                @csrf
                                @method('POST')
                                <div class="d-flex justify-content-between">
                                    <input type="hidden" name="id_receptor" value="{{ $pedido->id_cliente }}">
                                    <input type="hidden" name="id_emisor" value="{{ Auth::user()->id }}">
                                    <input name="mensaje" type="text" class="form-control mx-3"
                                        placeholder="Escribe tu mensaje..." aria-label="Escribe tu mensaje">
                                    <button class="btn btn-primary" type="submit" id="button-addon2">
                                        <i class="bi bi-send-fill"></i> Enviar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->
