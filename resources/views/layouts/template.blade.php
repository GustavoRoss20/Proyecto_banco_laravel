<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>App</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- dataTables -->
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- JQuery  -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
    <!-- Nav -->
    <nav class="navbar bg-body-tertiary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Bienvenid@: @auth {{ Auth::user()->nombre }} @endauth
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <!-- Home -->
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('home') ? 'active' : '' }}" aria-current="page"
                                href="{{ url('home') }}">Home</a>
                        </li>
                        <!-- Users -->
                        <li class="nav-item dropdown">
                            <a class="nav-link {{ Request::is('users/*') ? 'active' : '' }} dropdown-toggle"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Usuarios
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item {{ Request::is('users/profile') ? 'active' : '' }}"
                                        href="{{ url('/users/profile') }}">Perfil</a></li>
                                <hr class="dropdown-divider" />
                                <li><a class="dropdown-item {{ Request::is('users/register') ? 'active' : '' }}"
                                        href="{{ url('/users/register') }}">Registrar usuario</a></li>
                                <hr class="dropdown-divider" />
                                <li><a class="dropdown-item {{ Request::is('users/showAll') ? 'active' : '' }}"
                                        href="{{ url('/users/showAll') }}">Mostrar usuarios</a></li>
                        </li>
                    </ul>

                    <!-- Archivos -->
                    <li class="nav-item dropdown">
                        <a class="nav-link {{ Request::is('files/*') ? 'active' : '' }} dropdown-toggle" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Archivos
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item {{ Request::is('files/txt') ? 'active' : '' }}"
                                    href="{{ url('/files/txt') }}">Archivos TXT</a></li>
                            <li><a class="dropdown-item {{ Request::is('files/csv') ? 'active' : '' }}"
                                    href="{{ url('/files/csv') }}">Archivos CSV</a></li>
                            <li><a class="dropdown-item {{ Request::is('files/xml') ? 'active' : '' }}"
                                    href="{{ url('/files/xml') }}">Archivos XML</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li>
                                <a class="dropdown-item {{ Request::is('files/charts') ? 'active' : '' }}"
                                    href="{{ url('/files/charts') }}">Gráficas</a>
                            </li>
                        </ul>
                    </li>
                    <!-- Consultas -->
                    <li class="nav-item dropdown">
                        <a class="nav-link {{ Request::is('queries/*') ? 'active' : '' }} dropdown-toggle"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Consultas
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item {{ Request::is('queries/ascd') ? 'active' : '' }}"
                                    href="{{ url('/queries/ascd') }}">Ascendente</a></li>
                            <li><a class="dropdown-item {{ Request::is('queries/desc') ? 'active' : '' }}"
                                    href="{{ url('/queries/desc') }}">Descendente</a></li>
                        </ul>
                    </li>
                    <!-- Operaciones -->
                    <li class="nav-item dropdown">
                        <a class="nav-link {{ Request::is('operations/*') ? 'active' : '' }} dropdown-toggle"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Operaciones
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item {{ Request::is('operations/deposits') ? 'active' : '' }}"
                                    href="{{ url('/operations/deposits') }}">Depositos</a></li>
                            <li><a class="dropdown-item {{ Request::is('operations/transfers') ? 'active' : '' }}"
                                    href="{{ url('/operations/transfers') }}">Transferencias</a></li>
                            <li><a class="dropdown-item {{ Request::is('operations/service_payment') ? 'active' : '' }}"
                                    href="{{ url('/operations/service_payment') }}">Pagos de servicio</a></li>
                        </ul>
                    </li>
                    <!-- Estados financieros        -->
                    <li class="nav-item dropdown">
                        <a class="nav-link {{ Request::is('financial_statements/*') ? 'active' : '' }} dropdown-toggle"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Estados financieros
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item {{ Request::is('financial_statements/loans') ? 'active' : '' }}"
                                    href="{{ url('/financial_statements/loans') }}">Prestamos</a></li>
                            <li><a class="dropdown-item {{ Request::is('financial_statements/balance') ? 'active' : '' }}"
                                    href="{{ url('/financial_statements/balance') }}">Saldo</a></li>
                        </ul>
                    </li>
                    <!-- Salir -->
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" type="button" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">Cerrar sesión</a>
                    </li>
                    <br>
                    <div class="logo-laravel-contenedor" style="display: flex; justify-content: center;">
                        <img src="{{ asset('imgs/laravel.svg') }}" alt="laravel" class="laravel-logo">
                    </div>

                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- Fin Nav -->

    <main class="container main-container">
        @yield('content')
    </main>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Cerrar sesión</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    Desea cerrar sesión?
                    <br>
                    <img src="{{ asset('imgs/no_papu.png') }}" class="imagen-no_papu">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="{{ route('logout') }}"><button type="button" class="btn btn-primary">Cerrar
                            sesión</button></a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    @stack('scripts')
</body>

</html>
