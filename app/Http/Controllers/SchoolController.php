<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Locality;
use App\School;
use App\User;

class SchoolController extends Controller
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
        $schools = School::with('locality')->paginate(5);
        return view('user.schools.index', compact('schools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $localities = Locality::all();
        return view('user.schools.create', compact('localities'));
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
            'idSchool' => 'required|string',
            'nameSchool' => 'required|string',
            'idLocality' => 'required|integer',
        ]);

        $school = new School();
        $school->idSchool = $request->idSchool;
        $school->nameSchool = $request->nameSchool;
        $school->locality_id = $request->idLocality;
        $school->save();

        return redirect()->action('SchoolController@index')->with('saveSchool', 'Nueva escuela agregada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $idSchool = $request->get('id');
        $nameSchool = $request->get('nameSchool');
        $idLocality = $request->get('idLocality');
        // return $request;

        $schools = School::orderBy('id', 'ASC')
            ->idSchool($idSchool)
            ->nameSchool($nameSchool)
            ->idLocality($idLocality)
            ->paginate(5);

        if (count($schools) == 0) {
            return back()->with('notFound', 'No se encontraron resultados');
        } else {
            return view('user.schools.index', compact('schools'));
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
        $school = School::where('id', $id)->with('locality')->first();
        $localities = Locality::all()->sortBy('nameLocality');
        return view('user.schools.edit', compact('school', 'localities'));
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
            'idSchool' => 'required|string',
            'nameSchool' => 'required|string',
            'locality_id' => 'required',
        ]);

        School::where('id', $id)->update($data);
        return redirect()->action('SchoolController@index')->with('updateSchool', 'Escuela actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Locality::destroy('id', $id);
        return redirect()->action('SchoolController@index')->with('deleteSchool', 'Escuela eliminada');
    }

    public function reportSchool($id, $type){
        $schoolInfo = School::where('id', $id)->with('locality.municipality.region')->get();
        foreach ($schoolInfo as $school) {
            $idReg =  $school->locality->municipality->region->id;
            $bossRegion = User::where('region_id', $idReg)->get();
        }

        $mediums = School::join('media', 'schools.id', '=', 'media.school_id')
        ->where('school_id', $id)
        ->get();

        $higers = School::join('higers', 'schools.id', '=', 'higers.school_id')
        ->where('school_id', $id)
        ->get();

        if ($type == 0) {
            return view('user.schools.schoolGeneral', compact('schoolInfo', 'bossRegion', 'mediums', 'higers'));
        } elseif ($type == 1) {
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadView('user.schools.schoolPdf', compact('schoolInfo', 'bossRegion', 'mediums', 'higers'));
            return $pdf->stream();
        } else {
            return back();
        }

    }
}
