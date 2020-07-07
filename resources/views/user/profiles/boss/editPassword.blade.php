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
                            <a class="nav-link active" href="{{route('editBossPassword')}}" tabindex="-1" aria-disabled="true">CAMBIAR CONTRASEÑA</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('editBossEmail')}}" tabindex="-1" aria-disabled="true">CAMBIAR CORREO</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <h4 class="card-title">ACTUALIZAR CONTRASEÑA</h4>
                    <div class="container border-danger">
                        <form action="{{url('/editBossPassword/'.$idBoss.'/updateBossPassword')}}" method="post" enctype="multipart/form-data" class="">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="password">{{'Contraseña'}}</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Ingresar la nueva contraseña">
                                        @error('password')
                                        <label for="email" class="text-danger">
                                            Error en el nuevo password(minimo 8 caracteres), Asegurese de escribir correctamente las dos contraseñas
                                        </label @enderror </div> <div class="form-group">
                                        <label for="password_confirmation">{{'Confirmar nueva contraseña'}}</label>
                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confrimar la nueva contraseña">
                                        @error('password_confirmation')
                                        <div class="alert alert-danger">
                                            Error en el primer apellido, comprobar nuevamente(nombre valido, no numeros, no vacio).
                                        </div>
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