@extends('plantillas.adminApp')
@section('main')
<div class="container shadow p-3 mb-5 bg-white rounded mt-2">
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
                        @if(Auth::user()->rol == 1)
                        <th scope="col">Acciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($municipalities as $municipio)
                    <tr>
                        <th scope="row">{{$municipio->id}}</th>
                        <td>{{$municipio->nameMunicipality}}</td>
                        <td>{{$municipio->region->nameRegion}}</td>
                        @if(Auth::user()->rol == 1)
                        <td class="justify-content-center">
                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Acciones
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item" href="{{url('/municipality/'.$municipio->id.'/edit')}}">Editar</a>

                                        <form method="post" action="{{url('/municipality/'.$municipio->id)}}">
                                            @csrf
                                            {{method_field('DELETE')}}
                                            <button type="submit" class="dropdown-item" onclick="return confirm('Esta seguro que quiere eliminar el municipio?');">Borrar</button>
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
        <div class="col-sm">
            {{ $municipalities->links() }}
        </div>
        @if(Auth::user()->rol == 1)
        <div class="col-sm">
            <a class="btn btn-success float-right" href="{{url('/municipality/create')}}">Crear Municipio</a>
        </div>
        @endif
    </div>
</div>
@endsection