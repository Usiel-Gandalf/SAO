@extends('plantillas.adminApp')
@section('main')
<div class="row justify-content-md-center mb-2">
    <h1>ENTIDADES</h1>
</div>

<div class="row justify-content-md-center mb-2">
    @if(session('regionAlert'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <h5><strong>{{session('regionAlert')}}</strong></h5>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if(session('municipalityAlert'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <h5><strong>{{session('municipalityAlert')}}</strong></h5>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if(session('localityAlert'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <h5><strong>{{session('localityAlert')}}</strong></h5>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if(session('schoolAlert'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <h5><strong>{{session('schoolAlert')}}</strong></h5>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
</div>

<div class="row mb-2">
    <!-- Region -->
    <div class="col">
        <div class="card">
            <h5 class="card-header">Regiones</h5>
            <div class="card-body">
                <h5 class="card-title">Subir y/o actualizar regiones</h5>
                <p class="card-text">Se actualizaran o agregaran nuevas regiones sin afectar a los ya existentes,
                    los nombres de las columnas deben de ser, cve_reg, nom_reg, region
                </p>
                <div class="col">
                    <form action="{{route('importRegion')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @error('region')
                        <div class="alert alert-danger">
                            Porfavor seleccione un archivo excel de regiones
                        </div>
                        @enderror
                        <div class="form-control-file">
                            <input type="file" name="region" id="region" class="btn btn-primary">
                        </div>
                        <br>
                        <div class="form-control-button">
                            <button type="submit" class="btn btn-success">Subir archivo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- EndRegion -->
    <!-- Municipality -->
    <div class="col">
        <div class="card">
            <h5 class="card-header">
                Municipio
            </h5>
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
        </div>
    </div>
    <!-- EndMunicipality -->
</div>

<div class="row">
    <!-- Locality -->
    <div class="col">
        <div class="card">
            <h5 class="card-header">Localidad</h5>
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
        </div>
    </div>
    <!-- EndLocality -->
    <!-- School -->
    <div class="col">
        <div class="card">
            <h5 class="card-header">Escuela</h5>
            <div class="card-body">
                <h5 class="card-title">Subir y/o actualizar escuelas</h5>
                <p class="card-text">Se actualizaran o agregaran nuevas escuelas sin afectar a las ya existentes
                    la primera fila del excel tienen que ser los titulos de las columnas que serian: cve_esc, nom_esc e cve_loc
                </p>
                <div class="col ">
                    <form action="{{route('importSchool')}}" method="post" enctype="multipart/form-data">
                        @csrf @error('school')
                        <div class="alert alert-danger">
                            Porfavor seleccione un archivo excel de escuelas
                        </div>
                        @enderror
                        <div class="form-control-file">
                            <input type="file" name="school" id="school" class="btn btn-primary">
                        </div>
                        <br>
                        <div class="form-control-button">
                            <button type="submit" class="btn btn-success">Subir archivo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- EndSchool -->
</div>
@endsection