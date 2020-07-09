@extends('plantillas.pdf')
@section('pdf')
<center><img class="mt-0" src="https://qroo.gob.mx/sites/default/files/inline-images/BECAS_COORDINACION_logo.png" class="img-fluid" alt="Responsive image" width="60%" height="70%"></center>

<center>
    <h5 class="mt-1"><b>SUBDIRECCION DE ATENCION OPERATIVA</b></h5>
</center>

<center>
    <h6><b>REPORTE GENERAL DE JOVENES ESCRIBIENDO EL FUTURO | {{@date('d-m-Y')}} | Administrador: {{Auth::user()->name}} {{Auth::user()->firstSurname}} {{Auth::user()->secondSurname}}</b></h6>
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
    <FONT FACE="impact" SIZE=2>&copy; {{@date('Y')}} {{'Subdireccion de atencion operativa - Oaxaca, Todos los derechos reservados'}}</FONT>
</center>
@endsection