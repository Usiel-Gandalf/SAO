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
        $this->middleware('checkRole');   
        //return $role = Auth::user()->rol;   
    }

    public function adminProfile(){
        $adminAuth = Auth::id();
        $admin = User::findOrfail($adminAuth);

        return view('user.profiles.admin.profile', compact('admin'));
    }
}
