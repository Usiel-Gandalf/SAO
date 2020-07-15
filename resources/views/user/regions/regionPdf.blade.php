@extends('plantillas.pdf')
@section('pdf')
<center><img class="mt-0" src="https://qroo.gob.mx/sites/default/files/inline-images/BECAS_COORDINACION_logo.png" class="img-fluid" alt="Responsive image" width="60%" height="70%"></center>

<center>
  <h5 class="mt-1"><b>SUBDIRECCION DE ATENCION OPERATIVA</b></h5>
</center>

<center>
  <h6>REPORTE GENERAL DE REGION | {{@date('d-m-Y')}} | Administrador: {{Auth::user()->name}} {{Auth::user()->firstSurname}} {{Auth::user()->secondSurname}}</h6>
</center>

<center>
  <h6>
    @if($bossRegion->count() == 0)
    {{'RESPONSABLE DE LA REGION: Sin Jefe'}}
    @elseif($bossRegion->count() >= 2)
    @foreach($bossRegion as $boss)
    {{'RESPONSABLES DE LA REGION:'}} {{$boss->name}} {{$boss->firstSurname}} {{$boss->secondSurname}},
    @endforeach
    @else
    @foreach($bossRegion as $boss)
    {{'RESPONSABLE DE LA REGION:'}} {{$boss->name}} {{$boss->firstSurname}} {{$boss->secondSurname}}
    @endforeach
    @endif
  </h6>
</center>

<hr style="color: #0056b2;" width="100%" />

<center>
  @foreach($regionInfo as $region)
  <h6><b>REGION:</b> {{$region->nameRegion}} | <b>CLAVE:</b> {{$region->id}} | <b>NUMERO:</b> {{$region->region}}</h6>
  @endforeach
</center>
<br>
<center>
  <h6>EDUCACION BASICA - CERM</h6>
</center>

<center>
  <table class="table table-bordered">
    <thead class="thead-dark">
      <tr>
        <th scope="col" style="width:30%; height:5%">
          <h6 style="font-size: 12px;">Estatus</h6>
        </th>
        <th scope="col">
          <h6 style="font-size: 12px;">Enero Febrero</h6>
        </th>
        <th scope="col">
          <h6 style="font-size: 12px;">Marzo Abril</h6>
        </th>
        <th scope="col">
          <h6 style="font-size: 12px;">Mayo Junio</h6>
        </th>
        <th scope="col">
          <h6 style="font-size: 12px;">Septiembre Octubre</h6>
        </th>
        <th scope="col">
          <h6 style="font-size: 12px;">Noviembre Diciembre</h6>
        </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">
          <h6 style="font-size: 12px;">Pendientes</h6>
        </th>
        <td>
          <h6 style="font-size: 12px;">{{$basicsCermBim1->where('status', 0)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$basicsCermBim2->where('status', 0)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$basicsCermBim3->where('status', 0)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$basicsCermBim4->where('status', 0)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$basicsCermBim4->where('status', 0)->count()}}</h6>
        </td>
      </tr>
      <tr>
        <th scope="row">
          <h6 style="font-size: 12px;">Entregados</h6>
        </th>
        <td>
          <h6 style="font-size: 12px;">{{$basicsCermBim1->where('status', 1)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$basicsCermBim2->where('status', 1)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$basicsCermBim3->where('status', 1)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$basicsCermBim4->where('status', 1)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$basicsCermBim5->where('status', 1)->count()}}</h6>
        </td>
      </tr>
      <tr>
        <th scope="row">
          <h6 style="font-size: 12px;">No entregados|No localizados</h6>
        </th>
        <td>
          <h6 style="font-size: 12px;">{{$basicsCermBim1->where('status', 2)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$basicsCermBim2->where('status', 2)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$basicsCermBim3->where('status', 2)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$basicsCermBim4->where('status', 2)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$basicsCermBim5->where('status', 2)->count()}}</h6>
        </td>
      </tr>
      <tr>
        <th scope="row">
          <h6 style="font-size: 12px;">No entregados|Por baja</h6>
        </th>
        <td>
          <h6 style="font-size: 12px;">{{$basicsCermBim1->where('status', 3)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$basicsCermBim2->where('status', 3)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$basicsCermBim3->where('status', 3)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$basicsCermBim4->where('status', 3)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$basicsCermBim5->where('status', 3)->count()}}</h6>
        </td>
      </tr>
    </tbody>
  </table>
</center>
<br><br>

<center>
  <h6>EDUCACION BASICA - AVISOS DE COBRO</h6>
</center>

<center>
  <table class="table table-bordered">
    <thead class="thead-dark">
      <tr>
        <th scope="col" style="width:30%; height:5%">
          <h6 style="font-size: 12px;">Estatus</h6>
        </th>
        <th scope="col">
          <h6 style="font-size: 12px;">Enero Febrero</h6>
        </th>
        <th scope="col">
          <h6 style="font-size: 12px;">Marzo Abril</h6>
        </th>
        <th scope="col">
          <h6 style="font-size: 12px;">Mayo Junio</h6>
        </th>
        <th scope="col">
          <h6 style="font-size: 12px;">Septiembre Octubre</h6>
        </th>
        <th scope="col">
          <h6 style="font-size: 12px;">Noviembre Diciembre</h6>
        </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">
          <h6 style="font-size: 12px;">Pendientes</h6>
        </th>
        <td>
          <h6 style="font-size: 12px;">{{$basicsDeliveryBim1->where('status', 0)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$basicsDeliveryBim2->where('status', 0)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$basicsDeliveryBim3->where('status', 0)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$basicsDeliveryBim4->where('status', 0)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$basicsDeliveryBim5->where('status', 0)->count()}}</h6>
        </td>
      </tr>
      <tr>
        <th scope="row">
          <h6 style="font-size: 12px;">Entregados</h6>
        </th>
        <td>
          <h6 style="font-size: 12px;">{{$basicsDeliveryBim1->where('status', 1)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$basicsDeliveryBim2->where('status', 1)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$basicsDeliveryBim3->where('status', 1)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$basicsDeliveryBim4->where('status', 1)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$basicsDeliveryBim5->where('status', 1)->count()}}</h6>
        </td>
      </tr>
      <tr>
        <th scope="row">
          <h6 style="font-size: 12px;">No entregados|No localizados</h6>
        </th>
        <td>
          <h6 style="font-size: 12px;">{{$basicsDeliveryBim1->where('status', 2)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$basicsDeliveryBim2->where('status', 2)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$basicsDeliveryBim3->where('status', 2)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$basicsDeliveryBim4->where('status', 2)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$basicsDeliveryBim5->where('status', 2)->count()}}</h6>
        </td>
      </tr>
      <tr>
        <th scope="row">
          <h6 style="font-size: 12px;">No entregados|Por baja</h6>
        </th>
        <td>
          <h6 style="font-size: 12px;">{{$basicsDeliveryBim1->where('status', 3)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$basicsDeliveryBim2->where('status', 3)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$basicsDeliveryBim3->where('status', 3)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$basicsDeliveryBim4->where('status', 3)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$basicsDeliveryBim5->where('status', 3)->count()}}</h6>
        </td>
      </tr>
    </tbody>
  </table>
</center>
<br>

<hr style="color: #0056b2;" width="100%" />

<center>
  <h6>EDUCACION MEDIA SUPERIOR</h6>
</center>

