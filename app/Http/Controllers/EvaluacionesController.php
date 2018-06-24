<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Alumno;
use App\Evaluacion;
use App\Comision;
use App\Escala;
use App\TipoEvaluacion;
use App\Evaluador;
use App\Evaluacion_Comision;
use \stdClass;

class EvaluacionesController extends Controller
{
    public function index()
    {
      $evaluaciones = Evaluacion::all();
      return view('listar', ['titulo' =>'Lista de Evaluaciones', 'elemento' => 'evaluaciones', 'nombre' => 'nombre', 'lista' => $evaluaciones]);
    }

    public function eliminar($id)
    {
        $affectedRows = Evaluacion_Comision::where('evaluacion', $id)->delete();
        $evaluacion = Evaluacion::find($id);
        $comisiones = $evaluacion->comisiones;
        $evaluador_id = $evaluacion->evaluador;
        Evaluacion::destroy($id);

        //Hay que eliminar en cada alumno
        foreach ($comisiones as $comision){
          //Alumnos que forman parte de la comisión
          $comisionAlumnos = Comision::find($comision);

          foreach ($comisionAlumnos->alumnos as $miembro){
            $alumno = Alumno::find($miembro);

            //Se obtienen sus evaluaciones comisiones
            $evaluaciones_comisiones = $alumno->evaluaciones_comisiones;

            $found = false;
            foreach($evaluaciones_comisiones as $key => $value) {
                if ($value['evaluacion_id'] === $id) {
                    $found = true;
                    break;
                }
            }

            if ($found){
              unset($evaluaciones_comisiones[$key]);
              $alumno->evaluaciones_comisiones = $evaluaciones_comisiones;
              $alumno->save();
            }
          }
        }

        //Hay que eliminar en el evaluador
        $evaluador = Evaluador::find($evaluador_id);

        //Se obtienen sus evaluaciones comisiones
        $evaluaciones_comisiones = $evaluador->evaluaciones_comisiones;
        //Se crean un nuevo arreglo
        $new_evaluaciones_comisiones = [];
        foreach($evaluaciones_comisiones as $key => $value) {
            if ($value['evaluacion_id'] !== $id) {
              array_push($new_evaluaciones_comisiones,$value);
            }
        }
        //Se eliminan los elementos
        $evaluador->evaluaciones_comisiones = $new_evaluaciones_comisiones;
        $evaluador->save();

        return redirect('evaluaciones');
    }

    public function agregarGet()
    {
      $comisiones = Comision::all();
      $escalas = Escala::all();
      $tipos = TipoEvaluacion::all();
      $evaluadores = Evaluador::all();
      return view('formEvaluacion',['evaluadores' => $evaluadores, 'comisiones' => $comisiones, 'escalas' => $escalas, 'tipos' => $tipos]);
    }

    public function agregarPost()
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
      $evaluacion->descripcion = $descripcion;
      $evaluacion->fecha = $fecha;
      $evaluacion->comisiones = $comisiones;
      $evaluacion->evaluador = $evaluador_id;
      $evaluacion->escala_notas = request('escala');
      $evaluacion->tipo = request('tipo');
      $evaluacion->criterios = $criterios;
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
          //Se agrega la nueva evaluacion_comision
          $alumno->evaluaciones_comisiones =  array_merge($alumno->evaluaciones_comisiones, [$evaluacion_comision]);
          $alumno->save();
        }

        //El evaluador se le agrega la comision asignada
        $evaluador = Evaluador::find($evaluador_id);
        $evaluador->evaluaciones_comisiones = array_merge($evaluador->evaluaciones_comisiones, [$evaluacion_comision]);
        $evaluador->save();

      }

      return view('mensaje',['mensaje_titulo' => 'Éxito', 'mensaje_cuerpo' => 'Evaluación creada con éxito']);
    }

    public function detallesGet($id)
    {
      $evaluacion = Evaluacion::find($id);
      $comisiones = Comision::all();
      $escalas = Escala::all();
      $tipos = TipoEvaluacion::all();
      $evaluadores = Evaluador::all();

      return view('formEvaluacionDetalles',['evaluadores' => $evaluadores, 'comisiones' => $comisiones, 'escalas' => $escalas, 'tipos' => $tipos, 'evaluacion' => $evaluacion]);
    }

    public function detallesPost($id)
    {
      /*tener en cuenta que a la hora de realizar las modificaciones
        ** No es posible modificar evaluador y comisiónes asignadas
      */

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

      //Se modifica la evaluacion
      $evaluacion = Evaluacion::find($id);
      $evaluacion->nombre = $nombre;
      $evaluacion->descripcion = $descripcion;
      $evaluacion->fecha = $fecha;
      $evaluacion->escala_notas = request('escala');
      $evaluacion->tipo = request('tipo');
      $evaluacion->criterios = $criterios;
      $evaluacion->save();


      foreach ($comisiones as $comision){
        //Alumnos que forman parte de la comisión
        $comisionAlumnos = Comision::find($comision);

        foreach ($comisionAlumnos->alumnos as $miembro){
          $alumno = Alumno::find($miembro);

          //Se obtienen sus evaluaciones comisiones
          $evaluaciones_comisiones = $alumno->evaluaciones_comisiones;

          $found = false;
          foreach($evaluaciones_comisiones as $key => $value) {
              if ($value['evaluacion_id'] === $id) {
                  $found = true;
                  break;
              }
          }

          if ($found){

            $evaluaciones_comisiones[$key]['evaluacion_nombre'] = $nombre;
            $evaluaciones_comisiones[$key]['descripcion'] = $descripcion;
            $evaluaciones_comisiones[$key]['fecha'] = $fecha;
            $evaluaciones_comisiones[$key]['escala_notas'] = $escala;

            $alumno->evaluaciones_comisiones = $evaluaciones_comisiones;

            $alumno->save();
          }

        }
      }

      //El evaluador se le agrega la modifican las comisiones
      $evaluador = Evaluador::find($evaluador_id);

      //Se obtienen sus evaluaciones comisiones
      $evaluaciones_comisiones = $evaluador->evaluaciones_comisiones;

      foreach($evaluaciones_comisiones as $key => $value) {
          if ($value['evaluacion_id'] === $id) {
            $evaluaciones_comisiones[$key]['evaluacion_nombre'] = $nombre;
            $evaluaciones_comisiones[$key]['descripcion'] = $descripcion;
            $evaluaciones_comisiones[$key]['fecha'] = $fecha;
            $evaluaciones_comisiones[$key]['escala_notas'] = $escala;
          }
      }
      $evaluador->evaluaciones_comisiones = $evaluaciones_comisiones;
      $evaluador->save();

      return view('mensaje',['mensaje_titulo' => 'Éxito', 'mensaje_cuerpo' => 'Evaluación modificada con éxito']);
    }
}
