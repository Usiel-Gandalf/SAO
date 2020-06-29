@extends('plantillas.adminApp')
@section('main')
<div class="row justify-content-md-center">
    <div class="col-7">
        <div class="col table-bordered mt-5">
            <div class="row justify-content-center mt-1">
                <h2 class="">Registrar Escuela</h2>
            </div>
            <form action="{{url('/school')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="idSchool">{{'Clave de la escuela'}}</label>
                    <input type="text" class="form-control" name="idSchool" id="idSchool" value="{{old('idSchool')}}">
                </div>
                @error('id')
                <div class="alert alert-danger">
                    Error en la clave, comprobar nuevamente(clave valida, numerico, no vacio).
                </div>
                @enderror

                <div class="form-group">
                    <label for="nameMunicipality">{{'Nombre de la localidad'}}</label>
                    <input type="text" class="form-control" name="nameSchool" id="nameSchool" value="{{old('nameSchool')}}">
                </div>
                @error('nameSchool')
                <div class="alert alert-danger">
                    Error en el nombre de la escuela, revisar nuevamente, (nombre valido, no vacio, no numerico)
                </div>
                @enderror

                <div class="form-group">
                    <label for="idLocality">{{'Localidad: '}}</label>
                    <select id="idLocality" name="idLocality" class="form-control">
                        <option selected>Selecciona la localidad perteneciente</option>
                        @foreach($localities as $locality)
                        <option name="{{$locality->id}}" value="{{$locality->id}}">{{$locality->nameLocality}}</option>
                        @endforeach
                    </select>
                </div>
                @error('idLocality')
                <div class="alert alert-danger">
                    Seleccione un localidad
                </div>
                @enderror

                <div class="row justify-content-center">
                    <input type="submit" class="btn btn-success mr-1" value="Registrar">
                    <a href="{{url('/school')}}" class="btn btn-primary">Regresar</a>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>
@endsection