<div class="main shadow p-3 mb-5 bg-white rounded mt-5">

    <div class="row justify-content-md-center mb-4">
        <h1>ENERO-FEBRERO</h1>
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
                            @if(count($pendingEntities->where('bimester', 1)->unique('region')) == 0)
                            {{'No existen registros'}}
                            @else
                            @foreach($pendingEntities->where('bimester', 1)->unique('region') as $regions)
                            {{$regions->school->locality->municipality->region->nameRegion}}
                            @endforeach
                            @endif
                        </td>
                        <td>
                            @if(count($deliveryYesEntities->where('bimester', 1)->unique('region')) == 0)
                            {{'No existen registros'}}
                            @else
                            @foreach($deliveryYesEntities->where('bimester', 1)->unique('region') as $regions)
                            {{$regions->school->locality->municipality->region->nameRegion}}
                            @endforeach
                            @endif
                        </td>
                        <td>
                            @if(count($deliveryNotEntities->where('bimester', 1)->unique('region')) == 0)
                            {{'No existen registros'}}
                            @else
                            @foreach($deliveryNotEntities->where('bimester', 1)->unique('region') as $regions)
                            {{$regions->school->locality->municipality->region->nameRegion}}
                            @endforeach
                            @endif
                        </td>
                        <td>
                            @if(count($deliveryDropEntities->where('bimester', 1)->unique('region')) == 0)
                            {{'No existen registros'}}
                            @else
                            @foreach($deliveryDrop->where('bimester', 1)->unique('region') as $regions)
                            {{$regions->school->locality->municipality->region->nameRegion}}
                            @endforeach
                            @endif
                        </td>
                        <td>
                            @if(count($deliveryReshipmentEntities->where('bimester', 1)->unique('region')) == 0)
                            {{'No existen registros'}}
                            @else
                            @foreach($deliveryReshipment->where('bimester', 1)->unique('region') as $regions)
                            {{$regions->school->locality->municipality->region->nameRegion}}
                            @endforeach
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Municipios</td>
                        <td>
                            @if(count($pendingEntities->where('bimester', 1)->unique('municipality')) == 0)
                            {{'No existen registros'}}
                            @else
                            @foreach($pendingEntities->where('bimester', 1)->unique('municipality') as $municipalities)
                            {{$municipalities->school->locality->municipality->nameMunicipality}}
                            @endforeach
                            @endif
                        </td>
                        <td>
                            @if(count($deliveryYesEntities->where('bimester', 1)->unique('municipality')) == 0)
                            {{'No existen registros'}}
                            @else
                            @foreach($deliveryYesEntities->where('bimester', 1)->unique('municipality') as $municipalities)
                            {{$municipalities->school->locality->municipality->nameMunicipality}}
                            @endforeach
                            @endif
                        </td>
                        <td>
                            @if(count($deliveryNotEntities->where('bimester', 1)->unique('municipality')) == 0)
                            {{'No existen registros'}}
                            @else
                            @foreach($deliveryNotEntities->where('bimester', 1)->unique('municipality') as $municipalities)
                            {{$municipalities->school->locality->municipality->nameMunicipality}}
                            @endforeach
                            @endif
                        </td>
                        <td>
                            @if(count($deliveryDropEntities->where('bimester', 1)->unique('municipality')) == 0)
                            {{'No existen registros'}}
                            @else
                            @foreach($deliveryDropEntities->where('bimester', 1)->unique('municipality') as $municipalities)
                            {{$municipalities->school->locality->municipality->nameMunicipality}}
                            @endforeach
                            @endif
                        </td>
                        <td>
                            @if(count($deliveryReshipmentEntities->where('bimester', 1)->unique('municipality')) == 0)
                            {{'No existen registros'}}
                            @else
                            @foreach($deliveryReshipmentEntities->where('bimester', 1)->unique('municipality') as $municipalities)
                            {{$municipalities->school->locality->municipality->nameMunicipality}}
                            @endforeach
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Localidades</td>
                        <td>
                            @if(count($pendingEntities->where('bimester', 1)->unique('locality')) == 0)
                            {{'No existen registros'}}
                            @else
                            @foreach($pendingEntities->where('bimester', 1)->unique('locality') as $localities)
                            {{$localities->school->locality->nameLocality}}
                            @endforeach
                            @endif
                        </td>
                        <td>
                            @if(count($deliveryYesEntities->where('bimester', 1)->unique('locality')) == 0)
                            {{'No existen registros'}}
                            @else
                            @foreach($deliveryYesEntities->where('bimester', 1)->unique('locality') as $localities)
                            {{$localities->school->locality->nameLocality}}
                            @endforeach
                            @endif
                        </td>
                        <td>
                            @if(count($deliveryNotEntities->where('bimester', 1)->unique('locality')) == 0)
                            {{'No existen registros'}}
                            @else
                            @foreach($deliveryNotEntities->where('bimester', 1)->unique('locality') as $localities)
                            {{$localities->school->locality->nameLocality}}
                            @endforeach
                            @endif
                        </td>
                        <td>
                            @if(count($deliveryDropEntities->where('bimester', 1)->unique('locality')) == 0)
                            {{'No existen registros'}}
                            @else
                            @foreach($deliveryDropEntities->where('bimester', 1)->unique('locality') as $localities)
                            {{$localities->school->locality->nameLocality}}
                            @endforeach
                            @endif
                        </td>
                        <td>
                            @if(count($deliveryReshipmentEntities->where('bimester', 1)->unique('locality')) == 0)
                            {{'No existen registros'}}
                            @else
                            @foreach($deliveryReshipmentEntities->where('bimester', 1)->unique('locality') as $localities)
                            {{$localities->school->locality->nameLocality}}
                            @endforeach
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>