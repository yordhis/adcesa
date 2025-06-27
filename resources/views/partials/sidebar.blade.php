<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">


        @if (array_key_exists('panel', session('permisos')))
            <!-- Start Components Nav | Panel -->
            <li class="nav-item">
                <a class="nav-link {{ url()->current() == route('admin.panel.index') ? 'bg-primary text-white collapse' : 'collapsed' }}"
                    href="{{ route('admin.panel.index') }}">
                    <i
                        class="bi bi-grid {{ url()->current() == route('admin.panel.index') ? 'text-white' : 'text-primary' }}"></i>
                    <span>Panel</span>
                </a>
            </li><!-- End Dashboard Nav | Panel-->
        @endif

        @if (array_key_exists('clientes', session('permisos')))
            <!-- Start Components Nav | Clientes -->
            <li class="nav-item">
                <a href="{{ route('admin.clientes.index') }}"
                    class="nav-link  {{ url()->current() == route('admin.clientes.index') ? 'bg-primary text-white collapse' : 'collapsed' }}">
                    <i
                        class="bi bi-people {{ url()->current() == route('admin.clientes.index') ? 'text-white' : 'text-primary' }}"></i><span>Clientes</span>
                </a>
            </li><!-- End Components Nav | Clientes -->
        @endif

        @if (array_key_exists('pedidos', session('permisos')))
            <!-- Start Components Nav | pedidos -->
            <li class="nav-item">
                <a href="{{ route('admin.pedidos.index') }}"
                    class="nav-link  {{ url()->current() == route('admin.pedidos.index') ? 'bg-primary text-white collapse' : 'collapsed' }}">
                    <i
                        class="bi bi-cart-check-fill {{ url()->current() == route('admin.pedidos.index') ? 'text-white' : 'text-primary' }}"></i><span>Pedidos</span>
                </a>
            </li><!-- End Components Nav | Pedidos -->
        @endif

        @if (array_key_exists('productos', session('permisos')))
            <!-- Start Components Nav | productos -->
            <li class="nav-item">
                <a href="{{ route('admin.productos.index') }}"
                    class="nav-link  {{ url()->current() == route('admin.productos.index') ? 'bg-primary text-white collapse' : 'collapsed' }}">
                    <i
                        class="bi bi-box-fill {{ url()->current() == route('admin.productos.index') ? 'text-white' : 'text-primary' }}"></i>
                    <span>
                        Productos
                    </span>
                </a>
            </li><!-- End Components Nav | productos -->
        @endif

        @if (array_key_exists('insumos', session('permisos')))
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
        @endif

        @if (array_key_exists('categorias', session('permisos')))
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
        @endif

        @if (array_key_exists('marcas', session('permisos')))
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

        @if (array_key_exists('configuraciones', session('permisos')))
            <!-- Start Components Nav | configuraciones -->
            <li class="nav-item">
                <a class="nav-link 
                    {{ url()->current() == route('admin.users.index') ||
                    url()->current() == route('admin.users.create') ||
                    url()->current() == route('admin.roles.index') ||
                    url()->current() == route('admin.almacenes.index') ||
                    url()->current() == route('admin.medidas.index')
                        ? 'collapse show'
                        : 'collapsed' }}
                    
                "
                    data-bs-target="#components-nav-10" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-gear"></i><span>Configuración</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav-10"
                    class="nav-content {{ url()->current() == route('admin.users.index') ||
                    url()->current() == route('admin.users.create') ||
                    url()->current() == route('admin.roles.index') ||
                    url()->current() == route('admin.almacenes.index') ||
                    url()->current() == route('admin.medidas.index')
                        ? 'collapse show'
                        : 'collapse' }} "
                    data-bs-parent=" #sidebar-nav">

                    @if (array_key_exists('users', session('permisos')))
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
                    @endif

                    @if (array_key_exists('roles', session('permisos')))
                        <!-- Start Components Nav | roles y permisos -->
                        <li class="nav-item">
                            <a href="{{ route('admin.roles.index') }}"
                                class="nav-link  {{ url()->current() == route('admin.roles.index') ? 'bg-primary text-white collapse' : 'collapsed' }}">
                                <i
                                    class="bi bi-key fs-5 {{ url()->current() == route('admin.roles.index') ? 'text-white' : 'text-primary' }}"></i>
                                <span>
                                    Roles y Permisos
                                </span>
                            </a>
                        </li><!-- End Components Nav | roles y permisos -->
                    @endif

                    @if (array_key_exists('almacens', session('permisos')))
                        <!-- Start Components Nav | almacenes -->
                        <li class="nav-item">
                            <a href="{{ route('admin.almacenes.index') }}"
                                class="nav-link  {{ url()->current() == route('admin.almacenes.index') ? 'bg-primary text-white collapse' : 'collapsed' }}">
                                <i
                                    class="bi bi-shop-window fs-5 {{ url()->current() == route('admin.almacenes.index') ? 'text-white' : 'text-primary' }}"></i>
                                <span>
                                    Almacenes
                                </span>
                            </a>
                        </li><!-- End Components Nav | almacenes -->
                    @endif

                    @if (array_key_exists('medidas', session('permisos')))
                        <!-- Start Components Nav | medidas -->
                        <li class="nav-item">
                            <a href="{{ route('admin.medidas.index') }}"
                                class="nav-link  {{ url()->current() == route('admin.medidas.index') ? 'bg-primary text-white collapse' : 'collapsed' }}">
                                <i
                                    class="bi bi-rulers fs-5 {{ url()->current() == route('admin.medidas.index') ? 'text-white' : 'text-primary' }}"></i>
                                <span>
                                    Medidas
                                </span>
                            </a>
                        </li><!-- End Components Nav | medidas -->
                    @endif
                    @if (array_key_exists('cuentas', session('permisos')))
                        <!-- Start Components Nav | cuentas -->
                        <li class="nav-item">
                            <a href="{{ route('admin.cuentas.index') }}"
                                class="nav-link  {{ url()->current() == route('admin.cuentas.index') ? 'bg-primary text-white collapse' : 'collapsed' }}">
                                <i
                                    class="bi bi-bank fs-5 {{ url()->current() == route('admin.cuentas.index') ? 'text-white' : 'text-primary' }}"></i>
                                <span>
                                    Cuentas
                                </span>
                            </a>
                        </li><!-- End Components Nav | cuentas -->
                    @endif
                </ul>
            </li><!-- End Components Nav | configuraciones -->
        @endif

    </ul>


</aside><!-- End Sidebar -->
