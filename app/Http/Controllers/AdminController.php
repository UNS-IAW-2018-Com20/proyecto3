<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Alumno;
use App\Comision;
use App\Escala;
use \stdClass;

class AdminController extends Controller
{
    public function formEscala()
    {
      return view('crearEscala');
    }

    public function enviarEscala()
    {
      $form_notas = request('notas');
      $form_conceptos = request('conceptos');

      $escala = new Escala;
      $escala->descripcion = request('descripcion');
      $arreglo_notas = [];

      for ($i = 0; $i< sizeof($form_notas); $i++){
        $notas = new stdClass();
        $notas->nota = $form_notas[$i];
        $notas->concepto = $form_conceptos[$i];
        array_push($arreglo_notas,$notas);
      }

      $escala->notas = $arreglo_notas;
      $escala->save();

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
      return view('index');
    }

    public function formExamen()
    {

    }
}
