@extends('layouts.template')

@section('content')
    <div class="container centro">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1 class="text-center t1">Archivo de importación</h1>
                <form method="post" name="add_name" id="add_name" class="form-floating" enctype="multipart/form-data">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="archivo">Subir</label>
                        <input type="file" class="form-control" id="archivo" name="archivo">
                    </div>
                    <div class="d-flex justify-content-center">
                        <input type="submit" name="submit" id="submit" class="btn btn-outline-primary btn-lg"
                            value="Importar" />
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
