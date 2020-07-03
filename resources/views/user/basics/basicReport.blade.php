@extends('plantillas.adminApp')
@section('main')
<div class="main mb-7">
    <div class="row justify-content-md-center mb-4">
        <h1>Reporte: Educacion basica</h1>
    </div>
    <div class="row justify-content-md-center mb-4">
        @if(session('alertRestrict'))
        <div class="alert alert-danger">
            <h4>{{session('alertRestrict')}}</h4>
        </div>
        @endif
        @if(session('alertConsignment'))
        <div class="alert alert-danger">
            <h4>{{session('alertConsignment')}}</h4>
        </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-12 mt-2">
            <div class="page-header">
                <form action="{{route('basicSearch')}}" method="post" class="form-inline float-right">
                    @csrf
                    @method('POST')
                    <h3 class="mr-3"><span>Buscar por: </span></h3>
                    <div class="form-group">
                        <label for="region"></label>
                        <select id="region" name="region" class="btn btn-secondary mx-1" style="width:200px">
                            <option selected value={{null}}>REGION</option>
                            @foreach($regions as $region)
                            <option value="{{$region->id}}">{{$region->nameRegion}}</option>
                            @endforeach
                        </select>
                        @error('gender')
                        <div class="alert alert-danger">
                            Seleccione un genero para el becario
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="municipality"></label>
                        <select id="municipality" name="municipality" class="btn btn-secondary mx-1" style="width:200px">
                            <option selected value={{null}}>MUNICIPIO</option>
                            @foreach($municipalities as $municipality)
                            <option value="{{$municipality->id}}">{{$municipality->nameMunicipality}}</option>
                            @endforeach
                        </select>
                        @error('gender')
                        <div class="alert alert-danger">
                            Seleccione un genero para el becario
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input id="locality" class="form-control mx-1" type="text" name="locality" placeholder="Buscar por localidad">
                    </div>
                    <div class="form-group">
                        <label for="consignment"></label>
                        <select id="consignment" name="consignment" class="btn btn-secondary mx-1">
                            <option selected value="{{null}}">REMESA</option>
                            <option value="*">Todas</option>
                            @foreach($consignments as $consignment)
                            <option value="{{$consignment->consignment}}">{{$consignment->consignment}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Reporte" placeholder="Reporte">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection