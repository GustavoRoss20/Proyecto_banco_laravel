@extends('layouts.template')

@section('content')
    <!-- Tabla de consulta alumnos -->
    <div class="container-fluid d-flex justify-content-center">
        <div class="table-responsive centrotabla">
            <h2 class="text-center titulo">Consulta de usuarios</h2>
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido paterno</th>
                        <th scope="col">Apellido materno</th>
                        <th scope="col">Saldo</th>                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->nombre }}</td>
                            <td>{{ $user->apellido_paterno }}</td>
                            <td>{{ $user->apellido_materno }}</td>
                            <td>{{ $user->saldo }}</td>                            
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>  
    @endsection
