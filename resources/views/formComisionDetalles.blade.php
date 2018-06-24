@extends('principal')

@section('title','Comisiones')

@section('content')
  <div class="col-lg-12" id="divMenu">
      <div class="my-content">
          <div class="container">
              <div class="row">
                  <div class="col-lg-12 col-lg-offset-3 myform-cont">
                      <div class="myform-top">
                          <div class="myform-top-left">
                              <h3>Detalles Comisión</h3>
                          </div>
                      </div>

                      <div class="myform-bottom">


                        <form method="post">
                          {{ csrf_field() }}
                          <div class="form-group">
                            Nombre de la Comisión
                            <input class="form-control form-group" type="text" name="nombre" required="true" value="{{ $comision -> nombre }}" />
                          </div>
                          <div>
                            Seleccionar Alumnos
                            <select class="form-control" multiple  required="true" name="alumnos[]" id="select" size="5">
                              @foreach ($alumnos as $alumno)
                                <option value={{$alumno -> _id}}  @if (in_array($alumno -> _id, $comision -> alumnos)) selected @endif> {{ $alumno->nombre }} {{ $alumno->apellido }} (LU: {{ $alumno->lu }})</option>
                              @endforeach
                            </select>
                          </div>
                          <input class="btn btn-primary" type="submit" />
                        </form>
                      </div>
              </div>
          </div>
      </div>
  </div>

@endsection
