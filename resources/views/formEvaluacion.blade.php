@extends('principal')

@section('title','Evaluaciones')

@section('content')


{{--open--}}

<div class="col-lg-12" id="divMenu">
    <div class="my-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-lg-offset-3 myform-cont">
                    <div class="myform-top">
                        <div class="myform-top-left">
                            <h3>Crear Evaluación</h3>
                        </div>
                    </div>

                    <div class="myform-bottom">


                      <form method="post">
                        {{ csrf_field() }}
                        <div>
                          Nombre
                          <input class="form-control form-group" type="text" name="nombre" required="true"/>
                        </div>
                        <div>
                          Descripción
                          <input class="form-control form-group" type="text" name="descripcion" required="true"/>
                        </div>
                        <div>
                          Fecha
                          <input class="form-control form-group"  type="date" name="fecha" min=
                            <?php
                             echo date('Y-m-d');
                             ?>
                          >
                        <div class="form-group">
                          Seleccionar Comisiones
                          <select class="form-control form-group" multiple  required="true" name="comisiones[]" id="selectComisiones" size="5">
                            @foreach ($comisiones as $comision)
                              <option value={{$comision -> _id}}> {{ $comision->nombre }} </option>
                            @endforeach
                          </select>
                        </div>
                        <div>
                          Seleccion Evaluador
                          <select class="form-control form-group" required="true" name="evaluador" id="selectEvaluador" size="5">
                            @foreach ($evaluadores as $evaluador)
                              <option value={{$evaluador -> _id}}> {{ $evaluador->nombre }} {{ $evaluador->apellido }} </option>
                            @endforeach
                          </select>
                        <div class="form-group">
                          Escala de Notas
                          <select class="form-control form-group" required="true" name="escala" id="selectEscalas" size="5">
                            @foreach ($escalas as $escala)
                              <option value={{$escala -> _id}}> {{ $escala->descripcion }} </option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                          Tipo de Evaluacion
                          <select class="form-control form-group" required="true" name="tipo" id="selectTipoEvaluacion">
                            @foreach ($tipos as $tipo)
                              <option value={{$tipo -> _id}}> {{ $tipo->descripcion }} </option>
                            @endforeach
                          </select>
                        </div>
                        <div>
                          Criterios (Al menos uno)
                          <div>
                            Criterio 1 <input class="form-control" type="text" name="criterios[]" required="true"/>
                            Criterio 2 <input class="form-control" type="text" name="criterios[]" />
                            Criterio 3 <input class="form-control" type="text" name="criterios[]" />
                          </div>
                        </div>
                        <input class="btn btn-primary" type="submit" />
                      </form>


                    </div>


                </div>
            </div>
        </div>
    </div>
</div>



@endsection
