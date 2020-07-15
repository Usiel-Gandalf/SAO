@extends('plantillas.adminApp')
@section('main')
<div class="container shadow p-3 mb-2 bg-white rounded mt-2">
    <div class="row justify-content-md-center mb-3 mt-2">
        <div class="col-9">
            @if(session('titularAlert'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <h5><strong>{{session('titularAlert')}}</strong></h5>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(session('scholarAlert'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <h5><strong>{{session('scholarAlert')}}</strong></h5>
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

    <div class="row justify-content-md-center mb-5 mt-2">
        <div class="col-6">
            <div class="card shadow-lg p-3 mb-4 bg-white rounded border border-primary">
                <center>
                    <h4 class="card-header">Becarios</h4>
                </center>
                <div class="card-body text-center">
                    <h5 class="card-title">Informacion personal</h5>
                    <p class="card-text">Se registrara la informacion de los becarios</p>
                    <div class="col">
                        <form action="{{route('importScholar')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="form-group">
                                <label for="level">Nivel Educativo</label>
                                <select id="level" name="level" class="">
                                    <option>Nivel educativo</option>
                                    <option name="1" value="1">Educacion Media Superior</option>
                                    <option name="2" value="2">Jovenes escribiendo el futuro</option>
                                </select>
                                @if(Session::has('level'))
                                <div class="alert alert-danger" role="alert">
                                    {{Session::get('level')}}
                                </div>
                                @endif
                            </div>

                            <div class="form-control-file">
                                <input type="file" name="scholarsInformation" id="scholarsInformation" class="btn btn-primary" required>
                            </div>
                            @error('universeInformation')
                            <div class="alert alert-danger">
                                Porfavor seleccione un archivo excel de alumnos
                            </div>
                            @enderror
                            <br>
                            <div class="form-control-button">
                                <button type="submit" class="btn btn-success">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- EndScholar -->
        <div class="col-6">
            <div class="card shadow-lg p-3 mb-4 bg-white rounded border border-primary">
                <center>
                    <h4 class="card-header">Titulares</h4>
                </center>
                <div class="card-body text-center">
                    <h5 class="card-title">Informacion personal</h5>
                    <p class="card-text">Se registrara la informacion de las titulares</p>
                    <div class="col">
                        <form action="{{route('importTitular')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="form-group">
                                <input class="form-control" type="text" id="" name="" disabled value="Titulares">
                            </div>

                            <div class="form-control-file">
                                <input type="file" name="titularsInformation" id="titularsInformation" class="btn btn-primary" required>
                            </div>
                            <br>
                            <div class="form-control-button">
                                <button type="submit" class="btn btn-success">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection