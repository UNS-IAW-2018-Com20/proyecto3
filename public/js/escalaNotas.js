
    $("#crear").click(function(){

  		$("#contenedor").append('<div>Nota: <input class="form-control form-group" type="text" name="notas[]" required="true"/> Concepto: <select class="form-control" name="conceptos[]"> <option>Aprobado</option> <option>Desaprobado</option> </select> <br/></div>');
  	});



    $("#eliminar").click(function(){
        $("#contenedor div:last").remove();

  	});
