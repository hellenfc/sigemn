
@extends('layout.layout') <!--Extiende de layout-->
@section('cuerpo') <!--Va en la seccion donde dice cuerpo-->
<div class="col-md-offset-2 col-md-8">

  <br>
  <div ng-app="myApp" ng-controller="customersCtrl">
    <div class="panel panel-warning"  id="maptoc">
      <div class="panel-heading" >
        <h3 class="panel-title">Actualizar Maestro </h3>
      </div>
      <br>


      <div class="panel-body">


        <form method="POST" action="guardarMaestroActualizado">
          {!! csrf_field() !!}

          <div class="form-group">
            <div class="col-lg-4" >
              <label class="control-label" for="focusedInput" >Maestro:</label>
            </div>


            <div class="col-lg-6">
              <select  name ="maestro" id="select-maestro" onchange="traerInformacionMaestro()" ng-model="selectedMaestro" class="form-control selectpicker" data-live-search="true">
                @foreach($maestros as $maestro)
                <option value="{{$maestro->id}}">{{$maestro->primerNombre}} {{$maestro->primerApellido}}</option>
                @endforeach
              </select>
              <br>
              <br><br>
            </div>
          </div>
          <!-- Para obtener la info del JSON -->

          <div class="form-group">

            <div  class="col-lg-4" >
              <label class="control-label" for="focusedInput">Primer Nombre<spam style="color:red;">*</spam></label>
            </div>
            <div class="col-lg-6">
              <!-- En el input pones con value el valor que necesitas del JSON -->
              <input class="form-control" id="pNombreMaestro" type="name" name="pNombre" required pattern="^([a-z ñáéíóú A-Z]{3,60})$" title="Nombre mal formado" value="">
              <br><br>
            </div>
          </div>

          <div class="form-group">
            <div class="col-lg-4" >
              <label class="control-label" for="focusedInput">Segundo Nombre</label>
            </div>
            <div class="col-lg-6">
              <!-- En el input pones con value el valor que necesitas del JSON -->
              <input class="form-control" id="sNombreMaestro" type="name" name="sNombre" pattern="^([a-z ñáéíóú A-Z]{3,60})$" title="Nombre mal formado" value="">
              <br>
            </div>
          </div>

          <div class="form-group">
            <div class="col-lg-4" >
              <label class="control-label" for="focusedInput">Primer Apellido<spam style="color:red;">*</spam></label>
            </div>
            <div class="col-lg-6">
              <input class="form-control" id="pApellidoMaestro" type="name" name="pApellido" required pattern="^([a-z ñáéíóú A-Z]{3,60})$" title="Apellido mal formado" value="">
              <br>
            </div>
          </div>

          <div class="form-group">
            <div class="col-lg-4">
              <label class="control-label" for="focusedInput">Segundo Apellido</label>
            </div>
            <div class="col-lg-6">
              <input class="form-control" id="sApellidoMaestro" type="name" name="sApellido" pattern="^([a-z ñáéíóú A-Z]{3,60})$" title="Apellido mal formado" value="">
              <br>
            </div>
          </div>
          <div class="form-group">
            <div class="col-lg-4">
              <label class="control-label" for="focusedInput">Número de Identidad<spam style="color:red;">*</spam></label>
            </div>
            <div class="col-lg-6">
              <input class="form-control" id="identidadMaestro" type="name" name="noIdentidad" required pattern="([0-9]{4})-([0-9]{4})-([0-9]{5})" title="No de identidad mal formado">
              <br>
            </div>
          </div>

          <div class="form-group">
            <div class="col-lg-4" >
              <label class="control-label" for="focusedInput">Correo Electrónico</label>
            </div>
            <div class="col-lg-6">
              <input class="form-control" id="emailMaestro" type="text" name="correo" pattern="^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})$" title="Correo incorrecto" value="">
              <br>
            </div>
          </div>

          <div class="form-group">
            <div class="col-lg-4">
              <label class="control-label" for="focusedInput">Dirección<spam style="color:red;">*</spam></label>
            </div>
            <div class="col-lg-6">
              <input class="form-control" id="direccionMaestro" type="name" name="direccion" required value="">
              <br>
            </div>
          </div>

          <div class="form-group">
            <div class="col-lg-4" >
              <label class="control-label" for="focusedInput">Teléfono<spam style="color:red;">*</spam></label>
            </div>
            <div class="col-lg-6">
              <input class="form-control" id="telefonoMaestro" type="number" name="telefono" required patter="[0-9]{8}"  title="No telefonico incorrecto" value="">
              <br>
            </div>
          </div>

          <div class="col-lg-12" style="text-align: center;">
            <button type="submit" class="btn btn-danger">Actualizar</button>
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
        $http.get("http://localhost:8000/traerInfoMaestro/" + $scope.selectedMaestro)
        .success(function (response) {$scope.information = response;});
        };
    });
  </script>
  <script>
    function traerInformacionMaestro(){
      var id = $('#select-maestro').val();
      $.get('http://localhost:8000/traerInfoMaestro/'+id, function(data){
        $('#pNombreMaestro').val(data.primerNombre);
        $('#sNombreMaestro').val(data.segundoNombre);
        $('#pApellidoMaestro').val(data.primerApellido);
        $('#sApellidoMaestro').val(data.segundoApellido);
        $('#identidadMaestro').val(data.nroIdentidad);
        $('#emailMaestro').val(data.correo);
        $('#direccionMaestro').val(data.direccion);
        $('#telefonoMaestro').val(data.telefono);
      });

    }
  </script>



@stop
