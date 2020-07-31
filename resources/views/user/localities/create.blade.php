@extends('plantillas.adminApp')
@section('main')
    <div class="container justify-content-md-center mt-3">
        <div class="row justify-content-md-center mt-3">
            <div class="col-8 shadow p-3 mb-5 bg-white rounded mt-4 border border-success">
                <div class="row justify-content-center mt-1">
                    <h2 class="">Registrar localidad</h2>
                </div>
                <form action="{{ url('/locality') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row form-group">
                        <div class="col">
                            <label for="id">{{ 'Clave de la localidad' }}</label>
                            <input type="number" class="form-control" name="id" id="id" value="{{ old('id') }}">
                            @error('id')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="keyLocality">{{ 'Numero de la localidad' }}</label>
                            <input type="number" class="form-control" name="keyLocality" id="keyLocality"
                                value="{{ old('keyLocality') }}">
                            @error('keyLocality')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col">
                            <label for="nameLocality">{{ 'Nombre de la localidad' }}</label>
                            <input type="text" class="form-control" name="nameLocality" id="nameLocality"
                                value="{{ old('nameLocality') }}">
                            @error('nameLocality')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="municipality_id">{{ 'Municipio: ' }}</label>
                            <select id="municipality_id" name="municipality_id" class="form-control">
                                <option value="{{null}}">Selecciona el municipio perteneciente</option>
                                @foreach($municipalities as $municipality)
                                    <option name="{{ $municipality->id }}" value="{{ $municipality->id }}">
                                        {{ $municipality->nameMunicipality }}</option>
                                @endforeach
                            </select>
                            @error('municipality_id')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row justify-content-center mb-3">
                        <input type="submit" class="btn btn-success mr-1" value="Registrar">
                        <a href="{{ url('/locality') }}" class="btn btn-primary">Regresar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
