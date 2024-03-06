<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkRole:superadmin')->only('superAdminMethod');
        $this->middleware('checkRole:admin,superadmin')->only('adminMethod');
        $this->middleware('checkRole:user,admin,superadmin')->only('userMethod');
    }
}
