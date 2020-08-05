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
        request()->except('_token', 'birthDate');

        $rules = [
            'id' => 'required|integer|numeric|unique:scholars,id',
            'nameScholar' => 'required|string|max:50',
            'firstSurname' => 'required|string|max:50',
            'secondSurname' => 'required|string|max:50',
            'gender' => 'required',
            //'birthDate' => 'nullable',
            'curp' => 'required|string|min:18|max:18',
        ];

        $message = [
            'id.required' => 'Ingrese una clave para el becario',
            'id.integer' => 'La clave del becario debe de ser tipo numerico entero(sin puntos decimales)',
            'id.numeric ' => 'La clave del becario debe de ser de tipo numerico',
            'id.unique' => 'La clave con la que intenta registrar al becario ya existe, ingrese otra clave para registrar al becario',
            'nameScholar.required' => 'El campo del nombre no se admite vacío',
            'nameScholar.string' => 'El campo nombre solo puede ser de tipo texto',
            'nameScholar.max' => 'El campo nombre solo puede contener 50 caracteres',
            'firstSurname.required' => 'El campo del del primer apellido no se admite vacío',
            'firstSurname.string' => 'El campo del primer apellido solo puede ser de tipo texto',
            'firstSurname.max' => 'El campo del primer apellido solo puede contener 50 caracteres',
            'secondSurname.required' => 'El campo del del segundo apellido no se admite vacío',
            'secondSurname.string' => 'El campo del segundo apellido solo puede ser de tipo texto',
            'secondSurname.max' => 'El campo del segundo apellido solo puede contener 50 caracteres',
            'gender.required' => 'Debe seleccionar un genero para el becario',
            //'birthDate.required' => 'Debe ingresar una fecha de nacimiento para el becario',
            //'birthDate.date' => 'Debe ingresar una fecha de nacimiento valida para el becario',
            'curp.required' => 'Debe ingresar una curp para el becario',
            'curp.string' => 'El campo curp debe de contener letras y numeros',
            'curp.min' => 'El campo curp debe de contener minimo 18 caracteres',
            'curp.max' => 'El campo curp debe de contener maximo 18 caracteres',
        ];

        $request->validate($rules, $message);

        $scholar = new Scholar();
        $scholar->id = $request->id;
        $scholar->nameScholar = $request->nameScholar;
        $scholar->firstSurname = $request->firstSurname;
        $scholar->secondSurname = $request->secondSurname;
        $scholar->gender = $request->gender;
        //$scholar->birthDate = $request->birthDate;
        $scholar->curp = $request->curp;
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
        $data = request()->except(['_token', '_method', 'birthDate']);

        $rules = [
            'id' => 'required|integer|numeric',
            'nameScholar' => 'required|string|max:50',
            'firstSurname' => 'required|string|max:50',
            'secondSurname' => 'required|string|max:50',
            'gender' => 'required',
            //'birthDate' => 'nullable',
            'curp' => 'required|string|min:18|max:18',
        ];

        $message = [
            'id.required' => 'Ingrese una clave para el becario',
            'id.integer' => 'La clave del becario debe de ser tipo numerico entero(sin puntos decimales)',
            'id.numeric ' => 'La clave del becario debe de ser de tipo numerico',
            //'id.unique' => 'La clave con la que intenta registrar al becario ya existe, ingrese otra clave para registrar al becario',
            'nameScholar.required' => 'El campo del nombre no se admite vacío',
            'nameScholar.string' => 'El campo nombre solo puede ser de tipo texto',
            'nameScholar.max' => 'El campo nombre solo puede contener 50 caracteres',
            'firstSurname.required' => 'El campo del del primer apellido no se admite vacío',
            'firstSurname.string' => 'El campo del primer apellido solo puede ser de tipo texto',
            'firstSurname.max' => 'El campo del primer apellido solo puede contener 50 caracteres',
            'secondSurname.required' => 'El campo del del segundo apellido no se admite vacío',
            'secondSurname.string' => 'El campo del segundo apellido solo puede ser de tipo texto',
            'secondSurname.max' => 'El campo del segundo apellido solo puede contener 50 caracteres',
            'gender.required' => 'Debe seleccionar un genero para el becario',
            //'birthDate.required' => 'Debe ingresar una fecha de nacimiento para el becario',
            //'birthDate.date' => 'Debe ingresar una fecha de nacimiento valida para el becario',
            'curp.required' => 'Debe ingresar una curp para el becario',
            'curp.string' => 'El campo curp debe de contener letras y numeros',
            'curp.min' => 'El campo curp debe de contener minimo 18 caracteres',
            'curp.max' => 'El campo curp debe de contener maximo 18 caracteres',
        ];

        $request->validate($rules, $message);

        if ($id ==  $request->id) {
            Scholar::where('id', $id)->update($data);
            return redirect()->action('ScholarController@index')->with('updateScholar', 'Becario actualizado');
        } else {
            if (Scholar::where('id', $request->id)->count() == 1) {
                return back()->with('notScholar', 'El id con el que intenta actualizar al becario ya esta en uso, ingrese otro');
            } else {
                Scholar::where('id', $id)->update($data);
                return redirect()->action('ScholarController@index')->with('updateScholar', 'Becario actualizado');
            }
        }
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
