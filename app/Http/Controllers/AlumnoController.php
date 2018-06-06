<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Alumno;

class AlumnoController extends Controller
{
    public function index()
    {
      $alumnos = Alumno::all();
      return view('alumnos.index')->with('alumnos',$alumnos);
    }
}
