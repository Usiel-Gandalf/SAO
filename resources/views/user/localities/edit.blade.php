@extends('plantillas.adminApp')
@section('main')
<div class="row justify-content-md-center">
    <div class="col-7">
        <div class="col table-bordered mt-5">
            <div class="row justify-content-center">
                <h2 class="mt-1">Editar localidad</h2>
            </div>
            <form action="{{url('/locality/'.$locality->id)}}" method="post">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="id">{{'Clave de la localidad'}}</label>
                    <input type="number" class="form-control" name="id" id="id" value="{{$locality->id}}">
                </div>
                @error('id')
                <div class="alert alert-danger">
                    Error en la clave, comprobar nuevamente(clave valida, numerico, no vacio).
                </div>
                @enderror

                <div class="form-group">
                    <label for="keyLocality">{{'Numero de la localidad'}}</label>
                    <input type="number" class="form-control" name="keyLocality" id="keyLocality" value="{{$locality->keyLocality}}">
                </div>
                @error('keyLocality')
                <div class="alert alert-danger">
                    Error en la clave de la localidad, revisar nuevamente(numerico, no vacio).
                </div>
                @enderror

                <div class="form-group">
                    <label for="nameLocality">{{'Nombre de la localidad'}}</label>
                    <input type="text" class="form-control" name="nameLocality" id="nameLocality" value="{{$locality->nameLocality}}">
                </div>
                @error('nameLocality')
                <div class="alert alert-danger">
                    Error en el nombre de la localidad, revisar nuevamente, (nombre valido, no vacio, no numerico)
                </div>
                @enderror

                <div class="form-group">
                    <label for="municipality_id">{{'Municipio: '}}</label>
                    <select id="municipality_id" name="municipality_id" class="form-control">
                        <option selected>Selecciona el municipio perteneciente</option>
                        @foreach($municipalities as $municipality)
                        @if($municipality->id == $locality->municipality_id)
                        <option name="{{$municipality->id}}" value="{{$municipality->id}}" selected>{{$municipality->nameMunicipality}}</option>
                        @elseif($municipality->id !== $locality->municipality_id)
                        <option name="{{$municipality->id}}" value="{{$municipality->id}}">{{$municipality->nameMunicipality}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                @error('idMunicipality')
                <div class="alert alert-danger">
                    Seleccione un municipio
                </div>
                @enderror

                <div class="row justify-content-center">
                    <input type="submit" class="btn btn-success mr-1" value="Editar">
                    <a href="{{url('/locality')}}" class="btn btn-primary">Regresar</a>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>
@endsection