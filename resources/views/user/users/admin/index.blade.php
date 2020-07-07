@extends('plantillas.adminApp')
@section('main')
<div class="container shadow p-3 mb-5 bg-white rounded mt-2">
  <div class="row justify-content-md-center mb-4">
    <h1>Administradores</h1>
  </div>

  <div class="row justify-content-md-center">
    @if(session('saveAdmin'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>{{session('saveAdmin')}}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif
    @if(session('deleteAdmin'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>{{session('deleteAdmin')}}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif
    @if(session('updateAdmin'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>{{session('updateAdmin')}}</strong>
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
        <form action="{{route('searchAdmin')}}" method="get" class="form-inline float-right">
          @csrf
          <div class="form-group">
            <input id="nameadmin" class="form-control mx-1" type="text" name="nameadmin" placeholder="Buscar por nombre">
          </div>
          <div class="form-group">
            <input id="firstSurnameadmin" class="form-control mx-1" type="text" name="firstSurnameadmin" placeholder="Primer apellido">
          </div>
          <div class="form-group">
            <input id="secondSurnameadmin" class="form-control mx-1" type="text" name="secondSurnameadmin" placeholder="Segundo apellido">
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

  <div class="container mt-2">
    <div class="row">
      <table class="table table-bordered">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Primer Apellido</th>
            <th scope="col">Segundo Apellido</th>
            <th scope="col">Estado</th>
            <th scope="col">Correo</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($admins as $admin)
          <tr>
            <td>{{$admin->name}}</td>
            <td>{{$admin->firstSurname}}</td>
            <td>{{$admin->secondSurname}}</td>
            <td>
              @if($admin->status == 1)
              Activo
              @elseif($admin->status == 0)
              Inactivo
              @endif
            </td>
            <td>{{$admin->email}}</td>
            <td class="justify-content-center">
              <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">
                  <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Acciones
                  </button>
                  <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <a class="dropdown-item" href="{{url('/admin/'.$admin->id.'/edit')}}">Editar Perfil</a>
                    <a class="dropdown-item" href="{{url('/admin/'.$admin->id.'/editPasswordAdmin')}}">Editar Contraseña</a>
                    <form method="post" action="{{url('/admin/'.$admin->id)}}">
                      @csrf
                      {{method_field('DELETE')}}
                      <button type="submit" class="dropdown-item" onclick="return confirm('Esta seguro que quiere eliminar al administrador?');">Borrar</button>
                    </form>
                  </div>
                </div>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <div class="row mt-1">
    <div class="col">
      {{ $admins->links() }}
    </div>
    <div class="col">
      <a class="btn btn-success float-right mr-1" href="{{url('/admin/create')}}">Registrar Administrador</a>
    </div>
  </div>
</div>
@endsection