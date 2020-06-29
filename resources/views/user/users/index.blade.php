@extends('plantillas.adminApp')
@section('main')
<div class="col-my-5 mt-5">
  <div class="row justify-content-center">
    <br><br>
    <h2 class="">Usuarios</h2>
  </div>
  @if(session('saveUser'))
  <div class="row justify-content-center">
    <div class="alert alert-success">
      {{session('saveUser')}}
    </div>
  </div>
  @endif
  @if(session('deleteUser'))
  <div class="row justify-content-center">
    <div class="alert alert-danger">
      {{session('deleteUser')}}
    </div>
  </div>
  @endif
  @if(session('updateUser'))
  <div class="row justify-content-center">
    <div class="alert alert-primary">
      {{session('updateUser')}}
    </div>
  </div>
  @endif
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
      @foreach($users as $usuario)
      <tr>
        <th scope="row">{{$usuario->id}}</th>
        <td>{{$usuario->name}}</td>
        <td>{{$usuario->firstLastName}}</td>
        <td>{{$usuario->secondLastName}}</td>
        <td>
          @if ($usuario->rol == 1)
          Administrador
          @endif
          @if ($usuario->rol == 0)
          Jefe Juar
          @endif
        </td>
        <td>{{$usuario->email}}</td>
        <td>
          <div class="row justify-content-center">
            <a class="btn btn-primary" href="{{url('/user/'.$usuario->id.'/edit')}}">Editar</a>
            <form method="post" action="{{url('/user/'.$usuario->id)}}">
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
  <div class="row">
    <div class="col">
      {{ $users->links() }}
    </div>
    <div class="col">
      <a class=" btn btn-success float-right" href="{{url('/user/create')}}">Crear Usuario</a>
    </div>

  </div>
</div>
@endsection