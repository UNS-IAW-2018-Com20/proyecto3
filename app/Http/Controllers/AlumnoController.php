<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Alumno;
use App\Comision;

class AlumnoController extends Controller
{
    public function index()
    {
      $alumnos = Alumno::all();
      //$alumnos = Comision::all();
      return view('alumnos')->with('alumnos',$alumnos);


    }
}
