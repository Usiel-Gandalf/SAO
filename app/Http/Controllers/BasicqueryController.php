<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Basic;
use App\Locality;
use App\Municipality;
use App\Region;
use Illuminate\Support\Facades\DB;

class BasicqueryController extends Controller
{  public function basicReport()
    {
        $regions = Region::all();
        $municipalities = Municipality::all();
        $localities = Locality::all();
        $consignments = DB::select('SELECT DISTINCT consignment FROM basics');
        return view('user.universes.basicReport', compact('regions', 'municipalities', 'localities', 'consignments'));
    }

    public function basicSearch(Request $request)
    {
        request()->except(['_token', '_method']);
        $consignment = $request->input('consignment');
        $municipality = $request->input('municipality');
        $region = $request->input('region');

        if ($municipality !== null && $region !== null) {
            return back()->with('alertRestrict', 'Solo puede seleccionar una entidad por cosulta(Municipio ó region)');
        } elseif ($consignment == null) {
            return back()->with('alertConsignment', 'Seleccione al menos una remesa');
        } elseif ($consignment !== null && $municipality !== null) {
            $reportMunicipalityReg = Municipality::find($municipality)->region->nameRegion;
            $reportMunicipalityNoLoc = Municipality::find($municipality)->localities->count();
            $reportMunicipality365 = Municipality::find($municipality)->basics->where('status', 365)->where('consignment', $consignment)->count();
            $reportMunicipality369 = Municipality::find($municipality)->basics->where('status', 369)->where('consignment', $consignment)->count();
            $reportMunicipality0 = Municipality::find($municipality)->basics->where('status', 0)->where('consignment', $consignment)->count();
        } elseif ($consignment !== null && $region !== null) {
            return 'remesa y region';
        } elseif ($consignment == "*") {
            $totalEntregado = Basic::where('status', 365)->count();
            $totalNoEntregado = Basic::where('status', 369)->count();
            $totalNoEspecificado = Basic::where('status', 0)->count();
        } else {
            $totalEntregado = Basic::where('status', 365)->where('consignment', $consignment)->count();
            $totalNoEntregado = Basic::where('status', 369)->where('consignment', $consignment)->count();
            $totalNoEspecificado = Basic::where('status', 0)->where('consignment', $consignment)->count();
        }
    }
}
