@extends('plantillas.adminApp')
@section('main')
<div class="container shadow p-3 mb-5 bg-white rounded mt-5">
    <div class="row justify-content-md-center">
        <!-- endImportBasic -->
        <div class="col-8 mt-5">
            <div class="card text-center shadow-lg p-3 mb-5 bg-white rounded border-primary">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('adminProfile')}}">PERFIL</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('editAdminProfile')}}">ACTUALIZAR PERFIL</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('editAdminPassword')}}" tabindex="-1" aria-disabled="true">CAMBIAR CONTRASEÑA</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('editAdminEmail')}}" tabindex="-1" aria-disabled="true">CAMBIAR CORREO</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    @if(session('notEmail'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('notEmail')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <h4 class="card-title">ACTUALIZAR PERFIL</h4>
                    <div class="container border-danger">
                        <form action="{{url('/editAdminProfile/'.$admin->id.'/updateAdminProfile')}}" method="post" enctype="multipart/form-data" class="">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">{{'Nombre'}}</label>
                                        <input type="text" class="form-control" name="name" id="name" value="{{$admin->name}}">
                                        @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="firstSurname">{{'Apellido Paterno'}}</label>
                                        <input type="text" class="form-control" name="firstSurname" id="firstSurname" value="{{$admin->firstSurname}}">
                                        @error('firstSurname')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="secondSurname">{{'Apellido Materno'}}</label>
                                        <input type="text" class="form-control" name="secondSurname" id="secondSurname" value="{{$admin->secondSurname}}">
                                        @error('secondSurname')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email">{{'Correo electronico'}}</label>
                                        <input type="email" class="form-control" name="email" id="email" value="{{$admin->email}}">
                                        @error('email')
                                        <p class="text-danger">{{ $message }}</p>
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