@extends('plantillas.adminApp')
@section('main')
<div class="container shadow p-3 mb-2 bg-white rounded mt-2">
<div class="container shadow p-3 mb-5 bg-white rounded border border-success">
  <div class="row justify-content-md-center mb-4">
    <h1>Jefes Juar</h1>
  </div>

  <div class="row justify-content-md-center">
    @if(session('saveBoss'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>{{session('saveBoss')}}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif
    @if(session('deleteBoss'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>{{session('deleteBoss')}}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif
    @if(session('updateBoss'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>{{session('updateBoss')}}</strong>
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
        <form action="{{route('searchBoss')}}" method="get" class="form-inline float-right">
          @csrf
          <div class="form-group">
            <input id="nameBoss" class="form-control mx-1" type="text" name="nameBoss" placeholder="Buscar por nombre">
          </div>
          <div class="form-group">
            <input id="firstSurnameBoss" class="form-control mx-1" type="text" name="firstSurnameBoss" placeholder="Primer apellido">
          </div>
          <div class="form-group">
            <input id="secondSurnameBoss" class="form-control mx-1" type="text" name="secondSurnameBoss" placeholder="Segundo apellido">
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
            <th scope="col">Region</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($bosses as $boss)
          <tr>
            <td>{{$boss->name}}</td>
            <td>{{$boss->firstSurname}}</td>
            <td>{{$boss->secondSurname}}</td>
            <td>
              @if($boss->status == 1)
              Activo
              @elseif($boss->status == 0)
              Inactivo
              @endif
            </td>
            <td>{{$boss->email}}</td>
            <td>
              @if(count($regions->where('id', $boss->region_id)) == 0)
              {{' Sin region asignada'}}
              @else
              @foreach($regions->where('id', $boss->region_id) as $region)
                {{$region->nameRegion}}
              @endforeach
              @endif
            </td>
            <td class="justify-content-center">
              <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">
                  <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Acciones
                  </button>
                  <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <a class="dropdown-item" href="{{url('/boss/'.$boss->id.'/edit')}}">Editar Perfil</a>
                    <a class="dropdown-item" href="{{url('/boss/'.$boss->id.'/editPasswordBoss')}}">Editar Contraseña</a>
                    <form method="post" action="{{url('/boss/'.$boss->id)}}">
                      @csrf
                      {{method_field('DELETE')}}
                      <button type="submit" class="dropdown-item" onclick="return confirm('Esta seguro que quiere eliminar al Jefe Juar?');">Borrar</button>
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

  <div class="row">
    <div class="col">
      {{ $bosses->links() }}
    </div>
    <div class="col">
      <a class="btn btn-success float-right mr-1" href="{{url('/boss/create')}}">Registrar Jefe Juar</a>
    </div>
  </div>
</div>
</div>
@endsection