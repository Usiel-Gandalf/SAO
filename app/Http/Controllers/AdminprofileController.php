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
        $rules = [
            'name' => 'required|alpha|max:50',
            'firstSurname' => 'required|alpha|max:50',
            'secondSurname' => 'required|alpha|max:50',
            'email' => 'required|email',
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

        $password = $request->password;
        $password = bcrypt($password);
        User::where('id', $id)->update([
            'password' => $password,
        ]);

        return redirect()->action('AdminprofileController@adminProfile')->with('updatePasswordSuccess', 'Contraseña actualizada correctamente');
    }

    public function updateAdminEmail(Request $request, $id)
    {
        $rules = [
            'email' => 'required|email',
        ];

        $message = [
            'email.required' => 'El campo email no se admite vacío',
            'email.email' => 'Verifique que su correo sea valido',
        ];

        $request->validate($rules, $message);

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
