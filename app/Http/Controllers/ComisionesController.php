<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Comision;
use App\Alumno;

class ComisionesController extends Controller
{
    public function index()
    {
      $comisiones = Comision::all();
      return view('listar', ['titulo' =>'Lista de Comisiones', 'elemento' => 'comisiones', 'nombre' => 'nombre', 'lista' => $comisiones]);
    }

    public function eliminar($id)
    {
        Comision::destroy($id);
        return redirect('comisiones');
    }

    public function agregarGet()
    {
      $alumnos = Alumno::all();
      return view('formComision')->with('alumnos',$alumnos);
    }

    public function agregarPost()
    {
      $comision = new Comision;

      $comision->nombre = request('nombre');
      $comision->alumnos = request('alumnos');
      $comision->save();
      return view('mensaje',['mensaje_titulo' => 'Éxito', 'mensaje_cuerpo' => 'Comisión creada con éxito!!']);
    }

    public function detallesGet($id)
    {
      $alumnos = Alumno::all();
      $comision = Comision::find($id);
      return view('formComisionDetalles',['alumnos' => $alumnos, 'comision' => $comision]);
    }

    public function detallesPost($id){
      $comision = Comision::find($id);

      $comision->nombre = request('nombre');
      $comision->alumnos = request('alumnos');
      $comision->save();
      return view('mensaje',['mensaje_titulo' => 'Éxito', 'mensaje_cuerpo' => 'Comisión modificada con éxito!!']);
    }
}
