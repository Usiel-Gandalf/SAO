@extends('plantillas.adminApp')
@section('main')
<div class="main shadow px-5 mb-5 bg-white rounded">

    <div class="row justify-content-md-center">
        <img src="https://qroo.gob.mx/sites/default/files/inline-images/BECAS_COORDINACION_logo.png" class="img-fluid" alt="Responsive image" width="40%" height="40%">
    </div>

    <div class="row justify-content-md-center">
        <h4><b>SUBDIRECCION DE ATENCION OPERATIVA</b></h4>
    </div>

    <div class="row justify-content-md-center">
        <h6>REPORTE GENERAL | {{@date('Y-m-d')}} | Administrador: {{Auth::user()->name}} {{Auth::user()->firstSurname}} {{Auth::user()->secondSurname}}</h6>
    </div>

    <div class="row justify-content-md-center">
        <h5>TODAS LAS REGIONES</h5>
        <hr style="color: #0056b2;" width="100%" />
    </div>
    

    <div class="row justify-content-md-center mt-3">
        <h5>EDUCACION BASICA - CERM</h5>
    </div>
        







    <div class="row justify-content-md-center mb-4">
        <p>&copy; {{@date('Y')}} {{'Subdireccion de atencion operativa - Oaxaca, Todos los derechos reservados'}}</p>
    </div>
</div>
@endsection