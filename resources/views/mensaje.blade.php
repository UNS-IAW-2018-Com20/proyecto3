@extends('principal')

@section('title',$mensaje_titulo)

@section('content')


{{--open--}}

<div class="col-lg-12" id="divMenu">
    <div class="my-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-lg-offset-3 myform-cont">
                    <div class="myform-top">
                        <div class="myform-top-left">
                            <h3> {{ $mensaje_titulo }} </h3>
                        </div>
                    </div>
                    <div class="myform-bottom">
                      {{ $mensaje_cuerpo }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
