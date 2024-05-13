@extends('layouts.template')

@section('content')
    <div class="container contenedor-grafica">
        <form action="post" id="buttons" name="buttons">
            <row class="marginBotton">
                <div class="row marginBotton">
                    <div class="col text-center">
                        <button type="button" class="btn btn-outline-success" value="barras" id="barras"
                            name="barras">Barras</button>
                    </div>
                    <!-- Botón 2 -->
                    <div class="col text-center">
                        <button type="button" class="btn btn-outline-primary" value="pastel" id="pastel"
                            name="pastel">Pastel</button>
                    </div>
                    <!-- Botón 3 -->
                    <div class="col text-center">
                        <button type="button" class="btn btn-outline-danger" value="dona" id="dona"
                            name="dona">Dona</button>
                    </div>
                </div>
            </row>
        </form>
        <!-- Fila con dos columnas -->
        <div class="row">
            <!-- Primera columna -->
            <div class="col-md-6">
                <!-- Contenido de la primera columna -->
                <h2>Gráfica</h2>
                <canvas id="myChart"></canvas>
            </div>
            <!-- Segunda columna -->
            <div class="col-md-6">
                <!-- Tabla de consulta -->
                <div class="container-fluid d-flex justify-content-center">
                    <div class="table-responsive">
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
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="{{ asset('js/charts.js') }}"></script>
    @endsection
