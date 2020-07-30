@extends('plantillas.adminApp')
@section('main')
    <div class="container justify-content-md-center mt-3">
        <div class="row justify-content-md-center mt-3">
            <div class="col-8 shadow p-3 mb-5 bg-white rounded mt-4 border border-success">
                <div class="row justify-content-center">
                    <h2 class="mt-1">Editar Jefe Juar</h2>
                </div>
                @if(session('notEmail'))
                    <div class="row justify-content-md-center">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session('notEmail') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif
               
                <form action="{{ url('/boss/' . $boss->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="row form-group">
                        <div class="col">
                            <label for="name">{{ 'Nombre' }}</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $boss->name }}">
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="firstSurname">{{ 'Apellido Paterno' }}</label>
                            <input type="text" class="form-control" name="firstSurname" id="firstSurname"
                                value="{{ $boss->firstSurname }}">
                            @error('firstSurname')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col">
                            <label for="secondSurname">{{ 'Apellido Materno' }}</label>
                            <input type="text" class="form-control" name="secondSurname" id="secondSurname"
                                value="{{ $boss->secondSurname }}">
                            @error('secondSurname')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="email">{{ 'Correo Electronico' }}</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ $boss->email }}">
                            @error('email')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col">
                            <label for="rol">{{ 'Rol' }}</label>
                            <select id="rol" name="rol" class="form-control">
                                @if($boss->rol == 1)
                                    <option name="1" value="1" selected>Administrador</option>
                                    <option name="0" value="0">Jefe Juar</option>
                                @elseif($boss->rol == 0)
                                    <option name="0" value="0" selected>Jefe Juar</option>
                                    <option name="1" value="1">Administrador</option>
                                @endif
                                @error('rol')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </select>
                        </div>

                        <div class="col">
                            <label for="status">{{ 'Estado' }}</label>
                            <select id="status" name="status" class="form-control">
                                @if($boss->status == 1)
                                    <option name="1" value="1" selected>Activo</option>
                                    <option name="0" value="0">Inactivo</option>
                                @elseif($boss->status == 0)
                                    <option name="0" value="0" selected>Inactivo</option>
                                    <option name="1" value="1">Activo</option>
                                @endif
                                @error('status')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="region_id">{{ 'Region del jefe juar' }}</label>
                        <select id="region_id" name="region_id" class="form-control">
                            @foreach($regions as $region)
                            @if($region->id === $boss->region_id)
                                <option value="{{ $region->id }}" selected>{{ $region->nameRegion }}</option>
                            @else
                                <option name="region_id" value="{{ $region->id }}">{{ $region->nameRegion }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('region_id')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="row justify-content-center mt-3 mb-3">
                    <input type="submit" class="btn btn-success mr-1" value="Editar">
                    <a href="{{ url('/boss') }}" class="btn btn-primary">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
