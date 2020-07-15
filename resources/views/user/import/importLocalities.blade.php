@extends('plantillas.adminApp')
@section('main')
<div class="container shadow p-3 mb-5 bg-white rounded mt-3">
    <div class="row justify-content-md-center mb-1 mt-2">
        <div class="col-9">
            @if(session('localityAlert'))
            <div class="alert alert-success alert-dismissible fade show justify-content-md-center text-center" role="alert">
                <h6>{{session('localityAlert')}}</h6>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(session('munNot'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h6>Se a detenido el proceso: <strong>{{session('munNot')}}</strong> Verifique que exista ese municipio e intente nuevamente</h6>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
        </div>
    </div>

    <div class="row justify-content-md-center mb-4 mt-2">
    @if(session('failures'))
    <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".bd-example-modal-lg">Informacion procesada, sin embargo se detectaron errores, clic para ver reporte</button>
    @include('modals.failuresImports')
    @endif
    </div>

    <div class="row justify-content-md-center mb-5 mt-3">
        <div class="col-7">
            <div class="card shadow-lg p-3 mb-3 bg-white rounded border border-primary">
                <center>
                    <h4 class="card-header">Localidades</h4>
                    <div class="card-body">
                        <h5 class="card-title">Subir y/o actualizar localidades</h5>
                        <p class="card-text">Se actualizaran o agregaran nuevas localidades sin afectar a las ya existentes
                            la primera fila del excel tienen que ser los titulos de las columnas que serian: cve_loc, key_loc, nom_loc e cve_mun
                        </p>
                        <div class="col ">
                            <form action="{{route('importLocality')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @error('locality')
                                <div class="alert alert-danger">
                                    Porfavor seleccione un archivo excel de localidades
                                </div>
                                @enderror
                                <div class="form-control-file">
                                    <input type="file" name="locality" id="locality" class="btn btn-primary">
                                </div>
                                <br>
                                <div class="form-control-button">
                                    <button type="submit" class="btn btn-success">Subir archivo</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </center>
            </div>
        </div>
    </div>
</div>
@endsection