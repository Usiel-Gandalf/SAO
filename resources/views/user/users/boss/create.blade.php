@extends('plantillas.adminApp')
@section('main')
    <div class="container justify-content-md-center mt-3">
        <div class="row justify-content-md-center mt-3">
            <div class="col-8 shadow p-3 mb-5 bg-white rounded mt-4 border border-success">
                <div class="row justify-content-center">
                    <h2 class="mt-1">Registrar jefe juar</h2>
                </div>
                <form action="{{ url('/boss') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row form-group mt-2">
                        <div class="col">
                            <label for="name">{{ 'Nombre' }}</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="firstSurname">{{ 'Apellido Paterno' }}</label>
                            <input type="text" class="form-control" name="firstSurname" id="firstSurname"
                                value="{{ old('firstSurname') }}">
                            @error('firstSurname')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col">
                            <label for="secondSurname">{{ 'Apellido Materno' }}</label>
                            <input type="text" class="form-control" name="secondSurname" id="secondSurname"
                                value="{{ old('secondSurname') }}">
                            @error('secondSurname')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="email">{{ 'Escibre el correo electronico del jefe juar' }}</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                            @error('email')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="status">{{ 'Estado del jefe juar' }}</label>
                        <select id="status" name="status" class="form-control">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                        @error('status')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="region_id">{{ 'Region del jefe juar' }}</label>
                        <select id="region_id" name="region_id" class="form-control">
                            @foreach($regions as $region)
                                <option selected value="{{ $region->id }}">{{ $region->nameRegion }}</option>
                            @endforeach
                        </select>
                        @error('region_id')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="row form-group">
                        <div class="col">
                            <label for="password">{{ 'Contraseña del jefe juar' }}</label>
                            <input type="password" class="form-control" name="password" id="password" value="">
                        </div>

                        <div class="col">
                            <label for="password_confirmation">{{ 'Confirma la contraseña' }}</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                id="password_confirmation" value="">
                        </div>
                    </div>

                    <div class="row form-group">
                        @error('password')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="row justify-content-center">
                        <input type="submit" class="btn btn-success mr-1" value="Registrar">
                        <a href="{{ url('/boss') }}" class="btn btn-primary">Regresar</a>
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>
@endsection
