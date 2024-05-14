@extends('layouts.template')

@section('content')
    <div class="container cform">
        <div class="row">
            <div class="col-md-6 offset-md-3">
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
                <h1 class="text-center t1">Solicitar prestamo</h1>
                <form method="post" action="{{ route('insert.loans') }}" name="exportar_form" id="exportar_form" class="form-floating">
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
                    @csrf
                    <div class="mb-3">
                        <label for="monto" class="form-label"><strong>Referencia</strong></label>
                        <input type="text" class="form-control" id="referencia" name="referencia" required
                            placeholder="Ingrese la referencia">
                    </div>
                    <div class="mb-3">
                        <label for="monto" class="form-label"><strong>Monto</strong></label>
                        <input type="number" class="form-control" id="monto" name="monto" required
                            placeholder="Ingrese el total" min="1">
                    </div>
                    <div class="mb-3">
                        <label for="montoTotal" class="form-label"><strong>Total a pagar:</strong></label>
                        <input type="text" class="form-control" id="montoTotal" name="montoTotal"
                            placeholder="0"readonly required>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" name="loans" id="loans" data-bs-target="#screen_accept"
                            class="btn btn-outline-primary btn-lg">Solicitar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/loans.js') }}"></script>
@endsection
