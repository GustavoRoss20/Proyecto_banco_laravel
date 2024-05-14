@extends('layouts.template')

@section('content')
    <!-- Fila con dos columnas -->
    <div class="row">
        <!-- Primera columna -->
        <div class="col-md-6">
            <!-- Contenido de la primera columna -->
            <h2>Egresos</h2>
            <div class="container-fluid d-flex justify-content-center">
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Referencia</th>
                                <th scope="col">Monto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($egresos as $egreso)
                                <tr>
                                    <td>{{ $egreso->id }}</td>
                                    <td>{{ $egreso->nombre }}</td>
                                    <td>${{ $egreso->monto }}</td>
                                </tr>
                            @endforeach
                            <p>Total de Egresos: ${{ $totalEgresos }}</p>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Segunda columna -->
        <div class="col-md-6">
            <!-- Tabla de consulta -->
            <h2>Ingresos</h2>
            <div class="container-fluid d-flex justify-content-center">
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Referencia</th>
                                <th scope="col">Monto</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($ingresos as $ingreso)
                                <tr>
                                    <td>{{ $ingreso->id }}</td>
                                    <td>{{ $ingreso->nombre }}</td>
                                    <td>${{ $ingreso->monto }}</td>
                                </tr>
                            @endforeach
                            <p>Total de Ingresos: ${{ $totalIngresos }}</p>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
