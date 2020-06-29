@extends('plantillas.adminApp')
@section('main')

<div class="row justify-content-md-center mb-4">
    <h1>Educacion basica</h1>
</div>
@if(session('saveBasic'))
<div class="row justify-content-center">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <h5><strong>{{session('saveBasic')}}</strong></h5>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif
@if(session('updateBasic'))
<div class="row justify-content-center">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <h5><strong>{{session('saveBasic')}}</strong></h5>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif
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
            <form action="{{route('searchBasic')}}" method="get" class="form-inline float-right">
                @csrf
                <div class="form-group">
                    <input id="consignment" class="form-control mx-1" type="text" name="consignment" placeholder="Remesa">
                </div>
                <div class="form-group">
                    <input id="status" class="form-control mx-1" type="number" name="status" placeholder="Estado de cobro">
                </div>
                <div class="form-group">
                    <select id="bimester" name="bimester" class="form-control">
                        <option selected value="{{null}}">Bimestre</option>
                        <option name="1" value="1">Enero-Febrero</option>
                        <option name="2" value="2">Marzo-Abril</option>
                        <option name="3" value="3">Mayo-Junio</option>
                        <option name="4" value="4">Septiembre-Octubre</option>
                        <option name="5" value="5">Noviembre-Diciembre</option>
                    </select>
                </div>
                <div class="form-group">
                    <input id="titular_id" class="form-control mx-1" type="number" name="titular_id" placeholder="Titular">
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
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Bimestre</th>
                    <th scope="col">Remesa</th>
                    <th scope="col">localidad</th>
                    <th scope="col">Titular</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($basics as $basic)
                <tr>
                    <th scope="row">
                        @if($basic->bimester = 1)
                        {{'Enero-Febrero'}}
                        @elseif($basic->status = 2)
                        {{'Marzo-Abril'}}
                        @elseif($basic->status = 3)
                        {{'Mayo-Junio'}}
                        @elseif($basic->status = 4)
                        {{'Septiembre-Octubre'}}
                        @elseif($basic->status = 5)
                        {{'Noviembre-Diciembre'}}
                        @endif
                    </th>
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
                        @endif
                    </td>
                    <td>
                        <div class="row justify-content-center">
                            <a class="btn btn-primary mr-1" href="{{url('/basicEducation/'.$basic->id.'/edit')}}">Editar</a>
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
            {{ $basics->links() }}
        </div>
        <div class="col foat-right">
            <a class="btn btn-success float-right" href="{{url('/basicEducation/create')}}">Crear Escuela</a>
        </div>
    </div>
</div>
@endsection