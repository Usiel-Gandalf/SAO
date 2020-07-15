<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\PDF;
use App\Region;
use App\Basic;
use App\Medium;
use App\Higer;
use App\User;
use Illuminate\Support\Facades\App;

class RegionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('onlyAdmin')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $regions = Region::paginate(10);
            $regions->sortBy('nameRegion');
            return view('user.regions.index', compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.regions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->except('_token');

        $request->validate([
            'id' => 'required|integer',
            'region' => 'required|integer|max:100',
            'name' => 'required|string',
        ]);

        $region = new Region();
        $region->id = $request->id;
        $region->region = $request->region;
        $region->nameRegion = $request->name;
        $region->save();

        return redirect()->action('RegionController@index')->with('saveRegion', 'Nueva region agregada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $idRegion = $request->get('id');
        $numberRegion = $request->get('numberRegion');
        $nameRegion = $request->get('nameRegion');

        $regions = Region::orderBy('id', 'ASC')
            ->idRegion($idRegion)
            ->numberRegion($numberRegion)
            ->nameRegion($nameRegion)
            ->paginate(5);

        if (count($regions) == 0) {
            return back()->with('notFound', 'No se encontraron resultados');
        } else {
            return view('user.regions.index', compact('regions'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $region = Region::findOrfail($id);
        return view('user.regions.edit', compact('region'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = request()->except(['_token', '_method']);
        $request->validate([
            'id' => 'required|numeric',
            'region' => 'required|integer',
            'name' => 'required|string',
        ]);


        Region::where('id', $id)->update($data);
        return redirect()->action('RegionController@index')->with('updateRegion', 'Region actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Region::destroy($id);
        return redirect()->action('RegionController@index')->with('deleteRegion', 'Region eliminada');
    }

    // funciones para los reportes de regiones

    public function reportRegion($id, $type)
    {
        $bossRegion = User::where('region_id', $id)->get();
        $regionInfo = Region::where('id', $id)->get();

        ////////////////////////
        $basicsCermBim1 = Region::join('municipalities', 'regions.id', '=', 'municipalities.region_id')
            ->join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('basics', function ($join) {
                $join->on('localities.id', '=', 'basics.locality_id')->where('basics.type', 1)->where('basics.bimester', 1);
            })->where('region_id', $id)->get();

        $basicsCermBim2 = Region::join('municipalities', 'regions.id', '=', 'municipalities.region_id')
            ->join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('basics', function ($join) {
                $join->on('localities.id', '=', 'basics.locality_id')->where('basics.type', 1)->where('basics.bimester', 2);
            })->where('region_id', $id)->get();

        $basicsCermBim3 = Region::join('municipalities', 'regions.id', '=', 'municipalities.region_id')
            ->join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('basics', function ($join) {
                $join->on('localities.id', '=', 'basics.locality_id')->where('basics.type', 1)->where('basics.bimester', 3);
            })->where('region_id', $id)->get();

        $basicsCermBim4 = Region::join('municipalities', 'regions.id', '=', 'municipalities.region_id')
            ->join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('basics', function ($join) {
                $join->on('localities.id', '=', 'basics.locality_id')->where('basics.type', 1)->where('basics.bimester', 4);
            })->where('region_id', $id)->get();

        $basicsCermBim5 = Region::join('municipalities', 'regions.id', '=', 'municipalities.region_id')
            ->join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('basics', function ($join) {
                $join->on('localities.id', '=', 'basics.locality_id')->where('basics.type', 1)->where('basics.bimester', 5);
            })->where('region_id', $id)->get();
        ////////////////////////////////////////////////

        ////////////////////////////////////////////////
        $basicsDeliveryBim1 = Region::join('municipalities', 'regions.id', '=', 'municipalities.region_id')
            ->join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('basics', function ($join) {
                $join->on('localities.id', '=', 'basics.locality_id')->where('basics.type', 2)->where('basics.bimester', 1);
            })->where('region_id', $id)->get();

        $basicsDeliveryBim2 = Region::join('municipalities', 'regions.id', '=', 'municipalities.region_id')
            ->join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('basics', function ($join) {
                $join->on('localities.id', '=', 'basics.locality_id')->where('basics.type', 2)->where('basics.bimester', 2);
            })->where('region_id', $id)->get();

        $basicsDeliveryBim3 = Region::join('municipalities', 'regions.id', '=', 'municipalities.region_id')
            ->join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('basics', function ($join) {
                $join->on('localities.id', '=', 'basics.locality_id')->where('basics.type', 2)->where('basics.bimester', 3);
            })->where('region_id', $id)->get();

        $basicsDeliveryBim4 = Region::join('municipalities', 'regions.id', '=', 'municipalities.region_id')
            ->join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('basics', function ($join) {
                $join->on('localities.id', '=', 'basics.locality_id')->where('basics.type', 2)->where('basics.bimester', 4);
            })->where('region_id', $id)->get();

        $basicsDeliveryBim5 = Region::join('municipalities', 'regions.id', '=', 'municipalities.region_id')
            ->join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('basics', function ($join) {
                $join->on('localities.id', '=', 'basics.locality_id')->where('basics.type', 2)->where('basics.bimester', 5);
            })->where('region_id', $id)->get();
        ///////////////////////////////////////////////

        //////////////////////////////////////////////
        $mediumsBim1 = Region::join('municipalities', 'regions.id', '=', 'municipalities.region_id')
            ->join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', function ($join) {
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 1)->where('media.reissue', null);
            })->where('region_id', $id)->get();

        $mediumsBim2 = Region::join('municipalities', 'regions.id', '=', 'municipalities.region_id')
            ->join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', function ($join) {
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 2)->where('media.reissue', null);
            })->where('region_id', $id)->get();

        $mediumsBim3 = Region::join('municipalities', 'regions.id', '=', 'municipalities.region_id')
            ->join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', function ($join) {
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 3)->where('media.reissue', null);
            })->where('region_id', $id)->get();

        $mediumsBim4 = Region::join('municipalities', 'regions.id', '=', 'municipalities.region_id')
            ->join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', function ($join) {
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 4)->where('media.reissue', null);
            })->where('region_id', $id)->get();

        $mediumsBim5 = Region::join('municipalities', 'regions.id', '=', 'municipalities.region_id')
            ->join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', function ($join) {
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 5)->where('media.reissue', null);
            })->where('region_id', $id)->get();
        /////////////////////////////////////////////

        //////////////////////////////////////////////
        $reissueBim1 = Region::join('municipalities', 'regions.id', '=', 'municipalities.region_id')
            ->join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', function ($join) {
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 1)->where('media.reissue', 1);
            })->where('region_id', $id)->get();

        $reissueBim2 = Region::join('municipalities', 'regions.id', '=', 'municipalities.region_id')
            ->join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', function ($join) {
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 2)->where('media.reissue', 1);
            })->where('region_id', $id)->get();

        $reissueBim3 = Region::join('municipalities', 'regions.id', '=', 'municipalities.region_id')
            ->join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', function ($join) {
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 3)->where('media.reissue', 1);
            })->where('region_id', $id)->get();

        $reissueBim4 = Region::join('municipalities', 'regions.id', '=', 'municipalities.region_id')
            ->join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', function ($join) {
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 4)->where('media.reissue', 1);
            })->where('region_id', $id)->get();

        $reissueBim5 = Region::join('municipalities', 'regions.id', '=', 'municipalities.region_id')
            ->join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', function ($join) {
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 5)->where('reissue', 1);
            })->where('region_id', $id)->get();
        /////////////////////////////////////////////

        ////////////////////////////////////////////
        $higersBim1 = Region::join('municipalities', 'regions.id', '=', 'municipalities.region_id')
            ->join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('higers', function ($join) {
                $join->on('schools.id', '=', 'higers.school_id')->where('higers.bimester', 1);
            })->where('region_id', $id)->get();

        $higersBim2 = Region::join('municipalities', 'regions.id', '=', 'municipalities.region_id')
            ->join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('higers', function ($join) {
                $join->on('schools.id', '=', 'higers.school_id')->where('higers.bimester', 2);
            })->where('region_id', $id)->get();

        $higersBim3 = Region::join('municipalities', 'regions.id', '=', 'municipalities.region_id')
            ->join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('higers', function ($join) {
                $join->on('schools.id', '=', 'higers.school_id')->where('higers.bimester', 3);
            })->where('region_id', $id)->get();

        $higersBim4 = Region::join('municipalities', 'regions.id', '=', 'municipalities.region_id')
            ->join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('higers', function ($join) {
                $join->on('schools.id', '=', 'higers.school_id')->where('higers.bimester', 4);
            })->where('region_id', $id)->get();

        $higersBim5 = Region::join('municipalities', 'regions.id', '=', 'municipalities.region_id')
            ->join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('higers', function ($join) {
                $join->on('schools.id', '=', 'higers.school_id')->where('higers.bimester', 5);
            })->where('region_id', $id)->get();
        ///////////////////////////////////////////


        if ($type == 0) {
            return view('user.regions.regionGeneral', compact(
                'regionInfo',
                'bossRegion',
                'basicsCermBim1',
                'basicsCermBim2',
                'basicsCermBim3',
                'basicsCermBim4',
                'basicsCermBim5',
                'basicsDeliveryBim1',
                'basicsDeliveryBim2',
                'basicsDeliveryBim3',
                'basicsDeliveryBim4',
                'basicsDeliveryBim5',
                'mediumsBim1',
                'mediumsBim2',
                'mediumsBim3',
                'mediumsBim4',
                'mediumsBim5',
                'reissueBim1',
                'reissueBim2',
                'reissueBim3',
                'reissueBim4',
                'reissueBim5',
                'higersBim1',
                'higersBim2',
                'higersBim3',
                'higersBim4',
                'higersBim5'
            ));
        } elseif ($type == 1) {
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadView('user.regions.regionPdf', compact(
                'regionInfo',
                'bossRegion',
                'basicsCermBim1',
                'basicsCermBim2',
                'basicsCermBim3',
                'basicsCermBim4',
                'basicsCermBim5',
                'basicsDeliveryBim1',
                'basicsDeliveryBim2',
                'basicsDeliveryBim3',
                'basicsDeliveryBim4',
                'basicsDeliveryBim5',
                'mediumsBim1',
                'mediumsBim2',
                'mediumsBim3',
                'mediumsBim4',
                'mediumsBim5',
                'reissueBim1',
                'reissueBim2',
                'reissueBim3',
                'reissueBim4',
                'reissueBim5',
                'higersBim1',
                'higersBim2',
                'higersBim3',
                'higersBim4',
                'higersBim5'
            ));
            return $pdf->stream();
        } else {
            return back();
        }
    }
}