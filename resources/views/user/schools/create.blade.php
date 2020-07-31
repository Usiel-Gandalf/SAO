@extends('plantillas.adminApp')
@section('main')
    <div class="container justify-content-md-center mt-3">
        <div class="row justify-content-md-center mt-3">
            <div class="col-8 shadow p-3 mb-5 bg-white rounded mt-4 border border-success">
                <div class="row justify-content-center mt-1">
                    <h2 class="">Registrar Escuela</h2>
                </div>
                <form action="{{ url('/school') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="id">{{ 'Clave de la escuela' }}</label>
                        <input type="text" class="form-control" name="id" id="id" value="{{ old('id') }}">
                        @error('id')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nameSchool">{{ 'Nombre de la escuela' }}</label>
                        <input type="text" class="form-control" name="nameSchool" id="nameSchool"
                            value="{{ old('nameSchool') }}">
                        @error('nameSchool')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="locality_id">{{ 'Localidad: ' }}</label>
                        <select id="locality_id" name="locality_id" class="form-control">
                            <option value="{{null}}">Selecciona la localidad perteneciente</option>
                            @foreach($localities as $locality)
                                <option name="{{ $locality->id }}" value="{{ $locality->id }}">{{ $locality->nameLocality }}
                                </option>
                            @endforeach
                        </select>
                        @error('locality_id')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="row justify-content-center mb-3">
                        <input type="submit" class="btn btn-success mr-1" value="Registrar">
                        <a href="{{ url('/school') }}" class="btn btn-primary">Regresar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
