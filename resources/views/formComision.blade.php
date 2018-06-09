@extends('principal')

@section('title','Evaluaciones')

@section('content')
  <div class="col-lg-12" id="divMenu">
      <div class="my-content">
          <div class="container">
              <div class="row">
                  <div class="col-lg-12 col-lg-offset-3 myform-cont">
                      <div class="myform-top">
                          <div class="myform-top-left">
                              <h3>Comisiones</h3>
                          </div>
                      </div>

                      <div class="myform-bottom">

                        <h1>Creación de Comisión</h1>
                        <form method="post">
                          {{ csrf_field() }}
                          <div>
                            Nombre de la Comisión
                            <input type="text" name="nombre" required="true"/>
                          </div>
                          <div>
                            Seleccionar Alumnos
                            <select multiple  required="true" name="alumnos[]" id="select" size="5">
                              {{--@foreach ($alumnos as $alumno)
                                <option value={{$alumno -> _id}}> {{ $alumno->nombre }} {{ $alumno->apellido }} (LU: {{ $alumno->lu }})</option>
                              @endforeach
                            --}}
                            </select>
                          </div>
                          <input type="submit" />
                        </form>

                      </div>
              </div>
          </div>
      </div>
  </div>

@endsection
