@extends('plantillas.adminApp')
@section('main')
    <div class="container justify-content-md-center mt-3">
        <div class="row justify-content-md-center mt-3">
            <div class="col-8 shadow p-3 mb-5 bg-white rounded mt-4 border border-success">
                <div class="row justify-content-center">
                    <h2 class="">Editar municipio</h2>
                </div>
                <form action="{{ url('/municipality/' . $municipality->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="id">{{ 'Clave del municipio' }}</label>
                        <input type="number" class="form-control" name="id" id="id" value="{{ $municipality->id }}">
                        @error('id')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nameMunicipality">{{ 'Nombre del municipio' }}</label>
                        <input type="text" class="form-control" name="nameMunicipality" id="nameMunicipality"
                            value="{{ $municipality->nameMunicipality }}">
                        @error('nameMunicipality')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="region_id">{{ 'Region: ' }}</label>
                        <select id="region_id" name="region_id" class="form-control">
                            <option selected>Selecciona la region perteneciente</option>
                            @foreach($regions as $region)
                                @if($region->id == $municipality->region_id)
                                    <option name="{{ $region->id }}" value="{{ $region->id }}" selected>
                                        {{ $region->nameRegion }}</option>
                                @endif
                                @if($region->id !== $municipality->region_id)
                                    <option name="{{ $region->id }}" value="{{ $region->id }}">{{ $region->nameRegion }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('region_id')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="row justify-content-center mb-3">
                        <input type="submit" class="btn btn-success mr-1" value="Editar">
                        <a href="{{ url('/municipality') }}" class="btn btn-primary">Regresar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
