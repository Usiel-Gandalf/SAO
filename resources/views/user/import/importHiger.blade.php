@extends('plantillas.adminApp')
@section('main')
<div class="container shadow p-3 mb-2 bg-white rounded mt-2">
    <div class="row justify-content-md-center mb-1 mt-2">
        <div class="col-7">
            @if(session('importHigerAlert'))
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                <h5><strong>{{session('importHigerAlert')}}</strong></h5>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(session('updateHigerAlert'))
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                <h5><strong>{{session('updateHigerAlert')}}</strong></h5>
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

    <div class="row justify-content-md-center">
        <!-- Scholar -->
        <div class="col-6">
            <div class="card shadow-lg p-3 mb-5 bg-white rounded border border-primary">
                <center>
                    <h5 class="card-header">Registrar JEF</h5>
                    <div class="card-body text-center">
                        <div class="col ">
                            <form action="{{route('importHiger')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                @if(Session::has('higerAlert'))
                                <div class="alert alert-success" role="alert">
                                    {{Session::get('higerAlert')}}
                                </div>
                                @endif

                                <div class="row mb-4">
                                    <label for="">{{'Estado de entrega'}}</label>
                                    <input class="form-control" type="text" id="" name="" disabled value="Pendientes">
                                </div>

                                <div class="row">
                                    <div class="col form-group">
                                        <label for="bimester">{{'Bimestre: '}}</label>
                                        <select id="bimester" name="bimester" class="form-control">
                                            <option>Bimestre</option>
                                            <option name="1" value="1">Enero-Febrero</option>
                                            <option name="2" value="2">Marzo-Abril</option>
                                            <option name="3" value="3">Mayo-Junio</option>
                                            <option name="4" value="4">Septiembre-Octubre</option>
                                            <option name="5" value="5">Noviembre-Diciembre</option>
                                        </select>
                                        @error('bimester')
                                        <div class="alert alert-danger" role="alert">
                                            {{'Seleccione un bimestre'}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col form-group">
                                        <label for="year">{{'Año: '}}</label>
                                        <select id="year" name="year" class="form-control">
                                            <option value="2019">2019</option>
                                            <option selected value="2020">2020</option>
                                            <option value="2021">2021</option>
                                        </select>
                                        @error('year')
                                        <div class="alert alert-danger" role="alert">
                                            {{'Seleccione año'}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-control-file mb-4">
                                    <input type="file" name="higerUniverse" id="higerUniverse" class="btn btn-primary" required>
                                    @error('higerUniverse')
                                    <div class="alert alert-danger">
                                        Porfavor seleccione un archivo excel de alumnos
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-control-button">
                                    <button type="submit" class="btn btn-success">Registrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </center>
            </div>
        </div>
        <!-- EndScholar -->
        <div class="col-6">
            <div class="card shadow-lg p-3 mb-5 bg-white rounded border border-primary">
                <center>
                    <h5 class="card-header">Actualizar JEF</h5>
                    <div class="card-body text-center">
                        <div class="col">
                            <form action="{{route('updateHiger')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <div class="row mb-1">
                                    <p>Para actualizar el estado de entrega su documento solo necesita tener los folios de formato (fol_form),
                                        los datos se actualizaran automaticamente</p>
                                </div>

                                <label for="status">{{'Estado de entrega'}}</label>
                                <div class="row mb-3">
                                    <select id="status" name="status" class="form-control">
                                        <option>Estado de entrega</option>
                                        <option name="0" value="0">Pendientes</option>
                                        <option name="1" value="1">Entregados</option>
                                        <option name="2" value="2">No entregado/no localizado</option>
                                        <option name="3" value="3">No entregado/por baja</option>
                                    </select>
                                    @error('status')
                                    <div class="alert alert-danger" role="alert">
                                        {{'Seleccione un estado de entrega'}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-control-file mb-4">
                                    <input type="file" name="higerUniverse" id="higerUniverse" class="btn btn-primary" required>
                                    @error('higerUniverse')
                                    <div class="alert alert-danger">
                                        Porfavor seleccione un archivo excel de alumnos
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-control-button">
                                    <button type="submit" class="btn btn-success">Actualizar</button>
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