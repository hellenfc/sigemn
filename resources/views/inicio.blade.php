@extends('layout.layout') <!--Extiende de layout-->
@section('cuerpo') <!--Va en la seccion donde dice cuerpo-->
<br/><br/>
<div class="jumbotron">
  <h1>¡Bienvenido a SIGEMN!</h1>
  <p>Aquí podras ingresar manter un control de tu institución educativa.</p>

  <p><a  href="{{route('login')}}" class="btn btn-info btn-md" >Login</a></p>
</div>

<!-- a href="{{route('logout')}} -->
<div class="col-md-offset-1 col-md-10">
<div class="panel panel-warning" >
  <div class="panel-heading" >
    <h3 class="panel-title">¿Por qué SIGEMN?</h3>
  </div>
  <div class="panel-body" >
    SIGEMN mantendrá un control de tu estudiante, con un gestor de notas y un sistema de matrícula.
  </div>
</div>		
</div>

@stop