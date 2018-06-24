# Proyecto 3 - Ingeniería de Aplicaciones Web
## Página Web del Administrador
La página está protegida mediante el autenticación básica (Auth basic) de apache.
El usuario es *"administrador"* y el password *"reentrega"*.\
\
**A tener en cuenta**
* Se realizó un cambio en el modelo de la base de datos. Las tablas *alumnos* y *evaluadores* guardan los datos completos de los mismos. Se relaciones importantes a otras tablas, como se tenía inicialmente.\
* Se definió que las notas de las escalas fueran únicamente numéricas para favorecer el cálculo del promedio.
* Cada nota de la escala posee únicamente dos atributos, la nota numérica, y su concepto, que puede Aprobado o Desaprobado.
* La escala de notas debe tener al menos 2 notas definidas.
* La fecha de la evaluación a crear no puede ser anterior a la fecha actual.
* Los tipos de evaluación pueden ser Parcial o Proyecto.
* Modificar/Eliminar una escala no produce cambios de escala en las evaluaciones creadas anteriormente con la misma.
* Modificar/Eliminar una comisión no produce cambios en las evaluaciones creadas anteriormente.
* Se decidió que al modificar una Evaluación no se permitese editar las comisiones ni el evaluador, ya que eso implicaba una gran cantidad de cambios en la base de datos (evaluadores y alumnos) que volvían al sistema muy ineficiente.
* Al eliminar una evaluación, los cambios se ven reflejados en los alumnos de las comisiones asignadas y el evaluador respectivo.
