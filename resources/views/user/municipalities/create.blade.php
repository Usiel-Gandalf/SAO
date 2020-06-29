@extends('plantillas.adminApp')
@section('main')
<div class="row justify-content-md-center">
    <div class="col-7">
        <div class="col table-bordered mt-5">
            <div class="row justify-content-center">
                <h2 class="">Registrar municipio</h2>
            </div>
            <form action="{{url('/municipality')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="id">{{'Clave del municipio'}}</label>
                    <input type="number" class="form-control" name="id" id="id" value="{{old('id')}}">
                </div>
                @error('id')
                <div class="alert alert-danger">
                    Error en la clave, comprobar nuevamente(clave valida, numerico, no vacio).
                </div>
                @enderror

                <div class="form-group">
                    <label for="nameMunicipality">{{'Nombre del municipio'}}</label>
                    <input type="text" class="form-control" name="nameMunicipality" id="nameMunicipality" value="{{old('nameMunicipality')}}">
                </div>
                @error('nameMunicipality')
                <div class="alert alert-danger">
                    Error en el nombre del municipio, comprobar nuevamente(no repetido, no numerico, no vacio).
                </div>
                @enderror

                <div class="form-group">
                    <label for="idRegion"></label>
                    <select id="idRegion" name="idRegion" class="form-control">
                        <option selected>Selecciona la region perteneciente</option>
                        @foreach($regions as $region)
                        <option name="{{$region->id}}" value="{{$region->id}}">{{$region->nameRegion}}</option>
                        @endforeach
                    </select>
                </div>
                @error('idRegion')
                <div class="alert alert-danger">
                    Eliga una region para su municipio
                </div>
                @enderror

                <div class="row justify-content-center">
                    <input type="submit" class="btn btn-success mr-1" value="Registrar">
                    <a href="{{url('/municipality')}}" class="btn btn-primary">Regresar</a>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>
@endsection