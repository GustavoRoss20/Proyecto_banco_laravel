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
                <h1 class="text-center t1">Transferencias</h1>
                <form method="post" action="{{ route('opt.transfers') }}" name="exportar_form" id="exportar_form"
                    class="form-floating">
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
                        <label for="comparacion" class="form-label"><strong>Transferir a:</strong> </label>
                        <select class="form-select" id="usuario" name="usuario">
                            <option id="botonSubmit" selected value="">Selecciona un usuario</option>
                            @foreach ($data as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->id }} | {{ $user->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="monto" class="form-label"><strong>Monto</strong></label>
                        <input type="number" class="form-control" id="monto" name="monto" required
                            placeholder="Ingrese el total" min="1">
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" name="TXT" id="TXT"
                            class="btn btn-outline-primary btn-lg">Transferir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
