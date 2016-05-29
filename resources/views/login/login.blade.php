@extends('layout.layout') <!--Extiende de layout-->
@section('cuerpo') <!--Va en la seccion donde dice cuerpo-->

<form method="POST" action="{{route('login.store')}}">
  {!! csrf_field() !!}
  <br/> <br/>
<div class="col-md-offset-2 col-md-8">
  <div class="panel panel-primary"  >
    <div class="panel-heading" >
      <h3 class="panel-title">Iniciar Sesión</h3>
    </div>
    <div class="panel-body">
      <div class="row">
        <div class="form-group">
      <div class=" col-md-5">
          <label class="control-label col-md-offset-9" for="focusedInput">Usuario:</label>
      </div>
          <div class="col-md-4">
            <input class="form-control" id="focusedInput" type="name" name="name" placeholder="Usuario">
          </div>
        </div>
      </div><br/>
      <div class="row">
        <div class="form-group" >
          <div class="col-md-5">
            <label for="inputPassword" class="control-label col-md-offset-9">Contraseña:</label>
          </div>
          <div class=" col-md-4">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          </div>
        </div>
      </div><br/>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-md-12 " style="text-align:center;">
          <button type="submit" class="btn btn-info" class="">Iniciar Sesión</button>
        </div>
      </div>
    </div>
  </div>
</div>
</form>



@stop
