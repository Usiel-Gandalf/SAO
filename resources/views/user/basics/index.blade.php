@extends('plantillas.adminApp')
@section('main')
<div class="container shadow p-3 mb-5 bg-white rounded mt-1">
    <div class="container shadow p-3 mb-5 bg-white rounded border border-success">
        <div class="row justify-content-md-center mb-4">
            <h1>EDUCACION BASICA</h1>
        </div>

        <div class="row justify-content-md-center">
            @if(session('saveBasic'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <h5><strong>{{session('saveBasic')}}</strong></h5>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(session('updateBasic'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <h5><strong>{{session('saveBasic')}}</strong></h5>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(session('deleteBasic'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h5><strong>{{session('deleteBasic')}}</strong></h5>
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
                            <th scope="col">Titular</th>
                            <th scope="col">Estado</th>
                            @if(Auth::user()->rol == 1)
                            <th scope="col" style="width:10%; height:5%">Acciones</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($basics as $basic)
                        <tr>
                            <th scope="row">
                                @if($basic->bimester == 1)
                                {{'Enero-Febrero'}}
                                @elseif($basic->bimester == 2)
                                {{'Marzo-Abril'}}
                                @elseif($basic->bimester == 3)
                                {{'Mayo-Junio'}}
                                @elseif($basic->bimester == 4)
                                {{'Septiembre-Octubre'}}
                                @elseif($basic->bimester == 5)
                                {{'Noviembre-Diciembre'}}
                                @endif
                            </th>
                            <td>{{$basic->consignment}}</td>
                            <td>{{$basic->locality->nameLocality}}</td>
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
                            @if(Auth::user()->rol == 1)
                            <td class="justify-content-center">
                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Acciones
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <a class="dropdown-item" href="{{url('/basicEducation/'.$basic->id.'/edit')}}">Editar</a>

                                            <form method="post" action="{{url('/basicEducation/'.$basic->id)}}">
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
                {{ $basics->links() }}
            </div>
            @if(Auth::user()->rol == 1)
            <div class="col foat-right">
                <a class="btn btn-success float-right" href="{{url('/basicEducation/create')}}">Crear Registro</a>
            </div>
            @endif
        </div>
    </div>

    <div class="container shadow p-3 mb-5 bg-white rounded mt-5 border border-success">
        @include('user.basics.basicCermGeneral')
        @include('user.basics.basicDeliveryGeneral')

        <div class="row">
            <div class="col foat-right">
                <a class="btn btn-success float-right" href="{{url('basicPdf')}}" target="_blank">PDF</a>
            </div>
        </div>
    </div>
    
</div>
@endsection