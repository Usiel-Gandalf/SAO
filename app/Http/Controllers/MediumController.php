<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medium;

class MediumController extends Controller
{
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
