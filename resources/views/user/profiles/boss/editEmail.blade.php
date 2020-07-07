@extends('plantillas.adminApp')
@section('main')
<div class="container shadow p-3 mb-5 bg-white rounded mt-2">
    <div class="row justify-content-md-center">
        <!-- endImportBasic -->
        <div class="col-8 mt-5">
            <div class="card text-center shadow-lg p-3 mb-5 bg-white rounded border-primary">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('bossProfile')}}">PERFIL</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('editBossProfile')}}">ACTUALIZAR PERFIL</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('editBossPassword')}}" tabindex="-1" aria-disabled="true">CAMBIAR CONTRASEÑA</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('editBossEmail')}}" tabindex="-1" aria-disabled="true">CAMBIAR CORREO</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    @if(session('emailUnique'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{session('emailUnique')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <h4 class="card-title">ACTUALIZAR CORREO ELECTRONICO</h4>
                    <h6 class="card-title">Correo electronico actual: {{$boss->email}}</h6>
                    <div class="container border-danger">
                        <form action="{{url('/editBossEmail/'.$boss->id.'/updateBossEmail')}}" method="post" enctype="multipart/form-data" class="">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="email">{{'Correo electronico'}}</label>
                                        <input type="mail" class="form-control" name="email" id="email" placeholder="Ingresar el nuevo correo electronico">
                                        @error('email')
                                        <label for="email" class="text-danger">
                                            Error en el nuevo correo, verificar nuevamente
                                        </label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <input type="submit" class="btn btn-success mr-1" value="Actualizar">
                            </div>
                            <br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection