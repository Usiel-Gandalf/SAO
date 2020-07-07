@extends('plantillas.adminApp')
@section('main')
<div class="main shadow p-3 mb-5 bg-white rounded">

    <div class="row justify-content-md-center mb-2">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Importante!</strong> Registro de informacion de los becarios o titulares
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>

    <div class="row justify-content-md-center">
        <!-- Scholar -->
        <div class="col-7">
            <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                <center>
                    <h4 class="card-header">Becarios ó Titulares</h4>
                </center>
                <div class="card-body text-center">
                    <h5 class="card-title">Informacion personal</h5>
                    <p class="card-text">Se registrara la informacion de los becarios o titulares</p>
                    <div class="col">
                        <form action="{{route('importScholar')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            @error('universeInformation')
                            <div class="alert alert-danger">
                                Porfavor seleccione un archivo excel de alumnos
                            </div>
                            @enderror
                            @if(Session::has('scholarAlert'))
                            <div class="alert alert-success" role="alert">
                                {{Session::get('scholarAlert')}}
                            </div>
                            @endif
                            @if(Session::has('titularAlert'))
                            <div class="alert alert-success" role="alert">
                                {{Session::get('titularAlert')}}
                            </div>
                            @endif

                            <div class="form-group">
                                <label for="level"></label>
                                <select id="level" name="level" class="">
                                    <option selected value="null">Nivel educativo</option>
                                    <option name="1" value="1">Educacion Basica(Titulares)</option>
                                    <option name="2" value="2">Educacion Media Superior</option>
                                    <option name="3" value="3">Jovenes escribiendo el futuro</option>
                                </select>
                                @if(Session::has('level'))
                                <div class="alert alert-danger" role="alert">
                                    {{Session::get('level')}}
                                </div>
                                @endif
                            </div>

                            <div class="form-control-file">
                                <input type="file" name="universeInformation" id="universeInformation" class="btn btn-primary" required>
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
        <!-- EndScholar -->
    </div>
</div>
@endsection