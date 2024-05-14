@extends('layouts.template')

@section('content')
    <!-- Tabla de consulta -->
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
    <div class="container-fluid d-flex justify-content-center">
        <div class="table-responsive centrotabla">
            <h2 class="text-center titulo">Consulta de prestamos</h2>
            <div class="mb-3">
                <label for="parametro" class="form-label"><strong>Id:</strong> @auth
                        {{ Auth::user()->id }}
                    @endauth
                </label>
            </div>
            <div class="mb-3">
                <label for="parametro" class="form-label"><strong>Usuario:</strong> @auth
                        {{ Auth::user()->nombre }}
                    @endauth
                </label>
            </div>
            <div class="mb-3">
                <label for="parametro" class="form-label"><strong>Saldo:</strong> @auth
                        ${{ Auth::user()->saldo }}
                    @endauth
                </label>
            </div>
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Referencia</th>
                        <th scope="col">Total prestado</th>
                        <th scope="col">Total a pagar</th>
                        <th scope="col">Abono</th>
                        <th scope="col">Liquidado</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $register)
                        <tr>
                            <td>{{ $register->id }}</td>
                            <td>{{ $register->referencia }}</td>
                            <td>{{ $register->total_prestado }}</td>
                            <td>{{ $register->total_pagar }}</td>
                            <td>{{ $register->cantidad_actual }}</td>
                            <td>{{ $register->liquidado == 0 ? 'No' : 'Sí' }}</td>
                            <td>
                                @if ($register->liquidado == 0)
                                    <form method="post" action="{{ route('pay.loans') }}">
                                        @csrf
                                        <input hidden value={{ $register->id }} name="idLoan">
                                        <input type="number" class="form-control" name="monto" placeholder="Ingrese el monto" min="1">
                                        <button type="submit" class="btn btn-primary">Pagar</button>
                                    </form>
                                @endif
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
