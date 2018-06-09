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

                      <h1>Cantidad de Notas de la Escala</h1>
                      <input type="number" id="cantNotas" min="2" max="10" value="2" onChange="mostrarNotas()" />
                      <h1>Notas</h1>
                      <form method="post">
                      {{ csrf_field() }}
                      Descripcion de la Escala:
                      <input type="text" name="descripcion" required="true"/>

                      <div id="notasEscalaContainer">
                        @for ($i = 0; $i < 2; $i++)
                          Nota:
                          <input type="text" name="notas[]" required="true"/>
                          Concepto:
                          <select name="conceptos[]">
                            <option>Aprobado</option>
                            <option>Desaprobado</option>
                          </select> <br/>
                        @endfor
                      </div>

                      <input type="submit" />
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
