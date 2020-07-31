@extends('plantillas.adminApp')
@section('main')
    <div class="container justify-content-md-center mt-3">
        <div class="row justify-content-md-center mt-3">
            <div class="col-8 shadow p-3 mb-5 bg-white rounded mt-4 border border-success">
                <div class="row justify-content-center">
                    <h2 class="mt-1">Registrar region</h2>
                </div>
                <form action="{{ url('/region') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row form-group">
                        <div class="col">
                            <label for="id">{{ 'clave de la region' }}</label>
                            <input type="number" class="form-control" name="id" id="id" value="{{ old('id') }}">
                            @error('id')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="region">{{ 'Numero de region' }}</label>
                            <input type="number" class="form-control" name="region" id="region" value="{{ old('region') }}">
                            @error('region')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name">{{ 'Nombre de la region' }}</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                        @error('name')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="row justify-content-center">
                        <input type="submit" class="btn btn-success mr-1" value="Registrar">
                        <a href="{{ url('/region') }}" class="btn btn-primary">Regresar</a>
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>
@endsection
