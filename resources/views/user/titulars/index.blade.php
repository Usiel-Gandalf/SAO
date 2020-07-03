@extends('plantillas.adminApp')
@section('main')
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

<div class="container table-bordered mt-2">
    <div class="row">
        @if(session('saveTitular'))
        <div class="row justify-content-center">
            <div class="alert alert-success">
                {{session('saveTitular')}}
            </div>
        </div>
        @endif
        @if(session('deleteTitular'))
        <div class="row justify-content-center">
            <div class="alert alert-danger">
                {{session('deleteTitular')}}
            </div>
        </div>
        @endif
        @if(session('updateTitular'))
        <div class="row justify-content-center">
            <div class="alert alert-primary">
                {{session('updateTitular')}}
            </div>
        </div>
        @endif
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Curp</th>
                    <th scope="col">Nombre del titular</th>
                    <th scope="col">Apellido paterno</th>
                    <th scope="col">Apellido materno</th>
                    <th scope="col">Genero</th>
                    <th scope="col">Fecha de nacimiento</th>
                    <th scope="col">Acciones</th>
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
                    <td>{{'Sin formato'}}</td>
                    <td>
                        <div class="row justify-content-center">
                            <a class="btn btn-primary mr-1" href="{{url('/titular/'.$titular->id.'/edit')}}">Editar</a>
                            <form method="post" action="{{url('/titular/'.$titular->id)}}">
                                @csrf
                                {{method_field('DELETE')}}
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Esta seguro que quiere eliminar el/la titular?');">Borrar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-sm">
            {{ $titulars->links() }}
        </div>
        <div class="col-sm">
            <a class="btn btn-success float-right" href="{{url('/titular/create')}}">Crear Titular</a>
        </div>
    </div>
</div>
@endsection