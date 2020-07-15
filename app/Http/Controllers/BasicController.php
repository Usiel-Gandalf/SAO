<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Basic;
use App\Locality;

class BasicController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $basics = Basic::with('locality')->paginate(10);

        $basicsCermBim1 = Basic::where('type', 1)->where('bimester', 1)->get();
        $basicsCermBim2 = Basic::where('type', 1)->where('bimester', 2)->get();
        $basicsCermBim3 = Basic::where('type', 1)->where('bimester', 3)->get();
        $basicsCermBim4 = Basic::where('type', 1)->where('bimester', 4)->get();
        $basicsCermBim5 = Basic::where('type', 1)->where('bimester', 5)->get();

        $basicsDeliveryBim1 = Basic::where('type', 2)->where('bimester', 1)->get();
        $basicsDeliveryBim2 = Basic::where('type', 2)->where('bimester', 2)->get();
        $basicsDeliveryBim3 = Basic::where('type', 2)->where('bimester', 3)->get();
        $basicsDeliveryBim4 = Basic::where('type', 2)->where('bimester', 4)->get();
        $basicsDeliveryBim5 = Basic::where('type', 2)->where('bimester', 5)->get();

        return view('user.basics.index', compact(
            'basics',
            'basicsCermBim1',
            'basicsCermBim2',
            'basicsCermBim3',
            'basicsCermBim4',
            'basicsCermBim5',
            'basicsDeliveryBim1',
            'basicsDeliveryBim2',
            'basicsDeliveryBim3',
            'basicsDeliveryBim4',
            'basicsDeliveryBim5'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.basics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'titular_id' => 'required|integer',
            'locality_id' => 'required|integer',
            'consignment' => 'required|string',
            'fol_form' => 'required|integer',
            'bimester' => 'required|integer',
            'year' => 'required|integer',
            'status' => 'required|integer',
            'type' => 'required|integer',
        ]);

        $loc = $request->input('locality_id');

        $locExist= Locality::where('id', $loc)->first();
        if ($locExist === null) {
              return back()->with('locNot', 'La localidad con la que intenta hacer el registro no existe, asegurese de registrarla primero en la seccion de localidades');
        }

        $basic = new Basic();
        $basic->titular_id = $request->titular_id;
        $basic->locality_id = $request->locality_id;
        $basic->consignment = $request->consignment;
        $basic->fol_form = $request->fol_form;
        $basic->bimester = $request->bimester;
        $basic->year = $request->year;
        $basic->status = $request->status;
        $basic->type = $request->type;
        $basic->save();

        return redirect()->action('BasicController@index')->with('saveBasic', 'Nueva registro de educacion basica agregada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $consignment = $request->get('consignment');
        $status = $request->get('status');
        $bimester = $request->get('bimester');
        $type = $request->get('type');

        $basics = Basic::orderBy('id', 'ASC')
            ->consignment($consignment)
            ->status($status)
            ->bimester($bimester)
            ->type($type)
            ->paginate(10);

        if (count($basics) == 0) {
            return back()->with('notFound', 'No se encontraron resultados');
        } else {
            return view('user.basics.index', compact('basics'));
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
        $basic = Basic::findOrfail($id);
        return view('user.basics.edit', compact('basic'));
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
            'titular_id' => 'required|integer',
            'locality_id' => 'required|integer',
            'consignment' => 'required|string',
            'fol_form' => 'required|integer',
            'bimester' => 'required|integer',
            'year' => 'required|integer',
            'status' => 'required|integer',
            'type' => 'required|integer',
        ]);

        $loc = $request->input('locality_id');

        $locExist= Locality::where('id', $loc)->first();
        if ($locExist === null) {
              return back()->with('locNot', 'La localidad con la que intenta actualizar el registro no existe, asegurese de registrarla primero en la seccion de localidades');
        }
    
        Basic::where('id', $id)->update($data);
        return redirect()->action('BasicController@index')->with('updateBasic', 'Regitro actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Basic::destroy($id);
        return redirect()->action('BasicController@index')->with('deleteBasic', 'Informacion de educacion basica eliminada');
    }

    public function basicPdf()
    {
        $basicsCermBim1 = Basic::where('type', 1)->where('bimester', 1)->get();
        $basicsCermBim2 = Basic::where('type', 1)->where('bimester', 2)->get();
        $basicsCermBim3 = Basic::where('type', 1)->where('bimester', 3)->get();
        $basicsCermBim4 = Basic::where('type', 1)->where('bimester', 4)->get();
        $basicsCermBim5 = Basic::where('type', 1)->where('bimester', 5)->get();

        $basicsDeliveryBim1 = Basic::where('type', 2)->where('bimester', 1)->get();
        $basicsDeliveryBim2 = Basic::where('type', 2)->where('bimester', 2)->get();
        $basicsDeliveryBim3 = Basic::where('type', 2)->where('bimester', 3)->get();
        $basicsDeliveryBim4 = Basic::where('type', 2)->where('bimester', 4)->get();
        $basicsDeliveryBim5 = Basic::where('type', 2)->where('bimester', 5)->get();

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('user.basics.basicPdf', compact(
            'basicsCermBim1',
            'basicsCermBim2',
            'basicsCermBim3',
            'basicsCermBim4',
            'basicsCermBim5',
            'basicsDeliveryBim1',
            'basicsDeliveryBim2',
            'basicsDeliveryBim3',
            'basicsDeliveryBim4',
            'basicsDeliveryBim5'
        ));
        return $pdf->stream();
    }
}
