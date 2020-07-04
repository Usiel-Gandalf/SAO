@extends('plantillas.adminApp')
@section('main')
<div class="row justify-content-md-center mb-4">
  <h1>Usuarios</h1>
</div>

<div class="row justify-content-md-center">
  @if(session('saveUser'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{session('saveUser')}}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  @if(session('deleteUser'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{session('deleteUser')}}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  @if(session('updateUser'))
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>{{session('updateUser')}}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  @if(session('updatePassword'))
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>{{session('updatePassword')}}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  @if(session('notFound'))
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>{{session('notFound')}}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
</div>

<div class="row">
  <div class="col-md-12">
    <div class="page-header">
      <form action="{{route('searchUser')}}" method="get" class="form-inline float-right">
        @csrf
        <div class="form-group">
          <input id="nameUser" class="form-control mx-1" type="text" name="nameUser" placeholder="Buscar por nombre">
        </div>
        <div class="form-group">
          <input id="firstSurnameUser" class="form-control mx-1" type="text" name="firstSurnameUser" placeholder="Primer apellido">
        </div>
        <div class="form-group">
          <input id="secondSurnameUser" class="form-control mx-1" type="text" name="secondSurnameUser" placeholder="Segundo apellido">
        </div>
        <div class="form-group">
          <select id="rol" name="rol" class="form-control">
            <option selected value="{{null}}">Rol</option>
            <option name="0" value="0">Administrador</option>
            <option name="1" value="1">Jefes Juar</option>
          </select>
        </div>
        <div class="form-group">
          <input id="email" class="form-control mx-1" type="text" name="email" placeholder="E-mail">
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Buscar">
        </div>
      </form>
    </div>
  </div>
</div>

<div class="container table-bordered mt-2">
  <div class="row">
    <table class="table table-bordered">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nombre</th>
          <th scope="col">Primer Apellido</th>
          <th scope="col">Segundo Apellido</th>
          <th scope="col">Rol</th>
          <th scope="col">Correo</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr>
          <th scope="row">{{$user->id}}</th>
          <td>{{$user->name}}</td>
          <td>{{$user->firstSurname}}</td>
          <td>{{$user->secondSurname}}</td>
          <td>
            @if($user->rol == 1)
            Administrador
            @endif
            @if ($user->rol == 0)
            Jefe Juar
            @endif
          </td>
          <td>{{$user->email}}</td>
          <td>
            <div class="row justify-content-center">
              <a class="btn btn-primary mr-1" href="{{url('/user/'.$user->id.'/edit')}}">Editar Perfil</a>
              <a class="btn btn-primary mr-1" href="{{url('/user/'.$user->id.'/editPassword')}}">Editar Contraseña</a>

              <form method="post" action="{{url('/user/'.$user->id)}}">
                @csrf
                {{method_field('DELETE')}}
                <button type="submit" class="btn btn-danger" onclick="return confirm('Esta seguro que quiere eliminar al usuario?');">Borrar</button>
              </form>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="row">
    <div class="col">
      {{ $users->links() }}
    </div>
    <div class="col">
      <a class="btn btn-success float-right" href="{{url('/user/create')}}">Crear Usuario</a>
    </div>
  </div>
</div>
@endsection