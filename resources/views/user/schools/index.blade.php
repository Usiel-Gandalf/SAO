@extends('plantillas.adminApp')
@section('main')
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

<div class="container table-bordered mt-2">
    <div class="row">
        @if(session('saveSchool'))
        <div class="row justify-content-center">
            <div class="alert alert-success">
                {{session('saveSchool')}}
            </div>
        </div>
        @endif
        @if(session('deleteSchool'))
        <div class="row justify-content-center">
            <div class="alert alert-danger">
                {{session('deleteSchool')}}
            </div>
        </div>
        @endif
        @if(session('updateSchool'))
        <div class="row justify-content-center">
            <div class="alert alert-primary">
                {{session('updateSchool')}}
            </div>
        </div>
        @endif
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Clave</th>
                    <th scope="col">Nombre de la escuela</th>
                    <th scope="col">localidad</th>
                    @if(Auth::user()->rol == 1)
                    <th scope="col">Acciones</th>
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
                    <td>
                        <div class="row justify-content-center">
                            <a class="btn btn-primary mr-1" href="{{url('/school/'.$school->id.'/edit')}}">Editar</a>
                            <form method="post" action="{{url('/school/'.$school->id)}}">
                                @csrf
                                {{method_field('DELETE')}}
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Esta seguro que quiere eliminar la escuela?');">Borrar</button>
                            </form>
                        </div>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>

        </table>
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