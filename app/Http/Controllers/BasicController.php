<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Basic;
use App\Locality;

class BasicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $basics = Basic::with('locality')->paginate(10);
        return view('user.basics.index', compact('basics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $localities = Locality::all();
        return view('user.basics.create', compact('localities'));
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
        $titular_id = $request->get('titular_id');

        $basics = Basic::orderBy('id', 'ASC')
            ->consignment($consignment)
            ->status($status)
            ->bimester($bimester)
            ->titular($titular_id)
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
        $localities = Locality::all();
        $basic = Basic::findOrfail($id)->with('locality')->first();
        return view('user.basics.edit', compact('basic', 'localities'));
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

        Basic::where('id', $id)->update($data);
        return redirect()->action('BasicController@index')->with('updateBasic', 'Informacion de educacion basica actualizada');
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
}
