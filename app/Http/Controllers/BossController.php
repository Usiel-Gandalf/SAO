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
        //return $role = Auth::user()->rol;   
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bosses = User::where('rol', 0)->paginate(5);
        return view('user.users.boss.index', compact('bosses'));
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
        $request->validate([
            'name' => 'required|string|max:100',
            'firstSurname' => 'required|string|max:100',
            'secondSurname' => 'required|string|max:100',
            'status' => 'required|integer|max:1',
            'email' => 'required|email',
            'region_id' => 'required|integer',
            'password' => 'required|confirmed|min:8',
        ]);

        $rol  = request()->rol;

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

        $request->validate([
            'name' => 'required|string|max:100',
            'firstSurname' => 'required|string|max:100',
            'secondSurname' => 'required|string|max:100',
            'rol' => 'required|integer|max:1',
            'status' => 'required|integer|max:1',
            'region_id' => 'required|integer',
            'email' => 'required|email',
        ]);

        $user = new User();
        $name = $request->name;
        $firstSurname = $request->firstSurname;
        $secondSurname = $request->secondSurname;
        $email = $request->email;
        $status = $request->status;
        $region_id = $request->region_id;
        $rol = $request->rol;
        //$password = bcrypt($request->password);

        User::where('id', $id)->update([
            'name' => $name, 
            'firstSurname' => $firstSurname,
            'secondSurname' => $secondSurname, 
            'rol' => $rol, 
            'status' => $status,
            'region_id' => $region_id,
            'email' => $email
        ]);

        return redirect()->action('BossController@index')->with('updateBoss', 'Jefe juar actualizado');
    }

    public function updatePasswordBoss(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|confirmed|string|min:8',
        ]);
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
