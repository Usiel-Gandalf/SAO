<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <title>Hello, world!</title>
</head>

<body>
  <center><img class="mt-0" src="https://qroo.gob.mx/sites/default/files/inline-images/BECAS_COORDINACION_logo.png" class="img-fluid" alt="Responsive image" width="60%" height="70%"></center>

  <center>
    <h5 class="mt-1"><b>SUBDIRECCION DE ATENCION OPERATIVA</b></h5>
  </center>

  <center>
    <h6>REPORTE GENERAL</h6>
  </center>

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
          <td scope="col"><b>REGION:</b> {{$region->nameRegion}}</td>
          <td scope="col"><b>CLAVE:</b> {{$region->id}}</td>
          <td scope="col"><b>NUMERO:</b> {{$region->region}}</td>
        </tr>
        @endforeach
      </thead>
    </table>
  </center>

  <hr style="color: #0056b2;" width="100%" />

  <center>
    <h5>EDUCACION BASICA - CERM</h5>
  </center>

  <center>
    <table class="table table-bordered">
      <thead class="thead-light">
        <tr>
          <th scope="col" style="width:65%; height:3px">Estatus</th>
          <th scope="col">Enero Febrero</th>
          <th scope="col">Marzo Abril</th>
          <th scope="col">Mayo Junio</th>
          <th scope="col">Septiembre Octubre</th>
          <th scope="col">Noviembre Diciembre</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">Pendientes</th>
          <td>{{count($basics->where('status', 0)->where('bimester', 1)->where('type', 1))}}</td>
          <td>{{count($basics->where('status', 0)->where('bimester', 2)->where('type', 1))}}</td>
          <td>{{count($basics->where('status', 0)->where('bimester', 3)->where('type', 1))}}</td>
          <td>{{count($basics->where('status', 0)->where('bimester', 4)->where('type', 1))}}</td>
          <td>{{count($basics->where('status', 0)->where('bimester', 5)->where('type', 1))}}</td>
        </tr>
        <tr>
          <th scope="row">Entregados</th>
          <td>{{count($basics->where('status', 1)->where('bimester', 1)->where('type', 1))}}</td>
          <td>{{count($basics->where('status', 1)->where('bimester', 2)->where('type', 1))}}</td>
          <td>{{count($basics->where('status', 1)->where('bimester', 3)->where('type', 1))}}</td>
          <td>{{count($basics->where('status', 1)->where('bimester', 4)->where('type', 1))}}</td>
          <td>{{count($basics->where('status', 1)->where('bimester', 5)->where('type', 1))}}</td>
        </tr>
        <tr>
          <th scope="row">No entregados|No localizados</th>
          <td>{{count($basics->where('status', 2)->where('bimester', 1)->where('type', 1))}}</td>
          <td>{{count($basics->where('status', 2)->where('bimester', 2)->where('type', 1))}}</td>
          <td>{{count($basics->where('status', 2)->where('bimester', 3)->where('type', 1))}}</td>
          <td>{{count($basics->where('status', 2)->where('bimester', 4)->where('type', 1))}}</td>
          <td>{{count($basics->where('status', 2)->where('bimester', 5)->where('type', 1))}}</td>
        </tr>
        <tr>
          <th scope="row">No entregados|Por baja</th>
          <td>{{count($basics->where('status', 3)->where('bimester', 1)->where('type', 1))}}</td>
          <td>{{count($basics->where('status', 3)->where('bimester', 2)->where('type', 1))}}</td>
          <td>{{count($basics->where('status', 3)->where('bimester', 3)->where('type', 1))}}</td>
          <td>{{count($basics->where('status', 3)->where('bimester', 4)->where('type', 1))}}</td>
          <td>{{count($basics->where('status', 3)->where('bimester', 5)->where('type', 1))}}</td>
        </tr>
      </tbody>
    </table>
  </center>

  <hr style="color: #0056b2;" width="100%" />

  <center>
    <h5>EDUCACION BASICA - AVISOS DE COBRO</h5>
  </center>

  <center>
    <table class="table table-bordered">
      <thead class="thead-light">
        <tr>
          <th scope="col" style="width:65%; height:3px">ESTATUS</th>
          <th scope="col">Enero Febrero</th>
          <th scope="col">Marzo Abril</th>
          <th scope="col">Mayo Junio</th>
          <th scope="col">Septiembre Octubre</th>
          <th scope="col">Noviembre Diciembre</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">Pendientes</th>
          <td>{{count($basics->where('status', 0)->where('bimester', 1)->where('type', 2))}}</td>
          <td>{{count($basics->where('status', 0)->where('bimester', 2)->where('type', 2))}}</td>
          <td>{{count($basics->where('status', 0)->where('bimester', 3)->where('type', 2))}}</td>
          <td>{{count($basics->where('status', 0)->where('bimester', 4)->where('type', 2))}}</td>
          <td>{{count($basics->where('status', 0)->where('bimester', 5)->where('type', 2))}}</td>
        </tr>
        <tr>
          <th scope="row">Entregados</th>
          <td>{{count($basics->where('status', 1)->where('bimester', 1)->where('type', 2))}}</td>
          <td>{{count($basics->where('status', 1)->where('bimester', 2)->where('type', 2))}}</td>
          <td>{{count($basics->where('status', 1)->where('bimester', 3)->where('type', 2))}}</td>
          <td>{{count($basics->where('status', 1)->where('bimester', 4)->where('type', 2))}}</td>
          <td>{{count($basics->where('status', 1)->where('bimester', 5)->where('type', 2))}}</td>
        </tr>
        <tr>
          <th scope="row">No entregados - No localizados</th>
          <td>{{count($basics->where('status', 2)->where('bimester', 1)->where('type', 2))}}</td>
          <td>{{count($basics->where('status', 2)->where('bimester', 2)->where('type', 2))}}</td>
          <td>{{count($basics->where('status', 2)->where('bimester', 3)->where('type', 2))}}</td>
          <td>{{count($basics->where('status', 2)->where('bimester', 4)->where('type', 2))}}</td>
          <td>{{count($basics->where('status', 2)->where('bimester', 5)->where('type', 2))}}</td>
        </tr>
        <tr>
          <th scope="row">No entregados - Por baja</th>
          <td>{{count($basics->where('status', 3)->where('bimester', 1)->where('type', 2))}}</td>
          <td>{{count($basics->where('status', 3)->where('bimester', 2)->where('type', 2))}}</td>
          <td>{{count($basics->where('status', 3)->where('bimester', 3)->where('type', 2))}}</td>
          <td>{{count($basics->where('status', 3)->where('bimester', 4)->where('type', 2))}}</td>
          <td>{{count($basics->where('status', 3)->where('bimester', 5)->where('type', 2))}}</td>
        </tr>
      </tbody>
    </table>
  </center>

  <center>
    <h5>EDUCACION MEDIA SUPERIOR</h5>
  </center>

  <center>
    <table class="table table-bordered">
      <thead class="thead-light">
        <tr>
          <th scope="col" style="width:65%; height:3px">ESTATUS</th>
          <th scope="col">Enero Febrero</th>
          <th scope="col">Marzo Abril</th>
          <th scope="col">Mayo Junio</th>
          <th scope="col">Septiembre Octubre</th>
          <th scope="col">Noviembre Diciembre</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">Pendientes</th>
          <td>{{count($mediums->where('status', 0)->where('bimester', 1))}}</td>
          <td>{{count($mediums->where('status', 0)->where('bimester', 2))}}</td>
          <td>{{count($mediums->where('status', 0)->where('bimester', 3))}}</td>
          <td>{{count($mediums->where('status', 0)->where('bimester', 4))}}</td>
          <td>{{count($mediums->where('status', 0)->where('bimester', 5))}}</td>
        </tr>
        <tr>
          <th scope="row">Entregados</th>
          <td>{{count($mediums->where('status', 1)->where('bimester', 1))}}</td>
          <td>{{count($mediums->where('status', 1)->where('bimester', 2))}}</td>
          <td>{{count($mediums->where('status', 1)->where('bimester', 3))}}</td>
          <td>{{count($mediums->where('status', 1)->where('bimester', 4))}}</td>
          <td>{{count($mediums->where('status', 1)->where('bimester', 5))}}</td>
        </tr>
        <tr>
          <th scope="row">No entregados - No localizados</th>
          <td>{{count($mediums->where('status', 2)->where('bimester', 1))}}</td>
          <td>{{count($mediums->where('status', 2)->where('bimester', 2))}}</td>
          <td>{{count($mediums->where('status', 2)->where('bimester', 3))}}</td>
          <td>{{count($mediums->where('status', 2)->where('bimester', 4))}}</td>
          <td>{{count($mediums->where('status', 2)->where('bimester', 5))}}</td>
        </tr>
        <tr>
          <th scope="row">No entregados - Por baja</th>
          <td>{{count($mediums->where('status', 3)->where('bimester', 1))}}</td>
          <td>{{count($mediums->where('status', 3)->where('bimester', 2))}}</td>
          <td>{{count($mediums->where('status', 3)->where('bimester', 3))}}</td>
          <td>{{count($mediums->where('status', 3)->where('bimester', 4))}}</td>
          <td>{{count($mediums->where('status', 3)->where('bimester', 5))}}</td>
        </tr>
        <tr>
          <th scope="row">Reexpedicion</th>
          <td>{{count($mediums->where('status', 4)->where('bimester', 1))}}</td>
          <td>{{count($mediums->where('status', 4)->where('bimester', 2))}}</td>
          <td>{{count($mediums->where('status', 4)->where('bimester', 3))}}</td>
          <td>{{count($mediums->where('status', 4)->where('bimester', 4))}}</td>
          <td>{{count($mediums->where('status', 4)->where('bimester', 5))}}</td>
        </tr>
      </tbody>
    </table>
  </center>

  <hr style="color: #0056b2;" width="100%" />

  <center>
    <h5>JOVENES ESCRIBIENDO EL FUTURO</h5>
  </center>

  <table class="table table-bordered">
    <thead class="thead-light">
      <tr>
        <th scope="col" style="width:65%; height:3px">ESTATUS</th>
        <th scope="col">Enero Febrero</th>
        <th scope="col">Marzo Abril</th>
        <th scope="col">Mayo Junio</th>
        <th scope="col">Septiembre Octubre</th>
        <th scope="col">Noviembre Diciembre</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">Pendientes</th>
        <td>{{count($higers->where('status', 0)->where('bimester', 1))}}</td>
        <td>{{count($higers->where('status', 0)->where('bimester', 2))}}</td>
        <td>{{count($higers->where('status', 0)->where('bimester', 3))}}</td>
        <td>{{count($higers->where('status', 0)->where('bimester', 4))}}</td>
        <td>{{count($higers->where('status', 0)->where('bimester', 5))}}</td>
      </tr>
      <tr>
        <th scope="row">Entregados</th>
        <td>{{count($higers->where('status', 1)->where('bimester', 1))}}</td>
        <td>{{count($higers->where('status', 1)->where('bimester', 2))}}</td>
        <td>{{count($higers->where('status', 1)->where('bimester', 3))}}</td>
        <td>{{count($higers->where('status', 1)->where('bimester', 4))}}</td>
        <td>{{count($higers->where('status', 1)->where('bimester', 5))}}</td>
      </tr>
      <tr>
        <th scope="row">No entregados - No localizados</th>
        <td>{{count($higers->where('status', 2)->where('bimester', 1))}}</td>
        <td>{{count($higers->where('status', 2)->where('bimester', 2))}}</td>
        <td>{{count($higers->where('status', 2)->where('bimester', 3))}}</td>
        <td>{{count($higers->where('status', 2)->where('bimester', 4))}}</td>
        <td>{{count($higers->where('status', 2)->where('bimester', 5))}}</td>
      </tr>
      <tr>
        <th scope="row">No entregados - Por baja</th>
        <td>{{count($higers->where('status', 3)->where('bimester', 1))}}</td>
        <td>{{count($higers->where('status', 3)->where('bimester', 2))}}</td>
        <td>{{count($higers->where('status', 3)->where('bimester', 3))}}</td>
        <td>{{count($higers->where('status', 3)->where('bimester', 4))}}</td>
        <td>{{count($higers->where('status', 3)->where('bimester', 5))}}</td>
      </tr>
    </tbody>
  </table>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>