<center>
  <table class="table table-bordered">
    <thead class="thead-dark">
      <tr>
        <th scope="col" style="width:30%; height:5%;">
          <h6 style="font-size: 12px;">Estatus</h6>
        </th>
        <th scope="col">
          <h6 style="font-size: 12px;">Enero Febrero</h6>
        </th>
        <th scope="col">
          <h6 style="font-size: 12px;">Marzo Abril</h6>
        </th>
        <th scope="col">
          <h6 style="font-size: 12px;">Mayo Junio</h6>
        </th>
        <th scope="col">
          <h6 style="font-size: 12px;">Septiembre Octubre</h6>
        </th>
        <th scope="col">
          <h6 style="font-size: 12px;">Noviembre Diciembre</h6>
        </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">
          <h6 style="font-size: 12px;">Pendientes</h6>
        </th>
        <td>
          <h6 style="font-size: 12px;">{{$mediumsBim1->where('status', 0)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$mediumsBim2->where('status', 0)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$mediumsBim3->where('status', 0)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$mediumsBim4->where('status', 0)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$mediumsBim5->where('status', 0)->count()}}</h6>
        </td>
      </tr>
      <tr>
        <th scope="row">
          <h6 style="font-size: 12px;">Entregados</h6>
        </th>
        <td>
          <h6 style="font-size: 12px;">{{$mediumsBim1->where('status', 1)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$mediumsBim2->where('status', 1)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$mediumsBim3->where('status', 1)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$mediumsBim4->where('status', 1)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$mediumsBim5->where('status', 1)->count()}}</h6>
        </td>
      </tr>
      <tr>
        <th scope="row">
          <h6 style="font-size: 12px;">No entregados|No localizados</h6>
        </th>
        <td>
          <h6 style="font-size: 12px;">{{$mediumsBim1->where('status', 2)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$mediumsBim2->where('status', 2)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$mediumsBim3->where('status', 2)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$mediumsBim4->where('status', 2)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$mediumsBim5->where('status', 2)->count()}}</h6>
        </td>
      </tr>
      <tr>
        <th scope="row">
          <h6 style="font-size: 12px;">No entregados|Por baja</h6>
        </th>
        <td>
          <h6 style="font-size: 12px;">{{$mediumsBim1->where('status', 3)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$mediumsBim2->where('status', 3)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$mediumsBim3->where('status', 3)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$mediumsBim4->where('status', 3)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$mediumsBim5->where('status', 3)->count()}}</h6>
        </td>
      </tr>
    </tbody>
  </table>
</center>
<br>

<center>
  <h6>REEXPEDICIONES MEDIA SUPERIOR</h6>
</center>

<center>
  <table class="table table-bordered">
    <thead class="thead-dark">
      <tr>
        <th scope="col" style="width:30%; height:5%;">
          <h6 style="font-size: 12px;">Estatus</h6>
        </th>
        <th scope="col">
          <h6 style="font-size: 12px;">Enero Febrero</h6>
        </th>
        <th scope="col">
          <h6 style="font-size: 12px;">Marzo Abril</h6>
        </th>
        <th scope="col">
          <h6 style="font-size: 12px;">Mayo Junio</h6>
        </th>
        <th scope="col">
          <h6 style="font-size: 12px;">Septiembre Octubre</h6>
        </th>
        <th scope="col">
          <h6 style="font-size: 12px;">Noviembre Diciembre</h6>
        </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">
          <h6 style="font-size: 12px;">Pendientes</h6>
        </th>
        <td>
          <h6 style="font-size: 12px;">{{$reissueBim1->where('status', 0)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$reissueBim2->where('status', 0)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$reissueBim3->where('status', 0)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$reissueBim4->where('status', 0)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$reissueBim5->where('status', 0)->count()}}</h6>
        </td>
      </tr>
      <tr>
        <th scope="row">
          <h6 style="font-size: 12px;">Entregados</h6>
        </th>
        <td>
          <h6 style="font-size: 12px;">{{$reissueBim1->where('status', 1)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$reissueBim2->where('status', 1)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$reissueBim3->where('status', 1)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$reissueBim4->where('status', 1)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$reissueBim5->where('status', 1)->count()}}</h6>
        </td>
      </tr>
      <tr>
        <th scope="row">
          <h6 style="font-size: 12px;">No entregados|No localizados</h6>
        </th>
        <td>
          <h6 style="font-size: 12px;">{{$reissueBim1->where('status', 2)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$reissueBim2->where('status', 2)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$reissueBim3->where('status', 2)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$reissueBim4->where('status', 2)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$reissueBim5->where('status', 2)->count()}}</h6>
        </td>
      </tr>
      <tr>
        <th scope="row">
          <h6 style="font-size: 12px;">No entregados|Por baja</h6>
        </th>
        <td>
          <h6 style="font-size: 12px;">{{$reissueBim1->where('status', 3)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$reissueBim2->where('status', 3)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$reissueBim3->where('status', 3)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$reissueBim4->where('status', 3)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$reissueBim5->where('status', 3)->count()}}</h6>
        </td>
      </tr>
    </tbody>
  </table>
</center>

<hr style="color: #0056b2;" width="100%" />

<center>
  <h6>JOVENES ESCRIBIENDO EL FUTURO</h6>
</center>

<center>
  <table class="table table-bordered">
    <thead class="thead-dark">
      <tr>
        <th scope="col" style="width:30%; height:5%">
          <h6 style="font-size: 12px;">ESTATUS</h6>
        </th>
        <th scope="col">
          <h6 style="font-size: 12px;">Enero Febrero</h6>
        </th>
        <th scope="col">
          <h6 style="font-size: 12px;">Marzo Abril</h6>
        </th>
        <th scope="col">
          <h6 style="font-size: 12px;">Mayo Junio</h6>
        </th>
        <th scope="col">
          <h6 style="font-size: 12px;">Septiembre Octubre</h6>
        </th>
        <th scope="col">
          <h6 style="font-size: 12px;">Noviembre Diciembre</h6>
        </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">
          <h6 style="font-size: 12px;">Pendientes</h6>
        </th>
        <td>
          <h6 style="font-size: 12px;">{{$higersBim1->where('status', 0)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$higersBim2->where('status', 0)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$higersBim3->where('status', 0)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$higersBim4->where('status', 0)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$higersBim5->where('status', 0)->count()}}</h6>
        </td>
      </tr>
      <tr>
        <th scope="row">
          <h6 style="font-size: 12px;">Entregados</h6>
        </th>
        <td>
          <h6 style="font-size: 12px;">{{$higersBim1->where('status', 1)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$higersBim2->where('status', 1)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$higersBim3->where('status', 1)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$higersBim4->where('status', 1)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$higersBim5->where('status', 1)->count()}}</h6>
        </td>
      </tr>
      <tr>
        <th scope="row">
          <h6 style="font-size: 12px;">No entregados|No localizados</h6>
        </th>
        <td>
          <h6 style="font-size: 12px;">{{$higersBim1->where('status', 2)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$higersBim2->where('status', 2)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$higersBim3->where('status', 2)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$higersBim4->where('status', 2)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$higersBim5->where('status', 2)->count()}}</h6>
        </td>
      </tr>
      <tr>
        <th scope="row">
          <h6 style="font-size: 12px;">No entregados|Por baja</h6>
        </th>
        <td>
          <h6 style="font-size: 12px;">{{$higersBim1->where('status', 3)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$higersBim2->where('status', 3)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$higersBim3->where('status', 3)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$higersBim4->where('status', 3)->count()}}</h6>
        </td>
        <td>
          <h6 style="font-size: 12px;">{{$higersBim5->where('status', 3)->count()}}</h6>
        </td>
      </tr>
    </tbody>
  </table>
</center>

<center>
<small>Copyright &copy; {{@date('Y')}}  Subdireccion de atencion operativa, Coordinacion Nacional de Becas Para el Bienestar
                "Benito Juarez" en el Estado de Oaxaca</small>
</center>
@endsection