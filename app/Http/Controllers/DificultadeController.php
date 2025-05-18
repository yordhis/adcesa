<?php

namespace App\Http\Controllers;

use App\Models\Dificultade;
use App\Http\Requests\StoreDificultadeRequest;
use App\Http\Requests\UpdateDificultadeRequest;

class DificultadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDificultadeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDificultadeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dificultade  $dificultade
     * @return \Illuminate\Http\Response
     */
    public function show(Dificultade $dificultade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dificultade  $dificultade
     * @return \Illuminate\Http\Response
     */
    public function edit(Dificultade $dificultade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDificultadeRequest  $request
     * @param  \App\Models\Dificultade  $dificultade
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDificultadeRequest $request, Dificultade $dificultade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dificultade  $dificultade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dificultade $dificultade)
    {
        //
    }
}
