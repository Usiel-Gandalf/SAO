@extends('plantillas.adminApp')
@section('main')
    <div class="container justify-content-md-center mt-3">
        <div class="row justify-content-md-center mt-3">
            <div class="col-8 shadow p-3 mb-5 bg-white rounded mt-4 border border-success">
                <div class="row justify-content-center mt-1">
                    <h2 class="">Editar becario</h2>
                </div>
                <div class="row justify-content-center mt-1">
                    @if (session('notScholar'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('notScholar') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
                <form action="{{ url('/scholar/' . $scholar->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row form-group">
                        <div class="col">
                            <label for="id">{{ 'Clave del becario' }}</label>
                            <input type="number" class="form-control" name="id" id="id" value="{{ $scholar->id }}">
                            @error('id')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="nameScholar">{{ 'Nombre del becario' }}</label>
                            <input type="text" class="form-control" name="nameScholar" id="nameScholar"
                                value="{{ $scholar->nameScholar }}">
                            @error('nameScholar')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col">
                            <label for="firstSurname">{{ 'Primer apellido' }}</label>
                            <input type="text" class="form-control" name="firstSurname" id="firstSurname"
                                value="{{ $scholar->firstSurname }}">
                            @error('firstSurname')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="secondSurname">{{ 'Segundo apellido' }}</label>
                            <input type="text" class="form-control" name="secondSurname" id="secondSurname"
                                value="{{ $scholar->secondSurname }}">
                            @error('secondSurname')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col">
                            <label for="gender">{{ 'Genero' }}</label>
                            <select id="gender" name="gender" class="form-control">
                                <option>{{ 'Genero' }}</option>
                                @if ($scholar->gender == 'F')
                                    <option name="F" value="F" selected>Femenino</option>
                                    <option name="M" value="M">Masculino</option>
                                @endif
                                @if ($scholar->gender == 'M')
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
                            <input type="date" class="form-control" name="birthDate" id="birthDate"
                                value="{{ $scholar->birthDate }}">
                            @error('birthDate')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="curp">{{ 'Curp' }}</label>
                            <input type="text" class="form-control" name="curp" id="curp" value="{{ $scholar->curp }}">
                            @error('curp')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>


                    <div class="row justify-content-center">
                        <input type="submit" class="btn btn-success mr-1" value="Actualizar">
                        <a href="{{ url('/scholar') }}" class="btn btn-primary">Regresar</a>
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>
@endsection
