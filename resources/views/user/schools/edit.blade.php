@extends('plantillas.adminApp')
@section('main')
    <div class="container justify-content-md-center mt-3">
        <div class="row justify-content-md-center mt-3">
            <div class="col-8 shadow p-3 mb-5 bg-white rounded mt-4 border border-success">
                <div class="row justify-content-center mt-1">
                    <h2 class="">Editar Escuela</h2>
                </div>
                <form action="{{ url('/school/' . $school->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="id">{{ 'Clave de la escuela' }}</label>
                        <input type="text" class="form-control" name="id" id="id" value="{{ $school->id }}">
                        @error('id')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nameSchool">{{ 'Nombre de la escuela' }}</label>
                        <input type="text" class="form-control" name="nameSchool" id="nameSchool"
                            value="{{ $school->nameSchool }}">
                        @error('nameSchool')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="locality_id">{{ 'Localidad: ' }}</label>
                        <select id="locality_id" name="locality_id" class="form-control">
                            <option selected>Selecciona la localidad perteneciente</option>
                            @foreach($localities as $locality)
                                @if($locality->id == $school->locality_id)
                                    <option name="{{ $locality->id }}" value="{{ $locality->id }}" selected>
                                        {{ $locality->nameLocality }}</option>
                                @endif
                                @if($locality->id !== $school->locality_id)
                                    <option name="{{ $locality->id }}" value="{{ $locality->id }}">{{ $locality->nameLocality }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('locality_id')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="row justify-content-center mb-3">
                        <input type="submit" class="btn btn-success mr-1" value="Editar">
                        <a href="{{ url('/school') }}" class="btn btn-primary">Regresar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
