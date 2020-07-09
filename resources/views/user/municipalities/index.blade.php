@extends('plantillas.adminApp')
@section('main')
@if(Auth::user()->rol == 1)
<div class="container shadow p-3 mb-5 bg-white rounded mt-1">
    <div class="container shadow p-3 mb-5 bg-white rounded border border-success">
        <div class="row justify-content-md-center mb-4">
            <h1>Municipios</h1>
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
            @if(session('saveMunicipality'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{session('saveMunicipality')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(session('deleteMunicipality'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{session('deleteMunicipality')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(session('updateMunicipality'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <strong>{{session('updateMunicipality')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <form action="{{route('searchMunicipality')}}" method="get" class="form-inline float-right">
                        @csrf
                        <div class="form-group">
                            <input id="id" class="form-control mx-1" type="number" name="id" placeholder="Buscar por ID">
                        </div>
                        <div class="form-group">
                            <input id="nameMunicipality" class="form-control mx-1" type="text" name="nameMunicipality" placeholder="Buscar por nombre">
                        </div>
                        <div class="form-group">
                            <input id="idRegion" class="form-control mx-1" type="text" name="idRegion" placeholder="Buscar por clave de la region">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Buscar">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="container mt-2">
            <div class="row">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Clave</th>
                            <th scope="col">Nombre del municipio</th>
                            <th scope="col">Region</th>
                            <th scope="col" style="width:10%; height:5%">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($municipalities as $municipality)
                        <tr>
                            <th scope="row">{{$municipality->id}}</th>
                            <td>{{$municipality->nameMunicipality}}</td>
                            <td>{{$municipality->region->nameRegion}}</td>
                            <td class="justify-content-center">
                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Acciones
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <a class="dropdown-item" href="{{url('/municipality/'.$municipality->id.'/edit')}}">Editar</a>
                                            <a class="dropdown-item" href="{{url('reportMunicipality/'.$municipality->id.'/reportMunicipality/0')}}">Reporte</a>
                                            <form method="post" action="{{url('/municipality/'.$municipality->id)}}">
                                                @csrf
                                                {{method_field('DELETE')}}
                                                <button type="submit" class="dropdown-item" onclick="return confirm('Esta seguro que quiere eliminar el municipio?');">Borrar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-sm">
                {{ $municipalities->links() }}
            </div>
            <div class="col-sm">
                <a class="btn btn-success float-right" href="{{url('/municipality/create')}}">Crear Municipio</a>
            </div>
        </div>
    </div>
</div>
@endif
@endsection