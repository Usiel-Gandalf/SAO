@extends('plantillas.adminApp')
@section('main')
<div class="container shadow p-3 mb-5 bg-white rounded mt-2">
    @if(Auth::user()->rol == 1)
    <div class="row justify-content-md-center mb-4">
        <h1>Regiones</h1>
    </div>

    <div class="row justify-content-md-center">
        @if(session('notFound'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{session('notFound')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if(session('saveRegion'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('saveRegion')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if(session('deleteRegion'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{session('deleteRegion')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if(session('updateRegion'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong>{{session('updateRegion')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <form action="{{route('searchRegion')}}" method="get" class="form-inline float-right">
                    @csrf
                    <div class="form-group">
                        <input id="id" class="form-control mx-1" type="number" name="id" placeholder="Buscar por clave">
                    </div>
                    <div class="form-group">
                        <input id="numberRegion" class="form-control mx-1" type="number" name="numberRegion" placeholder="Buscar por numero">
                    </div>
                    <div class="form-group">
                        <input id="nameRegion" class="form-control mx-1" type="text" name="nameRegion" placeholder="Buscar por nombre">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Buscar">
                    </div>
                </form>
            </div>
        </div>
    </div>
    @else
    <div class="row justify-content-md-center mb-4">
        <h1>Region asignada</h1>
    </div>
    @endif

    <div class="container mt-2">
        <div class="row">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Clave</th>
                        <th scope="col">Numero</th>
                        <th scope="col">Nombre</th>
                        @if(Auth::user()->rol == 1)
                        <th scope="col" style="width:10%; height:5%">Acciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($regions as $region)
                    <tr>
                        <th scope="row">{{$region->id}}</th>
                        <td>{{$region->region}}</td>
                        <td>{{$region->nameRegion}}</td>
                        @if(Auth::user()->rol == 1)
                        <td class="justify-content-center">
                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Acciones
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item" href="{{url('/region/'.$region->id.'/edit')}}">Editar</a>
                                        <a class="dropdown-item" href="{{url('reportRegion/'.$region->id.'/reportRegion/0')}}">Reporte</a>
                                        <form method="post" action="{{url('/region/'.$region->id)}}">
                                            @csrf
                                            {{method_field('DELETE')}}
                                            <button type="submit" class="dropdown-item" onclick="return confirm('Esta seguro que quiere eliminar la region?');">Borrar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col">
            {{ $regions->links() }}
        </div>
        @if(Auth::user()->rol == 1)
        <div class="col">
            <a class="btn btn-success float-right" href="{{url('/region/create')}}">Crear Region</a>
        </div>
        @endif
    </div>

    @if(Auth::user()->rol == 0)
    @include('user.regions.regionGeneral')
    @endif
</div>
@endsection