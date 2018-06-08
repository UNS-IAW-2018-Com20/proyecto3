function mostrarNotas() {
  let containerNotas = document.getElementById("notasEscalaContainer");
  containerNotas.innerHTML = "";

  const cantNotas = document.getElementById("cantNotas").value;

  for (let i=0; i<cantNotas; i++){
    containerNotas.innerHTML += "Nombre:<input type='text' name='notas' required='true'>Estado:<select name='notas'><option>Aprobado</option><option>Desaprobado</option></select> <br/>";
  }

}
