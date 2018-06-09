<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Alumno;
use App\Comision;
use App\Escala;
use App\TipoEvaluacion;
use App\Evaluador;
use App\Evaluacion;
use App\Evaluacion_Comision;
use \stdClass;

class AdminController extends Controller
{
    public function formEscala()
    {
      return view('crearEscala');
    }

    public function formEvaluacion()
    {
      $comisiones = Comision::all();
      $escalas = Escala::all();
      $tipos = TipoEvaluacion::all();
      $evaluadores = Evaluador::all();
      return view('formEvaluacion',['evaluadores' => $evaluadores, 'comisiones' => $comisiones, 'escalas' => $escalas, 'tipos' => $tipos]);
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

    public function enviarEvaluacion()
    {
      //Se obtiene la escala de notas
      $escala = Escala::find(request('escala'));
      $nombre = request('nombre');
      $descripcion = request('descripcion');
      $criterios = request('criterios');
      $tipo = TipoEvaluacion::find(request('tipo'));
      $fecha = request('fecha');

      //Comisiones a las cuales se les agregará la evaluacion
      $comisiones = request('comisiones');

      foreach ($comisiones as $comision){
        $comisionAlumnos = Comision::find($comision);

        foreach ($comisionAlumnos->alumnos as $miembro){
          //$evaluacion_comision = new Evaluacion_Comision;
          $evaluacion_comision = new stdClass();
          $evaluacion_comision->comision_id = $comisionAlumnos->_id;
          $evaluacion_comision->comision_nombre = $comisionAlumnos->nombre;
          $evaluacion_comision->evaluacion_nombre = $nombre;
          $evaluacion_comision->descripcion = $descripcion;
          $evaluacion_comision->nota = "";
          $evaluacion_comision->observacion = "";
          $evaluacion_comision->evaluacion_tipo = $tipo->descripcion;
          $evaluacion_comision->criterios = $criterios;
          $evaluacion_comision->notas_criterios = [];
          $evaluacion_comision->publicada = false;

          $alumno = Alumno::find($miembro);
          $alumno->evaluaciones_comisiones =  array_merge($alumno->evaluaciones_comisiones, [$evaluacion_comision]);
          $alumno->save();
        }
      }
      return view('index');
    }
}
