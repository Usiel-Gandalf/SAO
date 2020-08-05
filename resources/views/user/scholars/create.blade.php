@extends('plantillas.adminApp')
@section('main')
    <div class="container justify-content-md-center mt-3">
        <div class="row justify-content-md-center mt-3">
            <div class="col-8 shadow p-3 mb-5 bg-white rounded mt-4 border border-success">
                <div class="row justify-content-center mt-1">
                    <h2 class="">Registrar Becario</h2>
                </div>
                <form action="{{ url('/scholar') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="id">{{ 'Clave del becario' }}</label>
                        <input type="number" class="form-control" name="id" id="id" value="{{ old('id') }}">
                        @error('id')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nameScholar">{{ 'Nombre del becario' }}</label>
                        <input type="text" class="form-control" name="nameScholar" id="nameScholar"
                            value="{{ old('nameScholar') }}">
                        @error('nameScholar')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="firstSurname">{{ 'Primer apellido' }}</label>
                        <input type="text" class="form-control" name="firstSurname" id="firstSurname"
                            value="{{ old('firstSurname') }}">
                        @error('firstSurname')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="secondSurname">{{ 'Segundo apellido' }}</label>
                        <input type="text" class="form-control" name="secondSurname" id="secondSurname"
                            value="{{ old('secondSurname') }}">
                        @error('secondSurname')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="row form-group">
                        <div class="col">
                            <label for="gender">{{ 'Genero' }}</label>
                            <select id="gender" name="gender" class="form-control">
                                <option>{{'Genero'}}</option>
                                <option name="F" value="F">Femenino</option>
                                <option name="M" value="M">Masculino</option>
                            </select>
                            @error('gender')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="birthDate">{{ 'Fecha de nacimiento' }}</label>
                            <input type="date" class="form-control" name="birthDate" id="birthDate"
                                value="{{ old('birthDate') }}">
                            @error('birthDate')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="curp">{{ 'Curp' }}</label>
                            <input type="text" class="form-control" name="curp" id="curp" value="{{ old('curp') }}">
                            @error('curp')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="row justify-content-center">
                        <input type="submit" class="btn btn-success mr-1" value="Registrar">
                        <a href="{{ url('/scholar') }}" class="btn btn-primary">Regresar</a>
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>
@endsection
