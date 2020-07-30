@extends('plantillas.adminApp')
@section('main')
    <div class="container justify-content-md-center mt-5 mb-5">
        <div class="row justify-content-md-center mt-3">

            <div class="col-8 shadow p-3 mb-5 bg-white rounded mt-4 border border-success">
                <div class="row justify-content-center">
                    <h2 class="mt-1">Editar contraseña</h2>
                </div>
                <div class="row justify-content-center">
                    <h5 class="mt-1">
                        Administrador: {{ $admin->name }}
                    </h5>
                </div>

                <form action="{{ url('/admin/' . $admin->id . '/updatePasswordAdmin') }}" method="post">
                    @csrf
                    <div class="form-group mt-1">
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="Ingresar nueva contraseña">
                        <input type="password" class="form-control mt-2" name="password_confirmation"
                            id="password_confirmation" placeholder="Confirmar nueva contraseña">
                    </div>

                    <div class="row justify-content-md-center">
                        @error('password')
                        <p class="text-danger ">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="row justify-content-center mt-2">
                        <input type="submit" class="btn btn-success mr-1" value="Editar">
                        <a href="{{ url('/admin') }}" class="btn btn-primary">Regresar</a>
                    </div>

                </form>
            </div>
            <br>
        </div>
    </div>
@endsection
