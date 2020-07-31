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
        $schools = School::with('locality')->paginate(10);
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

        $rules = [
            'id' => 'required|string|unique:schools,id',
            'nameSchool' => 'required|string|max:50',
            'locality_id' => 'required|integer|numeric|exists:localities,id',
        ];

        $message = [
            'id.required' => 'Ingrese una clave para la escuela',
            'id.string' => 'La clave de la escuela debe de ser de tipo texto',
            'id.unique' => 'La clave de la escuela ya existe',
            'nameSchool.required' => 'El campo del nombre no se admite vacío',
            'nameSchool.string' => 'El campo nombre solo puede ser de tipo texto',
            'nameSchool.max' => 'El campo nombre solo puede contener 50 caracteres',
            'locality_id.required' => 'Debe seleccionar una localidad para la escuela',
            'locality_id.integer' => 'El numero de la localidad solo puede ser un numero entero',
            'locality_id.numeric' => 'El numero de la localidad solo puede ser de tipo numerico',
            'locality_id.unique' => 'El numero de la localidad no existe, ingrese otro o registrela en la seccion de localidades',
        ];

        $request->validate($rules, $message);

        $school = new School();
        $school->id = $request->id;
        $school->nameSchool = $request->nameSchool;
        $school->locality_id = $request->locality_id;
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
        $locality_id = $request->get('locality_id');

        $schools = School::orderBy('id', 'ASC')
            ->idSchool($idSchool)
            ->nameSchool($nameSchool)
            ->idLocality($locality_id)
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
        $rules = [
            'id' => 'required|string|unique:schools,id',
            'nameSchool' => 'required|string|max:50',
            'locality_id' => 'required|integer|numeric|exists:localities,id',
        ];

        $message = [
            'id.required' => 'Ingrese una clave para la escuela',
            'id.string' => 'La clave de la escuela debe de ser de tipo texto',
            'id.unique' => 'La clave de la escuela ya existe',
            'nameSchool.required' => 'El campo del nombre no se admite vacío',
            'nameSchool.string' => 'El campo nombre solo puede ser de tipo texto',
            'nameSchool.max' => 'El campo nombre solo puede contener 50 caracteres',
            'locality_id.required' => 'Debe seleccionar una localidad para la escuela',
            'locality_id.integer' => 'El numero de la localidad solo puede ser un numero entero',
            'locality_id.numeric' => 'El numero de la localidad solo puede ser de tipo numerico',
            'locality_id.unique' => 'El numero de la localidad no existe, ingrese otro o registrela en la seccion de localidades',
        ];

        $request->validate($rules, $message);

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

    public function reportSchool($id, $type)
    {
        $schoolInfo = School::where('id', $id)->with('locality.municipality.region')->get();
        foreach ($schoolInfo as $school) {
            $idReg =  $school->locality->municipality->region->id;
            $bossRegion = User::where('region_id', $idReg)->get();
        }

        //////////////////////////////////////////7
        $mediumsBim1 = School::join('media', function ($join) {
            $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 1)->where('media.reissue', null);
        })->where('school_id', $id)->get();

        $mediumsBim2 = School::join('media', function ($join) {
            $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 2)->where('media.reissue', null);
        })->where('school_id', $id)->get();

        $mediumsBim3 = School::join('media', function ($join) {
            $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 3)->where('media.reissue', null);
        })->where('school_id', $id)->get();

        $mediumsBim4 = School::join('media', function ($join) {
            $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 4)->where('media.reissue', null);
        })->where('school_id', $id)->get();

        $mediumsBim5 = School::join('media', function ($join) {
            $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 5)->where('media.reissue', null);
        })->where('school_id', $id)->get();
        //////////////////////////////////////////

        //////////////////////////////////////////7
        $reissueBim1 = School::join('media', function ($join) {
            $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 1)->where('media.reissue', 1);
        })->where('school_id', $id)->get();

        $reissueBim2 = School::join('media', function ($join) {
            $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 2)->where('media.reissue', 1);
        })->where('school_id', $id)->get();

        $reissueBim3 = School::join('media', function ($join) {
            $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 3)->where('media.reissue', 1);
        })->where('school_id', $id)->get();

        $reissueBim4 = School::join('media', function ($join) {
            $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 4)->where('media.reissue', 1);
        })->where('school_id', $id)->get();

        $reissueBim5 = School::join('media', function ($join) {
            $join->on('schools.id', '=', 'media.school_id')->where('media.bimester', 5)->where('media.reissue', 1);
        })->where('school_id', $id)->get();
        //////////////////////////////////////////

        /////////////////////////////////////////
        $higersBim1 = School::join('higers',  function ($join) {
            $join->on('schools.id', '=', 'higers.school_id')->where('higers.bimester', 1);
        })->where('school_id', $id)->get();

        $higersBim2 = School::join('higers',  function ($join) {
            $join->on('schools.id', '=', 'higers.school_id')->where('higers.bimester', 2);
        })->where('school_id', $id)->get();

        $higersBim3 = School::join('higers',  function ($join) {
            $join->on('schools.id', '=', 'higers.school_id')->where('higers.bimester', 3);
        })->where('school_id', $id)->get();

        $higersBim4 = School::join('higers',  function ($join) {
            $join->on('schools.id', '=', 'higers.school_id')->where('higers.bimester', 4);
        })->where('school_id', $id)->get();

        $higersBim5 = School::join('higers',  function ($join) {
            $join->on('schools.id', '=', 'higers.school_id')->where('higers.bimester', 5);
        })->where('school_id', $id)->get();
        ///////////////////////////////////////

        if ($type == 0) {
            return view('user.schools.schoolGeneral', compact(
                'schoolInfo',
                'bossRegion',
                'mediumsBim1',
                'mediumsBim2',
                'mediumsBim3',
                'mediumsBim4',
                'mediumsBim5',
                'reissueBim1',
                'reissueBim2',
                'reissueBim3',
                'reissueBim4',
                'reissueBim5',
                'higersBim1',
                'higersBim2',
                'higersBim3',
                'higersBim4',
                'higersBim5'
            ));
        } elseif ($type == 1) {
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadView('user.schools.schoolPdf', compact(
                'schoolInfo',
                'bossRegion',
                'mediumsBim1',
                'mediumsBim2',
                'mediumsBim3',
                'mediumsBim4',
                'mediumsBim5',
                'reissueBim1',
                'reissueBim2',
                'reissueBim3',
                'reissueBim4',
                'reissueBim5',
                'higersBim1',
                'higersBim2',
                'higersBim3',
                'higersBim4',
                'higersBim5'
            ));
            return $pdf->stream();
        } else {
            return back();
        }
    }
}
