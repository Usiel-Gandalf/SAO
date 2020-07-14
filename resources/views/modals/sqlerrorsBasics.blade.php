<div class="collapse" id="collapseExample">
    <div class="card card-body">
        <div class="row justify-content-md-center mb-1 mt-2">
            <p>Verifique que la la localidad con la <strong>claveofi</strong> que se muestra en el reporte exista, si no existe, registrela, de lo contrario
                elimine la fila correspondiente e intente nuevamente, recuerde que el bimestre, año, estado y tipo de becas corresponde al formulario omita esa informacion
                <strong>Por seguridad al primer error con alguna accion con la base de datos, el flujo de trabajo se detendra automaticamente</strong></p>
        </div>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">FOL_FORM</th>
                    <th scope="col">FAM_ID</th>
                    <th scope="col"><strong>CLAVEOFI</strong></th>
                    <th scope="col">REMESA</th>
                    <th>Bimestre</th>
                    <th>Año</th>
                    <th>Estado</th>
                    <th>Tipo de beca</th>
                    <th>Fecha de intento</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @if(isset($err) && $err->any())
                    @foreach($err->all() as $error)
                    <td>{{$error}}</td>
                    @endforeach
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
</div>
</div>