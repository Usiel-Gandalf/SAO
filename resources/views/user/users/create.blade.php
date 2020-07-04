@extends('plantillas.adminApp')

@section('main')
<div class="row justify-content-md-center">
    <div class="col-7 mt-5">
        <div class="col table-bordered">
            <div class="row justify-content-center">
                <h2 class="mt-1">Registrar Usuario</h2>
            </div>
            <form action="{{url('/user')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">{{'Nombre'}}</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}">
                    @error('name')
                    <div class="alert alert-danger">
                        Error en el nombre, comprobar nuevamente(nombre valido, no numeros, no vacio).
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="firstSurname">{{'Apellido Paterno'}}</label>
                    <input type="text" class="form-control" name="firstSurname" id="firstSurname" value="{{old('firstSurname')}}">
                    @error('firstSurname')
                    <div class="alert alert-danger">
                        Error en el primer apellido, comprobar nuevamente(nombre valido, no numeros, no vacio).
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="secondSurname">{{'Apellido Materno'}}</label>
                    <input type="text" class="form-control" name="secondSurname" id="secondSurname" value="{{old('secondSurname')}}">
                    @error('secondSurname')
                    <div class="alert alert-danger">
                        Error en el segundo apellido, comprobar nuevamente(nombre valido, no numeros, no vacio).
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">{{'Escibre el correo electronico del usuario'}}</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}">
                    @error('email')
                    <div class="alert alert-danger">
                        Error en el email, comprobar nuevamente(correo valido, no vacio, sintaxis valida).
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="rol"></label>
                    <select id="rol" name="rol" class="form-control">
                        <option selected>Selecciona el tipo de usuario</option>
                        <option value="1">Administrador</option>
                        <option  value="0">Jefe Juar</option>
                    </select>
                    @error('rol')
                    <div class="alert alert-danger">
                        Seleccione un rol para el usuario.
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">{{'Escibre una contraseña temporal para el usuario'}}</label>
                    <input type="password" class="form-control" name="password" id="password" value="">
                    @error('password')
                    <div class="alert alert-danger">
                        Algo ha salido mal con la contraseña, revisa nuevamente(minima 8, confirmacion)
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">{{'Confirma la contraseña'}}</label>
                    <input type="password_confirmation" class="form-control" name="password_confirmation" id="password_confirmation" value="">
                </div>

                <div class="row justify-content-center">
                    <input type="submit" class="btn btn-success mr-1" value="Registrar">
                    <a href="{{url('/user')}}" class="btn btn-primary">Regresar</a>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>
@endsection