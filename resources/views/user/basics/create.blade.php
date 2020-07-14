@extends('plantillas.adminApp')
@section('main')
<div class="row justify-content-md-center">
    <div class="col-7 shadow p-3 mb-5 bg-white rounded mt-4">
        <div class="col border border-secondary">
            <div class="row justify-content-center my-2">
                <h2 class="">Registrar Beca Basica</h2>
            </div>
            @if(session('locNot'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <h5><strong>{{session('locNot')}}</strong></h5>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <form action="{{url('/basicEducation')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="consignment">{{'Remesa'}}</label>
                    <input type="text" class="form-control" name="consignment" id="consignment" value="{{old('consignment')}}">
                </div>
                @error('consignment')
                <div class="alert alert-danger">
                    Error en la remesa, comprobar nuevamente(remesa valida, formato de letras y numeros, no vacio).
                </div>
                @enderror

                <div class="form-group">
                    <label for="fol_form">{{'Folio de formato'}}</label>
                    <input type="number" class="form-control" name="fol_form" id="fol_form" value="{{old('fol_form')}}">
                </div>
                @error('fol_form')
                <div class="alert alert-danger">
                    Error en la clave de la localidad, revisar nuevamente(numerico, no vacio).
                </div>
                @enderror

                <div class="form-group">
                    <label for="titular_id">{{'clave de la titular'}}</label>
                    <input type="number" class="form-control" name="titular_id" id="titular_id" value="{{old('titular_id')}}">
                </div>
                @error('titular_id')
                <div class="alert alert-danger">
                    Error en el nombre de la localidad, revisar nuevamente, (nombre valido, no vacio, no numerico)
                </div>
                @enderror

                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="type"></label>
                            <select id="type" name="type" class="form-control">
                                <option selected value="{{null}}">Tipo de apoyo</option>
                                <option name="1" value="1">CERM</option>
                                <option name="2" value="2">Aviso de cobro</option>
                            </select>
                            @error('type')
                            <div class="alert alert-danger" role="alert">
                                {{'Seleccione un tipo de apollo'}}
                            </div>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="status"></label>
                            <select id="status" name="status" class="form-control">
                                <option selected value="{{null}}">Estado de entrega</option>
                                <option name="0" value="0">Pendiente</option>
                                <option name="1" value="1">Entregado</option>
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
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="bimester"></label>
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
                            <label for="year"></label>
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
                </div>

                <div class="form-group">
                    <input type="number" class="form-control" name="locality_id" id="locality_id" placeholder="Ingrese la clave de la localidad">
                    @error('locality_id')
                    <div class="alert alert-danger">
                        Ingrese una clave de localidad
                    </div>
                    @enderror
                </div>

                <div class="row justify-content-center">
                    <input type="submit" class="btn btn-success mr-1" value="Registrar">
                    <a href="{{url('/basicEducation')}}" class="btn btn-primary">Regresar</a>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>
@endsection