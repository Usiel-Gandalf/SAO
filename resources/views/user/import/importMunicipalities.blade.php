@extends('plantillas.adminApp')
@section('main')
<div class="container shadow p-3 mb-5 bg-white rounded mt-5 ">
    <div class="row justify-content-md-center mb-5 mt-2">
        <div class="col-9">
            @if(session('municipalityAlert'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <h5><strong>{{session('municipalityAlert')}}</strong></h5>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show justify-content-md-center" role="alert">
                <h5><strong>¡Error! </strong>{{session('error')}}</h5>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
        </div>
    </div>

    <div class="row justify-content-md-center mb-5 mt-5">
        <div class="col-7">
            <div class="card shadow-lg p-3 mb-3 bg-white rounded border border-primary">
                <center>
                    <h4 class="card-header">Municipios</h4>
                    <div class="card-body">
                        <h5 class="card-title">Subir y/o actualizar municipio</h5>
                        <p class="card-text">Se actualizaran o agregaran nuevos municipios sin afectar a los ya existentes,
                            los titulos de las columnas que serian: cve_mun, nom_mun e cve_reg</p>
                        <div class="col ">
                            <form action="{{route('importMunicipality')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @error('municipality')
                                <div class="alert alert-danger">
                                    Porfavor seleccione un archivo excel de municipios
                                </div>
                                @enderror
                                <div class="form-control-file">
                                    <input type="file" name="municipality" id="municipality" class="btn btn-primary">
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