<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Chat;
use App\Http\Requests\StoreChatRequest;
use App\Http\Requests\UpdateChatRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $mensajes = Chat::with('user')->orderBy('created_at', 'asc')->get();
            return view('chat.index', compact('mensajes'));
        } catch (\Throwable $th) {
            dd($th);
        }
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_emisor' => 'required|numeric|max:99999999',
            'mensaje' => 'required|string|max:155',
        ]);

        $mensaje = Chat::create([
            'id_emisor' => $request->input('id_emisor'),
            'id_receptor' => $request->input('id_receptor', 1),
            'mensaje' => $request->input('mensaje'),
        ]);

        $mensaje = "Mensaje enviado";
        $estatus = Response::HTTP_OK;
        return back()->with(compact('mensaje', 'estatus'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Chat $chat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChatRequest $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chat $chat)
    {
        //
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
}
