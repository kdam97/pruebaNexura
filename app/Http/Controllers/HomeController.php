<?php

namespace App\Http\Controllers;

date_default_timezone_set('America/Bogota');

use Illuminate\Http\Request;
use DB;
use App\Roles;
use App\Areas;
use App\Empleados;

class HomeController extends Controller
{
    public function index(){

        return view('welcome', [
            'roles' => Roles::all(),
            'areas' => Areas::all(),
            'empleados' => Empleados::all(),
        ]);
    }

}