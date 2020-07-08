@extends('plantillas.pdf')
@section('pdf')
<center><img class="mt-0" src="https://qroo.gob.mx/sites/default/files/inline-images/BECAS_COORDINACION_logo.png" class="img-fluid" alt="Responsive image" width="60%" height="70%"></center>

<center>
  <h5 class="mt-1"><b>SUBDIRECCION DE ATENCION OPERATIVA</b></h5>
</center>

<center>
  <h6>REPORTE GENERAL-REGION | {{@date('Y-m-d')}} | Administrador: {{Auth::user()->name}} {{Auth::user()->firstSurname}} {{Auth::user()->secondSurname}}</h6>
</center>
<br>
<center>
  <h6>
    @if(count($bossRegion) == 0)
    {{'Responsable de la region: Sin Jefe'}}
    @elseif(count($bossRegion) >= 2)
    @foreach($bossRegion as $boss)
    {{'Responsables de la region:'}} {{$boss->name}} {{$boss->firstSurname}} {{$boss->secondSurname}},
    @endforeach
    @else
    @foreach($bossRegion as $boss)
    {{'Responsable de la region:'}} {{$boss->name}} {{$boss->firstSurname}} {{$boss->secondSurname}}
    @endforeach
    @endif
  </h6>
</center>

<center>
  <table class="table table-bordered text-center">
    <thead class="thead-light">
      @foreach($regionInfo as $region)
      <tr>
        <td scope="col" class="py-1">
          <h6><b>REGION:</b> {{$region->nameRegion}}</h6>
        </td>
        <td scope="col" class="py-1">
          <h6><b>CLAVE:</b> {{$region->id}}</h6>
        </td>
        <td scope="col" class="py-1">
          <h6><b>NUMERO:</b> {{$region->region}}</h6>
        </td>
      </tr>
      @endforeach
    </thead>
  </table>
</center>

<hr style="color: #0056b2;" width="100%" />

<center>
  <h6>EDUCACION BASICA - CERM</h6>
</center>

<center>
  <table class="table table-bordered">
    <thead class="thead-light">
      <tr>
        <th scope="col" style="width:40%; height:5%">
          <h6>Estatus</h6>
        </th>
        <th scope="col">
          <h6>Enero Febrero</h6>
        </th>
        <th scope="col">
          <h6>Marzo Abril</h6>
        </th>
        <th scope="col">
          <h6>Mayo Junio</h6>
        </th>
        <th scope="col">
          <h6>Septiembre Octubre</h6>
        </th>
        <th scope="col">
          <h6>Noviembre Diciembre</h6>
        </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">
          <h6>Pendientes</h6>
        </th>
        <td>
          <h6>{{count($basics->where('status', 0)->where('bimester', 1)->where('type', 1))}}</h6>
        </td>
        <td>
          <h6>{{count($basics->where('status', 0)->where('bimester', 2)->where('type', 1))}}</h6>
        </td>
        <td>
          <h6>{{count($basics->where('status', 0)->where('bimester', 3)->where('type', 1))}}</h6>
        </td>
        <td>
          <h6>{{count($basics->where('status', 0)->where('bimester', 4)->where('type', 1))}}</h6>
        </td>
        <td>
          <h6>{{count($basics->where('status', 0)->where('bimester', 5)->where('type', 1))}}</h6>
        </td>

      </tr>
      <tr>
        <th scope="row">
          <h6>Entregados</h6>
        </th>
        <td>
          <h6>{{count($basics->where('status', 1)->where('bimester', 1)->where('type', 1))}}</h6>
        </td>
        <td>
          <h6>{{count($basics->where('status', 1)->where('bimester', 2)->where('type', 1))}}</h6>
        </td>
        <td>
          <h6>{{count($basics->where('status', 1)->where('bimester', 3)->where('type', 1))}}</h6>
        </td>
        <td>
          <h6>{{count($basics->where('status', 1)->where('bimester', 4)->where('type', 1))}}</h6>
        </td>
        <td>
          <h6>{{count($basics->where('status', 1)->where('bimester', 5)->where('type', 1))}}</h6>
        </td>
      </tr>
      <tr>
        <th scope="row">
          <h6>No entregados|No localizados</h6>
        </th>
        <td>
          <h6>{{count($basics->where('status', 2)->where('bimester', 1)->where('type', 1))}}</h6>
        </td>
        <td>
          <h6>{{count($basics->where('status', 2)->where('bimester', 2)->where('type', 1))}}</h6>
        </td>
        <td>
          <h6>{{count($basics->where('status', 2)->where('bimester', 3)->where('type', 1))}}</h6>
        </td>
        <td>
          <h6>{{count($basics->where('status', 2)->where('bimester', 4)->where('type', 1))}}</h6>
        </td>
        <td>
          <h6>{{count($basics->where('status', 2)->where('bimester', 5)->where('type', 1))}}</h6>
        </td>
      </tr>
      <tr>
        <th scope="row">
          <h6>No entregados|Por baja</h6>
        </th>
        <td>
          <h6>{{count($basics->where('status', 3)->where('bimester', 1)->where('type', 1))}}</h6>
        </td>
        <td>
          <h6>{{count($basics->where('status', 3)->where('bimester', 2)->where('type', 1))}}</h6>
        </td>
        <td>
          <h6>{{count($basics->where('status', 3)->where('bimester', 3)->where('type', 1))}}</h6>
        </td>
        <td>
          <h6>{{count($basics->where('status', 3)->where('bimester', 4)->where('type', 1))}}</h6>
        </td>
        <td>
          <h6>{{count($basics->where('status', 3)->where('bimester', 5)->where('type', 1))}}</h6>
        </td>
      </tr>
    </tbody>
  </table>
