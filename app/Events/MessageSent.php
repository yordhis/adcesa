<?php

namespace App\Events;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

  
    public $emisor;
    public $mensaje;
    /**
     * Create a new event instance.
     */
    public function __construct(Chat $mensaje, User $emisor)
    {
        $this->mensaje = $mensaje;
        $this->emisor = $emisor;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('chat'),
        ];
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs(): string
    {
        return '.message.sent';
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith(): array
    {
        return [
            'mensaje' => $this->mensaje->mensaje,
            'emisor' => [
                'id' => $this->emisor->id,
                'nombres' => $this->emisor->nombres,
                'apellidos' => $this->emisor->nombres,
            ],
            'time' => $this->mensaje->created_at->format('d-m-Y H:i'),
        ];
    }
}
