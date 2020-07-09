@extends('plantillas.pdf')
@section('pdf')
<center><img class="mt-0" src="https://qroo.gob.mx/sites/default/files/inline-images/BECAS_COORDINACION_logo.png" class="img-fluid" alt="Responsive image" width="60%" height="70%"></center>

<center>
    <h5 class="mt-1"><b>SUBDIRECCION DE ATENCION OPERATIVA</b></h5>
</center>

<center>
    <h6><b>REPORTE GENERAL DE LOCALIDAD | {{@date('d-m-Y')}} | Administrador: {{Auth::user()->name}} {{Auth::user()->firstSurname}} {{Auth::user()->secondSurname}}</b></h6>
</center>

<center>
    @foreach($localityInfo as $locality)
    <h6 style="font-size: 12px;">REGION: {{$locality->municipality->region->nameRegion}} - NUMERO: {{$locality->municipality->region->region}} |
        MUNICIPIO: {{$locality->municipality->nameMunicipality}} |
        @if(count($bossRegion) == 0)
        {{'Sin Jefe asignado'}}
        @elseif(count($bossRegion) >= 2)
        @foreach($bossRegion as $boss)
        {{'Responsables de la region:'}} {{$boss->name}} {{$boss->firstSurname}} {{$boss->secondSurname}},
        @endforeach
        @else
        @foreach($bossRegion as $boss)
        {{'Responsable de la region:'}} {{$boss->name}} {{$boss->firstSurname}} {{$boss->secondSurname}}
        @endforeach
        @endif
        @endforeach</h6>
</center>

<hr style="color: #0056b2;" width="100%" />

<center>
    @foreach($localityInfo as $locality)
    <h6><b>LOCALIDAD:</b> {{$locality->nameLocality}} | <b>NUMERO:</b> {{$locality->keyLocality}} | <b>CLAVE:</b> {{$locality->id}}</h6>
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
                    <h6 style="font-size: 12px;">{{count($basicsCerm->where('status', 0)->where('bimester', 1))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsCerm->where('status', 0)->where('bimester', 2))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsCerm->where('status', 0)->where('bimester', 3))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsCerm->where('status', 0)->where('bimester', 4))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsCerm->where('status', 0)->where('bimester', 5))}}</h6>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <h6 style="font-size: 12px;">Entregados</h6>
                </th>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsCerm->where('status', 1)->where('bimester', 1))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsCerm->where('status', 1)->where('bimester', 2))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsCerm->where('status', 1)->where('bimester', 3))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsCerm->where('status', 1)->where('bimester', 4))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsCerm->where('status', 1)->where('bimester', 5))}}</h6>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <h6 style="font-size: 12px;">No entregados|No localizados</h6>
                </th>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsCerm->where('status', 2)->where('bimester', 1))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsCerm->where('status', 2)->where('bimester', 2))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsCerm->where('status', 2)->where('bimester', 3))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsCerm->where('status', 2)->where('bimester', 4))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsCerm->where('status', 2)->where('bimester', 5))}}</h6>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <h6 style="font-size: 12px;">No entregados|Por baja</h6>
                </th>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsCerm->where('status', 3)->where('bimester', 1))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsCerm->where('status', 3)->where('bimester', 2))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsCerm->where('status', 3)->where('bimester', 3))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsCerm->where('status', 3)->where('bimester', 4))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsCerm->where('status', 3)->where('bimester', 5))}}</h6>
                </td>
            </tr>
        </tbody>
    </table>
</center>

<hr style="color: #0056b2;" width="100%" />
<br>
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
                    <h6 style="font-size: 12px;">{{count($basicsDelivery->where('status', 0)->where('bimester', 1))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsDelivery->where('status', 0)->where('bimester', 2))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsDelivery->where('status', 0)->where('bimester', 3))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsDelivery->where('status', 0)->where('bimester', 4))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsDelivery->where('status', 0)->where('bimester', 5))}}</h6>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <h6 style="font-size: 12px;">Entregados</h6>
                </th>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsDelivery->where('status', 1)->where('bimester', 1))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsDelivery->where('status', 1)->where('bimester', 2))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsDelivery->where('status', 1)->where('bimester', 3))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsDelivery->where('status', 1)->where('bimester', 4))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsDelivery->where('status', 1)->where('bimester', 5))}}</h6>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <h6 style="font-size: 12px;">No entregados|No localizados</h6>
                </th>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsDelivery->where('status', 2)->where('bimester', 1))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsDelivery->where('status', 2)->where('bimester', 2))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsDelivery->where('status', 2)->where('bimester', 3))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsDelivery->where('status', 2)->where('bimester', 4))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsDelivery->where('status', 2)->where('bimester', 5))}}</h6>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <h6 style="font-size: 12px;">No entregados|Por baja</h6>
                </th>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsDelivery->where('status', 3)->where('bimester', 1))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsDelivery->where('status', 3)->where('bimester', 2))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsDelivery->where('status', 3)->where('bimester', 3))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsDelivery->where('status', 3)->where('bimester', 4))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($basicsDelivery->where('status', 3)->where('bimester', 5))}}</h6>
                </td>
            </tr>
        </tbody>
    </table>
</center>
<br><br><br>
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
                    <h6 style="font-size: 12px;">{{count($mediums->where('status', 0)->where('bimester', 1))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($mediums->where('status', 0)->where('bimester', 2))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($mediums->where('status', 0)->where('bimester', 3))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($mediums->where('status', 0)->where('bimester', 4))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($mediums->where('status', 0)->where('bimester', 5))}}</h6>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <h6 style="font-size: 12px;">Entregados</h6>
                </th>
                <td>
                    <h6 style="font-size: 12px;">{{count($mediums->where('status', 1)->where('bimester', 1))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($mediums->where('status', 1)->where('bimester', 2))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($mediums->where('status', 1)->where('bimester', 3))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($mediums->where('status', 1)->where('bimester', 4))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($mediums->where('status', 1)->where('bimester', 5))}}</h6>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <h6 style="font-size: 12px;">No entregados|No localizados</h6>
                </th>
                <td>
                    <h6 style="font-size: 12px;">{{count($mediums->where('status', 2)->where('bimester', 1))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($mediums->where('status', 2)->where('bimester', 2))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($mediums->where('status', 2)->where('bimester', 3))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($mediums->where('status', 2)->where('bimester', 4))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($mediums->where('status', 2)->where('bimester', 5))}}</h6>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <h6 style="font-size: 12px;">No entregados|Por baja</h6>
                </th>
                <td>
                    <h6 style="font-size: 12px;">{{count($mediums->where('status', 3)->where('bimester', 1))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($mediums->where('status', 3)->where('bimester', 2))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($mediums->where('status', 3)->where('bimester', 3))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($mediums->where('status', 3)->where('bimester', 4))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($mediums->where('status', 3)->where('bimester', 5))}}</h6>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <h6 style="font-size: 12px;">Reexpedicion</h6>
                </th>
                <td>
                    <h6 style="font-size: 12px;">{{count($mediums->where('status', 4)->where('bimester', 1))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($mediums->where('status', 4)->where('bimester', 2))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($mediums->where('status', 4)->where('bimester', 3))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($mediums->where('status', 4)->where('bimester', 4))}}</h6>
                </td>
                <td>
                    <h6 style="font-size: 12px;">{{count($mediums->where('status', 4)->where('bimester', 5))}}</h6>
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
                <h6 style="font-size: 12px;">{{count($higers->where('status', 0)->where('bimester', 1))}}</h6>
            </td>
            <td>
                <h6 style="font-size: 12px;">{{count($higers->where('status', 0)->where('bimester', 2))}}</h6>
            </td>
            <td>
                <h6 style="font-size: 12px;">{{count($higers->where('status', 0)->where('bimester', 3))}}</h6>
            </td>
            <td>
                <h6 style="font-size: 12px;">{{count($higers->where('status', 0)->where('bimester', 4))}}</h6>
            </td>
            <td>
                <h6 style="font-size: 12px;">{{count($higers->where('status', 0)->where('bimester', 5))}}</h6>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <h6 style="font-size: 12px;">Entregados</h6>
            </th>
            <td>
                <h6 style="font-size: 12px;">{{count($higers->where('status', 1)->where('bimester', 1))}}</h6>
            </td>
            <td>
                <h6 style="font-size: 12px;">{{count($higers->where('status', 1)->where('bimester', 2))}}</h6>
            </td>
            <td>
                <h6 style="font-size: 12px;">{{count($higers->where('status', 1)->where('bimester', 3))}}</h6>
            </td>
            <td>
                <h6 style="font-size: 12px;">{{count($higers->where('status', 1)->where('bimester', 4))}}</h6>
            </td>
            <td>
                <h6 style="font-size: 12px;">{{count($higers->where('status', 1)->where('bimester', 5))}}</h6>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <h6 style="font-size: 12px;">No entregados|No localizados</h6>
            </th>
            <td>
                <h6 style="font-size: 12px;">{{count($higers->where('status', 2)->where('bimester', 1))}}</h6>
            </td>
            <td>
                <h6 style="font-size: 12px;">{{count($higers->where('status', 2)->where('bimester', 2))}}</h6>
            </td>
            <td>
                <h6 style="font-size: 12px;">{{count($higers->where('status', 2)->where('bimester', 3))}}</h6>
            </td>
            <td>
                <h6 style="font-size: 12px;">{{count($higers->where('status', 2)->where('bimester', 4))}}</h6>
            </td>
            <td>
                <h6 style="font-size: 12px;">{{count($higers->where('status', 2)->where('bimester', 5))}}</h6>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <h6 style="font-size: 12px;">No entregados|Por baja</h6>
            </th>
            <td>
                <h6 style="font-size: 12px;">{{count($higers->where('status', 3)->where('bimester', 1))}}</h6>
            </td>
            <td>
                <h6 style="font-size: 12px;">{{count($higers->where('status', 3)->where('bimester', 2))}}</h6>
            </td>
            <td>
                <h6 style="font-size: 12px;">{{count($higers->where('status', 3)->where('bimester', 3))}}</h6>
            </td>
            <td>
                <h6 style="font-size: 12px;">{{count($higers->where('status', 3)->where('bimester', 4))}}</h6>
            </td>
            <td>
                <h6 style="font-size: 12px;">{{count($higers->where('status', 3)->where('bimester', 5))}}</h6>
            </td>
        </tr>
    </tbody>
</table>

<center>
    <FONT FACE="impact" SIZE=2>&copy; {{@date('Y')}} {{'Subdireccion de atencion operativa - Oaxaca, Todos los derechos reservados'}}</FONT>
</center>
@endsection