@extends('plantillas.adminApp')

@section('main')
<div class="row justify-content-md-center mb-4">
    <h4>AVISOS DE COBRO EDUCACION BASICA</h4>
</div>
@include('user.mediums.mediumDelivery.bimesterOneDelivery')
@include('user.mediums.mediumDelivery.bimesterTwoDelivery')
@include('user.mediums.mediumDelivery.bimesterThreeDelivery')
@include('user.mediums.mediumDelivery.bimesterFourDelivery')
@include('user.mediums.mediumDelivery.bimesterFiveDelivery')
@endsection