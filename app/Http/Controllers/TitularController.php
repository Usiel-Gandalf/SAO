<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Titular;

class TitularController extends Controller
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
        $titulars = Titular::paginate(10);
        return view('user.titulars.index', compact('titulars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.titulars.create');
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
            'nameTitular' => 'required|string',
            'firstSurname' => 'required|string',
            'secondSurname' => 'required|string',
            'gender' => 'required',
            'birthDate' => 'required|string',
            'curp' => 'required|string',
        ]);

        $titular = new Titular();
        $titular->id = $request->id;
        $titular->nameTitular = $request->nameTitular;
        $titular->firstSurname = $request->firstSurname;
        $titular->secondSurname = $request->secondSurname;
        $titular->gender = $request->gender;
        $titular->birthDate = $request->birthDate;
        $titular->curp = $request->curp;
        $titular->save();

        return redirect()->action('TitularController@index')->with('saveTitular', 'Nuevo titular agregado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $idTitular = $request->get('id');
        $nameTitular = $request->get('nameTitular');
        $firstSurnameTitular = $request->get('firstSurnameTitular');
        $secondSurnameTitular = $request->get('secondSurnameTitular');

       $titulars = Titular::orderBy('id', 'ASC')
       ->idTitular($idTitular)
       ->nameTitular($nameTitular)
       ->firstSurnameTitular($firstSurnameTitular)
       ->secondSurnameTitular($secondSurnameTitular)
       ->paginate(10);

       if (count($titulars) == 0) {
        return back()->with('notFound', 'No se encontraron resultados');
       } else {
        return view('user.titulars.index', compact('titulars'));
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
        $titular = Titular::findOrfail($id);
        return view('user.titulars.edit', compact('titular'));
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
            'nameTitular' => 'required|string',
            'firstSurname' => 'required|string',
            'secondSurname' => 'required|string',
            'gender' => 'required',
            'birthDate' => 'required|string',
            'curp' => 'required|string',
        ]);
        
        Titular::where('id', $id)->update($data);
        return redirect()->action('TitularController@index')->with('updateTitular', 'Titular actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Titular::destroy('id', $id);
        return redirect()->action('TitularController@index')->with('deleteTitular', 'Titular eliminado');
    }
}
