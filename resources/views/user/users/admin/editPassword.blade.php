@extends('plantillas.adminApp')

@section('main')
<div class="row justify-content-md-center">
    <div class="col-7 shadow p-3 mb-5 bg-white rounded mt-4">
        <div class="col border border-secondary">
            <div class="row justify-content-center">
                <h2 class="mt-1">Editar contraseña</h2>
            </div>
            <div class="row justify-content-center">
                <h5 class="mt-1">
                    Administrador: {{$admin->name}}
                </h5>
            </div>

            <form action="{{url('/admin/'.$admin->id.'/updatePasswordAdmin')}}" method="post">
                @csrf
                <div class="form-group">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Ingresar nueva contraseña">
                    @error('password')
                    <div class="alert alert-danger">
                        Algo ha salido mal con la contraseña, revisa nuevamente(minima 8, confirmacion), asegurese de confirmar correctamente la contraseña
                    </div>
                    @enderror
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirmar nueva contraseña">
                </div>

                <div class="row justify-content-center">
                    <input type="submit" class="btn btn-success mr-1" value="Editar">
                    <a href="{{url('/admin')}}" class="btn btn-primary">Regresar</a>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>
@endsection