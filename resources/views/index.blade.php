@extends('principal')

@section('title','Elegir Opciones')

@section('content')

  <div class="col-lg-12" id="divMenu">
      <div class="my-content">
          <div class="container">
              <div class="row">
                  <div class="col-lg-12 col-lg-offset-3 myform-cont">
                      <div class="myform-top">
                          <div class="myform-top-left">
                              <h3> Menú del Administrador</h3>
                          </div>
                      </div>
                      <div class="myform-bottom">
                        <a href="/crearComision">
                          <button type="button" class="btn btn-primary btn-lg btn-block">Crear Comisión</button>
                        </a>
                        <a href="/crearEscala">
                          <button type="button" class="btn btn-primary btn-lg btn-block">Crear Escala Notas</button>
                        </a>
                        <a href="/crearEvaluacion">
                          <button type="button" class="btn btn-primary btn-lg btn-block">Crear Evaluación</button>
                        </a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
