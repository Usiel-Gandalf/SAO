@extends('plantillas.adminApp')
@section('main')
<div class="main">
    <div class="main">
        <img src="https://www.gob.mx/cms/uploads/image/file/556586/banner-beni.jpg" class="img-fluid" alt=""
            style="width:100%;height:300px;">
    </div>
</div>

<div class="container justify-content-md-center mb-4 mt-3">
    <div class="row justify-content-md-center">
        <h1><em>Subdireccion de Atencion Operativa</em></h1>
    </div>
    <div class="row justify-content-md-center">
        <blockquote class="blockquote text-center">
            <p class="mb-0">"La educación es fundamental para la felicidad social, es el principio en el que descansan la libertad y el engrandecimiento de los pueblos." </p>
            <footer class="blockquote-footer"><cite title="Source Title">    Benito Juárez</cite></footer>
        </blockquote>
    </div>
</div>
<div class="container justify-content-md-center mb-4 mt-3">
    <div class="row justify-content-md-center">
        <div class="col-7">
            <div class="card">
                <div class="card-header">
                    <h6>
                        <b>Bienvenido administrador:</b> {{Auth::user()->name}}
                    </h6>
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <p>¿Que desea hacer hoy?</p>
                        <footer class="blockquote-footer">Subdireccion de atencion operativa <cite
                                title="Source Title">Oaxaca</cite></footer>
                        <footer class="blockquote-footer">Fecha de hoy: <cite
                                title="Source Title">{{date('d-m-Y')}}</cite></footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection