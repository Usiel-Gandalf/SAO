@extends('plantillas.adminApp')
@section('main')

<div class="row justify-content-md-center mb-2">
    <h1>EDUCACION BASICA</h1>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Importante!</strong> Seccion para subir las cerms o avisos de cobro de educacion basica, asi como sus respectivas actualizaciones
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>

<div class="row justify-content-md-center">
    <!-- endImportBasic -->
    <div class="col-7">
        <div class="card">
            <h5 class="card-header">Informacion de educacion basica</h5>
            <div class="card-body text-center">
                <div class="col">
                    <form action="{{route('importBasic')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        @if(Session::has('basicAlert'))
                        <div class="alert alert-success" role="alert">
                            {{Session::get('basicAlert')}}
                        </div>
                        @endif

                        <div class="row">
                            <div class="col">
                                <label for="type">{{'Tipo de apoyo'}}</label>
                                <select id="type" name="type" class="form-control">
                                    <option selected value="{{null}}">Tipo de apoyo</option>
                                    <option name="1" value="1">CERM</option>
                                    <option name="2" value="2">Avisos de cobro</option>
                                </select>
                                @error('type')
                                <div class="alert alert-danger" role="alert">
                                    {{'Seleccione un tipo de apollo'}}
                                </div>
                                @enderror
                            </div>

                            <div class="col">
                                <label for="status">{{'Estado de entrega'}}</label>
                                <select id="status" name="status" class="form-control">
                                    <option selected value="{{null}}">Estado de entrega</option>
                                    <option name="0" value="0">Pendientes</option>
                                    <option name="1" value="1">Entregados</option>
                                    <option name="2" value="2">No entregado/no localizado</option>
                                    <option name="3" value="3">No entregado/por baja</option>
                                </select>
                                @error('status')
                                <div class="alert alert-danger" role="alert">
                                    {{'Seleccione una modalidad'}}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col">
                                <label for="bimester">{{'Bimestre'}}</label>
                                <select id="bimester" name="bimester" class="form-control">
                                    <option selected value="{{null}}">Bimestre</option>
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

                            <div class="col">
                                <label for="year">{{'Año'}}</label>
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

                        <div class="form-control-file">
                            <input type="file" name="basicUniverse" id="basicUniverse" class="btn btn-primary mt-3" required>
                        </div>
                        @error('basicUniverse')
                        <div class="alert alert-danger">
                            Seleccione un archivo excel
                        </div>
                        @enderror
                        <br>
                        <div class="form-control-button">
                            <button type="submit" class="btn btn-success">Subir archivo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- EndImportBasic -->

</div>
@endsection