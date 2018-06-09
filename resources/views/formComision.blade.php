<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>Creación de Comisión</h1>
    <form method="post">
      {{ csrf_field() }}
      <div>
        Nombre de la Comisión
        <input type="text" name="nombre" required="true"/>
      </div>
      <div>
        Seleccionar Alumnos
        <select multiple  required="true" name="alumnos[]" id="select" size="5">
          @foreach ($alumnos as $alumno)
            <option value={{$alumno -> _id}}> {{ $alumno->nombre }} {{ $alumno->apellido }} (LU: {{ $alumno->lu }})</option>
          @endforeach
        </select>
      </div>
      <input type="submit" />
    </form>
  </body>
</html>
