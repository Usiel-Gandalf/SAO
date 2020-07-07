@extends('plantillas.adminApp')
@section('main')
<div class="row justify-content-md-center mt-4">
    <div class="col-6 shadow p-3 mb-5 bg-white rounded mt-4">
        <div class="col border border-secondary">
            <div class="row justify-content-center">
                <h2 class="mt-1">Registrar Administrador</h2>
            </div>
            <form action="{{url('/admin')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row form-group">
                    <div class="col">
                        <label for="name">{{'Nombre'}}</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}">
                        @error('name')
                        <div class="alert alert-danger">
                            Error en el nombre, comprobar nuevamente(nombre valido, no numeros, no vacio).
                        </div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="firstSurname">{{'Apellido Paterno'}}</label>
                        <input type="text" class="form-control" name="firstSurname" id="firstSurname" value="{{old('firstSurname')}}">
                        @error('firstSurname')
                        <div class="alert alert-danger">
                            Error en el primer apellido, comprobar nuevamente(nombre valido, no numeros, no vacio).
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col">
                        <label for="secondSurname">{{'Apellido Materno'}}</label>
                        <input type="text" class="form-control" name="secondSurname" id="secondSurname" value="{{old('secondSurname')}}">
                        @error('secondSurname')
                        <div class="alert alert-danger">
                            Error en el segundo apellido, comprobar nuevamente(nombre valido, no numeros, no vacio).
                        </div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="email">{{'Escibre el correo electronico del usuario'}}</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}">
                        @error('email')
                        <div class="alert alert-danger">
                            Error en el email, comprobar nuevamente(correo valido, no vacio, sintaxis valida).
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="status"></label>
                    <select id="status" name="status" class="form-control">
                        <option selected value="{{null}}">Estado del administrador</option>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                    @error('status')
                    <div class="alert alert-danger">
                        Seleccione un estado para el administrador.
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">{{'Contraseña del administrador'}}</label>
                    <input type="password" class="form-control" name="password" id="password" value="">
                    @error('password')
                    <div class="alert alert-danger">
                        Algo ha salido mal con la contraseña, revisa nuevamente(minima 8, confirmacion)
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">{{'Confirma la contraseña'}}</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" value="">
                </div>

                <div class="row justify-content-center mt-3 mb-3">
                    <input type="submit" class="btn btn-success mr-1" value="Registrar">
                    <a href="{{url('/admin')}}" class="btn btn-primary">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection