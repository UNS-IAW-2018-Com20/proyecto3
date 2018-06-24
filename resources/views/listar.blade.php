@extends('principal')

@section('title','{{$titulo}}')

@section('content')


{{--open--}}

<div class="col-lg-12" id="divMenu">
    <div class="my-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-lg-offset-3 myform-cont">
                    <div class="myform-top">
                        <div class="myform-top-left">
                            <h3>{{$titulo}}</h3>
                        </div>
                    </div>

                    <div class="myform-bottom">
                      <table>
                        <tbody>
                          <tr>
                            <td>
                              <a href="/{{$elemento}}/agregar">
                                <button class="btnEvaluaciones btn btn-primary mr-2"> Agregar nueva </button>
                              </a>
                            </td>
                          </tr>
                          @foreach ($lista as $miembro)
                            <tr>
                              <td>{{ $miembro->$nombre }}</td>
                              <td>
                                <a href="/{{$elemento}}/detalles/{{$miembro->_id}}"><button class="btnEvaluaciones btn btn-primary mr-2"> Detalles </button></a>
                                <a href="/{{$elemento}}/eliminar/{{$miembro->_id}}"><button class="btnEvaluaciones btn btn-primary mr-2"> Eliminar </button></a>
                              </td>
                          @endforeach
                        </tbody>
                      </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



@endsection
