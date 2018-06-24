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
                            <div class="row p-2">
                                <a class="col-md-12" href="/comisiones">
                                  <button type="button" class="btn btn-primary btn-lg btn-block">Comisiones</button>
                                </a>
                            </div>

                            <div class="row p-2">
                              <a  class="col-md-12" href="/escalas">
                                <button type="button" class="btn btn-primary btn-lg btn-block ">Escalas de Notas</button>
                              </a>
                            </div>
                            <div class="row p-2">
                              <a class="col-md-12" href="/evaluaciones">
                                <button type="button" class="btn btn-primary btn-lg btn-block">Evaluaciones</button>
                              </a>
                            </div>
                    </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
