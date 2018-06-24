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
                            <h3>Detalles Escala</h3>
                        </div>
                    </div>

                    <div class="myform-bottom">

                      <form method="post">
                      {{ csrf_field() }}
                      Descripcion de la Escala:
                      <input class="form-group form-control" type="text" name="descripcion" required="true" value = "{{ $escala -> descripcion }}" />

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
                              <input class="form-control form-group" type="number" name="notas[]" required="true" value="{{ $escala->notas[$i]['nota'] }}" />
                              Concepto:
                              <select class="form-control" name="conceptos[]">
                                <option @if ($escala->notas[$i]['concepto'] === 'Aprobado') selected @endif>Aprobado</option>
                                <option @if ($escala->notas[$i]['concepto'] === 'Desaprobado') selected @endif>Desaprobado</option>
                              </select> <br/>
                            </div>
                          @endfor
                          <div id="contenedor">
                            @for ($i = 2; $i < count($escala->notas) ; $i++)
                              <div>
                                Nota:
                                <input class="form-control form-group" type="number" name="notas[]" required="true" value="{{ $escala->notas[$i]['nota'] }}" />
                                Concepto:
                                <select class="form-control" name="conceptos[]">
                                  <option @if ($escala->notas[$i]['concepto'] === 'Aprobado') selected @endif>Aprobado</option>
                                  <option @if ($escala->notas[$i]['concepto'] === 'Desaprobado') selected @endif>Desaprobado</option>
                                </select> <br/>
                              </div>
                            @endfor
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
    <script src="/js/escalaNotas.js"></script>


@endsection
