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

        $rules = [
            'id' => 'required|integer|numeric|unique:municipalities,id',
            'nameMunicipality' => 'required|string|max:50',
            'region_id' => 'required|integer|numeric|exists:regions,id',
        ];

        $message = [
            'id.required' => 'El id del municipio no se admite vacío',
            'id.integer' => 'El id del municipio solo puede ser un numero entero',
            'id.numeric' => 'El id del municipio solo puede ser de tipo numerico',
            'id.unique' => 'El id del municipio ya existe, ¿Seguro que es el id correcto?',
            'nameMunicipality.required' => 'El campo del nombre no se admite vacío',
            'nameMunicipality.string' => 'El campo nombre solo puede ser de tipo texto',
            'nameMunicipality.max' => 'El campo nombre solo puede contener 50 caracteres',
            'region_id.required' => 'Debe seleccionar una region para el municipio',
            'region_id.integer' => 'El numero de la region solo puede ser un numero entero',
            'region_id.numeric' => 'El numero de la region solo puede ser de tipo numerico',
            'region_id.unique' => 'El numero de la region no existe, ingrese otro o registrela en la seccion de regiones',
        ];

        $request->validate($rules, $message);

        $municipality = new Municipality();
        $municipality->id = $request->id;
        $municipality->nameMunicipality = $request->nameMunicipality;
        $municipality->region_id = $request->region_id;
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
        $region_id = $request->get('region_id');

        $municipalities = Municipality::orderBy('id', 'ASC')
            ->id($idMunicipality)
            ->nameMunicipality($nameMunicipality)
            ->idRegion($region_id)
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
        $rules = [
            'id' => 'required|integer|numeric',
            'nameMunicipality' => 'required|string|max:50',
            'region_id' => 'required|integer|numeric|exists:regions,id',
        ];

        $message = [
            'id.required' => 'El id del municipio no se admite vacío',
            'id.integer' => 'El id del municipio solo puede ser un numero entero',
            'id.numeric' => 'El id del municipio solo puede ser de tipo numerico',
            'nameMunicipality.required' => 'El campo del nombre no se admite vacío',
            'nameMunicipality.string' => 'El campo nombre solo puede ser de tipo texto',
            'nameMunicipality.max' => 'El campo nombre solo puede contener 50 caracteres',
            'region_id.required' => 'Debe seleccionar una region para el municipio',
            'region_id.integer' => 'El numero de la region solo puede ser un numero entero',
            'region_id.numeric' => 'El numero de la region solo puede ser de tipo numerico',
            'region_id.unique' => 'El numero de la region no existe, ingrese otro o registrela en la seccion de regiones',
        ];

        $request->validate($rules, $message);

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
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 1)->where('media.reissue', null);
            })->where('municipality_id', $id)->get();

        $mediumsBim2 = Municipality::join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', function ($join) {
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 2)->where('media.reissue', null);
            })->where('municipality_id', $id)->get();

        $mediumsBim3 = Municipality::join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', function ($join) {
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 3)->where('media.reissue', null);
            })->where('municipality_id', $id)->get();

        $mediumsBim4 = Municipality::join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', function ($join) {
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 4)->where('media.reissue', null);
            })->where('municipality_id', $id)->get();

        $mediumsBim5 = Municipality::join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', function ($join) {
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 5)->where('media.reissue', null);
            })->where('municipality_id', $id)->get();
        ///////////////////////////////////////////////////////////

        /////////////////////////////////////////////////////////
        $reissueBim1 = Municipality::join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', function ($join) {
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 1)->where('media.reissue', 1);
            })->where('municipality_id', $id)->get();

        $reissueBim2 = Municipality::join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', function ($join) {
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 2)->where('media.reissue', 1);
            })->where('municipality_id', $id)->get();

        $reissueBim3 = Municipality::join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', function ($join) {
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 3)->where('media.reissue', 1);
            })->where('municipality_id', $id)->get();

        $reissueBim4 = Municipality::join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', function ($join) {
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 4)->where('media.reissue', 1);
            })->where('municipality_id', $id)->get();

        $reissueBim5 = Municipality::join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', function ($join) {
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 5)->where('media.reissue', 1);
            })->where('municipality_id', $id)->get();

        ////////////////////////////////////////////////////////

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
            return view('user.municipalities.municipalityGeneral', compact(
                'municipalityInfo',
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
            $pdf->loadView('user.municipalities.municipalityPdf', compact(
                'municipalityInfo',
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
