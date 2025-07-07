@extends('layouts.page')

@section('title', 'Adcesa - Chat')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Chat en Tiempo Real</div>

                <div class="card-body">
                    <div id="messages" class="mb-3" style="height: 400px; overflow-y: scroll; border: 1px solid #eee; padding: 10px;">
                        @foreach ($messages as $message)
                            <div class="message-item mb-2 @if ($message->user_id == Auth::id()) text-right @endif">
                                <strong>{{ $message->user->name }}:</strong> {{ $message->message }}
                                <small class="text-muted">({{ $message->created_at->format('H:i') }})</small>
                            </div>
                        @endforeach
                    </div>

                    <form id="chat-form">
                        @csrf
                        <div class="input-group">
                            <input type="text" id="message-input" class="form-control" placeholder="Escribe tu mensaje...">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ mix('js/app.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const messagesDiv = document.getElementById('messages');
        const messageInput = document.getElementById('message-input');
        const chatForm = document.getElementById('chat-form');
        const userId = {{ Auth::id() }}; // ID del usuario autenticado para saber si el mensaje es propio

        // Scroll al final al cargar la página
        messagesDiv.scrollTop = messagesDiv.scrollHeight;

        chatForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const message = messageInput.value.trim();
            if (message === '') {
                return;
            }

            // Añadir el mensaje inmediatamente al div (sin esperar la respuesta del backend)
            appendMessage(message, '{{ Auth::user()->name }}', userId, new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }));

            axios.post('{{ route('chat.store') }}', { message: message })
                .then(response => {
                    console.log('Message sent!', response.data);
                    messageInput.value = ''; // Limpiar el input
                    messagesDiv.scrollTop = messagesDiv.scrollHeight; // Scroll al final
                })
                .catch(error => {
                    console.error('Error sending message:', error);
                    // Revertir el mensaje si hubo un error (opcional)
                    // messagesDiv.removeChild(messagesDiv.lastChild);
                });
        });

        function appendMessage(message, userName, sentUserId, time) {
            const messageItem = document.createElement('div');
            messageItem.classList.add('message-item', 'mb-2');
            if (sentUserId === userId) {
                messageItem.classList.add('text-right');
            }

            messageItem.innerHTML = `
                <strong>${userName}:</strong> ${message}
                <small class="text-muted">(${time})</small>
            `;
            messagesDiv.appendChild(messageItem);
            messagesDiv.scrollTop = messagesDiv.scrollHeight; // Scroll al final
        }

        // Suscribirse al canal privado de chat
        Echo.private('chat')
            .listen('.message.sent', (e) => {
                console.log('New message received:', e);
                appendMessage(e.message, e.user.name, e.user.id, e.time);
            });
    });
</script>
@endpush