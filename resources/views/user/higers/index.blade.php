@extends('plantillas.adminApp')
@section('main')

<div class="row justify-content-md-center mb-4">
    <h1>JOVENES ESCRIBIENDO EL FUTURO</h1>
</div>
@if(session('saveHiger'))
<div class="row justify-content-center">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <h5><strong>{{session('saveHiger')}}</strong></h5>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif
@if(session('updateHiger'))
<div class="row justify-content-center">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <h5><strong>{{session('saveHiger')}}</strong></h5>
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

<div class="container table-bordered mt-2">
    <div class="row">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Bimestre</th>
                    <th scope="col">Remesa</th>
                    <th scope="col">localidad</th>
                    <th scope="col">Becario</th>
                    <th scope="col">Estado</th>
                    @if(Auth::user()->rol == 1)
                    <th scope="col">Acciones</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($higers as $higer)
                <tr>
                    <th scope="row">
                        @if($higer->bimester == 1)
                        {{'Enero-Febrero'}}
                        @elseif($higer->bimester == 2)
                        {{'Marzo-Abril'}}
                        @elseif($higer->bimester == 3)
                        {{'Mayo-Junio'}}
                        @elseif($higer->bimester == 4)
                        {{'Septiembre-Octubre'}}
                        @elseif($higer->bimester == 5)
                        {{'Noviembre-Diciembre'}}
                        @endif
                    </th>
                    <td>{{$higer->consignment}}</td>
                    <td>{{$higer->school->nameSchool}}</td>
                    <td>{{$higer->scholar_id}}</td>
                    <td>
                        @if($higer->status == 0)
                        {{'Pendiente'}}
                        @elseif($higer->status == 1)
                        {{'Entregado'}}
                        @elseif($higer->status == 2)
                        {{'No Entregado | No localizado'}}
                        @elseif($higer->status == 3)
                        {{'no entregado por baja'}}
                        @endif
                    </td>
                    @if(Auth::user()->rol == 1)
                    <td>
                        <div class="row justify-content-center">
                            <a class="btn btn-primary mr-1" href="{{url('/higerEducation/'.$higer->id.'/edit')}}">Editar</a>
                            <form method="post" action="">
                                @csrf
                                {{method_field('DELETE')}}
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Esta seguro que quiere eliminar la escuela?');">Eliminar</button>
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
            {{ $higers->links() }}
        </div>
        @if(Auth::user()->rol == 1)
        <div class="col foat-right">
            <a class="btn btn-success float-right" href="{{url('/higerEducation/create')}}">Crear Escuela</a>
        </div>
        @endif
    </div>
</div>
@include('user.higers.higerCerm.higerCermGeneral')
@endsection