@extends('plantillas.adminApp')
@section('main')
<div class="container shadow px-5 mb-5 bg-white rounded mt-4 border border-success">

    <div class="row justify-content-md-center">
        <img src="https://qroo.gob.mx/sites/default/files/inline-images/BECAS_COORDINACION_logo.png" class="img-fluid" alt="Responsive image" width="40%" height="40%">
    </div>

    <div class="row justify-content-md-center mb-1">
        <h4><b>SUBDIRECCION DE ATENCION OPERATIVA</b></h4>
    </div>

    <div class="row justify-content-md-center mb-3">
        <h5><b>REPORTE GENERAL DE REGION</b> | {{@date('Y-m-d')}} | Administrador: {{Auth::user()->name}} {{Auth::user()->firstSurname}} {{Auth::user()->secondSurname}}</h5>
    </div>
    <hr style="color: #0056b2;" width="100%" />
    <hr style="color: #0056b2;" width="100%" />

    <div class="row justify-content-md-center mb-0">
        <div class="col-13">
            <table class="table table-bordered text-center">
                <thead class="thead-light">
                    <tr>
                        @foreach($regionInfo as $region)
                        <td scope="col"><h5><b>REGION</b></h5> {{$region->nameRegion}}</td>
                        <td scope="col"><h5><b>CLAVE</b></h5> {{$region->id}}</td>
                        <td scope="col"><h5><b>NUMERO</b></h5> {{$region->region}}</td>
                        @endforeach
                        <td>
                            @if(count($bossRegion) == 0)
                           <h5>{{'Sin Jefe'}}</h5>
                            @elseif(count($bossRegion) >= 2)
                            @foreach($bossRegion as $boss)
                           <h5><b>{{'Responsables de la region'}}</b></h5> {{$boss->name}} {{$boss->firstSurname}} {{$boss->secondSurname}},
                            @endforeach
                            @else
                            @foreach($bossRegion as $boss)
                          <h5><b>{{'Responsable de la region'}}</b></h5> {{$boss->name}} {{$boss->firstSurname}} {{$boss->secondSurname}}
                            @endforeach
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{url('reportRegion/'.$region->id.'/reportRegion/1')}}" target="_blank">PDF</a>
                            <a class="btn btn-success" href="{{url('/region')}}">Regresar</a>
                        </td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="row justify-content-md-center mt-3">
        <h5>EDUCACION BASICA - CERM</h5>
    </div>

    <div class="row justify-content-md-center mb-4">
        <div class="col">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">ESTATUS</th>
                        <th scope="col">ENERO-FEBRERO</th>
                        <th scope="col">MARZO-ABRIL</th>
                        <th scope="col">MAYO-JUNIO</th>
                        <th scope="col">SEPTIEMBRE-OCTUBRE</th>
                        <th scope="col">NOVIEMBRE-DICIEMBRE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Pendientes</th>
                        <td>{{count($basicsCerm->where('status', 0)->where('bimester', 1))}}</td>
                        <td>{{count($basicsCerm->where('status', 0)->where('bimester', 2))}}</td>
                        <td>{{count($basicsCerm->where('status', 0)->where('bimester', 3))}}</td>
                        <td>{{count($basicsCerm->where('status', 0)->where('bimester', 4))}}</td>
                        <td>{{count($basicsCerm->where('status', 0)->where('bimester', 5))}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Entregados</th>
                        <td>{{count($basicsCerm->where('status', 1)->where('bimester', 1))}}</td>
                        <td>{{count($basicsCerm->where('status', 1)->where('bimester', 2))}}</td>
                        <td>{{count($basicsCerm->where('status', 1)->where('bimester', 3))}}</td>
                        <td>{{count($basicsCerm->where('status', 1)->where('bimester', 4))}}</td>
                        <td>{{count($basicsCerm->where('status', 1)->where('bimester', 5))}}</td>
                    </tr>
                    <tr>
                        <th scope="row">No entregados - No localizados</th>
                        <td>{{count($basicsCerm->where('status', 2)->where('bimester', 1))}}</td>
                        <td>{{count($basicsCerm->where('status', 2)->where('bimester', 2))}}</td>
                        <td>{{count($basicsCerm->where('status', 2)->where('bimester', 3))}}</td>
                        <td>{{count($basicsCerm->where('status', 2)->where('bimester', 4))}}</td>
                        <td>{{count($basicsCerm->where('status', 2)->where('bimester', 5))}}</td>
                    </tr>
                    <tr>
                        <th scope="row">No entregados - Por baja</th>
                        <td>{{count($basicsCerm->where('status', 3)->where('bimester', 1))}}</td>
                        <td>{{count($basicsCerm->where('status', 3)->where('bimester', 2))}}</td>
                        <td>{{count($basicsCerm->where('status', 3)->where('bimester', 3))}}</td>
                        <td>{{count($basicsCerm->where('status', 3)->where('bimester', 4))}}</td>
                        <td>{{count($basicsCerm->where('status', 3)->where('bimester', 5))}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <div class="row justify-content-md-center mt-4">
        <h5>EDUCACION BASICA - AVISOS DE COBRO</h5>
    </div>

    <div class="row justify-content-md-center mb-4">
        <div class="col">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">ESTATUS</th>
                        <th scope="col">ENERO-FEBRERO</th>
                        <th scope="col">MARZO-ABRIL</th>
                        <th scope="col">MAYO-JUNIO</th>
                        <th scope="col">SEPTIEMBRE-OCTUBRE</th>
                        <th scope="col">NOVIEMBRE-DICIEMBRE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Pendientes</th>
                        <td>{{count($basicsDelivery->where('status', 0)->where('bimester', 1))}}</td>
                        <td>{{count($basicsDelivery->where('status', 0)->where('bimester', 2))}}</td>
                        <td>{{count($basicsDelivery->where('status', 0)->where('bimester', 3))}}</td>
                        <td>{{count($basicsDelivery->where('status', 0)->where('bimester', 4))}}</td>
                        <td>{{count($basicsDelivery->where('status', 0)->where('bimester', 5))}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Entregados</th>
                        <td>{{count($basicsDelivery->where('status', 1)->where('bimester', 1))}}</td>
                        <td>{{count($basicsDelivery->where('status', 1)->where('bimester', 2))}}</td>
                        <td>{{count($basicsDelivery->where('status', 1)->where('bimester', 3))}}</td>
                        <td>{{count($basicsDelivery->where('status', 1)->where('bimester', 4))}}</td>
                        <td>{{count($basicsDelivery->where('status', 1)->where('bimester', 5))}}</td>
                    </tr>
                    <tr>
                        <th scope="row">No entregados - No localizados</th>
                        <td>{{count($basicsDelivery->where('status', 2)->where('bimester', 1))}}</td>
                        <td>{{count($basicsDelivery->where('status', 2)->where('bimester', 2))}}</td>
                        <td>{{count($basicsDelivery->where('status', 2)->where('bimester', 3))}}</td>
                        <td>{{count($basicsDelivery->where('status', 2)->where('bimester', 4))}}</td>
                        <td>{{count($basicsDelivery->where('status', 2)->where('bimester', 5))}}</td>
                    </tr>
                    <tr>
                        <th scope="row">No entregados - Por baja</th>
                        <td>{{count($basicsDelivery->where('status', 3)->where('bimester', 1))}}</td>
                        <td>{{count($basicsDelivery->where('status', 3)->where('bimester', 2))}}</td>
                        <td>{{count($basicsDelivery->where('status', 3)->where('bimester', 3))}}</td>
                        <td>{{count($basicsDelivery->where('status', 3)->where('bimester', 4))}}</td>
                        <td>{{count($basicsDelivery->where('status', 3)->where('bimester', 5))}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <hr style="color: #0056b2;" width="100%" />

    <div class="row justify-content-md-center mt-5">
        <h5>EDUCACION MEDIA SUPERIOR</h5>
    </div>

    <div class="row justify-content-md-center mb-4">
        <div class="col">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">ESTATUS</th>
                        <th scope="col">ENERO-FEBRERO</th>
                        <th scope="col">MARZO-ABRIL</th>
                        <th scope="col">MAYO-JUNIO</th>
                        <th scope="col">SEPTIEMBRE-OCTUBRE</th>
                        <th scope="col">NOVIEMBRE-DICIEMBRE</th>
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
        </div>
    </div>

    <hr style="color: #0056b2;" width="100%" />

    <div class="row justify-content-md-center mt-5">
        <h5>JOVENES ESCRIBIENDO EL FUTURO</h5>
    </div>

    <div class="row justify-content-md-center mb-4">
        <div class="col">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">ESTATUS</th>
                        <th scope="col">ENERO-FEBRERO</th>
                        <th scope="col">MARZO-ABRIL</th>
                        <th scope="col">MAYO-JUNIO</th>
                        <th scope="col">SEPTIEMBRE-OCTUBRE</th>
                        <th scope="col">NOVIEMBRE-DICIEMBRE</th>
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
        </div>
    </div>

    <div class="row justify-content-md-center mb-4">
        <p>&copy; {{@date('Y')}} {{'Subdireccion de atencion operativa - Oaxaca, Todos los derechos reservados'}}</p>
    </div>

</div>
@endsection