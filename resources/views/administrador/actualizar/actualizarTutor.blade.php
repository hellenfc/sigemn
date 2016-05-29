
@extends('layout.layout') <!--Extiende de layout-->
@section('cuerpo') <!--Va en la seccion donde dice cuerpo-->
<br>
<div class="col-md-offset-2 col-md-8">

  <div ng-app="myApp" ng-controller="customersCtrl">
  <div class="panel panel-warning"  id="maptoc">
    <div class="panel-heading" >
      <h3 class="panel-title">Actualizar Tutor </h3>
    </div>
    <br>
    <div class="panel-body">


      <form method="POST" action="guardarTutorActualizado">
        {!! csrf_field() !!}

        <div class="form-group">
          <div class="col-lg-4" >
            <label class="control-label" for="focusedInput" >Tutor:</label>
          </div>


          <div class="col-lg-6">
            <select  name ="tutors" id="select-tutor" onchange="traerInformacionTutor(), showSelectOption()"  ng-model="selectedtutor" class="form-control selectpicker" data-live-search="true">
              @foreach($users as $user)
              <option value="{{$user->id}}">{{$user->primerNombre}} {{$user->primerApellido}}</option>
              @endforeach
            </select>
            <br>
            <br>
            <br>
          </div>
        </div>
        <!-- Para obtener la info del JSON -->
        <div  id = "formularioBoton">
            <div class="form-group">
              <div class="col-lg-4" >
                <label class="control-label" for="focusedInput">Primer Nombre<spam style="color:red;">*</spam></label>
              </div>
              <div class="col-lg-6">
                <!-- En el input pones con value el valor que necesitas del JSON -->
                <input class="form-control" id="pNombreTutor" type="name" name="pNombre" required pattern="^([a-z ñáéíóú A-Z]{3,60})$" title="Nombre mal formado" value="">
                <br>
              </div>
            </div>

            <div class="form-group">
              <div class="col-lg-4" >
                <label class="control-label" for="focusedInput">Segundo Nombre</label>
              </div>
              <div class="col-lg-6">
              <!-- En el input pones con value el valor que necesitas del JSON -->
                <input class="form-control" id="sNombreTutor" type="name" name="sNombre" pattern="^([a-z ñáéíóú A-Z]{3,60})$" title="Nombre mal formado" value="">
                <br>
              </div>
            </div>

            <div class="form-group">
              <div class="col-lg-4" >
                <label class="control-label" for="focusedInput">Primer Apellido<spam style="color:red;">*</spam></label>
              </div>
              <div class="col-lg-6">
                <input class="form-control" id="pApellidoTutor" type="name" name="pApellido" required pattern="^([a-z ñáéíóú A-Z]{3,60})$" title="Apellido mal formado" value="">
                <br>
              </div>
            </div>

            <div class="form-group">
              <div class="col-lg-4" >
                <label class="control-label" for="focusedInput">Segundo Apellido</label>
              </div>
              <div class="col-lg-6">
                <input class="form-control" id="sApellidoTutor" type="name" name="sApellido" pattern="^([a-z ñáéíóú A-Z]{3,60})$" title="Apellido mal formado" value="">
                <br>
              </div>
            </div>

  <div class="form-group">
              <div class="col-lg-4">
                <label class="control-label" for="focusedInput">Número de Identidad<spam style="color:red;">*</spam></label>
              </div>
              <div class="col-lg-6">
                <input class="form-control" id="identidadTutor" type="name" name="noIdentidad" required pattern="([0-9]{4})-([0-9]{4})-([0-9]{5})" title="No de identidad mal formado">
                <br>
              </div>
            </div>

            <div class="form-group">
              <div class="col-lg-4" >
                <label class="control-label" for="focusedInput">Correo Electrónico</label>
              </div>
              <div class="col-lg-6">
                <input class="form-control" id="emailTutor" type="text" name="correo" pattern="^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})$" title="Correo incorrecto" value=""}>
                <br>
              </div>
            </div>

            <div class="form-group">
              <div class="col-lg-4" >
                <label class="control-label" for="focusedInput">Dirección <spam style="color:red;">*</spam></label>
              </div>
              <div class="col-lg-6">
                <input class="form-control" id="direccionTutor" type="name" name="direccion" required value="">
                <br>
              </div>
            </div>

            <div class="form-group">
              <div class="col-lg-4" >
                <label class="control-label" for="focusedInput">Teléfono <spam style="color:red;">*</spam></label>
              </div>
              <div class="col-lg-6">
                <input class="form-control" id="telefonoTutor" type="number" name="telefono" required patter="[0-9]{8}"  title="No telefonico incorrecto" value="">
                <br>
              </div>
          </div>

          <div class="col-lg-12" >
            <button type="submit" class="btn btn-danger" style="text-align: center;">Actualizar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
  @include('layout.scriptsLoad')


<script>
    var app = angular.module('myApp',  []);
    app.controller('customersCtrl', function($scope, $http) {
        $scope.findInfo = function(){

        // Cambia esta url siempre tiene que ir /traerInfoMaestro/ que a este te estas refiriendo en las rutas
        $http.get("http://localhost:8000/traerInfoTutor/" + $scope.selectedtutor)
        .success(function (response) {$scope.information = response;});
        };
    });
  </script>
  	<script src="scripts/mostrar.js"></script>
  <script>
    if ($(document).ready){
      $('#formularioBoton').hide();
    }
  </script>
  <script>
    function traerInformacionTutor(){
      var id = $('#select-tutor').val();
      $.get('http://localhost:8000/traerInfoTutor/'+id, function(data){
        $('#pNombreTutor').val(data.primerNombre);
        $('#sNombreTutor').val(data.segundoNombre);
        $('#pApellidoTutor').val(data.primerApellido);
        $('#sApellidoTutor').val(data.segundoApellido);

        $('#identidadTutor').val(data.nroIdentidad);
        $('#emailTutor').val(data.correo);
        $('#direccionTutor').val(data.direccion);
        $('#telefonoTutor').val(data.telefono);
      });

    }
  </script>

@stop
