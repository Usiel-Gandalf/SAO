<div class="container my-5 table table-bordered">
    <div class="row justify-content-md-center mb-4">
        <h4>BIMESTRE SEPTIEMBRE-OCTUBRE</h4>
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
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Cantidad</td>
                    <td>{{$pending->where('bimester', 4)->count()}}</td>
                    <td>{{$cermYes->where('bimester', 4)->count()}}</td>
                    <td>{{$cermNot->where('bimester', 4)->count()}}</td>
                    <td>{{$cermDrop->where('bimester', 4)->count()}}</td>
                </tr>
                <tr>
                    <td>Regiones</td>
                    <td>
                        @if(count($pendingEntities->where('bimester', 4)->unique('region')) == 0)
                        {{'No existen registros'}}
                        @else
                        @foreach($pendingEntities->where('bimester', 4)->unique('region') as $regions)
                        {{$regions->school->locality->municipality->region->nameRegion}}
                        @endforeach
                        @endif
                    </td>
                    <td>
                        @if(count($cermYesEntities->where('bimester', 4)->unique('region')) == 0)
                        {{'No existen registros'}}
                        @else
                        @foreach($cermYesEntities->where('bimester', 4)->unique('region') as $regions)
                        {{$regions->school->locality->municipality->region->nameRegion}}
                        @endforeach
                        @endif
                    </td>
                    <td>
                        @if(count($cermNotEntities->where('bimester', 4)->unique('region')) == 0)
                        {{'No existen registros'}}
                        @else
                        @foreach($cermNotEntities->where('bimester', 4)->unique('region') as $regions)
                        {{$regions->school->locality->municipality->region->nameRegion}}
                        @endforeach
                        @endif
                    </td>
                    <td>
                        @if(count($cermDropEntities->where('bimester', 4)->unique('region')) == 0)
                        {{'No existen registros'}}
                        @else
                        @foreach($cermDrop->where('bimester', 4)->unique('region') as $regions)
                        {{$regions->school->locality->municipality->region->nameRegion}}
                        @endforeach
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Municipios</td>
                    <td>
                        @if(count($pendingEntities->where('bimester', 4)->unique('municipality')) == 0)
                        {{'No existen registros'}}
                        @else
                        @foreach($pendingEntities->where('bimester', 4)->unique('municipality') as $municipalities)
                        {{$municipalities->school->locality->municipality->nameMunicipality}}
                        @endforeach
                        @endif
                    </td>
                    <td>
                        @if(count($cermYesEntities->where('bimester', 4)->unique('municipality')) == 0)
                        {{'No existen registros'}}
                        @else
                        @foreach($cermYesEntities->where('bimester', 4)->unique('municipality') as $municipalities)
                        {{$municipalities->school->locality->municipality->nameMunicipality}}
                        @endforeach
                        @endif
                    </td>
                    <td>
                        @if(count($cermNotEntities->where('bimester', 4)->unique('municipality')) == 0)
                        {{'No existen registros'}}
                        @else
                        @foreach($cermNotEntities->where('bimester', 4)->unique('municipality') as $municipalities)
                        {{$municipalities->school->locality->municipality->nameMunicipality}}
                        @endforeach
                        @endif
                    </td>
                    <td>
                        @if(count($cermDropEntities->where('bimester', 4)->unique('municipality')) == 0)
                        {{'No existen registros'}}
                        @else
                        @foreach($cermDropEntities->where('bimester', 4)->unique('municipality') as $municipalities)
                        {{$municipalities->school->locality->municipality->nameMunicipality}}
                        @endforeach
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Localidades</td>
                    <td>
                        @if(count($pendingEntities->where('bimester', 4)->unique('locality')) == 0)
                        {{'No existen registros'}}
                        @else
                        @foreach($pendingEntities->where('bimester', 4)->unique('locality') as $localities)
                        {{$localities->school->locality->nameLocality}}
                        @endforeach
                        @endif
                    </td>
                    <td>
                        @if(count($cermYesEntities->where('bimester', 4)->unique('locality')) == 0)
                        {{'No existen registros'}}
                        @else
                        @foreach($cermYesEntities->where('bimester', 4)->unique('locality') as $localities)
                        {{$localities->school->locality->nameLocality}}
                        @endforeach
                        @endif
                    </td>
                    <td>
                        @if(count($cermNotEntities->where('bimester', 4)->unique('locality')) == 0)
                        {{'No existen registros'}}
                        @else
                        @foreach($cermNotEntities->where('bimester', 4)->unique('locality') as $localities)
                        {{$localities->school->locality->nameLocality}}
                        @endforeach
                        @endif
                    </td>
                    <td>
                        @if(count($cermDropEntities->where('bimester', 4)->unique('locality')) == 0)
                        {{'No existen registros'}}
                        @else
                        @foreach($cermDropEntities->where('bimester', 4)->unique('locality') as $localities)
                        {{$localities->school->locality->nameLocality}}
                        @endforeach
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>