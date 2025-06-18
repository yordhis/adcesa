@extends('layouts.app')

@section('title', 'Lista de roles')

@section('content')

    @if (session('mensaje'))
        @include('partials.alert')
    @endif
    <div id="alert"></div>

    <div class="col-12">
        @if ($errors->any())
            <div class="alert alert-danger text-start">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>


    <section class="section">
        <div class="row">



            <div class="col-12">
                <h2> Lista de roles</h2>
            </div>

            <div class="col-sm-6 col-xs-12 ">
                @include('admin.roles.partials.modal-form-create-rol')
                @include('admin.roles.partials.modal-form-create-permisos')
            </div>

            <!-- Filtro de clientes -->
            <div class="col-sm-6 col-xs-12">
                <form action="{{ route('admin.roles.index') }}" method="post">
                    @csrf
                    @method('GET')
                    <div class="input-group mb-3">
                        <label for="filtro" class="text-primary p-2">Buscar</label>
                        <input type="text" class="form-control" name="filtro" placeholder="Buscar por: Nombres"
                            aria-label="Filtrar" aria-describedby="button-addon2" required>
                        <button class="btn btn-primary" type="submit" id="button-addon2">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>


            <div class="col-lg-12 table-responsive">
                <!-- Table with stripped rows -->

                <table class="table table-hover  bg-white mt-2">
                    <thead>
                        <tr class="table-dark text-white">
                            <th scope="col">Nombre</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($roles as $rol)
                            <tr>
                               
                                <td>{{ $rol->nombre }}</td>

                                <td>
                                    @include('admin.roles.partials.modal-edit')

                                    @if ($rol->id > 3)
                                        @include('admin.roles.partials.modal-delete')
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>

                            <td colspan="7" class="text-center table-secondary">
                                Total de roles: {{ $roles->total() }} |
                                <a href="{{ route('admin.roles.index') }}" class="text-primary">
                                    Ver todo
                                </a>
                                <br>
                            </td>
                        </tr>
                    </tfoot>
                </table>

                <!-- End Table with stripped rows -->
                <div class="col-sm-6 col-xs-12">
                    {{ $roles->appends(['filtro' => $request->filtro])->links() }}
                </div>

            </div>

        </div>

    </section>

@endsection
