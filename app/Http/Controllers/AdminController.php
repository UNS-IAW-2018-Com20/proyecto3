<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Alumno;
use App\Comision;

class AdminController extends Controller
{
    public function formEscala()
    {
      return view('crearEscala');
    }

    public function enviarEscala()
    {
      return view('index');
    }

    public function formComision()
    {
      $alumnos = Alumno::all();
      return view('formComision')->with('alumnos',$alumnos);
    }

    public function enviarComision()
    {
      $comision = new Comision;

      $comision->nombre = request('nombre');
      $comision->alumnos = request('alumnos');
      $comision->save();
    }

    public function formExamen()
    {

    }
}
