<?php

namespace App\Http\Controllers;

use App\Region;
use Illuminate\Http\Request;
use App\User;

class BossController extends Controller
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
        $regions = Region::all();
        $bosses = User::where('rol', 0)->paginate(8);
        return view('user.users.boss.index', compact('bosses', 'regions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = Region::all();
        return view('user.users.boss.create', compact('regions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->except('_token');
        $rules = [
            'name' => 'required|alpha|max:50',
            'firstSurname' => 'required|alpha|max:50',
            'secondSurname' => 'required|alpha|max:50',
            'email' => 'required|email|unique:users',
            'status' => 'required|numeric|max:1',
            'region_id' => 'numeric|nullable',
            'password' => 'required|alpha_num|confirmed|min:8',
        ];

        $message = [
            'name.required' => 'El campo del nombre no se admite vacío',
            'name.alpha' => 'El campo nombre solo puede ser de tipo texto',
            'name.max' => 'El campo nombre solo puede contener 50 caracteres',
            'firstSurname.required' => 'El campo del apellido paterno no se admite vacío',
            'firstSurname.alpha' => 'El campo del apellido paterno solo puede ser de tipo texto',
            'firstSurname.max' => 'El campo del apellido paterno solo puede contener 50 caracteres',
            'secondSurname.required' => 'El campo del apellido materno no se admite vacío',
            'secondSurname.alpha' => 'El campo del apellido materno solo puede ser de tipo texto',
            'secondSurname.max' => 'El campo del apellido materno solo puede contener 50 caracteres',
            'email.required' => 'El campo email no se admite vacío',
            'email.email' => 'Verifique que su correo sea valido',
            'email.unique' => 'El correo ya esta en uso, porfavor ingrese otro',
            'status.required' => 'El estado no puede estar vacio',
            'status.numeric' => 'El estado solo puede ser de tipo numerico',
            'status.max' => 'El estado es maximo de una longitud',
            'region_id.numeric' => 'No se admiten caracteres numericos en el campo de la region',
            'password.required' => 'Ingrese una contraseña',
            'password.alpha_num' => 'Su password debe de contener letras y numeros',
            'password.confirmed' => 'Confirme su contraseña',
            'password.min' => 'Su contraseña debe de ser minimo de 8 caracteres',
        ];

        $request->validate($rules, $message);

        $user = new User();
        $user->name = $request->name;
        $user->firstSurname = $request->firstSurname;
        $user->secondSurname = $request->secondSurname;
        $user->rol = 0;
        $user->status = $request->status;
        $user->region_id = $request->region_id;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->action('BossController@index')->with('saveBoss', 'Jefe juar registrado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $nameBoss = $request->get('nameBoss');
        $firstSurnameBoss = $request->get('firstSurnameBoss');
        $secondSurnameBoss = $request->get('secondSurnameBoss');
        $email = $request->get('email');

        $boss = User::orderBy('id', 'ASC')
            ->nameUser($nameBoss)
            ->firstSurnameUser($firstSurnameBoss)
            ->secondSurnameUser($secondSurnameBoss)
            ->rol(0)
            ->email($email)
            ->paginate(5);

        if (count($boss) == 0) {
            return back()->with('notFound', 'No se encontraron resultados');
        } else {
            return view('user.users.Boss.index', compact('boss'));
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
        $boss = User::findOrfail($id);
        $regions = Region::all();
        return view('user.users.boss.edit', compact('boss', 'regions'));
    }

    public function editPasswordBoss($id)
    {
        $boss = User::findOrfail($id);
        return view('user.users.boss.editPassword', compact('boss'));
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
            'name' => 'required|alpha|max:50',
            'firstSurname' => 'required|alpha|max:50',
            'secondSurname' => 'required|alpha|max:50',
            'email' => 'required|email',
            'rol' => 'required|numeric|max:1',
            'status' => 'required|numeric|max:1',
            'region_id' => 'numeric|nullable',
        ];

        $message = [
            'name.required' => 'El campo del nombre no se admite vacío',
            'name.alpha' => 'El campo nombre solo puede ser de tipo texto',
            'name.max' => 'El campo nombre solo puede contener 50 caracteres',
            'firstSurname.required' => 'El campo del apellido paterno no se admite vacío',
            'firstSurname.alpha' => 'El campo del apellido paterno solo puede ser de tipo texto',
            'firstSurname.max' => 'El campo del apellido paterno solo puede contener 50 caracteres',
            'secondSurname.required' => 'El campo del apellido materno no se admite vacío',
            'secondSurname.alpha' => 'El campo del apellido materno solo puede ser de tipo texto',
            'secondSurname.max' => 'El campo del apellido materno solo puede contener 50 caracteres',
            'email.required' => 'El campo email no se admite vacío',
            'email.email' => 'Verifique que su correo sea valido',
            'rol.required' => 'El rol no puede estar vacio',
            'rol.numeric' => 'El rol solo puede ser de tipo numerico',
            'rol.max' => 'El rol es maximo de una logitud',
            'status.required' => 'El estado no puede estar vacio',
            'status.numeric' => 'El estado solo puede ser de tipo numerico',
            'status.max' => 'El estado es maximo de una longitud',
            'region_id.numeric' => 'No se admiten caracteres numericos en el campo de la region',
        ];

        $request->validate($rules, $message);

        $emailVerification = User::where('email', $request->email)->count();

        if ($emailVerification == 1) {
            if (User::where('email', $request->email)->where('id', '!=', $id)->count() == 1) {
                return back()->with('notEmail', 'El correo al que intenta actualizar ya esta en uso, ingrese otro');
            }
        }

        $name = $request->name;
        $firstSurname = $request->firstSurname;
        $secondSurname = $request->secondSurname;
        $email = $request->email;
        $status = $request->status;
        $region_id = $request->region_id;
        $rol = $request->rol;

        User::where('id', $id)->update([
            'name' => $name,
            'firstSurname' => $firstSurname,
            'secondSurname' => $secondSurname,
            'rol' => $rol,
            'status' => $status,
            'region_id' => $region_id,
            'email' => $email
        ]);

        if ($rol == 0) {
            return redirect()->action('BossController@index')->with('updateBoss', 'Jefe juar actualizado');
        } else {
            User::where('id', $id)->update([
                'region_id' => null,
            ]);
            return redirect()->action('BossController@index')->with('updateBoss', 'Jefe juar actualizado y ascendido a Administrador');
        }
    }

    public function updatePasswordBoss(Request $request, $id)
    {
        $rules  = [
            'password' => 'required|alpha_num|confirmed|min:8',
        ];

        $message = [
            'password.required' => 'Ingrese una contraseña',
            'password.alpha_num' => 'Su password debe de contener letras y numeros',
            'password.confirmed' => 'Confirme su contraseña',
            'password.min' => 'Su contraseña debe de ser minimo de 8 caracteres',
        ];

        $request->validate($rules, $message);

        $password = $request->input('password');
        $password = bcrypt($password);

        User::where('id', $id)->update([
            'password' => $password
        ]);

        return redirect()->action('BossController@index')->with('updatePassword', 'Contraseña del jefe juar actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->action('BossController@index')->with('deleteBoss', 'Jefe juar eliminado');
    }
}
