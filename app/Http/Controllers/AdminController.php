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

      return view('mensaje',['mensaje_titulo' => 'Éxito', 'mensaje_cuerpo' => 'Escala de Notas creada con éxito!!']);
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
      return view('mensaje',['mensaje_titulo' => 'Éxito', 'mensaje_cuerpo' => 'Comisión creada con éxito!!']);
    }

    public function enviarEvaluacion()
    {
      //Se obtienen elementos del formulario
      $nombre = request('nombre');
      $descripcion = request('descripcion');
      $criterios = request('criterios');
      $fecha = request('fecha');
      $comisiones = request('comisiones');
      $evaluador_id = request('evaluador');
      //De algunos elementos se obtiene el id y se buscan completos en la base de datos
      $escalaDB = Escala::find(request('escala'));
      $tipo = TipoEvaluacion::find(request('tipo'));
      $evaluador = Evaluador::find($evaluador_id);
      //Se crea el obj escala
      $escala = new stdClass();
      $escala->descripcion = $escalaDB->descripcion;
      $escala->notas = $escalaDB->notas;


      //Filtrar los criterios ya que si son null no deben agregarse
      $criterios_filtrados = [];
      foreach ($criterios as $criterio){
        if ($criterio != null){
          array_push($criterios_filtrados,$criterio);
        }
      }

      //Se crea una evaluacion
      $evaluacion = new Evaluacion;
      $evaluacion->nombre = $nombre;
      $evaluacion->comisiones = $comisiones;
      $evaluacion->evaluador = $evaluador_id;
      $evaluacion->save();

      //Se crea un objeto que se va a ir agergando a cada alumno de cada comision seleccionada
      //Se van asignando los valores que son comunes para todos los alumnos
      $evaluacion_comision = new stdClass();
      $evaluacion_comision->evaluacion_nombre = $nombre;
      $evaluacion_comision->evaluacion_id = $evaluacion->_id;
      $evaluacion_comision->fecha = $fecha;
      $evaluacion_comision->escala_notas = $escala;
      $evaluacion_comision->evaluacion_tipo = $tipo->descripcion;
      $evaluacion_comision->descripcion = $descripcion;
      $evaluacion_comision->publicada = false;
      $evaluacion_comision->nota = "";
      $evaluacion_comision->observacion = "";
      $evaluacion_comision->criterios = $criterios_filtrados;
      $evaluacion_comision->notas_criterios = [];

      foreach ($comisiones as $comision){
        //Alumnos que forman parte de la comisión
        $comisionAlumnos = Comision::find($comision);

        //Creacion de documento evaluacion_comision
        $evaluacion_comision_collection = new Evaluacion_Comision;
        $evaluacion_comision_collection->comision = $comision;
        $evaluacion_comision_collection->evaluacion = $evaluacion->_id;
        $evaluacion_comision_collection->save();

        $evaluacion_comision->comision_id = $comisionAlumnos->_id;
        $evaluacion_comision->comision_nombre = $comisionAlumnos->nombre;
        $evaluacion_comision->id_general = $evaluacion_comision_collection->_id;

        foreach ($comisionAlumnos->alumnos as $miembro){
          $alumno = Alumno::find($miembro);
          $alumno->evaluaciones_comisiones =  array_merge($alumno->evaluaciones_comisiones, [$evaluacion_comision]);
          $alumno->save();
        }

        //El evaluador se le agrega la comision asignada
        $evaluador->evaluaciones_comisiones = array_merge($evaluador->evaluaciones_comisiones, [$evaluacion_comision]);
        $evaluador->save();
      }

      return view('mensaje',['mensaje_titulo' => 'Éxito', 'mensaje_cuerpo' => 'Evaluación creada con éxito']);
    }
}
