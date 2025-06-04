<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        @if (Auth::user()->rol == 1 || Auth::user()->rol == 2)
            <!-- Start Components Nav | Panel -->
            <li class="nav-item">
                <a class="nav-link {{ url()->current() == route('admin.panel.index') ? 'bg-primary text-white collapse' : 'collapsed' }}"
                    href="{{ route('admin.panel.index') }}">
                    <i
                        class="bi bi-grid {{ url()->current() == route('admin.panel.index') ? 'text-white' : 'text-primary' }}"></i>
                    <span>Panel</span>
                </a>
            </li><!-- End Dashboard Nav | Panel-->

            <!-- Start Components Nav | Clientes -->
            <li class="nav-item">
                <a href="{{ route('admin.clientes.index') }}"
                    class="nav-link  {{ url()->current() == route('admin.clientes.index') ? 'bg-primary text-white collapse' : 'collapsed' }}">
                    <i
                        class="bi bi-people {{ url()->current() == route('admin.clientes.index') ? 'text-white' : 'text-primary' }}"></i><span>Clientes</span>
                </a>
            </li><!-- End Components Nav | Clientes -->



            <!-- Start Components Nav | insumos -->
            <li class="nav-item">
                <a href="{{ route('admin.insumos.index') }}"
                    class="nav-link  {{ url()->current() == route('admin.insumos.index') ? 'bg-primary text-white collapse' : 'collapsed' }}">
                    <i
                        class="bi bi-box {{ url()->current() == route('admin.insumos.index') ? 'text-white' : 'text-primary' }}"></i>
                    <span>
                        Insumos
                    </span>
                </a>
            </li><!-- End Components Nav | insumos -->

            <!-- Start Components Nav | Categorias -->
            <li class="nav-item">
                <a href="{{ route('admin.categorias.index') }}"
                    class="nav-link  {{ url()->current() == route('admin.categorias.index') ? 'bg-primary text-white collapse' : 'collapsed' }}">
                    <i
                        class="bi bi-tags {{ url()->current() == route('admin.categorias.index') ? 'text-white' : 'text-primary' }}"></i>
                    <span>
                        Categorias
                    </span>
                </a>
            </li><!-- End Components Nav | Categorias -->

            <!-- Start Components Nav | marcas -->
            <li class="nav-item">
                <a href="{{ route('admin.marcas.index') }}"
                    class="nav-link  {{ url()->current() == route('admin.marcas.index') ? 'bg-primary text-white collapse' : 'collapsed' }}">
                    <i
                        class="bi bi-bookmarks {{ url()->current() == route('admin.marcas.index') ? 'text-white' : 'text-primary' }}"></i>
                    <span>
                        Marcas
                    </span>
                </a>
            </li><!-- End Components Nav | marcas -->
        @endif

        @if (Auth::user()->rol == 1)
            <!-- Start Components Nav | configuraciones -->
            <li class="nav-item">
                <a class="nav-link 
                    {{ url()->current() == route('admin.users.index') || url()->current() == route('admin.users.create')
                        ? 'collapse show'
                        : 'collapsed' }}
                    
                "
                    data-bs-target="#components-nav-10" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-gear"></i><span>Configuración</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav-10"
                    class="nav-content {{ url()->current() == route('admin.users.index') ? 'collapse show' : 'collapsed' }} "
                    data-bs-parent=" #sidebar-nav">

                    <!-- Start Components Nav | usuarios -->
                    <li class="nav-item">
                        <a class="nav-link 
                            {{ url()->current() == route('admin.users.index') || url()->current() == route('admin.users.create')
                                ? 'bg-primary text-white collapse show'
                                : 'collapsed' }}
                             
                            "
                            data-bs-target="#components-nav-1" data-bs-toggle="collapse" href="#">
                            <i
                                class="bi bi-people fs-5 {{ url()->current() == route('admin.users.index') || url()->current() == route('admin.users.create')
                                    ? 'text-white'
                                    : 'text-primary' }}"></i>
                            <span>Usuarios</span>
                            <i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="components-nav-1"
                            class="nav-content 
                                {{ url()->current() == route('admin.users.index') || url()->current() == route('admin.users.create')
                                    ? 'collapse show'
                                    : 'collapse' }} 
                                "
                            data-bs-parent=" #sidebar-nav-1">
                            <li>
                                <a href="{{ route('admin.users.index') }}"
                                    class="{{ url()->current() == route('admin.users.index') ? 'active border rounded' : '' }}">
                                    <i class="bi bi-circle"></i><span>Lista </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.users.create') }}"
                                    class="{{ url()->current() == route('admin.users.create') ? 'active border rounded' : '' }}">
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
