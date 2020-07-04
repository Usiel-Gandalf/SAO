<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medium;
use App\School;

class MediumController extends Controller
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
        $mediums = Medium::with('school')->paginate(5);
        // Informacion de los estados de entrega de la educacion basica
        $pending = Medium::where('status', 0)->get();
        $pendingEntities = $pending->unique('school_id')->load('school.locality.municipality.region');
        $deliveryYes = Medium::where('status', 1)->get();
        $deliveryYesEntities = $deliveryYes->unique('school_id')->load('school.locality.municipality.region');
        $deliveryNot = Medium::where('status', 2)->get();
        $deliveryNotEntities = $deliveryNot->unique('school_id')->load('school.locality.municipality.region');
        $deliveryDrop = Medium::where('status', 3)->get();
        $deliveryDropEntities = $deliveryDrop->unique('school_id')->load('school.locality.municipality.region');
        $deliveryReshipment = Medium::where('status', 4)->get();
        $deliveryReshipmentEntities = $deliveryDrop->unique('school_id')->load('school.locality.municipality.region');
        //fin de la informacion de la entrega de educacion basica

        //return $pendingEntities;

        return view('user.mediums.index', compact('mediums', 'pending', 'deliveryYes', 'deliveryNot', 'deliveryDrop', 'deliveryReshipment', 
        'pendingEntities', 'deliveryYesEntities', 'deliveryNotEntities', 'deliveryDropEntities', 'deliveryReshipmentEntities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schools = School::all();
        return view('user.mediums.create', compact('schools'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        $request->validate([
            'scholar_id' => 'required|integer',
            'school_id' => 'required|string',
            'consignment' => 'required|string',
            'fol_form' => 'required|integer',
            'bimester' => 'required|integer',
            'year' => 'required|integer',
            'status' => 'required|integer',
        ]);

        $medium = new Medium();
        $medium->scholar_id = $request->scholar_id;
        $medium->school_id = $request->school_id;
        $medium->consignment = $request->consignment;
        $medium->fol_form = $request->fol_form;
        $medium->bimester = $request->bimester;
        $medium->year = $request->year;
        $medium->status = $request->status;
        $medium->save();

        return redirect()->action('MediumController@index')->with('saveMedium', 'Nuevo registro de educacion media superior agregado');

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
        $schools = School::all();
        $medium = Medium::findOrfail($id)->with('school')->first();
        return view('user.mediums.edit', compact('medium', 'schools'));
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

        Medium::where('id', $id)->update($data);
        return redirect()->action('MediumController@index')->with('updateMedium', 'Informacion de educacion media superior actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Medium::destroy($id);
        return redirect()->action('MediumController@index')->with('deleteMedium', 'Registro eliminado correctamente');
    }
}
