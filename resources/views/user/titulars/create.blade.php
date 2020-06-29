@extends('plantillas.adminApp')
@section('main')
<div class="row justify-content-md-center">
    <div class="col-7">
        <div class="col table-bordered my-5">
            <div class="row justify-content-center mt-1">
                <h2 class="">Registrar titular</h2>
            </div>
            <form action="{{url('/titular')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="id">{{'Clave del/la titular'}}</label>
                    <input type="text" class="form-control" name="id" id="id" value="{{old('id')}}">
                    @error('id')
                    <div class="alert alert-danger">
                        revisar nuevamente la clave del/la titular
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nameTitular">{{'Nombre del/la titular'}}</label>
                    <input type="text" class="form-control" name="nameTitular" id="nameTitular" value="{{old('nameTitular')}}">
                    @error('nameTitular')
                    <div class="alert alert-danger">
                        Error en el nombre del/la titular, revisar nuevamente, (nombre valido, no vacio, no numerico)
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="firstSurname">{{'Primer apellido'}}</label>
                    <input type="text" class="form-control" name="firstSurname" id="firstSurname" value="{{old('firstSurname')}}">
                    @error('firstSurname')
                    <div class="alert alert-danger">
                        Error en el apellido paterno del/la titular, revisar nuevamente, (apellido valido, no vacio, no numerico)
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="secondSurname">{{'Segundo apellido'}}</label>
                    <input type="text" class="form-control" name="secondSurname" id="secondSurname" value="{{old('secondSurname')}}">
                    @error('secondSurname')
                    <div class="alert alert-danger">
                        Error en el apellido materno del/la titular, revisar nuevamente, (apellido valido, no vacio, no numerico)
                    </div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col">
                        <label for="gender">{{'Genero'}}</label>
                        <select id="gender" name="gender" class="form-control">
                            <option selected>Genero</option>
                            <option name="M" value="M">Masculino</option>
                            <option name="F" value="F">Femenino</option>
                        </select>
                        @error('gender')
                        <div class="alert alert-danger">
                            Seleccione un genero para el becario
                        </div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="birthDate">{{'(AAAA/MM/DD)'}}</label>
                        <input type="text" class="form-control" name="birthDate" id="birthDate" value="{{old('birthDate')}}">
                        @error('birthDate')
                        <div class="alert alert-danger">
                            Ingrese la fecha del nacimiento(AAAA/MM/DD)
                        </div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="curp">{{'Curp'}}</label>
                        <input type="text" class="form-control" name="curp" id="curp" value="{{old('curp')}}">
                        @error('curp')
                        <div class="alert alert-danger">
                            revisar nuevamente la curp
                        </div>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="row justify-content-center">
                    <input type="submit" class="btn btn-success mr-1" value="Registrar">
                    <a href="{{url('/titular')}}" class="btn btn-primary">Regresar</a>
                </div>
                <br>
            </form>
        </div>

        @endsection