<div class="container my-5 table table-bordered">
    <div class="row justify-content-md-center mb-4">
        <h1>INFORMACION GENERAL DE EDUCACION MEDIA SUPERIOR</h1>
    </div>
    <div class="row">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Pendientes</th>
                    <th scope="col">Entregadas</th>
                    <th scope="col">No entregadas/No localizado</th>
                    <th scope="col">No entregadas/Por baja</th>
                    <th scope="col">Reexpedicion</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Cantidad</td>
                    <td>{{$pending->count()}}</td>
                    <td>{{$deliveryYes->count()}}</td>
                    <td>{{$deliveryNot->count()}}</td>
                    <td>{{$deliveryDrop->count()}}</td>
                    <td>{{$deliveryReshipment->count()}}</td>
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
                        @if(count($deliveryYesEntities->unique('region')) == 0)
                        {{'No existen registros'}}
                        @else
                        @foreach($deliveryYesEntities->unique('region') as $regions)
                        {{$regions->school->locality->municipality->region->nameRegion}}
                        @endforeach
                        @endif
                    </td>
                    <td>
                        @if(count($deliveryNotEntities->unique('region')) == 0)
                        {{'No existen registros'}}
                        @else
                        @foreach($deliveryNotEntities->unique('region') as $regions)
                        {{$regions->school->locality->municipality->region->nameRegion}}
                        @endforeach
                        @endif
                    </td>
                    <td>
                        @if(count($deliveryDropEntities->unique('region')) == 0)
                        {{'No existen registros'}}
                        @else
                        @foreach($deliveryDrop->unique('region') as $regions)
                        {{$regions->school->locality->municipality->region->nameRegion}}
                        @endforeach
                        @endif
                    </td>
                    <td>
                        @if(count($deliveryReshipmentEntities->unique('region')) == 0)
                        {{'No existen registros'}}
                        @else
                        @foreach($deliveryReshipment->unique('region') as $regions)
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
                        @if(count($deliveryYesEntities->unique('municipality')) == 0)
                        {{'No existen registros'}}
                        @else
                        @foreach($deliveryYesEntities->unique('municipality') as $municipalities)
                        {{$municipalities->school->locality->municipality->nameMunicipality}}
                        @endforeach
                        @endif
                    </td>
                    <td>
                        @if(count($deliveryNotEntities->unique('municipality')) == 0)
                        {{'No existen registros'}}
                        @else
                        @foreach($deliveryNotEntities->unique('municipality') as $municipalities)
                        {{$municipalities->school->locality->municipality->nameMunicipality}}
                        @endforeach
                        @endif
                    </td>
                    <td>
                        @if(count($deliveryDropEntities->unique('municipality')) == 0)
                        {{'No existen registros'}}
                        @else
                        @foreach($deliveryDropEntities->unique('municipality') as $municipalities)
                        {{$municipalities->school->locality->municipality->nameMunicipality}}
                        @endforeach
                        @endif
                    </td>
                    <td>
                        @if(count($deliveryReshipmentEntities->unique('municipality')) == 0)
                        {{'No existen registros'}}
                        @else
                        @foreach($deliveryReshipmentEntities->unique('municipality') as $municipalities)
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
                        @if(count($deliveryYesEntities->unique('locality')) == 0)
                        {{'No existen registros'}}
                        @else
                        @foreach($deliveryYesEntities->unique('locality') as $localities)
                        {{$localities->school->locality->nameLocality}}
                        @endforeach
                        @endif
                    </td>
                    <td>
                        @if(count($deliveryNotEntities->unique('locality')) == 0)
                        {{'No existen registros'}}
                        @else
                        @foreach($deliveryNotEntities->unique('locality') as $localities)
                        {{$localities->school->locality->nameLocality}}
                        @endforeach
                        @endif
                    </td>
                    <td>
                        @if(count($deliveryDropEntities->unique('locality')) == 0)
                        {{'No existen registros'}}
                        @else
                        @foreach($deliveryDropEntities->unique('locality') as $localities)
                        {{$localities->school->locality->nameLocality}}
                        @endforeach
                        @endif
                    </td>
                    <td>
                        @if(count($deliveryReshipmentEntities->unique('locality')) == 0)
                        {{'No existen registros'}}
                        @else
                        @foreach($deliveryReshipmentEntities->unique('locality') as $localities)
                        {{$localities->school->locality->nameLocality}}
                        @endforeach
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col foat-right">
            <a class="btn btn-success float-right" href="{{route('mediumBimestersDelivery')}}">Ver bimestres</a>
        </div>
    </div>
</div>