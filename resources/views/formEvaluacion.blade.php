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
        Nombre del Examen
        <input type="text" name="nombre" required="true"/>
      </div>
      <div>
        Fecha
        <input type="date" name="date1" min=
          <?php
           echo date('Y-m-d');
           ?>
        >
      <div>
        Seleccionar Alumnos
      
      </div>
      <input type="submit" />
    </form>
  </body>
</html>
