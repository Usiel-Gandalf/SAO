@extends('plantillas.adminApp')
@section('main')
<div class="row justify-content-md-center">
    <div class="col-7 shadow p-3 mb-5 bg-white rounded mt-4">
        <div class="col border border-secondary">
            <div class="row justify-content-center">
                <h2 class="">Editar municipio</h2>
            </div>
            <form action="{{url('/municipality/'.$municipality->id)}}" method="post">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="id">{{'Clave del municipio'}}</label>
                    <input type="number" class="form-control" name="id" id="id" value="{{$municipality->id}}">
                </div>
                @error('id')
                <div class="alert alert-danger">
                    Error en la clave, comprobar nuevamente(clave valida, numerico, no vacio).
                </div>
                @enderror

                <div class="form-group">
                    <label for="nameMunicipality">{{'Nombre del municipio'}}</label>
                    <input type="text" class="form-control" name="nameMunicipality" id="nameMunicipality" value="{{$municipality->nameMunicipality}}">
                </div>
                @error('nameMunicipality')
                <div class="alert alert-danger">
                    Error en el nombre del municipio, comprobar nuevamente(no repetido, no numerico, no vacio).
                </div>
                @enderror

                <div class="form-group">
                    <label for="region_id">{{'Region: '}}</label>
                    <select id="region_id" name="region_id" class="form-control">
                        <option selected>Selecciona la region perteneciente</option>
                        @foreach($regions as $region)
                        @if($region->id == $municipality->region_id)
                        <option name="{{$region->id}}" value="{{$region->id}}" selected>{{$region->nameRegion}}</option>
                        @endif
                        @if($region->id !== $municipality->region_id)
                        <option name="{{$region->id}}" value="{{$region->id}}">{{$region->nameRegion}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                @error('region_id')
                <div class="alert alert-danger">
                    Comprobar la region
                </div>
                @enderror

                <div class="row justify-content-center">
                    <input type="submit" class="btn btn-success mr-1" value="Editar">
                    <a href="{{url('/municipality')}}" class="btn btn-primary">Regresar</a>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>
@endsection