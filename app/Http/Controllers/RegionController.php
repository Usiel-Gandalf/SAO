<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Region;

class RegionController extends Controller
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
        $regions = Region::paginate(5);
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
        }else{
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
        $data = request()->except(['_token','_method']);
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
}
