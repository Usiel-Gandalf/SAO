<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Municipality;
use App\Region;
use App\User;

class MunicipalityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('onlyAdmin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $municipalities = Municipality::with('region')->paginate(10);
        //$municipalities = Municipality::orderBy('nameMunicipality', 'ASC')->with('region')->paginate(10);
        return view('user.municipalities.index', compact('municipalities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = Region::all();
        return view('user.municipalities.create', compact('regions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->except('_token');

        $request->validate([
            'id' => 'required|integer',
            'nameMunicipality' => 'required|string|max:100',
            'idRegion' => 'required|integer',
        ]);

        $municipality = new Municipality();
        $municipality->id = $request->id;
        $municipality->nameMunicipality = $request->nameMunicipality;
        $municipality->region_id = $request->idRegion;
        $municipality->save();

        return redirect()->action('MunicipalityController@index')->with('saveMunicipality', 'Nuevo municipio agregado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $idMunicipality = $request->get('id');
        $nameMunicipality = $request->get('nameMunicipality');
        $idRegion = $request->get('idRegion');
        // return $request;

        $municipalities = Municipality::orderBy('id', 'ASC')
            ->id($idMunicipality)
            ->nameMunicipality($nameMunicipality)
            ->idRegion($idRegion)
            ->paginate(5);

        if (count($municipalities) == 0) {
            return back()->with('notFound', 'No se encontraron resultados');
        } else {
            return view('user.municipalities.index', compact('municipalities'));
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
        $municipality = Municipality::findOrfail($id)->with('region')->first();
        //return json_encode($municipality);
        $regions = Region::all();

        return view('user.municipalities.edit', compact('municipality', 'regions'));
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
            'id' => 'required|integer',
            'nameMunicipality' => 'required|string',
            'region_id' => 'required|integer',
        ]);

        Municipality::where('id', $id)->update($data);
        return redirect()->action('MunicipalityController@index')->with('updateMunicipality', 'Municipio actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Municipality::destroy($id);
        return redirect()->action('MunicipalityController@index')->with('deleteMunicipality', 'Municipio eliminado');
    }

    public function reportMunicipality($id, $type)
    {
        $municipalityInfo = Municipality::where('id', $id)->with('region')->get();
        foreach ($municipalityInfo as $municipality) {
            $idReg =  $municipality->region->id;
            $bossRegion = User::where('region_id', $idReg)->get();
        }
        ///////////////////////////////////////////////////
        $basicsCermBim1 = Municipality::join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('basics',  function ($join) {
                $join->on('localities.id', '=', 'basics.locality_id')->where('basics.type', 1)->where('basics.bimester', 1);
            })->where('municipality_id', $id)->get();

        $basicsCermBim2 = Municipality::join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('basics',  function ($join) {
                $join->on('localities.id', '=', 'basics.locality_id')->where('basics.type', 1)->where('basics.bimester', 2);
            })->where('municipality_id', $id)->get();

        $basicsCermBim3 = Municipality::join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('basics',  function ($join) {
                $join->on('localities.id', '=', 'basics.locality_id')->where('basics.type', 1)->where('basics.bimester', 3);
            })->where('municipality_id', $id)->get();

        $basicsCermBim4 = Municipality::join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('basics',  function ($join) {
                $join->on('localities.id', '=', 'basics.locality_id')->where('basics.type', 1)->where('basics.bimester', 4);
            })->where('municipality_id', $id)->get();

        $basicsCermBim5 = Municipality::join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('basics',  function ($join) {
                $join->on('localities.id', '=', 'basics.locality_id')->where('basics.type', 1)->where('basics.bimester', 5);
            })->where('municipality_id', $id)->get();
        //////////////////////////////////////////////////////

        /////////////////////////////////////////////////////////
        $basicsDeliveryBim1 = Municipality::join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('basics', function ($join) {
                $join->on('localities.id', '=', 'basics.locality_id')->where('basics.type', 2)->where('basics.bimester', 1);
            })->where('municipality_id', $id)->get();

        $basicsDeliveryBim2 = Municipality::join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('basics', function ($join) {
                $join->on('localities.id', '=', 'basics.locality_id')->where('basics.type', 2)->where('basics.bimester', 2);
            })->where('municipality_id', $id)->get();

        $basicsDeliveryBim3 = Municipality::join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('basics', function ($join) {
                $join->on('localities.id', '=', 'basics.locality_id')->where('basics.type', 2)->where('basics.bimester', 3);
            })->where('municipality_id', $id)->get();

        $basicsDeliveryBim4 = Municipality::join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('basics', function ($join) {
                $join->on('localities.id', '=', 'basics.locality_id')->where('basics.type', 2)->where('basics.bimester', 4);
            })->where('municipality_id', $id)->get();

        $basicsDeliveryBim5 = Municipality::join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('basics', function ($join) {
                $join->on('localities.id', '=', 'basics.locality_id')->where('basics.type', 2)->where('basics.bimester', 5);
            })->where('municipality_id', $id)->get();
        /////////////////////////////////////////////////////////

        /////////////////////////////////////////////////////////
        $mediumsBim1 = Municipality::join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', function ($join) {
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 1);
            })->where('municipality_id', $id)->get();

        $mediumsBim2 = Municipality::join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', function ($join) {
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 2);
            })->where('municipality_id', $id)->get();

        $mediumsBim3 = Municipality::join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', function ($join) {
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 3);
            })->where('municipality_id', $id)->get();

        $mediumsBim4 = Municipality::join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', function ($join) {
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 4);
            })->where('municipality_id', $id)->get();

        $mediumsBim5 = Municipality::join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', function ($join) {
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 5);
            })->where('municipality_id', $id)->get();
        ///////////////////////////////////////////////////////////

        ///////////////////////////////////////////////////////////
        $higersBim1 = Municipality::join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('higers', function ($join) {
                $join->on('schools.id', '=', 'higers.school_id')->where('higers.bimester', 1);
            })->where('municipality_id', $id)->get();

            $higersBim2 = Municipality::join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('higers', function ($join) {
                $join->on('schools.id', '=', 'higers.school_id')->where('higers.bimester', 2);
            })->where('municipality_id', $id)->get();

            $higersBim3 = Municipality::join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('higers', function ($join) {
                $join->on('schools.id', '=', 'higers.school_id')->where('higers.bimester', 3);
            })->where('municipality_id', $id)->get();

            $higersBim4 = Municipality::join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('higers', function ($join) {
                $join->on('schools.id', '=', 'higers.school_id')->where('higers.bimester', 4);
            })->where('municipality_id', $id)->get();

            $higersBim5 = Municipality::join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('higers', function ($join) {
                $join->on('schools.id', '=', 'higers.school_id')->where('higers.bimester', 5);
            })->where('municipality_id', $id)->get();


        ////////////////////////////////////////////////////////////

        if ($type == 0) {
            return view('user.municipalities.municipalityGeneral', compact('municipalityInfo', 'bossRegion', 
            'basicsCermBim1', 'basicsCermBim2', 'basicsCermBim3', 'basicsCermBim4', 'basicsCermBim5',
            'basicsDeliveryBim1', 'basicsDeliveryBim2', 'basicsDeliveryBim3', 'basicsDeliveryBim4', 'basicsDeliveryBim5',
            'mediumsBim1', 'mediumsBim2', 'mediumsBim3', 'mediumsBim4', 'mediumsBim5',
            'higersBim1', 'higersBim2', 'higersBim3', 'higersBim4', 'higersBim5'
        ));
        } elseif ($type == 1) {
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadView('user.municipalities.municipalityPdf', compact('municipalityInfo', 'bossRegion', 
            'basicsCermBim1', 'basicsCermBim2', 'basicsCermBim3', 'basicsCermBim4', 'basicsCermBim5',
            'basicsDeliveryBim1', 'basicsDeliveryBim2', 'basicsDeliveryBim3', 'basicsDeliveryBim4', 'basicsDeliveryBim5',
            'mediumsBim1', 'mediumsBim2', 'mediumsBim3', 'mediumsBim4', 'mediumsBim5',
            'higersBim1', 'higersBim2', 'higersBim3', 'higersBim4', 'higersBim5'
        ));
            return $pdf->stream();
        } else {
            return back();
        }
    }
}