</center>

<hr style="color: #0056b2;" width="100%" />

<center>
  <h6>EDUCACION BASICA - AVISOS DE COBRO</h6>
</center>

<center>
  <table class="table table-bordered">
    <thead class="thead-light">
      <tr>
        <th scope="col" style="width:40%; height:5%">
          <h6>ESTATUS</h6>
        </th>
        <th scope="col">
          <h6>Enero Febrero</h6>
        </th>
        <th scope="col">
          <h6>Marzo Abril</h6>
        </th>
        <th scope="col">Mayo Junio</th>
        <th scope="col">
          <h6>Septiembre Octubre</h6>
        </th>
        <th scope="col">
          <h6>Noviembre Diciembre</h6>
        </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">
          <h6>Pendientes</h6>
        </th>
        <td>
          <h6>{{count($basics->where('status', 0)->where('bimester', 1)->where('type', 2))}}</h6>
        </td>
        <td>
          <h6>{{count($basics->where('status', 0)->where('bimester', 2)->where('type', 2))}}</h6>
        </td>
        <td>
          <h6>{{count($basics->where('status', 0)->where('bimester', 3)->where('type', 2))}}</h6>
        </td>
        <td>
          <h6>{{count($basics->where('status', 0)->where('bimester', 4)->where('type', 2))}}</h6>
        </td>
        <td>
          <h6>{{count($basics->where('status', 0)->where('bimester', 5)->where('type', 2))}}</h6>
        </td>
      </tr>
      <tr>
        <th scope="row">
          <h6>Entregados</h6>
        </th>
        <td>
          <h6>{{count($basics->where('status', 1)->where('bimester', 1)->where('type', 2))}}</h6>
        </td>
        <td>
          <h6>{{count($basics->where('status', 1)->where('bimester', 2)->where('type', 2))}}</h6>
        </td>
        <td>
          <h6>{{count($basics->where('status', 1)->where('bimester', 3)->where('type', 2))}}</h6>
        </td>
        <td>
          <h6>{{count($basics->where('status', 1)->where('bimester', 4)->where('type', 2))}}</h6>
        </td>
        <td>
          <h6>{{count($basics->where('status', 1)->where('bimester', 5)->where('type', 2))}}</h6>
        </td>
      </tr>
      <tr>
        <th scope="row">
          <h6>No entregados|No localizados</h6>
        </th>
        <td>
          <h6>{{count($basics->where('status', 2)->where('bimester', 1)->where('type', 2))}}</h6>
        </td>
        <td>
          <h6>{{count($basics->where('status', 2)->where('bimester', 2)->where('type', 2))}}</h6>
        </td>
        <td>
          <h6>{{count($basics->where('status', 2)->where('bimester', 3)->where('type', 2))}}</h6>
        </td>
        <td>
          <h6>{{count($basics->where('status', 2)->where('bimester', 4)->where('type', 2))}}</h6>
        </td>
        <td>
          <h6>{{count($basics->where('status', 2)->where('bimester', 5)->where('type', 2))}}</h6>
        </td>
      </tr>
      <tr>
        <th scope="row">
          <h6>No entregados|Por baja</h6>
        </th>
        <td>
          <h6>{{count($basics->where('status', 3)->where('bimester', 1)->where('type', 2))}}</h6>
        </td>
        <td>
          <h6>{{count($basics->where('status', 3)->where('bimester', 2)->where('type', 2))}}</h6>
        </td>
        <td>
          <h6>{{count($basics->where('status', 3)->where('bimester', 3)->where('type', 2))}}</h6>
        </td>
        <td>
          <h6>{{count($basics->where('status', 3)->where('bimester', 4)->where('type', 2))}}</h6>
        </td>
        <td>
          <h6>{{count($basics->where('status', 3)->where('bimester', 5)->where('type', 2))}}</h6>
        </td>
      </tr>
    </tbody>
  </table>
