@extends('plantillas.adminApp')
@section('main')
<div class="container shadow p-3 mb-2 bg-white rounded mt-2">
<div class="container shadow p-3 mb-5 bg-white rounded border border-success">
    <div class="row justify-content-md-center mb-4">
        <h1>Titulares</h1>
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
        @if(session('saveTitular'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('saveTitular')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if(session('deleteTitular'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{session('deleteTitular')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if(session('updateTitular'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong>{{session('updateTitular')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <form action="{{route('searchTitular')}}" method="get" class="form-inline float-right">
                    @csrf
                    <div class="form-group">
                        <input id="id" class="form-control mx-1" type="text" name="id" placeholder="Buscar por clave">
                    </div>
                    <div class="form-group">
                        <input id="nameTitular" class="form-control mx-1" type="text" name="nameTitular" placeholder="Buscar por nombre">
                    </div>
                    <div class="form-group">
                        <input id="firstSurnameTitular" class="form-control mx-1" type="text" name="firstSurnameTitular" placeholder="Primer apellido">
                    </div>
                    <div class="form-group">
                        <input id="secondSurnameTitular" class="form-control mx-1" type="text" name="secondSurnameTitular" placeholder="Segundo apellido">
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
                        <th scope="col">Curp</th>
                        <th scope="col">Nombre del titular</th>
                        <th scope="col">Apellido paterno</th>
                        <th scope="col">Apellido materno</th>
                        <th scope="col">Genero</th>
                        @if(Auth::user()->rol == 1)
                        <th scope="col" style="width:10%; height:5%">Acciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($titulars as $titular)
                    <tr>
                        <th scope="row">@if($titular->curp == null)
                            {{'Sin curp definida'}}
                            @else
                            {{$titular->curp}}
                            @endif
                        </th>
                        <td>{{$titular->nameTitular}}</td>
                        <td>{{$titular->firstSurname}}</td>
                        <td>{{$titular->secondSurname}}</td>
                        <td>{{$titular->gender}}</td>
                        @if(Auth::user()->rol == 1)
                        <td class="justify-content-center">
                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Acciones
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item" href="{{url('/titular/'.$titular->id.'/edit')}}">Editar</a>
                                        <a class="dropdown-item" href="">Historial</a>

                                        <form method="post" action="{{url('/titular/'.$titular->id)}}">
                                            @csrf
                                            {{method_field('DELETE')}}
                                            <button type="submit" class="dropdown-item" onclick="return confirm('Esta seguro que quiere eliminar el/la titular?');">Borrar</button>
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
            {{ $titulars->links() }}
        </div>
        @if(Auth::user()->rol == 1)
        <div class="col-sm">
            <a class="btn btn-success float-right" href="{{url('/titular/create')}}">Crear Titular</a>
        </div>
        @endif
    </div>
</div>
</div>
@endsection