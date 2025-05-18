@extends('layouts.app')

@section('title', 'Lista de niveles')

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
                <h2> Lista de niveles </h2>
            </div>

            <div class="col-sm-6 col-xs-12">
                {{-- boton del modal para crear --}}
                @include('admin.niveles.partials.modalform')
            </div>
            <div class="col-sm-6 col-xs-12">
                <form action="{{ route('admin.niveles.index') }}" method="post">
                    @csrf
                    @method('get')
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="filtro" placeholder="Buscar" aria-label="Filtrar"
                            aria-describedby="button-addon2" required>
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
                            <th scope="col">#</th>
                            <th scope="col">Código</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Libro</th>
                            <th scope="col">Duración</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($niveles as $nivel)
                            <tr>
                                <th scope="row">{{ $nivel->id }}</th>
                                <td>{{ $nivel->codigo }}</td>
                                <td>{{ $nivel->nombre }}</td>
                                <td>{{ $nivel->precio }}</td>
                                <td class="text-break">{{ $nivel->libro }}</td>
                                <td>{{ $nivel->duracion . ' ' . $nivel->tipo_duracion }} </td>
                                
                                @if ( $nivel->tipo_nivel )
                                    <td>{{ $nivel->tipo_nivel == 'ninio' ? 'Niños' : 'Adultos' }} </td>
                                @else
                                        <td> Sin asignar categoria </td>
                                @endif

                        <td>
                            @include('admin.niveles.partials.modaldialog')

                            <a href="{{ route('admin.niveles.edit', $nivel->id) }}">
                                <i class="bi bi-pencil"></i>
                            </a>


                            @include('admin.niveles.partials.modal')


                        </td>
                        </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>

                            <td colspan="8" class="text-center table-secondary">
                                Total de niveles: {{ $niveles->total() }} |
                                <a href="{{ route('admin.niveles.index') }}" class="text-primary">
                                    Ver todo
                                </a>
                                <br>
                            </td>
                        </tr>
                    </tfoot>
                </table>

                <!-- End Table with stripped rows -->
                <div class="col-sm-6 col-xs-12">
                    {{ $niveles->appends(['filtro' => $request->filtro])->links() }}
                </div>
            </div>

        </div>

    </section>





@endsection
