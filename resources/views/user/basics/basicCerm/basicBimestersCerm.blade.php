@extends('plantillas.adminApp')

@section('main')
<div class="row justify-content-md-center mb-4">
    <h4>CERMS EDUCACION BASICA</h4>
</div>
@include('user.basics.basicCerm.bimesterOneCerm')
@include('user.basics.basicCerm.bimesterTwoCerm')
@include('user.basics.basicCerm.bimesterTrheeCerm')
@include('user.basics.basicCerm.bimesterFourCerm')
@include('user.basics.basicCerm.bimesterFiveCerm')
@endsection