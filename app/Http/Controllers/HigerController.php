<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Higer;
use App\School;

class HigerController extends Controller
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
        $higers = Higer::where('school_id', null)->paginate(5);
        $higersBim1 = Higer::where('bimester', 1)->get();
        $higersBim2 = Higer::where('bimester', 2)->get();
        $higersBim3 = Higer::where('bimester', 3)->get();
        $higersBim4 = Higer::where('bimester', 4)->get();
        $higersBim5 = Higer::where('bimester', 5)->get();

        return view('user.higers.index', compact('higers', 'higersBim1', 'higersBim2', 'higersBim3', 'higersBim4', 'higersBim5'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schools = School::all();
        return view('user.higers.create', compact('schools'));
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
            'scholar_id' => 'required|integer',
            'school_id' => 'required|string',
            'consignment' => 'required|string',
            'fol_form' => 'required|integer',
            'bimester' => 'required|integer',
            'year' => 'required|integer',
            'status' => 'required|integer',
        ]);

        $higer = new Higer();
        $higer->scholar_id = $request->scholar_id;
        $higer->school_id = $request->school_id;
        $higer->consignment = $request->consignment;
        $higer->fol_form = $request->fol_form;
        $higer->bimester = $request->bimester;
        $higer->year = $request->year;
        $higer->status = $request->status;
        $higer->save();

        return redirect()->action('HigerController@index')->with('saveHiger', 'Nueva registro de jovenes escribiendo el furuto agregado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $JEF = Higer::findOrfail($id);
        $schools = School::all();
        return view('user.higers.edit', compact('schools', 'JEF'));
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
            'scholar_id' => 'required|integer',
            'school_id' => 'required|string',
            'consignment' => 'required|string',
            'fol_form' => 'required|integer',
            'bimester' => 'required|integer',
            'year' => 'required|integer',
            'status' => 'required|integer',
        ]);

        Higer::where('id', $id)->update($data);
        return redirect()->action('HigerController@index')->with('updateHiger', 'Informacion de Jovenes escribiendo el futuro actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Higer::destroy($id);
        return redirect()->action('HigerController@index')->with('deleteHiger', 'Informacion de Jovenes escribiendo el futuro eliminada');
    }

    public function higerPdf()
    {
        $higersBim1 = Higer::where('bimester', 1)->get();
        $higersBim2 = Higer::where('bimester', 2)->get();
        $higersBim3 = Higer::where('bimester', 3)->get();
        $higersBim4 = Higer::where('bimester', 4)->get();
        $higersBim5 = Higer::where('bimester', 5)->get();

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('user.higers.higerPdf', compact('higersBim1', 'higersBim2', 'higersBim3', 'higersBim4', 'higersBim5'));
        return $pdf->stream();
    }
}
