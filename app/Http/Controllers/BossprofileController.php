<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BossprofileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');    
    }

    public function bossProfile(){
       

    }
}
