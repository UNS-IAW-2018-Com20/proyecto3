<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Escala;
use \stdClass;

class EscaladeNotasController extends Controller
{
    public function index()
    {
      $escalas = Escala::all();
      return view('listar', ['titulo' =>'Lista de Escalas de Notas', 'elemento' => 'escalas', 'nombre' => 'descripcion', 'lista' => $escalas]);
    }

    public function eliminar($id)
    {
        Escala::destroy($id);
        return redirect('escalas');
    }

    public function agregarGet()
    {
      return view('formEscala');
    }

    public function agregarPost()
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

    public function detallesGet($id)
    {
      $escala = Escala::find($id);
      return view('formEscalaDetalles', ['escala' => $escala]);
    }

    public function detallesPost($id){
      $form_notas = request('notas');
      $form_conceptos = request('conceptos');

      $escala = Escala::find($id);
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

      return view('mensaje',['mensaje_titulo' => 'Éxito', 'mensaje_cuerpo' => 'Escala de Notas modificada con éxito!!']);
    }
}
