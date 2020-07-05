<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Locality;
use App\Municipality;

class LocalityController extends Controller
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
        $localities = Locality::with('municipality')->paginate(5);
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

        $request->validate([
            'id' => 'required|integer',
            'keyLocality' => 'required|integer',
            'nameLocality' => 'required|string',
            'idMunicipality' => 'required|integer',
        ]);

        $locality = new Locality();
        $locality->id = $request->id;
        $locality->keyLocality = $request->keyLocality;
        $locality->nameLocality = $request->nameLocality;
        $locality->municipality_id = $request->idMunicipality;
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
        $idMunicipality = $request->get('idMunicipality');
        // return $request;

        $localities = Locality::orderBy('id', 'ASC')
            ->idLocality($idLocality)
            ->numberLocality($numberLocality)
            ->nameLocality($nameLocality)
            ->idMunicipality($idMunicipality)
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
        $request->validate([
            'id' => 'required|integer',
            'keyLocality' => 'required|integer',
            'nameLocality' => 'required|string',
            'municipality_id' => 'required|integer',
        ]);

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
}
