<div class="main shadow p-3 mb-5 bg-white rounded mt-5">

    <div class="row justify-content-md-center mb-4">
        <h1>INFORMACION GENERAL DE JOVENES ESCRIBIENDO EL FUTURO</h1>
    </div>

    <div class="container mt-2">
        <div class="row">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Pendientes</th>
                        <th scope="col">Entregadas</th>
                        <th scope="col">No entregadas/No localizado</th>
                        <th scope="col">No entregadas/Por baja</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Cantidad</td>
                        <td>{{$pending->count()}}</td>
                        <td>{{$cermYes->count()}}</td>
                        <td>{{$cermNot->count()}}</td>
                        <td>{{$cermDrop->count()}}</td>
                    </tr>
                    <tr>
                        <td>Regiones</td>
                        <td>
                            @if(count($pendingEntities->unique('region')) == 0)
                            {{'No existen registros'}}
                            @else
                            @foreach($pendingEntities->unique('region') as $regions)
                            {{$regions->school->locality->municipality->region->nameRegion}}
                            @endforeach
                            @endif
                        </td>
                        <td>
                            @if(count($cermYesEntities->unique('region')) == 0)
                            {{'No existen registros'}}
                            @else
                            @foreach($cermYesEntities->unique('region') as $regions)
                            {{$regions->school->locality->municipality->region->nameRegion}}
                            @endforeach
                            @endif
                        </td>
                        <td>
                            @if(count($cermNotEntities->unique('region')) == 0)
                            {{'No existen registros'}}
                            @else
                            @foreach($cermNotEntities->unique('region') as $regions)
                            {{$regions->school->locality->municipality->region->nameRegion}}
                            @endforeach
                            @endif
                        </td>
                        <td>
                            @if(count($cermDropEntities->unique('region')) == 0)
                            {{'No existen registros'}}
                            @else
                            @foreach($cermDrop->unique('region') as $regions)
                            {{$regions->school->locality->municipality->region->nameRegion}}
                            @endforeach
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Municipios</td>
                        <td>
                            @if(count($pendingEntities->unique('municipality')) == 0)
                            {{'No existen registros'}}
                            @else
                            @foreach($pendingEntities->unique('municipality') as $municipalities)
                            {{$municipalities->school->locality->municipality->nameMunicipality}}
                            @endforeach
                            @endif
                        </td>
                        <td>
                            @if(count($cermYesEntities->unique('municipality')) == 0)
                            {{'No existen registros'}}
                            @else
                            @foreach($cermYesEntities->unique('municipality') as $municipalities)
                            {{$municipalities->school->locality->municipality->nameMunicipality}}
                            @endforeach
                            @endif
                        </td>
                        <td>
                            @if(count($cermNotEntities->unique('municipality')) == 0)
                            {{'No existen registros'}}
                            @else
                            @foreach($cermNotEntities->unique('municipality') as $municipalities)
                            {{$municipalities->school->locality->municipality->nameMunicipality}}
                            @endforeach
                            @endif
                        </td>
                        <td>
                            @if(count($cermDropEntities->unique('municipality')) == 0)
                            {{'No existen registros'}}
                            @else
                            @foreach($cermDropEntities->unique('municipality') as $municipalities)
                            {{$municipalities->school->locality->municipality->nameMunicipality}}
                            @endforeach
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Localidades</td>
                        <td>
                            @if(count($pendingEntities->unique('locality')) == 0)
                            {{'No existen registros'}}
                            @else
                            @foreach($pendingEntities->unique('locality') as $localities)
                            {{$localities->school->locality->nameLocality}}
                            @endforeach
                            @endif
                        </td>
                        <td>
                            @if(count($cermYesEntities->unique('locality')) == 0)
                            {{'No existen registros'}}
                            @else
                            @foreach($cermYesEntities->unique('locality') as $localities)
                            {{$localities->school->locality->nameLocality}}
                            @endforeach
                            @endif
                        </td>
                        <td>
                            @if(count($cermNotEntities->unique('locality')) == 0)
                            {{'No existen registros'}}
                            @else
                            @foreach($cermNotEntities->unique('locality') as $localities)
                            {{$localities->school->locality->nameLocality}}
                            @endforeach
                            @endif
                        </td>
                        <td>
                            @if(count($cermDropEntities->unique('locality')) == 0)
                            {{'No existen registros'}}
                            @else
                            @foreach($cermDropEntities->unique('locality') as $localities)
                            {{$localities->school->locality->nameLocality}}
                            @endforeach
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
            <div class="col foat-right">
                <a class="btn btn-success float-right" href="{{route('higerBimestersDelivery')}}">Ver bimestres</a>
            </div>
        </div>
</div>