@extends('plantillas.adminApp')
@section('main')
<div class="main shadow p-3 mb-1 bg-white rounded">
    <div class="row justify-content-md-center mt-5">
        <!-- endImportBasic -->
        <div class="col-8">
            <div class="card text-center shadow-lg p-3 mb-5 bg-white rounded border-primary">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('bossProfile')}}">PERFIL</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('editBossProfile')}}">ACTUALIZAR PERFIL</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('editBossPassword')}}" tabindex="-1" aria-disabled="true">CAMBIAR CONTRASEÑA</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('editBossEmail')}}" tabindex="-1" aria-disabled="true">CAMBIAR CORREO</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    @if(session('updateProfileSuccess'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('updateProfileSuccess')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @if(session('updatePasswordSuccess'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('updatePasswordSuccess')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @if(session('updateEmailSuccess'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('updateEmailSuccess')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <h4 class="card-title">PERFIL</h4>
                    <div class="row">
                        <div class="col">
                            <li class="list-group-item">Nombre: {{$boss->name}}</li>
                            <li class="list-group-item">Primer apellido: {{$boss->firstSurname}}</li>
                            <li class="list-group-item">Segundo apellido: {{$boss->secondSurname}}</li>
                        </div>
                        <div class="col">
                            <li class="list-group-item">Correo: {{$boss->email}}</li>
                            <li class="list-group-item">Rol: {{'Jefe'}}</li>
                            <li class="list-group-item">
                                Estado:
                                @if($boss->status == 1)
                                Activo
                                @else
                                Inactivo
                                @endif
                            </li>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <li class="list-group-item">Region asignada: {{$region->nameRegion}}</li>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection