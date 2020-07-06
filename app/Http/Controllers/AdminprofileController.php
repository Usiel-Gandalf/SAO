<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminprofileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('onlyAdmin');
    }

    public function adminProfile()
    {
        $adminAuth = Auth::id();
        $admin = User::findOrfail($adminAuth);

        return view('user.profiles.admin.profile', compact('admin'));
    }

    public function editAdminProfile()
    {
        $admin = Auth::user();
        return view('user.profiles.admin.editProfile', compact('admin'));
    }

    public function editAdminPassword()
    {
        $idAdmin = Auth::id();
        return view('user.profiles.admin.editPassword', compact('idAdmin'));
    }

    public function editAdminEmail()
    {
        $idAdmin = Auth::id();
        return view('user.profiles.admin.editEmail', compact('idAdmin'));
    }

    public function updateAdminProfile(Request $request, $id)
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

        return redirect()->action('AdminprofileController@adminProfile')->with('updateProfileSuccess', 'Perfil actualizado correctamente');
    }

    public function updateAdminPassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|confirmed|string|min:8',
        ]);

        $password = $request->password;
        $password = bcrypt($password);
        User::where('id', $id)->update([
            'password' => $password,
        ]);

        return redirect()->action('AdminprofileController@adminProfile')->with('updatePasswordSuccess', 'Contraseña actualizada correctamente');
    }

    public function updateAdminEmail(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email|min:8',
        ]);

        $email = $request->email;
        $verifiedEmail = User::where('email', $email)->count();
        if ($verifiedEmail == 1) {
            return back()->with('emailUnique', 'El correo ya esta en uso, ingrese uno diferente');
        } else {
            User::where('id', $id)->update([
                'email' => $email,
            ]);
            return redirect()->action('AdminprofileController@adminProfile')->with('updateEmailSuccess', 'Correo electronico actualizado correctamente');
        }
    }
}
