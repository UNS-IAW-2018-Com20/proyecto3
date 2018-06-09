@extends('principal')

@section('title','Crear Escala')

@section('content')


{{--open--}}

<div class="col-lg-12" id="divMenu">
    <div class="my-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-lg-offset-3 myform-cont">
                    <div class="myform-top">
                        <div class="myform-top-left">
                            <h3> Crear Escala</h3>
                        </div>
                    </div>

                    <div class="myform-bottom">


                      <h1>Notas</h1>
                      <form method="post">
                      {{ csrf_field() }}
                      Descripcion de la Escala:
                      <input class="form-group form-control" type="text" name="descripcion" required="true"/>

                      <div class="form-group" id="notasEscalaContainer">
                        <h1>Cantidad de Notas de la Escala</h1>
                        <input class="form-control" type="number" id="cantNotas" min="2" max="10" value="2" onChange="mostrarNotas()" />
                        @for ($i = 0; $i < 2; $i++)
                          Nota:
                          <input class="form-control form-group" type="text" name="notas[]" required="true"/>
                          Concepto:
                          <select class="form-control" name="conceptos[]">
                            <option>Aprobado</option>
                            <option>Desaprobado</option>
                          </select> <br/>
                        @endfor
                      </div>

                      <input type="submit" class="btn btn-primary"/>
                    </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

{{--end--}}


    <script src="js/escalaNotas.js"></script>

@endsection
