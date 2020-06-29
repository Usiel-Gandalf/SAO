@extends('plantillas.adminApp')
@section('main')
<div class="row justify-content-md-center mb-4">
    <h1>Becarios</h1>
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
            <form action="{{route('searchScholar')}}" method="get" class="form-inline float-right">
                @csrf
                <div class="form-group">
                    <input id="id" class="form-control mx-1" type="text" name="id" placeholder="Buscar por clave">
                </div>
                <div class="form-group">
                    <input id="nameScholar" class="form-control mx-1" type="text" name="nameScholar" placeholder="Buscar por nombre">
                </div>
                <div class="form-group">
                    <input id="firstSurnameScholar" class="form-control mx-1" type="text" name="firstSurnameScholar" placeholder="Primer apellido">
                </div>
                <div class="form-group">
                    <input id="secondSurnameScholar" class="form-control mx-1" type="text" name="secondSurnameScholar" placeholder="Segundo apellido">
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
        @if(session('saveScholar'))
        <div class="row justify-content-center">
            <div class="alert alert-success">
                {{session('saveScholar')}}
            </div>
        </div>
        @endif
        @if(session('deleteScholar'))
        <div class="row justify-content-center">
            <div class="alert alert-danger">
                {{session('deleteScholar')}}
            </div>
        </div>
        @endif
        @if(session('updateScholar'))
        <div class="row justify-content-center">
            <div class="alert alert-primary">
                {{session('updateScholar')}}
            </div>
        </div>
        @endif
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Curp</th>
                    <th scope="col">Nombre del alumno</th>
                    <th scope="col">Apellido paterno</th>
                    <th scope="col">Apellido materno</th>
                    <th scope="col">Genero</th>
                    <th scope="col">Fecha de nacimiento</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($scholars as $scholar)
                <tr>
                    <th scope="row">{{$scholar->curp}}</th>
                    <td>{{$scholar->nameScholar}}</td>
                    <td>{{$scholar->firstSurname}}</td>
                    <td>{{$scholar->secondSurname}}</td>
                    <td>{{$scholar->gender}}</td>
                    <td>{{'Sin formato'}}</td>
                    <td>
                        <div class="row justify-content-center mx-1">
                            <a class="btn btn-primary mr-1" href="{{url('/scholar/'.$scholar->id.'/edit')}}">Editar</a>
                            <form method="post" action="{{url('/scholar/'.$scholar->id)}}">
                                @csrf
                                {{method_field('DELETE')}}
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Esta seguro que quiere eliminar la escuela?');">Borrar</button>
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
            {{ $scholars->links() }}
        </div>
        <div class="col-sm">
            <a class="btn btn-success float-right" href="{{url('/scholar/create')}}">Crear Becario</a>
        </div>
    </div>
</div>


    @endsection