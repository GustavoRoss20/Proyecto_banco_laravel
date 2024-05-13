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
                        <th scope="col">Correo</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Saldo</th>                        
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->nombre }}</td>
                            <td>{{ $user->apellido_paterno }}</td>
                            <td>{{ $user->apellido_materno }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->direccion }}</td>
                            <td>{{ $user->saldo }}</td>                            
                            <td>
                                <a href="{{ route('users.delete', $user->id) }}" class='btn btn-outline-danger delete'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16'
                                        fill='currentColor' class='bi bi-trash3-fill' viewBox='0 0 16 16'>
                                        <path
                                            d='M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z' />
                                    </svg></a>

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    @push('scripts')
        <!-- Datatables -->
        <script>
            $(document).ready(function() {
                $('#table').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"
                    },
                });
            });          
        </script>
    @endsection
