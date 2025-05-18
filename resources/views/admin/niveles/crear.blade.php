@extends('layouts.app')

@section('title', 'Crear Usuario')


@section('content')

    @isset($respuesta)
        @include('partials.alert')
    @endisset
    <div id="alert"></div>

    <div class="container">
        <section class="section register d-flex flex-column align-items-center justify-content-center ">
            <div class="container">
                <div class="row justify-content-center">
                    <div class=" col-sm-8 d-flex flex-column align-items-center justify-content-center">

                        <div class="card ">

                            <div class="card-body">

                                <div class=" pb-2">
                                    <h5 class="card-title text-center pb-0 fs-2">Crear Nivel</h5>
                                    <p class="text-center text-danger small">Rellene todos los campos</p>
                                </div>




                            

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>
    @endsection
