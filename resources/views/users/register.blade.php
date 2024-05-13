@extends('layouts.template')

@section('content')
    <div class="container-sm mx-auto centro">
        <h2 class="text-center titulo">Registro de usuarios
        </h2>
        <form class="form-floating" method="post" name="add_name" id="add_name" action="{{ route('register') }}">
            @csrf

            @if (session('success'))
                <script>
                    window.onload = function() {
                        alert('{{ session('success') }}');
                    };
                </script>
            @endif

            @if (session('error'))
                <script>
                    window.onload = function() {
                        alert('{{ session('error') }}');
                    };
                </script>
            @endif
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                <label for="nombre">Nombre</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="apellido_paterno" placeholder="Apellido paterno"
                    name="apellido_paterno">
                <label for="apellido_paterno">Apellido paterno</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="apellido_materno" name="apellido_materno"
                    placeholder="Apellido materno">
                <label for="apellido_materno">Apellido materno</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                <label for="email">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion">
                <label for="direccion">Direccion</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="saldo" name="saldo" placeholder="Saldo">
                <label for="saldo">Saldo</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <label for="password">Password</label>
            </div>
            <div class="container-sm d-flex justify-content-center">
                <input type="submit" name="submit" id="submit" class="btn btn-outline-primary btn-lg"
                    value="Registrar" />
                <!-- class="btn btn-info btn-raised btn-sm" -->
            </div>
        </form>
    @endsection
