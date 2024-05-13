<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="{{ asset('imgs/epico_bg.png') }}" class="img-fluid" alt="Eso tillin" />
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form method="POST" action="{{ route('loginAuth') }}">
                        @csrf <!-- Token CSRF para proteger tu formulario -->

                        @if (session('error'))
                            <script>
                                window.onload = function() {
                                    alert('{{ session('error') }}');
                                };
                            </script>
                        @endif



                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0 title-login">Iniciar sesión</p>
                        </div>

                        <!-- Usuario input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="text" id="form3Example3" class="form-control form-control-lg"
                                placeholder="Ingresa tu usuario" name="name" required />
                            <label class="form-label" for="form3Example3">Usuario</label>
                        </div>

                        <!-- Contraseña input -->
                        <div data-mdb-input-init class="form-outline mb-3">
                            <input type="password" id="form3Example4" class="form-control form-control-lg"
                                placeholder="Ingresa tu contraseña" name="password" required />
                            <label class="form-label" for="form3Example4">Contraseña</label>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                class="btn btn-primary btn-lg button-login">Login</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </section>
</body>

</html>
