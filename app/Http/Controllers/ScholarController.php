<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Scholar;

class ScholarController extends Controller
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
        $scholars = Scholar::paginate(10);
        return view('user.scholars.index', compact('scholars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.scholars.create');
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
            'keyScholar' => 'required',
            'nameScholar' => 'required|string',
            'firstSurname' => 'required|string',
            'secondSurname' => 'required|string',
            'gender' => 'required',
            'birthDate' => 'required|date',
            'curp' => 'required|string',
        ]);
        $scholar = new Scholar();
        $scholar->nameScholar = $request->nameScholar;
        $scholar->firstSurname = $request->firstSurname;
        $scholar->secondSurname = $request->secondSurname;
        $scholar->gender = $request->gender;
        $scholar->birthDate = $request->birthDate;
        $scholar->curp = $request->curp;
        $scholar->keyScholar = $request->keyScholar;
        $scholar->save();

        return redirect()->action('ScholarController@index')->with('saveScholar', 'Nuevo becario agregado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $idScholar = $request->get('id');
        $nameScholar = $request->get('nameScholar');
        $firstSurnameScholar = $request->get('firstSurnameScholar');
        $secondSurnameScholar = $request->get('secondSurnameScholar');
        // $curpScholar = $request->get('curpScholar');
        // return $request;

        $scholars = Scholar::orderBy('id', 'ASC')
            ->idScholar($idScholar)
            ->nameScholar($nameScholar)
            ->firstSurnameScholar($firstSurnameScholar)
            ->secondSurnameScholar($secondSurnameScholar)
            //->curpScholar($curpScholar)
            ->paginate(10);

        if (count($scholars) == 0) {
            return back()->with('notFound', 'No se encontraron resultados');
        } else {
            return view('user.scholars.index', compact('scholars'));
        }

        return view('user.scholars.index', compact('scholars'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $scholar = Scholar::findOrfail($id);
        // return $scholar;
        return view('user.scholars.edit', compact('scholar'));
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
            'keyScholar' => 'required',
            'nameScholar' => 'required|string',
            'firstSurname' => 'required|string',
            'secondSurname' => 'required|string',
            'gender' => 'required',
            'birthDate' => 'required',
            'curp' => 'required|string',
        ]);

        Scholar::where('id', $id)->update($data);
        return redirect()->action('ScholarController@index')->with('updateScholar', 'Becario actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Scholar::destroy('id', $id);
        return redirect()->action('ScholarController@index')->with('deleteScholar', 'Becario eliminado');
    }
}
