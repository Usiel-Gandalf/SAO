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

        $rules = [
            'id' => 'required|integer|numeric|unique:titulars,id',
            'nameTitular' => 'required|string|max:50',
            'firstSurname' => 'required|string|max:50',
            'secondSurname' => 'required|string|max:50',
            'gender' => 'required',
            'birthDate' => 'nullable',
            'curp' => 'required|string|min:18|max:18',
        ];

        $message = [
            'id.required' => 'Ingrese una clave para la titular',
            'id.integer' => 'La clave de la titular debe de ser tipo numerico entero(sin puntos decimales)',
            'id.numeric ' => 'La clave de la titular debe de ser de tipo numerico',
            'id.unique' => 'La clave con la que intenta registrar a la titular ya existe, ingrese otra clave para registrar al becario',
            'nameTitular.required' => 'El campo del nombre no se admite vacío',
            'nameTitular.string' => 'El campo nombre solo puede ser de tipo texto',
            'nameTitular.max' => 'El campo nombre solo puede contener 50 caracteres',
            'firstSurname.required' => 'El campo del del primer apellido no se admite vacío',
            'firstSurname.string' => 'El campo del primer apellido solo puede ser de tipo texto',
            'firstSurname.max' => 'El campo del primer apellido solo puede contener 50 caracteres',
            'secondSurname.required' => 'El campo del del segundo apellido no se admite vacío',
            'secondSurname.string' => 'El campo del segundo apellido solo puede ser de tipo texto',
            'secondSurname.max' => 'El campo del segundo apellido solo puede contener 50 caracteres',
            'gender.required' => 'Debe seleccionar un genero para la titular',
            //'birthDate.required' => 'Debe ingresar una fecha de nacimiento para el becario',
            //'birthDate.date' => 'Debe ingresar una fecha de nacimiento valida para el becario',
            'curp.required' => 'Debe ingresar una curp para la titular',
            'curp.string' => 'El campo curp debe de contener letras y numeros',
            'curp.min' => 'El campo curp debe de contener minimo 18 caracteres',
            'curp.max' => 'El campo curp debe de contener maximo 18 caracteres',
        ];

        $request->validate($rules, $message);

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

        $rules = [
            'id' => 'required|integer|numeric',
            'nameTitular' => 'required|string|max:50',
            'firstSurname' => 'required|string|max:50',
            'secondSurname' => 'required|string|max:50',
            'gender' => 'required',
            'birthDate' => 'nullable',
            'curp' => 'required|string|min:18|max:18',
        ];

        $message = [
            'id.required' => 'Ingrese una clave para la titular',
            'id.integer' => 'La clave de la titular debe de ser tipo numerico entero(sin puntos decimales)',
            'id.numeric ' => 'La clave de la titular debe de ser de tipo numerico',
            'id.unique' => 'La clave con la que intenta registrar a la titular ya existe, ingrese otra clave para registrar al becario',
            'nameTitular.required' => 'El campo del nombre no se admite vacío',
            'nameTitular.string' => 'El campo nombre solo puede ser de tipo texto',
            'nameTitular.max' => 'El campo nombre solo puede contener 50 caracteres',
            'firstSurname.required' => 'El campo del del primer apellido no se admite vacío',
            'firstSurname.string' => 'El campo del primer apellido solo puede ser de tipo texto',
            'firstSurname.max' => 'El campo del primer apellido solo puede contener 50 caracteres',
            'secondSurname.required' => 'El campo del del segundo apellido no se admite vacío',
            'secondSurname.string' => 'El campo del segundo apellido solo puede ser de tipo texto',
            'secondSurname.max' => 'El campo del segundo apellido solo puede contener 50 caracteres',
            'gender.required' => 'Debe seleccionar un genero para la titular',
            //'birthDate.required' => 'Debe ingresar una fecha de nacimiento para el becario',
            //'birthDate.date' => 'Debe ingresar una fecha de nacimiento valida para el becario',
            'curp.required' => 'Debe ingresar una curp para la titular',
            'curp.string' => 'El campo curp debe de contener letras y numeros',
            'curp.min' => 'El campo curp debe de contener minimo 18 caracteres',
            'curp.max' => 'El campo curp debe de contener maximo 18 caracteres',
        ];

        $request->validate($rules, $message);

        if ($id ==  $request->id) {
            Titular::where('id', $id)->update($data);
            return redirect()->action('TitularController@index')->with('updateTitular', 'Titular actualizado');
        } else {
            if (Titular::where('id', $request->id)->count() == 1) {
                return back()->with('notTitular', 'El id con el que intenta actualizar a la titular ya esta en uso, ingrese otro');
            } else {
                Titular::where('id', $id)->update($data);
                return redirect()->action('TitularController@index')->with('updateTitular', 'Titular actualizado');
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
        Titular::destroy('id', $id);
        return redirect()->action('TitularController@index')->with('deleteTitular', 'Titular eliminado');
    }
}