</center>

<center>
  <h6>EDUCACION MEDIA SUPERIOR</h6>
</center>

<center>
  <table class="table table-bordered">
    <thead class="thead-light">
      <tr>
        <th scope="col" style="width:40%; height:5%">
          <h6>ESTATUS</h6>
        </th>
        <th scope="col">
          <h6>Enero Febrero</h6>
        </th>
        <th scope="col">
          <h6>Marzo Abril</h6>
        </th>
        <th scope="col">
          <h6>Mayo Junio</h6>
        </th>
        <th scope="col">
          <h6>Septiembre Octubre</h6>
        </th>
        <th scope="col">
          <h6>Noviembre Diciembre</h6>
        </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">
          <h6>Pendientes</h6>
        </th>
        <td>
          <h6>{{count($mediums->where('status', 0)->where('bimester', 1))}}</h6>
        </td>
        <td>
          <h6>{{count($mediums->where('status', 0)->where('bimester', 2))}}</h6>
        </td>
        <td>
          <h6>{{count($mediums->where('status', 0)->where('bimester', 3))}}</h6>
        </td>
        <td>
          <h6>{{count($mediums->where('status', 0)->where('bimester', 4))}}</h6>
        </td>
        <td>
          <h6>{{count($mediums->where('status', 0)->where('bimester', 5))}}</h6>
        </td>
      </tr>
      <tr>
        <th scope="row">
          <h6>Entregados</h6>
        </th>
        <td>
          <h6>{{count($mediums->where('status', 1)->where('bimester', 1))}}</h6>
        </td>
        <td>
          <h6>{{count($mediums->where('status', 1)->where('bimester', 2))}}</h6>
        </td>
        <td>
          <h6>{{count($mediums->where('status', 1)->where('bimester', 3))}}</h6>
        </td>
        <td>
          <h6>{{count($mediums->where('status', 1)->where('bimester', 4))}}</h6>
        </td>
        <td>
          <h6>{{count($mediums->where('status', 1)->where('bimester', 5))}}</h6>
        </td>
      </tr>
      <tr>
        <th scope="row">
          <h6>No entregados|No localizados</h6>
        </th>
        <td>
          <h6>{{count($mediums->where('status', 2)->where('bimester', 1))}}</h6>
        </td>
        <td>
          <h6>{{count($mediums->where('status', 2)->where('bimester', 2))}}</h6>
        </td>
        <td>
          <h6>{{count($mediums->where('status', 2)->where('bimester', 3))}}</h6>
        </td>
        <td>
          <h6>{{count($mediums->where('status', 2)->where('bimester', 4))}}</h6>
        </td>
        <td>
          <h6>{{count($mediums->where('status', 2)->where('bimester', 5))}}</h6>
        </td>
      </tr>
      <tr>
        <th scope="row">
          <h6>No entregados|Por baja</h6>
        </th>
        <td>
          <h6>{{count($mediums->where('status', 3)->where('bimester', 1))}}</h6>
        </td>
        <td>
          <h6>{{count($mediums->where('status', 3)->where('bimester', 2))}}</h6>
        </td>
        <td>
          <h6>{{count($mediums->where('status', 3)->where('bimester', 3))}}</h6>
        </td>
        <td>
          <h6>{{count($mediums->where('status', 3)->where('bimester', 4))}}</h6>
        </td>
        <td>
          <h6>{{count($mediums->where('status', 3)->where('bimester', 5))}}</h6>
        </td>
      </tr>
      <tr>
        <th scope="row">
          <h6>Reexpedicion</h6>
        </th>
        <td>
          <h6>{{count($mediums->where('status', 4)->where('bimester', 1))}}</h6>
        </td>
        <td>
          <h6>{{count($mediums->where('status', 4)->where('bimester', 2))}}</h6>
        </td>
        <td>
          <h6>{{count($mediums->where('status', 4)->where('bimester', 3))}}</h6>
        </td>
        <td>
          <h6>{{count($mediums->where('status', 4)->where('bimester', 4))}}</h6>
        </td>
        <td>
          <h6>{{count($mediums->where('status', 4)->where('bimester', 5))}}</h6>
        </td>
      </tr>
    </tbody>
  </table>
