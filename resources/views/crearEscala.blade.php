<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>Cantidad de Notas de la Escala</h1>
    <input type="number" id="cantNotas" min="2" max="10" value="2" onChange="mostrarNotas()" />
    <h1>Notas</h1>

    <form action="/enviarEscala" method="post">
      Descripcion de la Escala:
      <input type="text" name="notas" required="true"/>

      <div id="notasEscalaContainer">
        @for ($i = 0; $i < 2; $i++)
          Nota:
          <input type="text" name="notas" required="true"/>
          Concepto:
          <select name="notas">
            <option>Aprobado</option>
            <option>Desaprobado</option>
          </select> <br/>
        @endfor
      </div>

      <input type="submit" />
    </form>

    <script src="js/escalaNotas.js"></script>
  </body>
</html>
