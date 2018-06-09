function mostrarNotas() {
  let containerNotas = document.getElementById("notasEscalaContainer");
  containerNotas.innerHTML = "";

  const cantNotas = document.getElementById("cantNotas").value;

  for (let i=0; i<cantNotas; i++){
    containerNotas.innerHTML += "Nota:<input type='text' name='notas[]' required='true'/>Concepto:<select name='conceptos[]'><option>Aprobado</option><option>Desaprobado</option></select> <br/>";
  }

}
