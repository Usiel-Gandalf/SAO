@extends('plantillas.adminApp')

@section('main')
<div class="row justify-content-md-center">
    <div class="col-7 shadow p-3 mb-5 bg-white rounded mt-4">
        <div class="col border border-secondary">
            <div class="row justify-content-center">
                <h2 class="mt-1">Editar Administrador</h2>
            </div>
            <form action="{{url('/admin/'.$admin->id)}}" method="post">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="name">{{'Nombre'}}</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$admin->name}}">
                    @error('name')
                    <div class="alert alert-danger">
                        Error en el nombre, comprobar nuevamente(nombre valido, no numeros, no vacio).
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="firstSurname">{{'Apellido Paterno'}}</label>
                    <input type="text" class="form-control" name="firstSurname" id="firstSurname" value="{{$admin->firstSurname}}">
                    @error('firstSurname')
                    <div class="alert alert-danger">
                        Error en el primer apellido, comprobar nuevamente(nombre valido, no numeros, no vacio).
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="secondSurname">{{'Apellido Materno'}}</label>
                    <input type="text" class="form-control" name="secondSurname" id="secondSurname" value="{{$admin->secondSurname}}">
                    @error('secondSurname')
                    <div class="alert alert-danger">
                        Error en el segundo apellido, comprobar nuevamente(nombre valido, no numeros, no vacio).
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">{{'Correo Electronico'}}</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{$admin->email}}">
                    @error('email')
                    <div class="alert alert-danger">
                        Error en el email, comprobar nuevamente(correo valido, no vacio, sintaxis valida).
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="rol">{{'Rol'}}</label>
                    <select id="rol" name="rol" class="form-control">
                        <option>Tipo de usuario</option>
                        @if($admin->rol == 1)
                        <option name="1" value="1" selected>Administrador</option>
                        <option name="0" value="0">Jefe Juar</option>
                        @elseif($admin->rol == 0)
                        <option name="0" value="0" selected>Jefe Juar</option>
                        <option name="1" value="1">Administrador</option>
                        @endif
                        @error('rol')
                        <div class="alert alert-danger">
                            Seleccione un rol para el usuario.
                        </div>
                        @enderror
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">{{'Estado'}}</label>
                    <select id="status" name="status" class="form-control">
                        <option>Estado</option>
                        @if($admin->status == 1)
                        <option name="1" value="1" selected>Activo</option>
                        <option name="0" value="0">Inactivo</option>
                        @elseif($admin->status == 0)
                        <option name="0" value="0" selected>Inactivo</option>
                        <option name="1" value="1">Activo</option>
                        @endif
                        @error('status')
                        <div class="alert alert-danger">
                            Seleccione un rol para el usuario.
                        </div>
                        @enderror
                    </select>
                </div>

                <div class="row justify-content-center">
                    <input type="submit" class="btn btn-success mr-1" value="Editar">
                    <a href="{{url('/admin')}}" class="btn btn-primary">Regresar</a>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>
@endsection