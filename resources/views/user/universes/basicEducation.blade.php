@extends('plantillas.adminApp')
@section('main')

<div class="row justify-content-md-center mb-4">
    <h1>Educacion basica</h1>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="page-header float-right">
            <a class="btn btn-primary " href="{{route('basicReport')}}">Generar reporte</a>
        </div>
    </div>
</div>

<div class="container table-bordered mt-2">
    <div class="row">
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
                    <th scope="col">Remesa</th>
                    <th scope="col">localidad</th>
                    <th scope="col">Titular</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @if(count($basicEducation) == 0)
                <div class="alert alert-danger">
                    No se encontraron resultados
                </div>
                @endif
                @foreach($basicEducation as $basic)
                <tr>
                    <th scope="row">{{$basic->id}}</th>
                    <td>{{$basic->consignment}}</td>
                    <td>{{ $basic->locality->nameLocality }}</td>
                    <td>{{$basic->titular_id}}</td>
                    <td>
                        @if($basic->status == 0)
                        {{'Pendiente'}}
                        @elseif($basic->status == 1)
                        {{'Entregado'}}
                        @elseif($basic->status == 2)
                        {{'No Entregado | No localizado'}}
                        @elseif($basic->status == 3)
                        {{'no entregado por baja'}}
                        @endif</td>
                    <td>
                        <div class="row justify-content-center">
                            <a class="btn btn-primary mr-1" href="">Editar</a>
                            <form method="post" action="">
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
        <div class="col">
            {{ $basicEducation->links() }}
        </div>
        <div class="col foat-right">
            <a class="btn btn-success float-right" href="{{url('/school/create')}}">Crear Escuela</a>
        </div>
    </div>
</div>
@endsection