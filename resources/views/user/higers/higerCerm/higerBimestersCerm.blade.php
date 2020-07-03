@extends('plantillas.adminApp')

@section('main')
<div class="row justify-content-md-center mb-4">
    <h4>CERM DE JOVENES ESCRIBIENDO EL FUTURO</h4>
</div>
@include('user.higers.higerCerm.bimesterOneCerm')
@include('user.higers.higerCerm.bimesterTwoCerm')
@include('user.higers.higerCerm.bimesterTrheeCerm')
@include('user.higers.higerCerm.bimesterFourCerm')
@include('user.higers.higerCerm.bimesterFiveCerm')
@endsection