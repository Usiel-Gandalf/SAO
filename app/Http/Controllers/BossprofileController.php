<?php

namespace App\Http\Controllers;

use App\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class BossprofileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('onlyBoss');
    }

    public function bossProfile()
    {
        $boss = Auth::user();
        $region = Region::findOrfail($boss->region_id);
        return view('user.profiles.boss.profile', compact('boss', 'region'));
    }

    public function editBossProfile()
    {
        $boss = Auth::user();
        return view('user.profiles.boss.editProfile', compact('boss'));
    }

    public function editBossPassword()
    {
        $idBoss = Auth::id();
        return view('user.profiles.boss.editPassword', compact('idBoss'));
    }

    public function editBossEmail()
    {
        $boss = Auth::user();
        return view('user.profiles.boss.editEmail', compact('boss'));
    }

    public function updateBossProfile(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'firstSurname' => 'required|string|max:50',
            'secondSurname' => 'required|string|max:50',
            'email' => 'required|email|max:20',
        ]);

        $name = $request->name;
        $firstSurname = $request->firstSurname;
        $secondSurname = $request->secondSurname;
        $email = $request->email;

        User::where('id', $id)->update([
            'name' => $name,
            'firstSurname' => $firstSurname,
            'secondSurname' => $secondSurname,
            'email' => $email,
        ]);

        return redirect()->action('BossprofileController@bossProfile')->with('updateProfileSuccess', 'Perfil actualizado correctamente');
    }

    public function updateBossPassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|confirmed|string|min:8',
        ]);
   
        $password = $request->password;
        $password = bcrypt($password);
        User::where('id', $id)->update([
            'password' => $password,
        ]);

        return redirect()->action('BossprofileController@bossProfile')->with('updatePasswordSuccess', 'Contraseña actualizada correctamente'); 
    }

    public function updateBossEmail(Request $request, $id)
    {
        
        $request->validate([
            'email' => 'required|email|min:8',
        ]);
                /*
        $email = $request->email;
        $verifiedEmail = User::where('email', $email)->count();
        if ($verifiedEmail == 1) {
            return back()->with('emailUnique', 'El correo ya esta en uso, ingrese uno diferente');
        } else {
            User::where('id', $id)->update([
                'email' => $email,
            ]);
            return redirect()->action('BossprofileController@bossProfile')->with('updateEmailSuccess', 'Correo electronico actualizado correctamente');
        } */

        
    }
}