</center>

<hr style="color: #0056b2;" width="100%" />

<center>
  <h6>JOVENES ESCRIBIENDO EL FUTURO</h6>
</center>

<table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th scope="col" style="width:40%; height:5%">
        <h6>ESTATUS</h6>
      </th>
      <th scope="col">
        <h6>Enero Febrero</h6>
      </th>
      <th scope="col">
        <h6>Marzo Abril</h6>
      </th>
      <th scope="col">
        <h6>Mayo Junio</h6>
      </th>
      <th scope="col">
        <h6>Septiembre Octubre</h6>
      </th>
      <th scope="col">
        <h6>Noviembre Diciembre</h6>
      </th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">
        <h6>Pendientes</h6>
      </th>
      <td>
        <h6>{{count($higers->where('status', 0)->where('bimester', 1))}}</h6>
      </td>
      <td>
        <h6>{{count($higers->where('status', 0)->where('bimester', 2))}}</h6>
      </td>
      <td>
        <h6>{{count($higers->where('status', 0)->where('bimester', 3))}}</h6>
      </td>
      <td>
        <h6>{{count($higers->where('status', 0)->where('bimester', 4))}}</h6>
      </td>
      <td>
        <h6>{{count($higers->where('status', 0)->where('bimester', 5))}}</h6>
      </td>
    </tr>
    <tr>
      <th scope="row">
        <h6>Entregados</h6>
      </th>
      <td>
        <h6>{{count($higers->where('status', 1)->where('bimester', 1))}}</h6>
      </td>
      <td>
        <h6>{{count($higers->where('status', 1)->where('bimester', 2))}}</h6>
      </td>
      <td>
        <h6>{{count($higers->where('status', 1)->where('bimester', 3))}}</h6>
      </td>
      <td>
        <h6>{{count($higers->where('status', 1)->where('bimester', 4))}}</h6>
      </td>
      <td>
        <h6>{{count($higers->where('status', 1)->where('bimester', 5))}}</h6>
      </td>
    </tr>
    <tr>
      <th scope="row">
        <h6>No entregados|No localizados</h6>
      </th>
      <td>
        <h6>{{count($higers->where('status', 2)->where('bimester', 1))}}</h6>
      </td>
      <td>
        <h6>{{count($higers->where('status', 2)->where('bimester', 2))}}</h6>
      </td>
      <td>
        <h6>{{count($higers->where('status', 2)->where('bimester', 3))}}</h6>
      </td>
      <td>
        <h6>{{count($higers->where('status', 2)->where('bimester', 4))}}</h6>
      </td>
      <td>
        <h6>{{count($higers->where('status', 2)->where('bimester', 5))}}</h6>
      </td>
    </tr>
    <tr>
      <th scope="row">
        <h6>No entregados|Por baja</h6>
      </th>
      <td>
        <h6>{{count($higers->where('status', 3)->where('bimester', 1))}}</h6>
      </td>
      <td>
        <h6>{{count($higers->where('status', 3)->where('bimester', 2))}}</h6>
      </td>
      <td>
        <h6>{{count($higers->where('status', 3)->where('bimester', 3))}}</h6>
      </td>
      <td>
        <h6>{{count($higers->where('status', 3)->where('bimester', 4))}}</h6>
      </td>
      <td>
        <h6>{{count($higers->where('status', 3)->where('bimester', 5))}}</h6>
      </td>
    </tr>
  </tbody>
</table>

<br><br><br><br><br><br><br><br>
<center>
  <FONT FACE="impact" SIZE=2>&copy; {{@date('Y')}} {{'Subdireccion de atencion operativa - Oaxaca, Todos los derechos reservados'}}</FONT>
</center>
@endsection