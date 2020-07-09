@extends('plantillas.adminApp')
@section('main')
<div class="container shadow p-3 mb-5 bg-white rounded mt-1">
    <div class="container shadow p-3 mb-5 bg-white rounded border border-success">
        <div class="row justify-content-md-center mb-4">
            <h1>EDUCACION MEDIA SUPERIOR</h1>
        </div>

        <div class="row justify-content-md-center">
            @if(session('saveMedium'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <h5><strong>{{session('saveMedium')}}</strong></h5>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(session('updateMedium'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <h5><strong>{{session('updateMedium')}}</strong></h5>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(session('deleteMedium'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h5><strong>{{session('deleteMedium')}}</strong></h5>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(session('notFound'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{session('notFound')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
        </div>

        <div class="container mt-2">
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
                            <th scope="col" style="width:10%; height:5%">Acciones</th>
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
                            <td class="justify-content-center">
                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Acciones
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <a class="dropdown-item" href="{{url('/mediumEducation/'.$medium->id.'/edit')}}">Editar</a>

                                            <form method="post" action="{{url('/mediumEducation/'.$medium->id)}}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item" onclick="return confirm('Esta seguro que quiere eliminar el registro?');">Eliminar</button>
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
                {{ $mediums->links() }}
            </div>
            @if(Auth::user()->rol == 1)
            <div class="col foat-right">
                <a class="btn btn-success float-right" href="{{url('/mediumEducation/create')}}">Crear Registro</a>
            </div>
            @endif
        </div>
    </div>

    <div class="container shadow p-3 mb-5 bg-white rounded mt-1 border border-success">
        @include('user.mediums.mediumDeliveryGeneral')

        <div class="row">
            <div class="col foat-right">
            <a class="btn btn-success float-right" href="{{url('mediumPdf')}}" target="_blank">PDF</a>
            </div>
        </div>
    </div>


</div>
@endsection