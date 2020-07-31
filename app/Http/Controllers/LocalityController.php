<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Locality;
use App\Municipality;
use App\User;

class LocalityController extends Controller
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
        $localities = Locality::with('municipality')->paginate(10);
        return view('user.localities.index', compact('localities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $municipalities = Municipality::all();
        return view('user.localities.create', compact('municipalities'));
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
            'id' => 'required|integer|numeric|unique:localities,id',
            'keyLocality' => 'required|integer|numeric',
            'nameLocality' => 'required|string|max:50',
            'municipality_id' => 'required|integer|numeric|exists:municipalities,id',
        ];

        $message = [
            'id.required' => 'La clave oficial no se admite vacío',
            'id.integer' => 'La clave oficial solo puede ser un numero entero',
            'id.numeric' => 'La clave oficial solo puede ser de tipo numerico',
            'id.unique' => 'La clave oficial ya se encuentra registrada',
            'keyLocality.required' => 'El numero de la localidad no se admite vacío',
            'keyLocality.integer' => 'El numero de la localidad solo puede ser un numero entero',
            'keyLocality.numeric' => 'El numero de la localidad solo puede ser de tipo numerico',
            'nameLocality.required' => 'El campo del nombre no se admite vacío',
            'nameLocality.string' => 'El campo nombre solo puede ser de tipo texto',
            'nameLocality.max' => 'El campo nombre solo puede contener 50 caracteres',
            'municipality_id.required' => 'Debe seleccionar un municipio para la localidad',
            'municipality_id.integer' => 'El numero del municipio solo puede ser un numero entero',
            'municipality_id.numeric' => 'El numero del municipio solo puede ser de tipo numerico',
            'municipality_id.unique' => 'El numero del municipio no existe, ingrese otro o registrela en la seccion de municipios',
        ];

        $request->validate($rules, $message);

        $locality = new Locality();
        $locality->id = $request->id;
        $locality->keyLocality = $request->keyLocality;
        $locality->nameLocality = $request->nameLocality;
        $locality->municipality_id = $request->municipality_id;
        $locality->save();

        return redirect()->action('LocalityController@index')->with('saveLocality', 'Nueva localidad agregada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $idLocality = $request->get('id');
        $numberLocality = $request->get('numberLocality');
        $nameLocality = $request->get('nameLocality');
        $municipality_id = $request->get('municipality_id');
        // return $request;

        $localities = Locality::orderBy('id', 'ASC')
            ->idLocality($idLocality)
            ->numberLocality($numberLocality)
            ->nameLocality($nameLocality)
            ->idMunicipality($municipality_id)
            ->paginate(5);

        if (count($localities) == 0) {
            return back()->with('notFound', 'No se encontraron resultados');
        } else {
            return view('user.localities.index', compact('localities'));
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
        $locality = Locality::findOrfail($id)->with('municipality')->first();
        $municipalities = Municipality::all();

        return view('user.localities.edit', compact('locality', 'municipalities'));
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
            'keyLocality' => 'required|integer|numeric',
            'nameLocality' => 'required|string|max:50',
            'municipality_id' => 'required|integer|numeric|exists:municipalities,id',
        ];

        $message = [
            'id.required' => 'La clave oficial no se admite vacío',
            'id.integer' => 'La clave oficial solo puede ser un numero entero',
            'id.numeric' => 'La clave oficial solo puede ser de tipo numerico',
            'keyLocality.required' => 'El numero de la localidad no se admite vacío',
            'keyLocality.integer' => 'El numero de la localidad solo puede ser un numero entero',
            'keyLocality.numeric' => 'El numero de la localidad solo puede ser de tipo numerico',
            'nameLocality.required' => 'El campo del nombre no se admite vacío',
            'nameLocality.string' => 'El campo nombre solo puede ser de tipo texto',
            'nameLocality.max' => 'El campo nombre solo puede contener 50 caracteres',
            'municipality_id.required' => 'Debe seleccionar un municipio para la localidad',
            'municipality_id.integer' => 'El numero del municipio solo puede ser un numero entero',
            'municipality_id.numeric' => 'El numero del municipio solo puede ser de tipo numerico',
            'municipality_id.unique' => 'El numero del municipio no existe, ingrese otro o registrela en la seccion de municipios',
        ];

        $request->validate($rules, $message);

        Locality::where('id', $id)->update($data);
        return redirect()->action('LocalityController@index')->with('updateLocality', 'Localidad actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Locality::destroy($id);
        return redirect()->action('LocalityController@index')->with('deleteLocality', 'Localidad eliminada');
    }

    public function reportLocality($id, $type)
    {
        $localityInfo = Locality::where('id', $id)->with('municipality.region')->get();
        foreach ($localityInfo as $locality) {
            $idReg =  $locality->municipality->region->id;
            $bossRegion = User::where('region_id', $idReg)->get();
        }

        ///////////////////////////////////////////
        $basicsCermBim1 = Locality::join('basics', function ($join) {
            $join->on('localities.id', '=', 'basics.locality_id')->where('basics.type', 1)->where('basics.bimester', 1);
        })->where('locality_id', $id)->get();

        $basicsCermBim2 = Locality::join('basics', function ($join) {
            $join->on('localities.id', '=', 'basics.locality_id')->where('basics.type', 1)->where('basics.bimester', 2);
        })->where('locality_id', $id)->get();

        $basicsCermBim3 = Locality::join('basics', function ($join) {
            $join->on('localities.id', '=', 'basics.locality_id')->where('basics.type', 1)->where('basics.bimester', 3);
        })->where('locality_id', $id)->get();

        $basicsCermBim4 = Locality::join('basics', function ($join) {
            $join->on('localities.id', '=', 'basics.locality_id')->where('basics.type', 1)->where('basics.bimester', 4);
        })->where('locality_id', $id)->get();

        $basicsCermBim5 = Locality::join('basics', function ($join) {
            $join->on('localities.id', '=', 'basics.locality_id')->where('basics.type', 1)->where('basics.bimester', 5);
        })->where('locality_id', $id)->get();

        //////////////////////////////////////////

        //////////////////////////////////////////////////
        $basicsDeliveryBim1 = Locality::join('basics', function ($join) {
            $join->on('localities.id', '=', 'basics.locality_id')->where('basics.type', 2)->where('basics.bimester', 1);
        })->where('locality_id', $id)->get();

        $basicsDeliveryBim2 = Locality::join('basics', function ($join) {
            $join->on('localities.id', '=', 'basics.locality_id')->where('basics.type', 2)->where('basics.bimester', 2);
        })->where('locality_id', $id)->get();

        $basicsDeliveryBim3 = Locality::join('basics', function ($join) {
            $join->on('localities.id', '=', 'basics.locality_id')->where('basics.type', 2)->where('basics.bimester', 3);
        })->where('locality_id', $id)->get();

        $basicsDeliveryBim4 = Locality::join('basics', function ($join) {
            $join->on('localities.id', '=', 'basics.locality_id')->where('basics.type', 2)->where('basics.bimester', 4);
        })->where('locality_id', $id)->get();

        $basicsDeliveryBim5 = Locality::join('basics', function ($join) {
            $join->on('localities.id', '=', 'basics.locality_id')->where('basics.type', 2)->where('basics.bimester', 5);
        })->where('locality_id', $id)->get();
        /////////////////////////////////////////////////

        /////////////////////////////////////////////////
        $mediumsBim1 = Locality::join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', function ($join) {
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 1)->where('media.reissue', null);
            })->where('locality_id', $id)->get();

        $mediumsBim2 = Locality::join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', function ($join) {
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 2)->where('media.reissue', null);
            })->where('locality_id', $id)->get();

        $mediumsBim3 = Locality::join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', function ($join) {
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 3)->where('media.reissue', null);
            })->where('locality_id', $id)->get();

        $mediumsBim4 = Locality::join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', function ($join) {
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 4)->where('media.reissue', null);
            })->where('locality_id', $id)->get();

        $mediumsBim5 = Locality::join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', function ($join) {
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 5)->where('media.reissue', null);
            })->where('locality_id', $id)->get();
        //////////////////////////////////////////////////////

        /////////////////////////////////////////////////
        $reissueBim1 = Locality::join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', function ($join) {
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 1)->where('media.reissue', 1);
            })->where('locality_id', $id)->get();

        $reissueBim2 = Locality::join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', function ($join) {
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 2)->where('media.reissue', 1);
            })->where('locality_id', $id)->get();

        $reissueBim3 = Locality::join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', function ($join) {
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 3)->where('media.reissue', 1);
            })->where('locality_id', $id)->get();

        $reissueBim4 = Locality::join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', function ($join) {
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 4)->where('media.reissue', 1);
            })->where('locality_id', $id)->get();

        $reissueBim5 = Locality::join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', function ($join) {
                $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 5)->where('media.reissue', 1);
            })->where('locality_id', $id)->get();
        /////////////////////////////////////////////////

        //////////////////////////////////////////////////////
        $higersBim1 = Locality::join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('higers',  function ($join) {
                $join->on('schools.id', '=', 'higers.school_id')->where('higers.bimester', 1);
            })->where('municipality_id', $id)->get();

        $higersBim2 = Locality::join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('higers',  function ($join) {
                $join->on('schools.id', '=', 'higers.school_id')->where('higers.bimester', 2);
            })->where('municipality_id', $id)->get();

        $higersBim3 = Locality::join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('higers',  function ($join) {
                $join->on('schools.id', '=', 'higers.school_id')->where('higers.bimester', 3);
            })->where('municipality_id', $id)->get();

        $higersBim4 = Locality::join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('higers',  function ($join) {
                $join->on('schools.id', '=', 'higers.school_id')->where('higers.bimester', 4);
            })->where('municipality_id', $id)->get();

        $higersBim5 = Locality::join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('higers',  function ($join) {
                $join->on('schools.id', '=', 'higers.school_id')->where('higers.bimester', 5);
            })->where('municipality_id', $id)->get();

        ///////////////////////////////////////////////////

        if ($type == 0) {
            return view('user.localities.localityGeneral', compact(
                'localityInfo',
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
            $pdf->loadView('user.localities.localityPdf', compact(
                'localityInfo',
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
