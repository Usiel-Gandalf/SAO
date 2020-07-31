@extends('plantillas.adminApp')
@section('main')
    <div class="container justify-content-md-center mt-3">
        <div class="row justify-content-md-center mt-3">
            <div class="col-8 shadow p-3 mb-5 bg-white rounded mt-4 border border-success">
                <div class="row justify-content-center">
                    <h2 class="">Registrar municipio</h2>
                </div>
                <form action="{{ url('/municipality') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="id">{{ 'Clave del municipio' }}</label>
                        <input type="number" class="form-control" name="id" id="id" value="{{ old('id') }}">
                        @error('id')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="region_id"></label>
                        <select id="region_id" name="region_id" class="form-control">
                            <option value="{{null}}">Seleccione una region</option>
                            @foreach($regions as $region)
                                <option name="{{ $region->id }}" value="{{ $region->id }}">{{ $region->nameRegion }}
                                </option>
                            @endforeach
                        </select>
                        @error('region_id')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nameMunicipality">{{ 'Nombre del municipio' }}</label>
                        <input type="text" class="form-control" name="nameMunicipality" id="nameMunicipality"
                            value="{{ old('nameMunicipality') }}">
                        @error('nameMunicipality')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="row justify-content-center mb-3">
                        <input type="submit" class="btn btn-success mr-1" value="Registrar">
                        <a href="{{ url('/municipality') }}" class="btn btn-primary">Regresar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
