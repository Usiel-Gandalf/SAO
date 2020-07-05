@extends('plantillas.adminApp')
@section('main')
<div class="main shadow p-3 mb-5 bg-white rounded mt-5">
    <div class="row justify-content-md-center mb-4">
        <h1>Localidades</h1>
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
        @if(session('saveLocality'))
        <div class="row justify-content-center">
            <div class="alert alert-success">
                {{session('saveLocality')}}
            </div>
        </div>
        @endif
        @if(session('deleteLocality'))
        <div class="row justify-content-center">
            <div class="alert alert-danger">
                {{session('deleteLocality')}}
            </div>
        </div>
        @endif
        @if(session('updateLocality'))
        <div class="row justify-content-center">
            <div class="alert alert-primary">
                {{session('updateLocality')}}
            </div>
        </div>
        @endif
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <form action="{{route('searchLocality')}}" method="get" class="form-inline float-right">
                    @csrf
                    <div class="form-group">
                        <input id="id" class="form-control mx-1" type="number" name="id" placeholder="Buscar por clave">
                    </div>
                    <div class="form-group">
                        <input id="numberLocality" class="form-control mx-1" type="number" name="numberLocality" placeholder="Buscar por numero">
                    </div>
                    <div class="form-group">
                        <input id="nameLocality" class="form-control mx-1" type="text" name="nameLocality" placeholder="Buscar por nombre">
                    </div>
                    <div class="form-group">
                        <input id="idMunicipality" class="form-control mx-1" type="number" name="idMunicipality" placeholder="Buscar por municipio">
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
                        <th scope="col">Numero</th>
                        <th scope="col">Nombre de la localidad</th>
                        <th scope="col">Municipio</th>
                        @if(Auth::user()->rol == 1)
                        <th scope="col">Acciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($localities as $locality)
                    <tr>
                        <th scope="row">{{$locality->id}}</th>
                        <td>{{$locality->keyLocality}}</td>
                        <td>{{$locality->nameLocality}}</td>
                        <td>{{$locality->municipality->nameMunicipality}}</td>
                        @if(Auth::user()->rol == 1)
                        <td>
                            <div class="row justify-content-center">
                                <a class="btn btn-primary mr-1" href="{{url('/locality/'.$locality->id.'/edit')}}">Editar</a>
                                <form method="post" action="{{url('/locality/'.$locality->id)}}">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Esta seguro que quiere eliminar la localidad?');">Borrar</button>
                                </form>
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
            {{ $localities->links() }}
        </div>
        @if(Auth::user()->rol == 1)
        <div class="col-sm">
            <a class="btn btn-success float-right" href="{{url('/locality/create')}}">Crear Localidad</a>
        </div>
        @endif
    </div>
</div>
@endsection