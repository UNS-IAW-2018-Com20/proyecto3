<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>Creación de Examen</h1>
    <form method="post">
      {{ csrf_field() }}
      <div>
        Nombre
        <input type="text" name="nombre" required="true"/>
      </div>
      <div>
        Descripción
        <input type="text" name="descripcion" required="true"/>
      </div>
      <div>
        Fecha
        <input type="date" name="fecha" min=
          <?php
           echo date('Y-m-d');
           ?>
        >
      <div>
        Seleccionar Comisiones
        <select multiple  required="true" name="comisiones[]" id="selectComisiones" size="5">
          @foreach ($comisiones as $comision)
            <option value={{$comision -> _id}}> {{ $comision->nombre }} </option>
          @endforeach
        </select>
      </div>
      <div>
        Seleccion Evaluador
        <select required="true" name="evaluador" id="selectEvaluador" size="5">
          @foreach ($evaluadores as $evaluador)
            <option value={{$evaluador -> _id}}> {{ $evaluador->nombre }} {{ $evaluador->apellido }} </option>
          @endforeach
        </select>
      <div>
        Escala de Notas
        <select required="true" name="escala" id="selectEscalas" size="5">
          @foreach ($escalas as $escala)
            <option value={{$escala -> _id}}> {{ $escala->descripcion }} </option>
          @endforeach
        </select>
      </div>
      <div>
        Tipo de Evaluacion
        <select required="true" name="tipo" id="selectTipoEvaluacion">
          @foreach ($tipos as $tipo)
            <option value={{$tipo -> _id}}> {{ $tipo->descripcion }} </option>
          @endforeach
        </select>
      </div>
      <div>
        Criterios (Al menos uno)
        <ul>
          <li>
            Criterio 1 <input type="text" name="criterios[]" required="true"/>
          </li>
          <li>
            Criterio 2 <input type="text" name="criterios[]" />
          </li>
          <li>
            Criterio 3 <input type="text" name="criterios[]" />
          </li>
        </ul>
      </div>
      <input type="submit" />
    </form>
  </body>
</html>
