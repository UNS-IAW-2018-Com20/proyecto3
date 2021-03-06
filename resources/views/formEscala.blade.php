@extends('principal')

@section('title','Escalas')

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

                      <form method="post">
                      {{ csrf_field() }}
                      Descripcion de la Escala:
                      <input class="form-group form-control" type="text" name="descripcion" required="true"/>

                      <div class="form-group" id="notasEscalaContainer">
                        Cantidad de Notas de la Escala

                        <div class="container">
                          <div class="row">
                            <div class="col-md-6">
                              <button id="crear" type="button" class="btn btn-primary">Agregar
                              </button>
                            </div>
                            <div class="col-md-6">
                              <button id="eliminar" type="button" class="btn btn-primary">Eliminar
                              </button>

                            </div>

                          </div>
                        </div>


                          @for ($i = 0; $i < 2; $i++)
                            <div>
                              Nota:
                              <input class="form-control form-group" type="number" name="notas[]" required="true"/>
                              Concepto:
                              <select class="form-control" name="conceptos[]">
                                <option>Aprobado</option>
                                <option>Desaprobado</option>
                              </select> <br/>
                            </div>
                          @endfor
                          <div id="contenedor">

                          </div>
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

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="js/escalaNotas.js"></script>


@endsection
