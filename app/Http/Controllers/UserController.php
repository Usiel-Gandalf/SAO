<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
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
        $users = User::paginate(10);
        return view('user.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.users.create');
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
            'rol' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $rol  = request()->rol;

        $user = new User();
        $user->name = $request->name;
        $user->firstSurname = $request->firstSurname;
        $user->secondSurname = $request->secondSurname;
        $user->rol = $request->rol;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->action('UserController@index')->with('saveUser', 'Usuario agregado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $nameUser = $request->get('nameUser');
        $firstSurnameUser = $request->get('firstSurnameUser');
        $secondSurnameUser = $request->get('secondSurnameUser');
        $rol = $request->get('rol');
        $email = $request->get('email');

        $users = User::orderBy('id', 'ASC')
            ->nameUser($nameUser)
            ->firstSurnameUser($firstSurnameUser)
            ->secondSurnameUser($secondSurnameUser)
            ->rol($rol)
            ->email($email)
            ->paginate(10);

        if (count($users) == 0) {
            return back()->with('notFound', 'No se encontraron resultados');
        } else {
            return view('user.users.index', compact('users'));
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
        $user = User::findOrfail($id);
        return view('user.users.edit', compact('user'));
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
            'name' => 'required|string|max:100',
            'firstSurname' => 'required|string|max:100',
            'secondSurname' => 'required|string|max:100',
            'rol' => 'required|integer',
            'email' => 'required|email',
        ]);

        $user = new User();
        $name = $request->name;
        $firstSurname = $request->firsSurname;
        $secondSurname = $request->seconSurname;
        $email = $request->email;
        $rol = $request->rol;
        //$password = bcrypt($request->password);

        User::where('id', $id)->update([
            'name' => $name, 'firstSurname' => $firstSurname,
            'secondSurname' => $secondSurname, 'rol' => $rol, 'email' => $email
        ]);

        return redirect()->action('UserController@index')->with('updateUser', 'Usuario actualizado');
    }

    public function editPassword($id)
    {
        $user = User::findOrfail($id);
        return view('user.users.editPassword', compact('user'));
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|confirmed|string|min:8',
        ]);
        $password = $request->input('password');
        $password = bcrypt($password);

        User::where('id', $id)->update([
            'password' => $password
        ]);

        return redirect()->action('UserController@index')->with('updatePassword', 'Contraseña del usuario actualizada correctamente');
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
        return redirect()->action('UserController@index')->with('deleteUser', 'Usuario eliminado');
    }
}
