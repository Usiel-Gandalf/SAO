@extends('plantillas.adminApp')
@section('main')
<div class="container shadow p-3 mb-5 bg-white rounded mt-2">
    <div class="row justify-content-md-center mb-4">
        <h1>Escuelas</h1>
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
        @if(session('saveSchool'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('saveSchool')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if(session('deleteSchool'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{session('deleteSchool')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if(session('updateSchool'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong>{{session('updateSchool')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <form action="{{route('searchSchool')}}" method="get" class="form-inline float-right">
                    @csrf
                    <div class="form-group">
                        <input id="id" class="form-control mx-1" type="text" name="id" placeholder="Buscar por clave">
                    </div>
                    <div class="form-group">
                        <input id="nameSchool" class="form-control mx-1" type="text" name="nameSchool" placeholder="Buscar por nombre">
                    </div>
                    <div class="form-group">
                        <input id="idLocality" class="form-control mx-1" type="number" name="idLocalidad" placeholder="Buscar por localidad">
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
                        <th scope="col">Nombre de la escuela</th>
                        <th scope="col">localidad</th>
                        @if(Auth::user()->rol == 1)
                        <th scope="col" style="width:10%; height:5%">Acciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($schools as $school)
                    <tr>
                        <th scope="row">{{$school->id}}</th>
                        <td>{{$school->nameSchool}}</td>
                        <td>{{ $school->locality->nameLocality }}</td>
                        @if(Auth::user()->rol == 1)
                        <td class="justify-content-center">
                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Acciones
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item" href="{{url('/school/'.$school->id.'/edit')}}">Editar</a>
                                        <a class="dropdown-item" href="">Reporte</a>
                                        <form method="post" action="{{url('/school/'.$school->id)}}">
                                            @csrf
                                            {{method_field('DELETE')}}
                                            <button type="submit" class="dropdown-item" onclick="return confirm('Esta seguro que quiere eliminar la escuela?');">Borrar</button>
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
            {{ $schools->links() }}
        </div>
        @if(Auth::user()->rol == 1)
        <div class="col foat-right">
            <a class="btn btn-success float-right" href="{{url('/school/create')}}">Crear Escuela</a>
        </div>
        @endif
    </div>
</div>
@endsection