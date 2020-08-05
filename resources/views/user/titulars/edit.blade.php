@extends('plantillas.adminApp')
@section('main')
    <div class="container justify-content-md-center mt-3">
        <div class="row justify-content-md-center mt-3">
            <div class="col-8 shadow p-3 mb-5 bg-white rounded mt-4 border border-success">
                <div class="row justify-content-center mt-1">
                    <h2 class="">Editar titular</h2>
                </div>
                <div class="row justify-content-center mt-1">
                    @if (session('notTitular'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('notTitular') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
                <form action="{{ url('/titular/' . $titular->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="id">{{ 'Clave del/la titular' }}</label>
                        <input type="text" class="form-control" name="id" id="id" value="{{ $titular->id }}">
                        @error('id')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nameTitular">{{ 'Nombre del/la titular' }}</label>
                        <input type="text" class="form-control" name="nameTitular" id="nameTitular"
                            value="{{ $titular->nameTitular }}">
                        @error('nameTitular')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="firstSurname">{{ 'Primer apellido' }}</label>
                        <input type="text" class="form-control" name="firstSurname" id="firstSurname"
                            value="{{ $titular->firstSurname }}">
                        @error('firstSurname')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="secondSurname">{{ 'Segundo apellido' }}</label>
                        <input type="text" class="form-control" name="secondSurname" id="secondSurname"
                            value="{{ $titular->secondSurname }}">
                        @error('secondSurname')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="gender">{{ 'Genero' }}</label>
                            <select id="gender" name="gender" class="form-control">
                                <option>{{'Genero'}}</option>
                                @if ($titular->gender == 'F')
                                    <option name="F" value="F" selected>Femenino</option>
                                    <option name="M" value="M">Masculino</option>
                                @endif
                                @if ($titular->gender == 'M')
                                    <option name="M" value="M" selected>Masculino</option>
                                    <option name="F" value="F">Femenino</option>
                                @endif
                            </select>
                            @error('gender')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="birthDate">{{ 'Fecha de nacimiento' }}</label>
                            <input type="text" class="form-control" name="birthDate" id="birthDate"
                                value="{{ $titular->birthDate }}">
                            @error('birthDate')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="curp">{{ 'Curp' }}</label>
                            <input type="text" class="form-control" name="curp" id="curp" value="{{ $titular->curp }}">
                            @error('curp')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="row justify-content-center">
                        <input type="submit" class="btn btn-success mr-1" value="Actualizar">
                        <a href="{{ url('/titular') }}" class="btn btn-primary">Regresar</a>
                    </div>
                    <br>
                </form>
            </div>
        @endsection
