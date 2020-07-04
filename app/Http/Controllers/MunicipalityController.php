<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Municipality;
use App\Region;

class MunicipalityController extends Controller
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
       ->paginate(10);

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
}
