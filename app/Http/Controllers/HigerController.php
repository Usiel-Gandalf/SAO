<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Higer;

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
        $higers = Higer::with('school')->paginate(5);
        // Informacion de los estados de entrega de la educacion basica
        $pending = Higer::where('status', 0)->get();
        $pendingEntities = $pending->unique('school_id')->load('school.locality.municipality.region');
        $cermYes = Higer::where('status', 1)->get();
        $cermYesEntities = $cermYes->unique('school_id')->load('school.locality.municipality.region');
        $cermNot = Higer::where('status', 2)->get();
        $cermNotEntities = $cermNot->unique('school_id')->load('school.locality.municipality.region');
        $cermDrop = Higer::where('status', 3)->get();
        $cermDropEntities = $cermDrop->unique('school_id')->load('school.locality.municipality.region');;
        //fin de la informacion de la entrega de educacion basica

        //return $pendingEntities;

        return view('user.higers.index', compact('higers', 'pending', 'cermYes', 'cermNot', 'cermDrop', 
        'pendingEntities', 'cermYesEntities', 'cermNotEntities', 'cermDropEntities'));
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
