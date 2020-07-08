@extends('plantillas.adminApp')

@section('main')
<div class="main">
    <div class="main">
        <img src="https://www.gob.mx/cms/uploads/image/file/556586/banner-beni.jpg" class="img-fluid" alt="" style="width:100%;height:300px;">
    </div>
</div>
@if(Auth::user()->type = 1)
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
                        <footer class="blockquote-footer">Subdireccion de atencion operativa <cite title="Source Title">Oaxaca</cite></footer>
                        <footer class="blockquote-footer">Hora de inicio de sesion <cite title="Source Title">{{now()}}</cite></footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
</div>
@elseif(Auth::user()->type = 0)
<b>Bienvenido jefe:</b> {{Auth::user()->name}}
@endif

@endsection