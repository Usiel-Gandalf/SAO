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
        //return $role = Auth::user()->rol;   
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
        $request->validate([
            'name' => 'required|string|max:100',
            'firstSurname' => 'required|string|max:100',
            'secondSurname' => 'required|string|max:100',
            'status' => 'required|integer|max:1',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $emailVerification = User::where('email', $request->email)->count();
        $nameVerification = $request->name;
        $firstSurnameVerification = $request->firstSurname;
        $secondSurnameVerification = $request->secondSurname;

        if ($emailVerification == 1) {
            return back()->with('notEmail', 'El correo ya esta en uso, ingrese otro');
        } elseif (is_numeric($nameVerification)) {
            return back()->with('notName', 'El nombre solo puede ser de tipo texto');
        } elseif (is_numeric($firstSurnameVerification)) {
            return back()->with('notFirstSurname', 'El primer apellido solo puede ser de tipo texto');
        } elseif (is_numeric($secondSurnameVerification)) {
            return back()->with('notSecondSurname', 'El segundo apellido solo puede ser de tipo texto');
        } else {

            $user = new User();
            $user->name = $request->name;
            $user->firstSurname = $request->firstSurname;
            $user->secondSurname = $request->secondSurname;
            $user->rol = 1;
            $user->status = $request->status;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            return redirect()->action('AdminController@index')->with('saveAdmin', 'Administrador registrado correctamente');
        }
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

        $admin = User::orderBy('id', 'ASC')
            ->nameUser($nameAdmin)
            ->firstSurnameUser($firstSurnameAdmin)
            ->secondSurnameUser($secondSurnameAdmin)
            ->rol(1)
            ->email($email)
            ->paginate(5);

        if (count($admin) == 0) {
            return back()->with('notFound', 'No se encontraron resultados');
        } else {
            return view('user.users.admin.index', compact('admin'));
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
        $emailVerification = User::where('email', $request->email)->count();
        $nameVerification = $request->name;
        $firstSurnameVerification = $request->firstSurname;
        $secondSurnameVerification = $request->secondSurname;

        $request->validate([
            'name' => 'required|string|max:100',
            'firstSurname' => 'required|string|max:100',
            'secondSurname' => 'required|string|max:100',
            'rol' => 'required|integer|max:1',
            'status' => 'required|integer|max:1',
            'email' => 'required|email',
        ]);


        if ($emailVerification == 1) {
            if (User::where('email', $request->email)->where('id', '!=', $id)->count() == 1) {
                return back()->with('notEmail', 'El correo al que intenta actualizar ya esta en uso, ingrese otro');
            }
        }
        if (is_numeric($nameVerification)) {
            return back()->with('notName', 'El nombre solo puede ser de tipo texto');
        } elseif (is_numeric($firstSurnameVerification)) {
            return back()->with('notFirstSurname', 'El primer apellido solo puede ser de tipo texto');
        } elseif (is_numeric($secondSurnameVerification)) {
            return back()->with('notSecondSurname', 'El segundo apellido solo puede ser de tipo texto');
        } else {

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
            }else{
                return redirect()->action('AdminController@index')->with('updateAdmin', 'Administrador actualizado y descendido a Jefe de region');
            }
        }
    }

    public function updatePasswordAdmin(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|confirmed|string|min:8',
        ]);
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
