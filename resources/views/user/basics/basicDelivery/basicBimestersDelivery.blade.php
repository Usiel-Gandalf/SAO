@extends('plantillas.adminApp')

@section('main')
<div class="row justify-content-md-center mb-4">
    <h4>AVISOS DE COBRO EDUCACION BASICA</h4>
</div>
@include('user.basics.basicDelivery.bimesterOneDelivery')
@include('user.basics.basicDelivery.bimesterTwoDelivery')
@include('user.basics.basicDelivery.bimesterTrheeDelivery')
@include('user.basics.basicDelivery.bimesterFourDelivery')
@include('user.basics.basicDelivery.bimesterFiveDelivery')
@endsection