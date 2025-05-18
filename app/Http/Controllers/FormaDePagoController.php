<?php

namespace App\Http\Controllers;

use App\Models\FormaDePago;
use App\Http\Requests\StoreFormaDePagoRequest;
use App\Http\Requests\UpdateFormaDePagoRequest;

class FormaDePagoController extends Controller
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
     * @param  \App\Http\Requests\StoreFormaDePagoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFormaDePagoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FormaDePago  $formaDePago
     * @return \Illuminate\Http\Response
     */
    public function show(FormaDePago $formaDePago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FormaDePago  $formaDePago
     * @return \Illuminate\Http\Response
     */
    public function edit(FormaDePago $formaDePago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFormaDePagoRequest  $request
     * @param  \App\Models\FormaDePago  $formaDePago
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFormaDePagoRequest $request, FormaDePago $formaDePago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FormaDePago  $formaDePago
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormaDePago $formaDePago)
    {
        //
    }
}
