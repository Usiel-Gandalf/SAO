@extends('plantillas.adminApp')

@section('main')
<div class="row justify-content-center">
    <h2 class="">Registrar usuario</h2>
</div>
<br>
<div class="col table-bordered">
    
<form action="{{url('/user')}}" method="post" enctype="multipart/form-data">
    @csrf
    @error('name')
        <div class="alert alert-danger">
            Error en el nombre, comprobar nuevamente(nombre valido, no numeros, no vacio).
        </div>
    @enderror
    @error('firstLastName')
        <div class="alert alert-danger">
            Error en el primer apellido, comprobar nuevamente(nombre valido, no numeros, no vacio).
        </div>
    @enderror
    @error('secondLastName')
        <div class="alert alert-danger">
            Error en el segundo apellido, comprobar nuevamente(nombre valido, no numeros, no vacio).
        </div>
    @enderror
    @error('email')
        <div class="alert alert-danger">
            Error en el email, comprobar nuevamente(correo valido, no vacio, sintaxis valida).
        </div>
    @enderror
    @error('rol')
        <div class="alert alert-danger">
            Seleccione un rol para el usuario.
        </div>
    @enderror
    @error('password')
        <div class="alert alert-danger">
            Algo ha salido mal con la contraseña, revisa nuevamente(minima 8, confirmacion)
        </div>
    @enderror
    <div class="form-group">
        <label for="name">{{'Nombre'}}</label>
        <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}">
    </div>

    <div class="form-group">
        <label for="firstLastName">{{'Apellido Paterno'}}</label>
        <input type="text" class="form-control" name="firstLastName" id="firstLastName" value="{{old('firstLastName')}}">
    </div>

    <div class="form-group">
        <label for="secondLastName">{{'Apellido Materno'}}</label>
        <input type="text" class="form-control" name="secondLastName" id="secondLastName" value="{{old('secondLastName')}}">
    </div>

    <div class="form-group">
        <label for="email">{{'Escibre el correo electronico del usuario'}}</label>
        <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}">
    </div>

    <div class="form-group">
        <label for="rol"></label>
        <select id="rol" name="rol">
            <option selected>Selecciona el tipo de usuario</option>
            <option name="administrador" value="administrador">Administrador</option>
            <option name="jefe" value="jefe">Jefe Juar</option>
        </select>
    </div>

    <div class="form-group">
        <label for="password">{{'Escibre una contraseña temporal para el usuario'}}</label>
        <input type="password" class="form-control" name="password" id="password" value="">
    </div>

    <div class="form-group">
        <label for="password_confirmation">{{'Confirma la contraseña'}}</label>
        <input type="password_confirmation" class="form-control" name="password_confirmation" id="password_confirmation" value="">
    </div>

    <div class="row justify-content-center">
        <input type="submit" class="btn btn-success" value="Registrar">
        <a href="{{url('/user')}}" class="btn btn-warning">Regresar</a>
    </div>
    <br>
</form>
</div>
@endsection