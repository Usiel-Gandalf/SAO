@extends('plantillas.adminApp')
@section('main')
<div class="row justify-content-md-center">
    <div class="col-7 shadow p-3 mb-5 bg-white rounded mt-4">
        <div class="col border border-secondary">
            <div class="row justify-content-center my-2">
                <h2 class="">Registrar aviso de cobro</h2>
            </div>
            <form action="{{url('/mediumEducation')}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="consignment">{{'Remesa'}}</label>
                                <input type="text" class="form-control" name="consignment" id="consignment" value="{{old('consignment')}}">
                            </div>
                            @error('consignment')
                            <div class="alert alert-danger">
                                Error en la remesa, comprobar nuevamente(remesa valida, formato de letras y numeros, no vacio).
                            </div>
                            @enderror
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="scholar_id">{{'clave del becario'}}</label>
                                <input type="number" class="form-control" name="scholar_id" id="scholar_id" value="{{old('scholar_id')}}">
                            </div>
                            @error('scholar_id')
                            <div class="alert alert-danger">
                                Error en la clave del becario, revisar nuevamente, (nombre valido, no vacio, numerico)
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="fol_form">{{'Folio de formato'}}</label>
                    <input type="number" class="form-control" name="fol_form" id="fol_form" value="{{old('fol_form')}}">
                </div>
                @error('fol_form')
                <div class="alert alert-danger">
                    Error en la clave del folio del formato, revisar nuevamente(numerico, no vacio).
                </div>
                @enderror

                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="status"></label>
                            <select id="status" name="status" class="form-control">
                                <option selected value="{{null}}">Estado de entrega</option>
                                <option name="0" value="0">Pendiente</option>
                                <option name="1" value="1">Entregado</option>
                                <option name="2" value="2">No entregado/no localizado</option>
                                <option name="3" value="3">No entregado/por baja</option>
                                <option name="4" value="4">Reexpedicion</option>
                            </select>
                            @error('status')
                            <div class="alert alert-danger" role="alert">
                                {{'Seleccione una modalidad'}}
                            </div>
                            @enderror
                        </div>

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
                    <label for="school_id"></label>
                    <select id="school_id" name="school_id" class="form-control">
                        <option selected value="{{null}}">Selecciona la escuela del registro</option>
                        @foreach($schools as $school)
                        <option name="{{$school->id}}" value="{{$school->id}}" style="width:600px">{{$school->nameSchool}}</option>
                        @endforeach
                    </select>
                </div>
                @error('school_id')
                <div class="alert alert-danger">
                    Seleccione una escuela
                </div>
                @enderror

                <div class="row justify-content-center">
                    <input type="submit" class="btn btn-success mr-1" value="Registrar">
                    <a href="{{url('/mediumEducation')}}" class="btn btn-primary">Regresar</a>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>
@endsection