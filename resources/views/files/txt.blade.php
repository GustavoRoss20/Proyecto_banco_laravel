@extends('layouts.template')

@section('content')
    <div class="container cform">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1 class="text-center t1">Parametros de exportación</h1>
                <form method="post" action="{{ route('download.txt') }}" name="exportar_form" id="exportar_form"
                    class="form-floating">
                    <div class="mb-3">
                        <label for="parametro" class="form-label">Saldo</label>
                    </div>
                    @csrf
                    <div class="mb-3">
                        <label for="comparacion" class="form-label">Comparación</label>
                        <select class="form-select" id="comparacion" name="comparacion">
                            <option selected value="">Selecciona un parametro</option>
                            <option value=">"> > </option>
                            <option value="<">
                                < </option>
                            <option value="="> = </option>
                            <option value=">="> >= </option>
                            <option value="<=">
                                <= </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="porcentaje" class="form-label">Porcentaje</label>
                        <input type="number" class="form-control" id="porcentaje" name="porcentaje"
                            placeholder="Ingrese el total">
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" name="TXT" id="TXT"
                            class="btn btn-outline-primary btn-lg">Descargar txt</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
