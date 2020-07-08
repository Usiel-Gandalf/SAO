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
        $request->validate([
            'name' => 'required|string|max:100',
            'firstSurname' => 'required|string|max:100',
            'secondSurname' => 'required|string|max:100',
            'status' => 'required|integer|max:1',
            'email' => 'required|email',
            'region_id' => 'integer|nullable',
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
            $user->rol = 0;
            $user->status = $request->status;
            $user->region_id = $request->region_id;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            return redirect()->action('BossController@index')->with('saveBoss', 'Jefe juar registrado correctamente');
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
        $emailVerification = User::where('email', $request->email)->count();
        $nameVerification = $request->name;
        $firstSurnameVerification = $request->firstSurname;
        $secondSurnameVerification = $request->secondSurname;

        $request->validate([
            'name' => 'required|string|max:50',
            'firstSurname' => 'required|string|max:50',
            'secondSurname' => 'required|string|max:50',
            'rol' => 'required|integer|max:1',
            'status' => 'required|integer|max:1',
            'region_id' => 'integer|nullable',
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
                
            if ($rol == 0) {
                return redirect()->action('BossController@index')->with('updateBoss', 'Jefe juar actualizado');
            }else{
                User::where('id', $id)->update([
                    'region_id' => null,
                ]);
                return redirect()->action('BossController@index')->with('updateBoss', 'Jefe juar actualizado y ascendido a Administrador');
            }
        }
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
