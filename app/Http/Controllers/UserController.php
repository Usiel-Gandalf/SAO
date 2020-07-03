<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
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
        return view('uaer.users.create');
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
            'firstLastName' => 'required|string|max:100',
            'secondLastName' => 'required|string|max:100',
            'rol' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $rol  = request()->rol;

        if ($rol == "administrador") {
            $rol = 1;
        } elseif ($rol == "jefe") {
            $rol = 0;
        }

        $user = new User();
        $user->name = $request->name;
        $user->firstLastName = $request->firstLastName;
        $user->secondLastName = $request->secondLastName;
        $user->rol = $rol;
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
            'firstLastName' => 'required|string|max:100',
            'secondLastName' => 'required|string|max:100',
            'rol' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $rol = request()->rol;

        if ($rol == "administrador") {
            $rol = 1;
        } elseif ($rol == "jefe") {
            $rol = 0;
        }

        $user = new User();
        $name = $request->name;
        $firstLastName = $request->firstLastName;
        $secondLastName = $request->secondLastName;
        $email = $request->email;
        $password = bcrypt($request->password);

        $affected = User::where('id', $id)->update([
            'name' => $name, 'firstLastName' => $firstLastName,
            'secondLastName' => $secondLastName, 'rol' => $rol, 'email' => $email, 'password' => $password
        ]);

        return redirect()->action('UserController@index')->with('updateUser', 'Usuario actualizado');
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
        $users['users'] = User::paginate(10);
        return redirect()->action('UserController@index')->with('deleteUser', 'Usuario eliminado');
    }
}
