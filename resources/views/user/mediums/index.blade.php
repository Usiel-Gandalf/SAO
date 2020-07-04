@extends('plantillas.adminApp')
@section('main')

<div class="row justify-content-md-center mb-4">
    <h1>EDUCACION MEDIA SUPERIOR</h1>
</div>
@if(session('saveMedium'))
<div class="row justify-content-center">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <h5><strong>{{session('saveMedium')}}</strong></h5>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif
@if(session('updateMedium'))
<div class="row justify-content-center">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <h5><strong>{{session('updateMedium')}}</strong></h5>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif
@if(session('deleteMedium'))
<div class="row justify-content-center">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h5><strong>{{session('deleteMedium')}}</strong></h5>
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
                @foreach($mediums as $medium)
                <tr>
                    <th scope="row">
                        @if($medium->bimester == 1)
                        {{'Enero-Febrero'}}
                        @elseif($medium->bimester == 2)
                        {{'Marzo-Abril'}}
                        @elseif($medium->bimester == 3)
                        {{'Mayo-Junio'}}
                        @elseif($medium->bimester == 4)
                        {{'Septiembre-Octubre'}}
                        @elseif($medium->bimester == 5)
                        {{'Noviembre-Diciembre'}}
                        @endif
                    </th>
                    <td>{{$medium->consignment}}</td>
                    <td>{{$medium->school->nameSchool}}</td>
                    <td>{{$medium->scholar_id}}</td>
                    <td>
                        @if($medium->status == 0)
                        {{'Pendiente'}}
                        @elseif($medium->status == 1)
                        {{'Entregado'}}
                        @elseif($medium->status == 2)
                        {{'No Entregado | No localizado'}}
                        @elseif($medium->status == 3)
                        {{'no entregado por baja'}}
                        @elseif($medium->status == 4)
                        {{'Reexpedicion'}}
                        @endif
                    </td>
                    @if(Auth::user()->rol == 1)
                    <td>
                        <div class="row justify-content-center">
                            <a class="btn btn-primary mr-1" href="{{url('/mediumEducation/'.$medium->id.'/edit')}}">Editar</a>
                            <form method="post" action="{{url('/mediumEducation/'.$medium->id)}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Esta seguro que quiere eliminar el registro?');">Eliminar</button>
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
            {{ $mediums->links() }}
        </div>
        @if(Auth::user()->rol == 1)
        <div class="col foat-right">
            <a class="btn btn-success float-right" href="{{url('/mediumEducation/create')}}">Crear Registro</a>
        </div>
        @endif
    </div>
</div>
@include('user.mediums.mediumDelivery.mediumDeliveryGeneral')
@endsection