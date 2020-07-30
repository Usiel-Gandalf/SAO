<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
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
        $admins = User::where('rol', 1)->paginate(5);
        return view('user.users.admin.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.users.admin.create');
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
            'password' => 'required|alpha_num|confirmed|min:8',
            'status' => 'required|numeric|max:1',
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
            'password.required' => 'Ingrese una contraseña',
            'password.alpha_num' => 'Su password debe de contener letras y numeros',
            'password.confirmed' => 'Confirme su contraseña',
            'password.min' => 'Su contraseña debe de ser minimo de 8 caracteres',
            'status.required' => 'El estado no puede estar vacio',
            'status.numeric' => 'El estado solo puede ser de tipo numerico',
            'status.max' => 'El estado es maximo de una longitud',
        ];

        $request->validate($rules, $message);

        $user = new User();
        $user->name = $request->name;
        $user->firstSurname = $request->firstSurname;
        $user->secondSurname = $request->secondSurname;
        $user->rol = 1;
        $user->status = 1;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->action('AdminController@index')->with('saveAdmin', 'Administrador registrado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $nameAdmin = $request->get('nameAdmin');
        $firstSurnameAdmin = $request->get('firstSurnameAdmin');
        $secondSurnameAdmin = $request->get('secondSurnameAdmin');
        $email = $request->get('email');

        $admins = User::orderBy('id', 'ASC')
            ->name($nameAdmin)
            ->firstSurname($firstSurnameAdmin)
            ->secondSurname($secondSurnameAdmin)
            ->email($email)
            ->rol(1)
            ->paginate(5);

        if (count($admins) == 0) {
            return back()->with('notFound', 'No se encontraron resultados');
        } else {
            return view('user.users.admin.index', compact('admins'));
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
        $admin = User::findOrfail($id);
        return view('user.users.admin.edit', compact('admin'));
    }

    public function editPasswordAdmin($id)
    {
        $admin = User::findOrfail($id);
        return view('user.users.admin.editPassword', compact('admin'));
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
        $rol = $request->rol;

        User::where('id', $id)->update([
            'name' => $name,
            'firstSurname' => $firstSurname,
            'secondSurname' => $secondSurname,
            'rol' => $rol,
            'status' => $status,
            'email' => $email
        ]);

        if ($rol == 1) {
            return redirect()->action('AdminController@index')->with('updateAdmin', 'Administrador actualizado');
        } else {
            return redirect()->action('AdminController@index')->with('updateAdmin', 'Administrador actualizado y descendido a Jefe de region');
        }
    }

    public function updatePasswordAdmin(Request $request, $id)
    {
        $rules = [
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

        return redirect()->action('AdminController@index')->with('updatePassword', 'Contraseña del administrador actualizada correctamente');
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
        return redirect()->action('AdminController@index')->with('deleteAdmin', 'Administrador eliminado');
    }
}
