@php
    $url = explode('/', $_SERVER['REQUEST_URI']);
    $categoria = strtoupper($url[1]);
    if (isset($url[2])) {
        $subcategoria = strtoupper($url[2]);
    } else {
        $subcategoria = 'LISTA';
    }
@endphp

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        @if (Auth::user()->rol == 1 || Auth::user()->rol == 2)
            <!-- Start Components Nav | Panel -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.panel.index') }}">
                    <i class="bi bi-grid"></i>
                    <span>Panel</span>
                </a>
            </li><!-- End Dashboard Nav | Panel-->

            <!-- Start Components Nav | Clientes -->
            <li class="nav-item">
                <a href="{{ route('admin.profesores.index') }}"
                    class="nav-link  {{ $categoria == 'PROFESORES' ? 'text-warning collapse' : 'collapsed' }}">
                    <i class="bi bi-person-vcard"></i><span>Clientes</span>
                </a>
            </li><!-- End Components Nav | Clientes -->


            <!-- Start Components Nav | Productos compuestos -->
            <li class="nav-item">
                <a href="{{ route('admin.estudiantes.index') }}"
                    class="nav-link  {{ $categoria == 'ESTUDIANTES' ? 'text-warning collapse' : 'collapsed' }}">
                    <i class="bi bi-person-video3"></i><span>Productos Compuestos</span>
                </a>
            </li><!-- End Components Nav | Productos compuestos -->


            <!-- Start Components Nav | Materia prima -->
            <li class="nav-item">
                <a href="{{ route('admin.niveles.index') }}"
                    class="nav-link  {{ $categoria == 'NIVELES' ? 'text-warning collapse' : 'collapsed' }}">
                    <i class="bi bi-controller"></i><span>Materia prima</span>
                </a>
            </li><!-- End Components Nav | Materia prima -->


            <!-- Start Components Nav | Pagos -->
            <li class="nav-item">
            <a class="nav-link {{ $categoria == 'PAGOS' ? 'collapse show' : 'collapsed' }}"
                data-bs-target="#components-nav-7" data-bs-toggle="collapse" href="#">
                <i class="bi bi-paypal"></i><span>Pagos</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav-7" class="nav-content {{ $categoria == 'PAGOS' ? 'collapse show' : 'collapse' }} "
                data-bs-parent=" #sidebar-nav">
                <li>
                    <a href="{{ route('admin.pagos.index') }}" 
                        class="{{ $categoria == 'PAGOS' ? ($subcategoria == 'LISTA' ? 'active border rounded' : '') : '' }}">
                        <i class="bi bi-circle"></i><span>Lista</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.pagos.create') }}" 
                        class="{{ $categoria == 'PAGOS' ? ($subcategoria == 'CREATE' ? 'active border rounded' : '') : '' }}">
                        <i class="bi bi-circle"></i><span>Procesar Pago</span>
                    </a>
                </li>

            </ul>
        </li><!-- End Components Nav | Pagos -->
        @endif

        @if (Auth::user()->rol == 1)
            <!-- Start Components Nav | configuraciones -->
            <li class="nav-item">
                <a class="nav-link {{ ($categoria == 'CONCEPTOS' ? 'collapse show' : $categoria == 'USUARIOS') ? 'collapse show' : 'collapsed' }}"
                    data-bs-target="#components-nav-10" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-gear"></i><span>Configuración</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav-10"
                    class="nav-content {{ ($categoria == 'CONCEPTOS' ? 'collapse show' : $categoria == 'USUARIOS') ? 'collapse show' : 'collapse' }} "
                    data-bs-parent=" #sidebar-nav">

                    <!-- Start Components Nav | Conceptos -->
                    <li class="nav-item">
                        {{-- conceptos de pago --}}
                        <a class="nav-link {{ $categoria == 'CONCEPTOS' ? 'collapse show' : 'collapsed' }}"
                            data-bs-target="#components-nav-12" data-bs-toggle="collapse" href="#">
                            <i class="bi bi-paypal fs-3"></i><span>Definir conceptos de pago</span><i
                                class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="components-nav-12"
                            class="nav-content {{ $categoria == 'CONCEPTOS' ? 'collapse show' : 'collapse' }} "
                            data-bs-parent=" #sidebar-nav-1">
                            <li>
                                <a href="{{ route('admin.conceptos.index') }}"
                                    class="{{ $categoria == 'CONCEPTOS' ? ($subcategoria == 'LISTA' ? 'active border rounded' : '') : '' }}">
                                    <i class="bi bi-circle"></i><span>Lista</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.conceptos.create') }}"
                                    class="{{ $categoria == 'CONCEPTOS' ? ($subcategoria == 'CREATE' ? 'active border rounded' : '') : '' }}">
                                    <i class="bi bi-circle"></i><span>Crear</span>
                                </a>
                            </li>

                        </ul>
                    </li><!-- End Components Nav | Conceptos -->

                    <!-- Start Components Nav | usuarios -->
                    <li class="nav-item">
                        <a class="nav-link {{ $categoria == 'USUARIOS' ? 'collapse show' : 'collapsed' }}"
                            data-bs-target="#components-nav-1" data-bs-toggle="collapse" href="#">
                            <i class="bi bi-people fs-3"></i><span>Usuarios</span><i
                                class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="components-nav-1"
                            class="nav-content {{ $categoria == 'USUARIOS' ? 'collapse show' : 'collapse' }} "
                            data-bs-parent=" #sidebar-nav-1">
                            <li>
                                <a href="{{ route('admin.users.index') }}"
                                    class="{{ $categoria == 'USUARIOS' ? ($subcategoria == 'LISTA' ? 'active border rounded' : '') : '' }}">
                                    <i class="bi bi-circle"></i><span>Lista</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.users.create') }}"
                                    class="{{ $categoria == 'USUARIOS' ? ($subcategoria == 'CREATE' ? 'active border rounded' : '') : '' }}">
                                    <i class="bi bi-circle"></i><span>Crear</span>
                                </a>
                            </li>

                        </ul>
                    </li><!-- End Components Nav | usuarios -->

                </ul>
            </li><!-- End Components Nav | configuraciones -->
        @endif

    </ul>


</aside><!-- End Sidebar -->
